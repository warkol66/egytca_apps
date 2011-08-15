<?php

class MediasTypeDoDeleteAction extends BaseAction {

	function MediasTypeDoDeleteAction() {
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

		if ($_POST["doHardDelete"]) {
			if (MediaTypePeer::hardDelete($_POST["id"]))
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('failure');
		}
		else {
			if (MediaTypePeer::delete($_POST["id"]))
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('failure');
		}
	
	}

}
