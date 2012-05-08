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

/**
* DocumentsDoEditAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsDoEditAction extends DocumentsBaseAction {

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
	 * Setea las variables de smarty necesarias para volver al edit si se 
	 * produce un error.
	 * @param Document instancia de Document
	 */
	function failureSmartySetup($smarty,$document) {
		
		require_once('CategoryPeer.php');
		
		//obtengo las categorias que el usuario puede acceder	
		$user = Common::getAdminLogged();
		$smarty->assign('user',$user);
		$categories = $user->getDocumentsParentCategories();
		$smarty->assign("categories",$categories);
		
		$smarty->assign('document',$document);
		
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
		
		//caso de edicion
		if ($_POST['id']) {
		
			$id = $_POST["id"];
			$document = $documentPeer->getArchive($id);

			$password = $_POST["old_password"];
			
			//validacion de password
			if (!$this->documentPasswordValidation($document,$password)) {

				$this->failureSmartySetup($smarty,$document);
				$smarty->assign('message','wrongPassword');
				return $mapping->findForwardConfig('failure');

			}
			
			//validamos el nuevo password y su verificacion
			if($_POST["password"]!=$_POST["password_compare"]) {
				$this->failureSmartySetup($smarty,$document);
				$smarty->assign('message','wrongPasswordComparison');
				return $mapping->findForwardConfig('failure');

			}

			
			if (!($_FILES['document']['name'] == '')) {
				$documentPeer->updateDocument($_POST["id"],$_POST['title'],$_POST["description"],Common::convertToMysqlDateFormat($_POST["date"]),$_POST["category"],$_POST["password"],$_FILES['document']);
			}
			else {
				$documentPeer->updateDocument($_POST["id"],$_POST['title'],$_POST["description"],Common::convertToMysqlDateFormat($_POST["date"]),$_POST["category"],$_POST["password"]);
			}	

			return $mapping->findForwardConfig('success-edit');

		}
		else {
			//caso de upload o creacion de nuevo documento
			
			$documentPeer = new DocumentPeer();

			if($_POST["password"]!=$_POST["password_compare"]){
				return $mapping->findForwardConfig('failure-upload-password');
			}		

			////////////
			// se inserta en la base de datos todo lo ingresado en el formulario anterior y la fecha
				$documentPeer->create($_FILES['document'],$_POST['title'],$_POST["description"],Common::convertToMysqlDateFormat($_POST['date']),$_POST["category"],$_POST["password"]);

			return $mapping->findForwardConfig('success-upload');
			
		}
		
	}

}
