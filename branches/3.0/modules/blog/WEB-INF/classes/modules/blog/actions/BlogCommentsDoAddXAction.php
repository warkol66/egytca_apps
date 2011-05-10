<?php

class BlogCommentsDoAddXAction extends BaseAction {

	function BlogCommentsDoAddXAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);		

		$this->template->template = "TemplateAjax.tpl";

		$smarty->assign('entry',BlogEntryPeer::get($_POST['entryId']));

		//estoy creando un nuevo blogComment
		//validamos el captcha
		if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
			$smarty->assign('captcha',true);
			return $mapping->findForwardConfig('failure');
		}

		$_POST["blogComment"]["creationDate"] = date('Y-m-d H:m:s');
		$_POST["blogComment"]["ip"] = $_SERVER['REMOTE_ADDR'];
		
		if ($moduleConfig["comments"]["moderated"] == "YES") {
			if ($params['blogComment']['userId'])
				$_POST["blogComment"]["status"] = BlogCommentPeer::APPROVED;
			else
				$_POST["blogComment"]["status"] = BlogCommentPeer::PENDING;
		}
		else
			$_POST["blogComment"]["status"] = BlogCommentPeer::APPROVED;
		
		$comment = new BlogComment();
		
		$comment = Common::setObjectFromParams($comment,$_POST["blogComment"]);
		if (!$comment->save()) {
			$smarty->assign('entry',BlogEntryPeer::get($_POST['entryId']));
			return $mapping->findForwardConfig('failure');
		}

		$smarty->assign('comment',$comment);
		return $mapping->findForwardConfig('success');
	}
}