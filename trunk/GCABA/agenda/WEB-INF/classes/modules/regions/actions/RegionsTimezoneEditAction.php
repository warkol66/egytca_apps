<?php

class RegionsTimezoneEditAction extends BaseAction {

	function RegionsTimezoneEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "RegionsTimezone";
		$smarty->assign("module",$module);

		$RegionTimezonePeer = new RegionTimezonePeer();
		$continents = $RegionTimezonePeer->continents;
		$smarty->assign("continents",$continents);

		if ( !empty($_GET["id"]) ) {
			$region = RegionTimezonePeer::get($_GET["id"]);
			$smarty->assign("region",$region);
			$smarty->assign("action","edit");
			$regionstimezone =  RegionTimezonePeer::getIdentifiers($continent);
		}
		else {
			//voy a crear un region nuevo
			$region = new Region();
			$smarty->assign("region",$region);
			$smarty->assign("action","create");
			$regionstimezone =  RegionTimezonePeer::getIdentifiers();
		}

		$smarty->assign("message",$_GET["message"]);
		$smarty->assign('regionstimezone',$regionstimezone);

		return $mapping->findForwardConfig('success');
	}

}
