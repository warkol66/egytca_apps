<?php

/**
 * Skeleton subclass for representing a row from the 'modules_dependency' table.
 *
 * Dependencia de modulos 
 *
 * @package    modules
 */	
class ModuleDependency extends BaseModuleDependency {

/**
 * genera el codigo SQL de insercion de datos del modulo
 * @return string SQL
 */
	function getSQLInsert(){
		$moduleName = $this->getModuleName();
		$dependencyName = $this->getDependence();
		$sql = "INSERT INTO `modules_dependency` ( `moduleName` , `dependence` ) VALUES ('$moduleName', '$dependencyName');";
		return $sql;
	}
	
/**
 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
 * @return string SQL
 */
	public function getSQLCleanup() {
		$sql = "DELETE FROM `modules_dependency` WHERE `moduleName` = " . "'" . $this->getModuleName() . "'" . ';';
		return  $sql;
	}	

} // ModuleDependency
