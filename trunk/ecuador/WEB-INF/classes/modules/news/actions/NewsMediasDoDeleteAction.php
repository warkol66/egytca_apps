<?php

class NewsMediasDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
		$media = NewsMediaQuery::create()->find($_POST["id"]);
		$this->smarty->assign('type',$media->getMediaTypeName());
		
		/* manejar esto
		if (!empty($_POST['ajaxFromArticle'])) {
			$this->template->template = 'TemplateAjax.tpl';
			$smarty->assign('id',$_POST["id"]);
			return $mapping->findForwardConfig('success-from-article');
		}*/
		
	}

}
