<?php
/**
* DocumentsDoDeleteAction
*
*  Action que genera un cambio de estado en la base de datos, se le manda el nombre de una categoria
*  y lo busca en dicha base de datos y finalmente lo elimina.
* 
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mer_documents
*/



require_once 'BaseAction.php';
require_once("mer/DocumentPeer.php");

/**
* DocumentsDoDeleteAction
*
*  Esta clase hereda la clase BaseAction
* 
*/
class DocumentsDoDeleteAction extends BaseAction {


	/**
	* DocumentsDoDeleteAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsDoDeleteAction() {
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

		$module = "Documentos";
		$smarty->assign("module",$module);

		$documentPeer = new DocumentPeer();


		////////////
		// se obtiene el archivo a eliminar				
		$id= $_POST["id"];
		$document=$documentPeer->getArchive($id);
		$password=$document->getPassword();


		////////////
		// comparador de password, se checkea el password antes de eliminar el archivo
		// se muestra error si se ingresó incorrectamente
		if (!empty($password)) {
			$pass=$_POST["password"];

			$authdocument=$document->checkPassword($pass);

			if($authdocument){
				$documentPeer->delete($_POST["id"]);
				header("Location: Main.php?do=documentsList&errormessage=noError&id=".$_POST["category"]);
				exit;
			}
			else{
				header("Location: Main.php?do=documentsList&errormessage=wrongPassword&id=".$_POST["category"]);
				exit;

			}
		}

		////////////
		// en caso de no poseer password se elimina directamente
		else{
				$documentPeer->delete($_POST["id"]);
				header("Location: Main.php?do=documentsList&errormessage=noError&id=".$_POST["category"]);
				exit;
		}

		return $mapping->findForwardConfig('success');





	}

}
?>
