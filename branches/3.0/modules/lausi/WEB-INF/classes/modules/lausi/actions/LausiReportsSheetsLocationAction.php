<?php

require_once("ReportGenerator.php");

class LausiReportsSheetsLocationAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiReportsSheetsLocationAction() {
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
		
 		$smarty->assign('circuits',CircuitPeer::getAll());

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Advertisements";
		$smarty->assign("section",$section);				

		if (empty($_GET['date'])) {
			$_GET['date'] = date('d-m-Y');
			$smarty->assign('date',$_GET['date']);			
		}


		if (!empty($_GET['reportMode'])) {

			if (empty($_GET['type'])) {
				$_GET['type'] = BillboardPeer::TYPE_SEXTUPLE;
			}
		
	 		$reportGenerator = new ReportGenerator();
			$themePeer = new ThemePeer();
		
			if (!empty($_GET['circuitId'])) {
				$circuitId = $_GET['circuitId'];
				$smarty->assign('circuitId',$_GET['circuitId']);
				$results = $reportGenerator->getSheetsLocationReport(Common::convertToMysqlDateFormat($_GET['date']),$_GET['type'],$circuitId);
				$themes = $themePeer->getAllActive($_GET['type']);
			} else
				$smarty->assign('message',"noCircuitSeleted");
		   
			$smarty->assign('results',$results);
			$smarty->assign('themes',$themes);
			$smarty->assign('date',$_GET['date']);
			$smarty->assign('type',$_GET['type']);

			if ($_GET['reportMode'] == 'print') {
				$this->template->template = "TemplatePrint.tpl";
				foreach ($results as $key => $result)
					$results[$key] = $reportGenerator->reorderAddresses($result, $_GET['addressesIds']);
				$smarty->assign('results',$results);
			} elseif ($_GET['reportMode'] == 'xls') {
				$this->template->template = "TemplateCsv.tpl";
				foreach ($results as $key => $result)
					$results[$key] = $reportGenerator->reorderAddresses($result, $_GET['addressesIds']);
				$smarty->assign('results',$results);
	
				$forwardConfig = $mapping->findForwardConfig('xml');
				$xml = $smarty->fetch($forwardConfig->getPath());
	
				require_once("ExcelManagement.php");
				$excel = new ExcelManagement();			
				$excel->sendXlsFromXml($xml);
				die;
			}			
		}
		
		return $mapping->findForwardConfig('success');
	}

}
