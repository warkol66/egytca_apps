<?php

/** 
 *
 * @package    users
 * @subpackage levels
 */
class LevelPeer extends BaseLevelPeer {

  /**
  * Obtiene todos los niveles de usuarios.
	*
	*	@return array Informacion sobre todos los niveles de usuarios
  */
	function getAll() {
		$cond = new Criteria();
		$todosObj = LevelPeer::doSelect($cond);
		return $todosObj;
  }
  
  /**
  * Obtiene todos los niveles de usuarios con bitlevel mayor al pasado como parametro.
	*
	*	@return array Informacion sobre los niveles de usuarios
  */
	function getAllWithBitLevelGreaterThan($bitLevel) {
		$cond = new Criteria();
		$cond->add(LevelPeer::BITLEVEL, $bitLevel,Criteria::GREATER_THAN);
		$todosObj = LevelPeer::doSelect($cond);
		return $todosObj;
  }
  
  /**
  * Crea un nivel de usuarios nuevo.
  *
  * @param string $name Nombre del nivel de usuarios
  * @return boolean true si se creo el nivel de usuarios correctamente, false sino
	*/
  function create($name) {
		$level = new Level();
		$level->setName($name);
		$bitLevel = LevelPeer::getUnusedBitLevel();
		if ($bitLevel !== false)
			$level->setBitLevel($bitLevel);
		$level->save();
		return true;
  }
  
  function getUnusedBitLevel() {
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(LevelPeer::BITLEVEL);
		$levels = LevelPeer::doSelect($cond);
		if (empty($levels))
			return 1;
		$maxLevel = $levels[count($levels)-1]->getBitLevel();
		if ( $maxLevel > 1073741823) {
			//Tengo que ver si se borro alguno y volver a utilizarlo
			for ($i=0;$i<count($levels);$i++) {
				if ($levels[$i]->getBitLevel() != pow(2,$i))
					return pow(2,$i);
			}
			return false;
		}
		return $maxLevel*2;
  }

	/**
	* Elimina un nivel de usuarios a partir del id.
	*
  * @param int $id Id del nivel de usuarios
	*	@return boolean true si se elimino correctamente el nivel de usuarios, false sino
	*/
  function delete($id) {
		$level = LevelPeer::retrieveByPk($id);
		$level->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un nivel de usuarios.
  *
  * @param int $id Id del nivel de usuarios
  * @return array Informacion del nivel de usuarios
  */
  function get($id) {
		$level = LevelPeer::retrieveByPk($id);
		return $level;
  }

  /**
  * Actualiza la informacion de un nivel de usuarios.
  *
  * @param int $id Id del nivel de usuarios
  * @param string $name Nombre del nivel de usuarios
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name) {
		$level = LevelPeer::retrieveByPK($id);
		$level->setName($name);
		$level->save();
		return true;
  }

  /**
  * Obtiene el nivel de un usuario
  *
  * @param int $id Id del nivel de usuarios
  * @return int $level nivel de usuario
  */
  function getLevelByUser($id) {
		$level = LevelPeer::retrieveByPk($id);
		return $level->getBitLevel();
  }


}
