<?php

// The parent class
require_once 'import/classes/om/BaseProductPeer.php';

// The object class
include_once 'import/classes/Product.php';

/**
 * Class ProductPeer
 *
 * @package Product
 */
class ProductPeer extends BaseProductPeer {

  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
    global $system;
    return $system["config"]["system"]["rowsPerPage"];
  }

  /**
   * Valida los parametros necesarios para la creacion de un producto
   *
   */
  private function validateParams($params,$productSupplierParams) {

  	$productVal = (!empty($params['code']) && !empty($params['name']));
  	$productSupplierVal = (!empty($productSupplierParams['supplierId']) && !empty($productSupplierParams['code']));

	return ($productVal && $productSupplierVal);

  }

  /**
   * Valida los parametros necesarios para la creacion de un producto en el caso de proveedor
   *
   */
  private function validateParamsSupplierCreation($params,$productSupplierParams) {

  	$productVal = (!empty($params['name']));
  	$productSupplierVal = (!empty($productSupplierParams['supplierId']) && !empty($productSupplierParams['code']));

	return ($productVal && $productSupplierVal);

  }  

  /**
  * Proceso de creacion de un producto nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto product
  * @param array $productSupplierParams Array asociativo con los atributos del objeto productSupplier
  * @return boolean true si se creo correctamente, false sino
  */
   private function createProcess($params,$productSupplierParams) {

	try {
      $productObj = new Product();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($productObj,$setMethod) ) {          
          if (!empty($value))
            $productObj->$setMethod($value);
          else
            $productObj->$setMethod(null);
        }
      }

	  if ($productObj->getStatus() == 0) {
	  	$productObj->setStatus(Product::STATUS_ACTIVE);
	  }

      $productObj->save();
	
	  $productSupplierParams['productId'] = $productObj->getId();
	  
	 require_once('ProductSupplier.php');
	
	  $productSupplierObj = new ProductSupplier();
      foreach ($productSupplierParams as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($productSupplierObj,$setMethod) ) {          
          if (!empty($value))
            $productSupplierObj->$setMethod($value);
          else
            $productSupplierObj->$setMethod(null);
        }
      }

	  $productSupplierObj->save();
      return $productObj;

    } catch (Exception $exp) {
      return false;
    }         
  }


  /**
  * Crea un product nueva en casos normales de sistema.
  *
  * @param array $params Array asociativo con los atributos del objeto product
  * @param array $productSupplierParams Array asociativo con los atributos del objeto productSupplier
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params,$productSupplierParams) {

	if (!ProductPeer::validateParams($params,$productSupplierParams)) {
		return false;
	}
	return ProductPeer::createProcess($params,$productSupplierParams);
	
  }

  /**
  * Crea un product nueva por un proveedor
  *
  * @param array $params Array asociativo con los atributos del objeto product
  * @param array $productSupplierParams Array asociativo con los atributos del objeto productSupplier
  * @return boolean true si se creo correctamente, false sino
  */  
  function createBySupplier($params,$productSupplierParams) {

	if (!ProductPeer::validateParamsSupplierCreation($params,$productSupplierParams)) {
		return false;
	}
	
	$params['status'] = Product::STATUS_SUPPLIER_ACTIVE;
	
	return ProductPeer::createProcess($params,$productSupplierParams);
	
  }
	
	/**
	* Actualiza la informacion de un product.
	*
    * @param array $params Array asociativo con los atributos del objeto product
    * @param array $productSupplierParams Array asociativo con los atributos del objeto productSupplier
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/  
	function update($params,$productSupplierParams) {
	
		if (!ProductPeer::validateParams($params,$productSupplierParams)) {
			return false;
		}

	
	    try {
		  $productObj = ProductPeer::retrieveByPK($params["id"]);
	      foreach ($params as $key => $value) {
	        $setMethod = "set".$key;
	        if ( method_exists($productObj,$setMethod) ) {          
	          if (!empty($value))
	            $productObj->$setMethod($value);
	          else
	            $productObj->$setMethod(null);
	        }
	      }

	      $productObj->save();

		  $productSupplierParams['productId'] = $productObj->getId();

          require_once('ProductSupplierPeer.php');

          $criteria = new Criteria();
          $criteria->add(ProductSupplierPeer::PRODUCTID,$productObj->getId());
          $result = ProductSupplierPeer::doSelect($criteria);
          $productSupplierObj = $result[0];

	      foreach ($productSupplierParams as $key => $value) {
	        $setMethod = "set".$key;
	        if ( method_exists($productSupplierObj,$setMethod) ) {          
			  if (!empty($value))
	            $productSupplierObj->$setMethod($value);
	          else
	            $productSupplierObj->$setMethod(null);
	        }
	      }
	
		  $productSupplierObj->save();

	      return true;

	    } catch (Exception $exp) {
	      return false;
	    }


	}    


	/**
	* Elimina un product a partir de los valores de la clave.
	*
  * @param int $id id del product
	*	@return boolean true si se elimino correctamente el product, false sino
	*/
  function delete($id) {
  	$productObj = ProductPeer::retrieveByPK($id);
	$productObj->setactive('0');
	try {
		$productObj->save();
	}
	catch (Exception $exp) {
		return false;
	}

	return true;
  }

  /**
  * Obtiene la informacion de un product.
  *
  * @param int $id id del product
  * @return array Informacion del product
  */
  function get($id) {
		$productObj = ProductPeer::retrieveByPK($id);
    return $productObj;
  }

  /**
  * Obtiene todos los products.
	*
	*	@return array Informacion sobre todos los products
  */
	function getAll() {
		$cond = new Criteria();
		$cond->add(ProductPeer::STATUS,'1');
		$alls = ProductPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los products paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los products
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ProductPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $cond->add(ProductPeer::STATUS,Product::STATUS_ACTIVE);
    $pager = new PropelPager($cond,"ProductPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

	/**
	* Obtiene todos los products inactivos.
	*
	*	@return array Informacion sobre todos los products
	*/
	function getAllInactive() {
		$cond = new Criteria();
		$cond->add(ProductPeer::STATUS,Product::STATUS_INACTIVE);
		$alls = ProductPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los products inactivos.
	*
	*	@return array Informacion sobre todos los products
	*/
	function getAllActivatedBySupplier() {
		$cond = new Criteria();
		$cond->add(ProductPeer::STATUS,Product::STATUS_SUPPLIER_ACTIVE);
		$alls = ProductPeer::doSelect($cond);
		return $alls;
	}

	
	/**
	* Activa un product.
	*
	* @param int $id id del product
	* @return true si fue exitosa, false sino.
	*/
	function activate($id) {
		$product = ProductPeer::retrieveByPK($id);
		$product->setStatus(Product::STATUS_ACTIVE);
		try {
			$product->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		
		return true;

	}
	
	/**
	 * Realiza una busqueda de producto por sus campos descriptivos.
	 * @param String $searchString Cadena de Busqueda
	 * @return array
	 */
	function search($searchString) {
		
		$criteria = new Criteria();
		$words = split(' ',$searchString);
		
		foreach ($words as $word) {
			
			$criterion = $criteria->getNewCriterion(ProductPeer::NAME,"%" . $word . "%",Criteria::LIKE);
			$criterion->addOr($criteria->getNewCriterion(ProductPeer::CODE,"%" . $word . "%", Criteria::LIKE));
			$criterion->addOr($criteria->getNewCriterion(ProductPeer::NAMESPANISH,"%" . $word . "%", Criteria::LIKE));
			$criterion->addOr($criteria->getNewCriterion(ProductPeer::DESCRIPTION,"%" . $word . "%", Criteria::LIKE));
			$criterion->addOr($criteria->getNewCriterion(ProductPeer::DESCRIPTIONSPANISH,"%" . $word . "%", Criteria::LIKE));
		
			$criteria->addOr($criterion);
		}
		
		$criteria->add(ProductPeer::STATUS,Product::STATUS_ACTIVE);
		$result = ProductPeer::doSelect($criteria);
		
		return $result;
		
	}
	
	/**
	 * Asigna el codigo de operacion de un producto a otro, reemplazandolo.
	 * el producto reasignado pasa a estado inactivo mientras que el otro producto pasa a estado activo.
	 * A su vez se actualizan las 
	 */
	function reassign($productReassign,$product) {

		try {
			$product->setCode($productReassign->getCode());
			$product->setStatus(Product::STATUS_ACTIVE);
			$productReassign->setStatus(Product::STATUS_INACTIVE);
			
			$product->save();
			$productReassign->save();
			
		} catch (PropelException $e) {
			return false;
		}
		
		return true;		
	}

}
?>
