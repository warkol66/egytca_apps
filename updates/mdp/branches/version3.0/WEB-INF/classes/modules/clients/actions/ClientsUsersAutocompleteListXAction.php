<?php

//Accion que devuelve el listado de usuarios para mostrar en el autocomplete

class ClientsUsersAutocompleteListXAction extends BaseAction {

	function ClientsUsersAutocompleteListXAction() {
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

		$module = "Clients";
		
		$smarty->assign("module",$module);
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$users = ClientUserQuery::create()->where('ClientUser.Username LIKE ?', "%" . $searchString . "%")
									->orWhere('ClientUser.Name LIKE ?', "%" . $searchString . "%")
									->orWhere('ClientUser.Surname LIKE ?', "%" . $searchString . "%")
									->where('ClientUser.Id NOT IN ?', $userParticipatingIds)
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("users",$users);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
