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
			
			/*********** Provisorio ***********/
			$filteredQuery = DocumentRelatedEntityQuery::create()->filterByEntitytype("SupplierPrice")
				->filterByEntityid($priceBulletin->getId().'1');
			if ($filteredQuery->count() == 1)
				//$smarty->assign('document1', $filteredQuery->findOne());
				$priceBulletin->setSupplierdocument1($filteredQuery->findOne()->getDocumentId());
			
			$filteredQuery = DocumentRelatedEntityQuery::create()->filterByEntitytype("SupplierPrice")
				->filterByEntityid($priceBulletin->getId().'2');
			if ($filteredQuery->count() == 1)
				//$smarty->assign('document2', $filteredQuery->findOne());
				$priceBulletin->setSupplierdocument2($filteredQuery->findOne()->getDocumentId());
			
			$filteredQuery = DocumentRelatedEntityQuery::create()->filterByEntitytype("SupplierPrice")
				->filterByEntityid($priceBulletin->getId().'3');
			if ($filteredQuery->count() == 1)
				//$smarty->assign('document3', $filteredQuery->findOne());
				$priceBulletin->setSupplierdocument3($filteredQuery->findOne()->getDocumentId());
			/**********************************/
			
			if (!is_null($priceBulletin->getSupplierdocument1())) {
				$smarty->assign('document1', $priceBulletin->getDocumentRelatedBySupplierdocument1());
			}
			
			if (!is_null($priceBulletin->getSupplierdocument2())) {
				$smarty->assign('document2', $priceBulletin->getDocumentRelatedBySupplierdocument2());
			}
			
			if (!is_null($priceBulletin->getSupplierdocument3())) {
				$smarty->assign('document3', $priceBulletin->getDocumentRelatedBySupplierdocument3());
			}
			
			return $mapping->findForwardConfig('success');
			
		} else {
			throw new Exception("some params are missing");
		}
	}
}