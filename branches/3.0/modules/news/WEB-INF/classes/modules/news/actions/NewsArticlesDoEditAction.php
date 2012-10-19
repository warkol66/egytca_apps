<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");

class NewsArticlesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesDoEditAction() {
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
				

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un newsarticle existente

			NewsArticlePeer::update($_POST["newsarticle"]);
      	

		}
		else {
		  //estoy creando un nuevo newsarticle

			if ( !NewsArticlePeer::create($_POST["newsarticle"]) ) {
				$newsarticle = new NewsArticle();
			$newsarticle->setid($_POST["newsarticle"]["id"]);
			$newsarticle->settitle($_POST["newsarticle"]["title"]);
			$newsarticle->settopTitle($_POST["newsarticle"]["topTitle"]);
			$newsarticle->setsubTitle($_POST["newsarticle"]["subTitle"]);
			$newsarticle->setsummary($_POST["newsarticle"]["summary"]);
			$newsarticle->setbody($_POST["newsarticle"]["body"]);
			$newsarticle->setsource($_POST["newsarticle"]["source"]);
			$newsarticle->setsourceContact($_POST["newsarticle"]["sourceContact"]);
			$newsarticle->setcreationDate($_POST["newsarticle"]["creationDate"]);
			$newsarticle->setarchiveDate($_POST["newsarticle"]["archiveDate"]);
			$newsarticle->setstatus($_POST["newsarticle"]["status"]);
			$newsarticle->setregionId($_POST["newsarticle"]["regionId"]);
			require_once("RegionPeer.php");		
			$smarty->assign("regionIdValues",RegionPeer::getAll());
			$newsarticle->setcategoryId($_POST["newsarticle"]["categoryId"]);
			require_once("CategoryPeer.php");		
			$smarty->assign("categoryIdValues",CategoryPeer::getAll());
			$newsarticle->setuserId($_POST["newsarticle"]["userId"]);
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("newsarticle",$newsarticle);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
			}
      }
	  
		//redireccionamiento con opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}

}