<?php

class VialidadSupplyPriceEditModifiedPriceAction extends BaseAction {

	function VialidadSupplyPriceEditModifiedPriceAction() {
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

        $modifiedOn = $_POST['modifiedOn'. $_POST['priceIndex']];
        $definitiveOn = $_POST['definitiveOn'. $_POST['priceIndex']];
        
        $priceBulletin->setModifiedprice($_POST['modifiedPrice']);
        
        if (!empty($modifiedOn))
            $priceBulletin->setModifiedon($modifiedOn);
        
        if (!empty($definitiveOn))
            $priceBulletin->setDefinitiveon($definitiveOn);
        
        $priceBulletin->save();
        
        $smarty->assign("price", $priceBulletin);
        $smarty->assign("idx", $_POST["index"]);

		return $this->generateDynamicForward('success');
	}

}
