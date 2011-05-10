<?php

require 'import/classes/om/BaseBankAccountPeer.php';
require 'import/classes/BankAccount.php';


/**
 * Skeleton subclass for performing query and update operations on the 'import_bankAccount' table.
 *
 * Cuentas bancarias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class BankAccountPeer extends BaseBankAccountPeer {

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
  * Crea un cuentas bancaria nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $bankaccountObj = new BankAccount();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($bankaccountObj,$setMethod) ) {          
          if (!empty($value))
            $bankaccountObj->$setMethod($value);
          else
            $bankaccountObj->$setMethod(null);
        }
      }
	  $bankaccountObj->setActive(1);
      $bankaccountObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un cuentas bancaria.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {
      $bankaccountObj = BankAccountPeer::retrieveByPK($params["id"]);    
      if (empty($bankaccountObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($bankaccountObj,$setMethod) ) {          
          if (!empty($value))
            $bankaccountObj->$setMethod($value);
          else
            $bankaccountObj->$setMethod(null);
        }
      }
      $bankaccountObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un cuentas bancaria a partir de los valores de la clave.
	*
  * @param int $id id del bankaccount
	*	@return boolean true si se elimino correctamente el bankaccount, false sino
	*/
  function delete($id) {
	  	$bankaccountObj = BankAccountPeer::retrieveByPK($id);
	    $bankaccountObj->setActive(0);
	 	$bankaccountObj->save();
		return true;
  }

  /**
  * Obtiene la informacion de un cuentas bancaria.
  *
  * @param int $id id del bankaccount
  * @return array Informacion del bankaccount
  */
  function get($id) {
		$bankaccountObj = BankAccountPeer::retrieveByPK($id);
    return $bankaccountObj;
  }

  /**
  * Obtiene todos los cuentas bancarias.
	*
	*	@return array Informacion sobre todos los bankaccounts
  */
	function getAll() {
		$cond = new Criteria();
		$cond->add(BankAccountPeer::ACTIVE,1);
		$alls = BankAccountPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los cuentas bancarias paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los bankaccounts
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	BankAccountPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
	$cond->add(BankAccountPeer::ACTIVE,1);
    $pager = new PropelPager($cond,"BankAccountPeer", "doSelect",$page,$perPage);
    return $pager;
   }  

} // BankAccountPeer
