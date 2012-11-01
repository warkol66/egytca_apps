<?php

class RegistrationListAction extends BaseAction {

	function RegistrationListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";
		$smarty->assign('module',$module);

		//verifico si es un usuario administrativo
		//TODO tal vez haya que hacer algo con permisos
		if (isset($_SESSION['login_user'])) {

			$usersByRegistrationPeer = new RegistrationUserPeer();

			$pager = $usersByRegistrationPeer->getAllPaginated($_GET["page"]);
			$smarty->assign("users",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=registrationList";

			if (isset($_GET['page']))
				$url .= '&page=' . $_GET['page'];

			//aplicacion de filtro a url
			foreach ($_GET['filters'] as $key => $value)
				$url .= "&filters[$key]=$value";

			$smarty->assign("url",$url);

			if (isset($_GET['message'])) {
				$smarty->assign("message",$_GET['message']);
			}
			return $mapping->findForwardConfig('success');

		}
		//no es un usuario autenticado
		return $mapping->findForwardConfig('failure');

	}

}
