<?php

class CommonInternalMailsListAction extends BaseAction {

	function CommonInternalMailsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
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
		
		$pager = $internalMailPeer->getAllPaginatedFiltered($page);

		$smarty->assign("internalMails", $pager->getResult());
		$smarty->assign("pager", $pager);

		$url = "Main.php?do=commonInternalMailList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url", $url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
