<?php

//Accion que devuelve el listado de usuarios para mostrar en el autocomplete

class UsersAutocompleteListXAction extends BaseAction {

	function UsersAutocompleteListXAction() {
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

		$module = "Users";
		
		$smarty->assign("module",$module);
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		if (!empty($_REQUEST['adminActId'])) {
			$userParticipatingIds = AdminActParticipantQuery::create()
									->filterByAdminActId($_REQUEST['adminActId'])
									->filterByObjectType('User')
									->select('Objectid')
									->find();
		}
		
		$users = UserQuery::create()->where('User.Username LIKE ?', "%" . $searchString . "%")
									->orWhere('User.Name LIKE ?', "%" . $searchString . "%")
									->orWhere('User.Surname LIKE ?', "%" . $searchString . "%")
									->where('User.Id NOT IN ?', $userParticipatingIds)
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("users",$users);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
