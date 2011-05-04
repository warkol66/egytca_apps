<?php
/**
* DocumentsDoEditAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza  en dicha base de datos.
* 
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mer_documents
*/


require_once 'BaseAction.php';
require_once("mer/DocumentPeer.php");


/**
* DocumentsDoEditAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsDoEditAction extends BaseAction {


	/**
	* DocumentsDoEditAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsDoEditAction() {
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

		
		
		////////////		
		// obtengo el documento seleccionado
		$id= $_POST["id"];
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
			$pass=$_POST["old_password"];
			if(empty($pass) && empty($_POST["password"])){
				$documentPeer->updateDocumentWithoutPass($_POST["id"],$_POST["description"],$_POST["document_date"],$_POST["category"]);
						header("Location: Main.php?do=documentsList&id=".$_POST["category"]);
		exit;

			}

			$authdocument=$document->checkPassword($pass);

			if($authdocument){


					////////////
					// filtro de seguridad de password
					if($_POST["password"]!=$_POST["password_compare"]){
									//$msg1= las contraseñas se han ingresado incorrectamente
									$msg="wrongPasswordComparison";
									$smarty->assign("msg",$msg);
									$smarty->assign("id",$id);
									$smarty->assign("document",$document);

									$categoryPeer = new CategoryPeer();

									$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
									$smarty->assign("categories",$categories);

									return $mapping->findForwardConfig('failure');
					}
				
					////////////
					// filtro de seguridad 	
					if($_SESSION["authenticate_document"]==$_POST["id"]){
					
					////////////
					// se envian todos los datos necesarios y se actualiza el documento
					$documentPeer->updateDocument($_POST["id"],$_POST["description"],$_POST["document_date"],$_POST["category"],$_POST["password"]);
				
					header("Location: Main.php?do=documentsList&id=".$_POST["category"]);
					exit;

					}

			}
			else {
				//$msg2= ha ingresado la contraseña actual incorrectamente
				$msg="wrongPassword";
				$smarty->assign("message",$msg);
				$smarty->assign("id",$id);
				$smarty->assign("document",$document);

				$categoryPeer = new CategoryPeer();

				$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
				$smarty->assign("categories",$categories);

						return $mapping->findForwardConfig('failure');

			}
		}
		else {
				////////////
				// se envian todos los datos necesarios y se actualiza el documento
				$documentPeer->updateDocument($_POST["id"],$_POST["description"],$_POST["document_date"],$_POST["category"],$_POST["password"]);
			
		header("Location: Main.php?do=documentsList&id=".$_POST["category"]);
		exit;

		}

		

	}

}
?>
