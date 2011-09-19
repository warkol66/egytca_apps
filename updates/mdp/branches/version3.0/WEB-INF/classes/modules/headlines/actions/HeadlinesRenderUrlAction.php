<?php

class URLRenderer {
	
	private $command;
	
	function URLRenderer($command) {
		$this->command = $command;
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image = 'default_image.jpg') {
		$return_var;
		$output = array();
		exec($this->command . ' ' . $url . ' ' . $image,
			&$output, $return_var);
		
		if ($return_var != 0)
			throw new Exception("Unable to render image");
		
	}
	
}

class HeadlinesRenderUrlAction extends BaseAction {

	function HeadlinesRenderUrlAction() {
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

		if (isset($_GET["id"]) && $_GET["id"] != '') {
			
			$headline = HeadlinePeer::get($_GET["id"]);
			$url = $headline->getUrl();
			$temp_img = 'temp_headlineImage.jpg';
			
			switch (php_uname('s')) {
				case 'Linux':
					$renderer = new URLRenderer('./wkhtmltoimage-i386');
					break;
				default:
					$smarty->assign("error_message", "Actualmente solo hay soporte para Linux.");
					return $mapping->findForwardConfig('success');
			}
			
			try {
				$renderer->render($url, $temp_img);
			} catch (Exception $e) {
				$smarty->assign("error_message", $e->getMessage());
				return $mapping->findForwardConfig('success');
			}
			
			$smarty->assign("imageFileName", $temp_img);
			
		} else {
			$smarty->assign("error_message", "Not a valid ID");
		}
		
		return $mapping->findForwardConfig('success');
	}
}