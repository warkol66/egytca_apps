<?php

class BoardViewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preEdit() {
		parent::preEdit();
		
		if(isset($_GET["url"])){
			$entry = BoardChallengeQuery::create()->findOneByUrl($_GET["url"]);
			if(is_object($entry))
				$_POST['id'] = $entry->getId();
			else
				$_POST['id'] = -1;
		}
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Board";
		$this->smarty->assign("module",$module);
		
		$this->entity->increaseViews();
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		if ($moduleConfig['comments']['useComments']['value'] == "YES") {
			//busco los compromisos posibles
			$bonds = BoardBondQuery::create()->find();
			//si se la configuracion pide que se muestren los comentarios de forma directa
			if ($moduleConfig['comments']['displayComments']['value'] == 'YES') {
				$comments = BoardCommentQuery::create()->findByChallengeIdAndStatus($this->entity->getId(),BoardComment::APPROVED);
				$this->smarty->assign("comments",$comments);
			}
		}
		
		$this->smarty->assign("challengeDeleted", $this->entity->getDeletedAt('Y-m-d H:i:s')); 
		
		$this->template->template = "TemplateBlogPublic.tpl";
		
	}

}
