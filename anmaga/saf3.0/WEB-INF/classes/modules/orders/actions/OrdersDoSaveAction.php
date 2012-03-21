<?php

class OrdersDoSaveAction extends BaseAction {

	function OrdersDoSaveAction() {
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
		$smarty->assign("module",$module);

		if (Common::isSystemUser()) {
			$affiliateId = $_REQUEST["affiliateId"];
			if (empty($affiliateId))
				return $mapping->findForwardConfig('failure');
			require_once("AffiliatePeer.php");
			$affiliate = AffiliatePeer::get($affiliateId);
			$user = $affiliate->getOwner();
		}
		else
			$user = $_SESSION["loginAffiliateUser"];

		$items = $_SESSION["orderItems"];

		$total = 0;
		foreach ($items as $item) {
			//Si la cantidad del producto es mayor cero
			if ($item->getQuantity() > 0) {
				//Como la cantidad es en unidad de ventas debo multiplicar la cantidad por salesUnit para obtener la cantidad real
				$product = $item->getProduct();
				$productQuantity = $product->getSalesUnit() * $item->getQuantity();
				$item->setQuantity($productQuantity);
				$total += ($item->getPrice() * $item->getQuantity());
			}
		}

		$orderId = OrderTemplatePeer::create($_POST["name"],$user->getId(),$user->getAffiliateId(),$total);

		if (!empty($orderId)) {
			foreach ($items as $item) {
				//Si la cantidad del producto es mayor cero
				if ($item->getQuantity() > 0) {
					$templateItem = $item->getOrderTemplateItem();
					$templateItem->setOrderTemplateId($orderId);
					$templateItem->save();
				}
			}
		}
		$_SESSION["orderItems"] = array();
		return $mapping->findForwardConfig('success');
	}

}
