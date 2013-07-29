<?php
/**
 * BannersZonesEditAction
 *
 * Muestra el formulario de edición de Zonas de Banners, con datos si existe, sin datos para una nueva
 * @package banners
 */
class BannersZonesEditAction  extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
		/*		$rotationTypes = BannerZone::getRotationTypes();
			echo "Rota";
		print_r($rotationTypes);die;
		$smarty->assign("rotationTypes", $rotationTypes);
*/
	}

}
