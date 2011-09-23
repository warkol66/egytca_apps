<?php

class HeadlinesGetClippingAction extends BaseAction {
	
	function HeadlinesGetClippingAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (isset($_GET["file"]) && $_GET["file"] != '') {
			
			$file = $_GET["file"];
			
			header('Content-Type: image/jpeg');
			readfile($file);
			
		} else {
			throw new Exception('Invalid ID');
		}
	}
	
}