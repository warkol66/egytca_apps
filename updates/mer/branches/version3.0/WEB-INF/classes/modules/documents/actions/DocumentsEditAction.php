<?php

/**
* DocumentsEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mer_documents
*/

require_once 'BaseAction.php';
require_once("mer/DocumentPeer.php");


/**
* DocumentsEditAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsEditAction extends BaseAction {


	/**
	* DocumentsEditAction
	*
	*  Constructor por defecto
	*
	*/

	function ViewFileAction() {
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


		$documentPeer= new DocumentPeer();

		$categoryPeer = new CategoryPeer();
		

		$msg=$request->getParameter("message");
		if(empty($msg)){
			$msg="noError";
		}
		$smarty->assign("message",$msg);

		////////////			
		//obtengo las categorias que el usuario puede acceder	
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);


		////////////		
		// obtengo el documento seleccionado
		//$id= $_POST["id"];
		$id=$request->getParameter("id");

		$document=$documentPeer->getArchive($id);


		////////////
		// le paso a una variable el password de dicho documento
		$password=$document->getPassword();


		////////////
		// si existe la variable password, la comparo con el password ingresado en el action anterior (el de lista)
		// y si son equivalentes, muestro los datos del documento.
		// De no ser equivalentes, muestro un mensaje de error.
		// Por seguridad, se agrega una variable en sesion llamada authenticate_document con el id del documento que se está editando.

		if (!empty($password)) {
			$pass=$_POST["password"];
			//$authdocument=$documentPeer->checkPassword($id,$pass);

			$authdocument=$document->checkPassword($pass);

			
			if($authdocument){
				$_SESSION["authenticate_document"]=$document->getId();
				$smarty->assign("document",$document);
			}

			else{
				header("Location: Main.php?do=documentsList&errormessage=wrongPassword&id=".$_POST["category"]);
				exit;
			}

		}





		////////////
		// si no existe la variable password, simplemente muestro los datos y cargo la variable authenticate_document.
		else{
				$_SESSION["authenticate_document"]=$document->getId();
				$smarty->assign("document",$document);
		}



		return $mapping->findForwardConfig('success');

	}

}
?>
