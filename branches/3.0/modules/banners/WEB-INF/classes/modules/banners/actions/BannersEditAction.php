<?php
/**
 * BannersEditAction
 *
 * Muestra el formulario de edición de banners, si existe, muestra sus datos.
 * @package banners
 */
class BannersEditAction extends BaseAction {

	function BannersEditAction() {
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

		// todos los clientes, para el select
		$clients = BannerClientPeer::getAll();
		$smarty->assign("clients", $clients);
		$allZones = BannerZonePeer::getAll();
		$smarty->assign("allZones", $allZones);



		if (isset($_GET['bannerId'])) {
			try {
				$banner = BannerPeer::get($_GET['bannerId']);
				$smarty->assign("banner", $banner);
				$smarty->assign("accion","edicion");

				// todas las zonas y las del banner
				$selectedZones = $banner->getBannerZoneRelationsJoinBannerZone();
				$smarty->assign("selectedZones", $selectedZones);
				return $mapping->findForwardConfig('success');
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());	
				return $mapping->findForwardConfig('failure');
			}
		}
		else {
			try {
				$banner = new Banner;
				$smarty->assign("banner", $banner);
				return $mapping->findForwardConfig('success');
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());	
				return $mapping->findForwardConfig('failure');
			}
		}

		/*
		$conditions = array(true => "Activo", "Inactivo");
		$smarty->assign("conditions", $conditions);

		$frecuencies = BannerPeer::getFrecuencies();
		$smarty->assign("frecuencies", $frecuencies);
		*/

	}

}
