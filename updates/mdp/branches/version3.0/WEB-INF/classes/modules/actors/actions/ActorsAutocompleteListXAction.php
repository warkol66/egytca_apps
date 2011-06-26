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
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);


		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);

		if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("adminActId" => $_REQUEST['adminActId']));
		elseif ($_REQUEST['issueId'])
			$filters = array_merge_recursive($filters, array("issueId" => $_REQUEST['issueId']));
		elseif ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("headlineId" => $_REQUEST['headlineId']));
		if ($_REQUEST['getCandidates'])
			$filters = array_merge_recursive($filters, array("getCandidates" => true));

		$actorPeer = new ActorPeer();
		$this->applyFilters($actorPeer,$filters);
		$actors = $actorPeer->getAll();
		
		$smarty->assign("actors",$actors);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
