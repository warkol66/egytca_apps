<?php

class IssuesCategoryListAction extends BaseAction {

	function IssuesCategoryListAction() {
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

		$module = "Issues";
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		$issueCategoryPeer = new IssueCategoryPeer();

		if (isset($_GET['filters']))
			$this->applyFilters($issueCategoryPeer,$_GET['filters'],$smarty);

		$pager = $issueCategoryPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("categories",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=issuesCategoryList";

		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


