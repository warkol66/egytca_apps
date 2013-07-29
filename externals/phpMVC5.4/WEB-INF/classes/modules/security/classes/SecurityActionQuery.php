<?php


/**
 * Skeleton subclass for performing query and update operations on the 'security_action' table.
 *
 * Actions del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.security.classes
 */
class SecurityActionQuery extends BaseSecurityActionQuery {

	/**
	* Obtiene un action a partir de su nombre o del par
	* @param string $action nombre del action
	* @return object $obj action encontrado
	*/
	function filterByNameOrPair($action) {
		return $this->setIgnoreCase('true')
								->filterByAction($action)
									->_or()
								->filterByPair($action);
	}

} // SecurityActionQuery
