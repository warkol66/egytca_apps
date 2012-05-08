<?php

require_once "ProjectsEditBaseAction.php";

class ProjectsShowHistoryAction extends ProjectsEditBaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function ProjectsShowHistoryAction() {
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

		$module = "Projects";
		$section = "Projects";

 		$smarty->assign("module",$module);
  	$smarty->assign("section",$section);
  	
  	$this->preparePositions($mapping,$smarty);
		$this->prepareObjectives($mapping,$smarty);
		
		$minorChanges = ConfigModule::get("projects","useMinorChanges");
		$smarty->assign("minorChanges",$minorChanges);
		
		$priorityTypes = ProjectPeer::getPriorityTypes();
		$smarty->assign("priorityTypes",$priorityTypes);

		$projectId = $_GET['id'];
		$project = ProjectPeer::get($projectId);
		$maxPerPage = ConfigModule::get('projects','logsPerPage');
		$projectLogsPager = $project->getLogsOrderedByUpdatedPaginated('desc', $_GET['page'], $maxPerPage);
		
 		$userPeer = new UserPeer();
 		$smarty->assign("userPeer",$userPeer);

		$smarty->assign("project",$project);
		$smarty->assign("projectLogsPager", $projectLogsPager);
		$smarty->assign("action", "showLog");

		return $mapping->findForwardConfig('success');
	}

}
