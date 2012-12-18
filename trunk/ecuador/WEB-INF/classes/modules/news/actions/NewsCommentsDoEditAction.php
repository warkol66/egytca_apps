<?php

require_once("BaseAction.php");
require_once("NewsCommentPeer.php");

class NewsCommentsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsCommentsDoEditAction() {
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
			//estoy editando un newscomment existente
			NewsCommentPeer::update($_POST["newscomment"]);

			//redireccionamiento con opciones correctas
			$myRedirectConfig = $mapping->findForwardConfig('success');
			$myRedirectPath = $myRedirectConfig->getpath();
			
			if (isset($_POST['articleId']))
				$myRedirectPath .= '&articleId='.$_POST["articleId"];
			
			foreach ($_POST['filters'] as $key => $value) 
			$myRedirectPath .= "&filters[$key]=$value";

			$fc = new ForwardConfig($myRedirectPath, True);
			
			return $fc;			

		}
		else {
		  //estoy creando un nuevo newscomment

			if ( !NewsCommentPeer::create($_POST["newscomment"]) ) {
				$newscomment = new NewsComment();
			$newscomment->setid($_POST["newscomment"]["id"]);
			$newscomment->setarticleId($_POST["newscomment"]["articleId"]);
			require_once("NewsArticlePeer.php");		
			$smarty->assign("articleIdValues",NewsArticlePeer::getAll());
			$newscomment->settext($_POST["newscomment"]["text"]);
			$newscomment->setemail($_POST["newscomment"]["email"]);
			$newscomment->setusername($_POST["newscomment"]["username"]);
			$newscomment->seturl($_POST["newscomment"]["url"]);
			$newscomment->setip($_POST["newscomment"]["ip"]);
			$newscomment->setcreationDate($_POST["newscomment"]["creationDate"]);
			$newscomment->setstatus($_POST["newscomment"]["status"]);
			$newscomment->setuserId($_POST["newscomment"]["userId"]);
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("newscomment",$newscomment);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}