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
			
			echo "-------------------------------------<br/>";
			echo "<b>tipos de relaciones</b><br/>2 es ONE_TO_MANY<br/>4 es MANY_TO_MANY<br/><br/>";
			
			foreach ($tableMap->getRelations() as $relation) {
				$relatedEntityClass = $relation->getLocalTable()->getPhpName();
				$relatedEntityQuery = $relation->getLocalTable()->getPhpName().'Query';
				
				echo $relatedEntityClass.": ".$relation->getType()."<br>";
				
				if ($relation->getType() == RelationMap::MANY_TO_MANY) {
					//$relatedEntities[$relatedEntityClass] = 'pending...';
				} else {
					$foreignIdColumns = $relation->getLocalColumns();
					$foreignIdColumn = $foreignIdColumns[0]->getPhpName();
					
					$relatedEntities[$relatedEntityClass] = $relatedEntityQuery::create()->filterBy($foreignIdColumn, $entity->getId());
				}
			}
			
			echo "-------------------------------------<br/>";
			
			$smarty->assign('relatedEntities', $relatedEntities);
			return $mapping->findForwardConfig('success');
			
		} else {
			throw new Exception('wrong params');
		}
	}
}
