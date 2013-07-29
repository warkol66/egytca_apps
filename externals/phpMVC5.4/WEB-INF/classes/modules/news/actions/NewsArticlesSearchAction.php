<?php

class NewsArticlesSearchAction extends BaseAction {
	
	/*function __construct() {
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
		
		if (!empty($_GET['searchString'])) {
			
			$this->smarty->assign('searchString',$_GET['searchString']);
			
			$this->entity->setSearchString($_GET['searchString']);
		}
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "News";
		$this->smarty->assign("module", $module);
		
		//filtros
		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];
            
        $this->smarty->assign("filters",$this->filters);
        
        
        
        $this->smarty->assign('categorySelected',$category);
		$this->smarty->assign("categories",CategoryQuery::create()->filterByIsPublic(true)->filterByModule('news')->find());
		
		/*$this->smarty->assign('regionSelected',$region);
		$this->smarty->assign("regions",RegionQuery::create()->find());*
		
		$this->smarty->assign('archive',$_GET['filters']['archive']);
		
		if ($_REQUEST["rss"]=="1") {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 	
			//return $mapping->findForwardConfig('rss');
		}

		
	}*/


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesSearchAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    	BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//usamos el template para no autenticado.
		$this->template->template = "TemplateNewsPublic.tpl";
		
		$newsArticle = new NewsArticle();
		$newsArticle->setOrderByUpdateDate();
		$newsArticle->setPublishedMode();
				
		if (!empty($_GET['searchString'])) {
			
			$smarty->assign('searchString',$_GET['searchString']);
			
			$newsArticle->setSearchString($_GET['searchString']);
			
			$searchStringParams = "&searchString=".$_GET['searchString'];
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$newsArticle->setCategory($category);

				$searchString = $searchStringParams."&filters%5BcategoryId%5D=".$_GET['filters']['categoryId'];

			}
			
			if (!empty($_GET['filters']['fromDate'])) {
		    	$fromDate = Common::convertToMysqlDateFormat($_GET['filters']['fromDate']);
		    	$newsArticle->setFromDate($fromDate);

				$searchStringParams = $searchStringParams."&filters%5BfromDate%5D=".$_GET['filters']['fromDate'];

			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$toDate = Common::convertToMysqlDateFormat($_GET['filters']['toDate']);
				$newsArticle->setToDate($toDate);

				$searchStringParams = $searchStringParams."&filters%5BtoDate%5D=".$_GET['filters']['toDate'];

			}
			
			if (!empty($_GET['filters']['regionId'])) {
				$region = RegionQuery::create()->findOneById($_GET['filters']['regionId']);
				$newsArticle->setRegion($region);

				$searchString = $searchStringParams."&filters%5BregionId%5D=".$_GET['filters']['regionId'];

			}
			
			if (!empty($_GET['filters']['archive'])) {
				$newsArticle->setArchiveAndPublishedMode();

				$searchStringParams = $searchStringParams."&filters%5Barchive%5D=".$_GET['filters']['archive'];

			}		

			$smarty->assign('filters',$_GET['filters']);
			
			$smarty->assign('categorySelected',$category);
			$smarty->assign("categories",CategoryQuery::create()->filterByIsPublic(true)->filterByModule('news')->find());
			
			/*$smarty->assign('regionSelected',$region);
			$regions = RegionPeer::getAll();
			$smarty->assign("regions",$regions);*/
			
			$smarty->assign('archive',$_GET['filters']['archive']);
			
    	$pager = $newsArticle->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign("newsArticlesColl",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=newsArticlesSearch".$searchStringParams;
		
      $perPage = 	NewsArticle::getRowsPerPage();
      if ($_GET['page'] > 1 )
	      $pageCount = $_GET['page'] - 1;
			else
	      $pageCount = 0;
			      
			$fromRecord = ($perPage * $pageCount) + 1;
			$toRecord = $perPage + ($perPage * $pageCount);
			
			if ($toRecord > $pager->getTotalRecordCount())
				$toRecord = $pager->getTotalRecordCount();

			$smarty->assign("fromRecord",$fromRecord);		
			$smarty->assign("toRecord",$toRecord);		

			$smarty->assign("url",$url);		
		
		}*/
		
		if ($_REQUEST["rss"]=="1") {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 	
			return $mapping->findForwardConfig('rss');
		}

		return $mapping->findForwardConfig('success');
	

	}

}
