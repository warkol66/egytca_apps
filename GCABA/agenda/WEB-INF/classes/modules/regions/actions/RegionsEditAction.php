<?php

class RegionsEditAction extends BaseAction {

	function RegionsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Regions";
		$smarty->assign("module",$module);

		$regionPeer = new RegionPeer();
		$regionTypes = $regionPeer->getRegionTypesTranslated();
		$smarty->assign("regionTypes",$regionTypes);

		if ( !empty($_GET["id"]) ) {
			$region = RegionPeer::get($_GET["id"]);
			$smarty->assign("region",$region);
			$smarty->assign("action","edit");
			$type = $region->getType();
			$regions =  RegionPeer::getAllPossibleParentsByType($type);
		}
		else {
			$region = new Region();
			$smarty->assign("region",$region);
			$smarty->assign("action","create");
			$regions =  RegionPeer::getAllPossibleParents();
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);
		$smarty->assign('regions',$regions);

		return $mapping->findForwardConfig('success');
	}

}
