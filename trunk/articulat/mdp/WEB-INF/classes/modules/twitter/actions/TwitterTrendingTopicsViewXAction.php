<?php

class TwitterTrendingTopicsViewXAction extends BaseAction {

	function TwitterTrendingTopicsViewXAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if($_POST['TTview'] == 'next')
			$date = date('Y-m-d', strtotime($_POST['dateShowing']. ' +1 day'));
		else
			$date = date('Y-m-d', strtotime($_POST['dateShowing']. ' -1 day'));

		$timeRange = Common::findFirstAndLastTimes($date);

		$currentUserDate = Common::getDatetimeOnTimezone(date('Y-m-d H:i:s'));
		
		$smarty->assign('dateShowing', $date);
		$smarty->assign('currentDate', date('Y-m-d', strtotime($currentUserDate)));
		$smarty->assign('trendingTopics',TwitterTrendingTopicQuery::getMostTrending($timeRange['from'], $timeRange['to'], 10));
		return $mapping->findForwardConfig('success');

	}
}


