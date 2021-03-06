<?php

class NewsArticlesEditAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
		
	}
	
	protected function postSelect(){
		parent::postSelect();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		$this->smarty->assign("actualAction", "newsArticlesEdit");
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$newsArticlesConfig = $moduleConfig["newsArticles"];
		$this->smarty->assign("newsArticlesConfig",$newsArticlesConfig);
		
		if ($newsArticlesConfig['useRegions']['value'] == "YES")
			$this->smarty->assign("regionIdValues",RegionQuery::create()->find());
		if ($newsArticlesConfig['useCategories']['value'] == "YES") {
			$this->smarty->assign("categoryIdValues",CategoryQuery::create()->find());
		}
		
		//migrar
		$newsMediasTypes = NewsMedia::getMediaTypes();
		
		$types = array();
		if ($moduleConfig["image"]["useImages"]["value"] == "NO")
			$types[NewsMedia::NEWSMEDIA_IMAGE] = 'Imagen';
		if ($moduleConfig["video"]["useVideo"]["value"] == "NO")
			$types[NewsMedia::NEWSMEDIA_VIDEO] = 'Video';
		if ($moduleConfig["audio"]["useAudio"]["value"] == "NO")
			$types[NewsMedia::NEWSMEDIA_SOUND] = 'Sonido';

		$this->smarty->assign("newsArticleStatus",NewsArticle::getStatuses());
		$this->smarty->assign("newsMediasTypes",array_diff_assoc($newsMediasTypes, $types));
		
		//si la accion es edit
		if (!empty($_GET["id"])){
			$this->smarty->assign("newsmedias",NewsMediaQuery::create()->filterByArticleid($_GET['id'])->find());
			$this->smarty->assign("images",$this->entity->getImages());
			$this->smarty->assign("sounds",$this->entity->getSounds());
			$this->smarty->assign("videos",$this->entity->getVideos());
		}
		
	}

}
