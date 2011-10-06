<?php

// TODO: Filtros no andan.

class VialidadSupplyListAction extends BaseAction {

	function VialidadSupplyListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = 'Vialidad';
		
		$smarty->assign('module',$module);

		if (isset($_GET['page']))
			$page = $_GET['page'];
		
		$smarty->assign('page',$page);

		$supplyPeer = new SupplyPeer();

		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($supplyPeer,$filters,$smarty);
		}

		if (isset($page))
			$pager = $supplyPeer->getAllPaginatedFiltered($page);
		else
			$pager = $supplyPeer->getAllPaginatedFiltered();
		
		$smarty->assign('supplies',$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=vialidadSupplyList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		
		return $mapping->findForwardConfig('success');
	}
	
}
