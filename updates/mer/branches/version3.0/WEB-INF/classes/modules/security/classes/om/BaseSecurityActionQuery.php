<?php


/**
 * Base class that represents a query for the 'SecurityAction' table.
 *
 * Actions del sistema
 *
 * @method     SecurityActionQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     SecurityActionQuery orderByModule($order = Criteria::ASC) Order by the module column
 * @method     SecurityActionQuery orderBySection($order = Criteria::ASC) Order by the section column
 * @method     SecurityActionQuery orderByAccess($order = Criteria::ASC) Order by the access column
 * @method     SecurityActionQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method     SecurityActionQuery groupByAction() Group by the action column
 * @method     SecurityActionQuery groupByModule() Group by the module column
 * @method     SecurityActionQuery groupBySection() Group by the section column
 * @method     SecurityActionQuery groupByAccess() Group by the access column
 * @method     SecurityActionQuery groupByActive() Group by the active column
 *
 * @method     SecurityActionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SecurityActionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SecurityActionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SecurityAction findOne(PropelPDO $con = null) Return the first SecurityAction matching the query
 * @method     SecurityAction findOneOrCreate(PropelPDO $con = null) Return the first SecurityAction matching the query, or a new SecurityAction object populated from the query conditions when no match is found
 *
 * @method     SecurityAction findOneByAction(string $action) Return the first SecurityAction filtered by the action column
 * @method     SecurityAction findOneByModule(string $module) Return the first SecurityAction filtered by the module column
 * @method     SecurityAction findOneBySection(string $section) Return the first SecurityAction filtered by the section column
 * @method     SecurityAction findOneByAccess(int $access) Return the first SecurityAction filtered by the access column
 * @method     SecurityAction findOneByActive(int $active) Return the first SecurityAction filtered by the active column
 *
 * @method     array findByAction(string $action) Return SecurityAction objects filtered by the action column
 * @method     array findByModule(string $module) Return SecurityAction objects filtered by the module column
 * @method     array findBySection(string $section) Return SecurityAction objects filtered by the section column
 * @method     array findByAccess(int $access) Return SecurityAction objects filtered by the access column
 * @method     array findByActive(int $active) Return SecurityAction objects filtered by the active column
 *
 * @package    propel.generator.security.classes.om
 */
abstract class BaseSecurityActionQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseSecurityActionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'SecurityAction', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SecurityActionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SecurityActionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SecurityActionQuery) {
			return $criteria;
		}
		$query = new SecurityActionQuery();
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
	 * @return    SecurityAction|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = SecurityActionPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SecurityActionPeer::ACTION, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SecurityActionPeer::ACTION, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the action column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
	 * $query->filterByAction('%fooValue%'); // WHERE action LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $action The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterByAction($action = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($action)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $action)) {
				$action = str_replace('*', '%', $action);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SecurityActionPeer::ACTION, $action, $comparison);
	}

	/**
	 * Filter the query on the module column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByModule('fooValue');   // WHERE module = 'fooValue'
	 * $query->filterByModule('%fooValue%'); // WHERE module LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $module The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterByModule($module = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($module)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $module)) {
				$module = str_replace('*', '%', $module);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SecurityActionPeer::MODULE, $module, $comparison);
	}

	/**
	 * Filter the query on the section column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySection('fooValue');   // WHERE section = 'fooValue'
	 * $query->filterBySection('%fooValue%'); // WHERE section LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $section The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterBySection($section = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($section)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $section)) {
				$section = str_replace('*', '%', $section);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SecurityActionPeer::SECTION, $section, $comparison);
	}

	/**
	 * Filter the query on the access column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByAccess(1234); // WHERE access = 1234
	 * $query->filterByAccess(array(12, 34)); // WHERE access IN (12, 34)
	 * $query->filterByAccess(array('min' => 12)); // WHERE access > 12
	 * </code>
	 *
	 * @param     mixed $access The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterByAccess($access = null, $comparison = null)
	{
		if (is_array($access)) {
			$useMinMax = false;
			if (isset($access['min'])) {
				$this->addUsingAlias(SecurityActionPeer::ACCESS, $access['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($access['max'])) {
				$this->addUsingAlias(SecurityActionPeer::ACCESS, $access['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SecurityActionPeer::ACCESS, $access, $comparison);
	}

	/**
	 * Filter the query on the active column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByActive(1234); // WHERE active = 1234
	 * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
	 * $query->filterByActive(array('min' => 12)); // WHERE active > 12
	 * </code>
	 *
	 * @param     mixed $active The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_array($active)) {
			$useMinMax = false;
			if (isset($active['min'])) {
				$this->addUsingAlias(SecurityActionPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($active['max'])) {
				$this->addUsingAlias(SecurityActionPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SecurityActionPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SecurityAction $securityAction Object to remove from the list of results
	 *
	 * @return    SecurityActionQuery The current query, for fluid interface
	 */
	public function prune($securityAction = null)
	{
		if ($securityAction) {
			$this->addUsingAlias(SecurityActionPeer::ACTION, $securityAction->getAction(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseSecurityActionQuery
