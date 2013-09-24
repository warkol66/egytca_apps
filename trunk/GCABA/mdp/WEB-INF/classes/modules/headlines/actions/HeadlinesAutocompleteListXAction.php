<?php

class HeadlinesAutocompleteListXAction extends BaseAction {

	function HeadlinesAutocompleteListXAction() {
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

		$module = "Headlines";		
		$smarty->assign("module",$module);

		
		// backwards compatibility
		if ($_REQUEST['issueId']) {
			$_REQUEST['entityType'] = 'Issue';
			$_REQUEST['entityId'] = $_REQUEST['issueId'];
		}  else if ($_REQUEST['actorId']) {
			$_REQUEST['entityType'] = 'Actor';
			$_REQUEST['entityId'] = $_REQUEST['actorId'];
		} else if ($_REQUEST['headlineId']) {
			$_REQUEST['ids'][] = $_REQUEST['headlineId'];
		}
		
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);
		
		$processed = $_REQUEST['processed'];

		$filters = array(
			"searchString" => $searchString,
			"processed" => $processed
		);
		
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

        $headlines = BaseQuery::create('Headline')
			->addFilters($filters)
			->limit($_REQUEST['limit'])
			->find();
		
		$smarty->assign("relations",$headlines);
		$smarty->assign("limit",$_REQUEST['limit']);
                
		return $mapping->findForwardConfig('success');
	}

}
