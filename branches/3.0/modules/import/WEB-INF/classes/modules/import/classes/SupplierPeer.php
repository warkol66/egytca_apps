<?php

// The parent class
require_once 'import/classes/om/BaseSupplierPeer.php';

// The object class
include_once 'import/classes/Supplier.php';

/**
 * Class SupplierPeer
 *
 * @package Supplier
 */
class SupplierPeer extends BaseSupplierPeer {

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
  * Crea un supplier nuevo.
  *
  * @param string $name name del supplier
  * @param int $active active del supplier
  * @return boolean true si se creo el supplier correctamente, false sino
	*/
	function create($params) {
	  $supplierObj = new Supplier();
	  try {

	      foreach ($params as $key => $value) {
	        $setMethod = "set".$key;
	        if ( method_exists($supplierObj,$setMethod) ) {          
	          if (!empty($value))
	            $supplierObj->$setMethod($value);
	          else
	            $supplierObj->$setMethod(null);
	        }
	      }
		  $supplierObj->setactive('1');
		  $supplierObj->save();
	
	  } catch (PropelException $e) {
	  	  return false;
	  }
		
	  return true;
	
	}

  /**
  * Actualiza la informacion de un supplier.
  *
  * @param int $id id del supplier
  * @param string $name name del supplier
  * @param int $active active del supplier
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($params) {
  	  
	  $supplierObj = SupplierPeer::retrieveByPK($params['id']);
	  try {

	      foreach ($params as $key => $value) {
	        $setMethod = "set".$key;
	        if ( method_exists($supplierObj,$setMethod) ) {          
	          if (!empty($value))
	            $supplierObj->$setMethod($value);
	          else
	            $supplierObj->$setMethod(null);
	        }
	      }
		  $supplierObj->setactive('1');
		  $supplierObj->save();
	
	  } catch (PropelException $e) {
	  	  return false;
	  }
		
	  return true;


  }

	/**
	* Elimina un supplier a partir de los valores de la clave.
	*
  * @param int $id id del supplier
	*	@return boolean true si se elimino correctamente el supplier, false sino
	*/
  function delete($id) {
  	$supplierObj = SupplierPeer::retrieveByPK($id);
	$supplierObj->setactive('0');
	try {
		$supplierObj->save();
	}
	catch (PropelException $exp) {
		return false;
	}

	return true;
  }

  /**
  * Obtiene la informacion de un supplier.
  *
  * @param int $id id del supplier
  * @return array Informacion del supplier
  */
  function get($id) {
		$supplierObj = SupplierPeer::retrieveByPK($id);
    return $supplierObj;
  }

  /**
  * Obtiene todos los suppliers.
	*
	*	@return array Informacion sobre todos los suppliers
  */
	function getAll() {
		$cond = new Criteria();
		$cond->add(SupplierPeer::ACTIVE,'1');
		$alls = SupplierPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los suppliers paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los suppliers
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	SupplierPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $cond->add(SupplierPeer::ACTIVE,'1');
    $pager = new PropelPager($cond,"SupplierPeer", "doSelect",$page,$perPage);
    return $pager;
   }    


	/**
	* Obtiene todos los suppliers inactivos.
	*
	*	@return array Informacion sobre todos los suppliers
	*/
	function getAllInactive() {
		$cond = new Criteria();
		$cond->add(SupplierPeer::ACTIVE,'0');
		$alls = SupplierPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Activa un Supplier.
	*
	* @param int $id id del supplier
	* @return true si es exitosa, false sino
	*/
	function activate($id) {

		$supplier = SupplierPeer::retrieveByPK($id);
		$supplier->setActive('1');
		try {
			$supplier->save();
		}
		catch(PropelException $exp) {
			return false;
		}
		
		return true;
		
	}	
}	

?>
