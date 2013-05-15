<?php

class BlogViewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preEdit() {
		parent::preEdit();
		
		if(isset($_GET["url"])){
			$entry = BlogEntryQuery::create()->findOneByUrl($_GET["url"]);
			if(is_object($entry))
				$_POST['id'] = $entry->getId();
			else
				$_POST['id'] = -1;
		}
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		
		$this->entity->increaseViews();
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		if ($moduleConfig['comments']['useComments']['value'] == "YES") {
			//si se la configuracion pide que se muestren los comentarios de forma directa
			if ($moduleConfig['comments']['displayComments']['value'] == 'YES') {
				$comments = BlogCommentQuery::create()->findByEntryIdAndStatus($this->entity->getId(),BlogComment::APPROVED);
				$this->smarty->assign("comments",$comments);
			}
		}
		
		if(isset($_SESSION['loginUser']) || isset($_SESSION['loginAffiliateUser']) || isset($_SESSION['loginClientUser']))
			$logged = true;
		
		$this->smarty->assign("logged", $logged); 
		$this->smarty->assign("entryDeleted", $this->entity->getDeletedAt('Y-m-d H:i:s')); 
		
		$this->template->template = "TemplateBlogPublic.tpl";
		
	}

}
