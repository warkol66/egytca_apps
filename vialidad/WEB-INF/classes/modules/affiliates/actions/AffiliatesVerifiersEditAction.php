<?php

class AffiliatesVerifiersEditAction extends BaseAction {

	function AffiliatesVerifiersEditAction() {
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

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		if ($_GET['id']) {
			$affiliate =  VerifierQuery::create()->findPk($_GET['id']);
			if (empty($affiliate)) {
				$smarty->assign("notValidId","true");
				$affiliate = new Verifier();
			}
			else
				$smarty->assign("action","edit");
		}
		else {
			$affiliate = new Verifier();
			$smarty->assign("action","create");
		}
		$smarty->assign("affiliate",$affiliate);
		return $mapping->findForwardConfig('success');
	}
}