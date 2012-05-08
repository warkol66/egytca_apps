<?php
/**
* ActionlogsListAction
*
*  Toma los datos desde una fecha, hasta otra, desde la base de datos
*  una vez que que los toma, los lista
*
* @package actionlogs
*/

class CommonActionLogsListAction extends BaseAction {


	function CommonActionLogsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "actionlogs";
		$smarty->assign("module",$module);

		$usersPeer = new UserPeer();
		$users = $usersPeer->getAll();
		$smarty->assign("users", $users);

		$modulePeer = new ModulePeer();
		$modules = $modulePeer->getAllActive();
		$smarty->assign('modules',$modules);

		$smarty->assign("message",$_GET["message"]);

		if (class_exists('AffiliatePeer')){
			$affiliatePeer = new AffiliatePeer();
			$affiliates = $affiliatePeer->getAll();
			$smarty->assign("affiliates",$affiliates);

			if (class_exists('AffiliateUserPeer')){
				$affiliateUserPeer = new AffiliateUserPeer();
				$affiliateUser = $affiliateUserPeer->getAll();
				$smarty->assign("affiliateUser",$affiliateUser);
			}
		}

		$logs = new ActionLogPeer();
		$ActionLogPeer = new ActionLogPeer();
		$url= 'Main.php?do=commonActionLogsList';
		
 		if (!empty($_GET['filters'])) {

			$ActionLogPeer->setOrderByDatetime();
			if (!empty($_GET['filters']['dateFrom']))
				$ActionLogPeer->setDateFrom(Common::convertToMysqlDateFormat($_GET['filters']['dateFrom']) . ' 00:00:00');
			if (!empty($_GET['filters']['dateTo']))
				$ActionLogPeer->setDateTo(Common::convertToMysqlDateFormat($_GET['filters']['dateTo']) . ' 23:59:59');
			if (!empty($_GET['filters']['module']))
				$ActionLogPeer->setModule($_GET['filters']['module']);
			if (!empty($_GET['filters']['userId']))
				$ActionLogPeer->setUserId($_GET['filters']['userId']);
			if (!empty($_GET['filters']['afiliate']))
				$ActionLogPeer->setAffiliateId($_GET['filters']['affiliateId']);

			$pager = $ActionLogPeer->getAllPaginatedFiltered($_GET["page"]);

			foreach ($_GET['filters'] as $key => $value)
				$url .= "&filters[$key]=$value";
		}
		else if (!empty($_GET['listLogs']))
			$pager = $ActionLogPeer->getAllPaginated($_GET["page"]);

		if (empty($_GET['filters']['dateFrom']) && empty($_GET['filters']['dateTo'])) {
			$_GET['filters']["dateFrom"] = date('d-m-Y',mktime(0,0,0,date("m")-1,date("d"),date("Y")));
			$_GET['filters']["dateTo"] = date('d-m-Y');
		}

		$smarty->assign("filters",$_GET['filters']);
		if (!empty($pager))
			$smarty->assign("logs",$pager->getResult());
		$smarty->assign("pager",$pager);
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		$smarty->assign("url",$url);

		return $mapping->findForwardConfig('success');
	}

}
