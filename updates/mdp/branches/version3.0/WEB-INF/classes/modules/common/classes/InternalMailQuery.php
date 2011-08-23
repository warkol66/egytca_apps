<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_internalMail' table.
 *
 * Mensajes internos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class InternalMailQuery extends BaseInternalMailQuery {
	
	/**
	 * Filtra la consulta por usuario destinatario.
	 * @param     object $user El usuario por el que filtrar
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return    InternalMailQuery The current query, for fluid interface
	 */
	public function filterByRecipientUser($user = null, $comparison = null) {
		if (is_object($user) && get_class($user) == 'user')
			return $this->filterByRecipientType('user')->filterByRecipientId($user->getId(), $comparison);
		else
			return $this->filterByRecipientType('user')->filterByRecipientId(null, $comparison);
	}

	/**
	 * Filtra la consulta por usuario destinatario.
	 * @param     object $user El usuario por el que filtrar
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return    InternalMailQuery The current query, for fluid interface
	 */
	public function filterByRecipient($user = null, $comparison = null) {
		if (is_object($user) && get_class($user) == 'User')
			return $this->filterByRecipientType('user')->filterByRecipientId($user->getId(), $comparison);
		else if (is_object($user) && get_class($user) == 'AffiliateUser')
			return $this->filterByRecipientType('affiliateUser')->filterByRecipientId($user->getId(), $comparison);
		else if (is_object($user) && get_class($user) == 'ClientUser')
			return $this->filterByRecipientType('clientUser')->filterByRecipientId($user->getId(), $comparison);
		else
			return $this->filterByRecipientType('noValidUser');
	}

	/**
	 * Filtra la consulta por usuario por afiliado destinatario.
	 * @param     object $user El usuario por el que filtrar
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return    InternalMailQuery The current query, for fluid interface
	 */
	public function filterByRecipientAffiliateUser($user = null, $comparison = null) {
		return $this->filterByRecipientType('affiliateUser')->filterByRecipientId($user->getId(), $comparison);
	}
	
	/**
	 * Filtra la consulta por los mensajes que fueron enviados por un usuario.
	 * 
	 * @param     object $user El usuario por el que filtrar
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return    InternalMailQuery The current query, for fluid interface
	 */
	public function sentByUser($user = null, $comparison = null) {
		$this->filterByRecipientType(null)  //Con esto nos aseguramos no ver las copias propias
				 ->filterByRecipientId(null);   //de cada destinatario.

		if (is_object($user) && get_class($user) == 'User')
			return $this->filterByFromType('user')->filterByFromId($user->getId(), $comparison);
		else if (is_object($user) && get_class($user) == 'AffiliateUser')
			return $this->filterByFromType('affiliateUser')->filterByFromId($user->getId(), $comparison);
		else if (is_object($user) && get_class($user) == 'ClientUser')
			return $this->filterByFromType('clientUser')->filterByFromId($user->getId(), $comparison);
		else
			return $this->filterByFromType('noValidUser');

	}
	
	/**
	 * Filtra la consulta por los mensajes que fueron enviados por un usuario por afiliado.
	 * 
	 * @param     object $user El usuario por el que filtrar
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 * @return    InternalMailQuery The current query, for fluid interface
	 */
	public function sentByAffiliateUser($user = null, $comparison = null) {
		return $this->filterByFromType('affiliateUser')
					->filterByFromId($user->getId(), $comparison)
					->filterByRecipientType(null, Criteria::ISNULL)  //Con esto nos aseguramos no ver las copias propias
					->filterByRecipientId(null, Criteria::ISNULL);   //de cada destinatario.
	}	
	
	public function unread() {
		return $this->filterByReadOn(null);
	}
	
	public function read() {
		return $this->filterByReadOn(null, Criteria::ISNOTNULL);
	}
	
	public function searchByString($string) {
		return $this->where('InternalMail.Subject LIKE ?', '%' . $string . '%')
					->orWhere('InternalMail.Body LIKE ?', '%' . $string . '%');
	}

} // InternalMailQuery
