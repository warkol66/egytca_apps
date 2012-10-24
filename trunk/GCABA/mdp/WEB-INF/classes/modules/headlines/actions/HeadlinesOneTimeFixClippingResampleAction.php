<?php

class HeadlinesOneTimeFixClippingResampleAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		if (!empty($_POST['go'])) {
			
			$headlines = HeadlineQuery::create()->find();

			foreach ($headlines as $headline) {
				$headline = new Headline();
				if ($headline->hasClipping(Headline::CLIPPING_NORMAL)
					&& !$headline->hasClipping(Headline::CLIPPING_RESIZED)) {
					
					require_once 'HeadlineImageResampler.php';
					HeadlineImageResampler::copyResampled(
						$headline->getClippingFullname(Headline::CLIPPING_NORMAL)
						, $headline->getClippingFullname(Headline::CLIPPING_RESIZED)
					);
				}
			}
			echo "<p>done</p>";
		}
?>

<div>
	<p>
		<form method="post" action="Main.php?do=headlinesOneTimeFixClippingResample">
			<input type="hidden" name="go" value="1" />
			<input type="submit" value="filter and queue images" />
		</form>
	</p>
</div>
		
<?php
		return;
	}
}