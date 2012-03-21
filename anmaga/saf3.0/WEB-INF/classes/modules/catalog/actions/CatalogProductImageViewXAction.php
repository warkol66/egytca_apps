<?php
/**
* ProductsShowHistoryXAction
* 
* Permite mediante Ajax recuperar un log.
* 
* @package  products
*/

class CatalogProductImageViewXAction extends BaseAction {

	function CatalogProductImageViewXAction() {
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
	
		$productId = $_REQUEST['id'];
		if (!empty($productId)){
			$product = ProductPeer::get($productId);
		}
		if(!empty($product)) {
			$smarty->assign("product", $product);
			return $mapping->findForwardConfig('success');
		} 
		else
			return $mapping->findForwardConfig('failure');

	}
}
