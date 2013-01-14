<?php

class NewsMediasListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
	}
	
	protected function preList() {
		parent::preList();
		
		if(!empty($_GET['filters']['minDate']) || !empty($_GET['filters']['maxDate']))
			unset($this->filters['dateRange']);
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['creationdate']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['creationdate']['max'] = $_GET['filters']['maxDate'];
		}
		
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","News");
		
		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news');
		$this->smarty->assign("categories",$categories);
		$this->smarty->assign("mediaTypes",NewsMedia::getMediaTypes());
		
		//filtros
		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];
            
        $this->smarty->assign("filters",$this->filters);
		
	}

}
