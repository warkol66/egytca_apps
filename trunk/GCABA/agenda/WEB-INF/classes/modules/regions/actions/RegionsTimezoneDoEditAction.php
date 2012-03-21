<?php

class RegionsTimezoneDoEditAction extends BaseAction {

	function RegionsTimezoneDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un region existente

			if ( RegionTimezonePeer::update($_POST["id"],$_POST["regionData"]) )
				return $mapping->findForwardConfig('success');

		}
		else {
			//estoy creando un nuevo region

			$result = RegionTimezonePeer::create($_POST["regionData"]);
			if (!$result) {
				$region = new Region();
				$region->setid($_POST["id"]);
				$region->setname($_POST["name"]);
				$smarty->assign("region",$region);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
