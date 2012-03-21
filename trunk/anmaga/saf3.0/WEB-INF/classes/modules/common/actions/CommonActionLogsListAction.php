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
				$affiliatesUsers = $affiliateUserPeer->getAll();
				$smarty->assign("affiliatesUser",$affiliatesUsers);
			}
		}
		if (class_exists('ClientPeer')){
			$clientPeer = new ClientPeer();
			$clients = $clientPeer->getAll();
			$smarty->assign("clients",$clients);

			if (class_exists('ClientUserPeer')){
				$clientUserPeer = new ClientUserPeer();
				$clientUsers = $clientUserPeer->getAll();
				$smarty->assign("clientUsers",$clientUsers);
			}
		}

		$actionLogPeer = new ActionLogPeer();
		
		if (!empty($_GET['filters'])){
			if (empty($_GET['filters']['dateFrom']) && empty($_GET['filters']['dateTo'])) {
				$_GET['filters']["dateFrom"] = date('d-m-Y',mktime(0,0,0,date("m")-1,date("d"),date("Y")));
				$_GET['filters']["dateTo"] = date('d-m-Y');
			}

			$filters = $_GET['filters'];

			$filters["dateFrom"] = Common::convertToMysqlDateFormat($filters["dateFrom"]);
			$filters["dateTo"] = Common::convertToMysqlDateFormat($filters["dateTo"]);

			$this->applyFilters($actionLogPeer,$filters,$smarty);
			$pager = $actionLogPeer->getAllPaginatedFiltered($_GET["page"]);
			$logs = $pager->getResult();
		}

		$url= 'Main.php?do=commonActionLogsList';
		$smarty->assign("logs",$logs);
		$smarty->assign("pager",$pager);
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		$smarty->assign("url",$url);

		return $mapping->findForwardConfig('success');
	}

}
