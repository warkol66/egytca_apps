<?php


/**
 * Skeleton subclass for performing query and update operations on the 'positions_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class PositionQuery extends BasePositionQuery {

	public function __construct($dbName = 'application', $modelName = 'Position', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
			$this->orderByVersionid(Criteria::DESC);
	}

} // PositionQuery
