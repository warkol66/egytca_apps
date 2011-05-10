<?php

class AffiliatesBranchsDoEditAction extends BaseAction {

	function AffiliatesBranchsDoEditAction() {
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
		
		$params = $_POST["params"];

		if (!empty($_SESSION["loginUser"])) {
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);
			$smarty->assign("all",1);
			$affiliateId = $params["affiliateId"];
		}
		else {
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
			$smarty->assign("all",0);
		}

		if ( !empty($_POST["id"]) ) {
			$branch = AffiliateBranchPeer::get($_POST["id"]);
		} else {
			$branch = new AffiliateBranch;
		}
		Common::setObjectFromParams($branch, $params);
		if (!$branch->save()) {
			$smarty->assign("branch", $branch);
			return $mapping->findForwardConfig('failure');
		}
		return $mapping->findForwardConfig('success');
	}
}