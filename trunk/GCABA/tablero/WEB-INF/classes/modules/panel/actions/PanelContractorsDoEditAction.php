<?php

class PanelContractorsDoEditAction extends BaseAction {

	function PanelContractorsDoEditAction() {
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

		if ($_POST["action"] == "edit") { // Existing contractor

			$contractor = ContractorPeer::get($_POST["id"]);
			$contractor = Common::setObjectFromParams($contractor,$_POST["params"]);
			
			if (!$contractor->save()) 
				return $this->returnFailure($mapping,$smarty,$contractor);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New contractor

			$contractor = new Contractor();
			$contractor = Common::setObjectFromParams($contractor,$_POST["params"]);
			if (!$contractor->save())
				return $this->returnFailure($mapping,$smarty,$contractor);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
