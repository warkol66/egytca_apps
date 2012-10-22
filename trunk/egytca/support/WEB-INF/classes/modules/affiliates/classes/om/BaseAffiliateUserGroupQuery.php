<?php


/**
 * Base class that represents a query for the 'affiliates_userGroup' table.
 *
 * Users / Groups
 *
 * @method AffiliateUserGroupQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method AffiliateUserGroupQuery orderByGroupid($order = Criteria::ASC) Order by the groupId column
 *
 * @method AffiliateUserGroupQuery groupByUserid() Group by the userId column
 * @method AffiliateUserGroupQuery groupByGroupid() Group by the groupId column
 *
 * @method AffiliateUserGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AffiliateUserGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AffiliateUserGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AffiliateUserGroupQuery leftJoinAffiliateUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateUser relation
 * @method AffiliateUserGroupQuery rightJoinAffiliateUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateUser relation
 * @method AffiliateUserGroupQuery innerJoinAffiliateUser($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateUser relation
 *
 * @method AffiliateUserGroupQuery leftJoinAffiliateGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateGroup relation
 * @method AffiliateUserGroupQuery rightJoinAffiliateGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateGroup relation
 * @method AffiliateUserGroupQuery innerJoinAffiliateGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateGroup relation
 *
 * @method AffiliateUserGroup findOne(PropelPDO $con = null) Return the first AffiliateUserGroup matching the query
 * @method AffiliateUserGroup findOneOrCreate(PropelPDO $con = null) Return the first AffiliateUserGroup matching the query, or a new AffiliateUserGroup object populated from the query conditions when no match is found
 *
 * @method AffiliateUserGroup findOneByUserid(int $userId) Return the first AffiliateUserGroup filtered by the userId column
 * @method AffiliateUserGroup findOneByGroupid(int $groupId) Return the first AffiliateUserGroup filtered by the groupId column
 *
 * @method array findByUserid(int $userId) Return AffiliateUserGroup objects filtered by the userId column
 * @method array findByGroupid(int $groupId) Return AffiliateUserGroup objects filtered by the groupId column
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateUserGroupQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAffiliateUserGroupQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'AffiliateUserGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AffiliateUserGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AffiliateUserGroupQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AffiliateUserGroupQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AffiliateUserGroupQuery) {
            return $criteria;
        }
        $query = new AffiliateUserGroupQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$userId, $groupId]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   AffiliateUserGroup|AffiliateUserGroup[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AffiliateUserGroupPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AffiliateUserGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   AffiliateUserGroup A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `USERID`, `GROUPID` FROM `affiliates_userGroup` WHERE `USERID` = :p0 AND `GROUPID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new AffiliateUserGroup();
            $obj->hydrate($row);
            AffiliateUserGroupPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return AffiliateUserGroup|AffiliateUserGroup[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|AffiliateUserGroup[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(AffiliateUserGroupPeer::USERID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(AffiliateUserGroupPeer::GROUPID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(AffiliateUserGroupPeer::USERID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(AffiliateUserGroupPeer::GROUPID, $key[1], Criteria::EQUAL);
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
     * @see       filterByAffiliateUser()
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AffiliateUserGroupPeer::USERID, $userid, $comparison);
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
     * @see       filterByAffiliateGroup()
     *
     * @param     mixed $groupid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function filterByGroupid($groupid = null, $comparison = null)
    {
        if (is_array($groupid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AffiliateUserGroupPeer::GROUPID, $groupid, $comparison);
    }

    /**
     * Filter the query by a related AffiliateUser object
     *
     * @param   AffiliateUser|PropelObjectCollection $affiliateUser The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateUserGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateUser($affiliateUser, $comparison = null)
    {
        if ($affiliateUser instanceof AffiliateUser) {
            return $this
                ->addUsingAlias(AffiliateUserGroupPeer::USERID, $affiliateUser->getId(), $comparison);
        } elseif ($affiliateUser instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AffiliateUserGroupPeer::USERID, $affiliateUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAffiliateUser() only accepts arguments of type AffiliateUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AffiliateUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function joinAffiliateUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AffiliateUser');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AffiliateUser');
        }

        return $this;
    }

    /**
     * Use the AffiliateUser relation AffiliateUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateUserQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAffiliateUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateUser', 'AffiliateUserQuery');
    }

    /**
     * Filter the query by a related AffiliateGroup object
     *
     * @param   AffiliateGroup|PropelObjectCollection $affiliateGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateUserGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateGroup($affiliateGroup, $comparison = null)
    {
        if ($affiliateGroup instanceof AffiliateGroup) {
            return $this
                ->addUsingAlias(AffiliateUserGroupPeer::GROUPID, $affiliateGroup->getId(), $comparison);
        } elseif ($affiliateGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AffiliateUserGroupPeer::GROUPID, $affiliateGroup->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAffiliateGroup() only accepts arguments of type AffiliateGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AffiliateGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function joinAffiliateGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AffiliateGroup');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AffiliateGroup');
        }

        return $this;
    }

    /**
     * Use the AffiliateGroup relation AffiliateGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateGroupQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAffiliateGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateGroup', 'AffiliateGroupQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   AffiliateUserGroup $affiliateUserGroup Object to remove from the list of results
     *
     * @return AffiliateUserGroupQuery The current query, for fluid interface
     */
    public function prune($affiliateUserGroup = null)
    {
        if ($affiliateUserGroup) {
            $this->addCond('pruneCond0', $this->getAliasedColName(AffiliateUserGroupPeer::USERID), $affiliateUserGroup->getUserid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(AffiliateUserGroupPeer::GROUPID), $affiliateUserGroup->getGroupid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
