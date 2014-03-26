<?php

class AngulardemoTweetDoEditAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('TwitterTweet');
	}

	protected function preUpdate() {
		parent::preUpdate();

	}
	
	protected function postSave() {
		parent::postSave();
		$this->template->template = 'TemplatePlain.tpl';
	}
}
