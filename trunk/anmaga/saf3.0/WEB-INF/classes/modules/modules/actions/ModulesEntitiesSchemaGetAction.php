<?php

class ModulesEntitiesSchemaGetAction extends BaseAction {

	function ModulesEntitiesSchemaGetAction() {
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

		$module = "Modules";
		$smarty->assign("module",$module);
		$section = "Entities";
		$smarty->assign("section",$section);

		$entity = ModuleEntityPeer::get($_GET["id"]);
		$smarty->assign("entity",$entity);

		header("Content-type: text/xml; charset=UTF-8");	

		return $mapping->findForwardConfig('success');
	}

}

