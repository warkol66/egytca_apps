<?php
/**
 * BannersDoWeightByZoneAction
 *
 * Guarda la informaci�n de pesos relativos de los banners de una zona
 * @package banners
 */
class BannersDoWeightByZoneAction extends BaseAction {

	function BannersDoWeightByZoneAction() {
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

		$result = BannerZoneRelationPeer::update($_POST['zoneId'], $_POST['banners']);

		if ($result)
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');
	}

}
