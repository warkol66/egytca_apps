<?php


/**
 * Base class that represents a query for the 'actionLogs_log' table.
 *
 * logs de acciones del sistema
 *
 * @method ActionLogQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ActionLogQuery orderByUserobjecttype($order = Criteria::ASC) Order by the userObjectType column
 * @method ActionLogQuery orderByUserobjectid($order = Criteria::ASC) Order by the userObjectId column
 * @method ActionLogQuery orderByDatetime($order = Criteria::ASC) Order by the datetime column
 * @method ActionLogQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method ActionLogQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method ActionLogQuery orderByForward($order = Criteria::ASC) Order by the forward column
 *
 * @method ActionLogQuery groupById() Group by the id column
 * @method ActionLogQuery groupByUserobjecttype() Group by the userObjectType column
 * @method ActionLogQuery groupByUserobjectid() Group by the userObjectId column
 * @method ActionLogQuery groupByDatetime() Group by the datetime column
 * @method ActionLogQuery groupByAction() Group by the action column
 * @method ActionLogQuery groupByMessage() Group by the message column
 * @method ActionLogQuery groupByForward() Group by the forward column
 *
 * @method ActionLogQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ActionLogQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ActionLogQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ActionLogQuery leftJoinSecurityAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the SecurityAction relation
 * @method ActionLogQuery rightJoinSecurityAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SecurityAction relation
 * @method ActionLogQuery innerJoinSecurityAction($relationAlias = null) Adds a INNER JOIN clause to the query using the SecurityAction relation
 *
 * @method ActionLog findOne(PropelPDO $con = null) Return the first ActionLog matching the query
 * @method ActionLog findOneOrCreate(PropelPDO $con = null) Return the first ActionLog matching the query, or a new ActionLog object populated from the query conditions when no match is found
 *
 * @method ActionLog findOneById(int $id) Return the first ActionLog filtered by the id column
 * @method ActionLog findOneByUserobjecttype(string $userObjectType) Return the first ActionLog filtered by the userObjectType column
 * @method ActionLog findOneByUserobjectid(int $userObjectId) Return the first ActionLog filtered by the userObjectId column
 * @method ActionLog findOneByDatetime(string $datetime) Return the first ActionLog filtered by the datetime column
 * @method ActionLog findOneByAction(string $action) Return the first ActionLog filtered by the action column
 * @method ActionLog findOneByMessage(string $message) Return the first ActionLog filtered by the message column
 * @method ActionLog findOneByForward(string $forward) Return the first ActionLog filtered by the forward column
 *
 * @method array findById(int $id) Return ActionLog objects filtered by the id column
 * @method array findByUserobjecttype(string $userObjectType) Return ActionLog objects filtered by the userObjectType column
 * @method array findByUserobjectid(int $userObjectId) Return ActionLog objects filtered by the userObjectId column
 * @method array findByDatetime(string $datetime) Return ActionLog objects filtered by the datetime column
 * @method array findByAction(string $action) Return ActionLog objects filtered by the action column
 * @method array findByMessage(string $message) Return ActionLog objects filtered by the message column
 * @method array findByForward(string $forward) Return ActionLog objects filtered by the forward column
 *
 * @package    propel.generator.common.classes.om
 */
abstract class BaseActionLogQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseActionLogQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'ActionLog', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ActionLogQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ActionLogQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ActionLogQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ActionLogQuery) {
            return $criteria;
        }
        $query = new ActionLogQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ActionLog|ActionLog[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ActionLogPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ActionLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   ActionLog A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `USEROBJECTTYPE`, `USEROBJECTID`, `DATETIME`, `ACTION`, `MESSAGE`, `FORWARD` FROM `actionLogs_log` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new ActionLog();
            $obj->hydrate($row);
            ActionLogPeer::addInstanceToPool($obj, (string) $key);
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
     * @return ActionLog|ActionLog[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|ActionLog[]|mixed the list of results, formatted by the current formatter
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
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ActionLogPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ActionLogPeer::ID, $keys, Criteria::IN);
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
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ActionLogPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the userObjectType column
     *
     * Example usage:
     * <code>
     * $query->filterByUserobjecttype('fooValue');   // WHERE userObjectType = 'fooValue'
     * $query->filterByUserobjecttype('%fooValue%'); // WHERE userObjectType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userobjecttype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByUserobjecttype($userobjecttype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userobjecttype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userobjecttype)) {
                $userobjecttype = str_replace('*', '%', $userobjecttype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ActionLogPeer::USEROBJECTTYPE, $userobjecttype, $comparison);
    }

    /**
     * Filter the query on the userObjectId column
     *
     * Example usage:
     * <code>
     * $query->filterByUserobjectid(1234); // WHERE userObjectId = 1234
     * $query->filterByUserobjectid(array(12, 34)); // WHERE userObjectId IN (12, 34)
     * $query->filterByUserobjectid(array('min' => 12)); // WHERE userObjectId > 12
     * </code>
     *
     * @param     mixed $userobjectid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByUserobjectid($userobjectid = null, $comparison = null)
    {
        if (is_array($userobjectid)) {
            $useMinMax = false;
            if (isset($userobjectid['min'])) {
                $this->addUsingAlias(ActionLogPeer::USEROBJECTID, $userobjectid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userobjectid['max'])) {
                $this->addUsingAlias(ActionLogPeer::USEROBJECTID, $userobjectid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActionLogPeer::USEROBJECTID, $userobjectid, $comparison);
    }

    /**
     * Filter the query on the datetime column
     *
     * Example usage:
     * <code>
     * $query->filterByDatetime('2011-03-14'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime('now'); // WHERE datetime = '2011-03-14'
     * $query->filterByDatetime(array('max' => 'yesterday')); // WHERE datetime > '2011-03-13'
     * </code>
     *
     * @param     mixed $datetime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByDatetime($datetime = null, $comparison = null)
    {
        if (is_array($datetime)) {
            $useMinMax = false;
            if (isset($datetime['min'])) {
                $this->addUsingAlias(ActionLogPeer::DATETIME, $datetime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datetime['max'])) {
                $this->addUsingAlias(ActionLogPeer::DATETIME, $datetime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActionLogPeer::DATETIME, $datetime, $comparison);
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
     * @return ActionLogQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ActionLogPeer::ACTION, $action, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ActionLogPeer::MESSAGE, $message, $comparison);
    }

    /**
     * Filter the query on the forward column
     *
     * Example usage:
     * <code>
     * $query->filterByForward('fooValue');   // WHERE forward = 'fooValue'
     * $query->filterByForward('%fooValue%'); // WHERE forward LIKE '%fooValue%'
     * </code>
     *
     * @param     string $forward The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function filterByForward($forward = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($forward)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $forward)) {
                $forward = str_replace('*', '%', $forward);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ActionLogPeer::FORWARD, $forward, $comparison);
    }

    /**
     * Filter the query by a related SecurityAction object
     *
     * @param   SecurityAction|PropelObjectCollection $securityAction The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ActionLogQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySecurityAction($securityAction, $comparison = null)
    {
        if ($securityAction instanceof SecurityAction) {
            return $this
                ->addUsingAlias(ActionLogPeer::ACTION, $securityAction->getAction(), $comparison);
        } elseif ($securityAction instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ActionLogPeer::ACTION, $securityAction->toKeyValue('PrimaryKey', 'Action'), $comparison);
        } else {
            throw new PropelException('filterBySecurityAction() only accepts arguments of type SecurityAction or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SecurityAction relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function joinSecurityAction($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SecurityAction');

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
            $this->addJoinObject($join, 'SecurityAction');
        }

        return $this;
    }

    /**
     * Use the SecurityAction relation SecurityAction object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   SecurityActionQuery A secondary query class using the current class as primary query
     */
    public function useSecurityActionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSecurityAction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SecurityAction', 'SecurityActionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ActionLog $actionLog Object to remove from the list of results
     *
     * @return ActionLogQuery The current query, for fluid interface
     */
    public function prune($actionLog = null)
    {
        if ($actionLog) {
            $this->addUsingAlias(ActionLogPeer::ID, $actionLog->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
