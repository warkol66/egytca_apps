<?php

class VialidadBulletinDoCreateFromOtherAction extends BaseAction {
	
	function addPriceBulletinToBulletin($priceBulletin, $bulletin) {
		$newPriceBulletin = new PriceBulletin();
		$priceBulletin->copyInto($newPriceBulletin);
		$newPriceBulletin->setBulletin($bulletin);
		$newPriceBulletin->setPublish(false);
		$newPriceBulletin->setAverageprice(0);
		$newPriceBulletin->setDefinitive(false);
		$newPriceBulletin->setDefinitive1(false);
		$newPriceBulletin->setSupplierdocument1(null);
		$newPriceBulletin->setDefinitive2(false);
		$newPriceBulletin->setSupplierdocument2(null);
		$newPriceBulletin->setDefinitive3(false);
		$newPriceBulletin->setSupplierdocument3(null);
		
		if (!$newPriceBulletin->save())
			throw new Exception('unable to save PriceBulletin');
		
		try {
			$bulletin->save();
		} catch (Exception $e) {
			throw new Exception('unable to save Bulletin');
		}
	}

	function VialidadBulletinDoCreateFromOtherAction() {
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
		$section = "Bulletin";
		$smarty->assign("section",$section);
		
		if (!empty($_POST['lastBulletinId'])) {
			
			$bulletin = new Bulletin();
			$userParams = Common::userInfoToDoLog();
			$bulletinParams = array_merge_recursive($_POST["params"],$userParams);
			$bulletin = Common::setObjectFromParams($bulletin,$bulletinParams);
			if (!$bulletin->save())
				return $this->returnFailure($mapping,$smarty,$bulletin);
			
			$last = BulletinQuery::create()->findOneById($_POST['lastBulletinId']);
			
			foreach ($last->getPriceBulletins() as $priceBulletin) {
				$this->addPriceBulletinToBulletin($priceBulletin, $bulletin);
			}
			
			return new ForwardConfig('Main.php?do=vialidadBulletinEdit&id'.$bulletin->getId()
				.'&action=edit', True);
		
		} else {
			throw new Exception('wrong params');
		}
	}

}
