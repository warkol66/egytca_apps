<?php

require_once 'HeadlineImageResampler.php';

class HeadlinesOneTimeFixAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$attachmentsQuery = HeadlineAttachmentQuery::create();
		$attachmentsCount = $attachmentsQuery->count();
		$imagesAttachments = $attachmentsQuery->filterByType('image/jpg')->find();
		$imagesCount = count($imagesAttachments);
		
		foreach ($imagesAttachments as $attachment) {
			$filename = $attachment->getRealpath();
			HeadlineImageResampler::resample($filename);
			if (!file_exists($filename))
				throw new Exception('failed to resample '.$filename);
		}
?>

<div>
	<p>Total de Attachments: <?php echo $attachmentsCount?><p>
	<p>Total de imágenes: <?php echo $imagesCount?></p>
</div>
		
<?php
		return;
	}
}