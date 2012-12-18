<?php

require_once("BaseAction.php");
require_once("NewsMediaPeer.php");

class NewsMediasDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsMediasDoEditAction() {
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
			//estoy editando un newsmedia existente

			NewsMediaPeer::update($_POST["newsmedia"]);

		}
		else {
		  //estoy creando un nuevo newsmedia

			if ( !NewsMediaPeer::create($_POST["newsmedia"]) ) {
				$newsmedia = new NewsMedia();
			$newsmedia->setid($_POST["newsmedia"]["id"]);
			$newsmedia->setarticleId($_POST["newsmedia"]["articleId"]);
			require_once("NewsArticlePeer.php");		
			$smarty->assign("articleIdValues",NewsArticlePeer::getAll());
			$newsmedia->setname($_POST["newsmedia"]["name"]);
			$newsmedia->settitle($_POST["newsmedia"]["title"]);
			$newsmedia->setdescription($_POST["newsmedia"]["description"]);
			$newsmedia->setmediaType($_POST["newsmedia"]["mediaType"]);
			$newsmedia->setorder($_POST["newsmedia"]["order"]);
			$newsmedia->setcreationDate($_POST["newsmedia"]["creationDate"]);
			$newsmedia->setstatus($_POST["newsmedia"]["status"]);
			$newsmedia->setuserId($_POST["newsmedia"]["userId"]);
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("newsmedia",$newsmedia);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
      		}
			
		}
		
		//redireccionamos con las opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}

}