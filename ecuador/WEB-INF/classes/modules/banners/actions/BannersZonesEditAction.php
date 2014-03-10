<?php
/**
 * BannersZonesEditAction
 *
 * Muestra el formulario de edición de Zonas de Banners, con datos si existe, sin datos para una nueva
 * @package banners
 */
class BannersZonesEditAction  extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postSelect(){
		parent::postSelect();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
		/*		$rotationTypes = BannerZone::getRotationTypes();
			echo "Rota";
		print_r($rotationTypes);die;
		$smarty->assign("rotationTypes", $rotationTypes);
*/
	}

}
