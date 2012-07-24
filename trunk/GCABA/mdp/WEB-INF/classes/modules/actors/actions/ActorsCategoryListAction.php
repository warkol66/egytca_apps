<?php

class ActorsCategoryListAction extends BaseAction {

	function ActorsCategoryListAction() {
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

		$module = "Actors";
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		$actorCategoryPeer = new ActorCategoryPeer();

		if (isset($_GET['filters']))
			$this->applyFilters($actorCategoryPeer,$_GET['filters'],$smarty);

		$pager = $actorCategoryPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("categories",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=actorsCategoryList";

		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


