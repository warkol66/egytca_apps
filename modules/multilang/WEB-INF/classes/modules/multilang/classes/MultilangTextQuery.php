<?php


/**
 * Skeleton subclass for performing query and update operations on the 'multilang_text' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.multilang.classes
 */
class MultilangTextQuery extends BaseMultilangTextQuery {

	/**
	 * Returns a new MultilangTextQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MultilangTextQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MultilangTextQuery) {
			return $criteria;
		}
		$query = new self('application', 'MultilangText', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // MultilangTextQuery
