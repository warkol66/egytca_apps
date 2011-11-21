<?php

class VialidadCertificatesGetTotalPriceXAction extends BaseAction {

	function VialidadCertificatesGetTotalPriceXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Certificates";
		$smarty->assign("section",$section);

		if (!empty($_POST['id']))
			$certificate = CertificateQuery::create()->findPk($_POST["id"]);

		$smarty->assign("totalPrice",$certificate->calculatePrice());
		return $mapping->findForwardConfig('success');
	}
}