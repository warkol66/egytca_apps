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
		
		
		//BaseQueryDebug
		$filters = array(
			'name' => 'myName',
			'description' => 'myDescription',
			'entityFilter' => 'asd'
		);
		$q = BaseQuery::create('ImpactObjective')
			->addFilters($filters)
			->filterByName('qwe', Criteria::LIKE)
			->filterById(array('min' => 1, 'max' => 10))
			->orderByName(Criteria::ASC)
			->filterByName();
		
		$debugInfo = $q->debug();
		$pager = $q->createPager($filters, 1, 10);
		$results = $pager->getResults();
		$smarty->assign('debugInfo', $debugInfo);
		$smarty->assign('pager', $pager);
		$smarty->assign('results', $results);
		// end BaseQueryDebug
		
		return $mapping->findForwardConfig('success');
	}
}