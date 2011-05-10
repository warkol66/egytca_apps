<?php



/**
 * Skeleton subclass for representing a row from the 'panel_mission' table.
 *
 * Base de Misiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class Mission extends BaseMission {

	/** the default item name for this class */
	const ITEM_NAME = 'Mission';

	/**
	* Obtiene el nombre traducido del tipo de acto.
	*
	* @return string nombre del tipo
	*/
	function getTypeTranslated() {
		$type = $this->getType();
		$types = MissionPeer::getMissionTypes();
		$typeName = $types[$type];
		$typeNameTranslated = Common::getTranslation($typeName,'panel');
		return $typeNameTranslated;
	}

} // Mission
