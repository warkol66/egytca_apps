<?php
/**
* DocumentsAddAction
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un documento y los actualiza en dicha base de datos.
* 
* @package documents
*/

class DocumentsAddAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('Document');
	}
	
	protected function postEdit() {
		parent::postEdit();		
		$this->template->template = 'TemplateAjax.tpl';
	}

}
