<?php
/**
* DocumentsEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @package documents
*/

require_once("DocumentsBaseAction.php");
require_once("DocumentPeer.php");
require_once("CategoryPeer.php");

/**
* DocumentsEditAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsEditAction extends DocumentsBaseAction {


	/**
	* DocumentsEditAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsEditAction() {
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

		//Asignación a smarty de los parametros del módulo
		global $system;
		$smarty->assign("moduleParameters",$system["config"]["documents"]);

		$documentPeer= new DocumentPeer();
		$categoryPeer = new CategoryPeer();

		////////////
		//obtengo las categorias que el usuario puede acceder
		
		$user = Common::getAdminLogged();
		$smarty->assign('user',$user);

		$categories = $user->getDocumentsParentCategories();
		$smarty->assign("categories",$categories);

		//caso de edicion de un documento
		if (isset($_POST['id'])) {
	
			$msg=$request->getParameter("message");
			if(empty($msg)){
				$msg="noError";
			}
			$smarty->assign("message",$msg);

			// obtengo el documento seleccionado
			$id = $_POST["id"];
			$document = $documentPeer->getArchive($id);

			//password enviado desde el listado
			$password = $_POST['password'];
		
			//validacion de password
			if (!$this->documentPasswordValidation($document,$password)) {
				return $mapping->findForwardConfig('failure-edit');
			}

			$smarty->assign("document",$document);
			return $mapping->findForwardConfig('success-edit');
			
		}

		//caso de creacion de nuevo documento
		$categoryPeer = new CategoryPeer();
		
		////////////
		// $msg=0 --> no se muestra mensaje
		// $msg=1 --> se muestra mensaje de error
		// $msg=2 --> se muestra mensaje satisfactorio
		if(empty($_GET["errormessage"])){
			$msg="noError";
		}
		else $msg=$_GET["errormessage"];

		$smarty->assign("docscategory",$categoryId);

		$smarty->assign("msg",$msg);

		$smarty->assign("date",date("d-m-y"));

		return $mapping->findForwardConfig('success-upload');			

	}

}
