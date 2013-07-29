<?php

class NewsMediasUploadAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('CalendarMedia');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","CalendarMedias");
		
	}
	
	protected function postSave() {
		parent::postSave();
		
		$destPath = CalendarMedia::getSavePath($this->entity->getMediaType());
		$destPath .= $this->entity->getId();

		//si el tipo es imagen
		//if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_IMAGE && !empty($_FILES["document_file"]['tmp_name']))
		CalendarMedia::createImages($this->entity,$_FILES['document_file'],$this->entity->getId());

		/* Ver esto*/
		global $system;
  
		$saveOriginalFiles = $system["config"]["calendar"]["medias"]["saveOriginalFiles"]["value"];

		if ($saveOriginalFiles == "YES")
		  copy($_FILES["document_file"]["tmp_name"],$destPath);

	}
	
}
