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

/**
* DocumentsDoDownloadAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsDoDownloadAction extends DocumentsBaseAction {


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
		$id= $_REQUEST["id"];

		////////////
		// se obtiene el archivo a descargar y su nombre
		$document = $documentPeer->getArchive($id);

		$password=$_POST['password'];

		//validacion de password
		if (!$this->documentPasswordValidation($document,$password)) {
			return $mapping->findForwardConfig('failure');
		}

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("content-disposition: attachment; filename=\"".utf8_decode($document->getRealfilename())."\"");
		$document->getContents();
	}

}
