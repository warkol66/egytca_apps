<?php

class VialidadBulletinDoDeletePriceXAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {
		
		BaseAction::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_POST['priceBulletinId']) && !empty($_POST['priceNumber'])) {
			
			$priceBulletin = PriceBulletinQuery::create()->findOneById($_POST['priceBulletinId']);
			$priceNumber = $_POST['priceNumber'];
			
			$priceBulletin->deletePriceN($priceNumber);
				
			$smarty->assign('priceBulletin', $priceBulletin);
			$smarty->assign('priceNumber', $priceNumber);
			$smarty->assign('attachInplaceEditors', true);
			
			$smarty->display('VialidadPriceInclude.tpl');
			return;
		}
	}
}
