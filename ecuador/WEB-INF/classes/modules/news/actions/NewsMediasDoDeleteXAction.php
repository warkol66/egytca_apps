<?php

class NewsMediasDoDeleteXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign('id',$_POST["id"]);
		
		//elimina el archivo
		$path = NewsMedia::getSavePath($this->entity->getMediaType());
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
		
	}

}
