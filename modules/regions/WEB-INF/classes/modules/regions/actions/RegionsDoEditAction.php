<?php

class RegionsDoEditAction extends BaseAction {

	function RegionsDoEditAction() {
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

		$module = "Regions";

		$pagerRedirect = array ( "page" => $_POST["page"]);

		foreach ($_POST["filters"] as $key => $value) 
			$filterRedirect["filters[$key]"] = $value;

		if (is_array($filterRedirect))		
			$redirectParams = $pagerRedirect + $filterRedirect;
		else if (is_array($pagerRedirect))
			$redirectParams = $pagerRedirect;
		else
			$redirectParams = $filterRedirect;

		if ($_POST["action"] == "edit") {

			$_POST["regionData"]["latitude"] = Common::convertToMysqlNumericFormat($_POST["regionData"]["latitude"]);
			$_POST["regionData"]["longitude"] = Common::convertToMysqlNumericFormat($_POST["regionData"]["longitude"]);

			if (RegionPeer::update($_POST["id"],$_POST["regionData"])) {
				$logSufix = ', ' . Common::getTranslation('action: edit','common');
				Common::doLog('success', $_POST["regionData"]["name"] . $logSufix);
				return $this->addParamsToForwards($redirectParams,$mapping,'success');
			}
		}
		else {

			$_POST["regionData"]["latitude"] = Common::convertToMysqlNumericFormat($_POST["regionData"]["latitude"]);
			$_POST["regionData"]["longitude"] = Common::convertToMysqlNumericFormat($_POST["regionData"]["longitude"]);

			$result = RegionPeer::create($_POST["regionData"]);

			if (!$result) {
				$region = new Region();
				$region->setid($_POST["id"]);
				$region->setname($_POST["regionData"]["name"]);
				$smarty->assign("region",$region);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('failure', $_POST["regionData"]["name"] . $logSufix);
				return $this->addParamsToForwards($redirectParams,$mapping,'failure');
			}

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["regionData"]["name"] . $logSufix);
			return $this->addParamsToForwards($redirectParams,$mapping,'success');
		}

	}

}
