<?php

require 'import/classes/om/BaseSupplierPurchaseOrderBankTransferPeer.php';
require_once('import/classes/SupplierPurchaseOrderBankTransfer.php');

/**
 * Skeleton subclass for performing query and update operations on the 'import_supplierPurchaseOrderBankTransfer' table.
 *
 * Transferencias bancarias realizadas a esa orden de pedido a proveedor
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class SupplierPurchaseOrderBankTransferPeer extends BaseSupplierPurchaseOrderBankTransferPeer {

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
	  * Crea un product nueva.
	  *
	  * @param array $params Array asociativo con los atributos del objeto product
	  * @param array $bankTransferSupplierParams Array asociativo con los atributos del objeto productSupplier
	  * @return boolean true si se creo correctamente, false sino
	  */  
	  function create($params) {

		try {
		
	      $bankTransferObj = new SupplierPurchaseOrderBankTransfer();
	      foreach ($params as $key => $value) {
	        $setMethod = "set".$key;
	        if ( method_exists($bankTransferObj,$setMethod) ) {          
	          if (!empty($value))
	            $bankTransferObj->$setMethod($value);
	          else
	            $bankTransferObj->$setMethod(null);
	        }
	      }
		
		  $bankTransferObj->setCreatedAt(time());
	      $bankTransferObj->save();

	      return true;

	    } catch (Exception $exp) {
	      return false;
	    }         
	  }

		/**
		* Actualiza la informacion de un product.
		*
	    * @param array $params Array asociativo con los atributos del objeto product
	    * @param array $bankTransferSupplierParams Array asociativo con los atributos del objeto productSupplier
		* @return boolean true si se actualizo la informacion correctamente, false sino
		*/  
		function update($params) {

		    try {
			  $bankTransferObj = SupplierPurchaseOrderBankTransferPeer::retrieveByPK($params["id"]);
		      foreach ($params as $key => $value) {
		        $setMethod = "set".$key;
		        if ( method_exists($bankTransferObj,$setMethod) ) {          
		          if (!empty($value))
		            $bankTransferObj->$setMethod($value);
		          else
		            $bankTransferObj->$setMethod(null);
		        }
		      }

		      $bankTransferObj->save();

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
	  	$bankTransferObj = SupplierPurchaseOrderBankTransferPeer::retrieveByPK($id);
		try {
			$bankTransferObj->delete();
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
			$bankTransferObj = SupplierPurchaseOrderBankTransferPeer::retrieveByPK($id);
	    return $bankTransferObj;
	  }

	  /**
	  * Obtiene todos los products.
		*
		*	@return array Informacion sobre todos los products
	  */
		function getAll() {
			$cond = new Criteria();
			$alls = SupplierPurchaseOrderBankTransferPeer::doSelect($cond);
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
	      $perPage = 	SupplierPurchaseOrderBankTransferPeer::getRowsPerPage();
	    if (empty($page))
	      $page = 1;
	    $cond = new Criteria();
	    $pager = new PropelPager($cond,"SupplierPurchaseOrderBankTransferPeer", "doSelect",$page,$perPage);
	    return $pager;
	   }    


} // SupplierPurchaseOrderBankTransferPeer
