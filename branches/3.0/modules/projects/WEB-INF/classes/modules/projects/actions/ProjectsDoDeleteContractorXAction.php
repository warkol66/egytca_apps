<?php
require_once "ProjectsEditBaseAction.php";

class ProjectsDoDeleteContractorXAction extends ProjectsEditBaseAction {

	function ProjectsDoDeleteContractorXAction() {
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
		
		$project = ProjectPeer::get($_POST['projectId']);
		$contractorIds = $_POST['contractor']['id'];
		$preclasifiedIds = $_POST['preClasifiedContractor']['id'];
		
		$smarty->assign("contractorIds", $contractorIds);
		$smarty->assign("preclasifiedIds", $preclasifiedIds);
		
		$project->removeContractorFromPreClasifiedList($preclasifiedIds);
		$project->removeContractor($contractorIds);
		$this->prepareContractors($mapping,$smarty,$project);
		
		return $mapping->findForwardConfig('success');
	}

}
