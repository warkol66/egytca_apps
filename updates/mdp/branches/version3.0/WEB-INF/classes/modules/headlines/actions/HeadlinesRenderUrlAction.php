<?php

class URLRenderer {
	
	private $command;
	
	function URLRenderer() {
		/**** debug ***/
		echo "tu sistema operativo (" . phpuname('s') . "), ¿es 'Windows'?<br>";
		/**************/
		
		switch (php_uname('s')) {
			case 'Linux':
				$this->command = './wkhtmltoimage-i386';
				echo "estoy en linux!!<br>";//debug
				break;
			case 'Windows':
				$this->command = '';//falta comando!!
				echo "estas en Windows!!<br>";//debug
				break;
		}
	}
	
	/**
	 *
	 * @param string $url
	 * @param string $image
	 */
	function render($url, $image) {
		$return_var;
		$output = array();
		exec($this->command . ' ' . $url . ' ' . $image,
			&$output, $return_var);
	
		echo "ret: <br>";print_r($return_var);echo "<br>";//debug
		
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
			$renderer = new URLRenderer();
			
			try {
				$renderer->render($url, $temp_img);
				$smarty->assign("imageFileName", $temp_img);
			} catch (Exception $e) {
				$smarty->assign("error_message", $e->getMessage());
			}
			
		} else {
			$smarty->assign("error_message", "Not a valid ID");
		}
		
		return $mapping->findForwardConfig('success');
	}
}