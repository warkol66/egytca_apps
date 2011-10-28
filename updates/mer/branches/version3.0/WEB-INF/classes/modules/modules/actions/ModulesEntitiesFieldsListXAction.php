<?php

class ModulesEntitiesFieldsListXAction extends BaseAction {

	function ModulesEntitiesFieldsListXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$foreignKeyTableId = $_POST['fieldParams']['foreignKeyTable'];

		$fields = ModuleEntityFieldPeer::getAllByEntity($foreignKeyTableId);
		$smarty->assign("fields",$fields);

		return $mapping->findForwardConfig('success');
	}

}

