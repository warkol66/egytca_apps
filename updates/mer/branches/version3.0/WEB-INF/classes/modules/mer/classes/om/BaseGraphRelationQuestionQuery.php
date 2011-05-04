<?php


/**
 * Base class that represents a query for the 'MER_graphRelationQuestion' table.
 *
 * Preguntas de los graficos de relation
 *
 * @method     GraphRelationQuestionQuery orderByGraphrelationid($order = Criteria::ASC) Order by the graphRelationId column
 * @method     GraphRelationQuestionQuery orderByQuestionid($order = Criteria::ASC) Order by the questionId column
 *
 * @method     GraphRelationQuestionQuery groupByGraphrelationid() Group by the graphRelationId column
 * @method     GraphRelationQuestionQuery groupByQuestionid() Group by the questionId column
 *
 * @method     GraphRelationQuestionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     GraphRelationQuestionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     GraphRelationQuestionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     GraphRelationQuestionQuery leftJoinGraphRelation($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphRelation relation
 * @method     GraphRelationQuestionQuery rightJoinGraphRelation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphRelation relation
 * @method     GraphRelationQuestionQuery innerJoinGraphRelation($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphRelation relation
 *
 * @method     GraphRelationQuestionQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     GraphRelationQuestionQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     GraphRelationQuestionQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     GraphRelationQuestion findOne(PropelPDO $con = null) Return the first GraphRelationQuestion matching the query
 * @method     GraphRelationQuestion findOneOrCreate(PropelPDO $con = null) Return the first GraphRelationQuestion matching the query, or a new GraphRelationQuestion object populated from the query conditions when no match is found
 *
 * @method     GraphRelationQuestion findOneByGraphrelationid(int $graphRelationId) Return the first GraphRelationQuestion filtered by the graphRelationId column
 * @method     GraphRelationQuestion findOneByQuestionid(int $questionId) Return the first GraphRelationQuestion filtered by the questionId column
 *
 * @method     array findByGraphrelationid(int $graphRelationId) Return GraphRelationQuestion objects filtered by the graphRelationId column
 * @method     array findByQuestionid(int $questionId) Return GraphRelationQuestion objects filtered by the questionId column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseGraphRelationQuestionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseGraphRelationQuestionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'GraphRelationQuestion', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new GraphRelationQuestionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    GraphRelationQuestionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof GraphRelationQuestionQuery) {
			return $criteria;
		}
		$query = new GraphRelationQuestionQuery();
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
	 * @param     array[$graphRelationId, $questionId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    GraphRelationQuestion|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = GraphRelationQuestionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(GraphRelationQuestionPeer::GRAPHRELATIONID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(GraphRelationQuestionPeer::QUESTIONID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(GraphRelationQuestionPeer::GRAPHRELATIONID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(GraphRelationQuestionPeer::QUESTIONID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
	}

	/**
	 * Filter the query on the graphRelationId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByGraphrelationid(1234); // WHERE graphRelationId = 1234
	 * $query->filterByGraphrelationid(array(12, 34)); // WHERE graphRelationId IN (12, 34)
	 * $query->filterByGraphrelationid(array('min' => 12)); // WHERE graphRelationId > 12
	 * </code>
	 *
	 * @see       filterByGraphRelation()
	 *
	 * @param     mixed $graphrelationid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function filterByGraphrelationid($graphrelationid = null, $comparison = null)
	{
		if (is_array($graphrelationid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphRelationQuestionPeer::GRAPHRELATIONID, $graphrelationid, $comparison);
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
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestionid($questionid = null, $comparison = null)
	{
		if (is_array($questionid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphRelationQuestionPeer::QUESTIONID, $questionid, $comparison);
	}

	/**
	 * Filter the query by a related GraphRelation object
	 *
	 * @param     GraphRelation|PropelCollection $graphRelation The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function filterByGraphRelation($graphRelation, $comparison = null)
	{
		if ($graphRelation instanceof GraphRelation) {
			return $this
				->addUsingAlias(GraphRelationQuestionPeer::GRAPHRELATIONID, $graphRelation->getId(), $comparison);
		} elseif ($graphRelation instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphRelationQuestionPeer::GRAPHRELATIONID, $graphRelation->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByGraphRelation() only accepts arguments of type GraphRelation or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphRelation relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function joinGraphRelation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphRelation');
		
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
			$this->addJoinObject($join, 'GraphRelation');
		}
		
		return $this;
	}

	/**
	 * Use the GraphRelation relation GraphRelation object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuery A secondary query class using the current class as primary query
	 */
	public function useGraphRelationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphRelation($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphRelation', 'GraphRelationQuery');
	}

	/**
	 * Filter the query by a related Question object
	 *
	 * @param     Question|PropelCollection $question The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(GraphRelationQuestionPeer::QUESTIONID, $question->getId(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphRelationQuestionPeer::QUESTIONID, $question->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
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
	 * @param     GraphRelationQuestion $graphRelationQuestion Object to remove from the list of results
	 *
	 * @return    GraphRelationQuestionQuery The current query, for fluid interface
	 */
	public function prune($graphRelationQuestion = null)
	{
		if ($graphRelationQuestion) {
			$this->addCond('pruneCond0', $this->getAliasedColName(GraphRelationQuestionPeer::GRAPHRELATIONID), $graphRelationQuestion->getGraphrelationid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(GraphRelationQuestionPeer::QUESTIONID), $graphRelationQuestion->getQuestionid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseGraphRelationQuestionQuery
