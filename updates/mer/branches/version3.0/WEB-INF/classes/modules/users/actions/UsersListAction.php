<?php

class UsersListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function UsersListAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$userPeer = new UserPeer();
		$users = $userPeer->getAll();
		$smarty->assign("users",$users);
		$deletedUsers = $userPeer->getDeleteds();
		$smarty->assign("deletedUsers",$deletedUsers);

    $smarty->assign("message",$_GET["message"]);
    
    if ( !empty($_GET["user"]) ) {
			//voy a editar un usuario

			try {
				$user = $userPeer->get($_GET["user"]);
				$smarty->assign("currentUser",$user);
				$groups = $userPeer->getGroupsByUser($_GET["user"]);
				$smarty->assign("currentUserGroups",$groups);
				$groupPeer = new GroupPeer();
				$groups = $groupPeer->getAll();
				$smarty->assign("groups",$groups);
				$levels = LevelPeer::getAll();
				$smarty->assign("levels",$levels);
	    	$smarty->assign("accion","edicion");
	  	}
			catch (PropelException $e) {
      	$smarty->assign("accion","creacion");
			}
		}
		else if ( isset($_GET["user"]) ) {
			//voy a crear un usuario nuevo
			
			$levels = LevelPeer::getAll();
			$smarty->assign("levels",$levels);

			$smarty->assign("accion","creacion");
		}
		
		$activeUsersCount = count($users);
		global $licenses;
		$licensesLeft = $licenses - $activeUsersCount;
		$smarty->assign("licensesLeft",$licensesLeft);

		return $mapping->findForwardConfig('success');
	}

}
?>
