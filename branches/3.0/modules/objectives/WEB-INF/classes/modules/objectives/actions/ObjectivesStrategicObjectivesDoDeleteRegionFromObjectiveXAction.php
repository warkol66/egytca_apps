<?php

require_once("BaseAction.php");
require_once("StrategicObjectivePeer.php");
require_once("StrategicObjectivePeer.php");
require_once("RegionPeer.php");
require_once("TableroCommunePeer.php");
require_once("RegionObjectivePeer.php");

class ObjectivesStrategicObjectivesDoDeleteRegionFromObjectiveXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesStrategicObjectivesDoDeleteRegionFromObjectiveXAction() {
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

		$module = "Objectives";

		//TODO VERIFICACION USUARIOS
    		if ( !empty($_POST["objectiveId"]) && !(empty($_POST["regionId"])) ) {
			
			$objective = StrategicObjectivePeer::get($_POST["objectiveId"]);
			$region = RegionPeer::get($_POST["regionId"]);

	
			if (!empty($objective) && !empty($region)) {
			
				RegionObjectivePeer::delete($_POST["objectiveId"],$_POST["regionId"]);
				
				$smarty->assign('region',$region);
				
				
			}			
			

		}

		return $mapping->findForwardConfig('success');
	}

}