<?php

class PanelReportsSectionsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsSectionsDoEditAction() {
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

		if ($_POST["action"] == "edit") {
			$redirectParams = $redirectParams + array("id" => $_POST["id"]);
			if (ReportSectionPeer::update($_POST["id"],$_POST["sectionData"]))
				return $this->addParamsToForwards($redirectParams,$mapping,'success');
		} else {
			$section = ReportSectionPeer::create($_POST["sectionData"]);

			if (empty($section)) {
				$section = ReportSectionPeer::getObjectFromParams($_POST["sectionData"]);
				$smarty->assign("reportSection",$section);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				
				$reportSectionPeer = new ReportSectionPeer();
				$sectionTypes = $reportSectionPeer->getTypesTranslated();
				$smarty->assign("sectionTypes",$sectionTypes);
				
				return $mapping->findForwardConfig('failure');				
			}
			return $this->addParamsToForwards(array("id" => $section->getId()),$mapping,'successCreate');
		}
	}
}
