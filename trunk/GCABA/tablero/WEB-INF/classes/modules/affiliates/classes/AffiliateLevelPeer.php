<?php

  // include base peer class
  require_once 'affiliates/classes/om/BaseAffiliateLevelPeer.php';

  // include object class
  include_once 'AffiliateLevel.php';


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_level' table.
 *
 * Levels
 *
 * @package    affiliates
 */
class AffiliateLevelPeer extends BaseAffiliateLevelPeer {

  /**
  * Obtiene todos los niveles de usuarios.
	*
	*	@return array Informacion sobre todos los niveles de usuarios
  */
	function getAll() {
		$cond = new Criteria();
		$todosObj = AffiliateLevelPeer::doSelect($cond);
		return $todosObj;
  }
  
  /**
  * Obtiene todos los niveles de usuarios con bitlevel mayor al pasado como parametro.
	*
	*	@return array Informacion sobre los niveles de usuarios
  */
	function getAllWithBitLevelGreaterThan($bitLevel) {
		$cond = new Criteria();
		$cond->add(AffiliateLevelPeer::BITLEVEL, $bitLevel,Criteria::GREATER_THAN);
		$todosObj = AffiliateLevelPeer::doSelect($cond);
		return $todosObj;
  }
  
  /**
  * Crea un nivel de usuarios nuevo.
  *
  * @param string $name Nombre del nivel de usuarios
  * @return boolean true si se creo el nivel de usuarios correctamente, false sino
	*/
  function create($name) {
		$level = new AffiliateLevel();
		$level->setName($name);
		$bitLevel = AffiliateLevelPeer::getUnusedBitLevel();
		if ($bitLevel !== false)
			$level->setBitLevel($bitLevel);
		$level->save();
		return true;
  }
  
  function getUnusedBitLevel() {
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(AffiliateLevelPeer::BITLEVEL);
		$levels = AffiliateLevelPeer::doSelect($cond);
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
		$level = AffiliateLevelPeer::retrieveByPk($id);
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
		$level = AffiliateLevelPeer::retrieveByPk($id);
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
		$level = AffiliateLevelPeer::retrieveByPK($id);
		$level->setName($name);
		$level->save();
		return true;
  }

} // AffiliateLevelPeer
