<?php

class CommonJsAction extends BaseAction {

	function CommonJsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//Cambio el template externo
		$this->template->template = "TemplateAjax.tpl";

		global $moduleRootDir;

		if (!empty($_GET["module"])) {
			$filename = realpath($moduleRootDir . "/WEB-INF/classes/modules/" . $_GET["module"] . "/tpl/" . ucfirst($_GET["module"]) . ucfirst($_GET["name"]) . ".js");

			if (!file_exists($filename))
				die;
		}
		else
			$filename = "Common" . ucfirst($_GET["name"]) . ".js";

		header("Expires: " . gmdate('D, d M Y H:i:s', time()+24*60*60*365) . " GMT");
		header("Content-Type: application/javascript;");

		$smarty->display($filename);
	}
}
