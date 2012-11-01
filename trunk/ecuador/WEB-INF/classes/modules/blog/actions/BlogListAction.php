<?php

class BlogListAction extends BaseAction {

	function BlogListAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["blogEntries"];
		$smarty->assign("blogConfig",$blogConfig);
		
		$blogEntryPeer = new BlogEntryPeer();
		$blogEntryPeer->setReverseOrder();

 		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromDate']))
				$blogEntryPeer->setFromDate(Common::convertToMysqlDateFormat($_GET['filters']['fromDate']));
			
			if (!empty($_GET['filters']['toDate']))
				$blogEntryPeer->setToDate(Common::convertToMysqlDateFormat($_GET['filters']['toDate']));
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$blogEntryPeer->setCategory($category);			
			}
			
			$smarty->assign('filters',$_GET['filters']);
		}


		if ($_GET["export"] == "xls") {
			$blogEntries = $blogEntryPeer->getAllFiltered();

			$smarty->assign("blogEntries",$blogEntries);
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplatePlain.tpl";

			$xml = $smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		}
		
		$pager = $blogEntryPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("blogEntries",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=blogList";
		
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		
		$smarty->assign("url",$url);		

		$categories = BlogCategoryPeer::getAll();
		$smarty->assign("categories",$categories);
		$smarty->assign("blogEntryStatus",BlogEntryPeer::getStatus());   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}