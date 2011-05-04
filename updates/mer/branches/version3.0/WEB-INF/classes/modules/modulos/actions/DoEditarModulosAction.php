<?php
/**
* Editar Modulos Action
* 
* Utilizada para obtener administrar las opciones de los Módulos.
* @author Modulos Empresarios / Egytca
* @package mod_modulos
*/

/**
* Includes
*/
require_once 'Action.php';
require_once 'BaseAction.php';
require_once("Modulos.class.php");
require_once("includes/common.inc.php");
require_once("includes/DBConnection.inc.php");

/**
* DoEditarModulosAction
*
* Utilizada para obtener administrar las opciones de los Módulos.
* Esta clase hereda la clase BaseAction
* @package mod_modulos
* @public
*/
class DoEditarModulosAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function DoEditarModulosAction() {
		;
	}


	// ----- Métodos Públicos ------------------------------------------------- //

	/**
	* execute
	*
	* Procesa la solicitud HTTP específica, y crea su respectiva respuesta HTTP
	* ( o bien lo redirecciona hacia otro componente que la creará).
	* Devuelve un <code>ActionForward</code> describiendo donde y como se debe 
	* redireccionar la solicitud o <code>NULL</code> si la respuesta ha sido
	* completada. 
	* 
	* @param string			$mapping una variable que muestra los sucesos
	* @param array			$form con todo el contenido a ejecutar
	* @param pointer		&$request puntero a un string de lo que se esta solicitando
	* @param pointer		&$response puntero a un string de la respuesta que ha dado el servidor
	* @return ActionForward
	* @public
	*/

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$modulo = "Módulos";

		$smarty->assign("MODULO",$modulo); 

		//////////
		// Guarda en modulopost el resultado del _POST
	  $modulospost = $_POST['activo'];

    $modulos = new Modulos();

		//////////
		// Solicito todos los módulos y los guardo en $allmodulos
    $allmodulos = $modulos->getModulos();

		//////////
		// Se guarda en arraydiff la diferencia de arrays entre todos los módulos y los recibidos por POST
		$arraydiff = array_diff_assoc( $modulospost , $allmodulos );

		//////////
		// Se desactivan todos los módulos
		foreach($allmodulos as $eachmodulo)
		{
			$modulos->desactivaModulo($eachmodulo['id']);
		}

		//////////
		// Se activan los modulos enviados por el POST obtenidos de la diferencia de Arrays
		foreach($arraydiff as $eachmodulo)
		{
	   	$modulos->activaModulo($eachmodulo);
		}

		//////////
		// Se guarda la acción realizada
    loguear($_SESSION['id_usuario']);

		//////////
		// Solicito los modulos activos y los guardo en la sesión
    $datos = $modulos->getModulosActivos();

    $_SESSION['modulosactivos'] = $datos;

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');

	}

} // end of class
?>
