<?php

class PlanningIndicatorsSeriesEditAction extends BaseAction {

	function IndicatorsSeriesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Indicators";
		$smarty->assign("module",$module);

		$smarty->assign("indicatorsTypes",PlanningIndicator::getIndicatorTypes());

		if (!empty($_REQUEST["id"])) {
			$indicator = PlanningIndicatorQuery::create()->findPk($_REQUEST["id"]);
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","edit");
		}
		else {
			$indicator = new PlanningIndicator();
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
