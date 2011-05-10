<?php

class OrdersDoGenerateAction extends BaseAction {

	function OrdersDoGenerateAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplateMail.tpl";

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

		$orderId = OrderPeer::create($_POST["number"],$user->getId(),$user->getAffiliateId(),$total,$_POST["branchId"]);

		if (!empty($orderId)) {
			foreach ($items as $item) {
					//Si la cantidad del producto es mayor cero
					if ($item->getQuantity() > 0) {
						$item->setOrderId($orderId);
						$item->save();
					}
				}
		}

		$orderCreated = OrderPeer::get($orderId);

		$smarty->assign("order",$orderCreated);

		global $system;
		$sendEmail = $system["config"]["orders"]["sendMailOnCreation"]["value"];

		if ($sendEmail == "YES") {

			$affiliate = $orderCreated->getAffiliate();
			$owner = $affiliate->getOwner();
			$email = $owner->getMailAddress();

			$recipients = $system["config"]["orders"]["recipients"];

			//Reemplazo punto y coma por comas
			$recipients = str_replace(";", ",",$recipients);

			//Obtengo las direcciones de Mails
			$recipients = explode(",", $recipients);
			$recipients[] = $email;

			$forwardConfig = $mapping->findForwardConfig('email');
			//obtengo el template
			$template = $forwardConfig->getPath();


			$html_result = $smarty->fetch($template);

			if ($orderCreated->getNumber() == 0)
				$orderNumber = $orderCreated->getId();
			else
				$orderNumber = $orderCreated->getNumber();


			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
			require_once('EmailManagement.php');
			$manager = new EmailManagement();

			//creamos el mensaje multipart
			$message = $manager->createTextMessage("Creación de nueva orden: ".$orderNumber,$html_result);

			//realizamos el envio
			$result = $manager->sendMessage($recipients,$mailFrom,$message);
		}

		//vaciamos el carrito
		$_SESSION["orderItems"] = array();
		return $mapping->findForwardConfig('success');
	}

}
