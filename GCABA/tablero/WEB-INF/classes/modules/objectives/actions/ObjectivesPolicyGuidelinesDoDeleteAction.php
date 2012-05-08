<?php

class ObjectivesPolicyGuidelinesDoDeleteAction extends BaseAction {

	function ObjectivesPolicyGuidelinesDoDeleteAction() {
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

		$module = "Objectives";

		$result = PolicyGuidelinePeer::delete($_POST["id"]);
    		
		if ($result)
		return $mapping->findForwardConfig('success');
		else
		return $mapping->findForwardConfig('failure');

	}

}
