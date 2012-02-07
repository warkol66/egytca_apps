<?php

class UsersDoLoginAction extends BaseAction {

	function UsersDoLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

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
				$_SESSION["loginUser"] = $user;
				$smarty->assign("login_user",$user);
				return $mapping->findForwardConfig('success');
			}
		}

		$this->template->template = "template_login.tpl";
		
    $smarty->assign("message","wrongUser");
		return $mapping->findForwardConfig('failure');
	}

}
