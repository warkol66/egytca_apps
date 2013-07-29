<?php

class NewsMediasArticleListAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
		if(is_object($this->entity)){
			$this->smarty->assign("images",$this->entity->getImages());
			$this->smarty->assign("sounds",$this->entity->newsArticle->getSounds());
			$this->smarty->assign("videos",$this->entity->getVideos());
		}

 		$this->smarty->assign("created",$_REQUEST["created"]);
		
		//$this->template->template = 'TemplateAjax.tpl';
	}

}
