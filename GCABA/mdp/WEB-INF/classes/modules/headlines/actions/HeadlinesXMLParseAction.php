<?php

class HeadlinesXMLParseAction extends BaseAction {
	
	function HeadlinesXMLParseAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$xmlData = file_get_contents('feed.xml');
		
		$parsedData = new SimpleXMLElement($xmlData);
		
		echo '<pre>';print_r($parsedData);echo '</pre><br/>';
	}
}
