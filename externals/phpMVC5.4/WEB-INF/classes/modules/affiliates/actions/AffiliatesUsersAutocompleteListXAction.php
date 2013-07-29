<?php

//Accion que devuelve el listado de usuarios para mostrar en el autocomplete

class AffiliatesUsersAutocompleteListXAction extends BaseAction {

	function AffiliatesUsersAutocompleteListXAction() {
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

		$module = "Affiliates";
		
		$smarty->assign("module",$module);
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$users = AffiliateUserQuery::create()->where('AffiliateUser.Username LIKE ?', "%" . $searchString . "%")
									->orWhere('AffiliateUser.Name LIKE ?', "%" . $searchString . "%")
									->orWhere('AffiliateUser.Surname LIKE ?', "%" . $searchString . "%")
									->where('AffiliateUser.Id NOT IN ?', $userParticipatingIds)
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("users",$users);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
