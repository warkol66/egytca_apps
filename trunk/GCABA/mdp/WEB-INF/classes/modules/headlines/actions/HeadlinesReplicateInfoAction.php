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
			
			$headlineFromDate = $headlineFrom->getDatepublished('Y-m-d');
			$datePublishedFilter = array(
				'min' => date("Y-m-d", strtotime("$headlineFromDate - 5 days")),
				'max' => date("Y-m-d", strtotime("$headlineFromDate + 5 days"))
			);
			
			$headlinesTo = BaseQuery::create('Headline')
				->filterById($headlineFrom->getId(), Criteria::NOT_EQUAL)
				->filterByDatepublished($datePublishedFilter)
				->_if(!empty($_GET['text']))
					->searchString($_GET['text'])
				->_endif()
				->find();
			
			$smarty->assign('headlinesTo', $headlinesTo);
			$smarty->assign('headlineFrom', $headlineFrom);
		}
		
		return $mapping->findForwardConfig('success');
	}
}