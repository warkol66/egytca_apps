<?php


/**
 * Skeleton subclass for performing query and update operations on the 'users_user' table.
 *
 * Users
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.users.classes
 */
class UserQuery extends BaseUserQuery {
	
 /**
	* Selecciona usuarios bloquados
	*
	* @param $blocked bool
	*/
	function selectBlocked($blocked){
		if($blocked)
			$this->where('User.BlockedAt IS NOT NULL');
		return $this;
	}
	
 /**
	* Permite filtrar los usuarios que tienen las ids pasadas por parametro
	*
	* @param $ids array de ids que se quieren pasar por alto en la busqueda 
	*/
	function getDifferentFrom($ids){
		return $this->filterById($ids,Criteria::NOT_IN);
	}

 /**
	* Permite filtrar los usuarios que tienen las ids pasadas por parametro
	*/
	function getLoged(){
		return $this->filterBySession(null, Criteria::ISNOTNULL);
	}

 /**
	* Aplica filtro para ignorar usuario de sistema
	*/
	function ignoreNonRealUsers(){
		return $this->filterById(0, Criteria::GREATER_THAN);
	}

} // UserQuery
