<?php

class HeadlinesRemoveTempImageXAction extends BaseAction {
	
	function HeadlinesRemoveTempImageXAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		
		unlink($_POST["filename"]);
	}
}