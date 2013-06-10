<?php

class HeadlinesAttachmentDownloadXAction extends BaseAction {

	function HeadlinesAttachmentDownloadXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (!empty($_POST['id'])) {
			
			$attachment = HeadlineAttachmentQuery::create()->findOneById($_POST['id']);

			if (!is_null($attachment)) {
				try {
					$attachment->download();
				} catch (Exception $e) {
					$smarty->assign('errorMessage', $e->getMessage());
					return $mapping->findForwardConfig('success');
				}
				
				$smarty->assign('name', $attachment->getName());
				return $mapping->findForwardConfig('success');
			} else {
				$smarty->assign('errorMessage', 'invalid ID');
				return $mapping->findForwardConfig('success');
			}
		} else {
			$smarty->assign('errorMessage', 'missing ID');
			return $mapping->findForwardConfig('success');
		}
	}
}