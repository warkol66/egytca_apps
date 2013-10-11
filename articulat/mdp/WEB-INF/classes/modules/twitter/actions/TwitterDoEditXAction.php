<?php

class TwitterDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		//unset($this->entityParams["userId"]);
		$this->module = "Twitter";
		
		if(!empty($_POST['todo'])){
			switch($_POST['todo']){
				case 'discard':
				$this->entityParams['status'] = TwitterTweet::DISCARDED;
				$this->smarty->assign('discarded', true);
			}
			
		}
	}

	protected function postSave() {
		parent::postSave();

		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("tweet", $this->entity);
		
		if(isset($_POST['parsed']))
			$this->smarty->assign('parsed', true);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
