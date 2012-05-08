<?php

require_once("BaseAction.php");
require_once("UserPeer.php");
require_once("AffiliateUserPeer.php");

class AffiliatesUsersValidationUsernameXAction extends BaseAction {

	function AffiliatesUsersValidationUsernameXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$module = "Affiliate";

		$name = 'affiliateUser[username]';
		
		$exist = 1;
		
		$affiliateUser = $_POST['affiliateUser'];
		$affiliateUsername = $affiliateUser['username'];
		
		if (Common::hasUnifiedUsernames()) {
			$usernameExists = UserPeer::getByUsername($affiliateUsername);
			$AffiliateUsernameExists = AffiliateUserPeer::getByUsername($affiliateUsername);
			if (empty($usernameExists) && empty($AffiliateUsernameExists)){
				$exist = 0;
			}
		}
		else {
			$AffiliateUsernameExists = AffiliateUserPeer::getByUsername($affiliateUsername);
			if (empty($AffiliateUsernameExists))
				$exist = 0;
		}

			
			$smarty->assign('name',$name);			
			$smarty->assign('value',$exist);
			$smarty->assign('message',$message);

		return $mapping->findForwardConfig('success');

	}

}
