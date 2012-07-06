<?php
/**
 * PlanningOperativeObjectivesUpdateTabsXAction
 *
 * Vista via AJAX de versiones de Proyectos (OperativeObjective)
 *
 * @package    planning
 * @subpackage    planningOperativeObjectives
 */
class PlanningOperativeObjectivesUpdateTabsXAction extends BaseAction {

		function PlanningOperativeObjectivesUpdateTabsXAction() {
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

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		$id = $request->getParameter("id");
		$operativeObjective = OperativeObjectiveQuery::create()->findOneByID($id);

		$operativeObjectiveVersionsPager = $operativeObjective->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, $_GET['page'], $maxPerPage);

		$smarty->assign("operativeObjective", $operativeObjective);
		$smarty->assign("operativeObjectiveVersionsPager", $operativeObjectiveVersionsPager);
		$smarty->assign("showLog", true);

		return $mapping->findForwardConfig('success');

	}

}
