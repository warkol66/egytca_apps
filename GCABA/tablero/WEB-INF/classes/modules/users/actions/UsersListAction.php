<?php

class UsersListAction extends BaseAction {

	function UsersListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		$section = "Users";
		
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$page = $_GET["page"];
		$smarty->assign("page",$page);

		$userPeer = new UserPeer();

		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($userPeer,$filters,$smarty);
		}
        
//        $filters = !empty($_GET['filters']) ? $_GET['filters'] : array();
//        $pager = BaseQuery::create("User#special")->createPager($filters);

		$pager = $userPeer->getAllPaginatedFiltered($page);
		$smarty->assign("users",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=usersList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);


		$inactiveUsers = UserPeer::getInactives();
		$smarty->assign("inactiveUsers",$inactiveUsers);

    $smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
