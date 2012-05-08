<?php

class PanelReportsVersionsDoExportAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsVersionsDoExportAction() {
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
		
		$versionId = $_POST['versionId'];
		if (empty($versionId))
			$versionId = ReportSectionPeer::getLatestVersion();
			
		$rootType = ConfigModule::get("reportSections","treeRootType");
		$topLevelType = $rootType + 1;
		$topLevelSections = ReportSectionPeer::getAllBySectionType($topLevelType, $versionId);
		
		$smarty->assign("sections",$topLevelSections);
		$this->template->template = "TemplatePlain.tpl";
		$report = $smarty->fetch('PanelReportsExport.tpl');

		if ($_GET['doDownload'] === 'false') {
			echo $report;
		} else {
			// adecuammos la codificacion de caracteres a ANSI para RTF
			$report = iconv("UTF-8", "ISO-8859-1//TRANSLIT//IGNORE", $report);
			$fileName = 'report_v' . $versionId . '.doc';		
			
			header('Content-Description: File Transfer');
		    header('Content-Type: application/msword;');
		    header('Content-Disposition: attachment; filename=' . $fileName);
		    header('Content-Transfer-Encoding: chunked');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		    header('Pragma: public');
		    flush();
		    echo $report;
		}

		return $mapping->findForwardConfig('success');
	}

}

