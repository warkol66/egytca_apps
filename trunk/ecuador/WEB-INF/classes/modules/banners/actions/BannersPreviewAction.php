<?php
/**
 * BannersPreviewAction
 *
 * Muestra una vista previa del banner
 * @package banners
 */
class BannersPreviewAction extends BaseAction {

	function BannersPreviewAction() {
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

		$this->template->template = "TemplatePlain.tpl";

		$module = "Banners";
		$smarty->assign("module",$module);

		if (isset($_GET['bannerId'])) {
			try {
				$banner = BannerQuery::create()->findOneById($_GET['id']);
				if (is_object($banner)) {
					$smarty->assign("banner", $banner);
					$smarty->assign("mode", 'preview');
					return $mapping->findForwardConfig('success');
				}
			}
			catch (PropelException $e) {
			}
		}

		return $mapping->findForwardConfig('failure');
	}

}
