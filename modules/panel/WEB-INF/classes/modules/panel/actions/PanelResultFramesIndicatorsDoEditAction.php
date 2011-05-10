<?php

class PanelResultFramesIndicatorsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsDoEditAction() {
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
		
		$pagerRedirect = array ( "page" => $_POST["page"]);

		foreach ($_POST["filters"] as $key => $value) 
			$filterRedirect["filters[$key]"] = $value;

		if (is_array($filterRedirect))		
			$redirectParams = $pagerRedirect + $filterRedirect;
		else if (is_array($pagerRedirect))
			$redirectParams = $pagerRedirect;
		else
			$redirectParams = $filterRedirect;
			
		$indicatorValuesParams = $_POST['indicatorValuesParams'];
		
		if ($_POST["action"] == "edit") {
			$redirectParams = $redirectParams + array("id" => $_POST["id"]);
			if (ResultFrameIndicatorPeer::update($_POST["id"],$_POST["indicatorData"])) {
				ResultFrameIndicatorPeer::updateIndicatorValuesFromParams($_POST["id"], $indicatorValuesParams);
				if ($_POST["policyGuidelineId"] && $_POST["from"]){
					header("Location:Main.php?do=panelResultFramesView&policyGuidelineId=".$_POST["policyGuidelineId"]."&from=".$_POST["panelResultFramesView"]);
					exit();
				}
				return $this->addParamsToForwards($redirectParams,$mapping,'success');
			}
		}
		else {
			$indicator = ResultFrameIndicatorPeer::create($_POST["indicatorData"]);

			if (empty($indicator)) {
				$indicator = ResultFrameIndicatorPeer::getObjectFromParams($_POST["indicatorData"]);
				$smarty->assign("resultFrameIndicator",$indicator);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				
				$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();
				$indicatorTypes = $resultFrameIndicatorPeer->getTypesTranslated();
				$smarty->assign("indicatorTypes",$indicatorTypes);
				
				return $mapping->findForwardConfig('failure');				
			}
			ResultFrameIndicatorPeer::updateIndicatorValuesFromParams($indicator->getId(), $indicatorValuesParams);
			
			if ($_POST["policyGuidelineId"] && $_POST["from"])
				header("Location:Main.php?do=panelResultFramesView&policyGuidelineId=".$_POST["policyGuidelineId"]."&from=".$_POST["panelResultFramesView"]);


			return $this->addParamsToForwards(array("id" => $indicator->getId()),$mapping,'successCreate');
		}
	}
}
