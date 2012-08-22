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


			$newHeadline->fromJSON($headline->toJSON());
			$newHeadline->setId(NULL);



				$newHeadline->buildInternalId();
				$headlineExist = HeadlineQuery::create()->findOneByInternalid($newHeadline->getInternalId());
				if(!$headlineExist && $newHeadline->isModified() && $newHeadline->save()) {
					
					if ($headline->getCampaignid()) {
						//Creo el clipping
						require_once('WebkitHtmlRenderer.php');
						$url = $newHeadline->getUrl();
						$imagePath = ConfigModule::get('headlines', 'clippingsPath');
						if (!file_exists($imagePath))
							mkdir ($imagePath, 0777, true);

						$imageFullname = realpath($imagePath) . "/" . $newHeadline->getId() . ".jpg";

						$renderer = new WebkitHtmlRenderer();
						$renderer->render($url, $imageFullname, true, true);
						//Fin clipping
					} else {
						require_once('AutoDownloader.php');
						$attachmentsPath = ConfigModule::get('headlines', 'clippingsPath');
						if (!file_exists($attachmentsPath))
							mkdir ($attachmentsPath, 0777, true);
						if (!file_exists($attachmentsPath))
							throw new Exception("No se pudo crear el directorio $attachmentsPath. Verifique la configuración de permisos.");
						
						$downloader = new AutoDownloader();
						foreach ($headline->getHeadlineParsedAttachments() as $attachment) {
							$newAttachmentFullname = realpath($attachmentsPath)."/".$newHeadline->getId().'-'.uniqid();
							$newAttachment = new HeadlineAttachment();
							$newAttachment->setPath($newAttachmentFullname);
							$newAttachment->setLength($attachment->getLength());
							$newAttachment->setType($attachment->getType());
							
							$downloader->putInQueue($attachment->getPath(), $newAttachmentFullname);
							$newHeadline->addHeadlineAttachment($newAttachment);
						}
						$newHeadline->save();
					}

					$headline->setStatus(HeadlineParsedQuery::STATUS_PROCESSED);
					if($headline->isModified() && $headline->save()){
					}
				}
				$smarty->assign("headline",$headline);
				return $mapping->findForwardConfig('success');
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}
