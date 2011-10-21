<?php
/**
* DocumentsDoDownloadAction
*
* Permite la descarga de documentos subidos al sistema
*
* @package documents
*/

class DocumentsDoViewAction extends BaseAction {

	function DocumentsDoViewAction() {
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
/**
		//validacion de password
		$password = $_POST['password'];
		if (!$document->checkPasswordValidation($password))
			return $mapping->findForwardConfig('failure');
*/
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
			case "txt":
				header('Content-Type: text/plain');
				break;
			default:
				header('Content-Type: application/force-download', true);
				header("Content-Disposition: attachment; filename=\"".$document->getRealfilename()."\";" ); 
				break;
		}

		if ($document->getSize() != 0)
			header("Content-Length: " . $document->getSize() ."; ");

		$document->getContents();
	}

}