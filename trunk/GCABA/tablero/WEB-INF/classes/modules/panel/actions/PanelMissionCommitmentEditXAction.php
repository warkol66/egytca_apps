<?php

class PanelMissionCommitmentEditXAction extends BaseAction {

	function PanelMissionCommitmentEditXAction() {
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
		$section = "Mission";

		$this->template->template = 'TemplateAjax.tpl';

		$commitment = MissionCommitmentPeer::get($_POST["id"]);
		$smarty->assign("commitment",$commitment);

		return $mapping->findForwardConfig('success');

	}

}
