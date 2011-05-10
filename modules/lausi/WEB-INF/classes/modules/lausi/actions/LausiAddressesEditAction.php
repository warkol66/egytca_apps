<?php

class LausiAddressesEditAction extends BaseAction {

	function LausiAddressesEditAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Addresses";
		$smarty->assign("section",$section);		

		$filters = $_GET['filters'];
		$smarty->assign("filters",$filters);

    	if (!empty($_GET["id"])) {
			//voy a editar un address

			$address = AddressPeer::get($_GET["id"]);

			//obtengo todas las carteleras en la direccion
			$smarty->assign("billboards",$address->getBillboards());
			//obtengo todos los motivos actuales en esa direccion
			$adverts = AdvertisementPeer::getAllCurrentByAddress($address->getId());
			
			$themes = ThemePeer::getAllActive();
			$smarty->assign('themes',$themes);
			
			//agregado de agrupamiento por Motivo
			$groupByTheme = array();
			
			foreach ($adverts as $advert) {
				$theme = $advert->getTheme();
				$themeId = $advert->getThemeId();
				if (!empty($theme)) {
					if (empty($groupByTheme[$themeId]))
						$groupByTheme[$themeId]['adverts'] = array();
					
					array_push($groupByTheme[$themeId]['adverts'],$advert);
					
					if (empty($groupByTheme[$themeId]['theme']))
						$groupByTheme[$themeId]['theme'] = $advert->getTheme();
				}
			}
			
			//disponibilidades
			$billboards = BillboardPeer::getAllAvailableByAddress($_GET['id'], 0, date('Y-M-d'), 1, BillboardPeer::TYPE_DOBLE);
				
			$doubleAvailable = count($billboards[$_GET['id']]['elements']);
			
			$billboards = BillboardPeer::getAllAvailableByAddress($_GET['id'], 0, date('Y-M-d'), 1, BillboardPeer::TYPE_SEXTUPLE);
			$sixAvailable = count($billboards[$_GET['id']]['elements']);
			
			$smarty->assign('doubleAvailable',$doubleAvailable);
			$smarty->assign('sixAvailable',$sixAvailable);
			
			$smarty->assign("groupByTheme",$groupByTheme);
			
	    	$smarty->assign("action","edit");
		} else {
			//voy a crear un address nuevo
			$address = new Address();
			$smarty->assign("action","create");
		}
		
		$smarty->assign("address",$address);			
		$smarty->assign("regions",RegionPeer::getAll());
		$smarty->assign("circuits",CircuitPeer::getAll());

		$url = "Main.php?do=lausiAddressesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);
		
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
