<?php


/**
 * Skeleton subclass for performing query and update operations on the 'forms_form' table.
 *
 * Formularios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.forms.classes
 */
class FormQuery extends BaseFormQuery {

	/**
	 * Returns a new FormQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FormQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FormQuery) {
			return $criteria;
		}
		$query = new self('application', 'Form', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // FormQuery
