<?php

class ModulesEntitiesSchemaExportAction extends BaseAction {

	function ModulesEntitiesSchemaExportAction() {
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

		$moduleName = $_POST["moduleName"];
    $smarty->assign('moduleName', $moduleName);
    
    $entities = ModuleEntityQuery::create()->filterByModuleName($moduleName)->find();
    $smarty->assign('entities', $entities);
    
    $fileName = $moduleName . '.schema.xml';
    
    header('Content-Description: File Transfer');
    header('Content-Type: text/xml; charset: utf-8;');
    header('Content-Disposition: attachment; filename=' . $fileName);
    header('Content-Transfer-Encoding: chunked');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    
		return $mapping->findForwardConfig('success');
	}

}

