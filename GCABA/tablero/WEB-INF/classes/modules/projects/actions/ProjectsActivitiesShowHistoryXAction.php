<?php
/**
* ProjectsActivitiesShowHistoryXAction
* 
* Permite mediante Ajax recuperar un log.
* 
* @package  projects
*/

require_once "ProjectsActivitiesBaseEditAction.php";

class ProjectsActivitiesShowHistoryXAction extends ProjectsActivitiesBaseEditAction {

	function ProjectsActivitiesShowHistoryXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    parent::execute($mapping, $form, $request, $response);

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
		$smarty->assign("module",$module);
		$section = "Activities";
		$smarty->assign("section",$section);

  		$activity = $this->prepareProjectActivity($mapping, $smarty, $request);
		$this->prepareProjectsAndObjectives($mapping, $smarty);
		
		$logId = $_GET['logId'];
		if (!empty($logId)) {
			$activity = ProjectActivityLogQuery::create()->findPK($logId);
			if(empty($activity))
				$activity = new ProjectActivityLog();
		}
		
		$smarty->assign("activity", $activity); //se pasa el projectLog como si fuera un proyecto comun y correinte.		

		$smarty->assign("fromProjectId",$_GET["fromProjectId"]);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("message",$_GET["message"]);
		
		$smarty->assign("action", "showLog");

		return $mapping->findForwardConfig('success');
	}

}
