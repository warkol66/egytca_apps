<?php

require_once("BaseAction.php");

class AffiliatesUsersLoginAction extends BaseAction {


	function AffiliatesUsersLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
    	/**
     	* Use a different template
     	*/
		$this->template->template = "TemplateLogin.tpl";
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";

		$message=$_GET["message"];
		$smarty->assign("message",$message);

		global $system;
		$unifiedLogin = $system["config"]["system"]["parameters"]["affiliateUserLoginUnified"]["value"];
		
		if ($unifiedLogin == "YES") {
			$smarty->assign("unifiedLogin",true);
		
			$cookieName = $system["config"]["system"]["parameters"]['siteName'] . 'LoginOption';
			if ($_COOKIE[$cookieName]) {
				$smarty->assign('cookieSelection',$_COOKIE[$cookieName]);
			}
		
			return $mapping->findForwardConfig('success-unified');
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
