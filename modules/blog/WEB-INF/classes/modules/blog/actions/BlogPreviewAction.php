<?php

class BlogPreviewAction extends BaseAction {

	function BlogPreviewAction() {
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

		if (!empty($_POST['id']))
			$_POST['blogEntry']['id'] = $_POST['id'];

		$preview = BlogEntryPeer::createPreview($_POST['blogEntry']);

		//caso de preview en Home
		if ($_POST['mode'] == 'home') {

			$this->template->template = "TemplateBlogHome.tpl";
			$blogEntries = array();
			array_push($blogEntries,$preview);
			$smarty->assign("blogEntries",$blogEntries);

			return $mapping->findForwardConfig('success-home');
		}

		//caso de preview detallado
		if ($_POST['mode'] == 'detailed') {
			$this->template->template = "TemplateBlogPublic.tpl";
			$smarty->assign('blogEntry',$preview);
			return $mapping->findForwardConfig('success-detailed');

		}

	}

}