<?php

class VialidadCertificatesViewGraphAction extends BaseAction {

	function VialidadCertificatesViewGraphAction() {
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

		if (!empty($_GET['constructionId'])) {
			
			$smarty->assign('constructionId', $_GET['constructionId']);
			return $mapping->findForwardConfig("success");
		} else {
			throw new Exception('wrong params');
		}
	}
		
}
