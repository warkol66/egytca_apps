<?php

require_once("BaseAction.php");
require_once("TableroProjectPeer.php");
require_once("TableroObjectivePeer.php");
require_once("TableroCommunePeer.php");
require_once("TableroCommuneProject.php");

class TableroProjectsDoAddCommuneToProjectXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroProjectsDoAddCommuneToProjectXAction() {
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
    		if ( !empty($_POST["projectId"]) && !(empty($_POST["communeId"])) ) {
	
			$project = TableroProjectPeer::get($_POST["projectId"]);
			$commune = TableroCommunePeer::get($_POST["communeId"]);
			
			//TODO REFACTOR EN PEER
			if (!empty($project) && !empty($commune)) {
			
				$relation = new TableroCommuneProject();
				$relation->setCommuneId($_POST["communeId"]);
				$relation->setProjectId($_POST["projectId"]);
				
				try {
					$relation->save();				
				}
				catch (PropelException $exp) {
					$smarty->assign('errorTagId','communeMsgField');					
					return $mapping->findForwardConfig('failure');				
				}
				
				$smarty->assign('commune',$commune);
				$smarty->assign('project',$project);
				
			}			
	
			return $mapping->findForwardConfig('success');			

		}
	
		$smarty->assign('errorTagId','communeMsgField');
		return $mapping->findForwardConfig('failure');
	}

}
