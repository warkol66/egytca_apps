<?php

class HeadlinesReplicateInfoAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_GET['id'])) {
			
			$headlineFrom = HeadlineQuery::create()->findOneById($_GET['id']);
			if (!$headlineFrom) {
				$smarty->assign('invalidId', true);
				return $mapping->findForwardConfig('success');
			}
			
			$headlinesTo = HeadlineQuery::create()
				->filterById($headlineFrom->getId(), Criteria::NOT_EQUAL)
				->filterByDatepublished(date("Y-m-d", strtotime('now - 90 days')), Criteria::GREATER_EQUAL)
				->find();
			
			$smarty->assign('headlinesTo', $headlinesTo);
			$smarty->assign('headlineFrom', $headlineFrom);
		}
		
		return $mapping->findForwardConfig('success');
	}
}