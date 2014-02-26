<?php
/**
 * Edicion de usuarios
 *
 * @package users
 */
class UsersEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('User');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Users";
		$section = "Users";
		$this->smarty->assign("module",$module);
		$this->smarty->assign("section",$section);
		
		//Timezones
		require_once('TimezonePeer.php');
		$timezonePeer = new TimezonePeer();
		$this->smarty->assign("timezones",$timezonePeer->getAll());

		$this->smarty->assign("groups",$this->entity->getGroupCandidates());

		$this->smarty->assign("levels",BaseQuery::create("Level")->find());

		$this->smarty->assign("currentUser",$user);

		//Para obtener los grupos de usuario ordenados alfabeticamente
		//en el template usar $currentUser->getUserGroups($groupCriteria) 
		$groupCriteria = UserGroupQuery::create()
												->useGroupQuery()
													->orderByName()
												->endUse();		
		$this->smarty->assign("groupCriteria",$groupCriteria);
	
		$this->smarty->assign("documentTypes",User::getDocumentTypes());

	}

}
