<?php


/**
 * Base class that represents a query for the 'requirements_requirement' table.
 *
 * Requerimientos
 *
 * @method RequirementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method RequirementQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method RequirementQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method RequirementQuery orderByOutput($order = Criteria::ASC) Order by the output column
 * @method RequirementQuery orderByInput($order = Criteria::ASC) Order by the input column
 * @method RequirementQuery orderByProcess($order = Criteria::ASC) Order by the process column
 * @method RequirementQuery orderByOther($order = Criteria::ASC) Order by the other column
 * @method RequirementQuery orderByEstimateddelivery($order = Criteria::ASC) Order by the estimatedDelivery column
 * @method RequirementQuery orderByRealdelivery($order = Criteria::ASC) Order by the realDelivery column
 * @method RequirementQuery orderByDelivered($order = Criteria::ASC) Order by the delivered column
 * @method RequirementQuery orderByDevelopmentid($order = Criteria::ASC) Order by the developmentId column
 * @method RequirementQuery orderByClientid($order = Criteria::ASC) Order by the clientId column
 * @method RequirementQuery orderByEstimatedhours($order = Criteria::ASC) Order by the estimatedHours column
 * @method RequirementQuery orderByEstimatedcost($order = Criteria::ASC) Order by the estimatedCost column
 * @method RequirementQuery orderByRealhours($order = Criteria::ASC) Order by the realHours column
 * @method RequirementQuery orderByRealcost($order = Criteria::ASC) Order by the realCost column
 * @method RequirementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method RequirementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method RequirementQuery groupById() Group by the id column
 * @method RequirementQuery groupByName() Group by the name column
 * @method RequirementQuery groupByDescription() Group by the description column
 * @method RequirementQuery groupByOutput() Group by the output column
 * @method RequirementQuery groupByInput() Group by the input column
 * @method RequirementQuery groupByProcess() Group by the process column
 * @method RequirementQuery groupByOther() Group by the other column
 * @method RequirementQuery groupByEstimateddelivery() Group by the estimatedDelivery column
 * @method RequirementQuery groupByRealdelivery() Group by the realDelivery column
 * @method RequirementQuery groupByDelivered() Group by the delivered column
 * @method RequirementQuery groupByDevelopmentid() Group by the developmentId column
 * @method RequirementQuery groupByClientid() Group by the clientId column
 * @method RequirementQuery groupByEstimatedhours() Group by the estimatedHours column
 * @method RequirementQuery groupByEstimatedcost() Group by the estimatedCost column
 * @method RequirementQuery groupByRealhours() Group by the realHours column
 * @method RequirementQuery groupByRealcost() Group by the realCost column
 * @method RequirementQuery groupByCreatedAt() Group by the created_at column
 * @method RequirementQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method RequirementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RequirementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RequirementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RequirementQuery leftJoinDevelopment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Development relation
 * @method RequirementQuery rightJoinDevelopment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Development relation
 * @method RequirementQuery innerJoinDevelopment($relationAlias = null) Adds a INNER JOIN clause to the query using the Development relation
 *
 * @method RequirementQuery leftJoinAffiliate($relationAlias = null) Adds a LEFT JOIN clause to the query using the Affiliate relation
 * @method RequirementQuery rightJoinAffiliate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Affiliate relation
 * @method RequirementQuery innerJoinAffiliate($relationAlias = null) Adds a INNER JOIN clause to the query using the Affiliate relation
 *
 * @method Requirement findOne(PropelPDO $con = null) Return the first Requirement matching the query
 * @method Requirement findOneOrCreate(PropelPDO $con = null) Return the first Requirement matching the query, or a new Requirement object populated from the query conditions when no match is found
 *
 * @method Requirement findOneById(int $id) Return the first Requirement filtered by the id column
 * @method Requirement findOneByName(string $name) Return the first Requirement filtered by the name column
 * @method Requirement findOneByDescription(string $description) Return the first Requirement filtered by the description column
 * @method Requirement findOneByOutput(string $output) Return the first Requirement filtered by the output column
 * @method Requirement findOneByInput(string $input) Return the first Requirement filtered by the input column
 * @method Requirement findOneByProcess(string $process) Return the first Requirement filtered by the process column
 * @method Requirement findOneByOther(string $other) Return the first Requirement filtered by the other column
 * @method Requirement findOneByEstimateddelivery(string $estimatedDelivery) Return the first Requirement filtered by the estimatedDelivery column
 * @method Requirement findOneByRealdelivery(string $realDelivery) Return the first Requirement filtered by the realDelivery column
 * @method Requirement findOneByDelivered(boolean $delivered) Return the first Requirement filtered by the delivered column
 * @method Requirement findOneByDevelopmentid(int $developmentId) Return the first Requirement filtered by the developmentId column
 * @method Requirement findOneByClientid(int $clientId) Return the first Requirement filtered by the clientId column
 * @method Requirement findOneByEstimatedhours(double $estimatedHours) Return the first Requirement filtered by the estimatedHours column
 * @method Requirement findOneByEstimatedcost(double $estimatedCost) Return the first Requirement filtered by the estimatedCost column
 * @method Requirement findOneByRealhours(double $realHours) Return the first Requirement filtered by the realHours column
 * @method Requirement findOneByRealcost(double $realCost) Return the first Requirement filtered by the realCost column
 * @method Requirement findOneByCreatedAt(string $created_at) Return the first Requirement filtered by the created_at column
 * @method Requirement findOneByUpdatedAt(string $updated_at) Return the first Requirement filtered by the updated_at column
 *
 * @method array findById(int $id) Return Requirement objects filtered by the id column
 * @method array findByName(string $name) Return Requirement objects filtered by the name column
 * @method array findByDescription(string $description) Return Requirement objects filtered by the description column
 * @method array findByOutput(string $output) Return Requirement objects filtered by the output column
 * @method array findByInput(string $input) Return Requirement objects filtered by the input column
 * @method array findByProcess(string $process) Return Requirement objects filtered by the process column
 * @method array findByOther(string $other) Return Requirement objects filtered by the other column
 * @method array findByEstimateddelivery(string $estimatedDelivery) Return Requirement objects filtered by the estimatedDelivery column
 * @method array findByRealdelivery(string $realDelivery) Return Requirement objects filtered by the realDelivery column
 * @method array findByDelivered(boolean $delivered) Return Requirement objects filtered by the delivered column
 * @method array findByDevelopmentid(int $developmentId) Return Requirement objects filtered by the developmentId column
 * @method array findByClientid(int $clientId) Return Requirement objects filtered by the clientId column
 * @method array findByEstimatedhours(double $estimatedHours) Return Requirement objects filtered by the estimatedHours column
 * @method array findByEstimatedcost(double $estimatedCost) Return Requirement objects filtered by the estimatedCost column
 * @method array findByRealhours(double $realHours) Return Requirement objects filtered by the realHours column
 * @method array findByRealcost(double $realCost) Return Requirement objects filtered by the realCost column
 * @method array findByCreatedAt(string $created_at) Return Requirement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Requirement objects filtered by the updated_at column
 *
 * @package    propel.generator.requirements.classes.om
 */
abstract class BaseRequirementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRequirementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'Requirement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RequirementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     RequirementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RequirementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RequirementQuery) {
            return $criteria;
        }
        $query = new RequirementQuery();
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
     * @return   Requirement|Requirement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RequirementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RequirementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Requirement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `DESCRIPTION`, `OUTPUT`, `INPUT`, `PROCESS`, `OTHER`, `ESTIMATEDDELIVERY`, `REALDELIVERY`, `DELIVERED`, `DEVELOPMENTID`, `CLIENTID`, `ESTIMATEDHOURS`, `ESTIMATEDCOST`, `REALHOURS`, `REALCOST`, `CREATED_AT`, `UPDATED_AT` FROM `requirements_requirement` WHERE `ID` = :p0';
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
            $obj = new Requirement();
            $obj->hydrate($row);
            RequirementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Requirement|Requirement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Requirement[]|mixed the list of results, formatted by the current formatter
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RequirementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RequirementPeer::ID, $keys, Criteria::IN);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(RequirementPeer::ID, $id, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RequirementPeer::NAME, $name, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RequirementPeer::DESCRIPTION, $description, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RequirementPeer::OUTPUT, $output, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RequirementPeer::INPUT, $input, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RequirementPeer::PROCESS, $process, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RequirementPeer::OTHER, $other, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByEstimateddelivery($estimateddelivery = null, $comparison = null)
    {
        if (is_array($estimateddelivery)) {
            $useMinMax = false;
            if (isset($estimateddelivery['min'])) {
                $this->addUsingAlias(RequirementPeer::ESTIMATEDDELIVERY, $estimateddelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimateddelivery['max'])) {
                $this->addUsingAlias(RequirementPeer::ESTIMATEDDELIVERY, $estimateddelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::ESTIMATEDDELIVERY, $estimateddelivery, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByRealdelivery($realdelivery = null, $comparison = null)
    {
        if (is_array($realdelivery)) {
            $useMinMax = false;
            if (isset($realdelivery['min'])) {
                $this->addUsingAlias(RequirementPeer::REALDELIVERY, $realdelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realdelivery['max'])) {
                $this->addUsingAlias(RequirementPeer::REALDELIVERY, $realdelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::REALDELIVERY, $realdelivery, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByDelivered($delivered = null, $comparison = null)
    {
        if (is_string($delivered)) {
            $delivered = in_array(strtolower($delivered), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RequirementPeer::DELIVERED, $delivered, $comparison);
    }

    /**
     * Filter the query on the developmentId column
     *
     * Example usage:
     * <code>
     * $query->filterByDevelopmentid(1234); // WHERE developmentId = 1234
     * $query->filterByDevelopmentid(array(12, 34)); // WHERE developmentId IN (12, 34)
     * $query->filterByDevelopmentid(array('min' => 12)); // WHERE developmentId > 12
     * </code>
     *
     * @see       filterByDevelopment()
     *
     * @param     mixed $developmentid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByDevelopmentid($developmentid = null, $comparison = null)
    {
        if (is_array($developmentid)) {
            $useMinMax = false;
            if (isset($developmentid['min'])) {
                $this->addUsingAlias(RequirementPeer::DEVELOPMENTID, $developmentid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($developmentid['max'])) {
                $this->addUsingAlias(RequirementPeer::DEVELOPMENTID, $developmentid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::DEVELOPMENTID, $developmentid, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByClientid($clientid = null, $comparison = null)
    {
        if (is_array($clientid)) {
            $useMinMax = false;
            if (isset($clientid['min'])) {
                $this->addUsingAlias(RequirementPeer::CLIENTID, $clientid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientid['max'])) {
                $this->addUsingAlias(RequirementPeer::CLIENTID, $clientid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::CLIENTID, $clientid, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByEstimatedhours($estimatedhours = null, $comparison = null)
    {
        if (is_array($estimatedhours)) {
            $useMinMax = false;
            if (isset($estimatedhours['min'])) {
                $this->addUsingAlias(RequirementPeer::ESTIMATEDHOURS, $estimatedhours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimatedhours['max'])) {
                $this->addUsingAlias(RequirementPeer::ESTIMATEDHOURS, $estimatedhours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::ESTIMATEDHOURS, $estimatedhours, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByEstimatedcost($estimatedcost = null, $comparison = null)
    {
        if (is_array($estimatedcost)) {
            $useMinMax = false;
            if (isset($estimatedcost['min'])) {
                $this->addUsingAlias(RequirementPeer::ESTIMATEDCOST, $estimatedcost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($estimatedcost['max'])) {
                $this->addUsingAlias(RequirementPeer::ESTIMATEDCOST, $estimatedcost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::ESTIMATEDCOST, $estimatedcost, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByRealhours($realhours = null, $comparison = null)
    {
        if (is_array($realhours)) {
            $useMinMax = false;
            if (isset($realhours['min'])) {
                $this->addUsingAlias(RequirementPeer::REALHOURS, $realhours['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realhours['max'])) {
                $this->addUsingAlias(RequirementPeer::REALHOURS, $realhours['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::REALHOURS, $realhours, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByRealcost($realcost = null, $comparison = null)
    {
        if (is_array($realcost)) {
            $useMinMax = false;
            if (isset($realcost['min'])) {
                $this->addUsingAlias(RequirementPeer::REALCOST, $realcost['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realcost['max'])) {
                $this->addUsingAlias(RequirementPeer::REALCOST, $realcost['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::REALCOST, $realcost, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RequirementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RequirementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RequirementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RequirementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RequirementPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Development object
     *
     * @param   Development|PropelObjectCollection $development The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   RequirementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDevelopment($development, $comparison = null)
    {
        if ($development instanceof Development) {
            return $this
                ->addUsingAlias(RequirementPeer::DEVELOPMENTID, $development->getId(), $comparison);
        } elseif ($development instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RequirementPeer::DEVELOPMENTID, $development->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDevelopment() only accepts arguments of type Development or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Development relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RequirementQuery The current query, for fluid interface
     */
    public function joinDevelopment($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Development');

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
            $this->addJoinObject($join, 'Development');
        }

        return $this;
    }

    /**
     * Use the Development relation Development object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   DevelopmentQuery A secondary query class using the current class as primary query
     */
    public function useDevelopmentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDevelopment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Development', 'DevelopmentQuery');
    }

    /**
     * Filter the query by a related Affiliate object
     *
     * @param   Affiliate|PropelObjectCollection $affiliate The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   RequirementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliate($affiliate, $comparison = null)
    {
        if ($affiliate instanceof Affiliate) {
            return $this
                ->addUsingAlias(RequirementPeer::CLIENTID, $affiliate->getId(), $comparison);
        } elseif ($affiliate instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RequirementPeer::CLIENTID, $affiliate->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return RequirementQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Requirement $requirement Object to remove from the list of results
     *
     * @return RequirementQuery The current query, for fluid interface
     */
    public function prune($requirement = null)
    {
        if ($requirement) {
            $this->addUsingAlias(RequirementPeer::ID, $requirement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     RequirementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(RequirementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     RequirementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(RequirementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     RequirementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(RequirementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     RequirementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(RequirementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     RequirementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(RequirementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     RequirementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(RequirementPeer::CREATED_AT);
    }
}
