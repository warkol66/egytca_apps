<?php

class ModulesEntitiesEditAction extends BaseAction {

	function ModulesEntitiesEditAction() {
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
			$entity = ModuleEntityPeer::get($_GET["id"]);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un entity nuevo
			$entity = new ModuleEntity();
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("entity",$entity);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}

