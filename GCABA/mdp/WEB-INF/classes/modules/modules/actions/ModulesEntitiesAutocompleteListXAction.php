<?php

class ModulesEntitiesAutocompleteListXAction extends BaseAction {

	function ModulesEntitiesAutocompleteListXAction() {
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
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$moduleEntityPeer = new ModuleEntityPeer();

		$filters = array ("searchString" => $searchString, "limit" => $_REQUEST['limit']);
		$this->applyFilters($moduleEntityPeer,$filters);
		$modulesEntities = $moduleEntityPeer->getAll();
		
		$smarty->assign("modulesEntities",$modulesEntities);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
