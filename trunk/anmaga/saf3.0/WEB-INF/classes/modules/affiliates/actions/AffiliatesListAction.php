<?php

class AffiliatesListAction extends BaseAction {

	function AffiliatesListAction() {
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
  	$smarty->assign("module",$module);

  	$smarty->assign("message",$_GET["message"]);
		
		$affiliatePeer = new AffiliatePeer;
		$filters = $_GET["filters"];
		
		$this->applyFilters($affiliatePeer, $filters, $smarty);

		$pager = $affiliatePeer->getSearchPaginated($_GET["page"]);
		
		$url = "Main.php?do=affiliatesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("affiliates",$pager->getResult());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}
