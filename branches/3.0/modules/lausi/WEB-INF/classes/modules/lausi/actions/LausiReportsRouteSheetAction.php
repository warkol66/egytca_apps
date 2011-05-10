<?php

require_once("ReportGenerator.php");

class LausiReportsRouteSheetAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiReportsRouteSheetAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Advertisements";
		$smarty->assign("section",$section);				

		$smarty->assign('themes',ThemePeer::getAllActive(ThemePeer::TYPE_SEXTUPLE));
		$smarty->assign('workforces',WorkforcePeer::getAll());

 		$reportGenerator = new ReportGenerator();

		if (isset($_REQUEST['filter'])) {
			
			if (isset($_REQUEST['filter']['themeId']))
				$reportGenerator->setThemeId($_REQUEST['filter']['themeId']);
			if (isset($_REQUEST['filter']['workforceId']))
				$reportGenerator->setWorkforceId($_REQUEST['filter']['workforceId']);
			
			$smarty->assign('filter',$_REQUEST['filter']);
		}
		
		if (!empty($_GET['date'])) {
			
			$results = $reportGenerator->getRouteSheetReport(Common::convertToMysqlDateFormat($_GET['date']));
			$smarty->assign('results',$results);
			$smarty->assign('date',Common::convertToMysqlDateFormat($_GET['date']));
		}
		
		if ($_REQUEST['reportMode'] == 'print') {
			$this->template->template = "TemplatePrint.tpl";
			foreach ($results as $key => $result)
				$results[$key] = $reportGenerator->reorderAddresses($result, $_REQUEST['addressesIds']);
			$smarty->assign('results',$results);
		}
		
		$smarty->assign('reportMode',$_REQUEST['reportMode']);
		
		return $mapping->findForwardConfig('success');
	}

}
