<?php

class IndicatorsYsDoEditAction extends BaseAction {

	function IndicatorsYsDoEditAction() {
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

		$indicatorYPeer = new IndicatorYPeer();

		if ( !empty($_POST["indicatorId"]) ) {
			$ysUpdated = $_POST["yValue"];
			$series = IndicatorSerieQuery::create()
						->filterByIndicatorId($_POST["indicatorId"])
						->find();
			$xs = IndicatorXQuery::create()
						->filterByIndicatorId($_POST["indicatorId"])
						->find();
			foreach ($series as $serie) {
				$indicatorYPeer->deleteAllBySerie($serie->getId());
				foreach ($xs as $x) {
					$params = array();
					$params['xId'] = $x->getId();
					$params['serieId'] = $serie->getId();
					$params['value'] = Common::convertToMysqlNumericFormat($ysUpdated[$x->getId()][$serie->getId()]);	
					$indicatorYPeer->create($params);
				}
			}		
		}

		$smarty->assign("message",$_GET["message"]);

		return $this->addParamsToForwards($forwardParams,$mapping,'success');
	}

}
