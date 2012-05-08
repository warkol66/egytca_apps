<?php
/**
* ProjectsActivititesUpdateTabsXAction
* 
* Permite mediante Ajax actualizar las tabs de los logs al cambiar de pagina.
* 
* @package  projects
*/

require_once("BaseAction.php");

class ProjectsActivitiesUpdateTabsXAction extends BaseAction {

	function ProjectsActivitiesUpdateTabsXAction() {
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
		
		$projectActivityId = $_GET['id'];
		$projectActivity = ProjectActivityPeer::get($projectActivityId);
		$maxPerPage = ConfigModule::get('projects','logsPerPage');
		$projectActivityLogsPager = $projectActivity->getLogsOrderedByUpdatedPaginated('desc', $_GET['page'], $maxPerPage);
		
		$smarty->assign("activity", $projectActivity);
		$smarty->assign("projectActivityLogsPager", $projectActivityLogsPager);

		return $mapping->findForwardConfig('success');
		
	}

}
