<?php

// The parent class
require_once 'om/BaseClientPeer.php';

// The object class
include_once 'Client.php';

/**
 * Class ClientPeer
 *
 * @package Client
 */
class ClientPeer extends BaseClientPeer {

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
  * Crea un client nuevo.
  *
  * @param string $name name del client
  * @param string $contact contact del client
  * @return boolean true si se creo el client correctamente, false sino
	*/
	function create($name,$contact) {
    try {
      $clientObj = new Client();
      $clientObj->setname($name);
      $clientObj->setcontact($contact);
      $clientObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }      
	}

  /**
  * Actualiza la informacion de un client.
  *
  * @param int $id id del client
  * @param string $name name del client
  * @param string $contact contact del client
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$contact) {
    try {
      $clientObj = ClientPeer::retrieveByPK($id);
      $clientObj->setname($name);
      $clientObj->setcontact($contact);
      $clientObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }      
  }

  /**
  * Indica si existe un cliente con un nombre dado.
  *
  * @param string $name nombre
  * @return boolean true si existe el cliente, false si no existe
  */  
  function exists($name) {
    $criteria = new Criteria();
    $criteria->add(ClientPeer::NAME,$name);
    $results = ClientPeer::doCount($criteria);
    if ($results>0)
      return true;
    else
      return false;
  }
  
  /**
  * Obtiene un cliente con un nombre dado.
  *
  * @param string $name nombre
  * @return Client cliente
  */    
  function getByName($name) {
    $criteria = new Criteria();
    $criteria->add(ClientPeer::NAME,$name);
    $client = ClientPeer::doSelectOne($criteria); 
    return $client; 
  }  

	/**
	* Elimina un client a partir de los valores de la clave.
	*
  * @param int $id id del client
	*	@return boolean true si se elimino correctamente el client, false sino
	*/
  function delete($id) {
  	$clientObj = ClientPeer::retrieveByPK($id);
    $clientObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un client.
  *
  * @param int $id id del client
  * @return array Informacion del client
  */
  function get($id) {
		$clientObj = ClientPeer::retrieveByPK($id);
    return $clientObj;
  }

  /**
  * Obtiene todos los clients.
	*
	*	@return array Informacion sobre todos los clients
  */
	function getAll() {
		$cond = new Criteria();
		$alls = ClientPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los clients paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los clients
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ClientPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"ClientPeer", "doSelect",$page,$perPage);
    return $pager;
   }    

}
