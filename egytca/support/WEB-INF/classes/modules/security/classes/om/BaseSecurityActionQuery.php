<?php


/**
 * Base class that represents a query for the 'security_action' table.
 *
 * Actions del sistema
 *
 * @method SecurityActionQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method SecurityActionQuery orderByModule($order = Criteria::ASC) Order by the module column
 * @method SecurityActionQuery orderBySection($order = Criteria::ASC) Order by the section column
 * @method SecurityActionQuery orderByAccess($order = Criteria::ASC) Order by the access column
 * @method SecurityActionQuery orderByAccessaffiliateuser($order = Criteria::ASC) Order by the accessAffiliateUser column
 * @method SecurityActionQuery orderByAccessregistrationuser($order = Criteria::ASC) Order by the accessRegistrationUser column
 * @method SecurityActionQuery orderByAccessclientuser($order = Criteria::ASC) Order by the accessClientUser column
 * @method SecurityActionQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method SecurityActionQuery orderByPair($order = Criteria::ASC) Order by the pair column
 * @method SecurityActionQuery orderByNochecklogin($order = Criteria::ASC) Order by the noCheckLogin column
 *
 * @method SecurityActionQuery groupByAction() Group by the action column
 * @method SecurityActionQuery groupByModule() Group by the module column
 * @method SecurityActionQuery groupBySection() Group by the section column
 * @method SecurityActionQuery groupByAccess() Group by the access column
 * @method SecurityActionQuery groupByAccessaffiliateuser() Group by the accessAffiliateUser column
 * @method SecurityActionQuery groupByAccessregistrationuser() Group by the accessRegistrationUser column
 * @method SecurityActionQuery groupByAccessclientuser() Group by the accessClientUser column
 * @method SecurityActionQuery groupByActive() Group by the active column
 * @method SecurityActionQuery groupByPair() Group by the pair column
 * @method SecurityActionQuery groupByNochecklogin() Group by the noCheckLogin column
 *
 * @method SecurityActionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SecurityActionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SecurityActionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SecurityActionQuery leftJoinSecurityModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the SecurityModule relation
 * @method SecurityActionQuery rightJoinSecurityModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SecurityModule relation
 * @method SecurityActionQuery innerJoinSecurityModule($relationAlias = null) Adds a INNER JOIN clause to the query using the SecurityModule relation
 *
 * @method SecurityActionQuery leftJoinActionLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActionLog relation
 * @method SecurityActionQuery rightJoinActionLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActionLog relation
 * @method SecurityActionQuery innerJoinActionLog($relationAlias = null) Adds a INNER JOIN clause to the query using the ActionLog relation
 *
 * @method SecurityAction findOne(PropelPDO $con = null) Return the first SecurityAction matching the query
 * @method SecurityAction findOneOrCreate(PropelPDO $con = null) Return the first SecurityAction matching the query, or a new SecurityAction object populated from the query conditions when no match is found
 *
 * @method SecurityAction findOneByAction(string $action) Return the first SecurityAction filtered by the action column
 * @method SecurityAction findOneByModule(string $module) Return the first SecurityAction filtered by the module column
 * @method SecurityAction findOneBySection(string $section) Return the first SecurityAction filtered by the section column
 * @method SecurityAction findOneByAccess(int $access) Return the first SecurityAction filtered by the access column
 * @method SecurityAction findOneByAccessaffiliateuser(int $accessAffiliateUser) Return the first SecurityAction filtered by the accessAffiliateUser column
 * @method SecurityAction findOneByAccessregistrationuser(int $accessRegistrationUser) Return the first SecurityAction filtered by the accessRegistrationUser column
 * @method SecurityAction findOneByAccessclientuser(int $accessClientUser) Return the first SecurityAction filtered by the accessClientUser column
 * @method SecurityAction findOneByActive(int $active) Return the first SecurityAction filtered by the active column
 * @method SecurityAction findOneByPair(string $pair) Return the first SecurityAction filtered by the pair column
 * @method SecurityAction findOneByNochecklogin(boolean $noCheckLogin) Return the first SecurityAction filtered by the noCheckLogin column
 *
 * @method array findByAction(string $action) Return SecurityAction objects filtered by the action column
 * @method array findByModule(string $module) Return SecurityAction objects filtered by the module column
 * @method array findBySection(string $section) Return SecurityAction objects filtered by the section column
 * @method array findByAccess(int $access) Return SecurityAction objects filtered by the access column
 * @method array findByAccessaffiliateuser(int $accessAffiliateUser) Return SecurityAction objects filtered by the accessAffiliateUser column
 * @method array findByAccessregistrationuser(int $accessRegistrationUser) Return SecurityAction objects filtered by the accessRegistrationUser column
 * @method array findByAccessclientuser(int $accessClientUser) Return SecurityAction objects filtered by the accessClientUser column
 * @method array findByActive(int $active) Return SecurityAction objects filtered by the active column
 * @method array findByPair(string $pair) Return SecurityAction objects filtered by the pair column
 * @method array findByNochecklogin(boolean $noCheckLogin) Return SecurityAction objects filtered by the noCheckLogin column
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
     * @param     SecurityActionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SecurityActionQuery
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
     * @return   SecurityAction|SecurityAction[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SecurityActionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SecurityActionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   SecurityAction A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ACTION`, `MODULE`, `SECTION`, `ACCESS`, `ACCESSAFFILIATEUSER`, `ACCESSREGISTRATIONUSER`, `ACCESSCLIENTUSER`, `ACTIVE`, `PAIR`, `NOCHECKLOGIN` FROM `security_action` WHERE `ACTION` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new SecurityAction();
            $obj->hydrate($row);
            SecurityActionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return SecurityAction|SecurityAction[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|SecurityAction[]|mixed the list of results, formatted by the current formatter
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * Filter the query on the accessAffiliateUser column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessaffiliateuser(1234); // WHERE accessAffiliateUser = 1234
     * $query->filterByAccessaffiliateuser(array(12, 34)); // WHERE accessAffiliateUser IN (12, 34)
     * $query->filterByAccessaffiliateuser(array('min' => 12)); // WHERE accessAffiliateUser > 12
     * </code>
     *
     * @param     mixed $accessaffiliateuser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function filterByAccessaffiliateuser($accessaffiliateuser = null, $comparison = null)
    {
        if (is_array($accessaffiliateuser)) {
            $useMinMax = false;
            if (isset($accessaffiliateuser['min'])) {
                $this->addUsingAlias(SecurityActionPeer::ACCESSAFFILIATEUSER, $accessaffiliateuser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessaffiliateuser['max'])) {
                $this->addUsingAlias(SecurityActionPeer::ACCESSAFFILIATEUSER, $accessaffiliateuser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityActionPeer::ACCESSAFFILIATEUSER, $accessaffiliateuser, $comparison);
    }

    /**
     * Filter the query on the accessRegistrationUser column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessregistrationuser(1234); // WHERE accessRegistrationUser = 1234
     * $query->filterByAccessregistrationuser(array(12, 34)); // WHERE accessRegistrationUser IN (12, 34)
     * $query->filterByAccessregistrationuser(array('min' => 12)); // WHERE accessRegistrationUser > 12
     * </code>
     *
     * @param     mixed $accessregistrationuser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function filterByAccessregistrationuser($accessregistrationuser = null, $comparison = null)
    {
        if (is_array($accessregistrationuser)) {
            $useMinMax = false;
            if (isset($accessregistrationuser['min'])) {
                $this->addUsingAlias(SecurityActionPeer::ACCESSREGISTRATIONUSER, $accessregistrationuser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessregistrationuser['max'])) {
                $this->addUsingAlias(SecurityActionPeer::ACCESSREGISTRATIONUSER, $accessregistrationuser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityActionPeer::ACCESSREGISTRATIONUSER, $accessregistrationuser, $comparison);
    }

    /**
     * Filter the query on the accessClientUser column
     *
     * Example usage:
     * <code>
     * $query->filterByAccessclientuser(1234); // WHERE accessClientUser = 1234
     * $query->filterByAccessclientuser(array(12, 34)); // WHERE accessClientUser IN (12, 34)
     * $query->filterByAccessclientuser(array('min' => 12)); // WHERE accessClientUser > 12
     * </code>
     *
     * @param     mixed $accessclientuser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function filterByAccessclientuser($accessclientuser = null, $comparison = null)
    {
        if (is_array($accessclientuser)) {
            $useMinMax = false;
            if (isset($accessclientuser['min'])) {
                $this->addUsingAlias(SecurityActionPeer::ACCESSCLIENTUSER, $accessclientuser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessclientuser['max'])) {
                $this->addUsingAlias(SecurityActionPeer::ACCESSCLIENTUSER, $accessclientuser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityActionPeer::ACCESSCLIENTUSER, $accessclientuser, $comparison);
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
     * @return SecurityActionQuery The current query, for fluid interface
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
     * Filter the query on the pair column
     *
     * Example usage:
     * <code>
     * $query->filterByPair('fooValue');   // WHERE pair = 'fooValue'
     * $query->filterByPair('%fooValue%'); // WHERE pair LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pair The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function filterByPair($pair = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pair)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pair)) {
                $pair = str_replace('*', '%', $pair);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SecurityActionPeer::PAIR, $pair, $comparison);
    }

    /**
     * Filter the query on the noCheckLogin column
     *
     * Example usage:
     * <code>
     * $query->filterByNochecklogin(true); // WHERE noCheckLogin = true
     * $query->filterByNochecklogin('yes'); // WHERE noCheckLogin = true
     * </code>
     *
     * @param     boolean|string $nochecklogin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function filterByNochecklogin($nochecklogin = null, $comparison = null)
    {
        if (is_string($nochecklogin)) {
            $noCheckLogin = in_array(strtolower($nochecklogin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SecurityActionPeer::NOCHECKLOGIN, $nochecklogin, $comparison);
    }

    /**
     * Filter the query by a related SecurityModule object
     *
     * @param   SecurityModule|PropelObjectCollection $securityModule The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SecurityActionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySecurityModule($securityModule, $comparison = null)
    {
        if ($securityModule instanceof SecurityModule) {
            return $this
                ->addUsingAlias(SecurityActionPeer::MODULE, $securityModule->getModule(), $comparison);
        } elseif ($securityModule instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SecurityActionPeer::MODULE, $securityModule->toKeyValue('PrimaryKey', 'Module'), $comparison);
        } else {
            throw new PropelException('filterBySecurityModule() only accepts arguments of type SecurityModule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SecurityModule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function joinSecurityModule($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SecurityModule');

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
            $this->addJoinObject($join, 'SecurityModule');
        }

        return $this;
    }

    /**
     * Use the SecurityModule relation SecurityModule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   SecurityModuleQuery A secondary query class using the current class as primary query
     */
    public function useSecurityModuleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSecurityModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SecurityModule', 'SecurityModuleQuery');
    }

    /**
     * Filter the query by a related ActionLog object
     *
     * @param   ActionLog|PropelObjectCollection $actionLog  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SecurityActionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByActionLog($actionLog, $comparison = null)
    {
        if ($actionLog instanceof ActionLog) {
            return $this
                ->addUsingAlias(SecurityActionPeer::ACTION, $actionLog->getAction(), $comparison);
        } elseif ($actionLog instanceof PropelObjectCollection) {
            return $this
                ->useActionLogQuery()
                ->filterByPrimaryKeys($actionLog->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByActionLog() only accepts arguments of type ActionLog or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ActionLog relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function joinActionLog($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ActionLog');

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
            $this->addJoinObject($join, 'ActionLog');
        }

        return $this;
    }

    /**
     * Use the ActionLog relation ActionLog object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ActionLogQuery A secondary query class using the current class as primary query
     */
    public function useActionLogQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActionLog($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActionLog', 'ActionLogQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SecurityAction $securityAction Object to remove from the list of results
     *
     * @return SecurityActionQuery The current query, for fluid interface
     */
    public function prune($securityAction = null)
    {
        if ($securityAction) {
            $this->addUsingAlias(SecurityActionPeer::ACTION, $securityAction->getAction(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
