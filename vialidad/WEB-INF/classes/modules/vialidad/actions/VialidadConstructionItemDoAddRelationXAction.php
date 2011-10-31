<?php

class VialidadConstructionItemDoAddRelationXAction extends BaseAction {

	function VialidadConstructionItemDoAddRelationXAction() {
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
		
		if (!empty($_POST['itemId']) && !empty($_POST['supplyId'])) {
			
			$item = ConstructionItemQuery::create()->findOneById($_POST['itemId']);
			$supply = SupplyQuery::create()->findOneById($_POST['supplyId']);
			
			if (!$item->hasSupply($supply)) {
				
				$itemRelation = new ConstructionItemRelation();
				$itemRelation->setConstructionItem($item);
				$itemRelation->setSupply($supply);
				$itemRelation->setProportion(0);
				if (!$itemRelation->save())
					throw new Exception('could\'t save relation');
				
				$smarty->assign('component', $itemRelation);
				$smarty->assign('item', $item);
				
				return $mapping->findForwardConfig('success');
				
			} else {
				throw new Exception('relation already exists');
			}
			
		} else {
			throw new Exception('one or more params missing');
		}
	}

}
