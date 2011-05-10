<?php

class BlogSearchAction extends BaseAction {

	function BlogSearchAction() {
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

		/**
		* Use a different template
		*/
		$this->template->template = "TemplateBlogPublic.tpl";

		$blogEntryPeer = new BlogEntryPeer();
		$blogEntryPeer->setOrderByUpdateDate();
		$blogEntryPeer->setPublishedMode();

		if (!empty($_GET['searchString'])) {

			$smarty->assign('searchString',$_GET['searchString']);
			$blogEntryPeer->setSearchString($_GET['searchString']);
			$searchStringParams = "&searchString=".$_GET['searchString'];

			$pager = $blogEntryPeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign("blogEntries",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=blogSearch".$searchStringParams;

			$perPage = 	BlogEntryPeer::getRowsPerPage();
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