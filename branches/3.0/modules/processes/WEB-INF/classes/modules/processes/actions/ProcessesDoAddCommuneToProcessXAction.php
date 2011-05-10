<?php

require_once("BaseAction.php");

class ProcessesDoAddCommuneToProcessXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProcessesDoAddCommuneToProcessXAction() {
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
	
			$process = ProcessPeer::get($_POST["processId"]);
			$commune = TableroCommunePeer::get($_POST["communeId"]);
			
			//TODO REFACTOR EN PEER
			if (!empty($process) && !empty($commune)) {
			
				$relation = new TableroCommuneProcess();
				$relation->setCommuneId($_POST["communeId"]);
				$relation->setProcessId($_POST["processId"]);
				
				try {
					$relation->save();				
				}
				catch (PropelException $exp) {
					$smarty->assign('errorTagId','communeMsgField');					
					return $mapping->findForwardConfig('failure');				
				}
				
				$smarty->assign('commune',$commune);
				$smarty->assign('process',$process);
				
			}			
	
			return $mapping->findForwardConfig('success');			

		}
	
		$smarty->assign('errorTagId','communeMsgField');
		return $mapping->findForwardConfig('failure');
	}

}
