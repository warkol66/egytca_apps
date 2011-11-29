<?php

class VialidadSupplyPriceCalculateAveragePriceXAction extends BaseAction {

	function VialidadSupplyPriceCalculateAveragePriceXAction() {
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
		$section = "PriceBulletin";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		if (!empty($_POST['id'])) {
			$priceBulletin = PriceBulletinQuery::create()->findOneById($_POST['id']);
			
			if (!is_null($priceBulletin)) {
				$priceBulletin->setAverageprice($priceBulletin->calculatePrice());
				$priceBulletin->save();
				
				$smarty->assign('price', $priceBulletin->getAverageprice());
				
				return $mapping->findForwardConfig('success');
			} else {
				throw new Exception("price bulletin with id ".$_POST['id']." doesn't exist");
			}
		} else {
			throw new Exception('wrong params');
		}
		
	}
}