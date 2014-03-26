<?php

class AngulardemoTweetEditAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->template->template = 'TemplatePlain.tpl';
	}
}