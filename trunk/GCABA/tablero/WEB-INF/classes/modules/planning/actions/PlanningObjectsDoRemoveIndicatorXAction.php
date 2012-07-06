<?php
/**
 * PlanningObjectsDoRemoveIndicatorXAction
 *
 * Elimina relaciones entre indicadores y objetos de planeamiento (PlanningIndicatorRelation)
 *
 * @package    planning
 * @subpackage    planningIndicatorRelations
 */
class PlanningObjectsDoRemoveIndicatorXAction extends BaseAction {

	function PlanningObjectsDoRemoveIndicatorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Planning";
		$smarty->assign("module",$module);

		$planningObjectType = $request->getParameter('planningObjectType');
		$planningObjectId = $request->getParameter('planningObjectId');

		$indicatorId = $request->getParameter('indicatorId');

		if (!empty($planningObjectType) && !empty($planningObjectId) && !empty($indicatorId)) {

			$object = BaseQuery::create($planningObjectType)->findOneById($planningObjectId);
			$indicator = PlanningIndicatorQuery::create()->findOneById($indicatorId);
			if ($object && $indicator) {
				if (PlanningIndicatorRelationQuery::create()->filterByPlanningobjecttype($planningObjectType)
																										->filterByPlanningobjectid($planningObjectId)
																										->filterByPlanningindicator($indicator)
																										->delete()) {
					$smarty->assign('object', $object);
					$smarty->assign('indicator', $indicator);
					return $mapping->findForwardConfig('success');
				}
				return $mapping->findForwardConfig('error');
			}
			else {
				return $mapping->findForwardConfig('error');
			}
			return $mapping->findForwardConfig('error');
		}
		else {
			return $mapping->findForwardConfig('error');
		}
	}

}
