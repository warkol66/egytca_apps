<?php



/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_level' table.
 *
 * Levels
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateLevelPeer extends BaseAffiliateLevelPeer {

	/**
	* Obtiene todos los niveles de usuarios.
	*
	*	@return array Informacion sobre todos los niveles de usuarios
	*/
	function getAll() {
		return AffiliateLevelQuery::create()->find();
	}

	/**
	* Obtiene todos los niveles de usuarios con bitlevel mayor al pasado como parametro.
	*
	*	@return array Informacion sobre los niveles de usuarios
	*/
	function getAllWithBitLevelGreaterThan($bitLevel) {
		return AffiliateLevelQuery::create()->filterByBitLevel($bitLevel, Criteria::GREATER_THAN)->find();
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
		$level->save();
		return true;
	}

	function getUnusedBitLevel() {
		$levels = AffiliateLevelQuery::create()->orderByBitLevel()->find();
		if (empty($levels))
			return 1;
		$maxLevel = $levels->getLast()->getBitLevel();
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
	* @return cantidad de elementos eliminados (0 o 1).
	*/
	function delete($id) {
		return AffiliateLevelQuery::create()->filterByPrimaryKey($id)->delete();
	}

	/**
	* Obtiene la informacion de un nivel de usuarios.
	*
	* @param int $id Id del nivel de usuarios
	* @return array Informacion del nivel de usuarios
	*/
	function get($id) {
		return AffiliateLevelQuery::create()->findPk($id);
	}

	/**
	* Actualiza la informacion de un nivel de usuarios.
	*
	* @param int $id Id del nivel de usuarios
	* @param string $name Nombre del nivel de usuarios
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id, $params) {
		$level = AffiliateLevelPeer::retrieveByPK($id);
		Common::setObjectFromParams($level, $params);
		return $level->save();
	}

} // AffiliateLevelPeer
