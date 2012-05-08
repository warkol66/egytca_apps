<?php

class PanelReportsSectionsGetAllParentsBySectionXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsSectionsGetAllParentsBySectionXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$module = "Panel";
		$smarty->assign("module",$module);

		$type = $_POST['sectionDataX']['type'];

		$version = $_POST['sectionData']['version'];
		if (empty($version))
			$version = ReportSectionPeer::getLatestVersion();

		$sections =  ReportSectionPeer::getAllPossibleParentsByType($type, $version);
		
		$objectType = ReportSectionPeer::getObjectTypeBySectionType($type);
		$objects = ReportSectionPeer::getObjectsBySectionType($type);
		$smarty->assign('objectType',$objectType);
		$smarty->assign('objects',$objects);
		
		$smarty->assign('type',$type);
		$smarty->assign('sections',$sections);

		return $mapping->findForwardConfig('success');
	}

}
