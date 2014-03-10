<?php
/**
 * BannersPreviewAction
 *
 * Muestra una vista previa del banner
 * @package banners
 */
require_once('BannersInclude.php'); 

class BannersPreviewAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function preSelect(){
		parent::preSelect();
		
		if (!isset($_GET['id']))
			$_POST['id'] = -1;
	}
	
	protected function postSelect(){
		parent::postSelect();
		
		
		$this->smarty->assign("module","Banners");
		
		if(is_object($this->entity))
			$this->smarty->assign("mode", 'preview');
			
		//$this->template->template = "TemplatePlain.tpl";
		
	}

}
