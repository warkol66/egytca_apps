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
	* Filtro para obtener un action a partir de su nombre o el del par
	* @param string $action nombre del action
	*/
	function filterByNameOrPair($action) {
		$this->filterByAction($action)
			->_or()
				 ->filterByPair($action)
			->setIgnoreCase('true');
		return $this;
	}

} // SecurityActionQuery
