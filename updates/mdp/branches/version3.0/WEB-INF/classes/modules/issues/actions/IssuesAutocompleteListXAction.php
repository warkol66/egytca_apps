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
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$issuePeer = new IssuePeer();

		$filters = array ("searchString" => $searchString, "limit" => $_REQUEST['limit']/*, "adminActId" => $_REQUEST['adminActId']*/);
                
                if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("adminActId" => $_REQUEST['adminActId']));
                elseif ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("headlineId" => $_REQUEST['headlineId']));
                if ($_REQUEST['getCandidates'])
			$filters = array_merge_recursive($filters, array("getCandidates" => true));
                
		$this->applyFilters($issuePeer,$filters);
		$issues = $issuePeer->getAll();
		
		$smarty->assign("issues",$issues);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
