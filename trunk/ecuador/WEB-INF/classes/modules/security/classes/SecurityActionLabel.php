<?php

/**
 * Skeleton subclass for representing a row from the 'security_actionLabel' table.
 *
 * etiquetas de actions de seguridad
 *
 * @package    security
 */
class SecurityActionLabel extends BaseSecurityActionLabel {

	/**
	 * Genera instrucciones sql para insertar informacion
	 * @return string sql de insercion
	 */
	function getSQLInsert() {
		$sql = "INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('" . $this->getAction() . "', '" . $this->getLabel() . "', '" . $this->getDescription() . "', '" . $this->getLanguage() . "');";
		return $sql;
	}

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
															->setIgnoreCase(true)
															->filterByLanguage($language)
															->filterByAction($action)
																->_or()
															->filterByAction($actionWithoutDo)
															->findOne();
		return $securityActionLabel;
	}

	/**
	 * Genera instrucciones sql para elimnar informacion existente en la tabla
	 * @return string sql de insercion
	 */
	function getSQLCleanup($module,$languageCode) {
		$sql = "DELETE FROM `security_actionLabel` WHERE `action` LIKE '" . ucfirst($module) . "%' AND `language` = '" . $languageCode . "';\n";
		$sql .= "OPTIMIZE TABLE `security_actionLabel`;";
		return $sql;
	}

} // SecurityActionLabel
