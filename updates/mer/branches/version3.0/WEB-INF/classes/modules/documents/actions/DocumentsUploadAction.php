<?php


/**
* DocumentsUploadAction
*
*  Action utilizado para mostrar los datos a completar para la insersión
*  de un archivo en la base de datos y en el host, a su vez da la posibilidad de
*  buscar ese archivo en un disco local
* 
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mer_documents
*/

require_once 'BaseAction.php';
require_once("mer/CategoryPeer.php");


/**
* DocumentsUploadAction
*
*  Esta clase hereda la clase BaseAction
* 
*/
class DocumentsUploadAction extends BaseAction {

	/**
	* DocumentsUploadAction
	*
	*  Constructor por defecto
	*
	*/


	function DocumentsUploadAction() {
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

		$categoryPeer = new CategoryPeer();
		
		////////////
		//obtengo las categorias que el usuario puede acceder	
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);

		////////////
		// $msg=0 --> no se muestra mensaje
		// $msg=1 --> se muestra mensaje de error
		// $msg=2 --> se muestra mensaje satisfactorio
		if(empty($_GET["errormessage"])){
			$msg="noError";
		}
		else $msg=$_GET["errormessage"];

		////////////
		// Se selecciona por default el id de categoria 0 en caso de no haber id
		if (empty($_GET["id"]))
			$categoryId=0;
		else $categoryId=$_GET["id"];

		$smarty->assign("docscategory",$categoryId);
		
		$smarty->assign("msg",$msg);

		$smarty->assign("date",date("d/m/y"));


		return $mapping->findForwardConfig('success');

	}

}
?>