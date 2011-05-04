<?php


/**
 * Base class that represents a query for the 'MER_graphModelAxis' table.
 *
 * Preguntas de los ejes de los graficos modelos
 *
 * @method     GraphModelAxisQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     GraphModelAxisQuery orderByGraphid($order = Criteria::ASC) Order by the graphId column
 * @method     GraphModelAxisQuery orderByAxis($order = Criteria::ASC) Order by the axis column
 * @method     GraphModelAxisQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     GraphModelAxisQuery orderByQuestionid($order = Criteria::ASC) Order by the questionId column
 *
 * @method     GraphModelAxisQuery groupById() Group by the id column
 * @method     GraphModelAxisQuery groupByGraphid() Group by the graphId column
 * @method     GraphModelAxisQuery groupByAxis() Group by the axis column
 * @method     GraphModelAxisQuery groupByType() Group by the type column
 * @method     GraphModelAxisQuery groupByQuestionid() Group by the questionId column
 *
 * @method     GraphModelAxisQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     GraphModelAxisQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     GraphModelAxisQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     GraphModelAxisQuery leftJoinGraphModel($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphModel relation
 * @method     GraphModelAxisQuery rightJoinGraphModel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphModel relation
 * @method     GraphModelAxisQuery innerJoinGraphModel($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphModel relation
 *
 * @method     GraphModelAxisQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     GraphModelAxisQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     GraphModelAxisQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     GraphModelAxis findOne(PropelPDO $con = null) Return the first GraphModelAxis matching the query
 * @method     GraphModelAxis findOneOrCreate(PropelPDO $con = null) Return the first GraphModelAxis matching the query, or a new GraphModelAxis object populated from the query conditions when no match is found
 *
 * @method     GraphModelAxis findOneById(int $id) Return the first GraphModelAxis filtered by the id column
 * @method     GraphModelAxis findOneByGraphid(int $graphId) Return the first GraphModelAxis filtered by the graphId column
 * @method     GraphModelAxis findOneByAxis(string $axis) Return the first GraphModelAxis filtered by the axis column
 * @method     GraphModelAxis findOneByType(int $type) Return the first GraphModelAxis filtered by the type column
 * @method     GraphModelAxis findOneByQuestionid(int $questionId) Return the first GraphModelAxis filtered by the questionId column
 *
 * @method     array findById(int $id) Return GraphModelAxis objects filtered by the id column
 * @method     array findByGraphid(int $graphId) Return GraphModelAxis objects filtered by the graphId column
 * @method     array findByAxis(string $axis) Return GraphModelAxis objects filtered by the axis column
 * @method     array findByType(int $type) Return GraphModelAxis objects filtered by the type column
 * @method     array findByQuestionid(int $questionId) Return GraphModelAxis objects filtered by the questionId column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseGraphModelAxisQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseGraphModelAxisQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'GraphModelAxis', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new GraphModelAxisQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    GraphModelAxisQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof GraphModelAxisQuery) {
			return $criteria;
		}
		$query = new GraphModelAxisQuery();
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
	 * @return    GraphModelAxis|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = GraphModelAxisPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(GraphModelAxisPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(GraphModelAxisPeer::ID, $keys, Criteria::IN);
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
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphModelAxisPeer::ID, $id, $comparison);
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
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByGraphid($graphid = null, $comparison = null)
	{
		if (is_array($graphid)) {
			$useMinMax = false;
			if (isset($graphid['min'])) {
				$this->addUsingAlias(GraphModelAxisPeer::GRAPHID, $graphid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($graphid['max'])) {
				$this->addUsingAlias(GraphModelAxisPeer::GRAPHID, $graphid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelAxisPeer::GRAPHID, $graphid, $comparison);
	}

	/**
	 * Filter the query on the axis column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAxis('fooValue');   // WHERE axis = 'fooValue'
	 * $query->filterByAxis('%fooValue%'); // WHERE axis LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $axis The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByAxis($axis = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($axis)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $axis)) {
				$axis = str_replace('*', '%', $axis);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(GraphModelAxisPeer::AXIS, $axis, $comparison);
	}

	/**
	 * Filter the query on the type column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByType(1234); // WHERE type = 1234
	 * $query->filterByType(array(12, 34)); // WHERE type IN (12, 34)
	 * $query->filterByType(array('min' => 12)); // WHERE type > 12
	 * </code>
	 *
	 * @param     mixed $type The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByType($type = null, $comparison = null)
	{
		if (is_array($type)) {
			$useMinMax = false;
			if (isset($type['min'])) {
				$this->addUsingAlias(GraphModelAxisPeer::TYPE, $type['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($type['max'])) {
				$this->addUsingAlias(GraphModelAxisPeer::TYPE, $type['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelAxisPeer::TYPE, $type, $comparison);
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
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByQuestionid($questionid = null, $comparison = null)
	{
		if (is_array($questionid)) {
			$useMinMax = false;
			if (isset($questionid['min'])) {
				$this->addUsingAlias(GraphModelAxisPeer::QUESTIONID, $questionid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($questionid['max'])) {
				$this->addUsingAlias(GraphModelAxisPeer::QUESTIONID, $questionid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelAxisPeer::QUESTIONID, $questionid, $comparison);
	}

	/**
	 * Filter the query by a related GraphModel object
	 *
	 * @param     GraphModel|PropelCollection $graphModel The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByGraphModel($graphModel, $comparison = null)
	{
		if ($graphModel instanceof GraphModel) {
			return $this
				->addUsingAlias(GraphModelAxisPeer::GRAPHID, $graphModel->getId(), $comparison);
		} elseif ($graphModel instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphModelAxisPeer::GRAPHID, $graphModel->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    GraphModelAxisQuery The current query, for fluid interface
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
	 * Filter the query by a related Question object
	 *
	 * @param     Question|PropelCollection $question The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(GraphModelAxisPeer::QUESTIONID, $question->getId(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GraphModelAxisPeer::QUESTIONID, $question->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    GraphModelAxisQuery The current query, for fluid interface
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
	 * @param     GraphModelAxis $graphModelAxis Object to remove from the list of results
	 *
	 * @return    GraphModelAxisQuery The current query, for fluid interface
	 */
	public function prune($graphModelAxis = null)
	{
		if ($graphModelAxis) {
			$this->addUsingAlias(GraphModelAxisPeer::ID, $graphModelAxis->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseGraphModelAxisQuery
