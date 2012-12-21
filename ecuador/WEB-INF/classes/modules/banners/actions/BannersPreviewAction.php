<?php
/**
 * BannersPreviewAction
 *
 * Muestra una vista previa del banner
 * @package banners
 */
class BannersPreviewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function preEdit(){
		parent::preEdit();
		//TODO: probar que pasa pasandole id vacio (asegurarse de que edit no cree un nuevo banner)
		if (!isset($_GET['bannerId']))
			$_POST['id'] = -1;

	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$this->template->template = "TemplatePlain.tpl";
		$this->smarty->assign("module","Banners");
		
		if(is_object($this->entity))
			$this->smarty->assign("mode", 'preview');
		
	}

}
