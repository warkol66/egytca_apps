<?php

class NewsArticlesViewAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}
	
	protected function postSelect() {
		parent::postSelect();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$newsArticlesConfig = $moduleConfig["newsAticles"];
		$this->smarty->assign("newsArticlesConfig",$newsArticlesConfig);
		
		if(is_object($this->entity)){
			
			$this->entity->increaseViews();
			
			//si se la configuracion pide que se muestren los comentarios de forma directa
			if ($newsArticlesConfig['useComments']['value'] == "YES" && $newsArticlesConfig['displayNewsComments']['value'] == 'YES')
				$this->smarty->assign("comments",NewsCommentQuery::create()->filterByApprovedAndByArticle(1, $_GET["id"])->find());

		}
		
		$this->template->template = "TemplateNewsPublic.tpl";
	}

}
