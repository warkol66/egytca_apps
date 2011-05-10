<?php

class PanelReportsVersionsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsVersionsEditAction() {
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
		
		if ( !empty($_GET["id"]) ) {
			$reportVersion = ReportVersionPeer::get($_GET["id"]);
			$smarty->assign("action",'edit');			
		}
		else {
			//voy a crear una version nueva
			$reportVersion = new ReportVersion();
			$smarty->assign('latestVersionId', ReportSectionPeer::getLatestVersion());
			$smarty->assign("action",'create');
		}

		$smarty->assign("reportVersion",$reportVersion);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}

