<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");
require_once("NewsMediaPeer.php");

class NewsArticlesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
		
	}
	
	protected function postEdit(){
		parent::postEdit();
		
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
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		
		//migrar
		$newsMediasTypes = NewsMediaPeer::getMediaTypes();
		
		$types = array();
		if ($moduleConfig["image"]["useImages"]["value"] == "NO")
			$types[NewsMediaPeer::NEWSMEDIA_IMAGE] = 'Imagen';
		if ($moduleConfig["video"]["useVideo"]["value"] == "NO")
			$types[NewsMediaPeer::NEWSMEDIA_VIDEO] = 'Video';
		if ($moduleConfig["audio"]["useAudio"]["value"] == "NO")
			$types[NewsMediaPeer::NEWSMEDIA_SOUND] = 'Sonido';

		$this->smarty->assign("newsArticleStatus",NewsArticlePeer::getStatus());
		$this->smarty->assign("newsMediasTypes",array_diff_assoc($newsMediasTypes, $types));
		
		//si la accion es edit
		if (!empty($_GET["id"])){
			$this->smarty->assign("newsmedias",NewsMediaPeer::getAll($_GET['id']));
			$this->smarty->assign("images",$this->entity->getImages());
			$this->smarty->assign("sounds",$this->entity->getSounds());
			$this->smarty->assign("videos",$this->entity->getVideos());
		}
		
		//ver redireccionam con filtros
		
	}

}
