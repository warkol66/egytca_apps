<?php


require_once("BaseAction.php");
require_once("mer/SecurityActionPeer.php");
require_once("mer/GroupPeer.php");
require_once("mer/GroupCategoryPeer.php");


/**
* Implementation of <strong>Action</strong> that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class SecurityActionDoLoadAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityActionDoLoadAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
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

		//asigno modulo y seccion
		$modulo = "Security";
		$section = "action list";

		$smarty->assign("modulo",$modulo);
		$smarty->assign("section",$section);

		//contiene los modulos
		$modulos=$_POST["modulo"];

		//contiene los numeros de acceso
		$accesses=$_POST["access"];

		//contiene los actions activos
		$activoaction=$_POST["activoaction"];

		//contiene los pares Do
		$pareAction=$_POST["pare"];

		// por cada action activo traido de la vista...
		foreach ($_POST["action"] as $action) {
			if($activoaction[$action]) {

				if (empty($accesses[$action]))
					$accesses[$action] = 1;

				if($pareAction[$action]) {
					$pare=$pareAction[$action];
					SecurityActionPeer::addAction($pare,$modulos[$action],$accesses[$action]);
				}

				SecurityActionPeer::addAction($action,$modulos[$action],$accesses[$action]);
			}	else	{
				if($pareAction[$action]) {
					$pare=$pareAction[$action];
					SecurityActionPeer::delete($pare);
				}

				SecurityActionPeer::delete($action);
			}


		}

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');



	}

}
?>
