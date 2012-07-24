<?php

class HeadlinesParsedSaveAllXAction extends BaseAction {

	function HeadlinesParsedSaveAllXAction() {
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
			$campaign = CampaignQuery::create()->findOneById($_GET["id"]);
			if (!is_null($campaign)) {
				
				$headlinesParsed = HeadlineParsedQuery::create()
								->filterByCampaign($campaign)
								->filterByStatus(array('max' => HeadlineParsedQuery::STATUS_PROCESSING))
								->find();
				if (!empty($headlinesParsed)) {
					foreach($headlinesParsed as $headline) {
						$newHeadline = new Headline();
						$newHeadline = Common::morphObjectValues($headline,$newHeadline);
		
						$newHeadline->buildInternalId();
						$headlineExist = HeadlineQuery::create()->findOneByInternalid($newHeadline->getInternalId());
						if(!$headlineExist && $newHeadline->isModified() && $newHeadline->save()) {
		
							//Creo el clipping
							require_once('WebkitHtmlRenderer.php');
							$url = $newHeadline->getUrl();
							$imagePath = ConfigModule::get('headlines', 'clippingsPath');
							if (!file_exists($imagePath))
								mkdir ($imagePath, 0777, true);
		
							$imageFullname = realpath($imagePath) . "/" . $newHeadline->getId() . ".jpg";
		
							$renderer = new WebkitHtmlRenderer();
							try {
								$renderer->putInQueue($url, $imageFullname, true);
							} catch (Exception $e) {
								$smarty->assign('errorMessage', $e->getMessage());
								return $mapping->findForwardConfig('success');
							}
							//Fin clipping

							$headline->setStatus(HeadlineParsedQuery::STATUS_PROCESSED);
							if($headline->isModified() && $headline->save()){
							}
						}
					}
				}
				return $mapping->findForwardConfig('success');
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
