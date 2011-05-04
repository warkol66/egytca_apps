<?php


/**
* DocumentsDoDownloadAction
*
* Permite la descarga de documentos subidos al sistema
* 
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mer_documents
*/

require_once 'BaseAction.php';
require_once("mer/DocumentPeer.php");


/**
* DocumentsDoDownloadAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsDoDownloadAction extends BaseAction {


	/**
	* DocumentsDoDownloadAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsDoDownloadAction() {
		;
	}

	/**
	* execute
	*
	* Procesa la solicitud HTTP solicitada, y crea su respectiva respuesta HTTP o
	* bien lo manda hacia otra web en donde aqui la crea. Devuelve un 
	* "ActionForward" describiendo donde y como se debe mandar la solicitud o
	* NULL si la respuesta ha sido completada. 
	* 
	* 
	* //@param ActionConfig		El ActionConfig (mapping) usado para seleccionar los sucesos
	* //@param ActionForm			El opcional ActionForm con los contenidos de las peticiones
	* //@param HttpRequestBase	El HTTP request de lo que se esta  procesando
	* //@param HttpRequestBase	La respuesta HTTP de lo que estan creando
	* //@public
	* 
	* 
	* @param string $mapping una variable que muestra los sucesos
	* @param array $form con todo el contenido a ejecutar
	* @param pointer &$request puntero a un string de lo que se esta solicitando
	* @param pointer &$response puntero a un string de la respuesta que ha dado el servidor
	* @return ActionForward string $mapping con la cadena "sucess" o "failure"
	*
	*/

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
		
		global $moduleRootDir;
		$id= $_POST["id"];

		////////////
		// se obtiene el archivo a descargar y su nombre
		$document=$documentPeer->getArchive($id);
		$document_name=$document->getFilename();



		$password=$document->getPassword();
		////////////
		// comparador de password, se checkea el password antes de descargar el archivo
		// se muestra error si se ingresó incorrectamente
		if (!empty($password)) {
			$pass=$_POST["password"];

			$authdocument=$document->checkPassword($pass);
			if($authdocument){
		
			header("content-disposition: attachment; filename=".$document->getRealfilename());
			readfile($moduleRootDir."/WEB-INF/documents/".$document_name);
			}
			else{
				header("Location: Main.php?do=documentsList&errormessage=wrongPassword&id=".$_POST["category"]);
				exit;

			}
		}

		////////////
		// en caso de no poseer password se descarga directamente
		else{
	
		header("content-disposition: attachment; filename=".$document->getRealfilename());
		readfile($moduleRootDir."/WEB-INF/documents/".$document_name);
	}




	}

}
?>
