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
		
		if (!empty($_GET['entityType']) && !empty($_GET['entityId'])) {
			
			$entityQueryClass = ucfirst($_GET['entityType']) . "Query";
			
			if (class_exists($entityQueryClass)) {
	
				$entity = $entityQueryClass::create()->findOneById($_GET['entityId']);
	
				if (empty($entity))
					$smarty->assign("notValidId",true);
				else
					$smarty->assign('entity', $entity);

			}
			else
				$smarty->assign("notValidEntity",true);

			$smarty->assign('entityType', $_GET['entityType']);
			return $mapping->findForwardConfig("success");

		}
		return $mapping->findForwardConfig("failure");
	}
		
}
