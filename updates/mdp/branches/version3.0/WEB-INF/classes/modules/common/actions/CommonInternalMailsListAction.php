<?php

class CommonInternalMailsListAction extends BaseAction {

	function CommonInternalMailsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$internalMailPeer = new InternalMailPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page", $page);
		}
		
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($internalMailPeer, $filters, $smarty);
		}

		if (!empty($_GET["sent"])) {
			$internalMailPeer->setSearchSentOnly(true);
			$smarty->assign("sent", true);
		}
		$pager = $internalMailPeer->getAllPaginatedFiltered($page);

		$smarty->assign("internalMails", $pager->getResult());
		$smarty->assign("pager", $pager);

		$url = "Main.php?do=commonInternalMailsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url", $url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
