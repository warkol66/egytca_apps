<?php

class LausiReportsAddressesAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiReportsAddressesAction() {
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
		$section = "Billboards";
		$smarty->assign("section",$section);	

		if (!empty($_GET['reportMode'])) {
			
			$smarty->assign('reportMode',$_GET['reportMode']);
		
			$addressPeer = new AddressPeer();
		
			//procesamos las opciones de filtrado que pueden llegar a haberse aplicado
			if (!empty($_GET['type'])) {
				$this->applyFilters($addressPeer,array('searchBillboardType'=>$_GET['type'], $smarty));
				$smarty->assign('type',$_GET['type']); 			
			}
		
			if (!empty($_GET['viewDetail'])) {
				$smarty->assign('viewDetail',$_GET['viewDetail']);
			}
		
			if ($_GET['reportMode'] == 'normal') {
				$pager = Common::getAllPaginatedFiltered($addressPeer, $_GET["page"]);
				$smarty->assign("addresses",$pager->getResults());
				$smarty->assign("pager",$pager);
				$url = "Main.php?do=lausiReportsAddresses&type=".$_GET['type']."&page=".$_GET['page']."&viewDetail=".$_GET['viewDetail']."&reportMode=".$_GET['reportMode'];
				$smarty->assign("url",$url);
   			} elseif ($_GET['reportMode'] == 'print') {
				$this->template->template = "TemplatePrint.tpl";
				$addresses = $addressPeer->getAllFiltered($_GET["page"]);
				$smarty->assign("addresses",$addresses);
			} elseif ($_GET['reportMode'] == 'xls') {
				$this->template->template = "TemplateCsv.tpl";
				$addresses = $addressPeer->getAllFiltered($_GET["page"]);
				$smarty->assign("addresses",$addresses);

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
