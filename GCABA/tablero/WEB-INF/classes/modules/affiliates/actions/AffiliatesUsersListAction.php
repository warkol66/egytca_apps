<?php

require_once("BaseAction.php");
require_once("AffiliateUserPeer.php");
require_once("AffiliateUserInfo.php");
require_once("AffiliateGroupPeer.php");
require_once("AffiliateLevelPeer.php");
require_once("AffiliatePeer.php");
require_once("TimezonePeer.php");

class AffiliatesUsersListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AffiliatesUsersListAction() {
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

		$module = "Affiliates";
		$section = "";

		$timezonePeer = new TimezonePeer();
		$smarty->assign('timezones',$timezonePeer->getAll());

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$usersPeer = new AffiliateUserPeer();
		//Si esta logueado un usuario comun
		if (!empty($_SESSION["loginUser"])) {
			$affiliateId = $_GET["affiliateId"];
			if(!empty($affiliateId)) {
				if ($affiliateId == -1){
					$users = $usersPeer->getAll();
					$deletedUsers = $usersPeer->getDeleteds();
				}
				else{
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
			$users = $usersPeer->getAffiliate($affiliateId);
			$deletedUsers = $usersPeer->getDeletedsByAffiliate($affiliateId);
		}

		$smarty->assign("deletedUsers",$deletedUsers);

		$smarty->assign("affiliateId",$affiliateId);

		if ( !empty($_GET["user"]) ) {
			//voy a editar un usuario
			$action = "edit";
			try {
				$user = $usersPeer->get($_GET["user"]);
				//echo "usuario $user ...";

				$smarty->assign("currentAffiliateUser",$user);
				$smarty->assign("currentAffiliateUserInfo",$user->getAffiliateUserInfo());
				$groups = $usersPeer->getGroupsByUser($_GET["user"]);
				$smarty->assign("currentUserGroups",$groups);
				$groups = AffiliateGroupPeer::getAll();
				$smarty->assign("groups",$groups);
				$levels = AffiliateLevelPeer::getAll();
				$smarty->assign("levels",$levels);
				$smarty->assign("action",$action);
				$smarty->assign("accion","edicion");
				$smarty->assign("affiliateId",$user->getAffiliateId());
			}
			catch (PropelException $e) {
				$action = "create";
				$smarty->assign("action",$action);
				$smarty->assign("accion","creacion");
			}
		}
		else if ( isset($_GET["user"]) ) {
			//voy a crear un usuario nuevo

			$levels = AffiliateLevelPeer::getAll();
			$smarty->assign("levels",$levels);

			$smarty->assign("currentAffiliateUser",new AffiliateUser());
			$smarty->assign("currentAffiliateUserInfo",new AffiliateUserInfo());

			$action = "create";
			$smarty->assign("action",$action);

			$smarty->assign("accion","creacion");
		}

		$smarty->assign("users",$users);
		$smarty->assign("affId",$affiliateId);
		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("showList",true);

		return $mapping->findForwardConfig('success');
	}

}
