<?php


/**
 * Base class that represents a query for the 'MER_hierarchy' table.
 *
 * 
 *
 * @method     HierarchyQuery orderByActorid($order = Criteria::ASC) Order by the actorId column
 * @method     HierarchyQuery orderByCategoryid($order = Criteria::ASC) Order by the categoryId column
 * @method     HierarchyQuery orderByPosition($order = Criteria::ASC) Order by the position column
 *
 * @method     HierarchyQuery groupByActorid() Group by the actorId column
 * @method     HierarchyQuery groupByCategoryid() Group by the categoryId column
 * @method     HierarchyQuery groupByPosition() Group by the position column
 *
 * @method     HierarchyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     HierarchyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     HierarchyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     HierarchyQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     HierarchyQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     HierarchyQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     HierarchyQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     HierarchyQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     HierarchyQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     Hierarchy findOne(PropelPDO $con = null) Return the first Hierarchy matching the query
 * @method     Hierarchy findOneOrCreate(PropelPDO $con = null) Return the first Hierarchy matching the query, or a new Hierarchy object populated from the query conditions when no match is found
 *
 * @method     Hierarchy findOneByActorid(int $actorId) Return the first Hierarchy filtered by the actorId column
 * @method     Hierarchy findOneByCategoryid(int $categoryId) Return the first Hierarchy filtered by the categoryId column
 * @method     Hierarchy findOneByPosition(int $position) Return the first Hierarchy filtered by the position column
 *
 * @method     array findByActorid(int $actorId) Return Hierarchy objects filtered by the actorId column
 * @method     array findByCategoryid(int $categoryId) Return Hierarchy objects filtered by the categoryId column
 * @method     array findByPosition(int $position) Return Hierarchy objects filtered by the position column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseHierarchyQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseHierarchyQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Hierarchy', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new HierarchyQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    HierarchyQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof HierarchyQuery) {
			return $criteria;
		}
		$query = new HierarchyQuery();
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
	 * @param     array[$actorId, $categoryId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Hierarchy|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = HierarchyPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(HierarchyPeer::ACTORID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(HierarchyPeer::CATEGORYID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(HierarchyPeer::ACTORID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(HierarchyPeer::CATEGORYID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the actorId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByActorid(1234); // WHERE actorId = 1234
	 * $query->filterByActorid(array(12, 34)); // WHERE actorId IN (12, 34)
	 * $query->filterByActorid(array('min' => 12)); // WHERE actorId > 12
	 * </code>
	 *
	 * @see       filterByActor()
	 *
	 * @param     mixed $actorid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByActorid($actorid = null, $comparison = null)
	{
		if (is_array($actorid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(HierarchyPeer::ACTORID, $actorid, $comparison);
	}

	/**
	 * Filter the query on the categoryId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCategoryid(1234); // WHERE categoryId = 1234
	 * $query->filterByCategoryid(array(12, 34)); // WHERE categoryId IN (12, 34)
	 * $query->filterByCategoryid(array('min' => 12)); // WHERE categoryId > 12
	 * </code>
	 *
	 * @see       filterByCategory()
	 *
	 * @param     mixed $categoryid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByCategoryid($categoryid = null, $comparison = null)
	{
		if (is_array($categoryid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(HierarchyPeer::CATEGORYID, $categoryid, $comparison);
	}

	/**
	 * Filter the query on the position column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPosition(1234); // WHERE position = 1234
	 * $query->filterByPosition(array(12, 34)); // WHERE position IN (12, 34)
	 * $query->filterByPosition(array('min' => 12)); // WHERE position > 12
	 * </code>
	 *
	 * @param     mixed $position The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(HierarchyPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(HierarchyPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HierarchyPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByActor($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(HierarchyPeer::ACTORID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(HierarchyPeer::ACTORID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByActor() only accepts arguments of type Actor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Actor relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function joinActor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Actor');
		
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
			$this->addJoinObject($join, 'Actor');
		}
		
		return $this;
	}

	/**
	 * Use the Actor relation Actor object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery A secondary query class using the current class as primary query
	 */
	public function useActorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinActor($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Actor', 'ActorQuery');
	}

	/**
	 * Filter the query by a related Category object
	 *
	 * @param     Category|PropelCollection $category The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function filterByCategory($category, $comparison = null)
	{
		if ($category instanceof Category) {
			return $this
				->addUsingAlias(HierarchyPeer::CATEGORYID, $category->getId(), $comparison);
		} elseif ($category instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(HierarchyPeer::CATEGORYID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Category relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Category');
		
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
			$this->addJoinObject($join, 'Category');
		}
		
		return $this;
	}

	/**
	 * Use the Category relation Category object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery A secondary query class using the current class as primary query
	 */
	public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Category', 'CategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Hierarchy $hierarchy Object to remove from the list of results
	 *
	 * @return    HierarchyQuery The current query, for fluid interface
	 */
	public function prune($hierarchy = null)
	{
		if ($hierarchy) {
			$this->addCond('pruneCond0', $this->getAliasedColName(HierarchyPeer::ACTORID), $hierarchy->getActorid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(HierarchyPeer::CATEGORYID), $hierarchy->getCategoryid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseHierarchyQuery
