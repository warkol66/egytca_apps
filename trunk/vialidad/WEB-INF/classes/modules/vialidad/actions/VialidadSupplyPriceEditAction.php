<?php

class VialidadSupplyPriceEditAction extends BaseAction {

	function VialidadSupplyPriceEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (isset($_GET["bulletinId"]) && $_GET["bulletinId"] != ''
			&& isset($_GET["supplyId"]) && $_GET["supplyId"] != '') {
			
			$module = "Vialidad";
			$smarty->assign("module",$module);
			
			$priceBulletin = PriceBulletinQuery::create()
				->filterByBulletinid($_GET["bulletinId"])
				->filterBySupplyid($_GET["supplyId"])->findOne();
			
			if (is_null($priceBulletin)) {
				$smarty->assign("notValidId", "true");
				return $mapping->findForwardConfig('success');
			}
			
			$smarty->assign('priceBulletin', $priceBulletin);
			$smarty->assign('document1', $priceBulletin->getDocumentRelatedBySupplierdocument1()); // TODO: sirve? borrar
			$smarty->assign('document2', $priceBulletin->getDocumentRelatedBySupplierdocument2()); // TODO: sirve? borrar
			$smarty->assign('document3', $priceBulletin->getDocumentRelatedBySupplierdocument3()); // TODO: sirve? borrar
			$smarty->assign('allSuppliers', AffiliateQuery::create()->find());
			
			return $mapping->findForwardConfig('success');
			
		} else {
			throw new Exception("some params are missing");
		}
	}
}