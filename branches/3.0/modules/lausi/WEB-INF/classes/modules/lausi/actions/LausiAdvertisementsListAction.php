<?php

class LausiAdvertisementsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiAdvertisementsListAction() {
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

 		$advertisementPeer = new AdvertisementPeer();

		$advertisementPeer->setForReport();
		
		//opciones de filtrado
 		$smarty->assign('themes',ThemePeer::getAllActive());
 		$smarty->assign('clients',ClientPeer::getAll());
 		$smarty->assign('workforces',WorkforcePeer::getAll());
 		$smarty->assign('circuits',CircuitPeer::getAll());
		$smarty->assign("clientReport",$_GET['clientReport']);
		
		$filters = $_GET['filters'];
		$this->applyFilters($advertisementPeer, $filters, $smarty);
   		
		//ordenamiento especial para reporte de clientes
		if ($_GET['clientReport'] == 1) {
			$advertisementPeer->orderByCircuitOrder();
		}

		$smarty->assign("message",$_GET["message"]);
		
		//Las que vienen a continuación no se consideran opciones de filtrado
		if (empty($_GET['reportMode'])) {
			return $mapping->findForwardConfig('success');
		}
		
 		if (!empty($_GET['allThemes'])) {
 			$advertisementPeer->setAllThemes();
 			$smarty->assign('allThemes',$_GET['allThemes']);
 		}
		
		if (!empty($_GET['noGroupByAddressAndTheme'])) {
			$advertisementPeer->setNoGroupByAddressAndTheme();
			$smarty->assign('noGroupByAddressAndTheme',$_GET['noGroupByAddressAndTheme']);
		}
		
		if (!empty($_GET['onlyAddresses'])) {
			$smarty->assign('onlyAddresses',1);
		}


		if ($_GET['reportMode'] == 'normal') {
			$pager = Common::getAllPaginatedFiltered($advertisementPeer, $_GET["page"]);

			$advertisements = $pager->getResults();

			$smarty->assign("pager",$pager);

			$url = "Main.php?do=lausiAdvertisementsList&submitFilter=1&allThemes=" . $_GET['allThemes'] . "&noGroupByAddressAndTheme=" . $_GET['noGroupByAddressAndTheme'] . "&onlyAddresses=" . $_GET['onlyAddresses'] . "&clientReport=".$_GET['clientReport'] . "&reportMode=" . $_GET['reportMode'];
			foreach ($filters as $key => $value)
				$url .= "&filters[$key]=$value";
			
			$smarty->assign("url",$url);	
			$smarty->assign("groupByAddressAndTheme",$advertisementPeer->getGroupByAddressAndTheme());	
		} elseif ($_GET['reportMode'] == "xls") {
			$advertisements = $advertisementPeer->getAllFiltered();

			$smarty->assign("advertisements",$advertisements);
			
			$smarty->assign("groupByAddressAndTheme",$advertisementPeer->getGroupByAddressAndTheme());	
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplateCsv.tpl";

			$xml = $smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		} else {
			//es un reporte para impresion
			$this->template->template = "TemplatePrint.tpl";
			$advertisements = $advertisementPeer->getAllFiltered();
			$smarty->assign('printReport',1);
			$smarty->assign("groupByAddressAndTheme",$advertisementPeer->getGroupByAddressAndTheme());	
		}
		
		$smarty->assign("advertisements",$advertisements);

		return $mapping->findForwardConfig('success');
	}

}
