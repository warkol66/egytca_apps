<?php

class VialidadBulletinListAction extends BaseAction {

	function VialidadBulletinListAction() {
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

		$bulletinPeer = new BulletinPeer();

		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($bulletinPeer,$filters,$smarty);
		}

		if (isset($page))
			$pager = $bulletinPeer->getAllPaginatedFiltered($page);
		else
			$pager = $bulletinPeer->getAllPaginatedFiltered();
		
		$smarty->assign('bulletins',$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=vialidadList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		
		return $mapping->findForwardConfig('success');
	}
	
}
