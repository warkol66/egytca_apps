<?php
/**
 * Edicion de usuarios
 *
 * @package users
 */
class UsersEditAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('User');
	}

	protected function postSelect() {
		parent::postSelect();

		//Timezones
		$timezonePeer = new TimezonePeer();
		$this->smarty->assign("timezones", $timezonePeer->getAll());

		$this->smarty->assign("groups", $this->entity->getGroupCandidates());

		$this->smarty->assign("levels",BaseQuery::create("Level")->find());

		$this->smarty->assign("currentUser", $this->entity);

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
