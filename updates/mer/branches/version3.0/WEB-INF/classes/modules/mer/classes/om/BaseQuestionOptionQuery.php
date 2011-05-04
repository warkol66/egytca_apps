<?php


/**
 * Base class that represents a query for the 'MER_formSectionQuestionOption' table.
 *
 * Options for type-select questions
 *
 * @method     QuestionOptionQuery orderByQuestionid($order = Criteria::ASC) Order by the questionId column
 * @method     QuestionOptionQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     QuestionOptionQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     QuestionOptionQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method     QuestionOptionQuery orderByDefaultopc($order = Criteria::ASC) Order by the defaultOpc column
 *
 * @method     QuestionOptionQuery groupByQuestionid() Group by the questionId column
 * @method     QuestionOptionQuery groupByPosition() Group by the position column
 * @method     QuestionOptionQuery groupByValue() Group by the value column
 * @method     QuestionOptionQuery groupByText() Group by the text column
 * @method     QuestionOptionQuery groupByDefaultopc() Group by the defaultOpc column
 *
 * @method     QuestionOptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     QuestionOptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     QuestionOptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     QuestionOptionQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     QuestionOptionQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     QuestionOptionQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     QuestionOption findOne(PropelPDO $con = null) Return the first QuestionOption matching the query
 * @method     QuestionOption findOneOrCreate(PropelPDO $con = null) Return the first QuestionOption matching the query, or a new QuestionOption object populated from the query conditions when no match is found
 *
 * @method     QuestionOption findOneByQuestionid(int $questionId) Return the first QuestionOption filtered by the questionId column
 * @method     QuestionOption findOneByPosition(int $position) Return the first QuestionOption filtered by the position column
 * @method     QuestionOption findOneByValue(string $value) Return the first QuestionOption filtered by the value column
 * @method     QuestionOption findOneByText(string $text) Return the first QuestionOption filtered by the text column
 * @method     QuestionOption findOneByDefaultopc(boolean $defaultOpc) Return the first QuestionOption filtered by the defaultOpc column
 *
 * @method     array findByQuestionid(int $questionId) Return QuestionOption objects filtered by the questionId column
 * @method     array findByPosition(int $position) Return QuestionOption objects filtered by the position column
 * @method     array findByValue(string $value) Return QuestionOption objects filtered by the value column
 * @method     array findByText(string $text) Return QuestionOption objects filtered by the text column
 * @method     array findByDefaultopc(boolean $defaultOpc) Return QuestionOption objects filtered by the defaultOpc column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseQuestionOptionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseQuestionOptionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'QuestionOption', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new QuestionOptionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    QuestionOptionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof QuestionOptionQuery) {
			return $criteria;
		}
		$query = new QuestionOptionQuery();
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
	 * @param     array[$questionId, $position] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    QuestionOption|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = QuestionOptionPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(QuestionOptionPeer::QUESTIONID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(QuestionOptionPeer::POSITION, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(QuestionOptionPeer::QUESTIONID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(QuestionOptionPeer::POSITION, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
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
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByQuestionid($questionid = null, $comparison = null)
	{
		if (is_array($questionid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(QuestionOptionPeer::QUESTIONID, $questionid, $comparison);
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
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(QuestionOptionPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the value column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
	 * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $value The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByValue($value = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($value)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $value)) {
				$value = str_replace('*', '%', $value);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(QuestionOptionPeer::VALUE, $value, $comparison);
	}

	/**
	 * Filter the query on the text column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
	 * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $text The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByText($text = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($text)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $text)) {
				$text = str_replace('*', '%', $text);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(QuestionOptionPeer::TEXT, $text, $comparison);
	}

	/**
	 * Filter the query on the defaultOpc column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDefaultopc(true); // WHERE defaultOpc = true
	 * $query->filterByDefaultopc('yes'); // WHERE defaultOpc = true
	 * </code>
	 *
	 * @param     boolean|string $defaultopc The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByDefaultopc($defaultopc = null, $comparison = null)
	{
		if (is_string($defaultopc)) {
			$defaultOpc = in_array(strtolower($defaultopc), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(QuestionOptionPeer::DEFAULTOPC, $defaultopc, $comparison);
	}

	/**
	 * Filter the query by a related Question object
	 *
	 * @param     Question|PropelCollection $question The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(QuestionOptionPeer::QUESTIONID, $question->getId(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(QuestionOptionPeer::QUESTIONID, $question->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    QuestionOptionQuery The current query, for fluid interface
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
	 * @param     QuestionOption $questionOption Object to remove from the list of results
	 *
	 * @return    QuestionOptionQuery The current query, for fluid interface
	 */
	public function prune($questionOption = null)
	{
		if ($questionOption) {
			$this->addCond('pruneCond0', $this->getAliasedColName(QuestionOptionPeer::QUESTIONID), $questionOption->getQuestionid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(QuestionOptionPeer::POSITION), $questionOption->getPosition(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseQuestionOptionQuery
