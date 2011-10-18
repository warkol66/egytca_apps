<?php

class VialidadConstructionsEditAction extends BaseAction {

	function VialidadConstructionsEditAction() {
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

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		$contracts = ContractQuery::create()->find();
		$smarty->assign("contracts",$contracts);

		if ($_GET['id']) {
			$construction =  ConstructionPeer::get($_GET['id']);
			if (empty($construction)) {
				$smarty->assign("notValidId","true");
				$construction = new Construction();
			}
			else
				$smarty->assign("action","edit");
		}
		else {
			$construction = new Construction();
			$smarty->assign("action","create");
		}
		$smarty->assign("construction",$construction);
		return $mapping->findForwardConfig('success');
	}
}