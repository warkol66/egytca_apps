<?php

require_once("BaseAction.php");
require_once("ReportGenerator.php");
require_once("BillboardPeer.php");
require_once('ThemePeer.php');

class LausiReportsThemesAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiReportsThemesAction() {
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

 		$reportGenerator = new ReportGenerator();
		$themePeer = new ThemePeer();
		
		if (!empty($_GET['circuitId'])) {
			$circuit = CircuitPeer::get($_GET['circuitId']);
			$resultsDouble = $reportGenerator->getThemesReport(ThemePeer::TYPE_DOBLE,$circuit);
			$resultsSix = $reportGenerator->getThemesReport(ThemePeer::TYPE_SEXTUPLE,$circuit);
			$smarty->assign('circuit',$circuit);
		}
		else {
			$resultsDouble = $reportGenerator->getThemesReport(ThemePeer::TYPE_DOBLE);
			$resultsSix = $reportGenerator->getThemesReport(ThemePeer::TYPE_SEXTUPLE);
		}
		
		$smarty->assign('resultsDouble',$resultsDouble);
		$smarty->assign('resultsSix',$resultsSix);
		
		if ($_REQUEST['print'] == '1')
			$this->template->template = "TemplatePrint.tpl";
		elseif ($_REQUEST['export'] == 'xls') {
					
			$this->template->template = "TemplateCsv.tpl";
	
			$forwardConfig = $mapping->findForwardConfig('xml');
			$xml = $smarty->fetch($forwardConfig->getPath());
	
			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;

		}					
		return $mapping->findForwardConfig('success');
	}

}
