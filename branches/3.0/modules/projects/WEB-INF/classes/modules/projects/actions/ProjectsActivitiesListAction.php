<?php

class ProjectsActivitiesListAction extends BaseAction {

	function ProjectsActivitiesListAction() {
		;
	}

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
		$smarty->assign("module",$module);
		$section = "Activities";
		$smarty->assign("section",$section);

		$projectActivityPeer = new ProjectActivityPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($projectActivityPeer,$filters,$smarty);
		}

		$pager = $projectActivityPeer->getAllPaginatedFiltered($_GET['page']);

		$smarty->assign("activities",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=projectsActivitiesList";
		$smarty->assign("filters",$_GET['filters']);

		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";


		if ($filters['fromProjects']){
			$project = ProjectPeer::get($filters['projectId']);
			if (is_object($project))
				$smarty->assign("parentObject",$project);
		}

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
