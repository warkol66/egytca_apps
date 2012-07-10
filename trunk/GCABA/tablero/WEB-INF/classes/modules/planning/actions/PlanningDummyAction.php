<?php

class PlanningDummyAction extends BaseAction {
	
	function PlanningDummyAction() {
		;
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$smarty->assign('get', $_GET);
		
		if (!empty($_REQUEST['delay']))
			sleep($_REQUEST['delay']);
		
		if ($this->isAjax()) {
			$smarty->assign('isAjax', true);
			if ($_REQUEST['searchString'] == 'empty')
				$smarty->assign('empty', true);
			
			$this->template->template = "TemplateAjax.tpl";
		} else {
			$this->template->template = "TemplateJQuery.tpl";
		}
		
		return $mapping->findForwardConfig('success');
	}
}