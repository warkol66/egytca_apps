<?php

require_once("BaseAction.php");
require_once("TableroMilestonePeer.php");
require_once("TableroProjectPeer.php");
require_once("TableroDependencyPeer.php");

class TableroMilestonesNavAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroMilestonesNavAction() {
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
		$section = "Nav";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);
 	
		$dependencyId = $this->getDependencyId();	
		
		$project = TableroProjectPeer::get($_GET["projectId"]);
		
		if (!empty($_GET["status"])) {
			$method = "getMilestones".$_GET["status"];
			$milestones = $project->$method();
		}
		else {
			$milestones = TableroMilestonePeer::getAllByProject($_GET['projectId'],$dependencyId);		
		}
		
		$smarty->assign("milestones",$milestones);
		$smarty->assign("project",$project);
		$smarty->assign("status",$_GET["status"]);
		
		$smarty->assign("objective",$project->getTableroObjective());
		
		$dependency = TableroDependencyPeer::get($dependencyId);
		$smarty->assign("dependency",$dependency);
   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
