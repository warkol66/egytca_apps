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

		$smarty->assign("users", BaseQuery::create("User")->find());

		$modulePeer = new ModulePeer();
		$modules = $modulePeer->getAllActive();
		$smarty->assign("modules", BaseQuery::create("Module")->find());

		$smarty->assign("message",$_GET["message"]);

		if (class_exists("AffiliateQuery")) {
			$smarty->assign("affiliates", BaseQuery::create("Affiliate")->find());

			if (class_exists("AffiliateUserQuery"))
				$smarty->assign("affiliatesUsers", BaseQuery::create("AffiliateUser")->find());

		}
		if (class_exists("ClientQuery")) {
			$smarty->assign("clients", BaseQuery::create("Client")->find());

			if (class_exists("ClientUserQuery"))
				$smarty->assign("clientUsers", BaseQuery::create("ClientUser")->find());

		}

		$actionLogPeer = new ActionLogPeer();
		
		if (!empty($_GET['filters'])) {
			if (empty($_GET['filters']['dateFrom']) && empty($_GET['filters']['dateTo'])) {
				$_GET['filters']["dateFrom"] = date('d-m-Y',mktime(0,0,0,date("m")-1,date("d"),date("Y")));
				$_GET['filters']["dateTo"] = date('d-m-Y');
			}

			$filters = $_GET['filters'];

			$filters["dateFrom"] = Common::convertToMysqlDateFormat($filters["dateFrom"]);
			$filters["dateTo"] = Common::convertToMysqlDateFormat($filters["dateTo"]);

			$pager = BaseQuery::create("ActionLog")->createPager($filters, $_GET["page"], $perPage);

			$url= 'Main.php?do=commonActionLogsList';
			$smarty->assign("actionLogColl", $pager->getResults());
			$smarty->assign("pager",$pager);
			foreach ($filters as $key => $value)
				$url .= "&filters[$key]=$value";
			$smarty->assign("url",$url);
			if (isset($_GET['page']))
				$url .= '&page=' . $_GET['page'];
			$smarty->assign("url",$url);
		}

		return $mapping->findForwardConfig('success');
	}

}