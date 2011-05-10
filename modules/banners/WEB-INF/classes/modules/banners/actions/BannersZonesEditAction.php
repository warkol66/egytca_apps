<?php
/**
 * BannersZonesEditAction
 *
 * Muestra el formulario de edición de Zonas de Banners, con datos si existe, sin datos para una nueva
 * @package banners
 */
class BannersZonesEditAction  extends BaseAction {

	function BannersZonesEditAction() {
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

		if (isset($_GET['zoneId'])) {
			try {
				$zone = BannerZonePeer::get($_GET['zoneId']);
				$smarty->assign("zone", $zone);
				$smarty->assign("accion","edicion");
				return $mapping->findForwardConfig('success');
			}
			catch (PropelException $e) {
			}
		}
		else {
			try {
				$zone = new BannerZone();
				$smarty->assign("zone", $zone);
				return $mapping->findForwardConfig('success');
			}
			catch (PropelException $e) {
			}
		}

/*		$rotationTypes = BannerZone::getRotationTypes();
			echo "Rota";
		print_r($rotationTypes);die;
		$smarty->assign("rotationTypes", $rotationTypes);
*/
		return $mapping->findForwardConfig('failure');
	}

}
