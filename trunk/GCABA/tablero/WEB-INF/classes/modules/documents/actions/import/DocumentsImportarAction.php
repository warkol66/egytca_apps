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

class DocumentsImportarAction extends DocumentsBaseAction {

	function DocumentsImportarAction() {
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

		require_once('config/DBConnection.inc.php');


			$db = new DBConnection();

			$result = array();

			$query = "SELECT * FROM bv_contenido";
			$db->query($query);
			$result = $db->recordset2Array();

			foreach ($result as $record) {
			//caso de upload o creacion de nuevo documento
			
			$documentPeer = new DocumentPeer();

			$extra = array();
			$extra['author'] = utf8_encode($record['autores']);
			$record['extra'] = $extra;
			$record['category'] = $record['idbv_subseccion']+10;
			
			$record['date'] = $record['anio']."-".$record['mes']."-01";
			$record["nombre"] = utf8_encode(ltrim($record["nombre"]));
			$record["extra"]["keyWords"] = utf8_encode($record["realFilename"]);
			
			////////////
			// se inserta en la base de datos todo lo ingresado en el formulario anterior y la fecha
			$documentPeer->create($record['documento'],$record["nombre"],$record['archivo'],$record['date'],$record["category"],$record["password"],$record["extra"]);
	// DocumentPeer function create($file,$title,$description,$date,$categoryId,$password,$extra) {

		}
		$moduleConfig = Common::getModuleConfiguration('Documents');
		$documentsPath = $moduleConfig['documentsPath'];
		echo $documentsPath."<br />";
		$allFiles = $documentPeer->getAll();
		foreach ($allFiles as $eachFile) {
			echo $eachFile->getDescription()."<br />";
			copy("publicaciones/".$eachFile->getDescription(),$documentsPath."/".$eachFile->getId());
			$extra = array();
			$extra['author'] = $eachFile->getAuthor();
			$extra['keyWords'] = "";
			
			if ($eachFile->getKeyWords() != '')
				$title = $eachFile->getKeyWords();
			else
				$title = $eachFile->getTitle();

		$extension = substr($eachFile->getKeyWords(),(strrpos($eachFile->getKeyWords(),".")));
			if ($extension == ".pdf" || $extension == ".htm" || $extension == ".html" || $extension == ".doc" || $extension == ".zip"){
					$realFilename = $eachFile->getKeyWords();
					$title = substr($title,0,strrpos($title,"."));
				}
			else
					$realFilename = $eachFile->getTitle().substr($eachFile->getDescription(),(strrpos($eachFile->getDescription(),".")));
		$documentPeer->updateImportedDocument($eachFile->getId(),$title,"",$eachFile->getDocumentdate(),$eachFile->getCategoryId(),"",$extra,$realFilename);
	// DocumentPeer function updateDocument($id,$title,$description,$document_date,$category,$password,$extra,$file)
		}

	}

}
