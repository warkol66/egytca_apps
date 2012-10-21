<?php

class PlanningIndicatorsYsDoEditAction extends BaseAction {

	function PlanningIndicatorsYsDoEditAction() {
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
		if ($_POST['disbursement']){
			$smarty->assign("disbursement",true);
			$smarty->assign("module","Projects");
			$forwardParams = array("id" => $_POST["indicatorId"], "disbursement" => 1);
		}
		else
			$forwardParams = array("id" => $_POST["indicatorId"]);

		if ( !empty($_POST["indicatorId"]) ) {
			$ysUpdated = $_POST["yValue"];
			$series = PlanningIndicatorSerieQuery::create()
						->filterByIndicatorid($_POST["indicatorId"])
						->find();
			$xs = PlanningIndicatorXQuery::create()
						->filterByIndicatorid($_POST["indicatorId"])
						->find();
			foreach ($series as $serie) {
				PlanningIndicatorYQuery::create()->filterBySerieid($serie->getId())->delete();
				foreach ($xs as $x) {
					$y=new PlanningIndicatorY();
                    $y->setSerieid($serie->getId());
                    $y->setXid($x->getId());
                    $y->setOldid($x->getId());
                    $y->setValue(Common::convertToMysqlNumericFormat($ysUpdated[$x->getId()][$serie->getId()]));
                    $y->save();
				}
			}		
		}

		$smarty->assign("message",$_GET["message"]);

		return $this->addParamsToForwards($forwardParams,$mapping,'success-edit');
	}

}
