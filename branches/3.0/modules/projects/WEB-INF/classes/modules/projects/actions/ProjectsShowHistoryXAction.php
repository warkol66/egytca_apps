<?php
/**
* ProjectsShowHistoryXAction
* 
* Permite mediante Ajax recuperar un log.
* 
* @package  projects
*/

require_once "ProjectsEditBaseAction.php";

class ProjectsShowHistoryXAction extends ProjectsEditBaseAction {

	function ProjectsShowHistoryXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Projects";
		$content = new Content();
		
		$this->preparePositions($mapping,$smarty);
		$this->prepareObjectives($mapping,$smarty);
		
		$minorChanges = ConfigModule::get("projects","useMinorChanges");
		$smarty->assign("minorChanges",$minorChanges);
		
		$priorityTypes = ProjectPeer::getPriorityTypes();
		$smarty->assign("priorityTypes",$priorityTypes);
		
		$logId = $_GET['logId'];
		if (!empty($logId)) {
			$projectLog = ProjectLogQuery::create()->findPK($logId);
		}
		$projectId = $_GET['id'];
		if (!empty($projectId)) {
			$project = ProjectQuery::create()->findPK($projectId);
		}
		if(!empty($project)) {
			$smarty->assign("project", $project);
			$smarty->assign("action", "showLog");
			return $mapping->findForwardConfig('success');
		} elseif(!empty($projectLog)) {
			$smarty->assign("project", $projectLog); //se pasa el projectLog como si fuera un proyecto comun y correinte.
			$smarty->assign("action", "showLog");
			return $mapping->findForwardConfig('success');
		} else {
			return $mapping->findForwardConfig('failure');
		}
	}

}
