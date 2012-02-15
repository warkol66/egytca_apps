<?php

class AffiliatesClientsViewXAction extends BaseAction {

	function AffiliatesClientsViewXAction() {
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

		$id = $request->getParameter("id");
    $affiliate = ClientQuery::create()->findOneById($id);
		$smarty->assign("affiliate",$affiliate);

		return $mapping->findForwardConfig('success');
	}

}
