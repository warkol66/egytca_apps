<?php

class CommonSchedulesSubscriptionsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('ScheduleSubscription');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Common";
		$this->smarty->assign("module",$module);
		
		if (isset($_GET['id'])){
			$moduleEntity = $this->entity->getModuleEntity();
			$this->smarty->assign('entityDateFields', $this->entity->getPosibleTemporalFields());
			$this->smarty->assign('entityNameFields', $this->entity->getPosibleNameFields());
			$this->smarty->assign('entityBooleanFields', $this->entity->getPosibleBooleanFields());
		}else{	
			$moduleEntity = new ModuleEntity();
		}

		$this->smarty->assign('moduleEntity',$moduleEntity);
		$this->smarty->assign("message",$_GET["message"]);

	}

}
