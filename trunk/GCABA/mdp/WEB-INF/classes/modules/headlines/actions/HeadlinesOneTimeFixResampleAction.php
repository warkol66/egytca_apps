<?php

class HeadlinesOneTimeFixResampleAction extends BaseAction {
	
	function queueImage($id) {
		file_put_contents(
			"./WEB-INF/classes/modules/headlines/classes/autoresampler/queue/$id",
			"id=$id"
		);
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$queuedImagesCount = 0;
		
		if (!empty($_POST['go'])) {

			$images = HeadlineAttachmentQuery::create()
				->filterByType('image/jpg')
				->find();

			foreach ($images as $image) {
				if ($image->dataExists() && !$image->secondaryDataExists()) {
					$this->queueImage($image->getId());
					$queuedImagesCount++;
				}
			}
		}
?>

<div>
	<p>Archivos puestos en cola: <?php echo $queuedImagesCount?><p>
	<p>
		<form method="post" action="Main.php?do=headlinesOneTimeFixResample">
			<input type="hidden" name="go" value="1" />
			<input type="submit" value="filter and queue images" />
		</form>
	</p>
</div>
		
<?php
		return;
	}
}