<?php

class BoardSearchAction extends BaseAction {

	function BoardSearchAction() {
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

		$module = "Board";
		$smarty->assign("module",$module);
		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["boardChallenges"];
		$smarty->assign("boardConfig",$boardConfig);

		/**
		* Use a different template
		*/
		$this->template->template = "TemplateBlogPublic.tpl";

		$BoardChallenge = new BoardChallenge();
		$BoardChallenge->setOrderByUpdateDate();
		$BoardChallenge->setPublishedMode();

		if (!empty($_GET['searchString'])) {

			$smarty->assign('searchString',$_GET['searchString']);
			$BoardChallenge->setSearchString($_GET['searchString']);
			$searchStringParams = "&searchString=".$_GET['searchString'];

			$pager = $BoardChallenge->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign("blogEntryColl",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=blogSearch".$searchStringParams;

			$perPage = 	BoardChallenge::getRowsPerPage();
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
