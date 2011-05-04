<?php


/**
 * Base class that represents a query for the 'MER_formSectionQuestion' table.
 *
 * 
 *
 * @method     QuestionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     QuestionQuery orderBySectionid($order = Criteria::ASC) Order by the sectionId column
 * @method     QuestionQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     QuestionQuery orderByQuestion($order = Criteria::ASC) Order by the question column
 * @method     QuestionQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     QuestionQuery orderByUnit($order = Criteria::ASC) Order by the unit column
 * @method     QuestionQuery orderByAnalysis($order = Criteria::ASC) Order by the analysis column
 * @method     QuestionQuery orderByLabel($order = Criteria::ASC) Order by the label column
 *
 * @method     QuestionQuery groupById() Group by the id column
 * @method     QuestionQuery groupBySectionid() Group by the sectionId column
 * @method     QuestionQuery groupByType() Group by the type column
 * @method     QuestionQuery groupByQuestion() Group by the question column
 * @method     QuestionQuery groupByPosition() Group by the position column
 * @method     QuestionQuery groupByUnit() Group by the unit column
 * @method     QuestionQuery groupByAnalysis() Group by the analysis column
 * @method     QuestionQuery groupByLabel() Group by the label column
 *
 * @method     QuestionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     QuestionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     QuestionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     QuestionQuery leftJoinFormSection($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormSection relation
 * @method     QuestionQuery rightJoinFormSection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormSection relation
 * @method     QuestionQuery innerJoinFormSection($relationAlias = null) Adds a INNER JOIN clause to the query using the FormSection relation
 *
 * @method     QuestionQuery leftJoinQuestionOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the QuestionOption relation
 * @method     QuestionQuery rightJoinQuestionOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the QuestionOption relation
 * @method     QuestionQuery innerJoinQuestionOption($relationAlias = null) Adds a INNER JOIN clause to the query using the QuestionOption relation
 *
 * @method     QuestionQuery leftJoinRelationship($relationAlias = null) Adds a LEFT JOIN clause to the query using the Relationship relation
 * @method     QuestionQuery rightJoinRelationship($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Relationship relation
 * @method     QuestionQuery innerJoinRelationship($relationAlias = null) Adds a INNER JOIN clause to the query using the Relationship relation
 *
 * @method     QuestionQuery leftJoinActorActiveQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorActiveQuestion relation
 * @method     QuestionQuery rightJoinActorActiveQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorActiveQuestion relation
 * @method     QuestionQuery innerJoinActorActiveQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorActiveQuestion relation
 *
 * @method     QuestionQuery leftJoinRelationshipActiveQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the RelationshipActiveQuestion relation
 * @method     QuestionQuery rightJoinRelationshipActiveQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RelationshipActiveQuestion relation
 * @method     QuestionQuery innerJoinRelationshipActiveQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the RelationshipActiveQuestion relation
 *
 * @method     QuestionQuery leftJoinAnswer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Answer relation
 * @method     QuestionQuery rightJoinAnswer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Answer relation
 * @method     QuestionQuery innerJoinAnswer($relationAlias = null) Adds a INNER JOIN clause to the query using the Answer relation
 *
 * @method     QuestionQuery leftJoinGraphModelAxis($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphModelAxis relation
 * @method     QuestionQuery rightJoinGraphModelAxis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphModelAxis relation
 * @method     QuestionQuery innerJoinGraphModelAxis($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphModelAxis relation
 *
 * @method     QuestionQuery leftJoinGraphRelationQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphRelationQuestion relation
 * @method     QuestionQuery rightJoinGraphRelationQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphRelationQuestion relation
 * @method     QuestionQuery innerJoinGraphRelationQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphRelationQuestion relation
 *
 * @method     Question findOne(PropelPDO $con = null) Return the first Question matching the query
 * @method     Question findOneOrCreate(PropelPDO $con = null) Return the first Question matching the query, or a new Question object populated from the query conditions when no match is found
 *
 * @method     Question findOneById(int $id) Return the first Question filtered by the id column
 * @method     Question findOneBySectionid(int $sectionId) Return the first Question filtered by the sectionId column
 * @method     Question findOneByType(int $type) Return the first Question filtered by the type column
 * @method     Question findOneByQuestion(string $question) Return the first Question filtered by the question column
 * @method     Question findOneByPosition(int $position) Return the first Question filtered by the position column
 * @method     Question findOneByUnit(string $unit) Return the first Question filtered by the unit column
 * @method     Question findOneByAnalysis(boolean $analysis) Return the first Question filtered by the analysis column
 * @method     Question findOneByLabel(string $label) Return the first Question filtered by the label column
 *
 * @method     array findById(int $id) Return Question objects filtered by the id column
 * @method     array findBySectionid(int $sectionId) Return Question objects filtered by the sectionId column
 * @method     array findByType(int $type) Return Question objects filtered by the type column
 * @method     array findByQuestion(string $question) Return Question objects filtered by the question column
 * @method     array findByPosition(int $position) Return Question objects filtered by the position column
 * @method     array findByUnit(string $unit) Return Question objects filtered by the unit column
 * @method     array findByAnalysis(boolean $analysis) Return Question objects filtered by the analysis column
 * @method     array findByLabel(string $label) Return Question objects filtered by the label column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseQuestionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseQuestionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Question', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new QuestionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    QuestionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof QuestionQuery) {
			return $criteria;
		}
		$query = new QuestionQuery();
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
	 * @return    Question|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = QuestionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(QuestionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(QuestionPeer::ID, $keys, Criteria::IN);
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
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(QuestionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the sectionId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySectionid(1234); // WHERE sectionId = 1234
	 * $query->filterBySectionid(array(12, 34)); // WHERE sectionId IN (12, 34)
	 * $query->filterBySectionid(array('min' => 12)); // WHERE sectionId > 12
	 * </code>
	 *
	 * @see       filterByFormSection()
	 *
	 * @param     mixed $sectionid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterBySectionid($sectionid = null, $comparison = null)
	{
		if (is_array($sectionid)) {
			$useMinMax = false;
			if (isset($sectionid['min'])) {
				$this->addUsingAlias(QuestionPeer::SECTIONID, $sectionid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sectionid['max'])) {
				$this->addUsingAlias(QuestionPeer::SECTIONID, $sectionid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(QuestionPeer::SECTIONID, $sectionid, $comparison);
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
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByType($type = null, $comparison = null)
	{
		if (is_array($type)) {
			$useMinMax = false;
			if (isset($type['min'])) {
				$this->addUsingAlias(QuestionPeer::TYPE, $type['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($type['max'])) {
				$this->addUsingAlias(QuestionPeer::TYPE, $type['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(QuestionPeer::TYPE, $type, $comparison);
	}

	/**
	 * Filter the query on the question column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByQuestion('fooValue');   // WHERE question = 'fooValue'
	 * $query->filterByQuestion('%fooValue%'); // WHERE question LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $question The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($question)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $question)) {
				$question = str_replace('*', '%', $question);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(QuestionPeer::QUESTION, $question, $comparison);
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
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(QuestionPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(QuestionPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(QuestionPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the unit column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUnit('fooValue');   // WHERE unit = 'fooValue'
	 * $query->filterByUnit('%fooValue%'); // WHERE unit LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $unit The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByUnit($unit = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($unit)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $unit)) {
				$unit = str_replace('*', '%', $unit);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(QuestionPeer::UNIT, $unit, $comparison);
	}

	/**
	 * Filter the query on the analysis column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAnalysis(true); // WHERE analysis = true
	 * $query->filterByAnalysis('yes'); // WHERE analysis = true
	 * </code>
	 *
	 * @param     boolean|string $analysis The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByAnalysis($analysis = null, $comparison = null)
	{
		if (is_string($analysis)) {
			$analysis = in_array(strtolower($analysis), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(QuestionPeer::ANALYSIS, $analysis, $comparison);
	}

	/**
	 * Filter the query on the label column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
	 * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $label The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByLabel($label = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($label)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $label)) {
				$label = str_replace('*', '%', $label);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(QuestionPeer::LABEL, $label, $comparison);
	}

	/**
	 * Filter the query by a related FormSection object
	 *
	 * @param     FormSection|PropelCollection $formSection The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByFormSection($formSection, $comparison = null)
	{
		if ($formSection instanceof FormSection) {
			return $this
				->addUsingAlias(QuestionPeer::SECTIONID, $formSection->getId(), $comparison);
		} elseif ($formSection instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(QuestionPeer::SECTIONID, $formSection->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByFormSection() only accepts arguments of type FormSection or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FormSection relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinFormSection($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FormSection');
		
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
			$this->addJoinObject($join, 'FormSection');
		}
		
		return $this;
	}

	/**
	 * Use the FormSection relation FormSection object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormSectionQuery A secondary query class using the current class as primary query
	 */
	public function useFormSectionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinFormSection($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FormSection', 'FormSectionQuery');
	}

	/**
	 * Filter the query by a related QuestionOption object
	 *
	 * @param     QuestionOption $questionOption  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByQuestionOption($questionOption, $comparison = null)
	{
		if ($questionOption instanceof QuestionOption) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $questionOption->getQuestionid(), $comparison);
		} elseif ($questionOption instanceof PropelCollection) {
			return $this
				->useQuestionOptionQuery()
					->filterByPrimaryKeys($questionOption->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByQuestionOption() only accepts arguments of type QuestionOption or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the QuestionOption relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinQuestionOption($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('QuestionOption');
		
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
			$this->addJoinObject($join, 'QuestionOption');
		}
		
		return $this;
	}

	/**
	 * Use the QuestionOption relation QuestionOption object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionOptionQuery A secondary query class using the current class as primary query
	 */
	public function useQuestionOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinQuestionOption($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'QuestionOption', 'QuestionOptionQuery');
	}

	/**
	 * Filter the query by a related Relationship object
	 *
	 * @param     Relationship $relationship  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByRelationship($relationship, $comparison = null)
	{
		if ($relationship instanceof Relationship) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $relationship->getQuestionid(), $comparison);
		} elseif ($relationship instanceof PropelCollection) {
			return $this
				->useRelationshipQuery()
					->filterByPrimaryKeys($relationship->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRelationship() only accepts arguments of type Relationship or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Relationship relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinRelationship($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Relationship');
		
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
			$this->addJoinObject($join, 'Relationship');
		}
		
		return $this;
	}

	/**
	 * Use the Relationship relation Relationship object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RelationshipQuery A secondary query class using the current class as primary query
	 */
	public function useRelationshipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRelationship($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Relationship', 'RelationshipQuery');
	}

	/**
	 * Filter the query by a related ActorActiveQuestion object
	 *
	 * @param     ActorActiveQuestion $actorActiveQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByActorActiveQuestion($actorActiveQuestion, $comparison = null)
	{
		if ($actorActiveQuestion instanceof ActorActiveQuestion) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $actorActiveQuestion->getQuestionid(), $comparison);
		} elseif ($actorActiveQuestion instanceof PropelCollection) {
			return $this
				->useActorActiveQuestionQuery()
					->filterByPrimaryKeys($actorActiveQuestion->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByActorActiveQuestion() only accepts arguments of type ActorActiveQuestion or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ActorActiveQuestion relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinActorActiveQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ActorActiveQuestion');
		
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
			$this->addJoinObject($join, 'ActorActiveQuestion');
		}
		
		return $this;
	}

	/**
	 * Use the ActorActiveQuestion relation ActorActiveQuestion object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorActiveQuestionQuery A secondary query class using the current class as primary query
	 */
	public function useActorActiveQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinActorActiveQuestion($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ActorActiveQuestion', 'ActorActiveQuestionQuery');
	}

	/**
	 * Filter the query by a related RelationshipActiveQuestion object
	 *
	 * @param     RelationshipActiveQuestion $relationshipActiveQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByRelationshipActiveQuestion($relationshipActiveQuestion, $comparison = null)
	{
		if ($relationshipActiveQuestion instanceof RelationshipActiveQuestion) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $relationshipActiveQuestion->getQuestionid(), $comparison);
		} elseif ($relationshipActiveQuestion instanceof PropelCollection) {
			return $this
				->useRelationshipActiveQuestionQuery()
					->filterByPrimaryKeys($relationshipActiveQuestion->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRelationshipActiveQuestion() only accepts arguments of type RelationshipActiveQuestion or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the RelationshipActiveQuestion relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinRelationshipActiveQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('RelationshipActiveQuestion');
		
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
			$this->addJoinObject($join, 'RelationshipActiveQuestion');
		}
		
		return $this;
	}

	/**
	 * Use the RelationshipActiveQuestion relation RelationshipActiveQuestion object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RelationshipActiveQuestionQuery A secondary query class using the current class as primary query
	 */
	public function useRelationshipActiveQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRelationshipActiveQuestion($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'RelationshipActiveQuestion', 'RelationshipActiveQuestionQuery');
	}

	/**
	 * Filter the query by a related Answer object
	 *
	 * @param     Answer $answer  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByAnswer($answer, $comparison = null)
	{
		if ($answer instanceof Answer) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $answer->getQuestionid(), $comparison);
		} elseif ($answer instanceof PropelCollection) {
			return $this
				->useAnswerQuery()
					->filterByPrimaryKeys($answer->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByAnswer() only accepts arguments of type Answer or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Answer relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinAnswer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Answer');
		
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
			$this->addJoinObject($join, 'Answer');
		}
		
		return $this;
	}

	/**
	 * Use the Answer relation Answer object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AnswerQuery A secondary query class using the current class as primary query
	 */
	public function useAnswerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAnswer($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Answer', 'AnswerQuery');
	}

	/**
	 * Filter the query by a related GraphModelAxis object
	 *
	 * @param     GraphModelAxis $graphModelAxis  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByGraphModelAxis($graphModelAxis, $comparison = null)
	{
		if ($graphModelAxis instanceof GraphModelAxis) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $graphModelAxis->getQuestionid(), $comparison);
		} elseif ($graphModelAxis instanceof PropelCollection) {
			return $this
				->useGraphModelAxisQuery()
					->filterByPrimaryKeys($graphModelAxis->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphModelAxis() only accepts arguments of type GraphModelAxis or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphModelAxis relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function joinGraphModelAxis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphModelAxis');
		
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
			$this->addJoinObject($join, 'GraphModelAxis');
		}
		
		return $this;
	}

	/**
	 * Use the GraphModelAxis relation GraphModelAxis object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelAxisQuery A secondary query class using the current class as primary query
	 */
	public function useGraphModelAxisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphModelAxis($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphModelAxis', 'GraphModelAxisQuery');
	}

	/**
	 * Filter the query by a related GraphRelationQuestion object
	 *
	 * @param     GraphRelationQuestion $graphRelationQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function filterByGraphRelationQuestion($graphRelationQuestion, $comparison = null)
	{
		if ($graphRelationQuestion instanceof GraphRelationQuestion) {
			return $this
				->addUsingAlias(QuestionPeer::ID, $graphRelationQuestion->getQuestionid(), $comparison);
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
	 * @return    QuestionQuery The current query, for fluid interface
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
	 * @param     Question $question Object to remove from the list of results
	 *
	 * @return    QuestionQuery The current query, for fluid interface
	 */
	public function prune($question = null)
	{
		if ($question) {
			$this->addUsingAlias(QuestionPeer::ID, $question->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseQuestionQuery
