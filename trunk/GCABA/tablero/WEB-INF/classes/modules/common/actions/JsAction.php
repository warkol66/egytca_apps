<?php
/**
 * JsAction
 *
 * Obtiene el template que contiene codigo de JS y lo muestra su respectivo encabezado
 *
 * @package    common
 */
class JsAction extends BaseAction {

	function JsAction() {
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
			$requested = $moduleRootDir . "/WEB-INF/classes/modules/" . $_GET["module"] . "/tpl/" . ucfirst($_GET["module"]) . ucfirst($_GET["name"]) . ".js";
			$filename = realpath($requested);

			if (!file_exists($filename)) {
				$smarty->assign("errorMsg", $requested);
				$filename = "Error.tpl";
			}
		}
		else
			$filename = "Common" . ucfirst($_GET["name"]) . ".js";

		header("Expires: " . gmdate('D, d M Y H:i:s', time()+24*60*60*365) . " GMT");
		header("Content-Type: application/javascript;");

		$smarty->display($filename);
		die();
	}
}
