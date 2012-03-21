<?php

class OrdersConfirmAction extends BaseAction {

	function OrdersConfirmAction() {
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

		$module = "Orders";
		$smarty->assign("module",$module);
		
		if (Common::isSystemUser()) {
			$affiliateId = $_REQUEST["affiliateId"];
			require_once("AffiliatePeer.php");
			$affiliate = AffiliatePeer::get($affiliateId);
			$smarty->assign("affiliate",$affiliate);
		}
		else
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();

		if (empty($affiliateId))
			return $mapping->findForwardConfig('failure');
		
		$branchs = AffiliateBranchPeer::getAllByAffiliateId($affiliateId);
		$smarty->assign("branchs",$branchs);		

		$orderItems = $_SESSION["orderItems"];
		$smarty->assign("orderItems",$orderItems);

		return $mapping->findForwardConfig('success');
	}

}
