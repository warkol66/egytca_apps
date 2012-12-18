<?php
/**
 * ContentDoEditOrderXAction
 *
 * Permite mediante Ajax el cambio de orden de los banners disponibles
 * @package banners
 */
class BannersDoOrderByZoneXAction extends BaseAction {

	function BannersDoOrderByZoneXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Banners";
		$section = "Zones";

		parse_str($_POST['data']);

		for ($i = 0; $i < count($bannersList); $i++)
			BannerZoneRelationPeer::updateOrder($_POST['zoneId'], $bannersList[$i],$i);

		return $mapping->findForwardConfig('success');

	}

}
