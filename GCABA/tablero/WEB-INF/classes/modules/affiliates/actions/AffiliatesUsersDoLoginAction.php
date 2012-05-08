<?php

require_once("BaseAction.php");
require_once("AffiliateUserPeer.php");

class AffiliatesUsersDoLoginAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AffiliatesUsersDoLoginAction() {
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

		if (Common::hasUnifiedLogin()) {
			$smarty->assign("unifiedLogin",true);
			Common::setValueUnifiedLoginCookie($_POST['select']);			
		}

		if ( !empty($_POST["username"]) && !empty($_POST["password"]) ) {;
			$user = AffiliateUserPeer::auth($_POST["username"],$_POST["password"]);
			if ( !empty($user) ) {
				$_SESSION["loginAffiliateUser"] = $user;
				$smarty->assign("loginAffiliateUser",$user);
				Common::doLog('success','username: ' . $username);
				return $mapping->findForwardConfig('success');
			}

		}

		$this->template->template = "TemplateLogin.tpl";
		
		$smarty->assign("message","wrongUser");


		if (Common::hasUnifiedLogin()) {

			//si hay unificado, obligamos a la opcion que se intento loguear
			$smarty->assign('cookieSelection','dependency');
			return $mapping->findForwardConfig('failure-unified');
		}
		
		return $mapping->findForwardConfig('failure');
	}

}
?>
