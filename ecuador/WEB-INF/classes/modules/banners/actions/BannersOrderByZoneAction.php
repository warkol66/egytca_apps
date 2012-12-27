<?php
/**
 * BannersOrderByZoneAction
 *
 * Muestra un formulario para guardar los pesos relativos de los banners en la zona
 * @package banners
 */
class BannersOrderByZoneAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
		if (is_object($this->entity)){
			$banners = BannerQuery::getAllByZoneHydrated($_GET['id'],"order");
			$this->smarty->assign("banners", $banners);
		}
		
		//ver failure
		
	}

}
