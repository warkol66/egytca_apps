<?php

class PlanningImpactObjectivesUpdateTabsXAction extends BaseAction {

		function PlanningImpactObjectivesUpdateTabsXAction() {
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
		$impactObjective = ImpactObjectiveQuery::create()->findOneByID($id);

		$impactObjectiveVersionsPager = $impactObjective->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, $_GET['page'], $maxPerPage);

		$smarty->assign("impactObjective", $impactObjective);
		$smarty->assign("impactObjectiveVersionsPager", $impactObjectiveVersionsPager);
		$smarty->assign("showLog", true);

		return $mapping->findForwardConfig('success');

	}

}
