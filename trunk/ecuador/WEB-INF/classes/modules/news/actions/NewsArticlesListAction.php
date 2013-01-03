<?php

class NewsArticlesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
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

	protected function postList() {
		parent::postList();
		
		$module = "News";
		$this->smarty->assign("module", $module);
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$newsArticlesConfig = $moduleConfig["newsAticles"];
		$this->smarty->assign("newsArticlesConfig",$newsArticlesConfig);
		
		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news');
		$this->smarty->assign("categories",$categories);
		//migrar cuando esten los peers
		$this->smarty->assign("newsArticleStatus",NewsArticlePeer::getStatus());
		
		//filtros
		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];

		/* Comentado para uso futuro
		 * if ($_GET["export"] == "xls") {
			$newsarticles = $newsArticlePeer->getAllFiltered();

			$smarty->assign("newsarticles",$newsarticles);
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplatePlain.tpl";

			$xml = $smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		}
		*/
		
	}

}
