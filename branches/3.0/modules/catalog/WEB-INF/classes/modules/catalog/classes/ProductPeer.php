<?php

/**
 * Class ProductPeer
 *
 * @package Product
 */
class ProductPeer extends BaseProductPeer {

	private $searchCategoryId;
  private $searchAffiliateId;
	private $searchPriceFrom;
	private $searchPriceTo;
	private $searchCode;
  
  function __construct() {
    $this->searchCategoryId = 'all';
  }
  //mapea las condiciones del filtro
  var $filterConditions = array(
    "categoryId"=>"setSearchCategoryId",
    "affiliateId"=>"setSearchAffiliateId",
    "priceFrom"=>"setSearchPriceFrom",
    "priceTo"=>"setSearchPriceTo",
    "code"=>"setSearchCode"
  );
  
  function setSearchCategoryId($categoryId) {
    if ($categoryId === '')
      $categoryId = null;
    $this->searchCategoryId = $categoryId;
  }
  
  function setSearchAffiliateId($affiliateId) {
    $this->searchAffiliateId = $affiliateId;
  }
  
  function setSearchPriceFrom($priceFrom) {
    $this->searchPriceFrom = $priceFrom;
  }

  function setSearchPriceTo($priceTo) {
    $this->searchPriceTo = $priceTo;
  }

  function setSearchCode($productCode) {
    $this->searchCode = $productCode;
  }

  /**
  * Crea un product nuevo.
  *
  * @params array de parametros para crear el objeto.
  * @return objeto creado. False si ocurrio algun error.
	*/
	function create($params) {
    try {
			$productObj = new Product();
			foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($productObj,$setMethod) ) {          
          if (!empty($value) || $value == "0")
            $productObj->$setMethod($value);
          else
            $productObj->$setMethod(null);
        }
      }
      $image = $params['image'];
			if (!empty($image['tmp_name'])) {
				ProductPeer::createImages($image,$productObj->getId());
			}
      if (!empty($params['categoryId'])) {
        $category = CategoryQuery::create()->findPk($params['categoryId']);
        if (!empty($category))
          $productObj->addCategory($category);
      }
      $productObj->save();

	    return $productObj;
  	}
		catch (PropelException $e) {
		  if (ConfigModule::get("global","showPropelExceptions"))
        print_r($exp->getMessage());
      return false;
		}
	}
	
	/**
	* Chequea el tama�o y formato de la imagen.
	*
	* @param array $image Imagen
	* @return boolean true si es valida
	*/
	function checkImage($image) {
		global $system;
		if ( filesize($image['tmp_name']) <= $system["config"]["catalog"]["image"]["maxSize"]) {
			$parts = split('/',$image['type']);
			$format = $parts[1];
			$formats = $system["config"]["catalog"]["image"]["formats"];
			$valid = false;
			foreach( $formats as $ext => $value )
			{
				if ($value["value"] == "YES" && $ext == $format)
					$valid = true;
			}
			return $valid;
		}	
		else
			return false;
	}
	
	/**
	* Copia la imagen del producto y crea el thumbnail.
	*
	* @param array $image Imagen
	* @param string $name Nombre 
	* @return void
	*/	
	function createImages($image,$name) {		
		
		if (ProductPeer::checkImage($image)) {
			$uploadFile = 'WEB-INF/products/' . $name;
			move_uploaded_file($image['tmp_name'], $uploadFile);	
		
			global $system;	
			$width = $system["config"]["catalog"]["image"]["thumbnail"]["width"];
			$height = $system["config"]["catalog"]["image"]["thumbnail"]["height"];
			$resizeFormat = $system["config"]["catalog"]["image"]["thumbnail"]["resizeFormat"];
			
			$file = $uploadFile;
			list($actualWidth, $actualHeight) = getimagesize($file);
			
			switch ($resizeFormat) {
				case "1":
					$newWidth = $width;
					$newHeight = $height;
					break;
				case "2":
					$newHeight = $height;
					$perc = $newHeight / $actualHeight;
					$newWidth = $actualWidth * $perc;
					break;
				case "3":
					$newWidth = $width;
					$perc = $newWidth / $actualWidth;
					$newHeight = $actualHeight * $perc;			
					break;							
			}

			$tn = imagecreatetruecolor($newWidth, $newHeight);
			
			switch ($image['type']) {
				case "image/jpeg":
					$newImage = imagecreatefromjpeg($file);
					break;
				case "image/png":
					$newImage = imagecreatefrompng($file);
					break;				
			}
			
			imagecopyresampled($tn, $newImage, 0, 0, 0, 0, $newWidth, $newHeight, $actualWidth, $actualHeight);
			
			imagejpeg($tn, $uploadFile."_t0", 100); 	
		}
	
	}
	
  /**
  * Crea un product nuevo, reemplazando al producto de igual codigo, si existia.
  *
  * @params array de parametros del objeto.
  * @return objeto creado. False si ocurrio algun error.
	*/
	function createAndReplace($params) {
	  if (!isset($params['salesUnit']))  
      $params['salesUnit'] = 1;
    $productObj = ProductPeer::getByCode($params['code']);
    if (empty($productObj))
      $productObj = ProductPeer::create($params);
    else
      $productObj = ProductPeer::update($productObj->getId(), $params);
	}


  /**
  * Actualiza la informacion de un product.
  *
  * Por defecto el producto actualizado queda activado.
  * 
  * @params array de parametros.
  * @return objecto actualizado, false si pcurrio algun error.
	*/
  function update($id, $params) {
    // Por defecto vamos a activar el producto al actualizarlo.
    if (!isset($params['active']))
      $params['active'] = true;
    try {
  		$productObj = ProductPeer::get($id);
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($productObj,$setMethod) ) {          
          if (!empty($value) || $value == "0")
            $productObj->$setMethod($value);
          else
            $productObj->$setMethod(null);
        }
      }
      $image = $params['image'];
  		if (!empty($image['tmp_name'])) {
  			ProductPeer::createImages($image,$productObj->getId());
  		}
      if (!empty($params['categoryId'])) {
        $category = CategoryQuery::create()->findPk($params['categoryId']);
        if (!empty($category))
          $productObj->addCategory($category);
      }
  		$productObj->save();
  		return true;
    } catch (PropelException $e) {
      if (ConfigModule::get("global","showPropelExceptions"))
        print_r($exp->getMessage());
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
    $productObj->setActive(false);
	  $productObj->save();
		return true;
  }

	/**
	* Elimina todos los productos.
	*
	* @return void
	*/
  function deleteAll() {
    ProductQuery::create()->update(array('Active' => 'false'));
  }

	/**
	* Elimina todos los productos.
	*
	* @param int $categoryId Id de la categoria
	* @return void
	*/
  function deleteAllByCategoryId($categoryId) {
    ProductQuery::create()->filterByCategoryId($categoryId)->update(array('Active', false));
  }

  /**
  * Obtiene la informacion de un product.
  *
  * @param int $id id del product
  * @return array Informacion del product
  */
  function get($id) {
	$productObj = ProductQuery::create()->findPk($id);
    return $productObj;
  }
  
  /**
   * Devuelve una coleccion de objetos con las claves pasadas por parametro.
   * 
   * @param array $ids, ids de los productos
   * @return coleccion de productos.
   */
  function getByIds($ids) {
  	return ProductQuery::create()->findPks($ids);
  }
  
  /**
  * Obtiene todos los productos.
	*
	*	@return array Informacion sobre todos los products
  */
	function getAll() {
		return ProductQuery::create()->filterByActive(true)->find();
  }

  /**
  * Obtiene todos los productos con stock.
  *
  *	@return array Informacion sobre todos los products
  */
	function getAllWithStock() {
	  //regla de negocio, aquellos productos de precio cero no tienen stock y no pueden ser comprados.
		return ProductQuery::create()->filterByActive(true)
                                 ->filterByPrice(0, Criteria::NOT_EQUAL)
		                             ->find();
  }
  
  /**
  * Obtiene todos los productos paginados.
	*
	*	@return array Informacion sobre los productos
  */
	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		require_once("lib/util/PropelPager.php");
		$cond = new Criteria();
		$cond->add(ProductPeer::ACTIVE, true);
		$cond->addAscendingOrderByColumn(ProductPeer::CODE);

		$pager = new PropelPager($cond,"ProductPeer", "doSelect",$page,$perPage);
		return $pager;
	 }
	 
  /**
  * Obtiene un producto en base a su codigo.
	*
	* @param string $code Codigo del producto
	*	@return Product Producto con el codigo pasado como parametro
  */
	function getByCode($code) {
		return ProductQuery::create()->filterByCode($code)->findOne();
  }

  /**
  * Obtiene un producto en base a su codigo, quitando los guiones de los codigos de los productos.
	*
	* @param string $code Codigo del producto
	*	@return Product Producto con el codigo pasado como parametro
  */
	function getByCodeModified($code) {
	  $code = str_replace('-', '', $code);
		return ProductPeer::getByCode($code); 		
  }
  
  /**
  * Obtiene un producto en base al codigo de producto del afiliado.
	*
	* @param int $affiliateId Id del Afiliado
	* @param string $code Codigo del producto
	*	@return Product Producto con el codigo pasado como parametro
  */
	function getByAffiliateProductCode($affiliateId,$code) {
		require_once("AffiliateProductCodePeer.php");
		$affiliateProductCode = AffiliateProductCodePeer::getByAffiliateAndCode($affiliateId,$code);
		if (empty($affiliateProductCode) || $affiliateProductCode->getProductCode() == 0)
			return false;
		else
			return $affiliateProductCode->getProduct();
	}  

	/**
	* Actualiza el precio de un producto.
	*
	* @param string $code Codigo del producto
	* @param int $price Nuevo Precio
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function updatePrice($code,$price) {
		$product = ProductPeer::getByCode($code);

		global $system;
		
		$decimalSeparator = $system['config']['system']['parameters']['decimalSeparator'];

		if (!empty($product)) {

	/*		if ($decimalSeparator == ',') {
				//saco los . por ser posibles separadores de miles
				$price = str_replace('.','',$price);  
				//reemplazo la , del separador decimal por .
				$price = str_replace(',','.',$price);				
			}
	*/		$product->setPrice($price);
			$product->save();
			return true;
		}
		return false;
	}

  function doImportPrices($filename) {

      $archive = array();
      $rowsReaded = 0;
      $rowsCreated = 0;
      $errorCodes = array();
      $handle = fopen($filename, "r");
      $separator = ",";

      $data = fgetcsv($handle, 1000, $separator);

      if (stripos($data[0],';') !== false) {
              $semicolonSeparator = true;
              $separator = ";";
      }			

      //me posiciono al principio del archivo
      fseek($handle,0);

      //lee todo el archivo
      while (($data = fgetcsv($handle, 1000, $separator)) !== FALSE) {

              //si el ; es el separador, debo reformatear los numeros
              if ($semicolonSeparator) {
                      //saco los .
                      $data[1] = str_replace('.','',$data[1]);  
                      //reemplazo la , por .
                      $data[1] = str_replace(',','.',$data[1]);				
              }
              
              $archive[] = $data;
              $rowsReaded++;                       
      }
      
      fclose($handle); 

      if ($rowsReaded > 0) { 
//              AffiliateProductPeer::deletePrices($this->getId());				

              //procesamiento de filas de datos		
              foreach ($archive as $row) {
                      if (ProductPeer::updatePrice($row[0],$row[1])!= false) {
                              $rowsCreated++;
                      }
                      else {
                              $errorCodes[] = $row[0];
					  }

              }	
      }

      $result = array("rowsReaded" => $rowsReaded, "rowsCreated" => $rowsCreated, "errorCodes" => $errorCodes);
      
      return $result;
	
  }
  


  /**
  * Obtiene todos los productos paginados.
	*
	*	@return array Informacion sobre los productos
  */
	function getAllPaginatedFiltered($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new ProductQuery();
		$cond->filterByActive(true);
		
    //print_r($this->searchCategoryId);die;
    if ($this->searchCategoryId != 'all')
			$cond->filterByCategoryId($this->searchCategoryId);
      
    if (!empty($this->searchAffiliateId))
      $cond->filterByAffiliateId($this->searchAffiliateId);

    if (!empty($this->searchCode))
			$cond->filterByCode("%".$this->searchCode."%",Criteria::LIKE);
   	
    if ( !empty($this->searchPriceFrom) ) {
			$cond->filterByPrice($this->searchPriceFrom, Criteria::GREATER_EQUAL);
		}
    if ( !empty($this->searchPriceTo) ) {
    	$cond->filterByPrice($this->searchPriceTo, Criteria::LESS_EQUAL);
    }

		$pager = new PropelPager($cond,"ProductPeer", "doSelect",$page,$perPage);
		return $pager;
	 }
	
	/**
	* Obtiene todos los productos que cuelgan de alguna categoria.
	*
	* @return array Informacion sobre los productos
	*/
	function getAllCategorized() {
	  return ProductQuery::create()->filterByActive(true)
                                 ->join('ProductCategory')
                                 ->find();
	}
  
  function getAllUncategorized() {
    return ProductQuery::create()->filterByActive(true)
                                 ->join('ProductCategory', Criteria::LEFT_JOIN)
                                 ->where('ProductCategory.Categoryid IS NULL')
                                 ->find();
  }
  
}
