<?php
/**
 * BannersDoOrderByZoneAction
 *
 * Guarda la información de pesos relativos de los banners de una zona
 * @package banners
 */
class BannersDoOrderByZoneAction extends BaseAction {

	function BannersDoOrderByZoneAction() {
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
		$section = "Zones";

		$result = BannerZoneRelation::updateRel($_POST['zoneId'], $_POST['banners']);

		if (!$result)
			$smarty->assign("message", "orderError");
			/*return $mapping->findForwardConfig('success');
		else*/
		return $mapping->findForwardConfig('failure');
	}

}
