<?php

require_once("BaseAction.php");
require_once("TableroProjectPeer.php");

class TableroProjectsDoDeleteAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroProjectsDoDeleteAction() {
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

		$module = "Tablero";

    		$project = TableroProjectPeer::get($_POST["id"]);
    		
    		if (Common::isAffiliatedUser() && (!$project->isOwner(Common::getAffiliatedId()))) {
			//es usuario afiliado pero no es duenio de la instancia
    			return $mapping->findForwardConfig('failure');	
    		}
    		
    		//es admin o es duenio
    		$proyect->delete();
    		
		//caso edicion desde show
		if (isset($_POST['show'])) {
			return $mapping->findForwardConfig('success-show');
		}

		return $mapping->findForwardConfig('success');

	}

}
