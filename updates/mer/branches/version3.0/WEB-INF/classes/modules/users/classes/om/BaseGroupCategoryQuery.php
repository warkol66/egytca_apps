<?php


/**
 * Base class that represents a query for the 'users_groupCategory' table.
 *
 * Groups / Categories
 *
 * @method     GroupCategoryQuery orderByGroupid($order = Criteria::ASC) Order by the groupId column
 * @method     GroupCategoryQuery orderByCategoryid($order = Criteria::ASC) Order by the categoryId column
 *
 * @method     GroupCategoryQuery groupByGroupid() Group by the groupId column
 * @method     GroupCategoryQuery groupByCategoryid() Group by the categoryId column
 *
 * @method     GroupCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     GroupCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     GroupCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     GroupCategoryQuery leftJoinGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the Group relation
 * @method     GroupCategoryQuery rightJoinGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Group relation
 * @method     GroupCategoryQuery innerJoinGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the Group relation
 *
 * @method     GroupCategoryQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     GroupCategoryQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     GroupCategoryQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     GroupCategory findOne(PropelPDO $con = null) Return the first GroupCategory matching the query
 * @method     GroupCategory findOneOrCreate(PropelPDO $con = null) Return the first GroupCategory matching the query, or a new GroupCategory object populated from the query conditions when no match is found
 *
 * @method     GroupCategory findOneByGroupid(int $groupId) Return the first GroupCategory filtered by the groupId column
 * @method     GroupCategory findOneByCategoryid(int $categoryId) Return the first GroupCategory filtered by the categoryId column
 *
 * @method     array findByGroupid(int $groupId) Return GroupCategory objects filtered by the groupId column
 * @method     array findByCategoryid(int $categoryId) Return GroupCategory objects filtered by the categoryId column
 *
 * @package    propel.generator.users.classes.om
 */
abstract class BaseGroupCategoryQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseGroupCategoryQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'GroupCategory', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new GroupCategoryQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    GroupCategoryQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof GroupCategoryQuery) {
			return $criteria;
		}
		$query = new GroupCategoryQuery();
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
	 * @param     array[$groupId, $categoryId] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    GroupCategory|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = GroupCategoryPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(GroupCategoryPeer::GROUPID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(GroupCategoryPeer::CATEGORYID, $key[1], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(GroupCategoryPeer::GROUPID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(GroupCategoryPeer::CATEGORYID, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$this->addOr($cton0);
		}
		
		return $this;
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
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function filterByGroupid($groupid = null, $comparison = null)
	{
		if (is_array($groupid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GroupCategoryPeer::GROUPID, $groupid, $comparison);
	}

	/**
	 * Filter the query on the categoryId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCategoryid(1234); // WHERE categoryId = 1234
	 * $query->filterByCategoryid(array(12, 34)); // WHERE categoryId IN (12, 34)
	 * $query->filterByCategoryid(array('min' => 12)); // WHERE categoryId > 12
	 * </code>
	 *
	 * @see       filterByCategory()
	 *
	 * @param     mixed $categoryid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function filterByCategoryid($categoryid = null, $comparison = null)
	{
		if (is_array($categoryid) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GroupCategoryPeer::CATEGORYID, $categoryid, $comparison);
	}

	/**
	 * Filter the query by a related Group object
	 *
	 * @param     Group|PropelCollection $group The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function filterByGroup($group, $comparison = null)
	{
		if ($group instanceof Group) {
			return $this
				->addUsingAlias(GroupCategoryPeer::GROUPID, $group->getId(), $comparison);
		} elseif ($group instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GroupCategoryPeer::GROUPID, $group->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    GroupCategoryQuery The current query, for fluid interface
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
	 * Filter the query by a related Category object
	 *
	 * @param     Category|PropelCollection $category The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function filterByCategory($category, $comparison = null)
	{
		if ($category instanceof Category) {
			return $this
				->addUsingAlias(GroupCategoryPeer::CATEGORYID, $category->getId(), $comparison);
		} elseif ($category instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(GroupCategoryPeer::CATEGORYID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Category relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Category');
		
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
			$this->addJoinObject($join, 'Category');
		}
		
		return $this;
	}

	/**
	 * Use the Category relation Category object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery A secondary query class using the current class as primary query
	 */
	public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Category', 'CategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     GroupCategory $groupCategory Object to remove from the list of results
	 *
	 * @return    GroupCategoryQuery The current query, for fluid interface
	 */
	public function prune($groupCategory = null)
	{
		if ($groupCategory) {
			$this->addCond('pruneCond0', $this->getAliasedColName(GroupCategoryPeer::GROUPID), $groupCategory->getGroupid(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(GroupCategoryPeer::CATEGORYID), $groupCategory->getCategoryid(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseGroupCategoryQuery
