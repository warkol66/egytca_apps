<?php
/**
 * BannersZonesListAction
 *
 * Muestra el listado de Zonas de Banners disponibles en el sistema
 * @package banners
 */
class BannersZonesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
	}

}
