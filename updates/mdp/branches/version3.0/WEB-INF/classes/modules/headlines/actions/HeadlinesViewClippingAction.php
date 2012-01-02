<?php

class HeadlinesViewClippingAction extends BaseAction {
	
	function HeadlinesViewClippingAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (isset($_GET["id"]) && $_GET["id"] != '') {
			
			$clippingsPath = ConfigModule::get("headlines","clippingsPath");
			$imageFullname = $clippingsPath.$_GET["id"].'.jpg';
			
			$smarty->assign('id', $_GET["id"]);
			
			if (file_exists($imageFullname)) {
				
				$smarty->assign('image', $_GET["id"].'.jpg');
				
				list($displayedWidth, $displayedHeight) = Headline::getClippingDisplaySize($imageFullname);
			
				$smarty->assign('displayedWidth', $displayedWidth);
				$smarty->assign('displayedHeight', $displayedHeight);
			}
		}
		else
			$smarty->assign("errorMessage", "ID inválido");

		if ($_GET["noTemplate"])
			$this->template->template = 'TemplateAjax.tpl';

		return $mapping->findForwardConfig('success');
	}
}