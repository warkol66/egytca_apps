<?php


/**
 * Base class that represents a query for the 'MER_graphActor' table.
 *
 * Graficos
 *
 * @method     GraphActorQuery orderByGraphid($order = Criteria::ASC) Order by the graphId column
 * @method     GraphActorQuery orderByActorid($order = Criteria::ASC) Order by the actorId column
 * @method     GraphActorQuery orderByCategoryid($order = Criteria::ASC) Order by the categoryId column
 * @method     GraphActorQuery orderByJudgement($order = Criteria::ASC) Order by the judgement column
 * @method     GraphActorQuery orderByOld($order = Criteria::ASC) Order by the old column
 *
 * @method     GraphActorQuery groupByGraphid() Group by the graphId column
 * @method     GraphActorQuery groupByActorid() Group by the actorId column
 * @method     GraphActorQuery groupByCategoryid() Group by the categoryId column
 * @method     GraphActorQuery groupByJudgement() Group by the judgement column
 * @method     GraphActorQuery groupByOld() Group by the old column
 *
 * @method     GraphActorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     GraphActorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     GraphActorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     GraphActorQuery leftJoinGraphModel($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphModel relation
 * @method     GraphActorQuery rightJoinGraphModel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphModel relation
 * @method     GraphActorQuery innerJoinGraphModel($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphModel relation
 *
 * @method     GraphActorQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     GraphActorQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     GraphActorQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     GraphActorQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     GraphActorQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     GraphActorQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     GraphActor findOne(PropelPDO $con = null) Return the first GraphActor matching the query
 * @method     GraphActor findOneOrCreate(PropelPDO $con = null) Return the first GraphActor matching the query, or a new GraphActor object populated from the query conditions when no match is found
 *
 * @method     GraphActor findOneByGraphid(int $graphId) Return the first GraphActor filtered by the graphId column
 * @method     GraphActor findOneByActorid(int $actorId) Return the first GraphActor filtered by the actorId column
 * @method     GraphActor findOneByCategoryid(int $categoryId) Return the first GraphActor filtered by the categoryId column
 * @method     GraphActor findOneByJudgement(string $judgement) Return the first GraphActor filtered by the judgement column
 * @method     GraphActor findOneByOld(int $old) Return the first GraphActor filtered by the old column
 *
 * @method     array findByGraphid(int $graphId) Return GraphActor objects filtered by the graphId column
 * @method     array findByActorid(int $actorId) Return GraphActor objects filtered by the actorId column
 * @method     array findByCategoryid(int $categoryId) Return GraphActor objects filtered by the categoryId column
 * @method     array findByJudgement(string $judgement) Return GraphActor objects filtered by the judgement column
 * @method     array findByOld(int $old) Return GraphActor objects filtered by the old column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseGraphActorQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseGraphActorQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'GraphActor', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new GraphActorQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    GraphActorQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof GraphActorQuery) {
			return $criteria;
		}
		$query = new GraphActorQuery();
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
	 * @param     array[$graphId, $actorId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    GraphActor|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = GraphActorPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(GraphActorPeer::GRAPHID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(GraphActorPeer::ACTORID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(GraphActorPeer::GRAPHID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(GraphActorPeer::ACTORID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the graphId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByGraphid(1234); // WHERE graphId = 1234
	 * $query->filterByGraphid(array(12, 34)); // WHERE graphId IN (12, 34)
	 * $query->filterByGraphid(array('min' => 12)); // WHERE graphId > 12
	 * </code>
	 *
	 * @see       filterByGraphModel()
	 *
	 * @param     mixed $graphid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByGraphid($graphid = null, $comparison = null)
	{
		if (is_array($graphid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphActorPeer::GRAPHID, $graphid, $comparison);
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
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByActorid($actorid = null, $comparison = null)
	{
		if (is_array($actorid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphActorPeer::ACTORID, $actorid, $comparison);
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
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByCategoryid($categoryid = null, $comparison = null)
	{
		if (is_array($categoryid)) {
			$useMinMax = false;
			if (isset($categoryid['min'])) {
				$this->addUsingAlias(GraphActorPeer::CATEGORYID, $categoryid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($categoryid['max'])) {
				$this->addUsingAlias(GraphActorPeer::CATEGORYID, $categoryid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphActorPeer::CATEGORYID, $categoryid, $comparison);
	}

	/**
	 * Filter the query on the judgement column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByJudgement('fooValue');   // WHERE judgement = 'fooValue'
	 * $query->filterByJudgement('%fooValue%'); // WHERE judgement LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $judgement The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByJudgement($judgement = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($judgement)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $judgement)) {
				$judgement = str_replace('*', '%', $judgement);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(GraphActorPeer::JUDGEMENT, $judgement, $comparison);
	}

	/**
	 * Filter the query on the old column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByOld(1234); // WHERE old = 1234
	 * $query->filterByOld(array(12, 34)); // WHERE old IN (12, 34)
	 * $query->filterByOld(array('min' => 12)); // WHERE old > 12
	 * </code>
	 *
	 * @param     mixed $old The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByOld($old = null, $comparison = null)
	{
		if (is_array($old)) {
			$useMinMax = false;
			if (isset($old['min'])) {
				$this->addUsingAlias(GraphActorPeer::OLD, $old['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($old['max'])) {
				$this->addUsingAlias(GraphActorPeer::OLD, $old['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphActorPeer::OLD, $old, $comparison);
	}

	/**
	 * Filter the query by a related GraphModel object
	 *
	 * @param     GraphModel|PropelCollection $graphModel The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByGraphModel($graphModel, $comparison = null)
	{
		if ($graphModel instanceof GraphModel) {
			return $this
				->addUsingAlias(GraphActorPeer::GRAPHID, $graphModel->getId(), $comparison);
		} elseif ($graphModel instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphActorPeer::GRAPHID, $graphModel->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByGraphModel() only accepts arguments of type GraphModel or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphModel relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function joinGraphModel($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphModel');
		
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
			$this->addJoinObject($join, 'GraphModel');
		}
		
		return $this;
	}

	/**
	 * Use the GraphModel relation GraphModel object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelQuery A secondary query class using the current class as primary query
	 */
	public function useGraphModelQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphModel($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphModel', 'GraphModelQuery');
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByActor($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(GraphActorPeer::ACTORID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphActorPeer::ACTORID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    GraphActorQuery The current query, for fluid interface
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
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function filterByCategory($category, $comparison = null)
	{
		if ($category instanceof Category) {
			return $this
				->addUsingAlias(GraphActorPeer::CATEGORYID, $category->getId(), $comparison);
		} elseif ($category instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphActorPeer::CATEGORYID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function joinCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Category', 'CategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     GraphActor $graphActor Object to remove from the list of results
	 *
	 * @return    GraphActorQuery The current query, for fluid interface
	 */
	public function prune($graphActor = null)
	{
		if ($graphActor) {
			$this->addCond('pruneCond0', $this->getAliasedColName(GraphActorPeer::GRAPHID), $graphActor->getGraphid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(GraphActorPeer::ACTORID), $graphActor->getActorid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseGraphActorQuery
