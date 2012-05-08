<?php
/**
 * ProjectsDoWeightByObjectiveAction
 *
 * Guarda la información de pesos relativos de los proyectos para un objetivo
 * @package projects
 */
require_once("BaseAction.php");
/**
 * Class ProjectsDoWeightByObjectiveAction
 *
 * Guarda la información de pesos relativos de los proyectos para un objetivo
 * @package projects
 */
class ProjectsDoWeightByObjectiveAction extends BaseAction {

	function ProjectsDoWeightByObjectiveAction() {
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
	
		$ok = true;
		$projects = $_POST['projects'];
		$totalWeight = 0;
		$numberOfDecimals = $system['config']['system']['parameters']['numberOfDecimals'];
		$decimalSeparator = $system['config']['system']['parameters']['decimalSeparator'];
		
		for($i = 0; $i < count($projects); $i++) {
			$projects[$i]['weight'] = Common::convertToMysqlNumericFormat($projects[$i]['weight']);	
			$projects[$i]['weight'] = abs($projects[$i]['weight']);
			$projects[$i]['weight'] = round($projects[$i]['weight'], $numberOfDecimals);
			$totalWeight += floatval($projects[$i]['weight']);
			//Convertimos de nuevo a punto porque el abs y round lo esta pasando a coma, no se entiende por qué, parece que es por el locale
			$projects[$i]['weight'] = Common::convertToMysqlNumericFormat($projects[$i]['weight']);
		}

		if ($totalWeight != 100) {
			$ok = false;
		} else {
			foreach($projects as $project) {
				if(!ProjectPeer::updateWeight($project['id'], $project['weight'])) {
					$ok = false;
				}
			}
		}
		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
