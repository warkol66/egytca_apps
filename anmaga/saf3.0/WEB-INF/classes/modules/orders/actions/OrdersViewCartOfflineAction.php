<?php

class OrdersViewCartOfflineAction extends BaseAction {

	function OrdersViewCartOfflineAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    $this->template->template = "TemplateJquery.tpl";
    
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Orders";
		$smarty->assign("module",$module);
		
		//Si es un usuario comun, cargo la lista de afiliados
		if (Common::isSystemUser())
      $smarty->assign("affiliates",AffiliatePeer::getAll());    
		
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
