<?php


/**
 * Base class that represents a query for the 'calendar_media' table.
 *
 * Media del calendario
 *
 * @method CalendarMediaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CalendarMediaQuery orderByCalendareventid($order = Criteria::ASC) Order by the calendarEventId column
 * @method CalendarMediaQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method CalendarMediaQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method CalendarMediaQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method CalendarMediaQuery orderByMediatype($order = Criteria::ASC) Order by the mediaType column
 * @method CalendarMediaQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method CalendarMediaQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method CalendarMediaQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method CalendarMediaQuery orderByCreationdate($order = Criteria::ASC) Order by the creationDate column
 * @method CalendarMediaQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method CalendarMediaQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 *
 * @method CalendarMediaQuery groupById() Group by the id column
 * @method CalendarMediaQuery groupByCalendareventid() Group by the calendarEventId column
 * @method CalendarMediaQuery groupByName() Group by the name column
 * @method CalendarMediaQuery groupByTitle() Group by the title column
 * @method CalendarMediaQuery groupByDescription() Group by the description column
 * @method CalendarMediaQuery groupByMediatype() Group by the mediaType column
 * @method CalendarMediaQuery groupByWidth() Group by the width column
 * @method CalendarMediaQuery groupByHeight() Group by the height column
 * @method CalendarMediaQuery groupByOrder() Group by the order column
 * @method CalendarMediaQuery groupByCreationdate() Group by the creationDate column
 * @method CalendarMediaQuery groupByStatus() Group by the status column
 * @method CalendarMediaQuery groupByUserid() Group by the userId column
 *
 * @method CalendarMediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CalendarMediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CalendarMediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CalendarMediaQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method CalendarMediaQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method CalendarMediaQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method CalendarMediaQuery leftJoinCalendarEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the CalendarEvent relation
 * @method CalendarMediaQuery rightJoinCalendarEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CalendarEvent relation
 * @method CalendarMediaQuery innerJoinCalendarEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the CalendarEvent relation
 *
 * @method CalendarMedia findOne(PropelPDO $con = null) Return the first CalendarMedia matching the query
 * @method CalendarMedia findOneOrCreate(PropelPDO $con = null) Return the first CalendarMedia matching the query, or a new CalendarMedia object populated from the query conditions when no match is found
 *
 * @method CalendarMedia findOneById(int $id) Return the first CalendarMedia filtered by the id column
 * @method CalendarMedia findOneByCalendareventid(int $calendarEventId) Return the first CalendarMedia filtered by the calendarEventId column
 * @method CalendarMedia findOneByName(string $name) Return the first CalendarMedia filtered by the name column
 * @method CalendarMedia findOneByTitle(string $title) Return the first CalendarMedia filtered by the title column
 * @method CalendarMedia findOneByDescription(string $description) Return the first CalendarMedia filtered by the description column
 * @method CalendarMedia findOneByMediatype(int $mediaType) Return the first CalendarMedia filtered by the mediaType column
 * @method CalendarMedia findOneByWidth(int $width) Return the first CalendarMedia filtered by the width column
 * @method CalendarMedia findOneByHeight(int $height) Return the first CalendarMedia filtered by the height column
 * @method CalendarMedia findOneByOrder(int $order) Return the first CalendarMedia filtered by the order column
 * @method CalendarMedia findOneByCreationdate(string $creationDate) Return the first CalendarMedia filtered by the creationDate column
 * @method CalendarMedia findOneByStatus(int $status) Return the first CalendarMedia filtered by the status column
 * @method CalendarMedia findOneByUserid(int $userId) Return the first CalendarMedia filtered by the userId column
 *
 * @method array findById(int $id) Return CalendarMedia objects filtered by the id column
 * @method array findByCalendareventid(int $calendarEventId) Return CalendarMedia objects filtered by the calendarEventId column
 * @method array findByName(string $name) Return CalendarMedia objects filtered by the name column
 * @method array findByTitle(string $title) Return CalendarMedia objects filtered by the title column
 * @method array findByDescription(string $description) Return CalendarMedia objects filtered by the description column
 * @method array findByMediatype(int $mediaType) Return CalendarMedia objects filtered by the mediaType column
 * @method array findByWidth(int $width) Return CalendarMedia objects filtered by the width column
 * @method array findByHeight(int $height) Return CalendarMedia objects filtered by the height column
 * @method array findByOrder(int $order) Return CalendarMedia objects filtered by the order column
 * @method array findByCreationdate(string $creationDate) Return CalendarMedia objects filtered by the creationDate column
 * @method array findByStatus(int $status) Return CalendarMedia objects filtered by the status column
 * @method array findByUserid(int $userId) Return CalendarMedia objects filtered by the userId column
 *
 * @package    propel.generator.calendar.classes.om
 */
abstract class BaseCalendarMediaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCalendarMediaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'CalendarMedia', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CalendarMediaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CalendarMediaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CalendarMediaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CalendarMediaQuery) {
            return $criteria;
        }
        $query = new CalendarMediaQuery();
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
     * @return   CalendarMedia|CalendarMedia[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CalendarMediaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CalendarMediaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CalendarMedia A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CALENDAREVENTID`, `NAME`, `TITLE`, `DESCRIPTION`, `MEDIATYPE`, `WIDTH`, `HEIGHT`, `ORDER`, `CREATIONDATE`, `STATUS`, `USERID` FROM `calendar_media` WHERE `ID` = :p0';
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
            $obj = new CalendarMedia();
            $obj->hydrate($row);
            CalendarMediaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return CalendarMedia|CalendarMedia[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CalendarMedia[]|mixed the list of results, formatted by the current formatter
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
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CalendarMediaPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CalendarMediaPeer::ID, $keys, Criteria::IN);
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
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CalendarMediaPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the calendarEventId column
     *
     * Example usage:
     * <code>
     * $query->filterByCalendareventid(1234); // WHERE calendarEventId = 1234
     * $query->filterByCalendareventid(array(12, 34)); // WHERE calendarEventId IN (12, 34)
     * $query->filterByCalendareventid(array('min' => 12)); // WHERE calendarEventId > 12
     * </code>
     *
     * @see       filterByCalendarEvent()
     *
     * @param     mixed $calendareventid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByCalendareventid($calendareventid = null, $comparison = null)
    {
        if (is_array($calendareventid)) {
            $useMinMax = false;
            if (isset($calendareventid['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::CALENDAREVENTID, $calendareventid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calendareventid['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::CALENDAREVENTID, $calendareventid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::CALENDAREVENTID, $calendareventid, $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CalendarMediaPeer::NAME, $name, $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CalendarMediaPeer::TITLE, $title, $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CalendarMediaPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the mediaType column
     *
     * Example usage:
     * <code>
     * $query->filterByMediatype(1234); // WHERE mediaType = 1234
     * $query->filterByMediatype(array(12, 34)); // WHERE mediaType IN (12, 34)
     * $query->filterByMediatype(array('min' => 12)); // WHERE mediaType > 12
     * </code>
     *
     * @param     mixed $mediatype The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByMediatype($mediatype = null, $comparison = null)
    {
        if (is_array($mediatype)) {
            $useMinMax = false;
            if (isset($mediatype['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::MEDIATYPE, $mediatype['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mediatype['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::MEDIATYPE, $mediatype['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::MEDIATYPE, $mediatype, $comparison);
    }

    /**
     * Filter the query on the width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth(1234); // WHERE width = 1234
     * $query->filterByWidth(array(12, 34)); // WHERE width IN (12, 34)
     * $query->filterByWidth(array('min' => 12)); // WHERE width > 12
     * </code>
     *
     * @param     mixed $width The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (is_array($width)) {
            $useMinMax = false;
            if (isset($width['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::WIDTH, $width['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($width['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::WIDTH, $width['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::WIDTH, $width, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight(1234); // WHERE height = 1234
     * $query->filterByHeight(array(12, 34)); // WHERE height IN (12, 34)
     * $query->filterByHeight(array('min' => 12)); // WHERE height > 12
     * </code>
     *
     * @param     mixed $height The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (is_array($height)) {
            $useMinMax = false;
            if (isset($height['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::HEIGHT, $height['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($height['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::HEIGHT, $height['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::ORDER, $order, $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByCreationdate($creationdate = null, $comparison = null)
    {
        if (is_array($creationdate)) {
            $useMinMax = false;
            if (isset($creationdate['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::CREATIONDATE, $creationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationdate['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::CREATIONDATE, $creationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::CREATIONDATE, $creationdate, $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::STATUS, $status, $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(CalendarMediaPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(CalendarMediaPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarMediaPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CalendarMediaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(CalendarMediaPeer::USERID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CalendarMediaPeer::USERID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return CalendarMediaQuery The current query, for fluid interface
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
     * Filter the query by a related CalendarEvent object
     *
     * @param   CalendarEvent|PropelObjectCollection $calendarEvent The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CalendarMediaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCalendarEvent($calendarEvent, $comparison = null)
    {
        if ($calendarEvent instanceof CalendarEvent) {
            return $this
                ->addUsingAlias(CalendarMediaPeer::CALENDAREVENTID, $calendarEvent->getId(), $comparison);
        } elseif ($calendarEvent instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CalendarMediaPeer::CALENDAREVENTID, $calendarEvent->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCalendarEvent() only accepts arguments of type CalendarEvent or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CalendarEvent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function joinCalendarEvent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CalendarEvent');

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
            $this->addJoinObject($join, 'CalendarEvent');
        }

        return $this;
    }

    /**
     * Use the CalendarEvent relation CalendarEvent object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   CalendarEventQuery A secondary query class using the current class as primary query
     */
    public function useCalendarEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCalendarEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CalendarEvent', 'CalendarEventQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   CalendarMedia $calendarMedia Object to remove from the list of results
     *
     * @return CalendarMediaQuery The current query, for fluid interface
     */
    public function prune($calendarMedia = null)
    {
        if ($calendarMedia) {
            $this->addUsingAlias(CalendarMediaPeer::ID, $calendarMedia->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
