<?php

require_once("BaseAction.php");
require_once("NewsCommentPeer.php");

class NewsCommentsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsCommentsEditAction() {
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
		

    if ( !empty($_GET["id"]) ) {
			//voy a editar un newscomment

			$newscomment = NewsCommentPeer::get($_GET["id"]);

			$smarty->assign("newscomment",$newscomment);
			require_once("NewsArticlePeer.php");		
			$smarty->assign("articleIdValues",NewsArticlePeer::getAll());
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());

	    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un newscomment nuevo
			$newscomment = new NewsComment();
			$smarty->assign("newscomment",$newscomment);			
			require_once("NewsArticlePeer.php");		
			$smarty->assign("articleIdValues",NewsArticlePeer::getAll());
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());

			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);
		
		//redireccionamientos
		if (isset($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);
		if (isset($_GET['articleId']))
			$smarty->assign('articleId',$_GET['articleId']);
			
		return $mapping->findForwardConfig('success');
	}

}