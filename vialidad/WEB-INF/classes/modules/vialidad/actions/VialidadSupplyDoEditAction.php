<?php

class VialidadSupplyDoEditAction extends BaseAction {

	function VialidadSupplyDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$supplyParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing supply

			$supply = SupplyPeer::get($_POST["id"]);
			$supply = Common::setObjectFromParams($supply,$supplyParams);
			
			if ($supply->isModified() && !$supply->save()) 
				return $this->returnFailure($mapping,$smarty,$supply,'failure-edit');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New supply

			$supply = new Supply();
			$supply = Common::setObjectFromParams($supply,$supplyParams);
			if (!$supply->save())
				return $this->returnFailure($mapping,$smarty,$supply);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
