<?php

class PanelMissionDoAddParticipantXAction extends BaseAction {

	function PanelMissionDoAddParticipantXAction() {
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

		$mission = MissionPeer::get($_REQUEST["missionId"]);
		$smarty->assign('mission',$mission);
		$smarty->assign('missionId',$missionId);
		
		$participantParam = $_REQUEST["participant"];
		
		$participant = new MissionParticipant();
		
		$participant->setMissionId($mission->getId());
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
