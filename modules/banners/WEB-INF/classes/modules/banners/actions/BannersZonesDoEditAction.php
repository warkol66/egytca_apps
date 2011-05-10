<?php
/**
 * BannersZonesDoEditAction
 *
 * Guarda los cambios a una zona existente del módulo de Banners, o crea una nueva
 * @package banners
 */
class BannersZonesDoEditAction extends BaseAction {

	function BannersZonesDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		$module = "Banners";
		$smarty->assign("module",$module);
		$section = "Zones";
		$smarty->assign("section",$section);

		if (empty($_POST["zone"]["zoneId"]) ) {
			$result = BannerZonePeer::create($_POST["zone"]);
			if ($result)
				return $mapping->findForwardConfig('success');
		}
		else{
			$result = BannerZonePeer::update($_POST["zone"]);
			if ($result)
				return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('failure');
	}

}
