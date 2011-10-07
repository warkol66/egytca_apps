<?php
//class VialidadBulletinDoEditPriceXAction extends BaseAction {
//
//	function VialidadBulletinDoEditPriceXAction() {
//		;
//	}
//
//	function execute($mapping, $form, &$request, &$response) {
//		BaseAction::execute($mapping, $form, $request, $response);
//
//		$plugInKey = 'SMARTY_PLUGIN';
//		$smarty =& $this->actionServer->getPlugIn($plugInKey);
//		if($smarty == NULL) {
//			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
//		}
//
//		$module = "Vialidad";
//		
//		$priceBulletin = PriceBulletinPeer::retrieveByPK($_POST['bulletinId'], $_POST['supplyId']);
//		
//		if (!empty($priceBulletin)) {
//		
//			$preliminaryPrice = $_POST['preliminaryPrice'];
//			$definitivePrice = $_POST['definitivePrice'];
//
//			if (!empty($preliminaryPrice) && $preliminaryPrice >= 0)
//				$priceBulletin->setPreliminaryprice ($preliminaryPrice);
//			
//			if (!empty($definitivePrice) && $definitivePrice >= 0)
//				$priceBulletin->setDefinitivePrice ($definitivePrice);
//			
//			if (!$priceBulletin->save()) {
//				throw new Exception("Couldn't save price bulletin");
//			}
//		}
//		else {
//			throw new Exception("Invalid IDs");
//		}
//
//		$smarty->assign('price', $priceBulletin);
//
//		return $mapping->findForwardConfig('success');
//	}
//}



class VialidadPriceDoEditFieldXAction extends BaseAction {

	function VialidadPriceDoEditFieldXAction() {
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

		$module = "Vialidad";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$priceBulletin = PriceBulletinPeer::retrieveByPK($_POST['bulletinId'], $_POST['supplyId']);
		
		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$priceBulletin->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$priceBulletin->save();
		}
		
		if (!empty($_POST['paramName'])) {
			$smarty->assign("paramValue", $priceBulletin->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
		}
		
		return $mapping->findForwardConfig('success');
	}

}
