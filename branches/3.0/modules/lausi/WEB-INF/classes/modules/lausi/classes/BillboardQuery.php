<?php



/**
 * Skeleton subclass for performing query and update operations on the 'lausi_billboard' table.
 *
 * Base de Activos (Carteleras)
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lausi.classes
 */
class BillboardQuery extends BaseBillboardQuery {

	public function filterByAvailable($fromDate,$duration) {
		$this->join('Address', Criteria::INNER_JOIN);
		
		//Esta subquery lo que hace es agregar una cuenta de la cantidad de advertisements asociados
		//al billboard cuyo rango temporal de validez tiene alguna intersección con el rango temporal
		//pasado por parámetro.
		$subQuery = AdvertisementQuery::create()
			->where(AdvertisementPeer::BILLBOARDID .' = ' . BillboardPeer::ID)
			->filterByPublished($fromDate, $duration)
			->clearSelectColumns()
			->addSelectColumn('COUNT(*)');
		$subQuery->setPrimaryTableName(AdvertisementPeer::TABLE_NAME);
			
		$params = array();
		$subQuery = BasePeer::createSelectSql($subQuery, $params);
		
		//Ahora nos fijamos si el resultado de ese subselect es igual a 0.
		$this->where('(' . $subQuery . ') = 0');
		
		$this->distinct();
		
		return $this;
	}
	
	public function filterByCircuitId($circuitId, $comparison = null) {
		return $this->join('Address')
					->useQuery('Address')
						->filterByCircuitId($circuitId, $comparison)
					->endUse();
	}
	
	public function filterByCircuit($circuit, $comparison = null) {
		return $this->join('Address')
					->useQuery('Address')
						->filterByCircuit($circuit, $comparison)
					->endUse();
	}
	
	public function selectFieldsForAvailableBillboardsReport() {
		$this->withColumn(CircuitPeer::ID, 'CircuitId');
		$this->withColumn(BillboardPeer::TYPE, 'BillboardType');
		$this->withColumn(CircuitPeer::NAME, 'CircuitName');
		$this->withColumn('COUNT(*)', 'Count');
		$this->select(array('CircuitId', 'Count', 'BillboardType', 'CircuitName'));
		return $this;
	}
	
	public function withDistanceTo($latitude_0, $longitude_0) {
		//cada grado de longitud equivale a 110900 metros
		//cada grado de latitud equivale a 90000
		return $this->withColumn('sqrt( pow((`longitude` - ' . $longitude_0 . ')*90000, 2) + pow((`latitude` - ' .$latitude_0. ')*110960, 2) )', 'Distance');
	}
	
	public function filterByRadius($latitude_0, $longitude_0, $radiusFrom, $radiusTo) {
		//cada grado de longitud equivale a 110900 metros
		//cada grado de latitud equivale a 90000
		return $this->where('sqrt( pow((`longitude` - ' . $longitude_0 . ')*90000, 2) + pow((`latitude` - ' .$latitude_0. ')*110960, 2) ) BETWEEN '.$radiusFrom.' AND '.$radiusTo);
	}
	
	public function filterByTheme($theme, $comparison = null) {
		return $this->join('Advertisement')
			 ->useQuery('Advertisement')
			 	->filterByTheme($theme, $comparison)
			 ->endUse();
	}
} // BillboardQuery
