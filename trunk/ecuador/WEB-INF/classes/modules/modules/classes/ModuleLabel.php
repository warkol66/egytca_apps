<?php

/**
 * Skeleton subclass for representing a row from the 'modules_label' table.
 *
 * Etiquetas de modulos
 *
 * @package    modules
 */
class ModuleLabel extends BaseModuleLabel {

/**
 *	Devuelve un SQL Insert para el la tabla de ModuleLabel
 *	a partir de la informacion de la instancia
 */
	function getSQLInsert() {
		$name = $this->getName();
		$label = $this->getLabel();
		$description = $this->getDescription();
		$lang = $this->getLanguage();
		$sql = "INSERT INTO `modules_label` ( `name` , `label` , `description` , `language` ) VALUES ('$name', '$label', '$description', '$lang');";
		return $sql;
	}

/**
 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
 * @return string SQL
 */
	public function getSQLCleanup() {
		$sql = "DELETE FROM `modules_label` WHERE `name` = '" . $this->getName() . "';\n";
		$sql .= "OPTIMIZE TABLE `modules_label`;";
		return  $sql;
	}


} // ModuleLabel
