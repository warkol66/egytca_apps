<?php

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



class LausiCircuitsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiCircuitsEditAction() {
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
		$section = "Circuits";
		$smarty->assign("section",$section);		

    	if ( !empty($_GET["id"]) ) {
			//voy a editar un circuit
			$circuit = CircuitPeer::get($_GET["id"]);
			
			//buscamos todos los workforces posibles y los actuales
			$currentWorkforces = $circuit->getWorkforces();
			$workforcesCandidates = WorkforcePeer::getCircuitCandidates($circuit);
			
			//dejamos que solo se asignen aquellos que no estan asignados
			$smarty->assign("workforces",$workforcesCandidates);
			$smarty->assign('currentWorkforces',$currentWorkforces);
			
	    $smarty->assign("action","edit");
		}
		else {
			//voy a crear un circuit nuevo
			$circuit = new Circuit();
						
			$smarty->assign("action","create");
		}
		
		//Esto es para dibujar los demas circuitos como referencia
		$smarty->assign("circuits",CircuitPeer::getAll());
		
		$smarty->assign("circuit",$circuit);
		
		$circuitPoints = $circuit->getCircuitPoints();
		$smarty->assign("circuitPoints",$circuitPoints);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
