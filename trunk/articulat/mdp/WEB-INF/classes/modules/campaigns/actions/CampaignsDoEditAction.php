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

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if ($_POST["id"]) { // Existing campaign

			$campaign = CampaignQuery::create()->findPK($_POST["id"]);

			if (!empty($campaign)) {
				if (isset($_POST["params"]["id"]))
					unset($_POST["params"]["id"]);
				$campaign = Common::setObjectFromParams($campaign,$_POST["params"]);

				$params["id"] = $_POST["id"];

				$smarty = $this->prepareSmarty($params,$filters,$mapping,$smarty,$campaign,'edit');

				if ($campaign->isModified() && !$campaign->save()) {
					if ($this->isAjax()) {
						$smarty->assign('errors', array(
							array('msg' => 'error desconocido')
						));
						header('Content-Type: application/json');
						$smarty->display('CampaignsDoEdit.json.tpl');
						return;
					} else {
						return $this->returnFailure($params,$filters,$mapping,$smarty,$campaign,'edit');
					}
				}

				if ($this->isAjax()) {
					header('Content-Type: application/json');
					$smarty->display('CampaignsDoEdit.json.tpl');
					return;
				} else {
					$smarty->assign("message","ok");
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
				}
			}
		}
		else { // New campaign

			$campaign = new Campaign();
			$campaign = Common::setObjectFromParams($campaign,$_POST["params"]);

			if ($campaign->save()){
				$params["id"] = $campaign->getId();

				if (mb_strlen($_POST["params"]["name"]) > 120)
					$cont = " ... ";

				$logSufix = "$cont, " . Common::getTranslation('action: create','common');
				Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-add');
			}
			else
				return $this->returnFailure($params,$filters,$mapping,$smarty,$campaign,'create');

		}

	}

}
