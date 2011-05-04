<?php


/**
 * Base class that represents a query for the 'modules_entity' table.
 *
 * Entidades de modulos 
 *
 * @method     ModuleEntityQuery orderByModulename($order = Criteria::ASC) Order by the moduleName column
 * @method     ModuleEntityQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ModuleEntityQuery orderByPhpname($order = Criteria::ASC) Order by the phpName column
 * @method     ModuleEntityQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ModuleEntityQuery orderBySoftdelete($order = Criteria::ASC) Order by the softDelete column
 * @method     ModuleEntityQuery orderByRelation($order = Criteria::ASC) Order by the relation column
 * @method     ModuleEntityQuery orderBySavelog($order = Criteria::ASC) Order by the saveLog column
 * @method     ModuleEntityQuery orderByNestedset($order = Criteria::ASC) Order by the nestedset column
 * @method     ModuleEntityQuery orderByScopefielduniquename($order = Criteria::ASC) Order by the scopeFieldUniqueName column
 * @method     ModuleEntityQuery orderByBehaviors($order = Criteria::ASC) Order by the behaviors column
 *
 * @method     ModuleEntityQuery groupByModulename() Group by the moduleName column
 * @method     ModuleEntityQuery groupByName() Group by the name column
 * @method     ModuleEntityQuery groupByPhpname() Group by the phpName column
 * @method     ModuleEntityQuery groupByDescription() Group by the description column
 * @method     ModuleEntityQuery groupBySoftdelete() Group by the softDelete column
 * @method     ModuleEntityQuery groupByRelation() Group by the relation column
 * @method     ModuleEntityQuery groupBySavelog() Group by the saveLog column
 * @method     ModuleEntityQuery groupByNestedset() Group by the nestedset column
 * @method     ModuleEntityQuery groupByScopefielduniquename() Group by the scopeFieldUniqueName column
 * @method     ModuleEntityQuery groupByBehaviors() Group by the behaviors column
 *
 * @method     ModuleEntityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ModuleEntityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ModuleEntityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ModuleEntityQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method     ModuleEntityQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method     ModuleEntityQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method     ModuleEntityQuery leftJoinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
 * @method     ModuleEntityQuery rightJoinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
 * @method     ModuleEntityQuery innerJoinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
 *
 * @method     ModuleEntityQuery leftJoinModuleEntityFieldRelatedByEntityname($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
 * @method     ModuleEntityQuery rightJoinModuleEntityFieldRelatedByEntityname($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
 * @method     ModuleEntityQuery innerJoinModuleEntityFieldRelatedByEntityname($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
 *
 * @method     ModuleEntityQuery leftJoinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
 * @method     ModuleEntityQuery rightJoinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
 * @method     ModuleEntityQuery innerJoinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
 *
 * @method     ModuleEntity findOne(PropelPDO $con = null) Return the first ModuleEntity matching the query
 * @method     ModuleEntity findOneOrCreate(PropelPDO $con = null) Return the first ModuleEntity matching the query, or a new ModuleEntity object populated from the query conditions when no match is found
 *
 * @method     ModuleEntity findOneByModulename(string $moduleName) Return the first ModuleEntity filtered by the moduleName column
 * @method     ModuleEntity findOneByName(string $name) Return the first ModuleEntity filtered by the name column
 * @method     ModuleEntity findOneByPhpname(string $phpName) Return the first ModuleEntity filtered by the phpName column
 * @method     ModuleEntity findOneByDescription(string $description) Return the first ModuleEntity filtered by the description column
 * @method     ModuleEntity findOneBySoftdelete(boolean $softDelete) Return the first ModuleEntity filtered by the softDelete column
 * @method     ModuleEntity findOneByRelation(boolean $relation) Return the first ModuleEntity filtered by the relation column
 * @method     ModuleEntity findOneBySavelog(boolean $saveLog) Return the first ModuleEntity filtered by the saveLog column
 * @method     ModuleEntity findOneByNestedset(boolean $nestedset) Return the first ModuleEntity filtered by the nestedset column
 * @method     ModuleEntity findOneByScopefielduniquename(string $scopeFieldUniqueName) Return the first ModuleEntity filtered by the scopeFieldUniqueName column
 * @method     ModuleEntity findOneByBehaviors(resource $behaviors) Return the first ModuleEntity filtered by the behaviors column
 *
 * @method     array findByModulename(string $moduleName) Return ModuleEntity objects filtered by the moduleName column
 * @method     array findByName(string $name) Return ModuleEntity objects filtered by the name column
 * @method     array findByPhpname(string $phpName) Return ModuleEntity objects filtered by the phpName column
 * @method     array findByDescription(string $description) Return ModuleEntity objects filtered by the description column
 * @method     array findBySoftdelete(boolean $softDelete) Return ModuleEntity objects filtered by the softDelete column
 * @method     array findByRelation(boolean $relation) Return ModuleEntity objects filtered by the relation column
 * @method     array findBySavelog(boolean $saveLog) Return ModuleEntity objects filtered by the saveLog column
 * @method     array findByNestedset(boolean $nestedset) Return ModuleEntity objects filtered by the nestedset column
 * @method     array findByScopefielduniquename(string $scopeFieldUniqueName) Return ModuleEntity objects filtered by the scopeFieldUniqueName column
 * @method     array findByBehaviors(resource $behaviors) Return ModuleEntity objects filtered by the behaviors column
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleEntityQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseModuleEntityQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'ModuleEntity', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ModuleEntityQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ModuleEntityQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ModuleEntityQuery) {
			return $criteria;
		}
		$query = new ModuleEntityQuery();
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
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ModuleEntity|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ModuleEntityPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * $objs = $c->findPks(array(12, 56, 832), $con);
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
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ModuleEntityPeer::NAME, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ModuleEntityPeer::NAME, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the moduleName column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByModulename('fooValue');   // WHERE moduleName = 'fooValue'
	 * $query->filterByModulename('%fooValue%'); // WHERE moduleName LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $modulename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByModulename($modulename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($modulename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $modulename)) {
				$modulename = str_replace('*', '%', $modulename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityPeer::MODULENAME, $modulename, $comparison);
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
	 * @return    ModuleEntityQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ModuleEntityPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the phpName column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPhpname('fooValue');   // WHERE phpName = 'fooValue'
	 * $query->filterByPhpname('%fooValue%'); // WHERE phpName LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $phpname The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByPhpname($phpname = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($phpname)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $phpname)) {
				$phpname = str_replace('*', '%', $phpname);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityPeer::PHPNAME, $phpname, $comparison);
	}

	/**
	 * Filter the query on the description column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
	 * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $description The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByDescription($description = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($description)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $description)) {
				$description = str_replace('*', '%', $description);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the softDelete column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySoftdelete(true); // WHERE softDelete = true
	 * $query->filterBySoftdelete('yes'); // WHERE softDelete = true
	 * </code>
	 *
	 * @param     boolean|string $softdelete The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterBySoftdelete($softdelete = null, $comparison = null)
	{
		if (is_string($softdelete)) {
			$softDelete = in_array(strtolower($softdelete), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(ModuleEntityPeer::SOFTDELETE, $softdelete, $comparison);
	}

	/**
	 * Filter the query on the relation column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRelation(true); // WHERE relation = true
	 * $query->filterByRelation('yes'); // WHERE relation = true
	 * </code>
	 *
	 * @param     boolean|string $relation The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByRelation($relation = null, $comparison = null)
	{
		if (is_string($relation)) {
			$relation = in_array(strtolower($relation), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(ModuleEntityPeer::RELATION, $relation, $comparison);
	}

	/**
	 * Filter the query on the saveLog column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySavelog(true); // WHERE saveLog = true
	 * $query->filterBySavelog('yes'); // WHERE saveLog = true
	 * </code>
	 *
	 * @param     boolean|string $savelog The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterBySavelog($savelog = null, $comparison = null)
	{
		if (is_string($savelog)) {
			$saveLog = in_array(strtolower($savelog), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(ModuleEntityPeer::SAVELOG, $savelog, $comparison);
	}

	/**
	 * Filter the query on the nestedset column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByNestedset(true); // WHERE nestedset = true
	 * $query->filterByNestedset('yes'); // WHERE nestedset = true
	 * </code>
	 *
	 * @param     boolean|string $nestedset The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByNestedset($nestedset = null, $comparison = null)
	{
		if (is_string($nestedset)) {
			$nestedset = in_array(strtolower($nestedset), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(ModuleEntityPeer::NESTEDSET, $nestedset, $comparison);
	}

	/**
	 * Filter the query on the scopeFieldUniqueName column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByScopefielduniquename('fooValue');   // WHERE scopeFieldUniqueName = 'fooValue'
	 * $query->filterByScopefielduniquename('%fooValue%'); // WHERE scopeFieldUniqueName LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $scopefielduniquename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByScopefielduniquename($scopefielduniquename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($scopefielduniquename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $scopefielduniquename)) {
				$scopefielduniquename = str_replace('*', '%', $scopefielduniquename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $scopefielduniquename, $comparison);
	}

	/**
	 * Filter the query on the behaviors column
	 * 
	 * @param     mixed $behaviors The value to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByBehaviors($behaviors = null, $comparison = null)
	{
		return $this->addUsingAlias(ModuleEntityPeer::BEHAVIORS, $behaviors, $comparison);
	}

	/**
	 * Filter the query by a related Module object
	 *
	 * @param     Module|PropelCollection $module The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByModule($module, $comparison = null)
	{
		if ($module instanceof Module) {
			return $this
				->addUsingAlias(ModuleEntityPeer::MODULENAME, $module->getName(), $comparison);
		} elseif ($module instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ModuleEntityPeer::MODULENAME, $module->toKeyValue('PrimaryKey', 'Name'), $comparison);
		} else {
			throw new PropelException('filterByModule() only accepts arguments of type Module or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Module relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function joinModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Module');
		
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
			$this->addJoinObject($join, 'Module');
		}
		
		return $this;
	}

	/**
	 * Use the Module relation Module object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleQuery A secondary query class using the current class as primary query
	 */
	public function useModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinModule($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Module', 'ModuleQuery');
	}

	/**
	 * Filter the query by a related ModuleEntityField object
	 *
	 * @param     ModuleEntityField|PropelCollection $moduleEntityField The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByModuleEntityFieldRelatedByScopefielduniquename($moduleEntityField, $comparison = null)
	{
		if ($moduleEntityField instanceof ModuleEntityField) {
			return $this
				->addUsingAlias(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $moduleEntityField->getUniquename(), $comparison);
		} elseif ($moduleEntityField instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $moduleEntityField->toKeyValue('PrimaryKey', 'Uniquename'), $comparison);
		} else {
			throw new PropelException('filterByModuleEntityFieldRelatedByScopefielduniquename() only accepts arguments of type ModuleEntityField or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function joinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByScopefielduniquename');
		
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
			$this->addJoinObject($join, 'ModuleEntityFieldRelatedByScopefielduniquename');
		}
		
		return $this;
	}

	/**
	 * Use the ModuleEntityFieldRelatedByScopefielduniquename relation ModuleEntityField object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityFieldQuery A secondary query class using the current class as primary query
	 */
	public function useModuleEntityFieldRelatedByScopefielduniquenameQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinModuleEntityFieldRelatedByScopefielduniquename($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByScopefielduniquename', 'ModuleEntityFieldQuery');
	}

	/**
	 * Filter the query by a related ModuleEntityField object
	 *
	 * @param     ModuleEntityField $moduleEntityField  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByModuleEntityFieldRelatedByEntityname($moduleEntityField, $comparison = null)
	{
		if ($moduleEntityField instanceof ModuleEntityField) {
			return $this
				->addUsingAlias(ModuleEntityPeer::NAME, $moduleEntityField->getEntityname(), $comparison);
		} elseif ($moduleEntityField instanceof PropelCollection) {
			return $this
				->useModuleEntityFieldRelatedByEntitynameQuery()
					->filterByPrimaryKeys($moduleEntityField->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByModuleEntityFieldRelatedByEntityname() only accepts arguments of type ModuleEntityField or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function joinModuleEntityFieldRelatedByEntityname($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByEntityname');
		
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
			$this->addJoinObject($join, 'ModuleEntityFieldRelatedByEntityname');
		}
		
		return $this;
	}

	/**
	 * Use the ModuleEntityFieldRelatedByEntityname relation ModuleEntityField object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityFieldQuery A secondary query class using the current class as primary query
	 */
	public function useModuleEntityFieldRelatedByEntitynameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinModuleEntityFieldRelatedByEntityname($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByEntityname', 'ModuleEntityFieldQuery');
	}

	/**
	 * Filter the query by a related ModuleEntityField object
	 *
	 * @param     ModuleEntityField $moduleEntityField  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function filterByModuleEntityFieldRelatedByForeignkeytable($moduleEntityField, $comparison = null)
	{
		if ($moduleEntityField instanceof ModuleEntityField) {
			return $this
				->addUsingAlias(ModuleEntityPeer::NAME, $moduleEntityField->getForeignkeytable(), $comparison);
		} elseif ($moduleEntityField instanceof PropelCollection) {
			return $this
				->useModuleEntityFieldRelatedByForeignkeytableQuery()
					->filterByPrimaryKeys($moduleEntityField->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByModuleEntityFieldRelatedByForeignkeytable() only accepts arguments of type ModuleEntityField or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function joinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByForeignkeytable');
		
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
			$this->addJoinObject($join, 'ModuleEntityFieldRelatedByForeignkeytable');
		}
		
		return $this;
	}

	/**
	 * Use the ModuleEntityFieldRelatedByForeignkeytable relation ModuleEntityField object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleEntityFieldQuery A secondary query class using the current class as primary query
	 */
	public function useModuleEntityFieldRelatedByForeignkeytableQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinModuleEntityFieldRelatedByForeignkeytable($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByForeignkeytable', 'ModuleEntityFieldQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ModuleEntity $moduleEntity Object to remove from the list of results
	 *
	 * @return    ModuleEntityQuery The current query, for fluid interface
	 */
	public function prune($moduleEntity = null)
	{
		if ($moduleEntity) {
			$this->addUsingAlias(ModuleEntityPeer::NAME, $moduleEntity->getName(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseModuleEntityQuery
