<?php

class VialidadConstructionsAddItemFromOtherXAction extends BaseAction {

	function VialidadConstructionsAddItemFromOtherXAction() {
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
		$section = "ConstructionItem";
		$smarty->assign("section",$section);
		
		if (!empty($_POST['constructionId']) && !empty($_POST['copiedId'])) {
			
			$construction = ConstructionQuery::create()->findOneById($_POST['constructionId']);
			$copied = ConstructionItemQuery::create()->findOneById($_POST['copiedId']);
			$newItem = new ConstructionItem();
			
			$copied->copyInto($newItem);
			$newItem->setConstruction($construction);
			try {
				$newItem->save();
			} catch (Exception $e) {
				throw new Exception('unable to save ConstructionItem');
			}
			
			foreach ($copied->getConstructionItemRelations() as $relation) {
				$newRelation = new ConstructionItemRelation();
				$relation->copyInto($newRelation);
				$newRelation->setConstructionItem($newItem);
				if (!$newRelation->save())
					throw new Exception('unable to save relation');
			}
			
			try {
				$newItem->save();
			} catch (Exception $e) {
				throw new Exception('unable to save ConstructionItem');
			}
			
			$smarty->assign('item', $newItem);
			$smarty->assign('constructionId', $_POST['constructionId']);
			
			return $mapping->findForwardConfig('success');
			
		} else {
			throw new Exception('one or more params missing');
		}
	}

}
