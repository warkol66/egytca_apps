<?php

require_once('WebkitHtmlRenderer.php');

class HeadlinesRenderUrlAction extends BaseAction {

	function HeadlinesRenderUrlAction() {
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
			
			$headline = HeadlineQuery::create()->findPK($_GET["id"]);

			if (!empty($headline)) {

				$smarty->assign("headline", $headline);
				$url = $headline->getUrl();
			
				$imagePath = ConfigModule::get('headlines', 'clippingsTmpPath');
				if (!file_exists($imagePath))
					mkdir ($imagePath, 0777, true);
			
				// borrar imagenes temporales viejas
				$tmpwatch = ConfigModule::get('global', 'tmpwatch');
				shell_exec($tmpwatch .' -d 1 '.$imagePath);

				$tempImg = 'cropme-'.uniqid().'.jpg';
				$imageFullname = $imagePath . $tempImg;
			
				$smarty->assign("id", $_GET["id"]);
			
				if (isset($_POST['manual']) && $_POST['manual'] == '1') {
					if ($_FILES["clipping"]["error"] > 0) {
						$smarty->assign('errorMessage', $_FILES['clipping']['error']);
						return $mapping->findForwardConfig('success');
					}
					else
						move_uploaded_file($_FILES["clipping"]["tmp_name"], $imageFullname);
				}
				else { // automatic
					$renderer = new WebkitHtmlRenderer();
					
					try {
						$renderer->render($url, $imageFullname);
					} catch (RenderException $e) {
						$smarty->assign("errorMessage", $e->getMessage());
						return $mapping->findForwardConfig('success');
					}
				}

				$smarty->assign("image", $tempImg);
				$smarty->assign("temp", true);
				
				list($displayedWidth, $displayedHeight) = Headline::getClippingDisplaySize($imageFullname);
				
				$smarty->assign('displayedWidth', $displayedWidth);
				$smarty->assign('displayedHeight', $displayedHeight);

			}
			else
				$smarty->assign("errorMessage", "invalidId");
		}
		else
			$smarty->assign("errorMessage", "invalidId");
		
		return $mapping->findForwardConfig('success');
	}
}