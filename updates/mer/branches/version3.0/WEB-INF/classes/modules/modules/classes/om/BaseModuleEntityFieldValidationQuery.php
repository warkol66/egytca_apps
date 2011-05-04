<?php


/**
 * Base class that represents a query for the 'modules_entityFieldValidation' table.
 *
 * Validaciones de los campos de las entidades de modulos 
 *
 * @method     ModuleEntityFieldValidationQuery orderByEntityfielduniquename($order = Criteria::ASC) Order by the entityFieldUniqueName column
 * @method     ModuleEntityFieldValidationQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ModuleEntityFieldValidationQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ModuleEntityFieldValidationQuery orderByMessage($order = Criteria::ASC) Order by the message column
 *
 * @method     ModuleEntityFieldValidationQuery groupByEntityfielduniquename() Group by the entityFieldUniqueName column
 * @method     ModuleEntityFieldValidationQuery groupByName() Group by the name column
 * @method     ModuleEntityFieldValidationQuery groupByValue() Group by the value column
 * @method     ModuleEntityFieldValidationQuery groupByMessage() Group by the message column
 *
 * @method     ModuleEntityFieldValidationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ModuleEntityFieldValidationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ModuleEntityFieldValidationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ModuleEntityFieldValidationQuery leftJoinModuleEntityField($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityField relation
 * @method     ModuleEntityFieldValidationQuery rightJoinModuleEntityField($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityField relation
 * @method     ModuleEntityFieldValidationQuery innerJoinModuleEntityField($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityField relation
 *
 * @method     ModuleEntityFieldValidation findOne(PropelPDO $con = null) Return the first ModuleEntityFieldValidation matching the query
 * @method     ModuleEntityFieldValidation findOneOrCreate(PropelPDO $con = null) Return the first ModuleEntityFieldValidation matching the query, or a new ModuleEntityFieldValidation object populated from the query conditions when no match is found
 *
 * @method     ModuleEntityFieldValidation findOneByEntityfielduniquename(string $entityFieldUniqueName) Return the first ModuleEntityFieldValidation filtered by the entityFieldUniqueName column
 * @method     ModuleEntityFieldValidation findOneByName(string $name) Return the first ModuleEntityFieldValidation filtered by the name column
 * @method     ModuleEntityFieldValidation findOneByValue(string $value) Return the first ModuleEntityFieldValidation filtered by the value column
 * @method     ModuleEntityFieldValidation findOneByMessage(string $message) Return the first ModuleEntityFieldValidation filtered by the message column
 *
 * @method     array findByEntityfielduniquename(string $entityFieldUniqueName) Return ModuleEntityFieldValidation objects filtered by the entityFieldUniqueName column
 * @method     array findByName(string $name) Return ModuleEntityFieldValidation objects filtered by the name column
 * @method     array findByValue(string $value) Return ModuleEntityFieldValidation objects filtered by the value column
 * @method     array findByMessage(string $message) Return ModuleEntityFieldValidation objects filtered by the message column
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleEntityFieldValidationQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseModuleEntityFieldValidationQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'ModuleEntityFieldValidation', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ModuleEntityFieldValidationQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ModuleEntityFieldValidationQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ModuleEntityFieldValidationQuery) {
			return $criteria;
		}
		$query = new ModuleEntityFieldValidationQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * <code>
	 * $obj = $c->findPk(array(12, 34), $con);
	 * </code>
	 * @param     array[$entityFieldUniqueName, $name] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ModuleEntityFieldValidation|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ModuleEntityFieldValidationPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ModuleEntityFieldValidationPeer::NAME, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ModuleEntityFieldValidationPeer::NAME, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the entityFieldUniqueName column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByEntityfielduniquename('fooValue');   // WHERE entityFieldUniqueName = 'fooValue'
	 * $query->filterByEntityfielduniquename('%fooValue%'); // WHERE entityFieldUniqueName LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $entityfielduniquename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByEntityfielduniquename($entityfielduniquename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($entityfielduniquename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $entityfielduniquename)) {
				$entityfielduniquename = str_replace('*', '%', $entityfielduniquename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME, $entityfielduniquename, $comparison);
	}

	/**
	 * Filter the query on the name column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityFieldValidationPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
	 * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $value The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByValue($value = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($value)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $value)) {
				$value = str_replace('*', '%', $value);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityFieldValidationPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the message column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
	 * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $message The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByMessage($message = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($message)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $message)) {
				$message = str_replace('*', '%', $message);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityFieldValidationPeer::MESSAGE, $message, $comparison);
	}

	/**
	 * Filter the query by a related ModuleEntityField object
	 *
	 * @param     ModuleEntityField|PropelCollection $moduleEntityField The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function filterByModuleEntityField($moduleEntityField, $comparison = null)
	{
		if ($moduleEntityField instanceof ModuleEntityField) {
			return $this
				->addUsingAlias(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME, $moduleEntityField->getUniquename(), $comparison);
		} elseif ($moduleEntityField instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME, $moduleEntityField->toKeyValue('PrimaryKey', 'Uniquename'), $comparison);
		} else {
			throw new PropelException('filterByModuleEntityField() only accepts arguments of type ModuleEntityField or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ModuleEntityField relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function joinModuleEntityField($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ModuleEntityField');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ModuleEntityField');
		}
		
		return $this;
	}

	/**
	 * Use the ModuleEntityField relation ModuleEntityField object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityFieldQuery A secondary query class using the current class as primary query
	 */
	public function useModuleEntityFieldQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinModuleEntityField($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ModuleEntityField', 'ModuleEntityFieldQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ModuleEntityFieldValidation $moduleEntityFieldValidation Object to remove from the list of results
	 *
	 * @return    ModuleEntityFieldValidationQuery The current query, for fluid interface
	 */
	public function prune($moduleEntityFieldValidation = null)
	{
		if ($moduleEntityFieldValidation) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME), $moduleEntityFieldValidation->getEntityfielduniquename(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ModuleEntityFieldValidationPeer::NAME), $moduleEntityFieldValidation->getName(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseModuleEntityFieldValidationQuery
