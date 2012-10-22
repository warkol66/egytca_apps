<?php


/**
 * Base class that represents a query for the 'services_alertSubscription' table.
 *
 * Suscripciones de alerta
 *
 * @method AlertSubscriptionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method AlertSubscriptionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method AlertSubscriptionQuery orderByEntityname($order = Criteria::ASC) Order by the entityName column
 * @method AlertSubscriptionQuery orderByEntitydatefielduniquename($order = Criteria::ASC) Order by the entityDateFieldUniqueName column
 * @method AlertSubscriptionQuery orderByEntitybooleanfielduniquename($order = Criteria::ASC) Order by the entityBooleanFieldUniqueName column
 * @method AlertSubscriptionQuery orderByAnticipationdays($order = Criteria::ASC) Order by the anticipationDays column
 * @method AlertSubscriptionQuery orderByEntitynamefielduniquename($order = Criteria::ASC) Order by the entityNameFieldUniqueName column
 * @method AlertSubscriptionQuery orderByExtrarecipients($order = Criteria::ASC) Order by the extraRecipients column
 *
 * @method AlertSubscriptionQuery groupById() Group by the id column
 * @method AlertSubscriptionQuery groupByName() Group by the name column
 * @method AlertSubscriptionQuery groupByEntityname() Group by the entityName column
 * @method AlertSubscriptionQuery groupByEntitydatefielduniquename() Group by the entityDateFieldUniqueName column
 * @method AlertSubscriptionQuery groupByEntitybooleanfielduniquename() Group by the entityBooleanFieldUniqueName column
 * @method AlertSubscriptionQuery groupByAnticipationdays() Group by the anticipationDays column
 * @method AlertSubscriptionQuery groupByEntitynamefielduniquename() Group by the entityNameFieldUniqueName column
 * @method AlertSubscriptionQuery groupByExtrarecipients() Group by the extraRecipients column
 *
 * @method AlertSubscriptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AlertSubscriptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AlertSubscriptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AlertSubscriptionQuery leftJoinModuleEntity($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntity relation
 * @method AlertSubscriptionQuery rightJoinModuleEntity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntity relation
 * @method AlertSubscriptionQuery innerJoinModuleEntity($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntity relation
 *
 * @method AlertSubscriptionQuery leftJoinModuleEntityFieldRelatedByEntitynamefielduniquename($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByEntitynamefielduniquename relation
 * @method AlertSubscriptionQuery rightJoinModuleEntityFieldRelatedByEntitynamefielduniquename($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByEntitynamefielduniquename relation
 * @method AlertSubscriptionQuery innerJoinModuleEntityFieldRelatedByEntitynamefielduniquename($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByEntitynamefielduniquename relation
 *
 * @method AlertSubscriptionQuery leftJoinModuleEntityFieldRelatedByEntitydatefielduniquename($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByEntitydatefielduniquename relation
 * @method AlertSubscriptionQuery rightJoinModuleEntityFieldRelatedByEntitydatefielduniquename($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByEntitydatefielduniquename relation
 * @method AlertSubscriptionQuery innerJoinModuleEntityFieldRelatedByEntitydatefielduniquename($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByEntitydatefielduniquename relation
 *
 * @method AlertSubscriptionQuery leftJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename($relationAlias = null) Adds a LEFT JOIN clause to the query using the ModuleEntityFieldRelatedByEntitybooleanfielduniquename relation
 * @method AlertSubscriptionQuery rightJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ModuleEntityFieldRelatedByEntitybooleanfielduniquename relation
 * @method AlertSubscriptionQuery innerJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename($relationAlias = null) Adds a INNER JOIN clause to the query using the ModuleEntityFieldRelatedByEntitybooleanfielduniquename relation
 *
 * @method AlertSubscriptionQuery leftJoinAlertSubscriptionUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the AlertSubscriptionUser relation
 * @method AlertSubscriptionQuery rightJoinAlertSubscriptionUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AlertSubscriptionUser relation
 * @method AlertSubscriptionQuery innerJoinAlertSubscriptionUser($relationAlias = null) Adds a INNER JOIN clause to the query using the AlertSubscriptionUser relation
 *
 * @method AlertSubscription findOne(PropelPDO $con = null) Return the first AlertSubscription matching the query
 * @method AlertSubscription findOneOrCreate(PropelPDO $con = null) Return the first AlertSubscription matching the query, or a new AlertSubscription object populated from the query conditions when no match is found
 *
 * @method AlertSubscription findOneById(int $id) Return the first AlertSubscription filtered by the id column
 * @method AlertSubscription findOneByName(string $name) Return the first AlertSubscription filtered by the name column
 * @method AlertSubscription findOneByEntityname(string $entityName) Return the first AlertSubscription filtered by the entityName column
 * @method AlertSubscription findOneByEntitydatefielduniquename(string $entityDateFieldUniqueName) Return the first AlertSubscription filtered by the entityDateFieldUniqueName column
 * @method AlertSubscription findOneByEntitybooleanfielduniquename(string $entityBooleanFieldUniqueName) Return the first AlertSubscription filtered by the entityBooleanFieldUniqueName column
 * @method AlertSubscription findOneByAnticipationdays(int $anticipationDays) Return the first AlertSubscription filtered by the anticipationDays column
 * @method AlertSubscription findOneByEntitynamefielduniquename(string $entityNameFieldUniqueName) Return the first AlertSubscription filtered by the entityNameFieldUniqueName column
 * @method AlertSubscription findOneByExtrarecipients(string $extraRecipients) Return the first AlertSubscription filtered by the extraRecipients column
 *
 * @method array findById(int $id) Return AlertSubscription objects filtered by the id column
 * @method array findByName(string $name) Return AlertSubscription objects filtered by the name column
 * @method array findByEntityname(string $entityName) Return AlertSubscription objects filtered by the entityName column
 * @method array findByEntitydatefielduniquename(string $entityDateFieldUniqueName) Return AlertSubscription objects filtered by the entityDateFieldUniqueName column
 * @method array findByEntitybooleanfielduniquename(string $entityBooleanFieldUniqueName) Return AlertSubscription objects filtered by the entityBooleanFieldUniqueName column
 * @method array findByAnticipationdays(int $anticipationDays) Return AlertSubscription objects filtered by the anticipationDays column
 * @method array findByEntitynamefielduniquename(string $entityNameFieldUniqueName) Return AlertSubscription objects filtered by the entityNameFieldUniqueName column
 * @method array findByExtrarecipients(string $extraRecipients) Return AlertSubscription objects filtered by the extraRecipients column
 *
 * @package    propel.generator.services.classes.om
 */
abstract class BaseAlertSubscriptionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAlertSubscriptionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'AlertSubscription', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AlertSubscriptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AlertSubscriptionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AlertSubscriptionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AlertSubscriptionQuery) {
            return $criteria;
        }
        $query = new AlertSubscriptionQuery();
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
     * @return   AlertSubscription|AlertSubscription[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AlertSubscriptionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AlertSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   AlertSubscription A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `ENTITYNAME`, `ENTITYDATEFIELDUNIQUENAME`, `ENTITYBOOLEANFIELDUNIQUENAME`, `ANTICIPATIONDAYS`, `ENTITYNAMEFIELDUNIQUENAME`, `EXTRARECIPIENTS` FROM `services_alertSubscription` WHERE `ID` = :p0';
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
            $obj = new AlertSubscription();
            $obj->hydrate($row);
            AlertSubscriptionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return AlertSubscription|AlertSubscription[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|AlertSubscription[]|mixed the list of results, formatted by the current formatter
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
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AlertSubscriptionPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AlertSubscriptionPeer::ID, $keys, Criteria::IN);
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
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::ID, $id, $comparison);
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
     * @return AlertSubscriptionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AlertSubscriptionPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the entityName column
     *
     * Example usage:
     * <code>
     * $query->filterByEntityname('fooValue');   // WHERE entityName = 'fooValue'
     * $query->filterByEntityname('%fooValue%'); // WHERE entityName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $entityname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByEntityname($entityname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($entityname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $entityname)) {
                $entityname = str_replace('*', '%', $entityname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::ENTITYNAME, $entityname, $comparison);
    }

    /**
     * Filter the query on the entityDateFieldUniqueName column
     *
     * Example usage:
     * <code>
     * $query->filterByEntitydatefielduniquename('fooValue');   // WHERE entityDateFieldUniqueName = 'fooValue'
     * $query->filterByEntitydatefielduniquename('%fooValue%'); // WHERE entityDateFieldUniqueName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $entitydatefielduniquename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByEntitydatefielduniquename($entitydatefielduniquename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($entitydatefielduniquename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $entitydatefielduniquename)) {
                $entitydatefielduniquename = str_replace('*', '%', $entitydatefielduniquename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, $entitydatefielduniquename, $comparison);
    }

    /**
     * Filter the query on the entityBooleanFieldUniqueName column
     *
     * Example usage:
     * <code>
     * $query->filterByEntitybooleanfielduniquename('fooValue');   // WHERE entityBooleanFieldUniqueName = 'fooValue'
     * $query->filterByEntitybooleanfielduniquename('%fooValue%'); // WHERE entityBooleanFieldUniqueName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $entitybooleanfielduniquename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByEntitybooleanfielduniquename($entitybooleanfielduniquename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($entitybooleanfielduniquename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $entitybooleanfielduniquename)) {
                $entitybooleanfielduniquename = str_replace('*', '%', $entitybooleanfielduniquename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, $entitybooleanfielduniquename, $comparison);
    }

    /**
     * Filter the query on the anticipationDays column
     *
     * Example usage:
     * <code>
     * $query->filterByAnticipationdays(1234); // WHERE anticipationDays = 1234
     * $query->filterByAnticipationdays(array(12, 34)); // WHERE anticipationDays IN (12, 34)
     * $query->filterByAnticipationdays(array('min' => 12)); // WHERE anticipationDays > 12
     * </code>
     *
     * @param     mixed $anticipationdays The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByAnticipationdays($anticipationdays = null, $comparison = null)
    {
        if (is_array($anticipationdays)) {
            $useMinMax = false;
            if (isset($anticipationdays['min'])) {
                $this->addUsingAlias(AlertSubscriptionPeer::ANTICIPATIONDAYS, $anticipationdays['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($anticipationdays['max'])) {
                $this->addUsingAlias(AlertSubscriptionPeer::ANTICIPATIONDAYS, $anticipationdays['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::ANTICIPATIONDAYS, $anticipationdays, $comparison);
    }

    /**
     * Filter the query on the entityNameFieldUniqueName column
     *
     * Example usage:
     * <code>
     * $query->filterByEntitynamefielduniquename('fooValue');   // WHERE entityNameFieldUniqueName = 'fooValue'
     * $query->filterByEntitynamefielduniquename('%fooValue%'); // WHERE entityNameFieldUniqueName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $entitynamefielduniquename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByEntitynamefielduniquename($entitynamefielduniquename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($entitynamefielduniquename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $entitynamefielduniquename)) {
                $entitynamefielduniquename = str_replace('*', '%', $entitynamefielduniquename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, $entitynamefielduniquename, $comparison);
    }

    /**
     * Filter the query on the extraRecipients column
     *
     * Example usage:
     * <code>
     * $query->filterByExtrarecipients('fooValue');   // WHERE extraRecipients = 'fooValue'
     * $query->filterByExtrarecipients('%fooValue%'); // WHERE extraRecipients LIKE '%fooValue%'
     * </code>
     *
     * @param     string $extrarecipients The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByExtrarecipients($extrarecipients = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($extrarecipients)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $extrarecipients)) {
                $extrarecipients = str_replace('*', '%', $extrarecipients);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AlertSubscriptionPeer::EXTRARECIPIENTS, $extrarecipients, $comparison);
    }

    /**
     * Filter the query by a related ModuleEntity object
     *
     * @param   ModuleEntity|PropelObjectCollection $moduleEntity The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AlertSubscriptionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntity($moduleEntity, $comparison = null)
    {
        if ($moduleEntity instanceof ModuleEntity) {
            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYNAME, $moduleEntity->getName(), $comparison);
        } elseif ($moduleEntity instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYNAME, $moduleEntity->toKeyValue('PrimaryKey', 'Name'), $comparison);
        } else {
            throw new PropelException('filterByModuleEntity() only accepts arguments of type ModuleEntity or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function joinModuleEntity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntity');

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
            $this->addJoinObject($join, 'ModuleEntity');
        }

        return $this;
    }

    /**
     * Use the ModuleEntity relation ModuleEntity object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleEntity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntity', 'ModuleEntityQuery');
    }

    /**
     * Filter the query by a related ModuleEntityField object
     *
     * @param   ModuleEntityField|PropelObjectCollection $moduleEntityField The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AlertSubscriptionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntityFieldRelatedByEntitynamefielduniquename($moduleEntityField, $comparison = null)
    {
        if ($moduleEntityField instanceof ModuleEntityField) {
            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, $moduleEntityField->getUniquename(), $comparison);
        } elseif ($moduleEntityField instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, $moduleEntityField->toKeyValue('PrimaryKey', 'Uniquename'), $comparison);
        } else {
            throw new PropelException('filterByModuleEntityFieldRelatedByEntitynamefielduniquename() only accepts arguments of type ModuleEntityField or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByEntitynamefielduniquename relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function joinModuleEntityFieldRelatedByEntitynamefielduniquename($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByEntitynamefielduniquename');

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
            $this->addJoinObject($join, 'ModuleEntityFieldRelatedByEntitynamefielduniquename');
        }

        return $this;
    }

    /**
     * Use the ModuleEntityFieldRelatedByEntitynamefielduniquename relation ModuleEntityField object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityFieldQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityFieldRelatedByEntitynamefielduniquenameQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleEntityFieldRelatedByEntitynamefielduniquename($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByEntitynamefielduniquename', 'ModuleEntityFieldQuery');
    }

    /**
     * Filter the query by a related ModuleEntityField object
     *
     * @param   ModuleEntityField|PropelObjectCollection $moduleEntityField The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AlertSubscriptionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntityFieldRelatedByEntitydatefielduniquename($moduleEntityField, $comparison = null)
    {
        if ($moduleEntityField instanceof ModuleEntityField) {
            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, $moduleEntityField->getUniquename(), $comparison);
        } elseif ($moduleEntityField instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, $moduleEntityField->toKeyValue('PrimaryKey', 'Uniquename'), $comparison);
        } else {
            throw new PropelException('filterByModuleEntityFieldRelatedByEntitydatefielduniquename() only accepts arguments of type ModuleEntityField or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByEntitydatefielduniquename relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function joinModuleEntityFieldRelatedByEntitydatefielduniquename($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByEntitydatefielduniquename');

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
            $this->addJoinObject($join, 'ModuleEntityFieldRelatedByEntitydatefielduniquename');
        }

        return $this;
    }

    /**
     * Use the ModuleEntityFieldRelatedByEntitydatefielduniquename relation ModuleEntityField object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityFieldQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityFieldRelatedByEntitydatefielduniquenameQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleEntityFieldRelatedByEntitydatefielduniquename($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByEntitydatefielduniquename', 'ModuleEntityFieldQuery');
    }

    /**
     * Filter the query by a related ModuleEntityField object
     *
     * @param   ModuleEntityField|PropelObjectCollection $moduleEntityField The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AlertSubscriptionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByModuleEntityFieldRelatedByEntitybooleanfielduniquename($moduleEntityField, $comparison = null)
    {
        if ($moduleEntityField instanceof ModuleEntityField) {
            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, $moduleEntityField->getUniquename(), $comparison);
        } elseif ($moduleEntityField instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, $moduleEntityField->toKeyValue('PrimaryKey', 'Uniquename'), $comparison);
        } else {
            throw new PropelException('filterByModuleEntityFieldRelatedByEntitybooleanfielduniquename() only accepts arguments of type ModuleEntityField or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ModuleEntityFieldRelatedByEntitybooleanfielduniquename relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function joinModuleEntityFieldRelatedByEntitybooleanfielduniquename($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ModuleEntityFieldRelatedByEntitybooleanfielduniquename');

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
            $this->addJoinObject($join, 'ModuleEntityFieldRelatedByEntitybooleanfielduniquename');
        }

        return $this;
    }

    /**
     * Use the ModuleEntityFieldRelatedByEntitybooleanfielduniquename relation ModuleEntityField object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ModuleEntityFieldQuery A secondary query class using the current class as primary query
     */
    public function useModuleEntityFieldRelatedByEntitybooleanfielduniquenameQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinModuleEntityFieldRelatedByEntitybooleanfielduniquename($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ModuleEntityFieldRelatedByEntitybooleanfielduniquename', 'ModuleEntityFieldQuery');
    }

    /**
     * Filter the query by a related AlertSubscriptionUser object
     *
     * @param   AlertSubscriptionUser|PropelObjectCollection $alertSubscriptionUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AlertSubscriptionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAlertSubscriptionUser($alertSubscriptionUser, $comparison = null)
    {
        if ($alertSubscriptionUser instanceof AlertSubscriptionUser) {
            return $this
                ->addUsingAlias(AlertSubscriptionPeer::ID, $alertSubscriptionUser->getAlertsubscriptionid(), $comparison);
        } elseif ($alertSubscriptionUser instanceof PropelObjectCollection) {
            return $this
                ->useAlertSubscriptionUserQuery()
                ->filterByPrimaryKeys($alertSubscriptionUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAlertSubscriptionUser() only accepts arguments of type AlertSubscriptionUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AlertSubscriptionUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function joinAlertSubscriptionUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AlertSubscriptionUser');

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
            $this->addJoinObject($join, 'AlertSubscriptionUser');
        }

        return $this;
    }

    /**
     * Use the AlertSubscriptionUser relation AlertSubscriptionUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AlertSubscriptionUserQuery A secondary query class using the current class as primary query
     */
    public function useAlertSubscriptionUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAlertSubscriptionUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AlertSubscriptionUser', 'AlertSubscriptionUserQuery');
    }

    /**
     * Filter the query by a related User object
     * using the services_alertSubscriptionUser table as cross reference
     *
     * @param   User $user the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AlertSubscriptionQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useAlertSubscriptionUserQuery()
            ->filterByUser($user, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   AlertSubscription $alertSubscription Object to remove from the list of results
     *
     * @return AlertSubscriptionQuery The current query, for fluid interface
     */
    public function prune($alertSubscription = null)
    {
        if ($alertSubscription) {
            $this->addUsingAlias(AlertSubscriptionPeer::ID, $alertSubscription->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
