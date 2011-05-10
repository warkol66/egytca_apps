<?php

class ObjectivesPolicyGuidelinesListAction extends BaseAction {

	function ObjectivesPolicyGuidelinesListAction() {
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

		$module = "Objectives";
		$section = "Policy Guidelines";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$policyGuidelinePeer = new PolicyGuidelinePeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($policyGuidelinePeer,$filters,$smarty);
		}

		$pager = $policyGuidelinePeer->getAllPaginatedFiltered($page);

		$smarty->assign("guidelines",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=objectivesPolicyGuidelinesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
