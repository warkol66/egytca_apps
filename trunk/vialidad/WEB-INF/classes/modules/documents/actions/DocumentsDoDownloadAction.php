<?php
/**
* DocumentsDoDownloadAction
*
* Permite la descarga de documentos subidos al sistema
*
* @package documents
*/

class DocumentsDoDownloadAction extends BaseAction {

	function DocumentsDoDownloadAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);

		$documentPeer = new DocumentPeer();

		$id = $_REQUEST["id"];
		$document = $documentPeer->getById($id);
		if (empty($document))
			$document = new Document();

		//validacion de password
		//desactualizado y no debería chequear pwd si el doc no tiene
		/*$password = $_POST['password'];
		if (!$document->checkPassword($password))
			return $mapping->findForwardConfig('failure');*/

		ob_end_clean();

		header('Pragma: public');   // required
		header('Expires: 0');       // no cache
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);

		$extension = substr(strrchr(strtolower($document->getRealfilename()),'.'),1);
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
			header("content-disposition: attachment; filename=\"" . str_replace('"',"'",$document->getRealfilename()) . "\"");
		else
			header("content-disposition: inline; filename=\"" . str_replace('"',"'",$document->getRealfilename()) . "\"");

		if ($document->getSize() != 0)
			header("Content-Length: " . $document->getSize());

		$document->getContents();
	}

}