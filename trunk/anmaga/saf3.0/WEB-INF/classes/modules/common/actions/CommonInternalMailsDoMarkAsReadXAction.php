<?php

class CommonInternalMailsDoMarkAsReadXAction extends BaseAction {

	function CommonInternalMailsDoMarkAsReadXAction() {
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

		$selectedIds = $_POST['selectedIds'];

		if ($_POST['reverse'])
			InternalMailPeer::markAsUnread($selectedIds);
		else
			InternalMailPeer::markAsRead($selectedIds);

		$internalMailPeer = new InternalMailPeer();

		if (!empty($_POST["page"])){
			$page = $_POST["page"];
			$smarty->assign("page", $page);
		}

		if (!empty($_POST['filters'])){
			$filters = $_POST['filters'];
			$this->applyFilters($internalMailPeer, $filters, $smarty);
		}

		$pager = $internalMailPeer->getAllPaginatedFiltered($page);

		$smarty->assign("internalMails", $pager->getResult());
		$smarty->assign("pager", $pager);

		$url = "Main.php?do=commonInternalMailList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url", $url);

		$smarty->assign("message",$_POST["message"]);
		return $mapping->findForwardConfig('success');
	}
}
