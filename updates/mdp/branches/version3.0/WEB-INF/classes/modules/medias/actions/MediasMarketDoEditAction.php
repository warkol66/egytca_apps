<?php

class MediasMarketDoEditAction extends BaseAction {

	function MediasMarketDoEditAction() {
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
		$mediaMarketParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing media

			$mediaMarket = MediaMarketPeer::get($_POST["id"]);
			$mediaMarket = Common::setObjectFromParams($mediaMarket,$mediaMarketParams);
			
			if ($mediaMarket->isModified() && !$mediaMarket->save()) 
				return $this->returnFailure($mapping,$smarty,$mediaMarket,'failure-edit');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New media

			$mediaMarket = new MediaMarket();
			$mediaMarket = Common::setObjectFromParams($mediaMarket,$mediaMarketParams);
			if (!$mediaMarket->save())
				return $this->returnFailure($mapping,$smarty,$mediaMarket);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
