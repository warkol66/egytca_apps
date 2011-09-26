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
			
			$imagePath = ConfigModule::get('headlines', 'clippingsTmpPath');
			if (!file_exists($imagePath))
				mkdir ($imagePath, 0777, true);
			
			// borrar imagenes temporales viejas
			$tmpwatch = ConfigModule::get('global', 'tmpwatch');
			shell_exec($tmpwatch .' -d 1 '.$imagePath);

			$tempImg = 'cropme-'.uniqid().'.jpg';
			$imageFullname = $imagePath . $tempImg;
			
			$renderer = new WebkitHtmlRenderer();
			
			try {
				$renderer->render($url, $imageFullname);
			} catch (RenderException $e) {
				$smarty->assign("errorMessage", $e->getMessage());
				return $mapping->findForwardConfig('success');
			}
			
			$smarty->assign("id", $_GET["id"]);
			$smarty->assign("image", $tempImg);
			$smarty->assign("imagePath", $imagePath);
			
			require_once('HeadlinesLimitSize.inc.php');
			
			$smarty->assign('displayedWidth', $displayedWidth);
			$smarty->assign('displayedHeight', $displayedHeight);
			
		} else {
			$smarty->assign("errorMessage", "ID inválido");
		}
		
		return $mapping->findForwardConfig('success');
	}
}