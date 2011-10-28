<?php

/**
 * Skeleton subclass for performing query and update operations on the 'modules_module' table.
 *
 *  Registro de modulos
 *
 * @package    modules
 */

class ModulePeer extends BaseModulePeer {

/**
 *	Obtiene un modulo a partir de su nombre
 *	@param string $moduleName nombre del modulo
 *	@return object $module nombre del modulo seleccionado
 */
	function get($moduleName) {
		$criteria = new Criteria();
		$criteria->add(ModulePeer::NAME, $moduleName);
		$module = ModulePeer::doSelectOne($criteria);
		return $module;
	}

/**
 *	Obtiene todos los módulos almacenados en la base de datos
 *	@return array $modules Modulos almacenados en la base de datos
 */
	function getAll() {
		$criteria = new Criteria();
		$allObj = ModulePeer::doSelect($criteria);
		return $allObj;
	}

/**
 *	Obtiene todos los módulos activos en la base de datos
 *	@return array $modules Modulos almacenados en la base de datos
 */
	function getAllActive() {
		$criteria = new Criteria();
		$criteria->add(ModulePeer::ACTIVE,1);
		$all = ModulePeer::doSelect($criteria);
		return $all;
	}

/**
 *	Obtiene todos los módulos activos en la base de datos
 *	@return array $modules Modulos almacenados en la base de datos
 */
	function getAllActiveNames() {
		$all = ModuleQuery::create()->select('Name')->filterByActive('1')->find();
		return $all;
	}

/**
 * Indica si en el sistema hay instalado el modulo de newsletters.
 * @return boolean true si existe el modulo newsletters
 */
	function hasNewslettersModule() {
		$newslettersModule = ModulePeer::get('newsletters');
		if (!empty($newslettersModule))
			return true;

		return false;
	}

/**
 * Indica si en el el directorio de modulos existe un determinado modulo
 * @return boolean true si existe el modulo
 */
	function existsModule($moduleName) {
		$dir = "WEB-INF/classes/modules/".$moduleName;
		$dh  = opendir($dir);
		if (!empty($dh))
			return true;

		return false;
	}

	/**
	*
	*	Obtiene todos los módulos almacenados en la base de datos que tienen categorias
	*	@return object $modules Modulos almacenados en la base de datos
	*/
	function getAllWithCategories() {
		$cond = new Criteria();
		$cond->add(ModulePeer::HASCATEGORIES,1);
		$todosObj = ModulePeer::doSelect($cond);
		return $todosObj;
	}

/**
*
*	Elimina un modulo
*	@param string $moduleName nombre del modulo
*	@return true si se eliminó correctamente
*/
	function delete($moduleName){
		try{
				$obj = new Module();
				$obj = ModulePeer::retrieveByPK($moduleName);
				if(!empty($obj))
					{
						$obj->delete();
					}
			}catch (PropelException $e) {}
			return true;
	}

	/**
	* Limpia el acceso activo de un modulo
	*
	* @param string $action con el nombre del modulo a limpiar
	*/

	function clearActive($module) {
		$obj = new Module();
		$obj = ModulePeer::retrieveByPK($module);
		$obj->setActive(0);
		$obj->save();
		return;
	}

/**
*
*	Actualiza estado de un modulo
*	@param string $moduleName nombre del modulo
*	@param string $active nuevo estado del modulo
*	@return true si se actualizó correctamente
*/
	function setActive ($moduleName,$active){
		$obj = new Module();
		$obj = ModulePeer::retrieveByPK($moduleName);
		$obj->setActive($active);
		$obj->save();
		return;
	}

	/**
	*
	*	Actualiza en la base de datos módulos
	*	@param string $moduleName nombre del modulo
	*	@param string $description descripcion del modulo
	*	@param string $label etiqueta del módulo
	*	@return true si se agrego correctamente
	*/

	function updateModule($module,$description,$label) {
			try{
				$moduleObj = new Module();
				$moduleObj = ModulePeer::retrieveByPK($module);
				$moduleObj ->save();
			}catch (PropelException $e) {}

			$cond = new Criteria();
			$cond->add(ModuleLabelPeer::NAME, $module);

			$language = Common::getCurrentLanguageCode();
			if(empty($language))
				$language='eng';

			$cond->add(ModuleLabelPeer::LANGUAGE, $language);
			$moduleLabel = ModuleLabelPeer::doSelectOne($cond);

			$moduleLabel->setDescription($description);
			$moduleLabel->setLabel($label);
			$moduleLabel->save();

			return true;
		}

	/**
	*
	*	Checkea el estado de una dependencia
	*	@param string $dependencyName nombre de la dependencia
	*	@return true si esta activada, false si está desactivada
	*/
	function dependencyStatus ($dependencyName){
			$obj = new Module();
			$obj = ModulePeer::retrieveByPK($dependencyName);
			if($obj){
				if (!$obj->getAlwaysActive() ){
					if(!$obj->getActive() ) {
						return 0;
					}
				}
			}
			else return 0;
			return 1;
	}

	/**
	*	Nombres de modulos presentes, instalados y activos
	*	@return array con nombres de modulos presentes, instalados y activos
	*/
	public function getActiveAndPresent(){

		$modulePath = "WEB-INF/classes/modules/";
		$directoryHandler = opendir($modulePath);
		$modules = array();

		while (false !== ($moduleName = readdir($directoryHandler))) {

			//verifico si es un directory y no no sea ni oculto ni raiz
			if (is_dir($modulePath . $moduleName) && ($moduleName[0] != ".")) {
				//busco si el modulo esta instalado y activo
				$result = ModuleQuery::create()->filterByActive('1')->findByName($moduleName);
				if (!empty($result))
					array_push($modules, $moduleName);
			}
		}
		closedir($directoryHandler);
		return $modules;
	}

/**
 *	Obtiene todos los módulos almacenados en la base de datos
 *	@return array $modules Modulos almacenados en la base de datos
 */
	function getAllPresent() {

		$modulePath = "WEB-INF/classes/modules/";
		$directoryHandler = opendir($modulePath);
		$modules = array();

		while (false !== ($moduleName = readdir($directoryHandler)))
			if (is_dir($modulePath . $moduleName) && ($moduleName[0] != "."))
				array_push($modules, $moduleName);

		closedir($directoryHandler);
		return $modules;
	}

} // ModulePeer
