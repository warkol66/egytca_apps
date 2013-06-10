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
					if ($attachment->dataExists()) {
						switch ($attachment->getType()) {
							
							case 'image/jpg':
								$images []= $attachment;
								break;
							
							case 'audio/mpeg':
								$audios []= $attachment;
								break;
							
							case 'video/x-ms-wmv':
								$videos []= $attachment;
								break;
							
							default:
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