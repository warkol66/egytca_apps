<?php

class AngulardemoTweetListAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$tweets = TwitterTweetQuery::create()
			->limit(100)
			->find();
		
		$this->smarty->assign('tweets', $tweets);
		
		$this->template->template = 'TemplatePlain.tpl';
		return $mapping->findForwardConfig('success');
	}
}
