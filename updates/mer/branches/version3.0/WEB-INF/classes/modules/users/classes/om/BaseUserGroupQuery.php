<?php


/**
 * Base class that represents a query for the 'users_userGroup' table.
 *
 * Users / Groups
 *
 * @method     UserGroupQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method     UserGroupQuery orderByGroupid($order = Criteria::ASC) Order by the groupId column
 *
 * @method     UserGroupQuery groupByUserid() Group by the userId column
 * @method     UserGroupQuery groupByGroupid() Group by the groupId column
 *
 * @method     UserGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserGroupQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     UserGroupQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     UserGroupQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     UserGroupQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     UserGroupQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     UserGroupQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     UserGroup findOne(PropelPDO $con = null) Return the first UserGroup matching the query
 * @method     UserGroup findOneOrCreate(PropelPDO $con = null) Return the first UserGroup matching the query, or a new UserGroup object populated from the query conditions when no match is found
 *
 * @method     UserGroup findOneByUserid(int $userId) Return the first UserGroup filtered by the userId column
 * @method     UserGroup findOneByGroupid(int $groupId) Return the first UserGroup filtered by the groupId column
 *
 * @method     array findByUserid(int $userId) Return UserGroup objects filtered by the userId column
 * @method     array findByGroupid(int $groupId) Return UserGroup objects filtered by the groupId column
 *
 * @package    propel.generator.users.classes.om
 */
abstract class BaseUserGroupQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseUserGroupQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'UserGroup', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserGroupQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserGroupQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserGroupQuery) {
			return $criteria;
		}
		$query = new UserGroupQuery();
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
	 * @param     array[$userId, $groupId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    UserGroup|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = UserGroupPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(UserGroupPeer::USERID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(UserGroupPeer::GROUPID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(UserGroupPeer::USERID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(UserGroupPeer::GROUPID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
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
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function filterByUserid($userid = null, $comparison = null)
	{
		if (is_array($userid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserGroupPeer::USERID, $userid, $comparison);
	}

	/**
	 * Filter the query on the groupId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByGroupid(1234); // WHERE groupId = 1234
	 * $query->filterByGroupid(array(12, 34)); // WHERE groupId IN (12, 34)
	 * $query->filterByGroupid(array('min' => 12)); // WHERE groupId > 12
	 * </code>
	 *
	 * @see       filterByGroup()
	 *
	 * @param     mixed $groupid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function filterByGroupid($groupid = null, $comparison = null)
	{
		if (is_array($groupid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserGroupPeer::GROUPID, $groupid, $comparison);
	}

	/**
	 * Filter the query by a related User object
	 *
	 * @param     User|PropelCollection $user The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function filterByUser($user, $comparison = null)
	{
		if ($user instanceof User) {
			return $this
				->addUsingAlias(UserGroupPeer::USERID, $user->getId(), $comparison);
		} elseif ($user instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(UserGroupPeer::USERID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    UserGroupQuery The current query, for fluid interface
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
	 * Filter the query by a related Group object
	 *
	 * @param     Group|PropelCollection $group The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function filterByGroup($group, $comparison = null)
	{
		if ($group instanceof Group) {
			return $this
				->addUsingAlias(UserGroupPeer::GROUPID, $group->getId(), $comparison);
		} elseif ($group instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(UserGroupPeer::GROUPID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByGroup() only accepts arguments of type Group or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Group relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function joinGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Group');
		
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
			$this->addJoinObject($join, 'Group');
		}
		
		return $this;
	}

	/**
	 * Use the Group relation Group object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GroupQuery A secondary query class using the current class as primary query
	 */
	public function useGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGroup($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Group', 'GroupQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     UserGroup $userGroup Object to remove from the list of results
	 *
	 * @return    UserGroupQuery The current query, for fluid interface
	 */
	public function prune($userGroup = null)
	{
		if ($userGroup) {
			$this->addCond('pruneCond0', $this->getAliasedColName(UserGroupPeer::USERID), $userGroup->getUserid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(UserGroupPeer::GROUPID), $userGroup->getGroupid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseUserGroupQuery
