<?php


/**
 * Base class that represents a query for the 'modules_label' table.
 *
 * Etiquetas de modulos 
 *
 * @method     ModuleLabelQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ModuleLabelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ModuleLabelQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ModuleLabelQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ModuleLabelQuery orderByLanguage($order = Criteria::ASC) Order by the language column
 *
 * @method     ModuleLabelQuery groupById() Group by the id column
 * @method     ModuleLabelQuery groupByName() Group by the name column
 * @method     ModuleLabelQuery groupByLabel() Group by the label column
 * @method     ModuleLabelQuery groupByDescription() Group by the description column
 * @method     ModuleLabelQuery groupByLanguage() Group by the language column
 *
 * @method     ModuleLabelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ModuleLabelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ModuleLabelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ModuleLabelQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method     ModuleLabelQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method     ModuleLabelQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method     ModuleLabel findOne(PropelPDO $con = null) Return the first ModuleLabel matching the query
 * @method     ModuleLabel findOneOrCreate(PropelPDO $con = null) Return the first ModuleLabel matching the query, or a new ModuleLabel object populated from the query conditions when no match is found
 *
 * @method     ModuleLabel findOneById(int $id) Return the first ModuleLabel filtered by the id column
 * @method     ModuleLabel findOneByName(string $name) Return the first ModuleLabel filtered by the name column
 * @method     ModuleLabel findOneByLabel(string $label) Return the first ModuleLabel filtered by the label column
 * @method     ModuleLabel findOneByDescription(string $description) Return the first ModuleLabel filtered by the description column
 * @method     ModuleLabel findOneByLanguage(string $language) Return the first ModuleLabel filtered by the language column
 *
 * @method     array findById(int $id) Return ModuleLabel objects filtered by the id column
 * @method     array findByName(string $name) Return ModuleLabel objects filtered by the name column
 * @method     array findByLabel(string $label) Return ModuleLabel objects filtered by the label column
 * @method     array findByDescription(string $description) Return ModuleLabel objects filtered by the description column
 * @method     array findByLanguage(string $language) Return ModuleLabel objects filtered by the language column
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleLabelQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseModuleLabelQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'ModuleLabel', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ModuleLabelQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ModuleLabelQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ModuleLabelQuery) {
			return $criteria;
		}
		$query = new ModuleLabelQuery();
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
	 * @param     array[$id, $name] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ModuleLabel|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ModuleLabelPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ModuleLabelPeer::ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ModuleLabelPeer::NAME, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ModuleLabelPeer::ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ModuleLabelPeer::NAME, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ModuleLabelPeer::ID, $id, $comparison);
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
	 * @return    ModuleLabelQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ModuleLabelPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the label column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
	 * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $label The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function filterByLabel($label = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($label)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $label)) {
				$label = str_replace('*', '%', $label);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleLabelPeer::LABEL, $label, $comparison);
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
	 * @return    ModuleLabelQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ModuleLabelPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the language column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLanguage('fooValue');   // WHERE language = 'fooValue'
	 * $query->filterByLanguage('%fooValue%'); // WHERE language LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $language The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function filterByLanguage($language = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($language)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $language)) {
				$language = str_replace('*', '%', $language);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ModuleLabelPeer::LANGUAGE, $language, $comparison);
	}

	/**
	 * Filter the query by a related Module object
	 *
	 * @param     Module|PropelCollection $module The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function filterByModule($module, $comparison = null)
	{
		if ($module instanceof Module) {
			return $this
				->addUsingAlias(ModuleLabelPeer::NAME, $module->getName(), $comparison);
		} elseif ($module instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ModuleLabelPeer::NAME, $module->toKeyValue('PrimaryKey', 'Name'), $comparison);
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
	 * @return    ModuleLabelQuery The current query, for fluid interface
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
	 * @param     ModuleLabel $moduleLabel Object to remove from the list of results
	 *
	 * @return    ModuleLabelQuery The current query, for fluid interface
	 */
	public function prune($moduleLabel = null)
	{
		if ($moduleLabel) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ModuleLabelPeer::ID), $moduleLabel->getId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ModuleLabelPeer::NAME), $moduleLabel->getName(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseModuleLabelQuery
