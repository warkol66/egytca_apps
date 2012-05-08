<?php
class CommonNestedSetDoOrderByParentXAction extends BaseAction {
	function CommonNestedSetDoOrderByParentXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    	BaseAction::execute($mapping, $form, $request, $response);

	    /**
	    * Use a different template
	    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		parse_str($_POST['data']);
		
		$parentId = $_POST['parentId'];
		$entityClassName = $_POST['entity'];
		$entityPeerName = $entityClassName . 'Peer';
		
		if (class_exists($entityPeerName) && method_exists($entityPeerName, 'get')) {
			$parent = call_user_func(array($entityPeerName, 'get'), $parentId);
			$child1 = call_user_func(array($entityPeerName, 'get'), $childrenList[0]);
			if (method_exists($child1, 'moveToFirstChildOf'))
				$child1->moveToFirstChildOf($parent);
			for ($index = 1; $index < count($childrenList); $index++) {
				$child2 = call_user_func(array($entityPeerName, 'get'), $childrenList[$index]); 
	   			$child2->moveToNextSiblingOf($child1);   			
				$child1 = $child2;
	   		}
		}
		return $mapping->findForwardConfig('success');
	}
}
