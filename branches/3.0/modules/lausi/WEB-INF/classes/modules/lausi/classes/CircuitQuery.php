<?php



/**
 * Skeleton subclass for performing query and update operations on the 'lausi_circuit' table.
 *
 * Base de Circuitos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lausi.classes
 */
class CircuitQuery extends BaseCircuitQuery {

	public function countBillboards($circuitId, $type = null) {
		if (empty($type)) {
			$type = BillboardPeer::TYPE_SEXTUPLE;
		}
		
		$this->join('Address', Criteria::INNER_JOIN);
		$this->join('Address.Billboard', Criteria::INNER_JOIN);
		$this->filterByPrimaryKey($circuitId);
		$this->useQuery('Billboard')
				->filterByType($type)
			->endUse();
		return $this->count();
	}
} // CircuitQuery
