<?php

class NewsMediasDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
		$media = NewsMediaQuery::create()->findOneById($_POST["id"]);
		$this->smarty->assign('type',$media->getMediaTypeName());
		
		//elimina el archivo
		$path = NewsMedia::getSavePath($newsmediaObj->getMediaType());
		$destPath = $path . $this->entity->getId();
		unlink($destPath);
		
		//si el tipo es imagen
		if ($this->entity->getMediaType() == NewsMedia::NEWSMEDIA_IMAGE) {    
		$destPathResizes = $path .'/resizes/'. $this->entity->getId();
		unlink($destPathResizes);
		$destPathThumbnails = $path . '/thumbnails/' .$this->entity->getId();
		unlink($destPathThumbnails);
		}

		//si el tipo es video
		if ($this->entity->getMediaType() == NewsMedia::NEWSMEDIA_VIDEO) {
		$destPathFlv = $path .'/flv/' . $this->entity->getId(). '.flv';
		unlink($destPathFlv);
		$destPathThumbnails = $path . '/thumbnails/' .$this->entity->getId(). '.jpg';
		unlink($destPathThumbnails);
		}  

		//si el tipo es audio
		if ($this->entity->getMediaType() == NewsMedia::NEWSMEDIA_SOUND) {
		global $moduleRootDir;
		$destPathMp3 = $moduleRootDir.'audio/' . $this->entity->getId() . '.mp3';
		unlink($destPathMp3);
		}   

		
		/* manejar esto
		if (!empty($_POST['ajaxFromArticle'])) {
			$this->template->template = 'TemplateAjax.tpl';
			$smarty->assign('id',$_POST["id"]);
			return $mapping->findForwardConfig('success-from-article');
		}*/
		
	}

}
