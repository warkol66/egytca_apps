<?php
/**
* DocumentsDoDownloadAction
*
* Permite la descarga de documentos subidos al sistema
* 
* @package documents
*/

require_once("DocumentsBaseAction.php");
require_once("DocumentPeer.php");

class DocumentsDoDownloadAction extends DocumentsBaseAction {

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
		
		$id= $_REQUEST["id"];
		$document = $documentPeer->getById($id);

		$password=$_POST['password'];

		//validacion de password
		if (!$this->documentPasswordValidation($document,$password)) {
			return $mapping->findForwardConfig('failure');
		}

		header('Pragma: public');   // required  
    header('Expires: 0');       // no cache  
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');  
    header('Cache-Control: private',false); 		

		$extension = strrchr(strtolower($document->getRealfilename(),'.'));
		switch ($extension) {
			case ".gif":
				header('Content-Type: image/gif');
			case ".jpg":
				header('Content-Type: image/jpeg');
			case ".png":
				header('Content-Type: image/png');
		}

    header("content-disposition: attachment; filename=\"" . str_replace('"',"'",$document->getRealfilename()) . "\"");

		if ($document->getSize() != 0)
			header("Content-Length: " . $document->getSize() ."; "); 

		$document->getContents();
	}

}