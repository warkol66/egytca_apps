<?php



/**
 * Skeleton subclass for performing query and update operations on the 'lausi_address' table.
 *
 * Base de Direcciones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.lausi.classes
 */
class AddressQuery extends BaseAddressQuery {
	
	/**
	 * Filter the query by a related Advertisement object
	 *
	 * @param     Advertisement $advertisement  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AddressQuery The current query, for fluid interface
	 */
	public function filterByAdvertisement($advertisement, $comparison = null)
	{
		$this->join('Billboard');
		$this->useQuery('Billboard')
			->filterByAdvertisement($advertisement, $comparison)
		->endUse();
		$this->distinct();
		return $this;
	}
} // AddressQuery
