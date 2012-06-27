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
	 * Aplica filtro para busqueda de usuario pro usuario, direccion de corro o
	 * direccion de correo alternativa
	 *
	 * @param string $username Nombre de usuario.
	 * @param string $mailAddress Email.
	 * @return Query aplicando filtros correspondientes.
	 */

	public function searchByUsernameAndMail($username, $mailAddress) {

		$this->setIgnoreCase('true')
			->filterByActive(1)									//Solo usuarios activos
			->filterById(0,Criteria::GREATER_THAN)	// Para no buscar al usuario system, id=-1
			->filterByUsername($username)
			->filterByMailaddress($mailAddress)			//Busco por direccion
				->_or()
			->filterByMailaddressalt($mailAddress);	//o direccion alternativa

		return $this;
	}

} // UserQuery
