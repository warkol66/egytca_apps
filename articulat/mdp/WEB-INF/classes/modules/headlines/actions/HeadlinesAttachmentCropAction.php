<?php

class HeadlinesAttachmentCropAction extends BaseAction {

	function HeadlinesAttachmentCropAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (empty($_GET['id'])) {
			$smarty->assign('errorMessage', 'invalidId');
			return $mapping->findForwardConfig('success');
		}
		
		$attachment = HeadlineAttachmentQuery::create()->findOneById($_GET["id"]);
		if (is_null($attachment)) {
			$smarty->assign('errorMessage', 'invalidId');
			return $mapping->findForwardConfig('success');
		}
		$smarty->assign('attachment', $attachment);
		
		list($displayedWidth, $displayedHeight) = Headline::getClippingDisplaySize($attachment->getRealpath());
		$smarty->assign('displayedWidth', $displayedWidth);
		$smarty->assign('displayedHeight', $displayedHeight);
		
		return $mapping->findForwardConfig('success');
	}
}