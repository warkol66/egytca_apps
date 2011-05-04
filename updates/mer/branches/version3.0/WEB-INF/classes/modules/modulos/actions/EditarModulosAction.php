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
* EditarModulosAction
*
* Utilizada para obtener administrar las opciones de los Módulos.
* Esta clase hereda la clase BaseAction
* @package mod_modulos
* @public
*/
class EditarModulosAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function EditarModulosAction() {
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
		if($smarty == NULL) 
		{
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$modulo = "Módulos";

		$smarty->assign("MODULO",$modulo); 

    $modulos = new Modulos();

    $datos = $modulos->getModulos();

    $smarty->assign("MODULOS",$datos);

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');

	}

} // end of class
?>
