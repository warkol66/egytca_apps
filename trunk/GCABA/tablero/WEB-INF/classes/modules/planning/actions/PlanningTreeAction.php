<?php

class PlanningTreeAction extends BaseAction {
	
	function PlanningTreeAction() {
		;
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$root = PositionQuery::create()->findOneByType(9);
		$root = PositionQuery::create()->findOneById($_GET["id"]);
		$data = $this->populate1($root);
		$smarty->assign('root', $root);
		$smarty->assign('data', json_encode($data));
		
		$this->template->template = "TemplateJQuery.tpl";
		
		return $mapping->findForwardConfig('success');
	}
	
	private function populate($node) {
		$data = array('name' => $node->getName());
		if (method_exists($node, 'getChildren')) {
			foreach ($node->getChildren() as $child) {
				if (!$data['children'])
					$data['children'] = array();
				$data['children'] []= $this->populate($child);
			}
		}
		return $data;
	}

	private function populate1($node) {
		$data = array('name' => $node->getName());
		if (method_exists($node, 'getChildren1')) {
			foreach ($node->getChildren1() as $child) {
				if (!$data['children'])
					$data['children'] = array();
				$data['children'] []= $this->populate($child);
			}
		}
		return $data;
	}

}
