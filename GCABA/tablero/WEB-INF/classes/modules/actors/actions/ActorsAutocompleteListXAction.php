<?php

class ActorsAutocompleteListXAction extends BaseAction {

	function ActorsAutocompleteListXAction() {
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

		$module = "Actors";		
		$smarty->assign("module",$module);
		
		// backwards compatibility
		if ($_REQUEST['issueId']) {
			$_REQUEST['entityType'] = 'Issue';
			$_REQUEST['entityId'] = $_REQUEST['issueId'];
		}  else if ($_REQUEST['headlineId']) {
			$_REQUEST['entityType'] = 'Headline';
			$_REQUEST['entityId'] = $_REQUEST['headlineId'];
		} else if ($_REQUEST['actorId']) {
			$_REQUEST['ids'][] = $_REQUEST['actorId'];
		} else if ($_REQUEST['campaignId']) {
			$_REQUEST['entityType'] = 'Campaign';
			$_REQUEST['entityId'] = $_REQUEST['campaignId'];
		}
		
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$filters = array("searchString" => $searchString);
		
		if (!empty($_REQUEST['entityType']) && !empty($_REQUEST['entityId']) && $_REQUEST['entityType'] != 'Campaign') {
			
			$filters = array_merge($filters, array('EntityFilter' => array(
				'entityType' => $_REQUEST['entityType'],
				'entityId' => $_REQUEST['entityId'],
				'getCandidates' => !empty($_REQUEST['getCandidates'])
			)));
		} else {
			// este es un caso raro por cómo es la relación
			$filters = array_merge($filters, array('CampaignId' => array(
				'id' => $_REQUEST['campaignId'],
				'getCandidates' => !empty($_REQUEST['getCandidates'])
			)));
		}
		
		if (is_array($_REQUEST['ids'])) {
			$filters = array_merge($filters, array('IdsFilter' => array(
				'ids' => $_REQUEST['ids'],
				'getCandidates' => !empty($_REQUEST['getCandidates'])
			)));
		}
		
		$actors = ActorQuery::create()
			->addFilters($filters)
			->limit($_REQUEST['limit'])
			->find();
		
		$smarty->assign("actors",$actors);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
