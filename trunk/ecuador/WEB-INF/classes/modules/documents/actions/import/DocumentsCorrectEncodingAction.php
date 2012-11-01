<?php
/**
* DocumentsDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza  en dicha base de datos.
* 
* @package documents
*/

require_once("DocumentsBaseAction.php");
require_once("DocumentPeer.php");

class DocumentsCorrectEncodingAction extends DocumentsBaseAction {

	function DocumentsCorrectEncodingAction() {
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

		$allFiles = $documentPeer->getAll();
		foreach ($allFiles as $eachFile) {

			$extra = array();
			$extra['author'] = mb_convert_encoding($eachFile->getAuthor(), 'UTF-8', 'HTML-ENTITIES');
			$title = mb_convert_encoding($eachFile->getTitle(), 'UTF-8', 'HTML-ENTITIES');
			$realFilename = mb_convert_encoding($eachFile->getRealfilename(), 'UTF-8', 'HTML-ENTITIES');
	
			$documentPeer->updateImportedDocument($eachFile->getId(),$title,"",$eachFile->getDocumentdate(),$eachFile->getCategoryId(),"",$extra,$realFilename);
		}

	}

}
