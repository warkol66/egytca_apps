<?php

class PanelReportsSectionsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsSectionsListAction() {
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
		
		$reportSectionPeer = new ReportSectionPeer();

		$sectionTypes = $reportSectionPeer->getTypesTranslated();
		$smarty->assign("sectionTypes",$sectionTypes);

		$versions = ReportSectionPeer::getVersions();
		$smarty->assign("versions",$versions);
		
		$reportVersion = new ReportVersion();
		$smarty->assign("reportVersion",$reportVersion);
		
		//por defecto muestra la última versión
		$version = ReportSectionPeer::getLatestVersion();
		
		if (isset($_GET["version"])) {
			$version = $_GET["version"];
		}

		$tree = ReportSectionPeer::getTree($version);
		$smarty->assign("reportSections",$tree);

		$root = ReportSectionPeer::getRoot($version);
		$smarty->assign("root",$root);

		$reportSectionPeer = new ReportSectionPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($reportSectionPeer,$filters,$smarty);
		}
		$smarty->assign("version",$version);
		$reportSectionPeer->setSearchVersion($version);

		$pager = $reportSectionPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("reportSections",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=panelReportsSectionsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}
}