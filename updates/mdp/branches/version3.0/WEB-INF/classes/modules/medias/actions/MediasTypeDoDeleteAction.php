<?php

class MediasTypeDoDeleteAction extends BaseAction {

	function MediasTypeDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$mediaType = MediaTypePeer::get($_POST["id"]);
		if (!empty($mediaType)) {
			if ($_POST["doHardDelete"])
				MediaTypePeer::disableSoftDelete();
			if ($mediaType->delete())
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('failure');
		}

	}

}
