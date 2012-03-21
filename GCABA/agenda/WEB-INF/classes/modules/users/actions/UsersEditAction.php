<?php

class UsersEditAction extends BaseAction {

	function UsersEditAction() {
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
				$smarty->assign("action","edit");
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
					$smarty->assign("action","create");
			}

			$groups = UserPeer::getGroupCandidates($_GET["id"]);
			$smarty->assign("groups",$groups);

			$levels = LevelPeer::getAll();
			$smarty->assign("levels",$levels);

			//Para obtener los grupos de usuario ordenados alfabeticamente
			//en el template usar $currentUser->getUserGroups($groupCriteria) 
			$groupCriteria = UserGroupQuery::create()
													->useGroupQuery()
														->orderByName()
													->endUse();		
			$smarty->assign("groupCriteria",$groupCriteria);
		}
		else {
			//voy a crear un usuario nuevo
			$user = new User();

			$levels = LevelPeer::getAll();
			$smarty->assign("levels",$levels);

			$groups = GroupPeer::getAll();
			$smarty->assign("groups",$groups);

			$smarty->assign("action","create");
		}

		$smarty->assign("currentUser",$user);

		$documentTypes = UserPeer::getDocumentTypes();
		$smarty->assign("documentTypes",$documentTypes);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);

		return $mapping->findForwardConfig('success');

	}

}
