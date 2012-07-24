<?php

require_once 'ServicesSearchEntityListXAction.php';

class ServicesSearchHeadlineListXAction extends ServicesSearchEntityListXAction {

	function ServicesSearchHeadlineListXAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {
		try {
			$_GET['entity'] = 'Headline';
			
			if (isset($_GET['filters']['fromDate']) || isset($_GET['filters']['toDate']))
				$_GET['filters']['datePublished'] = Common::getPeriodArray($_GET['filters']['fromDate'], $_GET['filters']['toDate']);
			
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
