<?php

class ModulesEntitiesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('ModuleEntity');
		
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$module = "Modules";
		$this->smarty->assign("module",$module);
		$section = "Entities";
		$this->smarty->assign("section",$section);
		
		$entityPeer = new ModuleEntityPeer();
		$fields = $entityPeer->getFieldNames(BasePeer::TYPE_FIELDNAME);	
		$this->smarty->assign("fields",$fields);
		
		$hiddens = array ( "id" => "getId", "do" => "moduleEntititesDoEdit", "action" => "$action" );
		$this->smarty->assign("hiddens",$hiddens);

	}

}

