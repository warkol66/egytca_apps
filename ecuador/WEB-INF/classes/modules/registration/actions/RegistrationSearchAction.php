<?php

class RegistrationSearchAction extends BaseAction {

	function RegistrationSearchAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";
		$smarty->assign('module',$module);

		$registrationUserPeer = new RegistrationUserPeer();

		if (!empty($_GET['searchString'])) {

			$smarty->assign('searchString',$_GET['searchString']);

			$registrationUserPeer->setSearchString($_GET['searchString']);

			$searchStringParams = "&searchString=".$_GET['searchString'];

			$smarty->assign('filters',$_GET['filters']);

			$pager = $registrationUserPeer->getAllPaginatedFiltered($_GET["page"]);
			$smarty->assign("users",$pager->getResult());
			$smarty->assign("pager",$pager);
			$url = "Main.php?do=RegistrationSearch".$searchStringParams;

			$perPage = 	RegistrationUserPeer::getRowsPerPage();
			if ($_GET['page'] > 1 )
				$pageCount = $_GET['page'] - 1;
			else
				$pageCount = 0;

			$fromRecord = ($perPage * $pageCount) + 1;
			$toRecord = $perPage + ($perPage * $pageCount);

			if ($toRecord > $pager->getTotalRecordCount())
				$toRecord = $pager->getTotalRecordCount();

			$smarty->assign("fromRecord",$fromRecord);
			$smarty->assign("toRecord",$toRecord);

			$smarty->assign("url",$url);

		}

		return $mapping->findForwardConfig('success');


	}

}