<?php

class ObjectivesStrategicObjectivesListAction extends BaseAction {

	function ObjectivesStrategicObjectivesListAction() {
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
		$section = "Strategic Objetives";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$strategicObjectivePeer = new StrategicObjectivePeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($strategicObjectivePeer,$filters,$smarty);
		}

		if (Common::isAffiliatedUser())
			$strategicObjectivePeer->setAffiliateId(Common::getAffiliatedId());

		$pager = $strategicObjectivePeer->getAllPaginatedFiltered($page);

		$smarty->assign("objectives",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=objectivesStrategicObjectivesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);		

		if ($filters['fromGuidelines']){
			$policyGuideline = PolicyGuidelinePeer::get($filters['guideline']);
			$smarty->assign("parentObject",$policyGuideline);
		}

		if (class_exists(AffiliateInfoPeer))
			$smarty->assign("affiliateInfoPeer",new AffiliateInfoPeer());

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
