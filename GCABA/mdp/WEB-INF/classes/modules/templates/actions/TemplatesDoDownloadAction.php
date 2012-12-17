<?php
/**
* TemplatesDoDownloadAction
*
* Permite la descarga de documentos subidos al sistema
*
* @package templates
*/

class TemplatesDoDownloadAction extends BaseAction {

	function TemplatesDoDownloadAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $_REQUEST["id"];
		$template = TemplateQuery::create()->findOneById($id);
		if (empty($template))
			$template = new Template();

		ob_end_clean();

		header('Pragma: public');   // required
		header('Expires: 0');       // no cache
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);

		$extension = substr(strrchr(strtolower($template->getRealfilename()),'.'),1);
		switch ($extension) {
			case "gif":
				header('Content-Type: image/gif');
				break;
			case "jpg":
				header('Content-Type: image/jpeg');
				break;
			case "png":
				header('Content-Type: image/png');
				break;
			case "pdf":
				header('Content-type: application/pdf');
				break;
			case "htm":
				header('Content-Type: text/html',true);
				break;
			case "html":
				header('Content-Type: text/html',true);
				break;
			default:
				header('Content-Type: application',true);
				break;
		}

		if (!$_REQUEST["view"])
			header("content-disposition: attachment; filename=\"" . str_replace('"',"'",$template->getRealfilename()) . "\"");
		else
			header("content-disposition: inline; filename=\"" . str_replace('"',"'",$template->getRealfilename()) . "\"");

		if ($template->getSize() != 0)
			header("Content-Length: " . $template->getSize());

		$template->getContents();
	}

}