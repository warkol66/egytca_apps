<?php
/**
* CommonExportAction
*
* Genera un archivo descargable
*
* @package common
*/

class CommonExportAction extends BaseAction {

	function CommonExportAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

	  $content = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $_POST["content"]);
	  $fileName = $_POST["fileName"];
		$fileType = $_POST["fileType"];

	  header("Content-Disposition: attachment; filename=\"$fileName\"");

		switch ($fileType) {
			case 'xls':
			  header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
			case 'txt':
			  header("Content-type: text/html; charset=UTF-8");
			case 'xml':
				header ("content-type: text/xml; charset=utf-8");
			default:
			  header("Content-type: text/html; charset=UTF-8");
		}

	  echo $content;
	}
}
