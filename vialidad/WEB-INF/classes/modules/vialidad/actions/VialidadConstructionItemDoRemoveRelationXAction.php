<?php

class VialidadConstructionItemDoRemoveRelationXAction extends BaseAction {

	function VialidadConstructionItemDoRemoveRelationXAction() {
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
		
		if (!empty($_POST['itemId']) && !empty($_POST['supplyId'])) {
			
			$itemRelation = ConstructionItemRelationQuery::create()->filterBySupplyid($_POST['supplyId'])
				->filterByItemid($_POST['itemId'])->findOne();
			
			try {
				$itemRelation->delete();
			
				$item = ConstructionItemQuery::create()->findOneById($_POST['itemId']);
				$components = ConstructionItemRelationQuery::create()->filterByItemid($_POST['itemId'])->find();
				
				$smarty->assign('item', $item);
				$smarty->assign('components', $components);
				
				return $mapping->findForwardConfig('success');
			} catch (Exception $e) {
				return $mapping->findForwardConfig('failure');
			}
	
		} else {
			throw new Exception('one or more params missing');
		}
	}

}
