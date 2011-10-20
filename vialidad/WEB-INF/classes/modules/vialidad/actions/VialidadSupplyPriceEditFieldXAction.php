<?php

class VialidadSupplyPriceEditFieldXAction extends BaseAction {

	function VialidadSupplyPriceEditFieldXAction() {
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
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$priceBulletin = PriceBulletinQuery::create()->filterByBulletinid($_POST["bulletinId"])
			->filterBySupplyid($_POST["supplyId"])->findOne();

		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$priceBulletin->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$priceBulletin->save();
		}

		if (!empty($_POST['paramName'])) {
			if (stripos($_POST['paramName'], 'supplierId') !== false) {
				$supplierId = $priceBulletin->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME);
				$smarty->assign("paramValue", SupplierPeer::retrieveByPK($supplierId));
			} else {
				$smarty->assign("paramValue", $priceBulletin->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
			}
		}

		return $mapping->findForwardConfig('success');
	}

}
