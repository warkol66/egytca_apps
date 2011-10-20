<?php

class VialidadBulletinDoEditAction extends BaseAction {

	function VialidadBulletinDoEditAction() {
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
		$bulletinParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing bulletin

			$bulletin = BulletinPeer::get($_POST["id"]);
			$bulletin = Common::setObjectFromParams($bulletin,$bulletinParams);
			
			if ($bulletin->isModified() && !$bulletin->save()) 
				return $this->returnFailure($mapping,$smarty,$bulletin,'failure-edit');

			$params["id"] = $_POST["id"];
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');

		}
		else { // New bulletin

			$bulletin = new Bulletin();
			$bulletin = Common::setObjectFromParams($bulletin,$bulletinParams);
			if (!$bulletin->save())
				return $this->returnFailure($mapping,$smarty,$bulletin);

			$params["id"] = $_POST["id"];
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}

	}

}
