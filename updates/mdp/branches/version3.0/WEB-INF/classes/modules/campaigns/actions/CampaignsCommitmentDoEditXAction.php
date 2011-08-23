<?php

class CampaignsCommitmentDoEditXAction extends BaseAction {

	function CampaignsCommitmentDoEditXAction() {
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

		$module = "Campaign";
		$section = "Campaign";

		if ($_POST["commitmentId"]) {
			$commitment = CampaignCommitmentPeer::get($_POST["commitmentId"]);
			$commitment = Common::setObjectFromParams($commitment,$_POST["commitmentData"]);
			
			if (!$commitment->save()) {
				$smarty->assign("commitment",$commitment);
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			$logSufix = ', ' . Common::getTranslation('action: edit','common');
			Common::doLog('success', substr($_POST["commitmentData"]["commitment"], 0, 60) . $logSufix);

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
	
			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["commitmentData"]["commitment"], 0, 60) . $logSufix);
	
			return $mapping->findForwardConfig('success');
		}
	}

}
