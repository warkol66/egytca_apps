<?php

class OrdersListAction extends BaseAction {

	function OrdersListAction() {
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

		$orderPeer = new OrderPeer();

		$url = "Main.php?do=ordersList";

		if (empty($_SESSION["loginUser"])) {
			$orderPeer->setSearchAffiliateId($_SESSION["loginAffiliateUser"]->getAffiliateId());
			$smarty->assign("all",0);
		}
		else {
			if (!empty($_GET["affiliateId"])) {
				$orderPeer->setSearchAffiliateId($_GET["affiliateId"]);
				$url .= "&affiliateId=".$_GET['affiliateId'];
				$smarty->assign("selectedAffiliateId",$_GET["affiliateId"]);
			}
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);
			$smarty->assign("all",1);
		}

		if (!empty($_GET["dateFrom"])) {
			$orderPeer->setSearchDateFrom(Common::usDateToDbDate($_GET["dateFrom"]));
			$url .= "&dateFrom=".$_GET['dateFrom'];
			$smarty->assign("selectedDateFrom",$_GET["dateFrom"]);
		}

		if (!empty($_GET["state"]) || $_GET["state"] == "0") {
			$orderPeer->setSearchState($_GET["state"]);
			$url .= "&state=".$_GET['state'];
			$smarty->assign("selectedState",$_GET["state"]);
		}

		if (!empty($_GET["dateTo"])) {
			$orderPeer->setSearchDateTo(Common::usDateToDbDate($_GET["dateTo"]));
			$url .= "&dateTo=".$_GET['dateTo'];
			$smarty->assign("selectedDateTo",$_GET["dateTo"]);
		}

		global $system;
		$daysByDefault = $system['config']['orders']['daysByDefault'];

		if (empty($_GET["dateFrom"]) && empty($_GET["dateTo"]) && empty($_GET["state"]) && $daysByDefault != 0) {
			$dateFrom = date("d-m-Y", (time() - (24 * 60 * 60 * $daysByDefault)));
			$orderPeer->setSearchDateFrom(Common::usDateToDbDate($dateFrom));
			$url .= "&dateFrom=".$dateFrom;
			$smarty->assign("selectedDateFrom",$dateFrom);
		}

		$pager = $orderPeer->getSearchPaginated($_GET["page"]);

		$smarty->assign("orders",$pager->getResult());
		$smarty->assign("pager",$pager);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
