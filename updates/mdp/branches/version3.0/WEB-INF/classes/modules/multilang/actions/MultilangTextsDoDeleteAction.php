<?php

class MultilangTextsDoDeleteAction extends BaseAction {

	function MultilangTextsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$modulo = "Multilang";

		MultilangTextPeer::deleteByIdAndModuleName($_POST["id"],$_POST["moduleName"]);

		header("Location: Main.php?do=multilangTextsList&moduleName=".$_POST["moduleName"]."&page=".$_POST["currentPage"]);
		exit;

		return $mapping->findForwardConfig('success');

	}

}
