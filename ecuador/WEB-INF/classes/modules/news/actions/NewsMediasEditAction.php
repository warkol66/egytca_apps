<?php

class NewsMediasEditAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
	}

	protected function postSelect() {
		parent::postSelect();
		
		$module = "News";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("articleIdValues",NewsArticleQuery::create()->find());
		$this->smarty->assign("types",NewsMedia::getMediaTypes());
		
		$maxUploadSize =  Common::maxUploadSize();
		$this->smarty->assign("maxUploadSize",$maxUploadSize);
		
	}

}
