<?php
/**
 * PlanningConstructionsUpdateTabsXAction
 *
 * Vista via AJAX de versiones de Proyectos (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningConstructions
 */
class PlanningConstructionsUpdateTabsXAction extends BaseAction {

		function PlanningConstructionsUpdateTabsXAction() {
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
		$planningConstruction = BaseQuery::create('PlanningConstruction')->findOneByID($id);

		$planningConstructionVersionsPager = $planningConstruction->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, $_GET['page'], $maxPerPage);

		$smarty->assign("planningConstruction", $planningConstruction);
		$smarty->assign("planningConstructionVersionsPager", $planningConstructionVersionsPager);
		$smarty->assign("showLog", true);

		$smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

		return $mapping->findForwardConfig('success');

	}

}
