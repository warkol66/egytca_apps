<?php
/**
 * BannersDoEditAction
 *
 * Guarda los cambios de los banners actuales o los datos de uno nuevo
 * @package banners
 */
class BannersDoEditAction extends BaseAction {

	function BannersDoEditAction() {
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

		$campaignStartDate = $_POST['campaignStartDate']['Year'] . '-' . $_POST['campaignStartDate']['Month'] . '-' . $_POST['campaignStartDate']['Day'];
		$campaignFinalDate = $_POST['campaignFinalDate']['Year'] . '-' . $_POST['campaignFinalDate']['Month'] . '-' . $_POST['campaignFinalDate']['Day'];
		if (empty($_POST['bannerId'])) {
			$result = $banner = BannerPeer::create($_POST['name'], $_POST['clientId'], $_POST['targetUrl'], $_POST['altText'], $_POST['description'], $_POST['printsTotal'], $_POST['printsLeft'], $_POST['frequency'], $campaignStartDate, $campaignFinalDate, $_FILES['content'], $_POST['zones'], $_POST['linkTarget'], $_POST['active'], $_POST['width'], $_POST['height']);
			if($result)
				return $mapping->findForwardConfig('success');
		}
		else {
			$result = $banner = BannerPeer::update($_POST['bannerId'], $_POST['name'], $_POST['clientId'], $_POST['targetUrl'], $_POST['altText'], $_POST['description'], $_POST['printsTotal'], $_POST['printsLeft'], $_POST['frequency'], $campaignStartDate, $campaignFinalDate, $_FILES['content'], $_POST['zones'], $_POST['linkTarget'], $_POST['active'], $_POST['width'], $_POST['height']);
			if($result)
				return $mapping->findForwardConfig('success');

		}

		return $mapping->findForwardConfig('failure');

	}

}
