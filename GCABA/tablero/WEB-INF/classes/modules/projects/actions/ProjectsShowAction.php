<?php

require_once("BaseAction.php");

class ProjectsShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProjectsShowAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET['positionId'])) {
			$position = PositionQuery::create()->findPK($_GET['positionId']);
			$smarty->assign("position", $position);
			if (!empty($_GET['color']))
				$projects = $position->getProjectsByStatusColor($_GET['color']);
			else
				$projects = $position->getAllProjectsWithDescendants();
		}
		else if(!empty($_GET['objectiveId'])) {
			$objective = ObjectiveQuery::create()->findPK($_GET['objectiveId']);
			$smarty->assign("objective", $objective);
			if (!empty($_GET['color']))
				$projects = $objective->getProjectsByStatusColor($_GET['color']);
			else
				$projects = $objective->getAllProjects();
		}
		else if(!empty($_GET['policyGuidelineId'])) {
			$policyGuideline = PolicyGuidelineQuery::create()->findPK($_GET['policyGuidelineId']);
			$smarty->assign("policyGuideline", $policyGuideline);
			if (!empty($_GET['color']))
				$projects = $policyGuideline->getProjectsByStatusColor($_GET['color']);
			else
				$projects = $policyGuideline->getAllProjects();
		}

		$smarty->assign("projects", $projects);

		return $mapping->findForwardConfig('success');

	}

}
