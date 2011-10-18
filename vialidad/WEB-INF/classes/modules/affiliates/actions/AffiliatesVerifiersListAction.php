<?php

class AffiliatesVerifiersListAction extends BaseAction {

	function AffiliatesVerifiersListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
  	$smarty->assign("module",$module);

  	$smarty->assign("message",$_GET["message"]);
		
		$affiliatePeer = new AffiliatePeer;
		$filters = $_GET["filters"];
		$this->applyFilters($affiliatePeer, $filters, $smarty);

		$pager = $affiliatePeer->getAllPaginatedFiltered($_GET["page"]);
		
		$url = "Main.php?do=affiliatesVerifiersList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("affiliates",$pager->getResult());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
