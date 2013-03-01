<?php

class PlanningIndicatorsViewAction extends BaseAction {

	function PlanningIndicatorsViewAction() {

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

		if (!empty($_GET["id"])) {
			$indicator = PlanningIndicatorQuery::create()->findPk($_GET["id"]);
			if (!empty($indicator))
				$smarty->assign("indicator",$indicator);
			else
				$smarty->assign("notValidId",true);
		}
		
		if(isset($_POST['lightbox']))
			$smarty->assign("lightbox",true);

		$smarty->assign("fromEdit",$_GET["fromEdit"]);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


