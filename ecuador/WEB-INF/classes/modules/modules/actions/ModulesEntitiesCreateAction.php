<?php

class ModulesEntitiesCreateAction extends BaseSelectAction {
	
	//este se va a usar como Edit y hay que crear otro que extienda DoEdit
	
	function __construct() {
		parent::__construct('ModuleEntity');
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "Modules";
		$this->smarty->assign("module",$module);
		$section = "Entities";
		$this->smarty->assign("section",$section);
		
		$field = new ModuleEntityField();
		$this->smarty->assign("field",$field);
		$this->smarty->assign("fieldCount",$_GET["fieldCount"]);
		
	}

	/*function ModulesEntitiesCreateAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
//print_r($_POST);die;
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

		$entity = new ModuleEntity();

		if ($request->getMethod() == "POST") {
			
			$entity = Common::setObjectFromParams($entity,$_POST["entityParams"]);
			if ($entity->save()) {
				$entity->createFieldsFromParams($_POST["fieldParams"]);
				return $mapping->findForwardConfig('created');
			} 
		} 

		$field = new ModuleEntityField();

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("entity",$entity);
		$smarty->assign("field",$field);
		$smarty->assign("message",$_GET["message"]);
		
		$smarty->assign("fieldCount",$_GET["fieldCount"]);

		$fieldTypes = ModuleEntityFieldPeer::getFieldTypes();
		$smarty->assign("fieldTypes",$fieldTypes);

		return $mapping->findForwardConfig('success');
	}*/

}

