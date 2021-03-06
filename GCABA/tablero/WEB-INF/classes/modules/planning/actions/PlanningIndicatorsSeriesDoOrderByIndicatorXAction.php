<?php
/**
* IndicatorsSeriesDoOrderByIndicatorXAction
*
* Permite mediante Ajax el cambio de orden de los proyectos disponibles
*
* @package  indicators
*/

class PlanningIndicatorsSeriesDoOrderByIndicatorXAction extends BaseAction {

	function PlanningIndicatorsSeriesDoOrderByIndicatorXAction() {
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
		parse_str($_POST['data']);

		for ($i = 0; $i < count($seriesList); $i++) {
			if($seriesList[$i] != NULL) {
				$serie=PlanningIndicatorSerieQuery::create()->findPk($seriesList[$i]);
				$serie->setOrder($i);
				$serie->save();
				echo $serie->getId();
			}
		}
		return $mapping->findForwardConfig('success');

	}

}
