<?php

class HtmlsListAction extends BaseAction {

	function HtmlsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = 'HTMLS';
		$smarty->assign("module",$module);

		$templatePath = "WEB-INF/tpl/";
		$directoryHandler = opendir($templatePath);
		$htmlFiles = array();

		while (false !== ($fileName = readdir($directoryHandler))) {
			if (is_file($templatePath . $fileName) && (strpos($fileName, "htmls_") === 0)) {
				$name = substr($fileName,6,-4);
				if (substr($name,-8,8) == "external")
					$external = true;
				else
					$external = false;
				array_push($htmlFiles, array("fileName" => $fileName, "name" => $name, "external" => $external ));
			}
		}

		$smarty->assign("htmlFiles",$htmlFiles);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');

	}

}
