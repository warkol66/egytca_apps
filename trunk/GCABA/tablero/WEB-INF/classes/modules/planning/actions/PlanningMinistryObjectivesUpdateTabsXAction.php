<?php

class PlanningMinistryObjectivesUpdateTabsXAction extends BaseAction {

		function PlanningMinistryObjectivesUpdateTabsXAction() {
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
		$ministryObjective = MinistryObjectiveQuery::create()->findOneByID($id);

		$ministryObjectiveVersionsPager = $ministryObjective->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, $_GET['page'], $maxPerPage);

		$smarty->assign("ministryObjective", $ministryObjective);
		$smarty->assign("ministryObjectiveVersionsPager", $ministryObjectiveVersionsPager);
		$smarty->assign("showLog", true);

		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());

		return $mapping->findForwardConfig('success');

	}

}
