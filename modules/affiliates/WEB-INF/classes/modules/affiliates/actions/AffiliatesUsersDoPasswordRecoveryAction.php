<?php
/** 
 * AffiliatesUsersDoPasswordRecoveryAction
 *
 * @package affiliates 
 */

class AffiliatesUsersDoPasswordRecoveryAction extends BaseAction {

	function AffiliatesUsersDoPasswordRecoveryAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
    
		$this->template->template = "TemplateMail.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";

		if ( !empty($_POST["username"]) && !empty($_POST["mailAddress"]) ) {
			$userAndPassword = AffiliateUserPeer::generatePassword($_POST["username"],$_POST["mailAddress"]);
			if ( !empty($userAndPassword) ) {
        $smarty->assign("user",$userAndPassword[0]);
        $smarty->assign("password",$userAndPassword[1]);
        $body = $smarty->fetch("AffiliatePasswordRecoveryMail.tpl");

				require_once("libmail.inc.php");

				global $system;

				$m = new Mail();
				$m->From($system["config"]["system"]["parameters"]["fromEmail"]);
				$m->To($user->getMailAddress());
				$m->Subject("Nueva Contrase�a");
				$m->Body($body);
				$m->Send();
				
				Common::doLog('success','username: ' . $_POST["username"] . ' Mail Address: ' . $_POST["mailAddress"]);
				return $mapping->findForwardConfig('success');
			}
		}
		
		$this->template->template = "TemplateLogin.tpl";		

    	$smarty->assign("message","wrongUser");
		Common::doLog('failure','username: ' . $_POST["username"] . ' Mail Address: ' . $_POST["mailAddress"]);
		return $mapping->findForwardConfig('failure');
	}

}
