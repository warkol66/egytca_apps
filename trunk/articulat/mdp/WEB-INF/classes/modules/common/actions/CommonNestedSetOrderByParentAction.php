<?php
class CommonNestedSetOrderByParentAction extends BaseAction {
	function CommonNestedSetOrderByParentAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		
		$entityName = $_POST['entity'];
		$entityNodeId = $_POST['nodeId'];
		$entityPeerName = $entityName . 'Peer';
		
		$entityNode = NULL;
		$children = new PropelCollection();
		if (class_exists($entityPeerName) && method_exists($entityPeerName, 'get')) {
			$tableMap = call_user_func(array($entityPeerName, 'getTableMap'));
			$entityPackageName = $tableMap->getPackage();
			$entityModuleName = ucwords(preg_replace('/.classes$/', '', $entityPackageName));
			$entityNode =  call_user_func( array($entityPeerName, 'get'), $entityNodeId );
			if (method_exists($entityNode, 'getChildren')) {
				$children = $entityNode->getChildren();
			}
		}
		$smarty->assign('module', $entityModuleName);	
		$smarty->assign('parentId', $entityNodeId);	
		$smarty->assign('children', $children);
		$smarty->assign('entity', $entityName);	
		return $mapping->findForwardConfig('success');
	}
}
