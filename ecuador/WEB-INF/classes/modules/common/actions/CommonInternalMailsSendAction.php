<?php
/**
* CommonInternalMailsSend
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un internal mail y los actualiza en dicha base de datos.
* 
* @package common
*/

class CommonInternalMailsSendAction extends BaseEditAction {
	
	public function __construct() {
		parent::__construct('InternalMail');
	}
	
	protected function postEdit() {
		parent::postEdit();		
		$this->template->template = 'TemplateAjax.tpl';
	}

}
