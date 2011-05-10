<?php

class BlogCommentsDoDeleteAction extends BaseAction {

	function BlogCommentsDoDeleteAction() {
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

		BlogCommentPeer::delete($_POST["id"]);

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

}