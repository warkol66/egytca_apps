<?php

class HeadlinesViewAttachmentsAction extends BaseAction {
	
	function HeadlinesViewAttachmentsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($request->getParameter('noTemplate'))
			$this->template->template = 'TemplateAjax.tpl';

		$headlineId = $request->getParameter('id');
		if ($headlineId > 0) {

			$headline = HeadlineQuery::create()->findOneById($headlineId);
			if (!empty($headline)) {
				
				$images = array();
				$audios = array();
				$videos = array();
				$missing = array();
				foreach ($headline->getHeadlineAttachments() as $attachment) {
					if (file_exists(ConfigModule::get('headlines', 'clippingsPath').'/'.$attachment->getName())) {
						switch ($attachment->getType()) {
							
							case 'image/jpg':
								$image = array('name' => $attachment->getName());
								list($displayedWidth, $displayedHeight) = Headline::getClippingDisplaySize($attachment->getName());
								$image['displayedWidth'] = $displayedWidth;
								$image['displayedHeight'] = $displayedHeight;
								$images []= $image;
								break;
							
							case 'audio/mpeg':
								echo "audio<br/>";
								$audios []= $attachment;
								break;
							
							case 'video/x-ms-wmv':
								echo "video<br/>";
								$videos []= $attachment;
								break;
							
							default:
								echo "default<br/>";
								break;
						}
					} else {
						$missing []= $attachment;
					}
				}
				
				$smarty->assign('headline', $headline);
				$smarty->assign('images', $images);
				$smarty->assign('audios', $audios);
				$smarty->assign('videos', $videos);
				$smarty->assign('missingAttachments', $missing);
			}
		}
		else
			$smarty->assign("errorMessage", "ID inválido");

		return $mapping->findForwardConfig('success');
	}
}