<?php

class RegionsTimezoneGetAllParentsByRegionXAction extends BaseAction {

	function RegionsTimezoneGetAllParentsByRegionXAction() {
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

		$type = $_POST['regionDataX']['type'];
		$regionstimezone =  RegionTimezonePeer::getIdentifiers($continent);
		$smarty->assign('type',$type);
		$smarty->assign('regionstimezone',$regionstimezone);

		return $mapping->findForwardConfig('success');
	}

}
