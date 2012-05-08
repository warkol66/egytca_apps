<?php


/**
 * Skeleton subclass for representing a row from the 'tablero_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroPosition extends BaseTableroPosition {

	/**
	 * Initializes internal state of Position object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

	/** the default item name for this class */
	const ITEM_NAME = 'Position';

	/**
	* Obtiene el nombre del padre de un position.
	*
	* @return array Informacion del position
	*/
	function getParentName()
	{
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getName();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre del padre de un position.
	*
	* @return array Informacion del position
	*/
	function getParentId()
	{
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getId();
		}
		else
			return;
	}

	/**
	* Obtiene el nombre traducido fel tipo de position.
	*
	* @return array tipos de position
	*/
	function getPositionTypeTranslated()
	{
		$type = $this->getType();

		$positionPeer = new TableroPositionPeer();
		$positionTypes = $positionPeer->getPositionTypesTranslated();
		$positionTypeName = $positionTypes[$type];
		return $positionTypeName;

	}

} // TableroPosition
