<?php
/**
 * ProjectsWeightByObjectiveAction
 *
 * Muestra un formulario para guardar los pesos relativos de lso proyectos para un objetivo
 * @package projects
 */
require_once("BaseAction.php");
/**
 * Class ProjectsWeightByObjectiveAction
 *
 * Muestra un formulario para guardar los pesos relativos de lso proyectos para un objetivo
 * @package projects
 */
class ProjectsWeightByObjectiveAction extends BaseAction {

	function ProjectsWeightByObjectiveAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		$module = "Projects";
		$smarty->assign("module",$module);
		$section = "Objectives";
		$smarty->assign("section",$section);
		global $system;
		$decimalSeparator = $system['config']['system']['parameters']['decimalSeparator'];
		$numberOfDecimals = $system['config']['system']['parameters']['numberOfDecimals'];
		$smarty->assign("decimalSeparator", $decimalSeparator);
		$smarty->assign("numberOfDecimals", $numberOfDecimals);
		
		if ( isset($_GET['id']) ) {
			$objective = ObjectivePeer::get($_GET['id']);
			$smarty->assign("objective", $objective);

			$projects = ProjectPeer::getAllByObjectiveHydrated($_GET['id'],"weight");
			$smarty->assign("projects", $projects);
			$ok = true;
		}
		else
			$ok = false;

		$smarty->assign("objectiveId", $_GET['id']);
		$totalWeight = 0;
		foreach($projects as $project) {
			$totalWeight += $project->getWeight();
		}
		$smarty->assign("totalWeight", $totalWeight);
		
		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
