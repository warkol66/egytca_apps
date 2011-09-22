<?php

class HeadlinesViewClippingAction extends BaseAction {
	
	function HeadlinesViewClippingAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (isset($_GET["id"]) && $_GET["id"] != '') {
			
			$clippingsPath = ConfigModule::get("headlines","clippingsPath");
			$image_fullname = $clippingsPath.$_GET["id"].'.jpg';
			
			$smarty->assign('id', $_GET["id"]);
			
			if (file_exists($image_fullname)) {
				
				$smarty->assign('image', $image_fullname);
				
				require_once('HeadlinesLimitSize.inc.php');
			
				$smarty->assign('displayedWidth', $displayedWidth);
				$smarty->assign('displayedHeight', $displayedHeight);
			}
			
		} else {
			$smarty->assign("error_message", "ID inválido");
		}
		
		return $mapping->findForwardConfig('success');
	}
}