<?php

class LausiAddressesListAction extends BaseAction {

	function LausiAddressesListAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Addresses";
		$smarty->assign("section",$section);				
 
 		//opciones para filtro
 		$smarty->assign("circuits",CircuitPeer::getAll());
 		$smarty->assign("regions",RegionPeer::getAll());
 	
 		$addressPeer = new AddressPeer();
		
		$filters = $_GET['filters'];
 	
 		//procesamos las opciones de filtrado que pueden llegar a haberse aplicado
		$this->applyFilters($addressPeer, $filters, $smarty);
 		
		$pager = $addressPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("addresses",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=lausiAddressesList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
