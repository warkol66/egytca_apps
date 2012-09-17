<?php

require_once "HeadlineImageResampler.php";

class HeadlinesImageDoResampleAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		if (!empty($_REQUEST['id'])) {
			$filename = HeadlineAttachmentQuery::create()->findOneById($_REQUEST['id'])->getRealpath();
			HeadlineImageResampler::resample($filename);
			if (!file_exists($filename))
				throw new Exception('failed to resample '.$filename);
		}
	}
}