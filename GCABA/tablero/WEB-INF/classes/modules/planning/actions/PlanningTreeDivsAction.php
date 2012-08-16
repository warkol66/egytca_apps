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
		
		$root = PositionQuery::create()->findOneById($_GET["id"]);
		$smarty->assign('root', $root);
		
//		$this->template->template = "TemplateJQuery.tpl";
		
		return $mapping->findForwardConfig('success');
	}

}
