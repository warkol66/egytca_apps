<?php

class CommonSearchEntityListXAction extends BaseAction {

	function CommonSearchEntityListXAction() {
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
		
		if (!empty($_GET['entity']) && !empty($_GET['relatedEntity']) && !empty($_GET['relatedId'])) {
			
			$entityType = $_GET['entity'];
			$relatedEntityType = $_GET['relatedEntity'];
			
			$relatedEntityQueryClass = $relatedEntityType.'Query';
			if (!class_exists($relatedEntityQueryClass))
				throw new Exception('invalid entity');
			
			$relatedEntity = $relatedEntityQueryClass::create()->findOneById($_GET['relatedId']);
			if (is_null($relatedEntity))
				throw new Exception('invalid id');
			
			$entityQueryClass = $entityType.'Query';
			if (!class_exists($entityQueryClass))
				throw new Exception('invalid entity');
			
			$filterByEntity = 'filterBy'.$relatedEntityType;
			$collection = $entityQueryClass::create()->$filterByEntity($relatedEntity)->find();
			
			$smarty->assign('collection', $collection);
			
		} else {
			throw new Exception('wrong params');
		}
	}
}
