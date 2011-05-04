<?php


/**
* DocumentsDoUploadAction
*
*  Action que genera un cambio de estado en la base de datos. con los datos
*  ingresados en DocumentsUploadAction, se inserta un nuevo archivo en dicha
*  base de datos.
* 
* @author documentacion: Marcos Meli
* @author Archivo: Marcos Meli
* @package mod_archivo
*/

require_once 'BaseAction.php';
require_once("mer/DocumentPeer.php");


/**
* DocumentsDoUploadAction
*
*  Esta clase hereda la clase BaseAction
* 
*/

class DocumentsDoUploadAction extends BaseAction {


	/**
	* DoSubirArchivoAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsDoUploadAction() {
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
		global $documentsPath;
		////////////		
		// Comparacion de las 2 contraseñas ingresadas en el formulario anterior
		if($_POST["password"]!=$_POST["password_compare"]){
			header("Location: Main.php?do=documentsUpload&errormessage=wrongPasswordComparison&id=".$_POST["category"]);
			exit;
		}

		////////////		
		// La categoría 0 es inexistente en la base de datos.
		if($_POST["category"]==0){
			header("Location: Main.php?do=documentsUpload&errormessage=wrongCategory&id=".$_POST["category"]);
			exit;
		}


		$flag=true;
		$counter=1;
	
		////////////
		// Se corta el archivo en partes
		while($flag) {
			$parts=explode('\\',$_FILES['documento']['tmp_name']);

			$real_filename=$_FILES['documento']['name'];
			
			$filecounter=count($parts);
			
			$filename=$parts[$filecounter-1];
			
			//temporalmente mientras no exista la variable global $documentsPaths, igual, si ya se ha agregado al sistema no sucede nada
			if (empty($documentsPath)){
				$documentsPath="WEB-INF/documents/";
			}

			$filenamePath=$documentsPath.$parts[$filecounter-1];

			 if(file_exists($filename))
				$counter++;
			else
				$flag=false;
		}

		////////////
		// se crea una funcion fecha con la fecha actual
		$date_doc = explode("/", $_POST["date"]);
		$date = date("Y-m-d",mktime(0,0,0,$date_doc[1],$date_doc[0],$date_doc[2]));

		////////////
		// se inserta en la base de datos todo lo ingresado en el formulario anterior y la fecha
		$documentPeer->insert($filename,$_POST["description"],$date,$_POST["category"],$real_filename,$_POST["password"]);
		

		////////////
		// se mueve el archivo a una carpeta contenedora
		move_uploaded_file($_FILES['documento']['tmp_name'],$filenamePath);
		

		header("Location: Main.php?do=documentsList&id=".$_POST["category"]);
		exit;
		}

}
?>
