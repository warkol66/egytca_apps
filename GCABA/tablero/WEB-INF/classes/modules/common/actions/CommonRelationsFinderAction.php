<?php

class CommonRelationsFinderAction extends BaseAction {

	function CommonRelationsFinderAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);

		if (!empty($_GET['entityType']) && !empty($_GET['entityId'])) {
			
			$entityType = $_GET['entityType'];
			$entityQueryClass = $entityType.'Query';
			if (!class_exists($entityQueryClass)) {
				$smarty->assign("message", "invalid entity");
				return $mapping->findForwardConfig('failure');
			}
			
			$entity = $entityQueryClass::create()->findOneById($_GET['entityId']);
			if (is_null($entity)) {
				$smarty->assign("message", "invalid id");
				return $mapping->findForwardConfig("failure");
			}
			
			$tableMap = $entity->getPeer()->getTableMap();
			
			$relatedEntities = array();
			
			foreach ($tableMap->getRelations() as $relation) {
				
				$relatedEntityIncludeTemplate = 'WEB-INF/classes/modules/common/tpl/CommonSearch'.$relation->getName().'ListX.tpl';
				if (file_exists($relatedEntityIncludeTemplate )) {
					$relatedEntityClass = $relation->getLocalTable()->getPhpName();
					$relatedEntityQuery = $relatedEntityClass.'Query';
					
					$filterByEntity = 'filterBy'.$entityType;
					$relatedEntities[$relatedEntityClass] = $relatedEntityQuery::create()->$filterByEntity($entity)->find();
				}
			}
			
			$smarty->assign("entity", $entity);
			$smarty->assign("entityType", $entityType);
			$smarty->assign("entityId", $entity->getId());
			$smarty->assign("relatedEntities", $relatedEntities);
			
			return $mapping->findForwardConfig("success");
			
		}
		else
			return $mapping->findForwardConfig("success");
	}
}
