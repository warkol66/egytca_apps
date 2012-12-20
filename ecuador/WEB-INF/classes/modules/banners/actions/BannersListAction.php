<?php
/**
 * BannersListAction
 *
 * Muestra el lista do banners disponibles en el sistema
 * @package banners
 */
class BannersListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","Banners");
		
	}

}
