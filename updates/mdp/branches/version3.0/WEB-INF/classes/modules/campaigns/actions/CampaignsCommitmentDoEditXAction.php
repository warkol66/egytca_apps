<?php

class CampaignsCommitmentDoEditXAction extends BaseAction {

	function CampaignsCommitmentDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Campaign";
		$section = "Commitment";

		if ($_POST["commitmentId"]) {
			$commitment = CampaignCommitmentPeer::get($_POST["commitmentId"]);
			$commitment = Common::setObjectFromParams($commitment,$_POST["commitmentData"]);
			
			if ($commitment->isModified() && !$commitment->save()) {
				$smarty->assign("commitment",$commitment);
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			if (mb_strlen($_POST["commitmentData"]["commitment"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: edit','common');
			Common::doLog('success', substr($_POST["commitmentData"]["commitment"], 0, 120) . $logSufix);

			$smarty->assign("commitment",$commitment);
			return $mapping->findForwardConfig('success');

		}
		else {
			$commitment = new CampaignCommitment();
			$commitment = Common::setObjectFromParams($commitment,$_POST["commitmentData"]);
			
			if (!$commitment->save()) {
				$smarty->assign("commitment",$commitment);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}
	
			$smarty->assign("action","create");
			$smarty->assign("commitment",$commitment);
	
			if (mb_strlen($_POST["commitmentData"]["commitment"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["commitmentData"]["commitment"], 0, 120) . $logSufix);
	
			return $mapping->findForwardConfig('success');
		}
	}

}
