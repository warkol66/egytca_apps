<?php

class VialidadSupplyPriceEditModifiedPriceXAction extends BaseAction {

	function VialidadSupplyPriceEditModifiedPriceXAction() {
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

		if (!empty($_POST['paramValue'])) {
            $priceBulletin->setModified($_POST['paramValue']);
			$priceBulletin->save();
		}
        
        $smarty->assign("price", $priceBulletin);
        $smarty->assign("idx", $_POST["index"]);

		return $mapping->findForwardConfig('success');
	}

}
