<?php

class NewsMediasEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "News";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("articleIdValues",NewsArticleQuery::create()->find());
		$this->smarty->assign("types",NewsMedia::getMediaTypes());
		
		$maxUploadSize =  Common::maxUploadSize();
		$this->smarty->assign("maxUploadSize",$maxUploadSize);
		
	}

}