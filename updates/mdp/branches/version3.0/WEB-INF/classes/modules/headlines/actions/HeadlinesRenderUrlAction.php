<?php

require_once('WebkitHtmlRenderer.php');

class HeadlinesRenderUrlAction extends BaseAction {

	function HeadlinesRenderUrlAction() {
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
			
			$headline = HeadlinePeer::get($_GET["id"]);
			$url = $headline->getUrl();
			
			$image_path = ConfigModule::get('headlines', 'clippingsPath');
			$temp_img = 'cropme-'.uniqid().'.jpg';
			$image_fullname = $image_path . $temp_img;
			
			$renderer = new WebkitHtmlRenderer();
			
			try {
				$renderer->render($url, $image_fullname);
			} catch (RenderException $e) {
				$smarty->assign("error_message", $e->getMessage());
				return $mapping->findForwardConfig('success');
			}
			
			$smarty->assign("id", $_GET["id"]);
			$smarty->assign("image", $temp_img);
			$smarty->assign("image_path", $image_path);
			
			require_once('HeadlinesLimitSize.inc.php');
			
			$smarty->assign('displayedWidth', $displayedWidth);
			$smarty->assign('displayedHeight', $displayedHeight);
			
		} else {
			$smarty->assign("error_message", "ID inválido");
		}
		
		return $mapping->findForwardConfig('success');
	}
}