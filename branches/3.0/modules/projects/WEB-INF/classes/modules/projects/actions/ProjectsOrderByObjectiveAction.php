<?php
/**
 * ProjectsOrderByObjectiveAction
 *
 * Muestra un formulario para ordenar los proyectos para un objetivo
 * @package projects
 */
require_once("BaseAction.php");
/**
 * Class ProjectsOrderByObjectiveAction
 *
 * Muestra un formulario para guardar los pesos relativos de los banners en la zona
 * @package projects
 */
class ProjectsOrderByObjectiveAction extends BaseAction {

	function ProjectsOrderByObjectiveAction() {
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

		if ( isset($_GET['id']) ) {
			$objective =ObjectivePeer::get($_GET['id']);
			$smarty->assign("objective", $objective);

			$projects = ProjectPeer::getAllByObjectiveHydrated($_GET['id'],"order");
			$smarty->assign("projects", $projects);
			$ok = true;
		}
		else
			$ok = false;

		$smarty->assign("objectiveId", $_GET['id']);

		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
