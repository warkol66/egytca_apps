<?php


/**
* DocumentsListAction
*
*  Action utilizado para mostrar los documentos existentes dentro de una categoría
* 
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mer_documents
*/

require_once 'BaseAction.php';
require_once("mer/DocumentPeer.php");



/**
* DocumentsListAction
*
*  Esta clase hereda la clase BaseAction
* 
*/
class DocumentsListAction extends BaseAction {

	/**
	* DocumentsListAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsListAction() {
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

		$documents = new DocumentPeer();


		////////////	   
	    // obtengo los documentos de la categoría seleccionada
	    $docs = $documents->getDocumentsType($_GET["id"]);
	    $docsCategory=$_GET["id"];

		////////////
		// $msg=0 --> no se muestra mensaje
		// $msg=1 --> se muestra mensaje de error
		// $msg=2 --> se muestra mensaje satisfactorio
		if(empty($_GET["errormessage"])){
			$msg="noError";
		}
		else $msg=$_GET["errormessage"];


		////////////
		// se asignan las variables trabajadas
		$smarty->assign("message",$msg);
		$smarty->assign("documents",$docs);
		$smarty->assign("docscategory",$docsCategory);

		return $mapping->findForwardConfig('success');

	}

}
?>
