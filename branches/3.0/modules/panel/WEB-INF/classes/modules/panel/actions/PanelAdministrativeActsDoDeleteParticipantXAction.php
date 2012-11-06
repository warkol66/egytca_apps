<?php

class PanelAdministrativeActsDoDeleteParticipantXAction extends BaseAction {

	function PanelAdministrativeActsDoDeleteParticipantXAction() {
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

		$module = "Projects";

		if (AdminActParticipantPeer::delete($_REQUEST["partyId"])) {

			$smarty->assign('id',$_REQUEST["partyId"]);
			
			return $mapping->findForwardConfig('success');
		} else {
			echo "ERROR";die;
		}
	}

}