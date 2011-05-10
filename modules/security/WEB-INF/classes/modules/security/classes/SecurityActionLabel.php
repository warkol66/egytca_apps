<?php

  // include base peer class
  require_once 'security/classes/om/BaseSecurityActionLabel.php';


/**
 * Skeleton subclass for representing a row from the 'security_actionLabel' table.
 *
 * etiquetas de actions de seguridad
 *
 * @package    security
 */	
class SecurityActionLabel extends BaseSecurityActionLabel {

	function getSQLInsert() {

		$sql = "INSERT INTO `security_actionLabel` ( `action` , `label` , `description` ,`language` ) VALUES ('" . $this->getAction() . "', '" . $this->getLabel() . "', '" . $this->getDescription() . "', '" . $this->getLanguage() . "');";

		return $sql;
	}	

	function getSQLCleanup($module,$languageCode) {
		$sql = "DELETE FROM `security_actionLabel` WHERE `action` LIKE '" . ucfirst($module) . "%' AND `language` = '" . $languageCode . "';\n";
		$sql .= "OPTIMIZE TABLE `security_actionLabel`;";
		return $sql;
	}	

} // SecurityActionLabel
