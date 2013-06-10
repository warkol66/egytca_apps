<?php

class HeadlinesGetClippingAction extends BaseAction {
	
	function HeadlinesGetClippingAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (isset($_GET["image"]) && $_GET["image"] != '') {
			if (isset($_GET["temp"]) && $_GET["temp"] == '1') 
				$imagePath = ConfigModule::get('headlines', 'clippingsTmpPath');
			else
				$imagePath = ConfigModule::get('headlines', 'clippingsPath');
			
			$imageFullname = $imagePath.$_GET["image"];
			
			header('Content-Type: image/jpeg');
			readfile($imageFullname);
			
		}
		else
			throw new Exception('Invalid ID');
	}
	
}