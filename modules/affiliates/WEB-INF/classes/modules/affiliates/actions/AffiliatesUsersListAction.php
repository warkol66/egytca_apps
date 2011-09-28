<?php

class AffiliatesUsersListAction extends BaseAction {

	function AffiliatesUsersListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

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
		$filters = $_GET['filters'];
		$this->applyFilters($usersPeer, $filters, $smarty);

		if (!empty($_GET["page"])) {
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}

		//Si esta logueado un usuario de sistema
		if (!empty($_SESSION["loginUser"])) {
			if (!empty($_GET['filters']["searchAffiliateId"])) {
				if ($_GET['filters']["searchAffiliateId"] > 0)
					$deletedUsers = $usersPeer->getDeletedsByAffiliate($_GET['filters']["searchAffiliateId"]);
			}
			else
				$deletedUsers = $usersPeer->getDeleteds();

			$affiliatePeer = new AffiliatePeer();
			$affiliates = $affiliatePeer->getAll();
			$smarty->assign("affiliates",$affiliates);
		}
		else if (!empty($_SESSION["loginAffiliateUser"])) {
			$affiliateId = $_SESSION["loginAffiliateUser"]->getAffiliateId();
			$deletedUsers = $usersPeer->getDeletedsByAffiliate($affiliateId);
		}
		else
			return $mapping->findForwardConfig('failure');

		$pager = $usersPeer->getAllPaginatedFiltered($page);
		$smarty->assign("deletedUsers",$deletedUsers);

		$smarty->assign("affiliateId",$affiliateId);

		$url = "Main.php?do=affiliatesUsersList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("users", $pager->getResult());
		$smarty->assign("pager", $pager);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
