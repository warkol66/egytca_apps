<?php


/**
 * Base class that represents a query for the 'MER_judgementActor' table.
 *
 * Juicio general del actor
 *
 * @method     JudgementActorQuery orderByActorid($order = Criteria::ASC) Order by the actorId column
 * @method     JudgementActorQuery orderByMark($order = Criteria::ASC) Order by the mark column
 * @method     JudgementActorQuery orderByJudgement($order = Criteria::ASC) Order by the judgement column
 * @method     JudgementActorQuery orderByOld($order = Criteria::ASC) Order by the old column
 *
 * @method     JudgementActorQuery groupByActorid() Group by the actorId column
 * @method     JudgementActorQuery groupByMark() Group by the mark column
 * @method     JudgementActorQuery groupByJudgement() Group by the judgement column
 * @method     JudgementActorQuery groupByOld() Group by the old column
 *
 * @method     JudgementActorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     JudgementActorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     JudgementActorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     JudgementActorQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     JudgementActorQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     JudgementActorQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     JudgementActor findOne(PropelPDO $con = null) Return the first JudgementActor matching the query
 * @method     JudgementActor findOneOrCreate(PropelPDO $con = null) Return the first JudgementActor matching the query, or a new JudgementActor object populated from the query conditions when no match is found
 *
 * @method     JudgementActor findOneByActorid(int $actorId) Return the first JudgementActor filtered by the actorId column
 * @method     JudgementActor findOneByMark(int $mark) Return the first JudgementActor filtered by the mark column
 * @method     JudgementActor findOneByJudgement(string $judgement) Return the first JudgementActor filtered by the judgement column
 * @method     JudgementActor findOneByOld(int $old) Return the first JudgementActor filtered by the old column
 *
 * @method     array findByActorid(int $actorId) Return JudgementActor objects filtered by the actorId column
 * @method     array findByMark(int $mark) Return JudgementActor objects filtered by the mark column
 * @method     array findByJudgement(string $judgement) Return JudgementActor objects filtered by the judgement column
 * @method     array findByOld(int $old) Return JudgementActor objects filtered by the old column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseJudgementActorQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseJudgementActorQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'JudgementActor', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new JudgementActorQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    JudgementActorQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof JudgementActorQuery) {
			return $criteria;
		}
		$query = new JudgementActorQuery();
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
	 * @return    JudgementActor|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = JudgementActorPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(JudgementActorPeer::ACTORID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(JudgementActorPeer::ACTORID, $keys, Criteria::IN);
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
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function filterByActorid($actorid = null, $comparison = null)
	{
		if (is_array($actorid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(JudgementActorPeer::ACTORID, $actorid, $comparison);
	}

	/**
	 * Filter the query on the mark column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByMark(1234); // WHERE mark = 1234
	 * $query->filterByMark(array(12, 34)); // WHERE mark IN (12, 34)
	 * $query->filterByMark(array('min' => 12)); // WHERE mark > 12
	 * </code>
	 *
	 * @param     mixed $mark The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function filterByMark($mark = null, $comparison = null)
	{
		if (is_array($mark)) {
			$useMinMax = false;
			if (isset($mark['min'])) {
				$this->addUsingAlias(JudgementActorPeer::MARK, $mark['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($mark['max'])) {
				$this->addUsingAlias(JudgementActorPeer::MARK, $mark['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(JudgementActorPeer::MARK, $mark, $comparison);
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
	 * @return    JudgementActorQuery The current query, for fluid interface
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
		return $this->addUsingAlias(JudgementActorPeer::JUDGEMENT, $judgement, $comparison);
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
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function filterByOld($old = null, $comparison = null)
	{
		if (is_array($old)) {
			$useMinMax = false;
			if (isset($old['min'])) {
				$this->addUsingAlias(JudgementActorPeer::OLD, $old['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($old['max'])) {
				$this->addUsingAlias(JudgementActorPeer::OLD, $old['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(JudgementActorPeer::OLD, $old, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function filterByActor($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(JudgementActorPeer::ACTORID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(JudgementActorPeer::ACTORID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    JudgementActorQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     JudgementActor $judgementActor Object to remove from the list of results
	 *
	 * @return    JudgementActorQuery The current query, for fluid interface
	 */
	public function prune($judgementActor = null)
	{
		if ($judgementActor) {
			$this->addUsingAlias(JudgementActorPeer::ACTORID, $judgementActor->getActorid(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseJudgementActorQuery
