<?php


/**
 * Base class that represents a query for the 'MER_formAnswer' table.
 *
 * 
 *
 * @method     AnswerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     AnswerQuery orderByActorid($order = Criteria::ASC) Order by the actorId column
 * @method     AnswerQuery orderByQuestionid($order = Criteria::ASC) Order by the questionId column
 * @method     AnswerQuery orderByAnswer($order = Criteria::ASC) Order by the answer column
 * @method     AnswerQuery orderByJudgement($order = Criteria::ASC) Order by the judgement column
 * @method     AnswerQuery orderByOld($order = Criteria::ASC) Order by the old column
 *
 * @method     AnswerQuery groupById() Group by the id column
 * @method     AnswerQuery groupByActorid() Group by the actorId column
 * @method     AnswerQuery groupByQuestionid() Group by the questionId column
 * @method     AnswerQuery groupByAnswer() Group by the answer column
 * @method     AnswerQuery groupByJudgement() Group by the judgement column
 * @method     AnswerQuery groupByOld() Group by the old column
 *
 * @method     AnswerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     AnswerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     AnswerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     AnswerQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     AnswerQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     AnswerQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     AnswerQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     AnswerQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     AnswerQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     Answer findOne(PropelPDO $con = null) Return the first Answer matching the query
 * @method     Answer findOneOrCreate(PropelPDO $con = null) Return the first Answer matching the query, or a new Answer object populated from the query conditions when no match is found
 *
 * @method     Answer findOneById(int $id) Return the first Answer filtered by the id column
 * @method     Answer findOneByActorid(int $actorId) Return the first Answer filtered by the actorId column
 * @method     Answer findOneByQuestionid(int $questionId) Return the first Answer filtered by the questionId column
 * @method     Answer findOneByAnswer(string $answer) Return the first Answer filtered by the answer column
 * @method     Answer findOneByJudgement(string $judgement) Return the first Answer filtered by the judgement column
 * @method     Answer findOneByOld(int $old) Return the first Answer filtered by the old column
 *
 * @method     array findById(int $id) Return Answer objects filtered by the id column
 * @method     array findByActorid(int $actorId) Return Answer objects filtered by the actorId column
 * @method     array findByQuestionid(int $questionId) Return Answer objects filtered by the questionId column
 * @method     array findByAnswer(string $answer) Return Answer objects filtered by the answer column
 * @method     array findByJudgement(string $judgement) Return Answer objects filtered by the judgement column
 * @method     array findByOld(int $old) Return Answer objects filtered by the old column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseAnswerQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseAnswerQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Answer', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new AnswerQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    AnswerQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof AnswerQuery) {
			return $criteria;
		}
		$query = new AnswerQuery();
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
	 * @return    Answer|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = AnswerPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(AnswerPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(AnswerPeer::ID, $keys, Criteria::IN);
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
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(AnswerPeer::ID, $id, $comparison);
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
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByActorid($actorid = null, $comparison = null)
	{
		if (is_array($actorid)) {
			$useMinMax = false;
			if (isset($actorid['min'])) {
				$this->addUsingAlias(AnswerPeer::ACTORID, $actorid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($actorid['max'])) {
				$this->addUsingAlias(AnswerPeer::ACTORID, $actorid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AnswerPeer::ACTORID, $actorid, $comparison);
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
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByQuestionid($questionid = null, $comparison = null)
	{
		if (is_array($questionid)) {
			$useMinMax = false;
			if (isset($questionid['min'])) {
				$this->addUsingAlias(AnswerPeer::QUESTIONID, $questionid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($questionid['max'])) {
				$this->addUsingAlias(AnswerPeer::QUESTIONID, $questionid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AnswerPeer::QUESTIONID, $questionid, $comparison);
	}

	/**
	 * Filter the query on the answer column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAnswer('fooValue');   // WHERE answer = 'fooValue'
	 * $query->filterByAnswer('%fooValue%'); // WHERE answer LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $answer The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByAnswer($answer = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($answer)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $answer)) {
				$answer = str_replace('*', '%', $answer);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(AnswerPeer::ANSWER, $answer, $comparison);
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
	 * @return    AnswerQuery The current query, for fluid interface
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
		return $this->addUsingAlias(AnswerPeer::JUDGEMENT, $judgement, $comparison);
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
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByOld($old = null, $comparison = null)
	{
		if (is_array($old)) {
			$useMinMax = false;
			if (isset($old['min'])) {
				$this->addUsingAlias(AnswerPeer::OLD, $old['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($old['max'])) {
				$this->addUsingAlias(AnswerPeer::OLD, $old['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(AnswerPeer::OLD, $old, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor|PropelCollection $actor The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByActor($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(AnswerPeer::ACTORID, $actor->getId(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AnswerPeer::ACTORID, $actor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    AnswerQuery The current query, for fluid interface
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
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(AnswerPeer::QUESTIONID, $question->getId(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(AnswerPeer::QUESTIONID, $question->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    AnswerQuery The current query, for fluid interface
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
	 * @param     Answer $answer Object to remove from the list of results
	 *
	 * @return    AnswerQuery The current query, for fluid interface
	 */
	public function prune($answer = null)
	{
		if ($answer) {
			$this->addUsingAlias(AnswerPeer::ID, $answer->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseAnswerQuery
