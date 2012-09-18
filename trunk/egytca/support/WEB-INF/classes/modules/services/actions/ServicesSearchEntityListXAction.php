<?php

class ServicesSearchEntityListXAction extends BaseAction {

	function ServicesSearchEntityListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Services";
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
			$pager = $entityQueryClass::create()->$filterByEntity($relatedEntity)->createPager($_GET['filters'], $_GET['page'], $_GET['filters']['perPage']);
			
			$smarty->assign('entities', $pager->getResults());
			$smarty->assign("pager",$pager);
			
		} else {
			throw new Exception('wrong params');
		}
	}
}
