<?php

//Accion que devuelve el listado de usuarios para mostrar en el autocomplete

require_once("UserPeer.php");
require_once("UserQuery.php");

class PositionsUsersListXAction extends BaseAction {

	function PositionsUsersListXAction() {
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

		$module = "Positions";
		$section = "Positions";
		
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_POST['value'];
		$smarty->assign("searchString",$searchString);

		$users = UserQuery::create()->where('User.Username LIKE ?', "%" . $searchString . "%")
									->orWhere('User.Name LIKE ?', "%" . $searchString . "%")
									->orWhere('User.Surname LIKE ?', "%" . $searchString . "%")
									->find();
		
		$smarty->assign("users",$users);

		return $mapping->findForwardConfig('success');
	}

}
