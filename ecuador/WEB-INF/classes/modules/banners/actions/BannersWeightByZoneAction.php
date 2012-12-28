<?php
/**
 * BannersWeightByZoneAction
 *
 * Muestra un formulario para guardar el orden de los banners en la zona
 * @package banners
 */
class BannersWeightByZoneAction extends BaseAction {

	function BannersWeightByZoneAction() {
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

		if ( isset($_GET['id']) ) {
			$zone = BannerZoneQuery::create()->findOneById($_GET['id']);
			$smarty->assign("zone", $zone);
			$smarty->assign("id", $_GET['id']);

			//$bannersObj = new BannerPeer();
			$banners = BannerQuery::getAllByZoneHydrated($_GET['id'],"weight");
			$smarty->assign("banners", $banners);
			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');
	}

}
