<?php


/**
 * Base class that represents a query for the 'services_scheduleSubscriptionUser' table.
 *
 * Relacion ScheduleSubscription - User
 *
 * @method ScheduleSubscriptionUserQuery orderBySchedulesubscriptionid($order = Criteria::ASC) Order by the scheduleSubscriptionId column
 * @method ScheduleSubscriptionUserQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 *
 * @method ScheduleSubscriptionUserQuery groupBySchedulesubscriptionid() Group by the scheduleSubscriptionId column
 * @method ScheduleSubscriptionUserQuery groupByUserid() Group by the userId column
 *
 * @method ScheduleSubscriptionUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ScheduleSubscriptionUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ScheduleSubscriptionUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ScheduleSubscriptionUserQuery leftJoinScheduleSubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScheduleSubscription relation
 * @method ScheduleSubscriptionUserQuery rightJoinScheduleSubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScheduleSubscription relation
 * @method ScheduleSubscriptionUserQuery innerJoinScheduleSubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the ScheduleSubscription relation
 *
 * @method ScheduleSubscriptionUserQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method ScheduleSubscriptionUserQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method ScheduleSubscriptionUserQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method ScheduleSubscriptionUser findOne(PropelPDO $con = null) Return the first ScheduleSubscriptionUser matching the query
 * @method ScheduleSubscriptionUser findOneOrCreate(PropelPDO $con = null) Return the first ScheduleSubscriptionUser matching the query, or a new ScheduleSubscriptionUser object populated from the query conditions when no match is found
 *
 * @method ScheduleSubscriptionUser findOneBySchedulesubscriptionid(int $scheduleSubscriptionId) Return the first ScheduleSubscriptionUser filtered by the scheduleSubscriptionId column
 * @method ScheduleSubscriptionUser findOneByUserid(int $userId) Return the first ScheduleSubscriptionUser filtered by the userId column
 *
 * @method array findBySchedulesubscriptionid(int $scheduleSubscriptionId) Return ScheduleSubscriptionUser objects filtered by the scheduleSubscriptionId column
 * @method array findByUserid(int $userId) Return ScheduleSubscriptionUser objects filtered by the userId column
 *
 * @package    propel.generator.services.classes.om
 */
abstract class BaseScheduleSubscriptionUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseScheduleSubscriptionUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'ScheduleSubscriptionUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ScheduleSubscriptionUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ScheduleSubscriptionUserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ScheduleSubscriptionUserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ScheduleSubscriptionUserQuery) {
            return $criteria;
        }
        $query = new ScheduleSubscriptionUserQuery();
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
                         A Primary key composition: [$scheduleSubscriptionId, $userId]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ScheduleSubscriptionUser|ScheduleSubscriptionUser[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ScheduleSubscriptionUserPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   ScheduleSubscriptionUser A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `SCHEDULESUBSCRIPTIONID`, `USERID` FROM `services_scheduleSubscriptionUser` WHERE `SCHEDULESUBSCRIPTIONID` = :p0 AND `USERID` = :p1';
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
            $obj = new ScheduleSubscriptionUser();
            $obj->hydrate($row);
            ScheduleSubscriptionUserPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ScheduleSubscriptionUser|ScheduleSubscriptionUser[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ScheduleSubscriptionUser[]|mixed the list of results, formatted by the current formatter
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
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ScheduleSubscriptionUserPeer::USERID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ScheduleSubscriptionUserPeer::USERID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the scheduleSubscriptionId column
     *
     * Example usage:
     * <code>
     * $query->filterBySchedulesubscriptionid(1234); // WHERE scheduleSubscriptionId = 1234
     * $query->filterBySchedulesubscriptionid(array(12, 34)); // WHERE scheduleSubscriptionId IN (12, 34)
     * $query->filterBySchedulesubscriptionid(array('min' => 12)); // WHERE scheduleSubscriptionId > 12
     * </code>
     *
     * @see       filterByScheduleSubscription()
     *
     * @param     mixed $schedulesubscriptionid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
     */
    public function filterBySchedulesubscriptionid($schedulesubscriptionid = null, $comparison = null)
    {
        if (is_array($schedulesubscriptionid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID, $schedulesubscriptionid, $comparison);
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
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ScheduleSubscriptionUserPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query by a related ScheduleSubscription object
     *
     * @param   ScheduleSubscription|PropelObjectCollection $scheduleSubscription The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ScheduleSubscriptionUserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByScheduleSubscription($scheduleSubscription, $comparison = null)
    {
        if ($scheduleSubscription instanceof ScheduleSubscription) {
            return $this
                ->addUsingAlias(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID, $scheduleSubscription->getId(), $comparison);
        } elseif ($scheduleSubscription instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID, $scheduleSubscription->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByScheduleSubscription() only accepts arguments of type ScheduleSubscription or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScheduleSubscription relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
     */
    public function joinScheduleSubscription($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScheduleSubscription');

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
            $this->addJoinObject($join, 'ScheduleSubscription');
        }

        return $this;
    }

    /**
     * Use the ScheduleSubscription relation ScheduleSubscription object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ScheduleSubscriptionQuery A secondary query class using the current class as primary query
     */
    public function useScheduleSubscriptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinScheduleSubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScheduleSubscription', 'ScheduleSubscriptionQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ScheduleSubscriptionUserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(ScheduleSubscriptionUserPeer::USERID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ScheduleSubscriptionUserPeer::USERID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
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
        if ($relationAlias) {
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
     * @return   UserQuery A secondary query class using the current class as primary query
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
     * @param   ScheduleSubscriptionUser $scheduleSubscriptionUser Object to remove from the list of results
     *
     * @return ScheduleSubscriptionUserQuery The current query, for fluid interface
     */
    public function prune($scheduleSubscriptionUser = null)
    {
        if ($scheduleSubscriptionUser) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID), $scheduleSubscriptionUser->getSchedulesubscriptionid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ScheduleSubscriptionUserPeer::USERID), $scheduleSubscriptionUser->getUserid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
