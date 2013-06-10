<?php

require_once "HeadlineImageResampler.php";

class HeadlinesImageDoCreateResampledCopyAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_REQUEST['id'])) {
			$attachment = HeadlineAttachmentQuery::create()->findOneById($_REQUEST['id']);
			$input = $attachment->getRealpath();
			$output = $attachment->getSecondaryDataRealpath();
			try {
				HeadlineImageResampler::copyResampled($input, $output);
			} catch (Exception $e) {
				if ($_ENV['PHPMVC_MODE_CLI']) {
					throw $e;
				} else {
					$smarty->assign("errorMessage", $e->getMessage());
					return $mapping->findForwardConfig("success");
				}
			}
			
			return $mapping->findForwardConfig("success");
			
		} else {
			$smarty->assign("errorMessage", "ID paramater not found");
			return $mapping->findForwardConfig("success");
		}
	}
}