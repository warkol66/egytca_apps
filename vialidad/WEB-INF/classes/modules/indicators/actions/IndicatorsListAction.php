<?php

class IndicatorsListAction extends BaseAction {

	function IndicatorsListAction() {
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

		$module = "Vialidad";
		$smarty->assign("module",$module);



		$url = "Main.php?do=indicatorsList&contractId=".$_REQUEST["contractId"];

        $filters = $_GET["filters"];

        $pager = IndicatorQuery::create()->filterByContractid($_REQUEST["contractId"])->createPager($filters, $_GET["page"], $filters["perPage"]);

        $contract=ContractQuery::create()->findPk($_REQUEST["contractId"]);
        $smarty->assign("contract",$contract);

        $indicators=$pager->getResults();
        $smarty->assign("indicators",$indicators);

		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
        $smarty->assign("filters", $filters);
        $smarty->assign("contracts",$pager->getResults());
        $smarty->assign("pager",$pager);

		return $mapping->findForwardConfig('success');
	}

}


