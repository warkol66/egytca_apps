<?php

/**
 * Class ClientAddressPeer
 *
 * @package ClientAddress
 */
class ClientAddressPeer extends BaseClientAddressPeer {

	/**
	 * Elimina un clientaddress a partir de los valores de la clave.
	 *
	 * @param int $id id del clientaddress
	 *	@return boolean true si se elimino correctamente el clientaddress, false sino
	 */
	function delete($id) {
		if (is_array($id))
			return ClientAddressQuery::create()->filterByPrimaryKeys($id)->delete();
		return ClientAddressQuery::create()->filterByPrimaryKey($id)->delete();
	}

	/**
	 * Obtiene la informacion de un clientaddress.
	 *
	 * @param int $id id del clientaddress
	 * @return array Informacion del clientaddress
	 */
	function get($id) {
		if (is_array($id))
			return ClientAddressQuery::create()->findPks($id);
		return ClientAddressQuery::create()->findPk($id);
	}

	/**
	 * Obtiene todos los clientaddresses.
	 *
	 *	@return array Informacion sobre todos los clientaddresses
	 */
	function getAll() {
		return ClientAddressQuery::create()->find();
	}
  
	/**
	 * Obtiene todos los clientaddresses paginados.
	 *
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 *	@return array Informacion sobre todos los clientaddresses
	 */
	function getAllPaginated($page=1,$perPage=-1) {  
    	if ($perPage == -1)
    		$perPage = Common::getRowsPerPage();
    	if (empty($page))
    		$page = 1;
    	$cond = new ClientAddressQuery();     
    	$pager = new PropelPager($cond,"ClientAddressPeer", "doSelect",$page,$perPage);
    	return $pager;
	}    
}
