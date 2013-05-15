<?php

class NewsArticlesViewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
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
		
		if(isset($_SESSION['loginUser']) || isset($_SESSION['loginAffiliateUser']) || isset($_SESSION['loginClientUser']))
			$logged = true;
		
		$this->smarty->assign("logged", $logged);
		
		$this->template->template = "TemplateNewsPublic.tpl";
	}

}
