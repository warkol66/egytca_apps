<?php
/**
 * PlanningProjectsUpdateTabsXAction
 *
 * Vista via AJAX de versiones de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */
class PlanningProjectsUpdateTabsXAction extends BaseAction {

		function PlanningProjectsUpdateTabsXAction() {
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
		$planningProject = BaseQuery::create('PlanningProject')->findOneByID($id);

		$planningProjectVersionsPager = $planningProject->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, $_GET['page'], $maxPerPage);

		$smarty->assign("planningProject", $planningProject);
		$smarty->assign("planningProjectVersionsPager", $planningProjectVersionsPager);
		$smarty->assign("showLog", true);

		$smarty->assign("startingYear", Common::getStartingYear());
		$smarty->assign("endingYear", Common::getEndingYear());

		return $mapping->findForwardConfig('success');

	}

}
