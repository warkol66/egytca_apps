<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");

class NewsArticlesSearchAction extends BaseAction {


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
		$this->template->template = "TemplateNewsSearch.tpl";
		
		$newsArticlePeer = new NewsArticlePeer();
		$newsArticlePeer->setOrderByUpdateDate();
		$newsArticlePeer->setPublishedMode();
				
		if (!empty($_GET['searchString'])) {
			
			$smarty->assign('searchString',$_GET['searchString']);
			
			$newsArticlePeer->setSearchString($_GET['searchString']);
			
			$searchStringParams = "&searchString=".$_GET['searchString'];
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$newsArticlePeer->setCategory($category);

				$searchStringParams = $searchStringParams."&filters%5BcategoryId%5D=".$_GET['filters']['categoryId'];

			}
			
			if (!empty($_GET['filters']['fromDate'])) {
		    	$fromDate = Common::convertToMysqlDateFormat($_GET['filters']['fromDate']);
		    	$newsArticlePeer->setFromDate($fromDate);

				$searchStringParams = $searchStringParams."&filters%5BfromDate%5D=".$_GET['filters']['fromDate'];

			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$toDate = Common::convertToMysqlDateFormat($_GET['filters']['toDate']);
				$newsArticlePeer->setToDate($toDate);

				$searchStringParams = $searchStringParams."&filters%5BtoDate%5D=".$_GET['filters']['toDate'];

			}
			
			if (!empty($_GET['filters']['regionId'])) {
				$region = RegionPeer::get($_GET['filters']['regionId']);
				$newsArticlePeer->setRegion($region);

				$searchStringParams = $searchStringParams."&filters%5BregionId%5D=".$_GET['filters']['regionId'];

			}
			
			if (!empty($_GET['filters']['archive'])) {
				$newsArticlePeer->setArchiveAndPublishedMode();

				$searchStringParams = $searchStringParams."&filters%5Barchive%5D=".$_GET['filters']['archive'];

			}		

			$smarty->assign('filters',$_GET['filters']);
			
			$smarty->assign('categorySelected',$category);						
			$categories = CategoryPeer::getAllPublicByModule('news');
			$smarty->assign("categories",$categories);
			
			$smarty->assign('regionSelected',$region);
			$regions = RegionPeer::getAll();
			$smarty->assign("regions",$regions);
			
			$smarty->assign('archive',$_GET['filters']['archive']);
			
    	$pager = $newsArticlePeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign("newsarticles",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=newsArticlesSearch".$searchStringParams;
		
      $perPage = 	NewsArticlePeer::getRowsPerPage();
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
		
		}
		
		if ($_REQUEST["rss"]=="1") {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 	
			return $mapping->findForwardConfig('rss');
		}

		return $mapping->findForwardConfig('success');
	

	}

}