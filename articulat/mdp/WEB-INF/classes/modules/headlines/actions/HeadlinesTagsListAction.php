<?php
/**
 * HeadlineTagsListAction
 *
 * Listado de Etiquetas de Titulares extendiendo BaseListAction
 *
 * @package    actors
 */
require_once 'BaseListAction.php';

class HeadlinesTagsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('HeadlineTag');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Headline";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "HeadlineTags");
	}
}
