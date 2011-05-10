<?php

class ProjectsListAction extends BaseAction {

	function ProjectsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Projects";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$userPeer = new UserPeer();

		$projectPeer = new ProjectPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($projectPeer,$filters,$smarty);
		}

		if (Common::isAffiliatedUser()) {
			//solamente traigo los proyectos relacionados a ese usuario afiliado
			$dependencyId = Common::getAffiliatedId();
			$pager = $projectPeer->getSearchPaginated($page,-1,$dependencyId);
		}
		else if (Common::isAdmin() && ($moduleConfig['useDependencies']['value'] == "YES")) {
			$pager = $projectPeer->getSearchPaginated($page);
			$smarty->assign("dependencies",TableroDependencyPeer::getAll());
		}
		else
			$pager = $projectPeer->getSearchPaginated($page);

		if (ConfigModule::get("projects","useRegions"))
			$smarty->assign("regions",RegionPeer::getAll());

		if ($moduleConfig['useComunes']['value'] == "YES")
			$smarty->assign("communes",TableroCommunePeer::getAll());

		$smarty->assign("projects",$pager->getResult());
		$smarty->assign("pager",$pager);

		if ($filters['fromObjectives']){
			$objective = ObjectivePeer::get($filters['objective']);
			if (is_object($objective))
				$smarty->assign("parentObject",$objective);
		}

		$url = "Main.php?do=projectsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
