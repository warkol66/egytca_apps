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
			if (is_null($priceBulletin))
				throw new Exception("PriceBulletin doesn't exist");
			
			$smarty->assign('priceBulletin', $priceBulletin);
			$smarty->assign('document1', $priceBulletin->getDocumentRelatedBySupplierdocument1());
			$smarty->assign('document2', $priceBulletin->getDocumentRelatedBySupplierdocument2());
			$smarty->assign('document3', $priceBulletin->getDocumentRelatedBySupplierdocument3());
			
			return $mapping->findForwardConfig('success');
			
		} else {
			throw new Exception("some params are missing");
		}
	}
}