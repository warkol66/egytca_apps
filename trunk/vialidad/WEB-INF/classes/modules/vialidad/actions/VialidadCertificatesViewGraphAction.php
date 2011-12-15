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

		// borrame?
		if (!empty($_GET['constructionId'])) {
			$_GET['entityType'] = 'construction';
			$_GET['entityId'] = $_GET['constructionId'];
		}
			
		if ( !empty($_GET['entityType']) && !empty($_GET['entityId']) ) {
			
			switch ($_GET['entityType']) {
				case 'construction':
					$entity = ConstructionQuery::create()->findOneById($_GET['entityId']);
					break;
				case 'contract':
					$entity = ContractQuery::create()->findOneById($_GET['entityId']);
					break;
				default:
					throw new Exception('wrong params');
			}
			
			$smarty->assign('entity', $entity);
			$smarty->assign('entityType', $_GET['entityType']);

			return $mapping->findForwardConfig("success");
		} else {
			throw new Exception('wrong params');
		}
	}
		
}
