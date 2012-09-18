<?php

class AffiliatesClientsEditAction extends BaseAction {

	function AffiliatesClientsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Affiliates";
		$smarty->assign("module",$module);
		$section = "Clients";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$id = $request->getParameter("id");

		if (!empty($id)) {
	    $affiliate = ClientQuery::create()->findOneById($id);
			if (empty($affiliate))
				$smarty->assign("notValidId","true");
		}
		else
			$affiliate = new Client();

		$smarty->assign("affiliate",$affiliate);
		return $mapping->findForwardConfig('success');
	}
}