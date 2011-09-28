<?php

class UsersEditInfoAction extends BaseAction {

	function UsersEditInfoAction() {
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

		$module = "Users";
		$section = "Users";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		//timezone
		require_once('TimezonePeer.php');
		$timezonePeer = new TimezonePeer();
		$timezones = $timezonePeer->getAll();
		
		$smarty->assign("timezones",$timezones);

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET["id"])) {
			//voy a editar un usuario

			try {
				$user = UserPeer::get($_GET["id"]);
			}
			catch (PropelException $e) {
				$smarty->assign("action","create");
			}
		}
		else {
			//return $mapping->findForwardConfig('failure');
		}

		$smarty->assign("currentUser",$user);
		$smarty->assign("editInfo",true);

		$documentTypes = UserPeer::getDocumentTypes();
		$smarty->assign("documentTypes",$documentTypes);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		return $mapping->findForwardConfig('success');

	}

}