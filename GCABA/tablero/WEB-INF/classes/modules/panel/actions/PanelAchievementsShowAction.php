<?php

class PanelAchievementsShowAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$section = "Projects";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET['positionId'])) {
			$position = PositionQuery::create()->findOneById($_GET['positionId']);
			$smarty->assign("position", $position);
			$projects = empty($_GET['color']) ?
				$position->getAllProjectsWithDescendants() : $position->getProjectsByStatusColor($_GET['color']);
		} elseif (!empty($_GET['objectiveId'])) {
			require_once 'BaseObjectiveQuery.php';
			$objective = BaseObjectiveQuery::create()->filterById($_GET['objectiveId'])->findOne();
			$smarty->assign("objective", $objective);
			$projects = empty($_GET['color']) ?
				$objective->getAllProjects() : $objective->getProjectsByStatusColor($_GET['color']);
		}

		$smarty->assign("projects", $projects);

		return $mapping->findForwardConfig('success');
	}

}
