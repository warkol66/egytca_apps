<?php

require_once("BaseAction.php");
require_once("WorkforcePeer.php");
require_once("CircuitPeer.php");

/**
 * Funcion de Comparacion para calcular la diferencia entre dos arrays de workforces
 * @todo ver de mover a Common, se probo y no se pudo
 */
function comparator($elem1,$elem2) {

	if ($elem1->getId() == $elem2->getId()) 
		return 0;
	else 
		if ($elem1->getId() > $elem2->getId())
			return 1;
		else
			return -1;

}

class LausiWorkforcesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiWorkforcesEditAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Workforces";
		$smarty->assign("section",$section);		

    	if ( !empty($_GET["id"]) ) {
			//voy a editar un workforce
			$workforce = WorkforcePeer::get($_GET["id"]);
			$smarty->assign("workforce",$workforce);									

			//buscamos todos los circuits posibles y los actuales
			$currentCircuits = $workforce->getCircuits();
			$circuits = CircuitPeer::getAll();
			
			//dejamos que solo se asignen aquellos que no estan asignados
			$smarty->assign("circuits",array_udiff($circuits,$currentCircuits,'comparator'));
			$smarty->assign('currentCircuits',$currentCircuits);
			    	
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un workforce nuevo
			$workforce = new Workforce();
			$smarty->assign("workforce",$workforce);			
			
			//asignamos todos los circuitos posibles
			$circuits = CircuitPeer::getAll();
			$smarty->assign('circuits',$circuits);
												
			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
