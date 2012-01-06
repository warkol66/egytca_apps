<?php

class VialidadConstructionItemRelationDoEditFieldXAction extends BaseAction {

	function VialidadConstructionItemRelationDoEditFieldXAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$itemRelation = ConstructionItemRelationQuery::create()->filterByItemid($_POST["itemId"])
			->filterBySupplyid($_POST["supplyId"])->findOne();
		
		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			
			if ($_POST['paramName'] == 'proportion') {
				
				$_POST['paramValue'] = Common::convertToMysqlNumericFormat($_POST['paramValue']);
				$smarty->assign('isNumeric', true);
				
				$allRelations = ConstructionItemRelationQuery::create()->filterByItemid($_POST["itemId"])->find();
				$totalProportion = 0;
				
				foreach ($allRelations as $relation)
					$totalProportion += $relation->getProportion();
				
				$totalProportion -= $itemRelation->getProportion();
				$totalProportion += $_POST['paramValue'];
				
				if ($totalProportion <= 100) {
					$itemRelation->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
					$itemRelation->save();
				} else {
					throw new Exception('invalid proportion');
				}
				
			} else {
				$itemRelation->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
				$itemRelation->save();
			}
		}

		if (!empty($_POST['paramName'])) {
			$smarty->assign("paramValue", $itemRelation->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
		}

		return $mapping->findForwardConfig('success');
	}

}
