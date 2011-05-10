<?php

class OrdersTemplatesDoDeleteAction extends BaseAction {

	function OrdersTemplatesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Orders";
		$section = "Templates";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		OrderTemplatePeer::delete($_POST["id"]);

		return $mapping->findForwardConfig('success');

	}

}
