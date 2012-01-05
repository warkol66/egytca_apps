<?php

class CommonRelationsFinderAction extends BaseAction {

	function CommonRelationsFinderAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);
		
		if (!empty($_GET['entity']) && !empty($_GET['id'])) {
			
			$entityType = $_GET['entity'];
			$entityQueryClass = $entityType.'Query';
			if (!class_exists($entityQueryClass)) {
				$smarty->assign('errorMessage', 'invalid entity');
				return $mapping->findFOrwardConfig('success');
			}
			
			$entity = $entityQueryClass::create()->findOneById($_GET['id']);
			if (is_null($entity)) {
				$smarty->assign('errorMessage', 'invalid id');
				return $mapping->findFOrwardConfig('success');
			}
			
			$tableMap = $entity->getPeer()->getTableMap();
			
			$relatedEntities = array();
			
			foreach ($tableMap->getRelations() as $relation) {
				$relatedEntityClass = $relation->getLocalTable()->getPhpName();
				$relatedEntityQuery = $relatedEntityClass.'Query';
				
				$filterByEntity = 'filterBy'.$entityType;
				$relatedEntities[$relatedEntityClass] = $relatedEntityQuery::create()->$filterByEntity($entity);
			}
			
			$smarty->assign('relatedEntities', $relatedEntities);
			return $mapping->findForwardConfig('success');
			
		} else {
			throw new Exception('wrong params');
		}
	}
}
