<?php

class IssuesAutocompleteListXAction extends BaseAction {

	function IssuesAutocompleteListXAction() {
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

		$module = "Issues";
		
		$smarty->assign("module",$module);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$filters = array ("searchString" => $searchString, "limit" => $_REQUEST['limit']);
                
		if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("adminActId" => $_REQUEST['adminActId']));
		else if ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("headlineId" => $_REQUEST['headlineId']));
		else if ($_REQUEST['issueId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => IssuePeer::get($_REQUEST['issueId'])));

		if ($_REQUEST['getCandidates'])
			$filters = array_merge_recursive($filters, array("getCandidates" => true));
                
		$issuePeer = new IssuePeer();
		$this->applyFilters($issuePeer,$filters);
		$issues = $issuePeer->getAll();
		
		$smarty->assign("issues",$issues);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
