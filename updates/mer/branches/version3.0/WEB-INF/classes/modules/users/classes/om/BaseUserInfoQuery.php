<?php


/**
 * Base class that represents a query for the 'users_userInfo' table.
 *
 * Information about users
 *
 * @method     UserInfoQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method     UserInfoQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     UserInfoQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 *
 * @method     UserInfoQuery groupByUserid() Group by the userId column
 * @method     UserInfoQuery groupByName() Group by the name column
 * @method     UserInfoQuery groupBySurname() Group by the surname column
 *
 * @method     UserInfoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserInfoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserInfoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserInfoQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     UserInfoQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     UserInfoQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     UserInfo findOne(PropelPDO $con = null) Return the first UserInfo matching the query
 * @method     UserInfo findOneOrCreate(PropelPDO $con = null) Return the first UserInfo matching the query, or a new UserInfo object populated from the query conditions when no match is found
 *
 * @method     UserInfo findOneByUserid(int $userId) Return the first UserInfo filtered by the userId column
 * @method     UserInfo findOneByName(string $name) Return the first UserInfo filtered by the name column
 * @method     UserInfo findOneBySurname(string $surname) Return the first UserInfo filtered by the surname column
 *
 * @method     array findByUserid(int $userId) Return UserInfo objects filtered by the userId column
 * @method     array findByName(string $name) Return UserInfo objects filtered by the name column
 * @method     array findBySurname(string $surname) Return UserInfo objects filtered by the surname column
 *
 * @package    propel.generator.users.classes.om
 */
abstract class BaseUserInfoQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseUserInfoQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'UserInfo', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserInfoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserInfoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserInfoQuery) {
			return $criteria;
		}
		$query = new UserInfoQuery();
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
	 * @return    UserInfo|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = UserInfoPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(UserInfoPeer::USERID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(UserInfoPeer::USERID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the userId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUserid(1234); // WHERE userId = 1234
	 * $query->filterByUserid(array(12, 34)); // WHERE userId IN (12, 34)
	 * $query->filterByUserid(array('min' => 12)); // WHERE userId > 12
	 * </code>
	 *
	 * @see       filterByUser()
	 *
	 * @param     mixed $userid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function filterByUserid($userid = null, $comparison = null)
	{
		if (is_array($userid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserInfoPeer::USERID, $userid, $comparison);
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
	 * @return    UserInfoQuery The current query, for fluid interface
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
		return $this->addUsingAlias(UserInfoPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the surname column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
	 * $query->filterBySurname('%fooValue%'); // WHERE surname LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $surname The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function filterBySurname($surname = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($surname)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $surname)) {
				$surname = str_replace('*', '%', $surname);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserInfoPeer::SURNAME, $surname, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(UserInfoPeer::USERID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(UserInfoPeer::USERID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinUser($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     UserInfo $userInfo Object to remove from the list of results
	 *
	 * @return    UserInfoQuery The current query, for fluid interface
	 */
	public function prune($userInfo = null)
	{
		if ($userInfo) {
			$this->addUsingAlias(UserInfoPeer::USERID, $userInfo->getUserid(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseUserInfoQuery
