<?php


/**
 * Base class that represents a query for the 'modules_entity' table.
 *
 * Entidades de modulos
 *
 * @method ModuleEntityQuery orderByModulename($order = Criteria::ASC) Order by the moduleName column
 * @method ModuleEntityQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method ModuleEntityQuery orderByPhpname($order = Criteria::ASC) Order by the phpName column
 * @method ModuleEntityQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method ModuleEntityQuery orderBySoftdelete($order = Criteria::ASC) Order by the softDelete column
 * @method ModuleEntityQuery orderByRelation($order = Criteria::ASC) Order by the relation column
 * @method ModuleEntityQuery orderBySavelog($order = Criteria::ASC) Order by the saveLog column
 * @method ModuleEntityQuery orderByNestedset($order = Criteria::ASC) Order by the nestedset column
 * @method ModuleEntityQuery orderByScopefielduniquename($order = Criteria::ASC) Order by the scopeFieldUniqueName column
 * @method ModuleEntityQuery orderByBehaviors($order = Criteria::ASC) Order by the behaviors column
 *
 * @method ModuleEntityQuery groupByModulename() Group by the moduleName column
 * @method ModuleEntityQuery groupByName() Group by the name column
 * @method ModuleEntityQuery groupByPhpname() Group by the phpName column
 * @method ModuleEntityQuery groupByDescription() Group by the description column
 * @method ModuleEntityQuery groupBySoftdelete() Group by the softDelete column
 * @method ModuleEntityQuery groupByRelation() Group by the relation column
 * @method ModuleEntityQuery groupBySavelog() Group by the saveLog column
 * @method ModuleEntityQuery groupByNestedset() Group by the nestedset column
 * @method ModuleEntityQuery groupByScopefielduniquename() Group by the scopeFieldUniqueName column
 * @method ModuleEntityQuery groupByBehaviors() Group by the behaviors column
 *
 * @method ModuleEntityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ModuleEntityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ModuleEntityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ModuleEntityQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method ModuleEntityQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method ModuleEntityQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method ModuleEntityQuery leftJoinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
 * @method ModuleEntityQuery rightJoinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
 * @method ModuleEntityQuery innerJoinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
 *
 * @method ModuleEntityQuery leftJoinModuleEntityFieldRelatedByEntityname($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
 * @method ModuleEntityQuery rightJoinModuleEntityFieldRelatedByEntityname($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
 * @method ModuleEntityQuery innerJoinModuleEntityFieldRelatedByEntityname($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
 *
 * @method ModuleEntityQuery leftJoinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
 * @method ModuleEntityQuery rightJoinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
 * @method ModuleEntityQuery innerJoinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
 *
 * @method ModuleEntityQuery leftJoinAlertSubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the AlertSubscription relation
 * @method ModuleEntityQuery rightJoinAlertSubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AlertSubscription relation
 * @method ModuleEntityQuery innerJoinAlertSubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the AlertSubscription relation
 *
 * @method ModuleEntityQuery leftJoinScheduleSubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScheduleSubscription relation
 * @method ModuleEntityQuery rightJoinScheduleSubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScheduleSubscription relation
 * @method ModuleEntityQuery innerJoinScheduleSubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the ScheduleSubscription relation
 *
 * @method ModuleEntity findOne(PropelPDO $con = null) Return the first ModuleEntity matching the query
 * @method ModuleEntity findOneOrCreate(PropelPDO $con = null) Return the first ModuleEntity matching the query, or a new ModuleEntity object populated from the query conditions when no match is found
 *
 * @method ModuleEntity findOneByModulename(string $moduleName) Return the first ModuleEntity filtered by the moduleName column
 * @method ModuleEntity findOneByName(string $name) Return the first ModuleEntity filtered by the name column
 * @method ModuleEntity findOneByPhpname(string $phpName) Return the first ModuleEntity filtered by the phpName column
 * @method ModuleEntity findOneByDescription(string $description) Return the first ModuleEntity filtered by the description column
 * @method ModuleEntity findOneBySoftdelete(boolean $softDelete) Return the first ModuleEntity filtered by the softDelete column
 * @method ModuleEntity findOneByRelation(boolean $relation) Return the first ModuleEntity filtered by the relation column
 * @method ModuleEntity findOneBySavelog(boolean $saveLog) Return the first ModuleEntity filtered by the saveLog column
 * @method ModuleEntity findOneByNestedset(boolean $nestedset) Return the first ModuleEntity filtered by the nestedset column
 * @method ModuleEntity findOneByScopefielduniquename(string $scopeFieldUniqueName) Return the first ModuleEntity filtered by the scopeFieldUniqueName column
 * @method ModuleEntity findOneByBehaviors(resource $behaviors) Return the first ModuleEntity filtered by the behaviors column
 *
 * @method array findByModulename(string $moduleName) Return ModuleEntity objects filtered by the moduleName column
 * @method array findByName(string $name) Return ModuleEntity objects filtered by the name column
 * @method array findByPhpname(string $phpName) Return ModuleEntity objects filtered by the phpName column
 * @method array findByDescription(string $description) Return ModuleEntity objects filtered by the description column
 * @method array findBySoftdelete(boolean $softDelete) Return ModuleEntity objects filtered by the softDelete column
 * @method array findByRelation(boolean $relation) Return ModuleEntity objects filtered by the relation column
 * @method array findBySavelog(boolean $saveLog) Return ModuleEntity objects filtered by the saveLog column
 * @method array findByNestedset(boolean $nestedset) Return ModuleEntity objects filtered by the nestedset column
 * @method array findByScopefielduniquename(string $scopeFieldUniqueName) Return ModuleEntity objects filtered by the scopeFieldUniqueName column
 * @method array findByBehaviors(resource $behaviors) Return ModuleEntity objects filtered by the behaviors column
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleEntityQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseModuleEntityQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'ModuleEntity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ModuleEntityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ModuleEntityQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ModuleEntityQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ModuleEntityQuery) {
            return $criteria;
        }
        $query = new ModuleEntityQuery();
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
     * @return   ModuleEntity|ModuleEntity[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ModuleEntityPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   ModuleEntity A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MODULENAME`, `NAME`, `PHPNAME`, `DESCRIPTION`, `SOFTDELETE`, `RELATION`, `SAVELOG`, `NESTEDSET`, `SCOPEFIELDUNIQUENAME`, `BEHAVIORS` FROM `modules_entity` WHERE `NAME` = :p0';
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
            $obj = new ModuleEntity();
            $obj->hydrate($row);
            ModuleEntityPeer::addInstanceToPool($obj, (string) $key);
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
     * @return ModuleEntity|ModuleEntity[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ModuleEntity[]|mixed the list of results, formatted by the current formatter
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
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ModuleEntityPeer::NAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ModuleEntityPeer::NAME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the moduleName column
     *
     * Example usage:
     * <code>
     * $query->filterByModulename('fooValue');   // WHERE moduleName = 'fooValue'
     * $query->filterByModulename('%fooValue%'); // WHERE moduleName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modulename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByModulename($modulename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modulename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $modulename)) {
                $modulename = str_replace('*', '%', $modulename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ModuleEntityPeer::MODULENAME, $modulename, $comparison);
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
     * @return ModuleEntityQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ModuleEntityPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the phpName column
     *
     * Example usage:
     * <code>
     * $query->filterByPhpname('fooValue');   // WHERE phpName = 'fooValue'
     * $query->filterByPhpname('%fooValue%'); // WHERE phpName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phpname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByPhpname($phpname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phpname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phpname)) {
                $phpname = str_replace('*', '%', $phpname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ModuleEntityPeer::PHPNAME, $phpname, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ModuleEntityPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the softDelete column
     *
     * Example usage:
     * <code>
     * $query->filterBySoftdelete(true); // WHERE softDelete = true
     * $query->filterBySoftdelete('yes'); // WHERE softDelete = true
     * </code>
     *
     * @param     boolean|string $softdelete The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterBySoftdelete($softdelete = null, $comparison = null)
    {
        if (is_string($softdelete)) {
            $softDelete = in_array(strtolower($softdelete), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ModuleEntityPeer::SOFTDELETE, $softdelete, $comparison);
    }

    /**
     * Filter the query on the relation column
     *
     * Example usage:
     * <code>
     * $query->filterByRelation(true); // WHERE relation = true
     * $query->filterByRelation('yes'); // WHERE relation = true
     * </code>
     *
     * @param     boolean|string $relation The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByRelation($relation = null, $comparison = null)
    {
        if (is_string($relation)) {
            $relation = in_array(strtolower($relation), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ModuleEntityPeer::RELATION, $relation, $comparison);
    }

    /**
     * Filter the query on the saveLog column
     *
     * Example usage:
     * <code>
     * $query->filterBySavelog(true); // WHERE saveLog = true
     * $query->filterBySavelog('yes'); // WHERE saveLog = true
     * </code>
     *
     * @param     boolean|string $savelog The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterBySavelog($savelog = null, $comparison = null)
    {
        if (is_string($savelog)) {
            $saveLog = in_array(strtolower($savelog), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ModuleEntityPeer::SAVELOG, $savelog, $comparison);
    }

    /**
     * Filter the query on the nestedset column
     *
     * Example usage:
     * <code>
     * $query->filterByNestedset(true); // WHERE nestedset = true
     * $query->filterByNestedset('yes'); // WHERE nestedset = true
     * </code>
     *
     * @param     boolean|string $nestedset The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByNestedset($nestedset = null, $comparison = null)
    {
        if (is_string($nestedset)) {
            $nestedset = in_array(strtolower($nestedset), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ModuleEntityPeer::NESTEDSET, $nestedset, $comparison);
    }

    /**
     * Filter the query on the scopeFieldUniqueName column
     *
     * Example usage:
     * <code>
     * $query->filterByScopefielduniquename('fooValue');   // WHERE scopeFieldUniqueName = 'fooValue'
     * $query->filterByScopefielduniquename('%fooValue%'); // WHERE scopeFieldUniqueName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $scopefielduniquename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByScopefielduniquename($scopefielduniquename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($scopefielduniquename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $scopefielduniquename)) {
                $scopefielduniquename = str_replace('*', '%', $scopefielduniquename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $scopefielduniquename, $comparison);
    }

    /**
     * Filter the query on the behaviors column
     *
     * @param     mixed $behaviors The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function filterByBehaviors($behaviors = null, $comparison = null)
    {

        return $this->addUsingAlias(ModuleEntityPeer::BEHAVIORS, $behaviors, $comparison);
    }

    /**
     * Filter the query by a related Module object
     *
     * @param   Module|PropelObjectCollection $module The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleEntityQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModule($module, $comparison = null)
    {
        if ($module instanceof Module) {
            return $this
                ->addUsingAlias(ModuleEntityPeer::MODULENAME, $module->getName(), $comparison);
        } elseif ($module instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ModuleEntityPeer::MODULENAME, $module->toKeyValue('PrimaryKey', 'Name'), $comparison);
        } else {
            throw new PropelException('filterByModule() only accepts arguments of type Module or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Module relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function joinModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Module');

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
            $this->addJoinObject($join, 'Module');
        }

        return $this;
    }

    /**
     * Use the Module relation Module object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleQuery A secondary query class using the current class as primary query
     */
    public function useModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinModule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Module', 'ModuleQuery');
    }

    /**
     * Filter the query by a related ModuleEntityField object
     *
     * @param   ModuleEntityField|PropelObjectCollection $moduleEntityField The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleEntityQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntityFieldRelatedByScopefielduniquename($moduleEntityField, $comparison = null)
    {
        if ($moduleEntityField instanceof ModuleEntityField) {
            return $this
                ->addUsingAlias(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $moduleEntityField->getUniquename(), $comparison);
        } elseif ($moduleEntityField instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $moduleEntityField->toKeyValue('PrimaryKey', 'Uniquename'), $comparison);
        } else {
            throw new PropelException('filterByModuleEntityFieldRelatedByScopefielduniquename() only accepts arguments of type ModuleEntityField or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByScopefielduniquename relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function joinModuleEntityFieldRelatedByScopefielduniquename($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByScopefielduniquename');

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
            $this->addJoinObject($join, 'ModuleEntityFieldRelatedByScopefielduniquename');
        }

        return $this;
    }

    /**
     * Use the ModuleEntityFieldRelatedByScopefielduniquename relation ModuleEntityField object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityFieldQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityFieldRelatedByScopefielduniquenameQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleEntityFieldRelatedByScopefielduniquename($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByScopefielduniquename', 'ModuleEntityFieldQuery');
    }

    /**
     * Filter the query by a related ModuleEntityField object
     *
     * @param   ModuleEntityField|PropelObjectCollection $moduleEntityField  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleEntityQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntityFieldRelatedByEntityname($moduleEntityField, $comparison = null)
    {
        if ($moduleEntityField instanceof ModuleEntityField) {
            return $this
                ->addUsingAlias(ModuleEntityPeer::NAME, $moduleEntityField->getEntityname(), $comparison);
        } elseif ($moduleEntityField instanceof PropelObjectCollection) {
            return $this
                ->useModuleEntityFieldRelatedByEntitynameQuery()
                ->filterByPrimaryKeys($moduleEntityField->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByModuleEntityFieldRelatedByEntityname() only accepts arguments of type ModuleEntityField or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByEntityname relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function joinModuleEntityFieldRelatedByEntityname($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByEntityname');

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
            $this->addJoinObject($join, 'ModuleEntityFieldRelatedByEntityname');
        }

        return $this;
    }

    /**
     * Use the ModuleEntityFieldRelatedByEntityname relation ModuleEntityField object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityFieldQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityFieldRelatedByEntitynameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinModuleEntityFieldRelatedByEntityname($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByEntityname', 'ModuleEntityFieldQuery');
    }

    /**
     * Filter the query by a related ModuleEntityField object
     *
     * @param   ModuleEntityField|PropelObjectCollection $moduleEntityField  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleEntityQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntityFieldRelatedByForeignkeytable($moduleEntityField, $comparison = null)
    {
        if ($moduleEntityField instanceof ModuleEntityField) {
            return $this
                ->addUsingAlias(ModuleEntityPeer::NAME, $moduleEntityField->getForeignkeytable(), $comparison);
        } elseif ($moduleEntityField instanceof PropelObjectCollection) {
            return $this
                ->useModuleEntityFieldRelatedByForeignkeytableQuery()
                ->filterByPrimaryKeys($moduleEntityField->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByModuleEntityFieldRelatedByForeignkeytable() only accepts arguments of type ModuleEntityField or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByForeignkeytable relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function joinModuleEntityFieldRelatedByForeignkeytable($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByForeignkeytable');

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
            $this->addJoinObject($join, 'ModuleEntityFieldRelatedByForeignkeytable');
        }

        return $this;
    }

    /**
     * Use the ModuleEntityFieldRelatedByForeignkeytable relation ModuleEntityField object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityFieldQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityFieldRelatedByForeignkeytableQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleEntityFieldRelatedByForeignkeytable($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByForeignkeytable', 'ModuleEntityFieldQuery');
    }

    /**
     * Filter the query by a related AlertSubscription object
     *
     * @param   AlertSubscription|PropelObjectCollection $alertSubscription  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleEntityQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAlertSubscription($alertSubscription, $comparison = null)
    {
        if ($alertSubscription instanceof AlertSubscription) {
            return $this
                ->addUsingAlias(ModuleEntityPeer::NAME, $alertSubscription->getEntityname(), $comparison);
        } elseif ($alertSubscription instanceof PropelObjectCollection) {
            return $this
                ->useAlertSubscriptionQuery()
                ->filterByPrimaryKeys($alertSubscription->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAlertSubscription() only accepts arguments of type AlertSubscription or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AlertSubscription relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function joinAlertSubscription($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AlertSubscription');

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
            $this->addJoinObject($join, 'AlertSubscription');
        }

        return $this;
    }

    /**
     * Use the AlertSubscription relation AlertSubscription object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AlertSubscriptionQuery A secondary query class using the current class as primary query
     */
    public function useAlertSubscriptionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAlertSubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AlertSubscription', 'AlertSubscriptionQuery');
    }

    /**
     * Filter the query by a related ScheduleSubscription object
     *
     * @param   ScheduleSubscription|PropelObjectCollection $scheduleSubscription  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ModuleEntityQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByScheduleSubscription($scheduleSubscription, $comparison = null)
    {
        if ($scheduleSubscription instanceof ScheduleSubscription) {
            return $this
                ->addUsingAlias(ModuleEntityPeer::NAME, $scheduleSubscription->getEntityname(), $comparison);
        } elseif ($scheduleSubscription instanceof PropelObjectCollection) {
            return $this
                ->useScheduleSubscriptionQuery()
                ->filterByPrimaryKeys($scheduleSubscription->getPrimaryKeys())
                ->endUse();
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
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function joinScheduleSubscription($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useScheduleSubscriptionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinScheduleSubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScheduleSubscription', 'ScheduleSubscriptionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ModuleEntity $moduleEntity Object to remove from the list of results
     *
     * @return ModuleEntityQuery The current query, for fluid interface
     */
    public function prune($moduleEntity = null)
    {
        if ($moduleEntity) {
            $this->addUsingAlias(ModuleEntityPeer::NAME, $moduleEntity->getName(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
