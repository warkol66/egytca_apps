<?php

class PanelMissionListAction extends BaseAction {

	function PanelMissionListAction() {
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

		$module = "Panel";
		$smarty->assign("module",$module);
		$section = "Missions";
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$missionPeer = new MissionPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($missionPeer,$filters,$smarty);
		}
		$pager = $missionPeer->getAllPaginatedFiltered($page);

		$smarty->assign("missions",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=panelMissionList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
