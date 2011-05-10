<?php
/**
* ProjectsUpdateTabsXAction
* 
* Permite mediante Ajax actualizar las tabs de los logs al cambiar de pagina.
* 
* @package  projects
*/

require_once("BaseAction.php");

class ProjectsUpdateTabsXAction extends BaseAction {

	function ProjectsUpdateTabsXAction() {
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
		
		$projectId = $_GET['id'];
		$project = ProjectPeer::get($projectId);
		$maxPerPage = ConfigModule::get('projects','logsPerPage');
		$projectLogsPager = $project->getLogsOrderedByUpdatedPaginated('desc', $_GET['page'], $maxPerPage);
		
		$smarty->assign("project", $project);
		$smarty->assign("projectLogsPager", $projectLogsPager);

		return $mapping->findForwardConfig('success');
		
	}

}
