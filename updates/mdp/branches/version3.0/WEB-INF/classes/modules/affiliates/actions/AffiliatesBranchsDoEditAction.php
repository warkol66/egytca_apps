<?php

class AffiliatesBranchsDoEditAction extends BaseAction {

	function AffiliatesBranchsDoEditAction() {
		;
	}

	function returnFailure($mapping,$smarty,$branch) {
		$smarty->assign("branch",$branch);

		$id = $branch->getId();
		if (empty($id))
			$smarty->assign("action","create");
		else
			$smarty->assign("action","edit");

		$smarty->assign("message","error");
		return $mapping->findForwardConfig('failure');
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

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$branchParams = $_POST["params"];

		if (!empty($_SESSION["loginUser"])) {
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);
			$smarty->assign("all",1);
			$affiliateId = $branchParams["affiliateId"];
		}
		else {
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
			$smarty->assign("all",0);
		}

		if (!empty($_POST["id"]))
			$branch = AffiliateBranchPeer::get($_POST["id"]);
		else
			$branch = new AffiliateBranch;

		Common::setObjectFromParams($branch, $branchParams);

		if ($branch->isModified() && !$branch->save()) {
			$smarty->assign("branch", $branch);
			return $this->returnFailure($mapping,$smarty,$branch);
		}

		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
	}
}