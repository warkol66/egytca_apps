<?php


/**
 * Base class that represents a query for the 'security_module' table.
 *
 * Modulos del sistema
 *
 * @method SecurityModuleQuery orderByModule($order = Criteria::ASC) Order by the module column
 * @method SecurityModuleQuery orderByAccess($order = Criteria::ASC) Order by the access column
 * @method SecurityModuleQuery orderByAccessaffiliateuser($order = Criteria::ASC) Order by the accessAffiliateUser column
 * @method SecurityModuleQuery orderByAccessregistrationuser($order = Criteria::ASC) Order by the accessRegistrationUser column
 * @method SecurityModuleQuery orderByAccessclientuser($order = Criteria::ASC) Order by the accessClientUser column
 * @method SecurityModuleQuery orderByNochecklogin($order = Criteria::ASC) Order by the noCheckLogin column
 *
 * @method SecurityModuleQuery groupByModule() Group by the module column
 * @method SecurityModuleQuery groupByAccess() Group by the access column
 * @method SecurityModuleQuery groupByAccessaffiliateuser() Group by the accessAffiliateUser column
 * @method SecurityModuleQuery groupByAccessregistrationuser() Group by the accessRegistrationUser column
 * @method SecurityModuleQuery groupByAccessclientuser() Group by the accessClientUser column
 * @method SecurityModuleQuery groupByNochecklogin() Group by the noCheckLogin column
 *
 * @method SecurityModuleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SecurityModuleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SecurityModuleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SecurityModuleQuery leftJoinSecurityAction($relationAlias = null) Adds a LEFT JOIN clause to the query using the SecurityAction relation
 * @method SecurityModuleQuery rightJoinSecurityAction($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SecurityAction relation
 * @method SecurityModuleQuery innerJoinSecurityAction($relationAlias = null) Adds a INNER JOIN clause to the query using the SecurityAction relation
 *
 * @method SecurityModule findOne(PropelPDO $con = null) Return the first SecurityModule matching the query
 * @method SecurityModule findOneOrCreate(PropelPDO $con = null) Return the first SecurityModule matching the query, or a new SecurityModule object populated from the query conditions when no match is found
 *
 * @method SecurityModule findOneByModule(string $module) Return the first SecurityModule filtered by the module column
 * @method SecurityModule findOneByAccess(int $access) Return the first SecurityModule filtered by the access column
 * @method SecurityModule findOneByAccessaffiliateuser(int $accessAffiliateUser) Return the first SecurityModule filtered by the accessAffiliateUser column
 * @method SecurityModule findOneByAccessregistrationuser(int $accessRegistrationUser) Return the first SecurityModule filtered by the accessRegistrationUser column
 * @method SecurityModule findOneByAccessclientuser(int $accessClientUser) Return the first SecurityModule filtered by the accessClientUser column
 * @method SecurityModule findOneByNochecklogin(boolean $noCheckLogin) Return the first SecurityModule filtered by the noCheckLogin column
 *
 * @method array findByModule(string $module) Return SecurityModule objects filtered by the module column
 * @method array findByAccess(int $access) Return SecurityModule objects filtered by the access column
 * @method array findByAccessaffiliateuser(int $accessAffiliateUser) Return SecurityModule objects filtered by the accessAffiliateUser column
 * @method array findByAccessregistrationuser(int $accessRegistrationUser) Return SecurityModule objects filtered by the accessRegistrationUser column
 * @method array findByAccessclientuser(int $accessClientUser) Return SecurityModule objects filtered by the accessClientUser column
 * @method array findByNochecklogin(boolean $noCheckLogin) Return SecurityModule objects filtered by the noCheckLogin column
 *
 * @package    propel.generator.security.classes.om
 */
abstract class BaseSecurityModuleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSecurityModuleQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'SecurityModule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SecurityModuleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SecurityModuleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SecurityModuleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SecurityModuleQuery) {
            return $criteria;
        }
        $query = new SecurityModuleQuery();
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
     * @return   SecurityModule|SecurityModule[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SecurityModulePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SecurityModulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   SecurityModule A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MODULE`, `ACCESS`, `ACCESSAFFILIATEUSER`, `ACCESSREGISTRATIONUSER`, `ACCESSCLIENTUSER`, `NOCHECKLOGIN` FROM `security_module` WHERE `MODULE` = :p0';
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
            $obj = new SecurityModule();
            $obj->hydrate($row);
            SecurityModulePeer::addInstanceToPool($obj, (string) $key);
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
     * @return SecurityModule|SecurityModule[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|SecurityModule[]|mixed the list of results, formatted by the current formatter
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SecurityModulePeer::MODULE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SecurityModulePeer::MODULE, $keys, Criteria::IN);
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
     * @return SecurityModuleQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SecurityModulePeer::MODULE, $module, $comparison);
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByAccess($access = null, $comparison = null)
    {
        if (is_array($access)) {
            $useMinMax = false;
            if (isset($access['min'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESS, $access['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($access['max'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESS, $access['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityModulePeer::ACCESS, $access, $comparison);
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByAccessaffiliateuser($accessaffiliateuser = null, $comparison = null)
    {
        if (is_array($accessaffiliateuser)) {
            $useMinMax = false;
            if (isset($accessaffiliateuser['min'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESSAFFILIATEUSER, $accessaffiliateuser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessaffiliateuser['max'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESSAFFILIATEUSER, $accessaffiliateuser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityModulePeer::ACCESSAFFILIATEUSER, $accessaffiliateuser, $comparison);
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByAccessregistrationuser($accessregistrationuser = null, $comparison = null)
    {
        if (is_array($accessregistrationuser)) {
            $useMinMax = false;
            if (isset($accessregistrationuser['min'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESSREGISTRATIONUSER, $accessregistrationuser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessregistrationuser['max'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESSREGISTRATIONUSER, $accessregistrationuser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityModulePeer::ACCESSREGISTRATIONUSER, $accessregistrationuser, $comparison);
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByAccessclientuser($accessclientuser = null, $comparison = null)
    {
        if (is_array($accessclientuser)) {
            $useMinMax = false;
            if (isset($accessclientuser['min'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESSCLIENTUSER, $accessclientuser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accessclientuser['max'])) {
                $this->addUsingAlias(SecurityModulePeer::ACCESSCLIENTUSER, $accessclientuser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SecurityModulePeer::ACCESSCLIENTUSER, $accessclientuser, $comparison);
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function filterByNochecklogin($nochecklogin = null, $comparison = null)
    {
        if (is_string($nochecklogin)) {
            $noCheckLogin = in_array(strtolower($nochecklogin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SecurityModulePeer::NOCHECKLOGIN, $nochecklogin, $comparison);
    }

    /**
     * Filter the query by a related SecurityAction object
     *
     * @param   SecurityAction|PropelObjectCollection $securityAction  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SecurityModuleQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySecurityAction($securityAction, $comparison = null)
    {
        if ($securityAction instanceof SecurityAction) {
            return $this
                ->addUsingAlias(SecurityModulePeer::MODULE, $securityAction->getModule(), $comparison);
        } elseif ($securityAction instanceof PropelObjectCollection) {
            return $this
                ->useSecurityActionQuery()
                ->filterByPrimaryKeys($securityAction->getPrimaryKeys())
                ->endUse();
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
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function joinSecurityAction($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useSecurityActionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSecurityAction($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SecurityAction', 'SecurityActionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SecurityModule $securityModule Object to remove from the list of results
     *
     * @return SecurityModuleQuery The current query, for fluid interface
     */
    public function prune($securityModule = null)
    {
        if ($securityModule) {
            $this->addUsingAlias(SecurityModulePeer::MODULE, $securityModule->getModule(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
