<?php

class AffiliatesBranchsDoDeleteAction extends BaseAction {

	function AffiliatesBranchsDoDeleteAction() {
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

		$module = "Affiliates";
		$section = "Branchs";

		AffiliateBranchPeer::delete($_POST["id"]);

		return $mapping->findForwardConfig('success');

	}

}
