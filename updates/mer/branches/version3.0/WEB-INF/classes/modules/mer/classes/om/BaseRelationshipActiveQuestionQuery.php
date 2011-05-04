<?php


/**
 * Base class that represents a query for the 'MER_relationshipActiveQuestion' table.
 *
 * 
 *
 * @method     RelationshipActiveQuestionQuery orderByActor1id($order = Criteria::ASC) Order by the actor1Id column
 * @method     RelationshipActiveQuestionQuery orderByActor2id($order = Criteria::ASC) Order by the actor2Id column
 * @method     RelationshipActiveQuestionQuery orderByQuestionid($order = Criteria::ASC) Order by the questionId column
 *
 * @method     RelationshipActiveQuestionQuery groupByActor1id() Group by the actor1Id column
 * @method     RelationshipActiveQuestionQuery groupByActor2id() Group by the actor2Id column
 * @method     RelationshipActiveQuestionQuery groupByQuestionid() Group by the questionId column
 *
 * @method     RelationshipActiveQuestionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     RelationshipActiveQuestionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     RelationshipActiveQuestionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     RelationshipActiveQuestionQuery leftJoinActorRelatedByActor1id($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorRelatedByActor1id relation
 * @method     RelationshipActiveQuestionQuery rightJoinActorRelatedByActor1id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorRelatedByActor1id relation
 * @method     RelationshipActiveQuestionQuery innerJoinActorRelatedByActor1id($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorRelatedByActor1id relation
 *
 * @method     RelationshipActiveQuestionQuery leftJoinActorRelatedByActor2id($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorRelatedByActor2id relation
 * @method     RelationshipActiveQuestionQuery rightJoinActorRelatedByActor2id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorRelatedByActor2id relation
 * @method     RelationshipActiveQuestionQuery innerJoinActorRelatedByActor2id($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorRelatedByActor2id relation
 *
 * @method     RelationshipActiveQuestionQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     RelationshipActiveQuestionQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     RelationshipActiveQuestionQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     RelationshipActiveQuestion findOne(PropelPDO $con = null) Return the first RelationshipActiveQuestion matching the query
 * @method     RelationshipActiveQuestion findOneOrCreate(PropelPDO $con = null) Return the first RelationshipActiveQuestion matching the query, or a new RelationshipActiveQuestion object populated from the query conditions when no match is found
 *
 * @method     RelationshipActiveQuestion findOneByActor1id(int $actor1Id) Return the first RelationshipActiveQuestion filtered by the actor1Id column
 * @method     RelationshipActiveQuestion findOneByActor2id(int $actor2Id) Return the first RelationshipActiveQuestion filtered by the actor2Id column
 * @method     RelationshipActiveQuestion findOneByQuestionid(int $questionId) Return the first RelationshipActiveQuestion filtered by the questionId column
 *
 * @method     array findByActor1id(int $actor1Id) Return RelationshipActiveQuestion objects filtered by the actor1Id column
 * @method     array findByActor2id(int $actor2Id) Return RelationshipActiveQuestion objects filtered by the actor2Id column
 * @method     array findByQuestionid(int $questionId) Return RelationshipActiveQuestion objects filtered by the questionId column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseRelationshipActiveQuestionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseRelationshipActiveQuestionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'RelationshipActiveQuestion', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new RelationshipActiveQuestionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    RelationshipActiveQuestionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof RelationshipActiveQuestionQuery) {
			return $criteria;
		}
		$query = new RelationshipActiveQuestionQuery();
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
	 * $obj = $c->findPk(array(12, 34, 56), $con);
	 * </code>
	 * @param     array[$actor1Id, $actor2Id, $questionId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    RelationshipActiveQuestion|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = RelationshipActiveQuestionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR1ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR2ID, $key[1], Criteria::EQUAL);
		$this->addUsingAlias(RelationshipActiveQuestionPeer::QUESTIONID, $key[2], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(RelationshipActiveQuestionPeer::ACTOR1ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(RelationshipActiveQuestionPeer::ACTOR2ID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$cton2 = $this->getNewCriterion(RelationshipActiveQuestionPeer::QUESTIONID, $key[2], Criteria::EQUAL);
			$cton0->addAnd($cton2);
			$this->addOr($cton0);
		}
		
		return $this;
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByActor1id($actor1id = null, $comparison = null)
	{
		if (is_array($actor1id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR1ID, $actor1id, $comparison);
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByActor2id($actor2id = null, $comparison = null)
	{
		if (is_array($actor2id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR2ID, $actor2id, $comparison);
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestionid($questionid = null, $comparison = null)
	{
		if (is_array($questionid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(RelationshipActiveQuestionPeer::QUESTIONID, $questionid, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByActorRelatedByActor1id($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR1ID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR1ID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function joinActorRelatedByActor1id($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useActorRelatedByActor1idQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByActorRelatedByActor2id($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR2ID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RelationshipActiveQuestionPeer::ACTOR2ID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function joinActorRelatedByActor2id($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useActorRelatedByActor2idQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinActorRelatedByActor2id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ActorRelatedByActor2id', 'ActorQuery');
	}

	/**
	 * Filter the query by a related Question object
	 *
	 * @param     Question|PropelCollection $question The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(RelationshipActiveQuestionPeer::QUESTIONID, $question->getId(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(RelationshipActiveQuestionPeer::QUESTIONID, $question->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
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
	 * @param     RelationshipActiveQuestion $relationshipActiveQuestion Object to remove from the list of results
	 *
	 * @return    RelationshipActiveQuestionQuery The current query, for fluid interface
	 */
	public function prune($relationshipActiveQuestion = null)
	{
		if ($relationshipActiveQuestion) {
			$this->addCond('pruneCond0', $this->getAliasedColName(RelationshipActiveQuestionPeer::ACTOR1ID), $relationshipActiveQuestion->getActor1id(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(RelationshipActiveQuestionPeer::ACTOR2ID), $relationshipActiveQuestion->getActor2id(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond2', $this->getAliasedColName(RelationshipActiveQuestionPeer::QUESTIONID), $relationshipActiveQuestion->getQuestionid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseRelationshipActiveQuestionQuery
