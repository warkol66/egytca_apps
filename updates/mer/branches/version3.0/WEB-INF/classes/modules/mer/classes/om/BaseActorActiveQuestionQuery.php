<?php


/**
 * Base class that represents a query for the 'MER_actorActiveQuestion' table.
 *
 * 
 *
 * @method     ActorActiveQuestionQuery orderByActorid($order = Criteria::ASC) Order by the actorId column
 * @method     ActorActiveQuestionQuery orderByQuestionid($order = Criteria::ASC) Order by the questionId column
 *
 * @method     ActorActiveQuestionQuery groupByActorid() Group by the actorId column
 * @method     ActorActiveQuestionQuery groupByQuestionid() Group by the questionId column
 *
 * @method     ActorActiveQuestionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ActorActiveQuestionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ActorActiveQuestionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ActorActiveQuestionQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     ActorActiveQuestionQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     ActorActiveQuestionQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     ActorActiveQuestionQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     ActorActiveQuestionQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     ActorActiveQuestionQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     ActorActiveQuestion findOne(PropelPDO $con = null) Return the first ActorActiveQuestion matching the query
 * @method     ActorActiveQuestion findOneOrCreate(PropelPDO $con = null) Return the first ActorActiveQuestion matching the query, or a new ActorActiveQuestion object populated from the query conditions when no match is found
 *
 * @method     ActorActiveQuestion findOneByActorid(int $actorId) Return the first ActorActiveQuestion filtered by the actorId column
 * @method     ActorActiveQuestion findOneByQuestionid(int $questionId) Return the first ActorActiveQuestion filtered by the questionId column
 *
 * @method     array findByActorid(int $actorId) Return ActorActiveQuestion objects filtered by the actorId column
 * @method     array findByQuestionid(int $questionId) Return ActorActiveQuestion objects filtered by the questionId column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseActorActiveQuestionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseActorActiveQuestionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'ActorActiveQuestion', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ActorActiveQuestionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ActorActiveQuestionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ActorActiveQuestionQuery) {
			return $criteria;
		}
		$query = new ActorActiveQuestionQuery();
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
	 * @param     array[$actorId, $questionId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    ActorActiveQuestion|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ActorActiveQuestionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(ActorActiveQuestionPeer::ACTORID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(ActorActiveQuestionPeer::QUESTIONID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(ActorActiveQuestionPeer::ACTORID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(ActorActiveQuestionPeer::QUESTIONID, $key[1], Criteria::EQUAL);
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
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByActorid($actorid = null, $comparison = null)
	{
		if (is_array($actorid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ActorActiveQuestionPeer::ACTORID, $actorid, $comparison);
	}

	/**
	 * Filter the query on the questionId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByQuestionid(1234); // WHERE questionId = 1234
	 * $query->filterByQuestionid(array(12, 34)); // WHERE questionId IN (12, 34)
	 * $query->filterByQuestionid(array('min' => 12)); // WHERE questionId > 12
	 * </code>
	 *
	 * @see       filterByQuestion()
	 *
	 * @param     mixed $questionid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestionid($questionid = null, $comparison = null)
	{
		if (is_array($questionid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ActorActiveQuestionPeer::QUESTIONID, $questionid, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByActor($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(ActorActiveQuestionPeer::ACTORID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ActorActiveQuestionPeer::ACTORID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
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
	 * Filter the query by a related Question object
	 *
	 * @param     Question|PropelCollection $question The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(ActorActiveQuestionPeer::QUESTIONID, $question->getId(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ActorActiveQuestionPeer::QUESTIONID, $question->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByQuestion() only accepts arguments of type Question or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Question relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function joinQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Question');
		
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
			$this->addJoinObject($join, 'Question');
		}
		
		return $this;
	}

	/**
	 * Use the Question relation Question object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery A secondary query class using the current class as primary query
	 */
	public function useQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinQuestion($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Question', 'QuestionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     ActorActiveQuestion $actorActiveQuestion Object to remove from the list of results
	 *
	 * @return    ActorActiveQuestionQuery The current query, for fluid interface
	 */
	public function prune($actorActiveQuestion = null)
	{
		if ($actorActiveQuestion) {
			$this->addCond('pruneCond0', $this->getAliasedColName(ActorActiveQuestionPeer::ACTORID), $actorActiveQuestion->getActorid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(ActorActiveQuestionPeer::QUESTIONID), $actorActiveQuestion->getQuestionid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseActorActiveQuestionQuery
