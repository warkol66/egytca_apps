<?php
/**
 * BannersListAction
 *
 * Muestra el lista do banners disponibles en el sistema
 * @package banners
 */
class BannersListAction extends BaseAction {

	function BannersListAction() {
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
		$banners = BannerPeer::getAll();
		$smarty->assign("banners", $banners);
		$smarty->assign("message", $_GET['message']);

		return $mapping->findForwardConfig('success');
	}

}
