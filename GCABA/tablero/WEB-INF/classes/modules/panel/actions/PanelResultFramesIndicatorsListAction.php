<?php

class PanelResultFramesIndicatorsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsListAction() {
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

		$module = "Panel";
		$smarty->assign("module",$module);
		
		$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();

		$indicatorTypes = $resultFrameIndicatorPeer->getTypesTranslated();
		$smarty->assign("indicatorTypes",$indicatorTypes);

		$tree = ResultFrameIndicatorPeer::getAll();
		$smarty->assign("resultFrameIndicators",$tree);

		$root = ResultFrameIndicatorPeer::getRoot();
		$smarty->assign("root",$root);

		$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($resultFrameIndicatorPeer,$filters,$smarty);
		}

		$pager = $resultFrameIndicatorPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("resultFrameIndicators",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=panelResultFramesIndicatorsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}
}