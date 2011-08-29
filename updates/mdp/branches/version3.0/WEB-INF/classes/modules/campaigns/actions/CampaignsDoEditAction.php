<?php

class CampaignsDoEditAction extends BaseAction {

	function prepareSmarty($params,$filters,$mapping,$smarty,$campaign,$action) {

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$types = CampaignPeer::getCampaignTypes();
		$smarty->assign("types",$types);

		$smarty->assign("action",$action);
		$smarty->assign("campaign",$campaign);

		$smarty = Common::assignParamsAndFiltersToSmarty($smarty,$params,$filters);

		return $smarty;

	}

	function returnFailure($params,$filters,$mapping,$smarty,$campaign,$action) {

		$smarty = $this->prepareSmarty($params,$filters,$mapping,$smarty,$campaign,$action);
		$smarty->assign("message","error");

		return $mapping->findForwardConfig('failure');

	}

	function CampaignsDoEditAction() {
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

		if ($_POST["id"] && $_POST["action"] == "edit") { // Existing campaign

			$campaign = CampaignPeer::get($_POST["id"]);
			$campaign = Common::setObjectFromParams($campaign,$_POST["params"]);

			$params["id"] = $_POST["id"];

			$smarty = $this->prepareSmarty($params,$filters,$mapping,$smarty,$campaign,'edit');
	
			if ($campaign->isModified() && !$campaign->save())
				return $this->returnFailure($params,$filters,$mapping,$smarty,$campaign,'edit');

			$smarty->assign("message","ok");
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}
		else { // New campaign

			$campaign = new Campaign();
			$campaign = Common::setObjectFromParams($campaign,$_POST["params"]);

			if ($campaign->save()){
				$params["id"] = $campaign->getId();

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('success', $_POST["params"]["name"] . $logSufix);

				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-add');
			}
			else
				return $this->returnFailure($params,$filters,$mapping,$smarty,$campaign,'create');

		}

	}

}
