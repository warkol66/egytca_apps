<?php

require_once("BaseAction.php");
require_once("mer/UserPeer.php");

class UsersDoLoginAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function UsersDoLoginAction() {
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

		if ( !empty($_POST["username"]) && !empty($_POST["password"]) ) {
			$user = UserPeer::auth($_POST["username"],$_POST["password"]);
			if ( !empty($user) ) {
				$_SESSION["login_user"] = $user;
				$smarty->assign("login_user",$user);
				return $mapping->findForwardConfig('success');
			}
		}

		$this->template->template = "template_login.tpl";
		
    $smarty->assign("message","wrongUser");
		return $mapping->findForwardConfig('failure');
	}

}
?>
