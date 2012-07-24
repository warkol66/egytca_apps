<?php

class MultilangLanguagesDoDeleteAction extends BaseAction {

	function MultilangLanguagesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$modulo = "MultilangLanguages";
		MultilangLanguagePeer::delete($_POST["id"]);
		return $mapping->findForwardConfig('success');
	}

}

