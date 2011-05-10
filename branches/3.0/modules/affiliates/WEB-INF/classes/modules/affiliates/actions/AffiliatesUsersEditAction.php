<?php

class AffiliatesUsersEditAction extends BaseAction {

	function AffiliatesUsersEditAction() {
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

		$module = "Affiliates";
		$section = "Users";

  	$smarty->assign("module",$module);
  	$smarty->assign("section",$section);

		$usersPeer = new AffiliateUserPeer();

		//Si esta logueado un usuario de sistema
		if (!empty($_SESSION["loginUser"])) {
			$affiliateId = $_GET["affiliateId"];
			if (!empty($affiliateId)) {
				if ($affiliateId == -1) {
					$users = $usersPeer->getAll();
					$deletedUsers = $usersPeer->getDeleteds();
				}
				else {
					$users = $usersPeer->getAffiliate($affiliateId);
					$deletedUsers = $usersPeer->getDeletedsByAffiliate($affiliateId);
				}
			}
			else {
				$users = $usersPeer->getAll();
				$deletedUsers = $usersPeer->getDeleteds();
			}
			$affiliates = AffiliatePeer::getAll();
			$smarty->assign("affiliates",$affiliates);
		}
		else {
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
/*			$users = $usersPeer->getAffiliate($affiliateId);
			$deletedUsers = $usersPeer->getDeletedsByAffiliate($affiliateId);*/
		}

		$smarty->assign("affiliateId",$affiliateId);

  	if (!empty($_GET["id"])) {

			$user = $usersPeer->get($_GET["id"]);

			$groups = $usersPeer->getGroupsByUser($_GET["id"]);
			$smarty->assign("currentUserGroups",$groups);

    	$smarty->assign("action","edit");
		}
		else {
      $user = new AffiliateUser;
			$smarty->assign("action","create");
		}
    
    $smarty->assign("currentAffiliateUser", $user);
    
    $levels = AffiliateLevelPeer::getAll();
    $smarty->assign("levels",$levels);
    
    $groups = $user->getNotAssignedGroups();
    $smarty->assign("groups",$groups);
		
		$smarty->assign('ownerCreation', $_GET["ownerCreation"]);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
