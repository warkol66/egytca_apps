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
		
		if (isset($_GET["name"]) && $_GET["name"] != '') {
			
			$name = $_GET["name"];
			$image_path = ConfigModule::get('headlines', 'clippingsPath');
			
			header('Content-Type: image/jpeg');
			readfile($image_path . $name);
			
		} else {
			throw new Exception('Invalid ID');
		}
	}
	
}