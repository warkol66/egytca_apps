<?php

class BlogTagsListAction extends BaseAction {

	function BlogTagsListAction() {
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
		$section = "Tags";
		$smarty->assign("section",$section);

		$blogTagPeer = new BlogTagPeer();

		if (isset($_GET['filters']))
			$this->applyFilters($actorTagPeer,$_GET['filters'],$smarty);

		$pager = $blogTagPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("tags",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=blogTagsList";

		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


