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
			else if (!$headlineFrom->processed()) {
				$smarty->assign('notProcessed', true);
				return $mapping->findForwardConfig('success');
			}
			
			$headlineFromDate = $headlineFrom->getDatepublished('Y-m-d');
			$datePublishedFilter = array(
				'min' => date("Y-m-d", strtotime("$headlineFromDate - 7 days")),
				'max' => date("Y-m-d", strtotime("$headlineFromDate + 7 days"))
			);
			
			$headlinesTo = BaseQuery::create('Headline')
				->filterById($headlineFrom->getId(), Criteria::NOT_EQUAL)
				->filterByClasskey($headlineFrom->getClasskey())
				->filterByDatepublished($datePublishedFilter)
				->_if(!empty($_GET['text']))
					->searchString($_GET['text'])
				->_endif()
				->_if(empty($_GET['processed']))
					->filterByValue(0)
					->filterByRelevance(0)
					->filterByAgenda(0)
					->filterByHeadlinescope(0)
				->_endif()
				->limit(50)//->toString(); print_r($headlinesTo);die;
				->find();
			
			$smarty->assign('headlinesTo', $headlinesTo);
			$smarty->assign('headlineFrom', $headlineFrom);

			$smarty->assign("headlineAgendas", Headline::getHeadlineAgendas());
			$smarty->assign("headlineScopes", Headline::getHeadlineScopes());
			$smarty->assign("headlineValues", Headline::getHeadlineValues());
			$smarty->assign("headlineRelevances", Headline::getHeadlineRelevances());

			$smarty->assign('tags', HeadlineTagQuery::create()->select('Name')->find()->toArray());

			$smarty->assign("_filters", $_filters);

			$smarty->assign("text", $_GET["text"]);
			$smarty->assign("processed", $_GET["processed"]);
			$smarty->assign("filters", $_GET["filters"]);
			$smarty->assign("id", $_GET["id"]);
			$smarty->assign("page", $_GET["page"]);

		}
		
		return $mapping->findForwardConfig('success');
	}
}