<?php
/**
* CommonMenuItemsEditAction
* 
* Muestra el formulario para permitir la edición de un menú
* 
*/

class CommonMenuItemsEditAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('MenuItem');
	}

	protected function postSelect() {
		parent::postSelect();
		
		$module = "Common";
		$this->smarty->assign("module",$module);
		$languages = Common::getAllLanguages();
		$this->smarty->assign("languages",$languages);
		$this->smarty->assign("actions",SecurityActionQuery::create()->find());

		if (isset($_GET['id'])){
			$this->smarty->assign('parentId', $this->entity->getParentId());
			$this->smarty->assign("params", $this->entity->getParams());
		}else{	
			$parentId = (empty($_GET['parentId'])) ? NULL : $_GET['parentId'];
			$this->smarty->assign("parentId",$parentId);

		}

	}

}
