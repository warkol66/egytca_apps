<?php

require_once('WebkitHtmlRenderer.php');

class HeadlinesRenderUrlAction extends BaseAction {
	
	private $uri;

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

		if ($_REQUEST["page"] > 0)
			$params["page"] = $_REQUEST["page"];

		if (!empty($_REQUEST["filters"]))
			$filters = $_REQUEST["filters"];

		$smarty->assign("filters", $filters);
		$smarty->assign("params", $params);
		$smarty->assign("page",$_REQUEST["page"]);

		if (isset($_GET["id"]) && $_GET["id"] != '') {
			
			if (empty($_GET['type']))
					$_GET['type'] = 'clipping';
			
			$headline = HeadlineQuery::create()->findOneById($_GET["id"]);
			if (empty($headline)) {
				$smarty->assign("errorMessage", "invalidId");
				return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');
			}
			
			$this->uri = $headline->getUrl();
			
			$smarty->assign("headline", $headline);
			$smarty->assign("type", $_GET['type']);
			$smarty->assign("id", $_GET["id"]);
			
			switch ($_GET['type']) {
				
				case 'clipping':
					
					$imagePath = ConfigModule::get('headlines', 'clippingsTmpPath');
					if (!file_exists($imagePath))
						mkdir ($imagePath, 0777, true);

					// borrar imagenes temporales viejas
					$tmpwatch = ConfigModule::get('global', 'tmpwatch');
					shell_exec($tmpwatch .' -d 1 '.$imagePath);

					$tempImg = 'cropme-'.uniqid().'.jpg';
					$imageFullname = realpath($imagePath) . "/" . $tempImg;

					try {
						$this->getImage($imageFullname);
					} catch (Exception $e) {
						$smarty->assign('errorMessage', $e->getMessage());
						return $mapping->findForwardConfig('success');
					}

					$smarty->assign("image", $tempImg);
					$smarty->assign("temp", true);

					list($displayedWidth, $displayedHeight) = Headline::getClippingDisplaySize($imageFullname);

					$smarty->assign('displayedWidth', $displayedWidth);
					$smarty->assign('displayedHeight', $displayedHeight);
					
					return $mapping->findForwardConfig('success');
					
				case 'attachment':
					
					$fileName = $headline->getId().'-'.uniqid().'.jpg'; // sin el .jpg el WebkitHtmlRenderer parece fallar
					$fileFullpath = realpath(ConfigModule::get('headlines', 'clippingsPath')).'/'.$fileName;
					
					try {
						$this->getImage($fileFullpath);
					} catch (Exception $e) {
						$smarty->assign('errorMessage', $e->getMessage());
						return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');
					}
					
					$attachment = new HeadlineAttachment();
					$attachment->fromArray(array(
						'Type' => 'image/jpg'
					,	'Name' => $fileName
					,	'Secondarydataname' => "r-$fileName"
					));
					
					require_once 'HeadlineImageResampler.php';
					HeadlineImageResampler::copyResampled(
						$attachment->getRealpath()
					,	$attachment->getSecondaryDataRealpath()
					);
					
					$headline->addHeadlineAttachment($attachment);
					$headline->save();
					
					$smarty->assign('attachment', $attachment);
					
					return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');

				default:
					$smarty->assign("errorMessage", "invalid destination");
					return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');
			}
		} else {
			$smarty->assign("errorMessage", "invalidId");
			return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');
		}
	}
	
	private function getImage($destination) {
		
		if (isset($_POST['manual']) && $_POST['manual'] == '1') {
			if ($_FILES["clipping"]["error"] > 0)
				throw new Exception($_FILES['clipping']['error']);
			
			move_uploaded_file($_FILES["clipping"]["tmp_name"], $destination);
		} else { // automatic
			$renderer = new WebkitHtmlRenderer();
			$renderer->render($this->uri, $destination);
		}
	}
}