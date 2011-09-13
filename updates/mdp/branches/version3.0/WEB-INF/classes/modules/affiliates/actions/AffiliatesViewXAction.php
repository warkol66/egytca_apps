<?php

class AffiliatesViewXAction extends BaseAction {

	function AffiliatesViewXAction() {
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
		$section = "Users";
		
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$id = $_GET["id"];

		$affiliate = AffiliatePeer::get($id);
		$smarty->assign("affiliate",$affiliate);

		return $mapping->findForwardConfig('success');
	}

}
