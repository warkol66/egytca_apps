<?php
/**
* TemplatesListAction
*
*  Action administrativo utilizado para mostrar los documentos existentes
*
* @package templates
*/

class TemplatesListAction extends BaseListAction {

	function __construct() {
		parent::__construct('Template');
	}

	protected function preList() {
		parent::preList();

	}

	protected function postList() {
		parent::postList();

	}

}