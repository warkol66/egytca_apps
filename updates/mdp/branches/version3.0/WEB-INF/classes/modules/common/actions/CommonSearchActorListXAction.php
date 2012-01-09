<?php

require_once 'CommonSearchEntityListXAction.php';

class CommonSearchActorListXAction extends CommonSearchEntityListXAction {

	function CommonSearchActorListXAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {
		try {
			parent::execute($mapping, $form, $request, $response);
			return $mapping->findForwardConfig('success');
		} catch (Exception $e) {
			$plugInKey = 'SMARTY_PLUGIN';
			$smarty = $this->actionServer->getPlugIn($plugInKey);
			if($smarty == NULL) {
				echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
			}
			$smarty->assign('message', $e->getMessage());
			return $mapping->findForwardConfig('failure');
		}
	}
}
