<?php

class ModulesEntitiesFieldsListAction extends BaseAction {


	function ModulesEntitiesFieldsListAction() {
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
		$section = "Entities";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleEntityFieldPeer = new ModuleEntityFieldPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($moduleEntityFieldPeer,$filters,$smarty);
		}

		$modules = ModuleEntityPeer::getAllModules();
		$smarty->assign("modules",$modules);

		$entities = ModuleEntityPeer::getAll();
		$smarty->assign("entities",$entities);

		$pager = $moduleEntityFieldPeer->getAllPaginated($page);
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=modulesEntitiesFieldsList";
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
