<?php
require_once "ProjectsActivitiesBaseEditAction.php";
class ProjectsActivitiesEditAction extends ProjectsActivitiesBaseEditAction {


	function ProjectsActivitiesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    	parent::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$module = "Projects";
		$smarty->assign("module",$module);
		$section = "Activities";
		$smarty->assign("section",$section);

  	$activity = $this->prepareProjectActivity($mapping,$smarty,$request);
		$this->prepareProjectsAndObjectives($mapping,$smarty);
  	$this->prepareDocuments($mapping,$smarty,$activity);

		$smarty->assign("fromProjectId",$_GET["fromProjectId"]);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
