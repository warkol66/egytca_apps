<?php

class PanelMissionDoEditAction extends BaseAction {

	function prepareSmarty($params,$filters,$mapping,$smarty,$mission,$action) {

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$types = MissionPeer::getMissionTypes();
		$smarty->assign("types",$types);

		$policyGuidelines = PolicyGuidelinePeer::getAll();
		$smarty->assign("policyGuidelines",$policyGuidelines);

		$smarty->assign("action",$action);
		$smarty->assign("mission",$mission);

		$smarty = Common::assignParamsAndFiltersToSmarty($smarty,$params,$filters);

		return $smarty;

	}

	function returnFailure($params,$filters,$mapping,$smarty,$mission,$action) {

		$smarty = $this->prepareSmarty($params,$filters,$mapping,$smarty,$mission,$action);
		$smarty->assign("message","error");

		return $mapping->findForwardConfig('failure');

	}

	function PanelMissionDoEditAction() {
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

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if ($_POST["id"] && $_POST["action"] == "edit") { // Existing mission

			$mission = MissionPeer::get($_POST["id"]);
			$mission = Common::setObjectFromParams($mission,$_POST["params"]);

			$params["id"] = $_POST["id"];

			$smarty = $this->prepareSmarty($params,$filters,$mapping,$smarty,$mission,'edit');
	
			if ($mission->isModified() && !$mission->save())
				return $this->returnFailure($params,$filters,$mapping,$smarty,$mission,'edit');

			$smarty->assign("message","ok");
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}
		else { // New mission

			$mission = new Mission();
			$mission = Common::setObjectFromParams($mission,$_POST["params"]);

			if ($mission->save()){
				$params["id"] = $mission->getId();

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('success', $_POST["params"]["name"] . $logSufix);

				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-add');
			}
			else
				return $this->returnFailure($params,$filters,$mapping,$smarty,$mission,'create');

		}

	}

}
