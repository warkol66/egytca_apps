<?php

class VialidadSupplyDoEditXAction extends BaseAction {

	function VialidadSupplyDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$userParams = Common::userInfoToDoLog();
		$supplyParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing supply

			$supply = SupplyPeer::get($_POST["id"]);
			$supply = Common::setObjectFromParams($supply,$supplyParams);
			
			if ($supply->isModified() && !$supply->save()) 
				throw new Exception("Couldn't save supply");
		}
		else { // New supply

			$supply = new Supply();
			$supply = Common::setObjectFromParams($supply,$supplyParams);
			if (!$supply->save())
				throw new Exception("Couldn't save supply");
			$smarty->assign('newSupply', $supply);
		}
		
		if($supplyParams["type"] == 2)
			$supplies = SupplyQuery::create()->filterByType(2)->find();
		else
			$supplies = SupplyQuery::create()->filterByType(1)->find();

		$smarty->assign('supplies', $supplies);
		return $mapping->findForwardConfig('success');
	}

}
