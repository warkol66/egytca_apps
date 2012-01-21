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
		
		// backwards compatibility
		if ($_REQUEST['headlineId']) {
			$_REQUEST['entityType'] = 'Headline';
			$_REQUEST['entityId'] = $_REQUEST['headlineId'];
		} else if ($_REQUEST['issueId']) {
			$_REQUEST['ids'][] = $_REQUEST['issueId'];
		}
		
			
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);
		
		$filters = array ("searchString" => $searchString);
		
		if (!empty($_REQUEST['entityType']) && !empty($_REQUEST['entityId'])) {
			$filters = array_merge($filters, array('EntityFilter' => array(
				'entityType' => $_REQUEST['entityType'],
				'entityId' => $_REQUEST['entityId'],
				'getCandidates' => !empty($_REQUEST['getCandidates'])
			)));
		}
		
		if (is_array($_REQUEST['ids'])) {
			$filters = array_merge($filters, array('IdsFilter' => array(
				'ids' => $_REQUEST['ids'],
				'getCandidates' => !empty($_REQUEST['getCandidates'])
			)));
		}
		
		$issues = IssueQuery::create()
			->addFilters($filters)
			->limit($_REQUEST['limit'])
			->find();
		
		$smarty->assign("issues",$issues);
		$smarty->assign("limit",$_REQUEST['limit']);
		
		return $mapping->findForwardConfig('success');
	}

}
