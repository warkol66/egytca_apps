<?php

class NewsMediasDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","News");
		
	}
	
	protected function postSave() {
		parent::postSave();
		
		$destPath = NewsMedia::getSavePath($this->entity->getMediaType());
		$destPath .= $this->entity->getId();

		//si el tipo es imagen
		if ($params["mediaType"] == NewsMedia::NEWSMEDIA_IMAGE && !empty($file['tmp_name']))
		NewsMedia::createImages($this->entity,$file,$this->entity->getId()); 
		//si el tipo es video
		if ($params["mediaType"] == NewsMedia::NEWSMEDIA_VIDEO && !empty($file['tmp_name']))
		NewsMediaPeer::createVideo($this->entity,$file,$this->entity->getId().".flv"); 
		//si el tipo es audio
		if ($params["mediaType"] == NewsMedia::NEWSMEDIA_SOUND && !empty($file['tmp_name']))
		NewsMediaPeer::createSound($this->entity,$file,$this->entity->getId().".mp3"); 

		
		/* Ver esto
		global $system;
  
		$saveOriginalFiles = $system["config"]["news"]["medias"]["saveOriginalFiles"]["value"];

		if ($saveOriginalFiles == "YES")
		  return copy($file["tmp_name"],$destPath);
		}*/

}
