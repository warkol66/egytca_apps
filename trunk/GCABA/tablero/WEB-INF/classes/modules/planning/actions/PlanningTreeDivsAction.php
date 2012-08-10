<?php

class PlanningTreeDivsAction extends BaseAction {
	
	function PlanningTreeDivsAction() {
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
		$data = $this->populate($root);
		$smarty->assign('root', $root);
		$smarty->assign('data', $data);
		
		$this->template->template = "TemplateJQuery.tpl";
		
		return $mapping->findForwardConfig('success');
	}
	
	private function populate($node) {
		//$node = str_replace("'","´",$node);
		//['Padre',null,      'The President'],
		$data = "['".str_replace("'","´",$node)."',null,'".str_replace("'","´",$node)."'],";
		//$data = array('[' => $node->getTreeName());
		if (method_exists($node, 'getBrood')) {
		 	foreach ($node->getBrood() as $child) {
				//$child = str_replace("'","´",$child);
		// 		if (!$data['children'])
		 		$data = $data."['".str_replace("'","´",$child)."','".str_replace("'","´",$node)."','".str_replace("'","´",$child)."'],";
		 		$data = $data.$this->populate($child);
		 	}
		 }
		return $data;
	}

}
