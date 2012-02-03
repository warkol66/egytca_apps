<?php

class HeadlinesParsedSaveXAction extends BaseAction {

	function HeadlinesParsedSaveXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);

		if (!empty($_GET["id"])) {
			$headline = HeadlineParsedQuery::create()->findOneById($_GET["id"]);
			if (!is_null($headline)) {
				$newHeadline = new Headline();
				$newHeadline = Common::morphObjectValues($headline,$newHeadline);

				if($newHeadline->isModified() && $newHeadline->save()) {

					//Creo el clipping
					require_once('WebkitHtmlRenderer.php');
					$url = $headline->getUrl();
					$imagePath = ConfigModule::get('headlines', 'clippingsPath');
					if (!file_exists($imagePath))
						mkdir ($imagePath, 0777, true);

					$imageFullname = $imagePath . $headline->getId() . ".jpg";

					$renderer = new WebkitHtmlRenderer();
					$renderer->render($url, $imageFullname, true);
					//Fin clipping

					$headline->setStatus(HeadlineParsedQuery::STATUS_PROCESSED);
					if($headline->isModified() && $headline->save()){
					}
					$smarty->assign("headline",$headline);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
