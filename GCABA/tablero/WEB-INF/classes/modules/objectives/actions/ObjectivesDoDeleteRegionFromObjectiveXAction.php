<?php

class ObjectivesDoDeleteRegionFromObjectiveXAction extends BaseAction {

	function ObjectivesDoDeleteRegionFromObjectiveXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Objectives";

		//TODO VERIFICACION USUARIOS
		if ( !empty($_POST["objectiveId"]) && !(empty($_POST["regionId"])) ) {

			$objective = ObjectivePeer::get($_POST["objectiveId"]);
			$region = RegionPeer::get($_POST["regionId"]);

			if (!empty($objective) && !empty($region)) {
				ObjectiveRegionPeer::delete($_POST["objectiveId"],$_POST["regionId"]);
				$smarty->assign('region',$region);
			}
		}
		return $mapping->findForwardConfig('success');
	}

}
