<?php


/**
 * Base class that represents a query for the 'MER_graphRelation' table.
 *
 * Graficos de Relacion
 *
 * @method     GraphRelationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     GraphRelationQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     GraphRelationQuery orderByActor1id($order = Criteria::ASC) Order by the actor1Id column
 * @method     GraphRelationQuery orderByActor2id($order = Criteria::ASC) Order by the actor2Id column
 * @method     GraphRelationQuery orderByJudgement($order = Criteria::ASC) Order by the judgement column
 * @method     GraphRelationQuery orderByOld($order = Criteria::ASC) Order by the old column
 *
 * @method     GraphRelationQuery groupById() Group by the id column
 * @method     GraphRelationQuery groupByName() Group by the name column
 * @method     GraphRelationQuery groupByActor1id() Group by the actor1Id column
 * @method     GraphRelationQuery groupByActor2id() Group by the actor2Id column
 * @method     GraphRelationQuery groupByJudgement() Group by the judgement column
 * @method     GraphRelationQuery groupByOld() Group by the old column
 *
 * @method     GraphRelationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     GraphRelationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     GraphRelationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     GraphRelationQuery leftJoinActorRelatedByActor1id($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorRelatedByActor1id relation
 * @method     GraphRelationQuery rightJoinActorRelatedByActor1id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorRelatedByActor1id relation
 * @method     GraphRelationQuery innerJoinActorRelatedByActor1id($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorRelatedByActor1id relation
 *
 * @method     GraphRelationQuery leftJoinActorRelatedByActor2id($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorRelatedByActor2id relation
 * @method     GraphRelationQuery rightJoinActorRelatedByActor2id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorRelatedByActor2id relation
 * @method     GraphRelationQuery innerJoinActorRelatedByActor2id($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorRelatedByActor2id relation
 *
 * @method     GraphRelationQuery leftJoinGraphRelationQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphRelationQuestion relation
 * @method     GraphRelationQuery rightJoinGraphRelationQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphRelationQuestion relation
 * @method     GraphRelationQuery innerJoinGraphRelationQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphRelationQuestion relation
 *
 * @method     GraphRelation findOne(PropelPDO $con = null) Return the first GraphRelation matching the query
 * @method     GraphRelation findOneOrCreate(PropelPDO $con = null) Return the first GraphRelation matching the query, or a new GraphRelation object populated from the query conditions when no match is found
 *
 * @method     GraphRelation findOneById(int $id) Return the first GraphRelation filtered by the id column
 * @method     GraphRelation findOneByName(string $name) Return the first GraphRelation filtered by the name column
 * @method     GraphRelation findOneByActor1id(int $actor1Id) Return the first GraphRelation filtered by the actor1Id column
 * @method     GraphRelation findOneByActor2id(int $actor2Id) Return the first GraphRelation filtered by the actor2Id column
 * @method     GraphRelation findOneByJudgement(string $judgement) Return the first GraphRelation filtered by the judgement column
 * @method     GraphRelation findOneByOld(int $old) Return the first GraphRelation filtered by the old column
 *
 * @method     array findById(int $id) Return GraphRelation objects filtered by the id column
 * @method     array findByName(string $name) Return GraphRelation objects filtered by the name column
 * @method     array findByActor1id(int $actor1Id) Return GraphRelation objects filtered by the actor1Id column
 * @method     array findByActor2id(int $actor2Id) Return GraphRelation objects filtered by the actor2Id column
 * @method     array findByJudgement(string $judgement) Return GraphRelation objects filtered by the judgement column
 * @method     array findByOld(int $old) Return GraphRelation objects filtered by the old column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseGraphRelationQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseGraphRelationQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'GraphRelation', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new GraphRelationQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    GraphRelationQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof GraphRelationQuery) {
			return $criteria;
		}
		$query = new GraphRelationQuery();
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
	 * @return    GraphRelation|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = GraphRelationPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(GraphRelationPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(GraphRelationPeer::ID, $keys, Criteria::IN);
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
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphRelationPeer::ID, $id, $comparison);
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
	 * @return    GraphRelationQuery The current query, for fluid interface
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
		return $this->addUsingAlias(GraphRelationPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the actor1Id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByActor1id(1234); // WHERE actor1Id = 1234
	 * $query->filterByActor1id(array(12, 34)); // WHERE actor1Id IN (12, 34)
	 * $query->filterByActor1id(array('min' => 12)); // WHERE actor1Id > 12
	 * </code>
	 *
	 * @see       filterByActorRelatedByActor1id()
	 *
	 * @param     mixed $actor1id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByActor1id($actor1id = null, $comparison = null)
	{
		if (is_array($actor1id)) {
			$useMinMax = false;
			if (isset($actor1id['min'])) {
				$this->addUsingAlias(GraphRelationPeer::ACTOR1ID, $actor1id['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($actor1id['max'])) {
				$this->addUsingAlias(GraphRelationPeer::ACTOR1ID, $actor1id['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphRelationPeer::ACTOR1ID, $actor1id, $comparison);
	}

	/**
	 * Filter the query on the actor2Id column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByActor2id(1234); // WHERE actor2Id = 1234
	 * $query->filterByActor2id(array(12, 34)); // WHERE actor2Id IN (12, 34)
	 * $query->filterByActor2id(array('min' => 12)); // WHERE actor2Id > 12
	 * </code>
	 *
	 * @see       filterByActorRelatedByActor2id()
	 *
	 * @param     mixed $actor2id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByActor2id($actor2id = null, $comparison = null)
	{
		if (is_array($actor2id)) {
			$useMinMax = false;
			if (isset($actor2id['min'])) {
				$this->addUsingAlias(GraphRelationPeer::ACTOR2ID, $actor2id['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($actor2id['max'])) {
				$this->addUsingAlias(GraphRelationPeer::ACTOR2ID, $actor2id['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphRelationPeer::ACTOR2ID, $actor2id, $comparison);
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
	 * @return    GraphRelationQuery The current query, for fluid interface
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
		return $this->addUsingAlias(GraphRelationPeer::JUDGEMENT, $judgement, $comparison);
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
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByOld($old = null, $comparison = null)
	{
		if (is_array($old)) {
			$useMinMax = false;
			if (isset($old['min'])) {
				$this->addUsingAlias(GraphRelationPeer::OLD, $old['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($old['max'])) {
				$this->addUsingAlias(GraphRelationPeer::OLD, $old['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphRelationPeer::OLD, $old, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByActorRelatedByActor1id($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(GraphRelationPeer::ACTOR1ID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphRelationPeer::ACTOR1ID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByActorRelatedByActor1id() only accepts arguments of type Actor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ActorRelatedByActor1id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function joinActorRelatedByActor1id($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ActorRelatedByActor1id');
		
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
			$this->addJoinObject($join, 'ActorRelatedByActor1id');
		}
		
		return $this;
	}

	/**
	 * Use the ActorRelatedByActor1id relation Actor object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery A secondary query class using the current class as primary query
	 */
	public function useActorRelatedByActor1idQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinActorRelatedByActor1id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ActorRelatedByActor1id', 'ActorQuery');
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByActorRelatedByActor2id($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(GraphRelationPeer::ACTOR2ID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphRelationPeer::ACTOR2ID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByActorRelatedByActor2id() only accepts arguments of type Actor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ActorRelatedByActor2id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function joinActorRelatedByActor2id($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ActorRelatedByActor2id');
		
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
			$this->addJoinObject($join, 'ActorRelatedByActor2id');
		}
		
		return $this;
	}

	/**
	 * Use the ActorRelatedByActor2id relation Actor object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery A secondary query class using the current class as primary query
	 */
	public function useActorRelatedByActor2idQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinActorRelatedByActor2id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ActorRelatedByActor2id', 'ActorQuery');
	}

	/**
	 * Filter the query by a related GraphRelationQuestion object
	 *
	 * @param     GraphRelationQuestion $graphRelationQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function filterByGraphRelationQuestion($graphRelationQuestion, $comparison = null)
	{
		if ($graphRelationQuestion instanceof GraphRelationQuestion) {
			return $this
				->addUsingAlias(GraphRelationPeer::ID, $graphRelationQuestion->getGraphrelationid(), $comparison);
		} elseif ($graphRelationQuestion instanceof PropelCollection) {
			return $this
				->useGraphRelationQuestionQuery()
					->filterByPrimaryKeys($graphRelationQuestion->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphRelationQuestion() only accepts arguments of type GraphRelationQuestion or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphRelationQuestion relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function joinGraphRelationQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphRelationQuestion');
		
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
			$this->addJoinObject($join, 'GraphRelationQuestion');
		}
		
		return $this;
	}

	/**
	 * Use the GraphRelationQuestion relation GraphRelationQuestion object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuestionQuery A secondary query class using the current class as primary query
	 */
	public function useGraphRelationQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphRelationQuestion($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphRelationQuestion', 'GraphRelationQuestionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     GraphRelation $graphRelation Object to remove from the list of results
	 *
	 * @return    GraphRelationQuery The current query, for fluid interface
	 */
	public function prune($graphRelation = null)
	{
		if ($graphRelation) {
			$this->addUsingAlias(GraphRelationPeer::ID, $graphRelation->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseGraphRelationQuery
