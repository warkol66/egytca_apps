<?php


/**
 * Base class that represents a query for the 'resources_resource' table.
 *
 * Recursos
 *
 * @method ResourceQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ResourceQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method ResourceQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method ResourceQuery orderByPath($order = Criteria::ASC) Order by the path column
 *
 * @method ResourceQuery groupById() Group by the id column
 * @method ResourceQuery groupByTitle() Group by the title column
 * @method ResourceQuery groupByDescription() Group by the description column
 * @method ResourceQuery groupByPath() Group by the path column
 *
 * @method ResourceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ResourceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ResourceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ResourceQuery leftJoinAttendant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attendant relation
 * @method ResourceQuery rightJoinAttendant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attendant relation
 * @method ResourceQuery innerJoinAttendant($relationAlias = null) Adds a INNER JOIN clause to the query using the Attendant relation
 *
 * @method Resource findOne(PropelPDO $con = null) Return the first Resource matching the query
 * @method Resource findOneOrCreate(PropelPDO $con = null) Return the first Resource matching the query, or a new Resource object populated from the query conditions when no match is found
 *
 * @method Resource findOneById(int $id) Return the first Resource filtered by the id column
 * @method Resource findOneByTitle(string $title) Return the first Resource filtered by the title column
 * @method Resource findOneByDescription(string $description) Return the first Resource filtered by the description column
 * @method Resource findOneByPath(string $path) Return the first Resource filtered by the path column
 *
 * @method array findById(int $id) Return Resource objects filtered by the id column
 * @method array findByTitle(string $title) Return Resource objects filtered by the title column
 * @method array findByDescription(string $description) Return Resource objects filtered by the description column
 * @method array findByPath(string $path) Return Resource objects filtered by the path column
 *
 * @package    propel.generator.resources.classes.om
 */
abstract class BaseResourceQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseResourceQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'Resource', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ResourceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ResourceQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ResourceQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ResourceQuery) {
            return $criteria;
        }
        $query = new ResourceQuery();
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
     * @return   Resource|Resource[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ResourcePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ResourcePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Resource A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `TITLE`, `DESCRIPTION`, `PATH` FROM `resources_resource` WHERE `ID` = :p0';
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
            $obj = new Resource();
            $obj->hydrate($row);
            ResourcePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Resource|Resource[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Resource[]|mixed the list of results, formatted by the current formatter
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
     * @return ResourceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ResourcePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ResourceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ResourcePeer::ID, $keys, Criteria::IN);
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
     * @return ResourceQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ResourcePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResourceQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResourcePeer::TITLE, $title, $comparison);
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
     * @return ResourceQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ResourcePeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the path column
     *
     * Example usage:
     * <code>
     * $query->filterByPath('fooValue');   // WHERE path = 'fooValue'
     * $query->filterByPath('%fooValue%'); // WHERE path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $path The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResourceQuery The current query, for fluid interface
     */
    public function filterByPath($path = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($path)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $path)) {
                $path = str_replace('*', '%', $path);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResourcePeer::PATH, $path, $comparison);
    }

    /**
     * Filter the query by a related Attendant object
     *
     * @param   Attendant|PropelObjectCollection $attendant  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ResourceQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAttendant($attendant, $comparison = null)
    {
        if ($attendant instanceof Attendant) {
            return $this
                ->addUsingAlias(ResourcePeer::ID, $attendant->getAttendantid(), $comparison);
        } elseif ($attendant instanceof PropelObjectCollection) {
            return $this
                ->useAttendantQuery()
                ->filterByPrimaryKeys($attendant->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAttendant() only accepts arguments of type Attendant or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attendant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ResourceQuery The current query, for fluid interface
     */
    public function joinAttendant($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attendant');

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
            $this->addJoinObject($join, 'Attendant');
        }

        return $this;
    }

    /**
     * Use the Attendant relation Attendant object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AttendantQuery A secondary query class using the current class as primary query
     */
    public function useAttendantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttendant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attendant', 'AttendantQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Resource $resource Object to remove from the list of results
     *
     * @return ResourceQuery The current query, for fluid interface
     */
    public function prune($resource = null)
    {
        if ($resource) {
            $this->addUsingAlias(ResourcePeer::ID, $resource->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
