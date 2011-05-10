<?php

class BlogSendFormAction extends BaseAction {

	function BlogSendFormAction() {
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

		$this->template->template = "TemplateAjax.tpl";

		$blogEntryPeer = new BlogEntryPeer();
		$entry = $blogEntryPeer->get($_POST['id']);

		$smarty->assign('entry',$entry);

		return $mapping->findForwardConfig('success');
	}

}