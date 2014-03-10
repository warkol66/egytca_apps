<?php

class UsersAutocompleteListXAction extends BaseAction {

	function UsersAutocompleteListXAction() {
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
		$smarty->assign("module",$module);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);


		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);

		if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("adminActId" => $_REQUEST['adminActId']));
		else if ($_REQUEST['issueId'])
			$filters = array_merge_recursive($filters, array("issueId" => $_REQUEST['issueId']));
		else if ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("headlineId" => $_REQUEST['headlineId']));

		if ($_REQUEST['getCandidates'])
			$filters = array_merge_recursive($filters, array("getCandidates" => true));

		if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => IssuePeer::get($_REQUEST['adminActId'])));
		else if ($_REQUEST['issueId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => IssuePeer::get($_REQUEST['issueId'])));
		else if ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => HeadlinePeer::get($_REQUEST['headlineId'])));
		else if ($_REQUEST['campaignId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => CampaignPeer::get($_REQUEST['campaignId'])));

		$users = BaseQuery::create('User')->applyFilters($filters)->find();

		$smarty->assign("users",$users);
		$smarty->assign("limit",$_REQUEST['limit']);
		$smarty->assign("type",$_REQUEST['type']);

		return $mapping->findForwardConfig('success');
	}

}
