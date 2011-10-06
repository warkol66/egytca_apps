<?php
class VialidadBulletinDoEditPriceXAction extends BaseAction {

	function VialidadBulletinDoEditPriceXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		
		$priceBulletin = PriceBulletinPeer::retrieveByPK($_POST['bulletinId'], $_POST['supplyId']);
		
		if (!empty($priceBulletin)) {
		
			$preliminaryPrice = $_POST['preliminaryPrice'];
			$definitivePrice = $_POST['definitivePrice'];

			if (!empty($preliminaryPrice) && $preliminaryPrice >= 0)
				$priceBulletin->setPreliminaryprice ($preliminaryPrice);
			
			if (!empty($definitivePrice) && $definitivePrice >= 0)
				$priceBulletin->setDefinitivePrice ($definitivePrice);
			
			if (!$priceBulletin->save()) {
				throw new Exception("Couldn't save price bulletin");
			}
		}
		else {
			throw new Exception("Invalid IDs");
		}

		$smarty->assign('price', $priceBulletin);

		return $mapping->findForwardConfig('success');
	}
}
