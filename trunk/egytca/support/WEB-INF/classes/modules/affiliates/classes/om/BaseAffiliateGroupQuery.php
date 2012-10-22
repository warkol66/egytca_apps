<?php


/**
 * Base class that represents a query for the 'affiliates_group' table.
 *
 * Groups
 *
 * @method AffiliateGroupQuery orderById($order = Criteria::ASC) Order by the id column
 * @method AffiliateGroupQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method AffiliateGroupQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method AffiliateGroupQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 * @method AffiliateGroupQuery orderByBitlevel($order = Criteria::ASC) Order by the bitLevel column
 *
 * @method AffiliateGroupQuery groupById() Group by the id column
 * @method AffiliateGroupQuery groupByName() Group by the name column
 * @method AffiliateGroupQuery groupByCreated() Group by the created column
 * @method AffiliateGroupQuery groupByUpdated() Group by the updated column
 * @method AffiliateGroupQuery groupByBitlevel() Group by the bitLevel column
 *
 * @method AffiliateGroupQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AffiliateGroupQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AffiliateGroupQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AffiliateGroupQuery leftJoinAffiliateUserGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateUserGroup relation
 * @method AffiliateGroupQuery rightJoinAffiliateUserGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateUserGroup relation
 * @method AffiliateGroupQuery innerJoinAffiliateUserGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateUserGroup relation
 *
 * @method AffiliateGroup findOne(PropelPDO $con = null) Return the first AffiliateGroup matching the query
 * @method AffiliateGroup findOneOrCreate(PropelPDO $con = null) Return the first AffiliateGroup matching the query, or a new AffiliateGroup object populated from the query conditions when no match is found
 *
 * @method AffiliateGroup findOneById(int $id) Return the first AffiliateGroup filtered by the id column
 * @method AffiliateGroup findOneByName(string $name) Return the first AffiliateGroup filtered by the name column
 * @method AffiliateGroup findOneByCreated(string $created) Return the first AffiliateGroup filtered by the created column
 * @method AffiliateGroup findOneByUpdated(string $updated) Return the first AffiliateGroup filtered by the updated column
 * @method AffiliateGroup findOneByBitlevel(int $bitLevel) Return the first AffiliateGroup filtered by the bitLevel column
 *
 * @method array findById(int $id) Return AffiliateGroup objects filtered by the id column
 * @method array findByName(string $name) Return AffiliateGroup objects filtered by the name column
 * @method array findByCreated(string $created) Return AffiliateGroup objects filtered by the created column
 * @method array findByUpdated(string $updated) Return AffiliateGroup objects filtered by the updated column
 * @method array findByBitlevel(int $bitLevel) Return AffiliateGroup objects filtered by the bitLevel column
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateGroupQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAffiliateGroupQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'AffiliateGroup', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AffiliateGroupQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AffiliateGroupQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AffiliateGroupQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AffiliateGroupQuery) {
            return $criteria;
        }
        $query = new AffiliateGroupQuery();
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
     * @return   AffiliateGroup|AffiliateGroup[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AffiliateGroupPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AffiliateGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   AffiliateGroup A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `CREATED`, `UPDATED`, `BITLEVEL` FROM `affiliates_group` WHERE `ID` = :p0';
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
            $obj = new AffiliateGroup();
            $obj->hydrate($row);
            AffiliateGroupPeer::addInstanceToPool($obj, (string) $key);
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
     * @return AffiliateGroup|AffiliateGroup[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|AffiliateGroup[]|mixed the list of results, formatted by the current formatter
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
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AffiliateGroupPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AffiliateGroupPeer::ID, $keys, Criteria::IN);
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
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AffiliateGroupPeer::ID, $id, $comparison);
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
     * @return AffiliateGroupQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateGroupPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(AffiliateGroupPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(AffiliateGroupPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliateGroupPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the updated column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdated('2011-03-14'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated('now'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated(array('max' => 'yesterday')); // WHERE updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $updated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(AffiliateGroupPeer::UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(AffiliateGroupPeer::UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliateGroupPeer::UPDATED, $updated, $comparison);
    }

    /**
     * Filter the query on the bitLevel column
     *
     * Example usage:
     * <code>
     * $query->filterByBitlevel(1234); // WHERE bitLevel = 1234
     * $query->filterByBitlevel(array(12, 34)); // WHERE bitLevel IN (12, 34)
     * $query->filterByBitlevel(array('min' => 12)); // WHERE bitLevel > 12
     * </code>
     *
     * @param     mixed $bitlevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterByBitlevel($bitlevel = null, $comparison = null)
    {
        if (is_array($bitlevel)) {
            $useMinMax = false;
            if (isset($bitlevel['min'])) {
                $this->addUsingAlias(AffiliateGroupPeer::BITLEVEL, $bitlevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bitlevel['max'])) {
                $this->addUsingAlias(AffiliateGroupPeer::BITLEVEL, $bitlevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliateGroupPeer::BITLEVEL, $bitlevel, $comparison);
    }

    /**
     * Filter the query by a related AffiliateUserGroup object
     *
     * @param   AffiliateUserGroup|PropelObjectCollection $affiliateUserGroup  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateGroupQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateUserGroup($affiliateUserGroup, $comparison = null)
    {
        if ($affiliateUserGroup instanceof AffiliateUserGroup) {
            return $this
                ->addUsingAlias(AffiliateGroupPeer::ID, $affiliateUserGroup->getGroupid(), $comparison);
        } elseif ($affiliateUserGroup instanceof PropelObjectCollection) {
            return $this
                ->useAffiliateUserGroupQuery()
                ->filterByPrimaryKeys($affiliateUserGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAffiliateUserGroup() only accepts arguments of type AffiliateUserGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AffiliateUserGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function joinAffiliateUserGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AffiliateUserGroup');

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
            $this->addJoinObject($join, 'AffiliateUserGroup');
        }

        return $this;
    }

    /**
     * Use the AffiliateUserGroup relation AffiliateUserGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateUserGroupQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateUserGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAffiliateUserGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateUserGroup', 'AffiliateUserGroupQuery');
    }

    /**
     * Filter the query by a related AffiliateUser object
     * using the affiliates_userGroup table as cross reference
     *
     * @param   AffiliateUser $affiliateUser the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateGroupQuery The current query, for fluid interface
     */
    public function filterByAffiliateUser($affiliateUser, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useAffiliateUserGroupQuery()
            ->filterByAffiliateUser($affiliateUser, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   AffiliateGroup $affiliateGroup Object to remove from the list of results
     *
     * @return AffiliateGroupQuery The current query, for fluid interface
     */
    public function prune($affiliateGroup = null)
    {
        if ($affiliateGroup) {
            $this->addUsingAlias(AffiliateGroupPeer::ID, $affiliateGroup->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
