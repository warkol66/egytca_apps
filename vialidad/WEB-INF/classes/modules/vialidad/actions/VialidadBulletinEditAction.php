<?php

class VialidadBulletinEditAction extends BaseAction {

	function VialidadBulletinEditAction() {
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

		if (!empty($_GET["id"])) {
			//voy a editar un objeto

			$bulletin = BulletinPeer::get($_GET["id"]);

			if (is_null($bulletin))
				throw new Exception("Invalid ID");

			$smarty->assign("bulletin",$bulletin);
			$smarty->assign("action","edit");

		} else {
			//voy a crear un objeto nuevo
			$bulletin = new Bulletin();
			$smarty->assign("bulletin",$bulletin);
			$smarty->assign("action","create");
		}

		$supplies = SupplyQuery::create()->find();
		
		$suppliesArray = array();
		foreach ($supplies as $supply) {
			array_push($suppliesArray, $supply);
		}

		// Si un supply se elimino, destruyo su priceBulletin
		foreach ($bulletin->getPriceBulletins() as $priceBulletin) {
			if(!in_array($priceBulletin->getSupply(), $suppliesArray))
				PriceBulletinPeer::delete($priceBulletin);
		}
		
		// Si un supply se agrego, creo su priceBulletin
		foreach ($supplies as $supply) {
			if (!$bulletin->hasSupply($supply)) {
				$bulletin->addSupply($supply);
				if (!$bulletin->save()) {
					throw new Exception("Couldn't save bulletin");
				}
			}
		}
		
		$prices = PriceBulletinQuery::create()->filterByBulletin($bulletin)->find();
		
		$smarty->assign("prices", $prices);
		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
