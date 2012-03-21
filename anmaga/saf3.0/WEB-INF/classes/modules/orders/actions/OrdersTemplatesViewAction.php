<?php

class OrdersTemplatesViewAction extends BaseAction {

	function OrdersTemplatesViewAction() {
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

		$orderTemplate = OrderTemplatePeer::get($_GET["id"]);
		if (empty($orderTemplate))
			return $mapping->findForwardConfig('notExists');

		$smarty->assign("orderTemplate",$orderTemplate);

		return $mapping->findForwardConfig('success');
	}

}
