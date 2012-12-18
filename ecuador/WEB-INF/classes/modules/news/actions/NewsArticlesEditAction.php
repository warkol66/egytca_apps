<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");
require_once("NewsMediaPeer.php");

class NewsArticlesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "News";
		$smarty->assign("module",$module);
		$smarty->assign("actualAction", "newsArticlesEdit");

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$newsArticlesConfig = $moduleConfig["newsArticles"];
		$smarty->assign("newsArticlesConfig",$newsArticlesConfig);

    if ( !empty($_GET["id"]) ) {
			//voy a editar un newsarticle

			$newsarticle = NewsArticlePeer::get($_GET["id"]);

			$smarty->assign("newsarticle",$newsarticle);
			if ($newsArticlesConfig['useRegions']['value'] == "YES") {
				require_once("RegionPeer.php");		
				$smarty->assign("regionIdValues",RegionPeer::getAll());
			}
			if ($newsArticlesConfig['useCategories']['value'] == "YES") {
				require_once("CategoryPeer.php");		
				$smarty->assign("categoryIdValues",CategoryPeer::getAll());
			}
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());
			//buscamos las medias de articulo para listarlas
			$smarty->assign("newsmedias",NewsMediaPeer::getAll($_GET['id']));
			
			$smarty->assign("images",$newsarticle->getImages());
			$smarty->assign("sounds",$newsarticle->getSounds());
			$smarty->assign("videos",$newsarticle->getVideos());

	    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un newsarticle nuevo
			$newsarticle = new NewsArticle();
			$smarty->assign("newsarticle",$newsarticle);			
			if ($newsArticlesConfig['useRegions']['value'] == "YES") {
				require_once("RegionPeer.php");		
				$smarty->assign("regionIdValues",RegionPeer::getAll());
			}
			if ($newsArticlesConfig['useCategories']['value'] == "YES") {
				require_once("CategoryPeer.php");		
				$smarty->assign("categoryIdValues",CategoryPeer::getAll());
			}
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());

			$smarty->assign("action","create");
		}

		$newsMediasTypes = NewsMediaPeer::getMediaTypes();
		
		$types = array();
		if ($moduleConfig["image"]["useImages"]["value"] == "NO")
			$types[NewsMediaPeer::NEWSMEDIA_IMAGE] = 'Imagen';
		if ($moduleConfig["video"]["useVideo"]["value"] == "NO")
			$types[NewsMediaPeer::NEWSMEDIA_VIDEO] = 'Video';
		if ($moduleConfig["audio"]["useAudio"]["value"] == "NO")
			$types[NewsMediaPeer::NEWSMEDIA_SOUND] = 'Sonido';

		$smarty->assign("newsArticleStatus",NewsArticlePeer::getStatus());
		$smarty->assign("newsMediasTypes",array_diff_assoc($newsMediasTypes, $types));

		$smarty->assign("message",$_GET["message"]);
		
		if (!empty($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
		}

		return $mapping->findForwardConfig('success');
	}

}