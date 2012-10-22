<?php


/**
 * Base class that represents a query for the 'affiliates_level' table.
 *
 * Levels
 *
 * @method AffiliateLevelQuery orderById($order = Criteria::ASC) Order by the id column
 * @method AffiliateLevelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method AffiliateLevelQuery orderByBitlevel($order = Criteria::ASC) Order by the bitLevel column
 *
 * @method AffiliateLevelQuery groupById() Group by the id column
 * @method AffiliateLevelQuery groupByName() Group by the name column
 * @method AffiliateLevelQuery groupByBitlevel() Group by the bitLevel column
 *
 * @method AffiliateLevelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AffiliateLevelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AffiliateLevelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AffiliateLevelQuery leftJoinAffiliateUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateUser relation
 * @method AffiliateLevelQuery rightJoinAffiliateUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateUser relation
 * @method AffiliateLevelQuery innerJoinAffiliateUser($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateUser relation
 *
 * @method AffiliateLevel findOne(PropelPDO $con = null) Return the first AffiliateLevel matching the query
 * @method AffiliateLevel findOneOrCreate(PropelPDO $con = null) Return the first AffiliateLevel matching the query, or a new AffiliateLevel object populated from the query conditions when no match is found
 *
 * @method AffiliateLevel findOneById(int $id) Return the first AffiliateLevel filtered by the id column
 * @method AffiliateLevel findOneByName(string $name) Return the first AffiliateLevel filtered by the name column
 * @method AffiliateLevel findOneByBitlevel(int $bitLevel) Return the first AffiliateLevel filtered by the bitLevel column
 *
 * @method array findById(int $id) Return AffiliateLevel objects filtered by the id column
 * @method array findByName(string $name) Return AffiliateLevel objects filtered by the name column
 * @method array findByBitlevel(int $bitLevel) Return AffiliateLevel objects filtered by the bitLevel column
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateLevelQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAffiliateLevelQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'AffiliateLevel', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AffiliateLevelQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AffiliateLevelQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AffiliateLevelQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AffiliateLevelQuery) {
            return $criteria;
        }
        $query = new AffiliateLevelQuery();
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
     * @return   AffiliateLevel|AffiliateLevel[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AffiliateLevelPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AffiliateLevelPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   AffiliateLevel A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `BITLEVEL` FROM `affiliates_level` WHERE `ID` = :p0';
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
            $obj = new AffiliateLevel();
            $obj->hydrate($row);
            AffiliateLevelPeer::addInstanceToPool($obj, (string) $key);
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
     * @return AffiliateLevel|AffiliateLevel[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|AffiliateLevel[]|mixed the list of results, formatted by the current formatter
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
     * @return AffiliateLevelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AffiliateLevelPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AffiliateLevelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AffiliateLevelPeer::ID, $keys, Criteria::IN);
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
     * @return AffiliateLevelQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AffiliateLevelPeer::ID, $id, $comparison);
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
     * @return AffiliateLevelQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateLevelPeer::NAME, $name, $comparison);
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
     * @return AffiliateLevelQuery The current query, for fluid interface
     */
    public function filterByBitlevel($bitlevel = null, $comparison = null)
    {
        if (is_array($bitlevel)) {
            $useMinMax = false;
            if (isset($bitlevel['min'])) {
                $this->addUsingAlias(AffiliateLevelPeer::BITLEVEL, $bitlevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bitlevel['max'])) {
                $this->addUsingAlias(AffiliateLevelPeer::BITLEVEL, $bitlevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliateLevelPeer::BITLEVEL, $bitlevel, $comparison);
    }

    /**
     * Filter the query by a related AffiliateUser object
     *
     * @param   AffiliateUser|PropelObjectCollection $affiliateUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateLevelQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateUser($affiliateUser, $comparison = null)
    {
        if ($affiliateUser instanceof AffiliateUser) {
            return $this
                ->addUsingAlias(AffiliateLevelPeer::ID, $affiliateUser->getLevelid(), $comparison);
        } elseif ($affiliateUser instanceof PropelObjectCollection) {
            return $this
                ->useAffiliateUserQuery()
                ->filterByPrimaryKeys($affiliateUser->getPrimaryKeys())
                ->endUse();
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
     * @return AffiliateLevelQuery The current query, for fluid interface
     */
    public function joinAffiliateUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useAffiliateUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAffiliateUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateUser', 'AffiliateUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   AffiliateLevel $affiliateLevel Object to remove from the list of results
     *
     * @return AffiliateLevelQuery The current query, for fluid interface
     */
    public function prune($affiliateLevel = null)
    {
        if ($affiliateLevel) {
            $this->addUsingAlias(AffiliateLevelPeer::ID, $affiliateLevel->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
