<?php

require_once("BaseAction.php");
require_once("WorkforcePeer.php");
require_once("WorkforceCircuitPeer.php");

class LausiWorkforcesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiWorkforcesDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un workforce existente

			WorkforcePeer::update($_POST["id"],$_POST["name"],$_POST["telephone"],$_POST["workInHeight"]);
      		
			return $mapping->findForwardConfig('success');
		}
		else {
		  //estoy creando un nuevo workforce

			if (!($workforce = WorkforcePeer::create($_POST["name"],$_POST["telephone"],$_POST["workInHeight"]))) {
				
				$workforce = new Workforce();
				$workforce->setid($_POST["id"]);
				$workforce->setname($_POST["name"]);
				$workforce->settelephone($_POST["telephone"]);
				$workforce->setworkInHeight($_POST["workInHeight"]);
				$smarty->assign("workforce",$workforce);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      		}
      		
			//creamos la relaciones con los cicuitos
			if (isset($_POST['circuits'])) {
				foreach ($_POST['circuits'] as $circuitId) {
					WorkforceCircuitPeer::create($circuitId,$workforce->getId());					
				}
			
			}

			return $mapping->findForwardConfig('success');
		}
	}

}
