<?php

class AngulardemoTweetDoEditAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$this->template->template = 'TemplatePlain.tpl';
		
		$this->smarty->assign('twitterTweet', $this->entity);
		$this->smarty->display('AngulardemoTweetDoEdit.tpl');
	}
}
