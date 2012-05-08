<?php


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_documentProcess' table.
 *
 * Asociacion entre Documentos y Procesos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.tablero.classes
 */
class TableroDocumentProcessQuery extends BaseTableroDocumentProcessQuery {

	/**
	 * Returns a new TableroDocumentProcessQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TableroDocumentProcessQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TableroDocumentProcessQuery) {
			return $criteria;
		}
		$query = new self('application', 'TableroDocumentProcess', $modelAlias);
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

} // TableroDocumentProcessQuery
