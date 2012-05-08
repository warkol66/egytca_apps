<?php

require_once("BaseAction.php");
require_once("TableroProcessPeer.php");
require_once("TableroObjectivePeer.php");
require_once("TableroCommunePeer.php");
require_once("TableroCommuneProcessPeer.php");

class TableroProcessesDoDeleteCommuneFromProcessXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroProcessesDoDeleteCommuneFromProcessXAction() {
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

		//por ser una action ajax.		
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Tablero";

		//TODO VERIFICACION USUARIOS
    		if ( !empty($_POST["processId"]) && !(empty($_POST["communeId"])) ) {
			
			$process = TableroProcessPeer::get($_POST["processId"]);
			$commune = TableroCommunePeer::get($_POST["communeId"]);
			
			if (!empty($process) && !empty($commune)) {
			
				TableroCommuneProcessPeer::delete($_POST["processId"],$_POST["communeId"]);
			
			}
			
			$smarty->assign("commune",$commune);
		}

		return $mapping->findForwardConfig('success');
	}

}
