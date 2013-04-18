<?php

class CommonBlockedIpsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlockedIp');
	}
	
	protected function preList() {
		parent::preList();

		//aplicar filtro

	}

	protected function postList() {
		parent::postList();
		
		$module = "Common";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("message",$_GET["message"]);

	}

}


/*class CommonBlockedIpsListAction extends BaseAction {
	
	function CommonBlockedIpsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);

		$smarty->assign("message",$_GET["message"]);
		
		$blockedIps = BlockedIpQuery::create()->groupByIp()->find();
		//$blockedIps = $blockedIps->distinct();
		echo("<pre>");
		print_r($blockedIps);
		echo("</pre>");
		die();
		
		$smarty->assign("blockedUsers",$blockedUsers);
		$smarty->assign("blockedAffiliates",$blockedAffiliates);
		
		return $mapping->findForwardConfig('success');
	}

}*/

