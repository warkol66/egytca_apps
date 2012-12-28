<?php
/**
 * BannersZonesDoEditAction
 *
 * Guarda los cambios a una zona existente del modulo de Banners, o crea una nueva
 * @package banners
 */
class BannersZonesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}

	protected function postUpdate() {
		parent::postUpdate();		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
	}

}
