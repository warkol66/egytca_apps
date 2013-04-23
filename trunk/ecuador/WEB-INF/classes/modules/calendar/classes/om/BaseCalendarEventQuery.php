<?php


/**
 * Base class that represents a query for the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * @method CalendarEventQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CalendarEventQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method CalendarEventQuery orderBySummary($order = Criteria::ASC) Order by the summary column
 * @method CalendarEventQuery orderByBody($order = Criteria::ASC) Order by the body column
 * @method CalendarEventQuery orderByCreationdate($order = Criteria::ASC) Order by the creationDate column
 * @method CalendarEventQuery orderByStartdate($order = Criteria::ASC) Order by the startDate column
 * @method CalendarEventQuery orderByEnddate($order = Criteria::ASC) Order by the endDate column
 * @method CalendarEventQuery orderBySourcecontact($order = Criteria::ASC) Order by the sourceContact column
 * @method CalendarEventQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method CalendarEventQuery orderByRegionid($order = Criteria::ASC) Order by the regionId column
 * @method CalendarEventQuery orderByCategoryid($order = Criteria::ASC) Order by the categoryId column
 * @method CalendarEventQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method CalendarEventQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 *
 * @method CalendarEventQuery groupById() Group by the id column
 * @method CalendarEventQuery groupByTitle() Group by the title column
 * @method CalendarEventQuery groupBySummary() Group by the summary column
 * @method CalendarEventQuery groupByBody() Group by the body column
 * @method CalendarEventQuery groupByCreationdate() Group by the creationDate column
 * @method CalendarEventQuery groupByStartdate() Group by the startDate column
 * @method CalendarEventQuery groupByEnddate() Group by the endDate column
 * @method CalendarEventQuery groupBySourcecontact() Group by the sourceContact column
 * @method CalendarEventQuery groupByStatus() Group by the status column
 * @method CalendarEventQuery groupByRegionid() Group by the regionId column
 * @method CalendarEventQuery groupByCategoryid() Group by the categoryId column
 * @method CalendarEventQuery groupByUserid() Group by the userId column
 * @method CalendarEventQuery groupByDeletedAt() Group by the deleted_at column
 *
 * @method CalendarEventQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CalendarEventQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CalendarEventQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CalendarEventQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method CalendarEventQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method CalendarEventQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method CalendarEventQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method CalendarEventQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method CalendarEventQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method CalendarEventQuery leftJoinCalendarMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the CalendarMedia relation
 * @method CalendarEventQuery rightJoinCalendarMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CalendarMedia relation
 * @method CalendarEventQuery innerJoinCalendarMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the CalendarMedia relation
 *
 * @method CalendarEvent findOne(PropelPDO $con = null) Return the first CalendarEvent matching the query
 * @method CalendarEvent findOneOrCreate(PropelPDO $con = null) Return the first CalendarEvent matching the query, or a new CalendarEvent object populated from the query conditions when no match is found
 *
 * @method CalendarEvent findOneById(int $id) Return the first CalendarEvent filtered by the id column
 * @method CalendarEvent findOneByTitle(string $title) Return the first CalendarEvent filtered by the title column
 * @method CalendarEvent findOneBySummary(string $summary) Return the first CalendarEvent filtered by the summary column
 * @method CalendarEvent findOneByBody(string $body) Return the first CalendarEvent filtered by the body column
 * @method CalendarEvent findOneByCreationdate(string $creationDate) Return the first CalendarEvent filtered by the creationDate column
 * @method CalendarEvent findOneByStartdate(string $startDate) Return the first CalendarEvent filtered by the startDate column
 * @method CalendarEvent findOneByEnddate(string $endDate) Return the first CalendarEvent filtered by the endDate column
 * @method CalendarEvent findOneBySourcecontact(string $sourceContact) Return the first CalendarEvent filtered by the sourceContact column
 * @method CalendarEvent findOneByStatus(int $status) Return the first CalendarEvent filtered by the status column
 * @method CalendarEvent findOneByRegionid(int $regionId) Return the first CalendarEvent filtered by the regionId column
 * @method CalendarEvent findOneByCategoryid(int $categoryId) Return the first CalendarEvent filtered by the categoryId column
 * @method CalendarEvent findOneByUserid(int $userId) Return the first CalendarEvent filtered by the userId column
 * @method CalendarEvent findOneByDeletedAt(string $deleted_at) Return the first CalendarEvent filtered by the deleted_at column
 *
 * @method array findById(int $id) Return CalendarEvent objects filtered by the id column
 * @method array findByTitle(string $title) Return CalendarEvent objects filtered by the title column
 * @method array findBySummary(string $summary) Return CalendarEvent objects filtered by the summary column
 * @method array findByBody(string $body) Return CalendarEvent objects filtered by the body column
 * @method array findByCreationdate(string $creationDate) Return CalendarEvent objects filtered by the creationDate column
 * @method array findByStartdate(string $startDate) Return CalendarEvent objects filtered by the startDate column
 * @method array findByEnddate(string $endDate) Return CalendarEvent objects filtered by the endDate column
 * @method array findBySourcecontact(string $sourceContact) Return CalendarEvent objects filtered by the sourceContact column
 * @method array findByStatus(int $status) Return CalendarEvent objects filtered by the status column
 * @method array findByRegionid(int $regionId) Return CalendarEvent objects filtered by the regionId column
 * @method array findByCategoryid(int $categoryId) Return CalendarEvent objects filtered by the categoryId column
 * @method array findByUserid(int $userId) Return CalendarEvent objects filtered by the userId column
 * @method array findByDeletedAt(string $deleted_at) Return CalendarEvent objects filtered by the deleted_at column
 *
 * @package    propel.generator.calendar.classes.om
 */
abstract class BaseCalendarEventQuery extends ModelCriteria
{
    // soft_delete behavior
    protected static $softDelete = true;
    protected $localSoftDelete = true;

    /**
     * Initializes internal state of BaseCalendarEventQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'CalendarEvent', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CalendarEventQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CalendarEventQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CalendarEventQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CalendarEventQuery) {
            return $criteria;
        }
        $query = new CalendarEventQuery();
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
     * @return   CalendarEvent|CalendarEvent[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CalendarEventPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CalendarEvent A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `TITLE`, `SUMMARY`, `BODY`, `CREATIONDATE`, `STARTDATE`, `ENDDATE`, `SOURCECONTACT`, `STATUS`, `REGIONID`, `CATEGORYID`, `USERID`, `DELETED_AT` FROM `calendar_event` WHERE `ID` = :p0';
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
            $obj = new CalendarEvent();
            $obj->hydrate($row);
            CalendarEventPeer::addInstanceToPool($obj, (string) $key);
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
     * @return CalendarEvent|CalendarEvent[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CalendarEvent[]|mixed the list of results, formatted by the current formatter
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
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CalendarEventPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CalendarEventPeer::ID, $keys, Criteria::IN);
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
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CalendarEventPeer::ID, $id, $comparison);
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
     * @return CalendarEventQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CalendarEventPeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the summary column
     *
     * Example usage:
     * <code>
     * $query->filterBySummary('fooValue');   // WHERE summary = 'fooValue'
     * $query->filterBySummary('%fooValue%'); // WHERE summary LIKE '%fooValue%'
     * </code>
     *
     * @param     string $summary The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterBySummary($summary = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($summary)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $summary)) {
                $summary = str_replace('*', '%', $summary);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::SUMMARY, $summary, $comparison);
    }

    /**
     * Filter the query on the body column
     *
     * Example usage:
     * <code>
     * $query->filterByBody('fooValue');   // WHERE body = 'fooValue'
     * $query->filterByBody('%fooValue%'); // WHERE body LIKE '%fooValue%'
     * </code>
     *
     * @param     string $body The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByBody($body = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($body)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $body)) {
                $body = str_replace('*', '%', $body);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::BODY, $body, $comparison);
    }

    /**
     * Filter the query on the creationDate column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationdate('2011-03-14'); // WHERE creationDate = '2011-03-14'
     * $query->filterByCreationdate('now'); // WHERE creationDate = '2011-03-14'
     * $query->filterByCreationdate(array('max' => 'yesterday')); // WHERE creationDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByCreationdate($creationdate = null, $comparison = null)
    {
        if (is_array($creationdate)) {
            $useMinMax = false;
            if (isset($creationdate['min'])) {
                $this->addUsingAlias(CalendarEventPeer::CREATIONDATE, $creationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationdate['max'])) {
                $this->addUsingAlias(CalendarEventPeer::CREATIONDATE, $creationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::CREATIONDATE, $creationdate, $comparison);
    }

    /**
     * Filter the query on the startDate column
     *
     * Example usage:
     * <code>
     * $query->filterByStartdate('2011-03-14'); // WHERE startDate = '2011-03-14'
     * $query->filterByStartdate('now'); // WHERE startDate = '2011-03-14'
     * $query->filterByStartdate(array('max' => 'yesterday')); // WHERE startDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $startdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByStartdate($startdate = null, $comparison = null)
    {
        if (is_array($startdate)) {
            $useMinMax = false;
            if (isset($startdate['min'])) {
                $this->addUsingAlias(CalendarEventPeer::STARTDATE, $startdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startdate['max'])) {
                $this->addUsingAlias(CalendarEventPeer::STARTDATE, $startdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::STARTDATE, $startdate, $comparison);
    }

    /**
     * Filter the query on the endDate column
     *
     * Example usage:
     * <code>
     * $query->filterByEnddate('2011-03-14'); // WHERE endDate = '2011-03-14'
     * $query->filterByEnddate('now'); // WHERE endDate = '2011-03-14'
     * $query->filterByEnddate(array('max' => 'yesterday')); // WHERE endDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $enddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByEnddate($enddate = null, $comparison = null)
    {
        if (is_array($enddate)) {
            $useMinMax = false;
            if (isset($enddate['min'])) {
                $this->addUsingAlias(CalendarEventPeer::ENDDATE, $enddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddate['max'])) {
                $this->addUsingAlias(CalendarEventPeer::ENDDATE, $enddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::ENDDATE, $enddate, $comparison);
    }

    /**
     * Filter the query on the sourceContact column
     *
     * Example usage:
     * <code>
     * $query->filterBySourcecontact('fooValue');   // WHERE sourceContact = 'fooValue'
     * $query->filterBySourcecontact('%fooValue%'); // WHERE sourceContact LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sourcecontact The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterBySourcecontact($sourcecontact = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sourcecontact)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sourcecontact)) {
                $sourcecontact = str_replace('*', '%', $sourcecontact);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::SOURCECONTACT, $sourcecontact, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(CalendarEventPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(CalendarEventPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the regionId column
     *
     * Example usage:
     * <code>
     * $query->filterByRegionid(1234); // WHERE regionId = 1234
     * $query->filterByRegionid(array(12, 34)); // WHERE regionId IN (12, 34)
     * $query->filterByRegionid(array('min' => 12)); // WHERE regionId > 12
     * </code>
     *
     * @param     mixed $regionid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByRegionid($regionid = null, $comparison = null)
    {
        if (is_array($regionid)) {
            $useMinMax = false;
            if (isset($regionid['min'])) {
                $this->addUsingAlias(CalendarEventPeer::REGIONID, $regionid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regionid['max'])) {
                $this->addUsingAlias(CalendarEventPeer::REGIONID, $regionid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::REGIONID, $regionid, $comparison);
    }

    /**
     * Filter the query on the categoryId column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryid(1234); // WHERE categoryId = 1234
     * $query->filterByCategoryid(array(12, 34)); // WHERE categoryId IN (12, 34)
     * $query->filterByCategoryid(array('min' => 12)); // WHERE categoryId > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $categoryid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByCategoryid($categoryid = null, $comparison = null)
    {
        if (is_array($categoryid)) {
            $useMinMax = false;
            if (isset($categoryid['min'])) {
                $this->addUsingAlias(CalendarEventPeer::CATEGORYID, $categoryid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryid['max'])) {
                $this->addUsingAlias(CalendarEventPeer::CATEGORYID, $categoryid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::CATEGORYID, $categoryid, $comparison);
    }

    /**
     * Filter the query on the userId column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userId = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userId IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userId > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(CalendarEventPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(CalendarEventPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the deleted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedAt('2011-03-14'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt('now'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt(array('max' => 'yesterday')); // WHERE deleted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $deletedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(CalendarEventPeer::DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(CalendarEventPeer::DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarEventPeer::DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CalendarEventQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(CalendarEventPeer::USERID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CalendarEventPeer::USERID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
    }

    /**
     * Filter the query by a related Category object
     *
     * @param   Category|PropelObjectCollection $category The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CalendarEventQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof Category) {
            return $this
                ->addUsingAlias(CalendarEventPeer::CATEGORYID, $category->getId(), $comparison);
        } elseif ($category instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CalendarEventPeer::CATEGORYID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', 'CategoryQuery');
    }

    /**
     * Filter the query by a related CalendarMedia object
     *
     * @param   CalendarMedia|PropelObjectCollection $calendarMedia  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CalendarEventQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCalendarMedia($calendarMedia, $comparison = null)
    {
        if ($calendarMedia instanceof CalendarMedia) {
            return $this
                ->addUsingAlias(CalendarEventPeer::ID, $calendarMedia->getCalendareventid(), $comparison);
        } elseif ($calendarMedia instanceof PropelObjectCollection) {
            return $this
                ->useCalendarMediaQuery()
                ->filterByPrimaryKeys($calendarMedia->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCalendarMedia() only accepts arguments of type CalendarMedia or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CalendarMedia relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function joinCalendarMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CalendarMedia');

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
            $this->addJoinObject($join, 'CalendarMedia');
        }

        return $this;
    }

    /**
     * Use the CalendarMedia relation CalendarMedia object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   CalendarMediaQuery A secondary query class using the current class as primary query
     */
    public function useCalendarMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCalendarMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CalendarMedia', 'CalendarMediaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   CalendarEvent $calendarEvent Object to remove from the list of results
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function prune($calendarEvent = null)
    {
        if ($calendarEvent) {
            $this->addUsingAlias(CalendarEventPeer::ID, $calendarEvent->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every SELECT statement
     *
     * @param     PropelPDO $con The connection object used by the query
     */
    protected function basePreSelect(PropelPDO $con)
    {
        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            $this->addUsingAlias(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
        }

        return $this->preSelect($con);
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param     PropelPDO $con The connection object used by the query
     */
    protected function basePreDelete(PropelPDO $con)
    {
        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            return $this->softDelete($con);
        } else {
            return $this->hasWhereClause() ? $this->forceDelete($con) : $this->forceDeleteAll($con);
        }

        return $this->preDelete($con);
    }

    // soft_delete behavior

    /**
     * Temporarily disable the filter on deleted rows
     * Valid only for the current query
     *
     * @see CalendarEventQuery::disableSoftDelete() to disable the filter for more than one query
     *
     * @return CalendarEventQuery The current query, for fluid interface
     */
    public function includeDeleted()
    {
        $this->localSoftDelete = false;

        return $this;
    }

    /**
     * Soft delete the selected rows
     *
     * @param			PropelPDO $con an optional connection object
     *
     * @return		int Number of updated rows
     */
    public function softDelete(PropelPDO $con = null)
    {
        return $this->update(array('DeletedAt' => time()), $con);
    }

    /**
     * Bypass the soft_delete behavior and force a hard delete of the selected rows
     *
     * @param			PropelPDO $con an optional connection object
     *
     * @return		int Number of deleted rows
     */
    public function forceDelete(PropelPDO $con = null)
    {
        return CalendarEventPeer::doForceDelete($this, $con);
    }

    /**
     * Bypass the soft_delete behavior and force a hard delete of all the rows
     *
     * @param			PropelPDO $con an optional connection object
     *
     * @return		int Number of deleted rows
     */
    public function forceDeleteAll(PropelPDO $con = null)
    {
        return CalendarEventPeer::doForceDeleteAll($con);}

    /**
     * Undelete selected rows
     *
     * @param			PropelPDO $con an optional connection object
     *
     * @return		int The number of rows affected by this update and any referring fk objects' save() operations.
     */
    public function unDelete(PropelPDO $con = null)
    {
        return $this->update(array('DeletedAt' => null), $con);
    }

    /**
     * Enable the soft_delete behavior for this model
     */
    public static function enableSoftDelete()
    {
        self::$softDelete = true;
    }

    /**
     * Disable the soft_delete behavior for this model
     */
    public static function disableSoftDelete()
    {
        self::$softDelete = false;
    }

    /**
     * Check the soft_delete behavior for this model
     *
     * @return boolean true if the soft_delete behavior is enabled
     */
    public static function isSoftDeleteEnabled()
    {
        return self::$softDelete;
    }

}
