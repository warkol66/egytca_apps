<?php


/**
 * Base class that represents a query for the 'MER_formSection' table.
 *
 * 
 *
 * @method     FormSectionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     FormSectionQuery orderByParentsectionid($order = Criteria::ASC) Order by the parentSectionId column
 * @method     FormSectionQuery orderByPosition($order = Criteria::ASC) Order by the position column
 * @method     FormSectionQuery orderByTitle($order = Criteria::ASC) Order by the title column
 *
 * @method     FormSectionQuery groupById() Group by the id column
 * @method     FormSectionQuery groupByParentsectionid() Group by the parentSectionId column
 * @method     FormSectionQuery groupByPosition() Group by the position column
 * @method     FormSectionQuery groupByTitle() Group by the title column
 *
 * @method     FormSectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     FormSectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     FormSectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     FormSectionQuery leftJoinFormSectionRelatedByParentsectionid($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormSectionRelatedByParentsectionid relation
 * @method     FormSectionQuery rightJoinFormSectionRelatedByParentsectionid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormSectionRelatedByParentsectionid relation
 * @method     FormSectionQuery innerJoinFormSectionRelatedByParentsectionid($relationAlias = null) Adds a INNER JOIN clause to the query using the FormSectionRelatedByParentsectionid relation
 *
 * @method     FormSectionQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     FormSectionQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     FormSectionQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     FormSectionQuery leftJoinFormSectionRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormSectionRelatedById relation
 * @method     FormSectionQuery rightJoinFormSectionRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormSectionRelatedById relation
 * @method     FormSectionQuery innerJoinFormSectionRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the FormSectionRelatedById relation
 *
 * @method     FormSectionQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     FormSectionQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     FormSectionQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     FormSection findOne(PropelPDO $con = null) Return the first FormSection matching the query
 * @method     FormSection findOneOrCreate(PropelPDO $con = null) Return the first FormSection matching the query, or a new FormSection object populated from the query conditions when no match is found
 *
 * @method     FormSection findOneById(int $id) Return the first FormSection filtered by the id column
 * @method     FormSection findOneByParentsectionid(int $parentSectionId) Return the first FormSection filtered by the parentSectionId column
 * @method     FormSection findOneByPosition(int $position) Return the first FormSection filtered by the position column
 * @method     FormSection findOneByTitle(string $title) Return the first FormSection filtered by the title column
 *
 * @method     array findById(int $id) Return FormSection objects filtered by the id column
 * @method     array findByParentsectionid(int $parentSectionId) Return FormSection objects filtered by the parentSectionId column
 * @method     array findByPosition(int $position) Return FormSection objects filtered by the position column
 * @method     array findByTitle(string $title) Return FormSection objects filtered by the title column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseFormSectionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseFormSectionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'FormSection', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new FormSectionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FormSectionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FormSectionQuery) {
			return $criteria;
		}
		$query = new FormSectionQuery();
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
	 * @return    FormSection|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = FormSectionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(FormSectionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(FormSectionPeer::ID, $keys, Criteria::IN);
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
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(FormSectionPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the parentSectionId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByParentsectionid(1234); // WHERE parentSectionId = 1234
	 * $query->filterByParentsectionid(array(12, 34)); // WHERE parentSectionId IN (12, 34)
	 * $query->filterByParentsectionid(array('min' => 12)); // WHERE parentSectionId > 12
	 * </code>
	 *
	 * @see       filterByFormSectionRelatedByParentsectionid()
	 *
	 * @param     mixed $parentsectionid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByParentsectionid($parentsectionid = null, $comparison = null)
	{
		if (is_array($parentsectionid)) {
			$useMinMax = false;
			if (isset($parentsectionid['min'])) {
				$this->addUsingAlias(FormSectionPeer::PARENTSECTIONID, $parentsectionid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($parentsectionid['max'])) {
				$this->addUsingAlias(FormSectionPeer::PARENTSECTIONID, $parentsectionid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FormSectionPeer::PARENTSECTIONID, $parentsectionid, $comparison);
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
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByPosition($position = null, $comparison = null)
	{
		if (is_array($position)) {
			$useMinMax = false;
			if (isset($position['min'])) {
				$this->addUsingAlias(FormSectionPeer::POSITION, $position['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($position['max'])) {
				$this->addUsingAlias(FormSectionPeer::POSITION, $position['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FormSectionPeer::POSITION, $position, $comparison);
	}

	/**
	 * Filter the query on the title column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(FormSectionPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query by a related FormSection object
	 *
	 * @param     FormSection|PropelCollection $formSection The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByFormSectionRelatedByParentsectionid($formSection, $comparison = null)
	{
		if ($formSection instanceof FormSection) {
			return $this
				->addUsingAlias(FormSectionPeer::PARENTSECTIONID, $formSection->getId(), $comparison);
		} elseif ($formSection instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FormSectionPeer::PARENTSECTIONID, $formSection->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByFormSectionRelatedByParentsectionid() only accepts arguments of type FormSection or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FormSectionRelatedByParentsectionid relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function joinFormSectionRelatedByParentsectionid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FormSectionRelatedByParentsectionid');
		
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
			$this->addJoinObject($join, 'FormSectionRelatedByParentsectionid');
		}
		
		return $this;
	}

	/**
	 * Use the FormSectionRelatedByParentsectionid relation FormSection object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormSectionQuery A secondary query class using the current class as primary query
	 */
	public function useFormSectionRelatedByParentsectionidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinFormSectionRelatedByParentsectionid($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FormSectionRelatedByParentsectionid', 'FormSectionQuery');
	}

	/**
	 * Filter the query by a related Form object
	 *
	 * @param     Form $form  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByForm($form, $comparison = null)
	{
		if ($form instanceof Form) {
			return $this
				->addUsingAlias(FormSectionPeer::ID, $form->getRootsectionid(), $comparison);
		} elseif ($form instanceof PropelCollection) {
			return $this
				->useFormQuery()
					->filterByPrimaryKeys($form->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByForm() only accepts arguments of type Form or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Form relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function joinForm($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Form');
		
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
			$this->addJoinObject($join, 'Form');
		}
		
		return $this;
	}

	/**
	 * Use the Form relation Form object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormQuery A secondary query class using the current class as primary query
	 */
	public function useFormQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinForm($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Form', 'FormQuery');
	}

	/**
	 * Filter the query by a related FormSection object
	 *
	 * @param     FormSection $formSection  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByFormSectionRelatedById($formSection, $comparison = null)
	{
		if ($formSection instanceof FormSection) {
			return $this
				->addUsingAlias(FormSectionPeer::ID, $formSection->getParentsectionid(), $comparison);
		} elseif ($formSection instanceof PropelCollection) {
			return $this
				->useFormSectionRelatedByIdQuery()
					->filterByPrimaryKeys($formSection->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByFormSectionRelatedById() only accepts arguments of type FormSection or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the FormSectionRelatedById relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function joinFormSectionRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('FormSectionRelatedById');
		
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
			$this->addJoinObject($join, 'FormSectionRelatedById');
		}
		
		return $this;
	}

	/**
	 * Use the FormSectionRelatedById relation FormSection object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    FormSectionQuery A secondary query class using the current class as primary query
	 */
	public function useFormSectionRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinFormSectionRelatedById($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FormSectionRelatedById', 'FormSectionQuery');
	}

	/**
	 * Filter the query by a related Question object
	 *
	 * @param     Question $question  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function filterByQuestion($question, $comparison = null)
	{
		if ($question instanceof Question) {
			return $this
				->addUsingAlias(FormSectionPeer::ID, $question->getSectionid(), $comparison);
		} elseif ($question instanceof PropelCollection) {
			return $this
				->useQuestionQuery()
					->filterByPrimaryKeys($question->getPrimaryKeys())
				->endUse();
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
	 * @return    FormSectionQuery The current query, for fluid interface
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
	 * @param     FormSection $formSection Object to remove from the list of results
	 *
	 * @return    FormSectionQuery The current query, for fluid interface
	 */
	public function prune($formSection = null)
	{
		if ($formSection) {
			$this->addUsingAlias(FormSectionPeer::ID, $formSection->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseFormSectionQuery
