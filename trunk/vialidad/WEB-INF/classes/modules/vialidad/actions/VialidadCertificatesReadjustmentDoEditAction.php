<?php

class VialidadCertificatesReadjustmentDoEditAction extends BaseAction {

	function VialidadCertificatesReadjustmentDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		$certificate = CertificateQuery::create()->findPk($_POST["id"]);
		if (empty($certificate)) {
			$smarty->assign("notValidId","true");
			return $mapping->findForwardConfig('success');
		}
		
		$certificate->updateAccumulatedItems();

		return $this->addParamsToForwards(array("id"=>$_POST["id"]),$mapping,'success-edit');
	}
}