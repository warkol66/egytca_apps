<?php
/**
 * BannersZonesDoDeleteAction
 *
 * Elimina una zona del m�dulo de Banners
 * @package banners
 */
class BannersZonesDoDeleteAction  extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postDelete(){
		parent::postDelete();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
	}

}
