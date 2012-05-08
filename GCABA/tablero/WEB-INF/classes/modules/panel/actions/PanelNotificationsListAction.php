<?php

class PanelNotificationsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelNotificationsListAction() {
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

		$module = "Panel";
		$smarty->assign("module",$module);
		
		$notificationPeer = new NotificationPeer();

		$types = $notificationPeer->getTypesTranslated();
		$smarty->assign("types", $types);

		$notificationPeer = new NotificationPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($notificationPeer,$filters,$smarty);
		}

		$pager = $notificationPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("notifications",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=panelNotificationsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}
}