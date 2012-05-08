<?php

class PanelAdministrativeActsDoAddParticipantXAction extends BaseAction {

	function PanelAdministrativeActsDoAddParticipantXAction() {
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

		$administrativeAct = AdministrativeActPeer::get($_REQUEST["administrativeActId"]);
		$smarty->assign('administrativeAct',$administrativeAct);
		
		$participantParam = $_REQUEST["participant"];
		
		$participant = new AdminActParticipant();
		
		$participant->setAdminActId($administrativeAct->getId());
		$participant->setObjectType($participantParam["type"]);
		if ($participantParam["type"] == "User" && is_object(UserPeer::get($participantParam["userId"])))
			$participant->setObjectId($participantParam["userId"]);
		if ($participantParam["type"] == "Actor" && is_object(ActorPeer::get($participantParam["actorId"])))
			$participant->setObjectId($participantParam["actorId"]);

		if ($participant->getObjectId()	> 0){
			try {
				$participant->save();
				return $mapping->findForwardConfig('success');
			}
			catch (PropelException $exp) {
			}

			$smarty->assign('error','error');
			return $mapping->findForwardConfig('failure');
		}

	}

}
