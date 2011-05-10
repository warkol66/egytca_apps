<?php

require_once("BaseAction.php");

class ProjectsDoDeleteCommuneFromProjectXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProjectsDoDeleteCommuneFromProjectXAction() {
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
			
			$project = ProjectPeer::get($_POST["projectId"]);
			$commune = TableroCommunePeer::get($_POST["communeId"]);
			
			if (!empty($project) && !empty($commune)) {
			
				TableroCommuneProjectPeer::delete($_POST["projectId"],$_POST["communeId"]);
			
			}
			
			$smarty->assign("commune",$commune);
		}

		return $mapping->findForwardConfig('success');
	}

}
