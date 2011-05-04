<?php


/**
 * Base class that represents a query for the 'modules_dependency' table.
 *
 * Dependencia de modulos 
 *
 * @method     ModuleDependencyQuery orderByModulename($order = Criteria::ASC) Order by the moduleName column
 * @method     ModuleDependencyQuery orderByDependence($order = Criteria::ASC) Order by the dependence column
 *
 * @method     ModuleDependencyQuery groupByModulename() Group by the moduleName column
 * @method     ModuleDependencyQuery groupByDependence() Group by the dependence column
 *
 * @method     ModuleDependencyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ModuleDependencyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ModuleDependencyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ModuleDependencyQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method     ModuleDependencyQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method     ModuleDependencyQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method     ModuleDependency findOne(PropelPDO $con = null) Return the first ModuleDependency matching the query
 * @method     ModuleDependency findOneOrCreate(PropelPDO $con = null) Return the first ModuleDependency matching the query, or a new ModuleDependency object populated from the query conditions when no match is found
 *
 * @method     ModuleDependency findOneByModulename(string $moduleName) Return the first ModuleDependency filtered by the moduleName column
 * @method     ModuleDependency findOneByDependence(string $dependence) Return the first ModuleDependency filtered by the dependence column
 *
 * @method     array findByModulename(string $moduleName) Return ModuleDependency objects filtered by the moduleName column
 * @method     array findByDependence(string $dependence) Return ModuleDependency objects filtered by the dependence column
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleDependencyQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseModuleDependencyQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'ModuleDependency', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ModuleDependencyQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ModuleDependencyQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ModuleDependencyQuery) {
			return $criteria;
		}
		$query = new ModuleDependencyQuery();
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
	 * @param     array[$moduleName, $dependence] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ModuleDependency|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ModuleDependencyPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ModuleDependencyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ModuleDependencyPeer::MODULENAME, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ModuleDependencyPeer::DEPENDENCE, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ModuleDependencyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ModuleDependencyPeer::MODULENAME, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ModuleDependencyPeer::DEPENDENCE, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
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
	 * @return    ModuleDependencyQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ModuleDependencyPeer::MODULENAME, $modulename, $comparison);
	}

	/**
	 * Filter the query on the dependence column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDependence('fooValue');   // WHERE dependence = 'fooValue'
	 * $query->filterByDependence('%fooValue%'); // WHERE dependence LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $dependence The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleDependencyQuery The current query, for fluid interface
	 */
	public function filterByDependence($dependence = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($dependence)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $dependence)) {
				$dependence = str_replace('*', '%', $dependence);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleDependencyPeer::DEPENDENCE, $dependence, $comparison);
	}

	/**
	 * Filter the query by a related Module object
	 *
	 * @param     Module|PropelCollection $module The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleDependencyQuery The current query, for fluid interface
	 */
	public function filterByModule($module, $comparison = null)
	{
		if ($module instanceof Module) {
			return $this
				->addUsingAlias(ModuleDependencyPeer::MODULENAME, $module->getName(), $comparison);
		} elseif ($module instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ModuleDependencyPeer::MODULENAME, $module->toKeyValue('PrimaryKey', 'Name'), $comparison);
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
	 * @return    ModuleDependencyQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     ModuleDependency $moduleDependency Object to remove from the list of results
	 *
	 * @return    ModuleDependencyQuery The current query, for fluid interface
	 */
	public function prune($moduleDependency = null)
	{
		if ($moduleDependency) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ModuleDependencyPeer::MODULENAME), $moduleDependency->getModulename(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ModuleDependencyPeer::DEPENDENCE), $moduleDependency->getDependence(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseModuleDependencyQuery
