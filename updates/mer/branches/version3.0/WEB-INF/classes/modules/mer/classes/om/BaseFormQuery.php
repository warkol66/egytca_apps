<?php


/**
 * Base class that represents a query for the 'MER_form' table.
 *
 * 
 *
 * @method     FormQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     FormQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     FormQuery orderByRelationship($order = Criteria::ASC) Order by the relationship column
 * @method     FormQuery orderByRootsectionid($order = Criteria::ASC) Order by the rootSectionId column
 *
 * @method     FormQuery groupById() Group by the id column
 * @method     FormQuery groupByName() Group by the name column
 * @method     FormQuery groupByRelationship() Group by the relationship column
 * @method     FormQuery groupByRootsectionid() Group by the rootSectionId column
 *
 * @method     FormQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     FormQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     FormQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     FormQuery leftJoinFormSection($relationAlias = null) Adds a LEFT JOIN clause to the query using the FormSection relation
 * @method     FormQuery rightJoinFormSection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FormSection relation
 * @method     FormQuery innerJoinFormSection($relationAlias = null) Adds a INNER JOIN clause to the query using the FormSection relation
 *
 * @method     Form findOne(PropelPDO $con = null) Return the first Form matching the query
 * @method     Form findOneOrCreate(PropelPDO $con = null) Return the first Form matching the query, or a new Form object populated from the query conditions when no match is found
 *
 * @method     Form findOneById(int $id) Return the first Form filtered by the id column
 * @method     Form findOneByName(string $name) Return the first Form filtered by the name column
 * @method     Form findOneByRelationship(boolean $relationship) Return the first Form filtered by the relationship column
 * @method     Form findOneByRootsectionid(int $rootSectionId) Return the first Form filtered by the rootSectionId column
 *
 * @method     array findById(int $id) Return Form objects filtered by the id column
 * @method     array findByName(string $name) Return Form objects filtered by the name column
 * @method     array findByRelationship(boolean $relationship) Return Form objects filtered by the relationship column
 * @method     array findByRootsectionid(int $rootSectionId) Return Form objects filtered by the rootSectionId column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseFormQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseFormQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Form', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new FormQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    FormQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof FormQuery) {
			return $criteria;
		}
		$query = new FormQuery();
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
	 * @return    Form|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = FormPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(FormPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(FormPeer::ID, $keys, Criteria::IN);
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
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(FormPeer::ID, $id, $comparison);
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
	 * @return    FormQuery The current query, for fluid interface
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
		return $this->addUsingAlias(FormPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the relationship column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRelationship(true); // WHERE relationship = true
	 * $query->filterByRelationship('yes'); // WHERE relationship = true
	 * </code>
	 *
	 * @param     boolean|string $relationship The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function filterByRelationship($relationship = null, $comparison = null)
	{
		if (is_string($relationship)) {
			$relationship = in_array(strtolower($relationship), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(FormPeer::RELATIONSHIP, $relationship, $comparison);
	}

	/**
	 * Filter the query on the rootSectionId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRootsectionid(1234); // WHERE rootSectionId = 1234
	 * $query->filterByRootsectionid(array(12, 34)); // WHERE rootSectionId IN (12, 34)
	 * $query->filterByRootsectionid(array('min' => 12)); // WHERE rootSectionId > 12
	 * </code>
	 *
	 * @see       filterByFormSection()
	 *
	 * @param     mixed $rootsectionid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function filterByRootsectionid($rootsectionid = null, $comparison = null)
	{
		if (is_array($rootsectionid)) {
			$useMinMax = false;
			if (isset($rootsectionid['min'])) {
				$this->addUsingAlias(FormPeer::ROOTSECTIONID, $rootsectionid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($rootsectionid['max'])) {
				$this->addUsingAlias(FormPeer::ROOTSECTIONID, $rootsectionid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(FormPeer::ROOTSECTIONID, $rootsectionid, $comparison);
	}

	/**
	 * Filter the query by a related FormSection object
	 *
	 * @param     FormSection|PropelCollection $formSection The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function filterByFormSection($formSection, $comparison = null)
	{
		if ($formSection instanceof FormSection) {
			return $this
				->addUsingAlias(FormPeer::ROOTSECTIONID, $formSection->getId(), $comparison);
		} elseif ($formSection instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(FormPeer::ROOTSECTIONID, $formSection->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function joinFormSection($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useFormSectionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinFormSection($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'FormSection', 'FormSectionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Form $form Object to remove from the list of results
	 *
	 * @return    FormQuery The current query, for fluid interface
	 */
	public function prune($form = null)
	{
		if ($form) {
			$this->addUsingAlias(FormPeer::ID, $form->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseFormQuery
