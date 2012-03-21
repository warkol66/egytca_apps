<?php

class ModulesEntitiesFieldsEditAction extends BaseAction {

	function ModulesEntitiesFieldsEditAction() {
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

		$module = "Modules";
		$smarty->assign("module",$module);
		$section = "Entities";
		$smarty->assign("section",$section);

		if ( !empty($_GET["id"]) ) {
			$field = ModuleEntityFieldPeer::get($_GET["id"]);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un entity nuevo
			$field = new ModuleEntityField();
			if (!empty($_GET["entityId"]))
				$field->setEntityId($_GET["entityId"]);
			$smarty->assign("action","create");
		}

		$entities = ModuleEntityPeer::getAll();
		$smarty->assign("entities",$entities);
		
		$smarty->assign("emptyValidation",new ModuleEntityFieldValidation());
		$smarty->assign("validationNames",ModuleEntityFieldValidationPeer::getValidationNames());

		$fieldTypes = ModuleEntityFieldPeer::getFieldTypes();
		$smarty->assign("fieldTypes",$fieldTypes);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("field",$field);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}

