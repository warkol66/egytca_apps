<?php


/**
 * Base class that represents a query for the 'requirements_development' table.
 *
 * Desarrollo
 *
 * @method DevelopmentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DevelopmentQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method DevelopmentQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method DevelopmentQuery orderByOutput($order = Criteria::ASC) Order by the output column
 * @method DevelopmentQuery orderByInput($order = Criteria::ASC) Order by the input column
 * @method DevelopmentQuery orderByProcess($order = Criteria::ASC) Order by the process column
 * @method DevelopmentQuery orderByOther($order = Criteria::ASC) Order by the other column
 * @method DevelopmentQuery orderByEstimateddelivery($order = Criteria::ASC) Order by the estimatedDelivery column
 * @method DevelopmentQuery orderByRealdelivery($order = Criteria::ASC) Order by the realDelivery column
 * @method DevelopmentQuery orderByDelivered($order = Criteria::ASC) Order by the delivered column
 * @method DevelopmentQuery orderByClientid($order = Criteria::ASC) Order by the clientId column
 * @method DevelopmentQuery orderByEstimatedhours($order = Criteria::ASC) Order by the estimatedHours column
 * @method DevelopmentQuery orderByEstimatedcost($order = Criteria::ASC) Order by the estimatedCost column
 * @method DevelopmentQuery orderByRealhours($order = Criteria::ASC) Order by the realHours column
 * @method DevelopmentQuery orderByRealcost($order = Criteria::ASC) Order by the realCost column
 * @method DevelopmentQuery orderByQuotation($order = Criteria::ASC) Order by the quotation column
 * @method DevelopmentQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method DevelopmentQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method DevelopmentQuery groupById() Group by the id column
 * @method DevelopmentQuery groupByName() Group by the name column
 * @method DevelopmentQuery groupByDescription() Group by the description column
 * @method DevelopmentQuery groupByOutput() Group by the output column
 * @method DevelopmentQuery groupByInput() Group by the input column
 * @method DevelopmentQuery groupByProcess() Group by the process column
 * @method DevelopmentQuery groupByOther() Group by the other column
 * @method DevelopmentQuery groupByEstimateddelivery() Group by the estimatedDelivery column
 * @method DevelopmentQuery groupByRealdelivery() Group by the realDelivery column
 * @method DevelopmentQuery groupByDelivered() Group by the delivered column
 * @method DevelopmentQuery groupByClientid() Group by the clientId column
 * @method DevelopmentQuery groupByEstimatedhours() Group by the estimatedHours column
 * @method DevelopmentQuery groupByEstimatedcost() Group by the estimatedCost column
 * @method DevelopmentQuery groupByRealhours() Group by the realHours column
 * @method DevelopmentQuery groupByRealcost() Group by the realCost column
 * @method DevelopmentQuery groupByQuotation() Group by the quotation column
 * @method DevelopmentQuery groupByCreatedAt() Group by the created_at column
 * @method DevelopmentQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method DevelopmentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DevelopmentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DevelopmentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DevelopmentQuery leftJoinAffiliate($relationAlias = null) Adds a LEFT JOIN clause to the query using the Affiliate relation
 * @method DevelopmentQuery rightJoinAffiliate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Affiliate relation
 * @method DevelopmentQuery innerJoinAffiliate($relationAlias = null) Adds a INNER JOIN clause to the query using the Affiliate relation
 *
 * @method DevelopmentQuery leftJoinRequirement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requirement relation
 * @method DevelopmentQuery rightJoinRequirement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requirement relation
 * @method DevelopmentQuery innerJoinRequirement($relationAlias = null) Adds a INNER JOIN clause to the query using the Requirement relation
 *
 * @method Development findOne(PropelPDO $con = null) Return the first Development matching the query
 * @method Development findOneOrCreate(PropelPDO $con = null) Return the first Development matching the query, or a new Development object populated from the query conditions when no match is found
 *
 * @method Development findOneById(int $id) Return the first Development filtered by the id column
 * @method Development findOneByName(string $name) Return the first Development filtered by the name column
 * @method Development findOneByDescription(string $description) Return the first Development filtered by the description column
 * @method Development findOneByOutput(string $output) Return the first Development filtered by the output column
 * @method Development findOneByInput(string $input) Return the first Development filtered by the input column
 * @method Development findOneByProcess(string $process) Return the first Development filtered by the process column
 * @method Development findOneByOther(string $other) Return the first Development filtered by the other column
 * @method Development findOneByEstimateddelivery(string $estimatedDelivery) Return the first Development filtered by the estimatedDelivery column
 * @method Development findOneByRealdelivery(string $realDelivery) Return the first Development filtered by the realDelivery column
 * @method Development findOneByDelivered(boolean $delivered) Return the first Development filtered by the delivered column
 * @method Development findOneByClientid(int $clientId) Return the first Development filtered by the clientId column
 * @method Development findOneByEstimatedhours(double $estimatedHours) Return the first Development filtered by the estimatedHours column
 * @method Development findOneByEstimatedcost(double $estimatedCost) Return the first Development filtered by the estimatedCost column
 * @method Development findOneByRealhours(double $realHours) Return the first Development filtered by the realHours column
 * @method Development findOneByRealcost(double $realCost) Return the first Development filtered by the realCost column
 * @method Development findOneByQuotation(double $quotation) Return the first Development filtered by the quotation column
 * @method Development findOneByCreatedAt(string $created_at) Return the first Development filtered by the created_at column
 * @method Development findOneByUpdatedAt(string $updated_at) Return the first Development filtered by the updated_at column
 *
 * @method array findById(int $id) Return Development objects filtered by the id column
 * @method array findByName(string $name) Return Development objects filtered by the name column
 * @method array findByDescription(string $description) Return Development objects filtered by the description column
 * @method array findByOutput(string $output) Return Development objects filtered by the output column
 * @method array findByInput(string $input) Return Development objects filtered by the input column
 * @method array findByProcess(string $process) Return Development objects filtered by the process column
 * @method array findByOther(string $other) Return Development objects filtered by the other column
 * @method array findByEstimateddelivery(string $estimatedDelivery) Return Development objects filtered by the estimatedDelivery column
 * @method array findByRealdelivery(string $realDelivery) Return Development objects filtered by the realDelivery column
 * @method array findByDelivered(boolean $delivered) Return Development objects filtered by the delivered column
 * @method array findByClientid(int $clientId) Return Development objects filtered by the clientId column
 * @method array findByEstimatedhours(double $estimatedHours) Return Development objects filtered by the estimatedHours column
 * @method array findByEstimatedcost(double $estimatedCost) Return Development objects filtered by the estimatedCost column
 * @method array findByRealhours(double $realHours) Return Development objects filtered by the realHours column
 * @method array findByRealcost(double $realCost) Return Development objects filtered by the realCost column
 * @method array findByQuotation(double $quotation) Return Development objects filtered by the quotation column
 * @method array findByCreatedAt(string $created_at) Return Development objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Development objects filtered by the updated_at column
 *
 * @package    propel.generator.requirements.classes.om
 */
abstract class BaseDevelopmentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDevelopmentQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'Development', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DevelopmentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DevelopmentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DevelopmentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DevelopmentQuery) {
            return $criteria;
        }
        $query = new DevelopmentQuery();
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
     * @return   Development|Development[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DevelopmentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Development A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `DESCRIPTION`, `OUTPUT`, `INPUT`, `PROCESS`, `OTHER`, `ESTIMATEDDELIVERY`, `REALDELIVERY`, `DELIVERED`, `CLIENTID`, `ESTIMATEDHOURS`, `ESTIMATEDCOST`, `REALHOURS`, `REALCOST`, `QUOTATION`, `CREATED_AT`, `UPDATED_AT` FROM `requirements_development` WHERE `ID` = :p0';
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
            $obj = new Development();
            $obj->hydrate($row);
            DevelopmentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Development|Development[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Development[]|mixed the list of results, formatted by the current formatter
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
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DevelopmentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DevelopmentPeer::ID, $keys, Criteria::IN);
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
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DevelopmentPeer::ID, $id, $comparison);
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
     * @return DevelopmentQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DevelopmentPeer::NAME, $name, $comparison);
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
     * @return DevelopmentQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DevelopmentPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the output column
     *
     * Example usage:
     * <code>
     * $query->filterByOutput('fooValue');   // WHERE output = 'fooValue'
     * $query->filterByOutput('%fooValue%'); // WHERE output LIKE '%fooValue%'
     * </code>
     *
     * @param     string $output The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByOutput($output = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($output)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $output)) {
                $output = str_replace('*', '%', $output);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::OUTPUT, $output, $comparison);
    }

    /**
     * Filter the query on the input column
     *
     * Example usage:
     * <code>
     * $query->filterByInput('fooValue');   // WHERE input = 'fooValue'
     * $query->filterByInput('%fooValue%'); // WHERE input LIKE '%fooValue%'
     * </code>
     *
     * @param     string $input The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByInput($input = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($input)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $input)) {
                $input = str_replace('*', '%', $input);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::INPUT, $input, $comparison);
    }

    /**
     * Filter the query on the process column
     *
     * Example usage:
     * <code>
     * $query->filterByProcess('fooValue');   // WHERE process = 'fooValue'
     * $query->filterByProcess('%fooValue%'); // WHERE process LIKE '%fooValue%'
     * </code>
     *
     * @param     string $process The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByProcess($process = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($process)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $process)) {
                $process = str_replace('*', '%', $process);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::PROCESS, $process, $comparison);
    }

    /**
     * Filter the query on the other column
     *
     * Example usage:
     * <code>
     * $query->filterByOther('fooValue');   // WHERE other = 'fooValue'
     * $query->filterByOther('%fooValue%'); // WHERE other LIKE '%fooValue%'
     * </code>
     *
     * @param     string $other The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByOther($other = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($other)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $other)) {
                $other = str_replace('*', '%', $other);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::OTHER, $other, $comparison);
    }

    /**
     * Filter the query on the estimatedDelivery column
     *
     * Example usage:
     * <code>
     * $query->filterByEstimateddelivery('2011-03-14'); // WHERE estimatedDelivery = '2011-03-14'
     * $query->filterByEstimateddelivery('now'); // WHERE estimatedDelivery = '2011-03-14'
     * $query->filterByEstimateddelivery(array('max' => 'yesterday')); // WHERE estimatedDelivery > '2011-03-13'
     * </code>
     *
     * @param     mixed $estimateddelivery The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByEstimateddelivery($estimateddelivery = null, $comparison = null)
    {
        if (is_array($estimateddelivery)) {
            $useMinMax = false;
            if (isset($estimateddelivery['min'])) {
                $this->addUsingAlias(DevelopmentPeer::ESTIMATEDDELIVERY, $estimateddelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimateddelivery['max'])) {
                $this->addUsingAlias(DevelopmentPeer::ESTIMATEDDELIVERY, $estimateddelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::ESTIMATEDDELIVERY, $estimateddelivery, $comparison);
    }

    /**
     * Filter the query on the realDelivery column
     *
     * Example usage:
     * <code>
     * $query->filterByRealdelivery('2011-03-14'); // WHERE realDelivery = '2011-03-14'
     * $query->filterByRealdelivery('now'); // WHERE realDelivery = '2011-03-14'
     * $query->filterByRealdelivery(array('max' => 'yesterday')); // WHERE realDelivery > '2011-03-13'
     * </code>
     *
     * @param     mixed $realdelivery The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByRealdelivery($realdelivery = null, $comparison = null)
    {
        if (is_array($realdelivery)) {
            $useMinMax = false;
            if (isset($realdelivery['min'])) {
                $this->addUsingAlias(DevelopmentPeer::REALDELIVERY, $realdelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realdelivery['max'])) {
                $this->addUsingAlias(DevelopmentPeer::REALDELIVERY, $realdelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::REALDELIVERY, $realdelivery, $comparison);
    }

    /**
     * Filter the query on the delivered column
     *
     * Example usage:
     * <code>
     * $query->filterByDelivered(true); // WHERE delivered = true
     * $query->filterByDelivered('yes'); // WHERE delivered = true
     * </code>
     *
     * @param     boolean|string $delivered The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByDelivered($delivered = null, $comparison = null)
    {
        if (is_string($delivered)) {
            $delivered = in_array(strtolower($delivered), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DevelopmentPeer::DELIVERED, $delivered, $comparison);
    }

    /**
     * Filter the query on the clientId column
     *
     * Example usage:
     * <code>
     * $query->filterByClientid(1234); // WHERE clientId = 1234
     * $query->filterByClientid(array(12, 34)); // WHERE clientId IN (12, 34)
     * $query->filterByClientid(array('min' => 12)); // WHERE clientId > 12
     * </code>
     *
     * @see       filterByAffiliate()
     *
     * @param     mixed $clientid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByClientid($clientid = null, $comparison = null)
    {
        if (is_array($clientid)) {
            $useMinMax = false;
            if (isset($clientid['min'])) {
                $this->addUsingAlias(DevelopmentPeer::CLIENTID, $clientid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientid['max'])) {
                $this->addUsingAlias(DevelopmentPeer::CLIENTID, $clientid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::CLIENTID, $clientid, $comparison);
    }

    /**
     * Filter the query on the estimatedHours column
     *
     * Example usage:
     * <code>
     * $query->filterByEstimatedhours(1234); // WHERE estimatedHours = 1234
     * $query->filterByEstimatedhours(array(12, 34)); // WHERE estimatedHours IN (12, 34)
     * $query->filterByEstimatedhours(array('min' => 12)); // WHERE estimatedHours > 12
     * </code>
     *
     * @param     mixed $estimatedhours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByEstimatedhours($estimatedhours = null, $comparison = null)
    {
        if (is_array($estimatedhours)) {
            $useMinMax = false;
            if (isset($estimatedhours['min'])) {
                $this->addUsingAlias(DevelopmentPeer::ESTIMATEDHOURS, $estimatedhours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimatedhours['max'])) {
                $this->addUsingAlias(DevelopmentPeer::ESTIMATEDHOURS, $estimatedhours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::ESTIMATEDHOURS, $estimatedhours, $comparison);
    }

    /**
     * Filter the query on the estimatedCost column
     *
     * Example usage:
     * <code>
     * $query->filterByEstimatedcost(1234); // WHERE estimatedCost = 1234
     * $query->filterByEstimatedcost(array(12, 34)); // WHERE estimatedCost IN (12, 34)
     * $query->filterByEstimatedcost(array('min' => 12)); // WHERE estimatedCost > 12
     * </code>
     *
     * @param     mixed $estimatedcost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByEstimatedcost($estimatedcost = null, $comparison = null)
    {
        if (is_array($estimatedcost)) {
            $useMinMax = false;
            if (isset($estimatedcost['min'])) {
                $this->addUsingAlias(DevelopmentPeer::ESTIMATEDCOST, $estimatedcost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimatedcost['max'])) {
                $this->addUsingAlias(DevelopmentPeer::ESTIMATEDCOST, $estimatedcost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::ESTIMATEDCOST, $estimatedcost, $comparison);
    }

    /**
     * Filter the query on the realHours column
     *
     * Example usage:
     * <code>
     * $query->filterByRealhours(1234); // WHERE realHours = 1234
     * $query->filterByRealhours(array(12, 34)); // WHERE realHours IN (12, 34)
     * $query->filterByRealhours(array('min' => 12)); // WHERE realHours > 12
     * </code>
     *
     * @param     mixed $realhours The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByRealhours($realhours = null, $comparison = null)
    {
        if (is_array($realhours)) {
            $useMinMax = false;
            if (isset($realhours['min'])) {
                $this->addUsingAlias(DevelopmentPeer::REALHOURS, $realhours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realhours['max'])) {
                $this->addUsingAlias(DevelopmentPeer::REALHOURS, $realhours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::REALHOURS, $realhours, $comparison);
    }

    /**
     * Filter the query on the realCost column
     *
     * Example usage:
     * <code>
     * $query->filterByRealcost(1234); // WHERE realCost = 1234
     * $query->filterByRealcost(array(12, 34)); // WHERE realCost IN (12, 34)
     * $query->filterByRealcost(array('min' => 12)); // WHERE realCost > 12
     * </code>
     *
     * @param     mixed $realcost The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByRealcost($realcost = null, $comparison = null)
    {
        if (is_array($realcost)) {
            $useMinMax = false;
            if (isset($realcost['min'])) {
                $this->addUsingAlias(DevelopmentPeer::REALCOST, $realcost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realcost['max'])) {
                $this->addUsingAlias(DevelopmentPeer::REALCOST, $realcost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::REALCOST, $realcost, $comparison);
    }

    /**
     * Filter the query on the quotation column
     *
     * Example usage:
     * <code>
     * $query->filterByQuotation(1234); // WHERE quotation = 1234
     * $query->filterByQuotation(array(12, 34)); // WHERE quotation IN (12, 34)
     * $query->filterByQuotation(array('min' => 12)); // WHERE quotation > 12
     * </code>
     *
     * @param     mixed $quotation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByQuotation($quotation = null, $comparison = null)
    {
        if (is_array($quotation)) {
            $useMinMax = false;
            if (isset($quotation['min'])) {
                $this->addUsingAlias(DevelopmentPeer::QUOTATION, $quotation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quotation['max'])) {
                $this->addUsingAlias(DevelopmentPeer::QUOTATION, $quotation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::QUOTATION, $quotation, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DevelopmentPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DevelopmentPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DevelopmentPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DevelopmentPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DevelopmentPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Affiliate object
     *
     * @param   Affiliate|PropelObjectCollection $affiliate The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DevelopmentQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliate($affiliate, $comparison = null)
    {
        if ($affiliate instanceof Affiliate) {
            return $this
                ->addUsingAlias(DevelopmentPeer::CLIENTID, $affiliate->getId(), $comparison);
        } elseif ($affiliate instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DevelopmentPeer::CLIENTID, $affiliate->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAffiliate() only accepts arguments of type Affiliate or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Affiliate relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function joinAffiliate($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Affiliate');

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
            $this->addJoinObject($join, 'Affiliate');
        }

        return $this;
    }

    /**
     * Use the Affiliate relation Affiliate object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAffiliate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Affiliate', 'AffiliateQuery');
    }

    /**
     * Filter the query by a related Requirement object
     *
     * @param   Requirement|PropelObjectCollection $requirement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DevelopmentQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRequirement($requirement, $comparison = null)
    {
        if ($requirement instanceof Requirement) {
            return $this
                ->addUsingAlias(DevelopmentPeer::ID, $requirement->getDevelopmentid(), $comparison);
        } elseif ($requirement instanceof PropelObjectCollection) {
            return $this
                ->useRequirementQuery()
                ->filterByPrimaryKeys($requirement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRequirement() only accepts arguments of type Requirement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Requirement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function joinRequirement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Requirement');

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
            $this->addJoinObject($join, 'Requirement');
        }

        return $this;
    }

    /**
     * Use the Requirement relation Requirement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   RequirementQuery A secondary query class using the current class as primary query
     */
    public function useRequirementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRequirement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Requirement', 'RequirementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Development $development Object to remove from the list of results
     *
     * @return DevelopmentQuery The current query, for fluid interface
     */
    public function prune($development = null)
    {
        if ($development) {
            $this->addUsingAlias(DevelopmentPeer::ID, $development->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     DevelopmentQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DevelopmentPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     DevelopmentQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DevelopmentPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     DevelopmentQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DevelopmentPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     DevelopmentQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DevelopmentPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     DevelopmentQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DevelopmentPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     DevelopmentQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DevelopmentPeer::CREATED_AT);
    }
}
