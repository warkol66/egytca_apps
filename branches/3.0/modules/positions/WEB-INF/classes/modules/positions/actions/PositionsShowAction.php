<?php

class PositionsShowAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function PositionsShowAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Positions";
		$smarty->assign("module",$module);

		if (!empty($_GET["id"]))
			$position = PositionPeer::get($_GET["id"]);			
		else
			return $mapping->findForwardConfig('failure');

		if (!empty($_GET["objectives"])){
			$objectives = PositionPeer::getObjectives($_GET["id"]);			
			$smarty->assign("objectives",$objectives);

			$projects = PositionPeer::getProjects($_GET["id"]);			
			$smarty->assign("projects",$projects);
		}

		$smarty->assign("position",$position);
		return $mapping->findForwardConfig('success');
	}

}

