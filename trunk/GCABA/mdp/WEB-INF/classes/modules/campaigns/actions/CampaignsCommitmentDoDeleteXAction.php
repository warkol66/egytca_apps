<?php

class CampaignsCommitmentDoDeleteXAction extends BaseAction {

	function CampaignsCommitmentDoDeleteXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "campaign";
		
		$id = $_POST["id"];
		$smarty->assign("id", $id);
		if ($_POST["doHardDelete"])
			$deleted = CampaignCommitmentPeer::hardDelete($id);
		else
			$deleted = CampaignCommitmentPeer::delete($id);

		$smarty->assign("message", "deletesuccess");
		return $mapping->findForwardConfig("success");
	}

}
