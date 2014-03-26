<?php

class AngulardemoTweetDoDeleteAction extends BaseDoDeleteAction {
	
	public function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		echo '{"status": "no sabes, porque esto esta harcodeado"}';
		return;
	}
}