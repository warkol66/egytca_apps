<?php

/** 
 * The skeleton for this class was autogenerated by Propel  on:
 *
 * [04/09/07 17:03:34]
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package anmaga 
 */
class Product extends BaseProduct {

	public function __toString() {
		return $this->getDescription();
	}

	public function getPrice() {
		if (Common::isAffiliatedUser() && AffiliateProductPeer::affiliateHasPriceList(Common::getAffiliatedId())) {
      return AffiliateProductQuery::create()->join('Product')
                                     ->filterByAffiliateId(Common::getAffiliatedId())
                                     ->useQuery('Product')
                                      ->filterByPrimaryKey($this->getPrimaryKey())
                                     ->endUse()
                                     ->select('Price')
                                     ->findOne();
		}
		
		return parent::getPrice();
	}
	
	/**
	 * Obtiene el precio de producto para el afiliado para los casos de precio de producto diferenciado.
	 * En caso de no tener un codigo diferenciado devuelve 0
	 * @param $affiliateId codigo de afiliado
	 * @return float precio de producto diferenciado
	 */
	public function getAffiliatePrice($affiliateId) {
	
		$cond = new Criteria();
		$cond->add(AffiliateProductPeer::AFFILIATEID,$affiliateId);
		$cond->add(AffiliateProductPeer::PRODUCTID,$this->getId());
		$todosObj = AffiliateProductPeer::doSelect($cond);
		//si se pidiera un precio a uno que no lo tiene, se devolvera 0, que para anmaga significa como que ese producto no esta disponible
		if (empty($todosObj))
			return '0';
			
		$specialPrice= $todosObj[0];
		return $specialPrice->getPrice();

	}
	
	/**
	 * Obtiene el codigo de producto para el afiliado para los casos de codigo de producto diferenciado.
	 * En caso de no tener un codigo diferenciado devuelve el codigo real de producto
	 * @param $affiliateId codigo de afiliado
	 * @return string codigo de producto diferencial
	 */
	public function getAffiliateCode($affiliateId) {
	
		$cond = new Criteria();
		$cond->add(AffiliateProductCodePeer::AFFILIATEID,$affiliateId);
		$cond->add(AffiliateProductCodePeer::PRODUCTCODE,$this->getCode());
		$todosObj = AffiliateProductCodePeer::doSelect($cond);
		//si el codigo diferenciado no existe se devuelve el real del producto
		if (empty($todosObj))
			return $this->getCode();

		$code = $todosObj[0];
		return $code->getProductCodeAffiliate();
	
	}

	/**
	 * Obtiene el codigo de producto para el afiliado para los casos de codigo de producto diferenciado.
	 * En caso de no tener un codigo diferenciado devuelve el codigo real de producto
	 * @param $affiliateId codigo de afiliado
	 * @return string codigo de producto diferencial
	 */
	public function getImagePath() {
		global $moduleRootDir;

  	if (file_exists($moduleRootDir."WEB-INF/products/" . $this->getCode() . ".jpg"))
			return "productImages/".$this->getCode();
		else
			return;
	}

	/**
	* Obtiene el id de todas las categorķas de producto asignadas.
	*
	*	@return array Id de todos los product category de un product
	*/
	function getAssignedCategoriesArray(){
		$categories = ProductCategoryQuery::create()->select('Categoryid')->filterByProduct($this)->find()->toArray();
		return $categories;
	}

	/**
	 * Devuelve el color de nivel de stock para el producto
	 * @return string nombre de la clase a mostrar
	 */
	public function getStockLevel() {
		$stockAlert = $this->getStockAlert();
		switch ($stockAlert) {
			case '1':
				$class = "Red";
				break;
			case '2':
				$class = "Yellow";
				break;
			case '3':
				$class = "Green";
				break;
			default:
				$class = "Grey";
				break;
		}

		return $class;
	}

}
