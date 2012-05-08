<?php

class PanelGuaranteesDoEditAction extends BaseAction {

	function PanelGuaranteesDoEditAction() {
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

		$_POST["params"]["ammount"] = Common::convertToMysqlNumericFormat($_POST["params"]["ammount"]);

		if ($_POST["action"] == "edit") { // Existing guarantee
			
			$params["id"] = $_POST["id"];

			$guarantee = GuaranteePeer::get($_POST["id"]);
			$guarantee = Common::setObjectFromParams($guarantee,$_POST["params"]);
			
			if (!$guarantee->save()) 
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New guarantee

			$guarantee = new Guarantee();
			$guarantee = Common::setObjectFromParams($guarantee,$_POST["params"]);
			if (!$guarantee->save())
				return $this->returnFailure($mapping,$smarty,$guarantee);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
