<?php

class ObjectivesListAction extends BaseAction {

	function ObjectivesListAction() {
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
		$section = "Objectives";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$objectivePeer = new ObjectivePeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($objectivePeer,$filters,$smarty);
		}

		if (Common::isAffiliatedUser())
			$objectivePeer->setAffiliateId(Common::getAffiliatedId());

		$pager = $objectivePeer->getAllPaginatedFiltered($page);

		$smarty->assign("objectives",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=objectivesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);		

		if ($filters['fromStrategicObjectives']){
			$strategic = StrategicObjectivePeer::get($filters['strategicObjective']);
			$smarty->assign("parentObject",$strategic);
		}

		$smarty->assign("affiliateInfoPeer",new AffiliateInfoPeer());
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
