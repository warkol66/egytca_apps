<?php
/**
* CommonInternalMailsSend
*
*  Action que genera un cambio de estado en la base de datos, le llegan datos de
*  un internal mail y los actualiza en dicha base de datos.
* 
* @package common
*/

class CommonInternalMailsSendAction extends BaseSelectAction {
	
	public function __construct() {
		parent::__construct('InternalMail');
	}
	
	protected function postSelect() {
		parent::postSelect();		
		$this->template->template = 'TemplateAjax.tpl';
		
		if(isset($_GET['error']))
			$this->smarty->assign('error',$_GET['error']);
			
		if(isset($_GET['success']))
			$this->smarty->assign('success',$_GET['success']);
	}

}
