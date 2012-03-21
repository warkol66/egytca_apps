<?php

class CatalogProductValidationCodeXAction extends BaseAction {

	function CatalogProductValidationCodeXAction() {
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

		$fieldname = 'product[code]';
		$exist = 1;


		if ($_POST['product']['code'] == $_POST['actualproduct']['code'])
			$exist = 0;
		else {
			if (strlen($_POST['product']['code']) >= 4) {
				$codeExists = ProductPeer::getByCode($_POST['product']['code']);
				if (empty($codeExists))
					$exist = 0;
			}
			else
				$minLength = 1;
		}

		$smarty->assign('minLength',$minLength);

		$smarty->assign('name',$fieldname);
		$smarty->assign('value',$exist);
		$smarty->assign('message',$message);

		return $mapping->findForwardConfig('success');

	}

}
