<?php

class BlogCommentsDoEditAction extends BaseAction {

	function BlogCommentsDoEditAction() {
		;
	}

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

		$module = "Blog";
		$smarty->assign("module",$module);

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un blogComment existente
			BlogCommentPeer::update($_POST["blogComment"]["id"],$_POST["blogComment"]);

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
			//estoy creando un nuevo blogComment

			if ( !BlogCommentPeer::create($_POST["blogComment"]) ) {
				$blogComment = new BlogCommentPeer();
				$blogComment->setid($_POST["blogComment"]["id"]);
				$blogComment->setarticleId($_POST["blogComment"]["articleId"]);
				$smarty->assign("articleIdValues",BlogEntryPeer::getAll());
				$blogComment->settext($_POST["blogComment"]["text"]);
				$blogComment->setemail($_POST["blogComment"]["email"]);
				$blogComment->setusername($_POST["blogComment"]["username"]);
				$blogComment->seturl($_POST["blogComment"]["url"]);
				$blogComment->setip($_POST["blogComment"]["ip"]);
				$blogComment->setcreationDate($_POST["blogComment"]["creationDate"]);
				$blogComment->setstatus($_POST["blogComment"]["status"]);
				$blogComment->setuserId($_POST["blogComment"]["userId"]);
				$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("blogComment",$blogComment);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}