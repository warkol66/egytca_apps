<?php
/**
* ProjectsShowHistoryXAction
* 
* Permite mediante Ajax recuperar un log.
* 
* @package  projects
*/

require_once "ProjectsEditBaseAction.php";

class ProjectsViewXAction extends ProjectsEditBaseAction {

	function ProjectsViewXAction() {
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
		
		$this->preparePositions($mapping,$smarty);
		$this->prepareObjectives($mapping,$smarty);
	
		$projectId = $_REQUEST['id'];
		if (!empty($projectId)){
			$project = ProjectPeer::get($projectId);

			$this->prepareDocuments($mapping,$smarty,$project);
			$this->prepareContractors($mapping,$smarty,$project);
			$this->prepareAdministrativeActs($mapping,$smarty,$project);
		}
		if(!empty($project)) {
			$smarty->assign("project", $project);
			$smarty->assign("action", "showLog");
			return $mapping->findForwardConfig('success');
		} 
		else
			return $mapping->findForwardConfig('failure');

	}
}
