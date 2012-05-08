<?php
/**
 * PanelImportProjectsAction
 *
 */

class PanelImportProjectsAction extends BaseAction {

	function PanelImportProjectsAction() {
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

		$module = "Panel";
		
		// Preparo objetivos.
		$objectivePeer = new ObjectivePeer();
		$objectives = $objectivePeer->getAllFiltered();		
		$smarty->assign("objectives", $objectives);
		
		// Preparo positions.
		$version = PositionPeer::getLatestVersion();
		$types = ConfigModule::get("projects","positionsTypes");
		$positions = PositionPeer::getAllResponsiblesByPositionType($types,$version);
		$smarty->assign("positions", $positions);
		
		$smarty->assign("project", new Project);
				
		return $mapping->findForwardConfig('success');
	}

}
