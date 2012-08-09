<?php
/**
 * ActorsListAction
 *
 * Listado de Actores extendiendo BaseListAction
 *
 * @package    actors
 */
require_once 'BaseListAction.php';

class ActorsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Actor');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Actor";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Actors");
	}
}
