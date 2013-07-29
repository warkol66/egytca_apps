<?php

class CalendarMediasDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('CalendarMedia');
		
	}
	
	protected function preDelete(){
		parent::preDelete();
		
		$media = CalendarMediaQuery::create()->findOneById($_POST["id"]);
		$this->smarty->assign('type',$media->getMediaTypeName());
		
		//elimina el archivo
		//Donde va a ir el archivo?
		$path = CalendarMedia::getSavePath();
		$destPath = $path . $media->getId();
		unlink($destPath);
		  
		$destPathResizes = $path .'/resizes/'. $media->getId();
		unlink($destPathResizes);
		$destPathThumbnails = $path . '/thumbnails/' .$media->getId();
		unlink($destPathThumbnails);
				
		/* manejar esto
		if (!empty($_POST['ajaxFromArticle'])) {
			$this->template->template = 'TemplateAjax.tpl';
			$smarty->assign('id',$_POST["id"]);
			return $mapping->findForwardConfig('success-from-event');
		}*/
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "CalendarMedias";
		$this->smarty->assign("module",$module);
		
	}

}
