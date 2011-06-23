<?php

/**
 * Skeleton subclass for representing a row from the 'modules_module' table.
 *
 *  Registro de modulos
 *
 * @package    modules
 */
class Module extends BaseModule {

/**
 * Obtiene la etiqueta del modulo traducida al idioma actual
 * @return string label la etiqueta del modulo traducida al idioma actual
 */
	function getLabel(){
		try{
			$language = Common::getCurrentLanguageCode();
			if(empty($language))
				$language='eng';
			$moduleLabelInfo=ModuleLabelPeer::getByModuleAndLanguage($this->getName(),$language);
			if (!empty($moduleLabelInfo))
				return $moduleLabelInfo->getLabel();
			return "";
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return "";
		}
	}

/**
 * Obtiene la descripcion del modulo traducida al idioma actual
 * @return string la descripcion del modulo traducida al idioma actual
 */
	function getDescription(){
		try {
			$language = Common::getCurrentLanguageCode();
			if(empty($language))
				$language='eng';
			$moduleLabelInfo = ModuleLabelPeer::getByModuleAndLanguage($this->getName(),$language);
			if (!empty($moduleLabelInfo))
				return $moduleLabelInfo->getDescription();
			return "";
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return "";
		}
	}

/**
* Obtiene el accesso de ese modulo
* @return string access el acceso
*/
	function getAccess(){
		try{
			$securityAccess = SecurityModulePeer::get($this->getName());
			return $securityAccess->getAccess();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return "";
		}
	}

/**
 *
 */
	function getSQLInsert() {
		$moduleName = $this->getName();
		$alwaysActive = $this->getAlwaysActive();
		$hasCategories = $this->getHasCategories();
		$sql .= "INSERT INTO `modules_module` ( `name` , `active` , `alwaysActive`, `hasCategories` ) VALUES ('$moduleName', '1', '$alwaysActive','$hasCategories');";
		return $sql;
	}

/**
 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
 * @return string SQL
 */
	public function getSQLCleanup() {
		$sql = "DELETE FROM `modules_module` WHERE `name` = " . "'" . $this->getName() . "'" . ';';
		return  $sql;
	}

/**
 * Obtiene las categorias base del modulo
 * @return array de instancias de Category
 */
	public function getParentCategories() {
		require_once('CategoryPeer.php');
		return CategoryPeer::getAllParentsByModule($this->getName());
	}

} // Module
