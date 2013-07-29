<?php

class BannersValidationNameXAction extends BaseAction {

	function BannersValidationNameXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Validation";
		$smarty->assign('module',$module);

		$fieldname = 'params[name]';
		$exist = 0;
		
		$usernameExists = BannerQuery::create()->findOneByName($_GET['params']['name']);
		if (!empty($usernameExists))
			$exist = 1;
			
		$smarty->assign('name',$fieldname);
		$smarty->assign('value',$exist);

		return $mapping->findForwardConfig('success');
		
	}
	
}
