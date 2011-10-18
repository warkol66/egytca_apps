<?php

class VialidadConstructionsViewXAction extends BaseAction {

	function VialidadConstructionsViewXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Constructions";
		$smarty->assign("section",$section);

		$id = $_GET["id"];

		$construction = ConstructionPeer::get($id);
		$smarty->assign("construction",$construction);

		return $mapping->findForwardConfig('success');
	}

}
