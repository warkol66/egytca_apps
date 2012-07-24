<?php

class ModulesEntitiesListAction extends BaseAction {

	function ModulesEntitiesListAction() {
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

		$module = "Modules";
		$smarty->assign("module",$module);
		$section = "Entities";
		$smarty->assign("section",$section);
		
		$moduleEntityPeer = new ModuleEntityPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($moduleEntityPeer,$filters,$smarty);
		}

		$modules = ModuleEntityPeer::getAllModules();
		$smarty->assign("modules",$modules);

		$pager = $moduleEntityPeer->getAllPaginated($page);

		$smarty->assign("pager",$pager);

		$url = "Main.php?do=modulesEntitiesList";
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
