<?php

class PanelResultFramesViewAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesViewAction() {
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
		
		$policyGuidelines = ResultFrameIndicatorPeer::getAllByIndicatorType(ResultFrameIndicatorPeer::CREDIT);
		$smarty->assign("policyGuidelines",$policyGuidelines);

			
		$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();

		$indicatorTypes = $resultFrameIndicatorPeer->getTypesTranslated();
		$smarty->assign("indicatorTypes",$indicatorTypes);

		if ($_GET["policyGuidelineId"]){

			$policyGuideline = ResultFrameIndicatorPeer::get($_GET["policyGuidelineId"]);

			$resultFrameIndicators = ResultFrameIndicatorPeer::getAllByIndicator($policyGuideline);
			$smarty->assign("resultFrameIndicators",$resultFrameIndicators);
		}
		else {
			$policyGuideline = new ResultFrameIndicator();
			$tree = ResultFrameIndicatorPeer::getAll();
//			$smarty->assign("resultFrameIndicators",$tree);
		}
		$smarty->assign("selectedPolicyGuideline",$policyGuideline);


		$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($resultFrameIndicatorPeer,$filters,$smarty);
		}


		$url = "Main.php?do=panelResultFramesView";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}
}