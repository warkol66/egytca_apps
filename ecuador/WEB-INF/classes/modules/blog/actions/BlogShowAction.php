<?php

class BlogShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postList() {
		parent::postList();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		 
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign('moduleConfig',$moduleConfig);
		
		/*$url = "Main.php?do=blogShow";
		if (isset($_GET['archive'])) 
			$url .= "&archive=1";
		$smarty->assign("url",$url);				
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			return $mapping->findForwardConfig('rss');
		}*/
		

	}

	/*function BlogShowAction() {
		;
	}

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

		$module = "Blog";
		$smarty->assign("module",$module);

   	// Use a different template
		$this->template->template = "TemplateBlogHome.tpl";
						
 		$blogEntryPeer = new BlogEntryPeer();
		$blogEntryPeer->setOrderByCreationDate();
		$blogEntryPeer->setReverseOrder();
		
		if($_GET['tagId'])
			$blogEntryPeer->setTag($_GET['tagId']);

		if($_GET['categoryId'])
			$blogEntryPeer->setCategory($_GET['categoryId']);

		if($_GET['period'])
			$blogEntryPeer->setPeriod($_GET['period']);

		$blogEntryPeer->setPublishedMode();

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign('moduleConfig',$moduleConfig);
    $entriesInHome = $moduleConfig["entriesInHome"];
    $entriesPerPage = $moduleConfig["entriesPerPage"];

		if (isset($_GET["page"]))
			$pager = $blogEntryPeer->getAllPaginatedFiltered($_GET["page"],$entriesPerPage);
		elseif (isset($_REQUEST["rss"]))
			$pager = $blogEntryPeer->getAllPaginatedFiltered(1);
		else
			$pager = $blogEntryPeer->getAllPaginatedFilteredForHome($entriesInHome);

		//Hack para cálculo de páginas si se quiere tener primera página diferente, implica uso de paginador especial
		$totalPages = ceil(($pager->getTotalRecordCount() - $entriesInHome ) / $entriesPerPage);
		$smarty->assign("totalPages",$totalPages);

		$smarty->assign("blogEntryColl",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=blogShow";
		if (isset($_GET['archive'])) 
			$url .= "&archive=1";
		$smarty->assign("url",$url);				
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			return $mapping->findForwardConfig('rss');
		}
   
		return $mapping->findForwardConfig('success');
	}*/

}
