<?php

class BoardEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BoardChallenge');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Board";
		$this->smarty->assign("module",$module);
		
		/*$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["boardChallenges"];
		$this->smarty->assign("boardConfig",$moduleConfig["boardChallenges"]);*/

		//users, statuses y bonds
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		$this->smarty->assign("boardChallengeStatus",BoardChallenge::getStatuses());
		$this->smarty->assign("bonds",BoardBondQuery::create()->find());
	}

}