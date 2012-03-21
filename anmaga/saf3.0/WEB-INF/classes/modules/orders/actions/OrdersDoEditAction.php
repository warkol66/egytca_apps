<?php

class OrdersDoEditAction extends BaseAction {

	function OrdersDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Orders";
		$section = "Orders";

		//recuperamos la orden a editar
		$order = OrderPeer::get($_POST["orderId"]);

		if (empty($order))
			return $mapping->findForwardConfig('notExists');

		if (empty($_SESSION["loginUser"])) {
			if ($_SESSION["loginAffiliateUser"]->getAffiliateId() != $order->getAffiliateId())
				return $mapping->findForwardConfig('noPermission');
		}

		if (empty($_SESSION["loginUser"]))
			$smarty->assign("all",0);
		else
			$smarty->assign("all",1);

		//modificamos la orden con los datos obtenidos
		if (isset($_POST['number']))
			$order->setNumber($_POST['number']);
		if (isset($_POST['branch']))
			$order->setAffiliateBranch(AffiliateBranchPeer::get($_POST['branch']));
		if (isset($_POST['created']))
			$order->setDateCreated($_POST['created']);
		//salvamos la orden
		try {
			$order->save();
		}
		catch (Exception $exp) {
			return $mapping->findForwardConfig('error');
		}

		//redireccionamiento
		$page = $_POST['page'];
		header("Location: Main.php?do=ordersList&message=saved&page=$page");
	}

}
