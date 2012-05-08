<?php

class PanelReportsVersionsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsVersionsDoEditAction() {
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

			if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (!empty($_POST["id"])) { // Existing

			$version = ReportVersionPeer::get($_POST["id"]);
			$version = Common::setObjectFromParams($version,$_POST["reportVersionData"]);
			
			if (!$version->save())
				return $mapping->findForwardConfig('failure');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}
		else { // New
			$version = new ReportVersion();
			$version = Common::setObjectFromParams($version,$_POST["reportVersionData"]);
			if (!$version->save())
				return $mapping->findForwardConfig('failure');
				
			$versionsCount = ReportVersionQuery::create()->count();
			
			if ($versionsCount == 1 || !$_POST['replicate'])
				ReportSectionPeer::createVersionFromCurrentEntities();
			else
				ReportSectionPeer::createNewVersion();
				
			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["reportVersionData"]["name"] . $logSufix);

			if ($version->getId() > 1)
				$params['version'] = $version->getId();

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'successCreateVersion');
		}

	}		
		
}
