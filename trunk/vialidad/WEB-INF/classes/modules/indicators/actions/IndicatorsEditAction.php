<?php

class IndicatorsEditAction extends BaseAction {

	function IndicatorsEditAction() {
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

		$module = "Indicators";
		$smarty->assign("module",$module);

        $filters = $_GET["filters"];
        $smarty->assign("filters", $filters);
        $page = $_GET["page"];
        $smarty->assign("page", $page);


		if ( !empty($_GET["id"]) ) {
			$indicator = IndicatorQuery::create()->findPk($_GET["id"]);
			if (!is_null($indicator)) {
				$smarty->assign("indicator",$indicator);
				$smarty->assign("action","edit");
                    $contract=$indicator->getContract();
			}
			else
				$smarty->assign("notValidId",true);			
		}
		else {
			//voy a crear un indicator nuevo
			$indicator = new Indicator();
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","create");
            $contract=ContractQuery::create()->findPk($_REQUEST["contractId"]);
		}


        $smarty->assign("contract",$contract);


		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
