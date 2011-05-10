<?php

class ImportSupplierOrderDoEditAction extends BaseAction {

	function ImportSupplierQuoteEditAction() {
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

		$module = "Import";
		$smarty->assign('module',$module);

		$purchaseOrderParams = $_POST['params'];
		
		if (!empty($_POST['id'])) {
			$supplierPurchaseOrder = SupplierPurchaseOrderPeer::get($_POST['id']);
			$params["id"] = $_POST["id"];

			$supplierPurchaseOrder = Common::setObjectFromParams($supplierPurchaseOrder, $purchaseOrderParams);
			
			if ($supplierPurchaseOrder->isModified() && $supplierPurchaseOrder->save())
				return $this->addParamsToForwards($params,$mapping,'success-edit');
			else
				return $mapping->findForwardConfig('failure');
		}
		else			
			return $mapping->findForwardConfig('failure');
	}
}
