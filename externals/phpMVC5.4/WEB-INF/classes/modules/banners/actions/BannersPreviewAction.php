<?php
/**
 * BannersPreviewAction
 *
 * Muestra una vista previa del banner
 * @package banners
 */
require_once('BannersInclude.php'); 

class BannersPreviewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function preEdit(){
		parent::preEdit();
		
		if (!isset($_GET['id']))
			$_POST['id'] = -1;
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		
		$this->smarty->assign("module","Banners");
		
		if(is_object($this->entity))
			$this->smarty->assign("mode", 'preview');
			
		//$this->template->template = "TemplatePlain.tpl";
		
	}

}
