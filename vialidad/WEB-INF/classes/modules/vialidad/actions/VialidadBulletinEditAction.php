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
			
			if (is_null($bulletin)) {
				$smarty->assign("notValidId", "true");
				return $mapping->findForwardConfig('success');
			}

			$smarty->assign("bulletin",$bulletin);
			$smarty->assign("action","edit");
			
			$supplies = SupplyQuery::create()->filterByType(1)->find();
			
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
			
		} else {
			//voy a crear un objeto nuevo a partir del último bulletin
			
			$last = BulletinQuery::create()->orderByBulletindate(Criteria::DESC)->findOne();
			$new = new Bulletin();
			
			if ($last) {
				
				$last->copyInto($new);
				$new->setNumber($last->getNumber()+1);
				$lastBulletinDate = $last->getBulletindate('%m/%d/%Y');
				$new->setBulletindate(date('d-m-Y',strtotime("$lastBulletinDate +1 month")));
				$new->setComments(null);
				$new->setPublished(false);
				
				$smarty->assign('toBeCopiedId', $last->getId());
				$smarty->assign("action","copy");
			}
			
			$smarty->assign("bulletin",$new);
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		if ($_GET['toPrint']) {
			$this->template->template = 'TemplatePrint.tpl';
			$smarty->assign('toPrint', true);
		}
		return $mapping->findForwardConfig('success');
	}

}
