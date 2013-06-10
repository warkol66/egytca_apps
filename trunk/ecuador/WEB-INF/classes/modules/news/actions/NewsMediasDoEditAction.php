<?php

class NewsMediasDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
	}
	
	protected function preUpdate(){
		parent::preUpdate();

		//informacion del usuario
		$user = Common::getLoggedUser();
		if(is_object($user))
			$this->entityParams['userId'] = $user->getId();

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
		if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_IMAGE && !empty($_FILES["document_file"]['tmp_name']))
			NewsMedia::createImages($this->entity,$_FILES['document_file'],$this->entity->getId());
		//si el tipo es video
		if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_VIDEO && !empty($_FILES["document_file"]['tmp_name']))
			NewsMedia::createVideo($this->entity,$_FILES['document_file'],$this->entity->getId() . ".flv"); 
		//si el tipo es audio
		if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_SOUND && !empty($_FILES["document_file"]['tmp_name']))
			NewsMedia::createSound($_FILES['document_file'],$this->entity->getId() . ".mp3"); 

		
		/* Ver esto*/
		global $system;
  
		$saveOriginalFiles = $system["config"]["news"]["medias"]["saveOriginalFiles"]["value"];

		if ($saveOriginalFiles == "YES")
		  copy($file["tmp_name"],$destPath);
		

	}
	
}
