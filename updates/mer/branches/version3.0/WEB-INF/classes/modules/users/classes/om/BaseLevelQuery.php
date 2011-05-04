<?php


/**
 * Base class that represents a query for the 'users_level' table.
 *
 * Levels
 *
 * @method     LevelQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     LevelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     LevelQuery orderByBitlevel($order = Criteria::ASC) Order by the bitLevel column
 *
 * @method     LevelQuery groupById() Group by the id column
 * @method     LevelQuery groupByName() Group by the name column
 * @method     LevelQuery groupByBitlevel() Group by the bitLevel column
 *
 * @method     LevelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     LevelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     LevelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     LevelQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     LevelQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     LevelQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     Level findOne(PropelPDO $con = null) Return the first Level matching the query
 * @method     Level findOneOrCreate(PropelPDO $con = null) Return the first Level matching the query, or a new Level object populated from the query conditions when no match is found
 *
 * @method     Level findOneById(int $id) Return the first Level filtered by the id column
 * @method     Level findOneByName(string $name) Return the first Level filtered by the name column
 * @method     Level findOneByBitlevel(int $bitLevel) Return the first Level filtered by the bitLevel column
 *
 * @method     array findById(int $id) Return Level objects filtered by the id column
 * @method     array findByName(string $name) Return Level objects filtered by the name column
 * @method     array findByBitlevel(int $bitLevel) Return Level objects filtered by the bitLevel column
 *
 * @package    propel.generator.users.classes.om
 */
abstract class BaseLevelQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseLevelQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Level', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new LevelQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    LevelQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof LevelQuery) {
			return $criteria;
		}
		$query = new LevelQuery();
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
	 * @return    Level|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = LevelPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(LevelPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(LevelPeer::ID, $keys, Criteria::IN);
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
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(LevelPeer::ID, $id, $comparison);
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
	 * @return    LevelQuery The current query, for fluid interface
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
		return $this->addUsingAlias(LevelPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the bitLevel column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByBitlevel(1234); // WHERE bitLevel = 1234
	 * $query->filterByBitlevel(array(12, 34)); // WHERE bitLevel IN (12, 34)
	 * $query->filterByBitlevel(array('min' => 12)); // WHERE bitLevel > 12
	 * </code>
	 *
	 * @param     mixed $bitlevel The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function filterByBitlevel($bitlevel = null, $comparison = null)
	{
		if (is_array($bitlevel)) {
			$useMinMax = false;
			if (isset($bitlevel['min'])) {
				$this->addUsingAlias(LevelPeer::BITLEVEL, $bitlevel['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bitlevel['max'])) {
				$this->addUsingAlias(LevelPeer::BITLEVEL, $bitlevel['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(LevelPeer::BITLEVEL, $bitlevel, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User $user  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(LevelPeer::ID, $user->getLevelid(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			return $this
				->useUserQuery()
					->filterByPrimaryKeys($user->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the User relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('User');
		
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
			$this->addJoinObject($join, 'User');
		}
		
		return $this;
	}

	/**
	 * Use the User relation User object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery A secondary query class using the current class as primary query
	 */
	public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Level $level Object to remove from the list of results
	 *
	 * @return    LevelQuery The current query, for fluid interface
	 */
	public function prune($level = null)
	{
		if ($level) {
			$this->addUsingAlias(LevelPeer::ID, $level->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseLevelQuery
