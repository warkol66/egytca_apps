<?php

class BlogCommentsDoAddXAction extends BaseDoEditAction {

	public function __construct() {
		parent::__construct('BlogComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		$moduleConfig = Common::getModuleConfiguration($module);
		
		if ( (empty($_POST['formId'])) || !Common::validateCaptcha($_POST['formId']) || !empty($_POST['securityCode'])) {
			$smarty->assign('captcha',true);
			return $mapping->findForwardConfig('failure');
		}
		
		$_POST["params"]["creationDate"] = date('Y-m-d H:m:s');
		$_POST["params"]["ip"] = $_SERVER['REMOTE_ADDR'];
		
		
		//Cambiar llamado a peer
		if ($moduleConfig["comments"]["moderated"] == "YES") {
			if ($params['blogComment']['userId'])
				$_POST["params"]["status"] = BlogCommentPeer::APPROVED;
			else
				$_POST["params"]["status"] = BlogCommentPeer::PENDING;
		}
		else
			$_POST["params"]["status"] = BlogCommentPeer::APPROVED;
		
	}

	/*function BlogCommentsDoAddXAction() {
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

		//me fijo si la entry es valida
		$entry = BlogEntryPeer::get($_POST['entryId']);
		if(!is_object($entry)){
			return $mapping->findForwardConfig('failure');
			$smarty->assign('exists',false);
		}
		else
			$smarty->assign('exists',true);

		$smarty->assign('entry',$entry);
		

		//estoy creando un nuevo blogComment
		//validamos el captcha
		if ( (empty($_POST['formId'])) || !Common::validateCaptcha($_POST['formId']) || !empty($_POST['securityCode'])) {
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
	}*/
}
