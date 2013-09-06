<?php

class TwitterListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		if(!empty($_GET['filters']['unprocessed'])){
			$this->filters['Status'] = TwitterTweet::PARSED; 
		}elseif(!empty($_GET['filters']['discarded'])){
			$this->filters['Status'] = TwitterTweet::DISCARDED;
		}elseif(!empty($_GET['filters']['all'])){
			$this->filters['maxStatus'] = TwitterTweet::DISCARDED;
		}else{
			$this->filters['Status'] = TwitterTweet::ACCEPTED;
		}

	}

	protected function postList() {
		parent::postList();
		
		echo "<pre>";
		print_r($this->results);
		echo "</pre>";
		die();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		
	}

	/*function TwitterListAction() {

		if (!empty($filters['processed']))
			if ($filters['processed'] == -1)
				unset($filters['processed']);

		if (!isset($filters["perPage"]))
			$perPage = Common::getRowsPerPage();
		else
			$perPage = $filters["perPage"];
		

		$pager = BaseQuery::create('Headline')->orderByCreatedAt('desc')->createPager($filters,$page,$perPage);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}*/
}
