<?php

require_once "HeadlineImageResampler.php";

class HeadlinesImageDoCreateResampledCopyAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		if (!empty($_REQUEST['id'])) {
			$attachment = HeadlineAttachmentQuery::create()->findOneById($_REQUEST['id']);
			$input = $attachment->getRealpath();
			$output = $attachment->getSecondaryDataRealpath();
			HeadlineImageResampler::copyResampled($input, $output);
			if (!file_exists($output))
				throw new Exception("failed to create $output - please check write permissions");
		}
	}
}