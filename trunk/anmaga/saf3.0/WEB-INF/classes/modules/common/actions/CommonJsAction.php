<?php

class CommonJsAction extends BaseAction {

	function CommonJsAction() {
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

		//Cambio el template externo
		$this->template->template = "TemplatePlain.tpl";

		global $moduleRootDir;

		if (!empty($_GET["module"]))
			$path = $moduleRootDir . "/WEB-INF/classes/modules/" . $_GET["module"] . "/tpl/" . ucfirst($_GET["module"]) . ucfirst($_GET["name"]) . ".js";
		else
			$path = "Common" . ucfirst($_GET["name"]) . ".js";

		header("Expires: " . gmdate('D, d M Y H:i:s', time()+24*60*60*365) . " GMT");
		header("Content-Type: application/javascript;");

		$text = $smarty->display($path);

	}

}

