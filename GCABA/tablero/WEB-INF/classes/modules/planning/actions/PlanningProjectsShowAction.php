<?php

class PlanningProjectsShowAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Planning";
		$section = "Projects";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET['positionId'])) {
			$filters = $_GET['filters'];
			$projectsQuery = BaseQuery::create('PlanningProject')->addFilters($filters);
			$position = PositionQuery::create()->findOneById($_GET['positionId']);
			$smarty->assign("position", $position);
			$projects = empty($_GET['color']) ?
				$position->getAllProjectsWithDescendants($projectsQuery) : $position->getProjectsByStatusColor($_GET['color'],$projectsQuery);
		} elseif (!empty($_GET['objectiveId'])) {
			require_once 'BaseObjectiveQuery.php';
			$objective = BaseObjectiveQuery::create()->filterById($_GET['objectiveId'])->findOne();
			$smarty->assign("objective", $objective);
			$projects = empty($_GET['color']) ?
				$objective->getAllProjects() : $objective->getProjectsByStatusColor($_GET['color']);
		}

		$smarty->assign("projects", $projects);

		$smarty->assign("planningTags", PlanningProjectTagQuery::create()->find());
		$smarty->assign("priorities", PlanningProject::getPriorities());
		$smarty->assign("filters", $filters);

		return $mapping->findForwardConfig('success');
	}

}
