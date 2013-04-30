<?php

class BoardSendFormAction extends BaseAction {

	function BoardSendFormAction() {
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

		$module = "Board";
		$smarty->assign("module",$module);

		$this->template->template = "TemplateAjax.tpl";

		$entry = BlogEntryQuery::create()->findOneById($_POST['id']);

		$smarty->assign('entry',$entry);

		return $mapping->findForwardConfig('success');
	}

}
