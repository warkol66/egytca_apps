<?php

class ServicesMultilangLanguagesDoDeleteAction extends BaseAction {

	function ServicesMultilangLanguagesDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$modulo = "Services";
		MultilangLanguagePeer::delete($_POST["id"]);
		return $mapping->findForwardConfig('success');

	}

}

