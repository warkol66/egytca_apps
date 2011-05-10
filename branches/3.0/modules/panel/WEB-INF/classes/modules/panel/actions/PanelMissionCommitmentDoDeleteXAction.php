<?php

class PanelMissionCommitmentDoDeleteXAction extends BaseAction {

	function PanelMissionCommitmentDoDeleteXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "panel";
		
		$this->template->template = 'TemplateAjax.tpl';

		$id = $_POST["id"];
		$smarty->assign("id", $id);
		if ($_POST["doHardDelete"])
			$deleted = MissionCommitmentPeer::hardDelete($id);
		else
			$deleted = MissionCommitmentPeer::delete($id);

		$smarty->assign("message", "deletesuccess");
		return $mapping->findForwardConfig("success");
	}

}
