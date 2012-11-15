<?php

class PlanningIndicatorsSeriesDoEditAction extends BaseAction {

	function PlanningIndicatorsSeriesDoEditAction() {
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

		$indicator = new PlanningIndicatorSerie();

		if ( !empty($_POST["indicatorId"]) ) {
			$seriesUpdated = $_POST["serieLabel"];
			foreach($seriesUpdated['id'] as $i => $serieUpdated) {
				if (!empty($seriesUpdated['name'][$i])) {
					$params = array();
					$params['Name'] = $seriesUpdated['name'][$i];

					if ($seriesUpdated['id'][$i] <= "0") {
						//para que el nuevo elemento quede al final de todo.
						$params['Indicatorid'] = $_POST["indicatorId"];
						$params['order'] = $i+1;
						PlanningIndicatorSeriePeer::create($params);
					}
					else
						PlanningIndicatorSerieQuery::create()->filterById($seriesUpdated['id'][$i])->update($params);
				}

			}
		}

		$smarty->assign("message",$_GET["message"]);
		return $this->addParamsToForwards(array("id"=>$_POST["indicatorId"]),$mapping,'success-edit');
	}

}
