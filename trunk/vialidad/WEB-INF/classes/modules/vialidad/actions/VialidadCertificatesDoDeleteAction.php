<?php

class VialidadCertificatesDoDeleteAction extends BaseAction {

	function VialidadCertificatesDoDeleteAction() {
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

		$certificate = CertificateQuery::create()->findPk($_POST["id"]);
		$certificate->delete();

		if ($certificate->isDeleted())
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');

	}

}
