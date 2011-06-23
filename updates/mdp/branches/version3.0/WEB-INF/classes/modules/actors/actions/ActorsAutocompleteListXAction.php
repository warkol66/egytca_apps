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
		
		$this->template->template = "TemplateAjax.tpl";

		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$actorPeer = new ActorPeer();

		$filters = array ("searchString" => $searchString, "limit" => $_REQUEST['limit'], "adminActId" => $_REQUEST['adminActId']);
		$this->applyFilters($actorPeer,$filters);
		$actors = $actorPeer->getAll();
		
		$smarty->assign("actors",$actors);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
