<?php

class CampaignsCommitmentEditXAction extends BaseAction {

	function CampaignsCommitmentEditXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$commitment = CampaignCommitmentPeer::get($_POST["id"]);
		$smarty->assign("commitment",$commitment);

		return $mapping->findForwardConfig('success');

	}

}
