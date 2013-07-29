<?php
/**
 * BannersDoClickThruAction
 *
 * Registra el clcik relacionado a un banner y redirecciona al url especificado
 * @package banners
 */

/**
 * Class BannersDoClickThruAction
 *
 * Registra el clcik relacionado a un banner y redirecciona al url especificado
 * @package banners
 * Se puede extender con DoEdit?
 */
class BannersDoClickThruAction extends BaseAction {

	function BannersDoClickThruAction() {
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

		$bannerId = $_GET['bannerId'];
		$zoneId = $_GET['zoneId'];
		$banner = BannerQuery::create()->findOneById($bannerId);

		if (is_object($banner)) {
			$url = $banner->getTargeturl();
			BannerClick::create($banner, $zoneId);
			if (!empty($url))
				header("Location: $url");
		}
		else
			return header("Location: " .$_SERVER['HTTP_REFERER']);

	}

}
