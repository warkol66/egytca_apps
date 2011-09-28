<?php

/**
 * Skeleton subclass for performing query and update operations on the 'security_actionLabel' table.
 *
 * etiquetas de actions de seguridad
 *
 * @package    security
 */
class SecurityActionLabelPeer extends BaseSecurityActionLabelPeer {

	/**
	*	Obtiene etiquetas segun el idioma y action
	*	@param string $language idioma
	*	@param string $module nombre del modulo
	*	@return object $objs etiquetas
	*/
	function getByActionAndLanguage($action,$language) {
		if (preg_match("/(.*)(Do[A-Z])(.*)/",$action,$parts))
			$actionWithoutDo = $parts[1].$parts[2][2].$parts[3];

		$securityActionLabel = SecurityActionLabelQuery::create()
															->filterByLanguage($language)
															->filterByAction($language)
																->_or()
															->filterByAction($actionWithoutDo)
															->findOne();
		return $securityActionLabel;
	}

	/**
	*	Obtiene todas las etiquetas para un idioma
	*	@param string $language idioma
	*	@return object $objs etiquetas
	*/
	function getAllByLanguage($language) {
		return SecurityActionLabelQuery::create()->filterByLanguage($language)->find();
	}

} // SecurityActionLabelPeer
