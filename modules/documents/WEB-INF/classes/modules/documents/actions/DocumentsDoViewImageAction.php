<?php
/**
* DocumentsDoDownloadAction
*
* Permite la descarga de documentos subidos al sistema
* 
* @package documents
*/

require_once("DocumentsBaseAction.php");

class DocumentsDoViewImageAction extends DocumentsBaseAction {

	function DocumentsDoViewImageAction() {
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
		
		$id= $_REQUEST["id"];
		$document = $documentPeer->getById($id);

		$extension = strrchr(strtolower($document->getRealfilename()),'.');
		switch ($extension) {
			case ".gif":
				header('Content-Type: image/gif');
			case ".jpg":
				header('Content-Type: image/jpeg');
			case ".png":
				header('Content-Type: image/png');
		}

		$document->getContents();
	}

}