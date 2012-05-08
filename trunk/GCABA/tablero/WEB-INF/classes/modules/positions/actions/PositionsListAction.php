<?php

class PositionsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsListAction() {
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

		$module = "Positions";
		$smarty->assign("module",$module);
		
		$positionPeer = new PositionPeer();

		$positionTypes = $positionPeer->getPositionTypesTranslated();
		$smarty->assign("positionTypes",$positionTypes);

		$versions = PositionPeer::getVersions();
		$smarty->assign("versions",$versions);
		
		$positionVersion = new PositionVersion();
		$smarty->assign("positionVersion",$positionVersion);
		
		//por defecto muestra la última versión
		$version = $versions[count($versions)-1];
		
		if (isset($_GET["version"])) {
			$version = $_GET["version"];
		}

		$tree = PositionPeer::getTree($version);//print_r($tree);die;
		$smarty->assign("positions",$tree);

		$root = PositionPeer::getRoot($version);//print_r($root);die;
		$smarty->assign("root",$root);

		$positionPeer = new PositionPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($positionPeer,$filters,$smarty);
		}
		$smarty->assign("version",$version);
		$positionPeer->setSearchVersion($version);

		$pager = $positionPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("positions",$pager->getResult());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=positionsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);		

		return $mapping->findForwardConfig('success');
	}

}


