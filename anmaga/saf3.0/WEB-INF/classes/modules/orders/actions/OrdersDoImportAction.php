<?php

class OrdersDoImportAction extends BaseAction {

	function OrdersDoImportAction() {
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

		if (!empty($_SESSION["loginUser"])) {
			$affiliateId = $_POST["affiliateId"];
			$affiliate = AffiliatePeer::get($affiliateId);
			$user = $affiliate->getOwner();
		}
		else {
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
			$affiliate = AffiliatePeer::get($affiliateId);
			$user = $_SESSION["loginAffiliateUser"];
		}


		$affiliateName = $affiliate->getName();

		require_once("OrdersPlugin".ucwords($affiliateName).".php");

		$separator = OrdersImportPlugin::getSeparator();

		$loaded = 0;

		if (!empty($_FILES["csv"]))
			$orders = OrdersImportPlugin::getOrdersFromFile($_FILES["csv"]["tmp_name"]);

		$results = OrderPeer::createFromArray($orders,$user);

		$smarty->assign("results",$results);

		if (!empty($_SESSION["loginUser"])) {
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);
		}

		return $mapping->findForwardConfig('success');
	}

}
