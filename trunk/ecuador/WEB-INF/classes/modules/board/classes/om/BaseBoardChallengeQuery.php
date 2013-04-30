<?php


/**
 * Base class that represents a query for the 'board_challenge' table.
 *
 * Challenges del Board
 *
 * @method BoardChallengeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BoardChallengeQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method BoardChallengeQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method BoardChallengeQuery orderByBody($order = Criteria::ASC) Order by the body column
 * @method BoardChallengeQuery orderByCreationdate($order = Criteria::ASC) Order by the creationDate column
 * @method BoardChallengeQuery orderByStartdate($order = Criteria::ASC) Order by the startDate column
 * @method BoardChallengeQuery orderByEnddate($order = Criteria::ASC) Order by the endDate column
 * @method BoardChallengeQuery orderByLastupdate($order = Criteria::ASC) Order by the lastUpdate column
 * @method BoardChallengeQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method BoardChallengeQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method BoardChallengeQuery orderByViews($order = Criteria::ASC) Order by the views column
 * @method BoardChallengeQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 *
 * @method BoardChallengeQuery groupById() Group by the id column
 * @method BoardChallengeQuery groupByTitle() Group by the title column
 * @method BoardChallengeQuery groupByUrl() Group by the url column
 * @method BoardChallengeQuery groupByBody() Group by the body column
 * @method BoardChallengeQuery groupByCreationdate() Group by the creationDate column
 * @method BoardChallengeQuery groupByStartdate() Group by the startDate column
 * @method BoardChallengeQuery groupByEnddate() Group by the endDate column
 * @method BoardChallengeQuery groupByLastupdate() Group by the lastUpdate column
 * @method BoardChallengeQuery groupByStatus() Group by the status column
 * @method BoardChallengeQuery groupByUserid() Group by the userId column
 * @method BoardChallengeQuery groupByViews() Group by the views column
 * @method BoardChallengeQuery groupByDeletedAt() Group by the deleted_at column
 *
 * @method BoardChallengeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BoardChallengeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BoardChallengeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BoardChallengeQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method BoardChallengeQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method BoardChallengeQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method BoardChallengeQuery leftJoinBoardComment($relationAlias = null) Adds a LEFT JOIN clause to the query using the BoardComment relation
 * @method BoardChallengeQuery rightJoinBoardComment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BoardComment relation
 * @method BoardChallengeQuery innerJoinBoardComment($relationAlias = null) Adds a INNER JOIN clause to the query using the BoardComment relation
 *
 * @method BoardChallengeQuery leftJoinBoardBondRelation($relationAlias = null) Adds a LEFT JOIN clause to the query using the BoardBondRelation relation
 * @method BoardChallengeQuery rightJoinBoardBondRelation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BoardBondRelation relation
 * @method BoardChallengeQuery innerJoinBoardBondRelation($relationAlias = null) Adds a INNER JOIN clause to the query using the BoardBondRelation relation
 *
 * @method BoardChallenge findOne(PropelPDO $con = null) Return the first BoardChallenge matching the query
 * @method BoardChallenge findOneOrCreate(PropelPDO $con = null) Return the first BoardChallenge matching the query, or a new BoardChallenge object populated from the query conditions when no match is found
 *
 * @method BoardChallenge findOneById(int $id) Return the first BoardChallenge filtered by the id column
 * @method BoardChallenge findOneByTitle(string $title) Return the first BoardChallenge filtered by the title column
 * @method BoardChallenge findOneByUrl(string $url) Return the first BoardChallenge filtered by the url column
 * @method BoardChallenge findOneByBody(string $body) Return the first BoardChallenge filtered by the body column
 * @method BoardChallenge findOneByCreationdate(string $creationDate) Return the first BoardChallenge filtered by the creationDate column
 * @method BoardChallenge findOneByStartdate(string $startDate) Return the first BoardChallenge filtered by the startDate column
 * @method BoardChallenge findOneByEnddate(string $endDate) Return the first BoardChallenge filtered by the endDate column
 * @method BoardChallenge findOneByLastupdate(string $lastUpdate) Return the first BoardChallenge filtered by the lastUpdate column
 * @method BoardChallenge findOneByStatus(int $status) Return the first BoardChallenge filtered by the status column
 * @method BoardChallenge findOneByUserid(int $userId) Return the first BoardChallenge filtered by the userId column
 * @method BoardChallenge findOneByViews(int $views) Return the first BoardChallenge filtered by the views column
 * @method BoardChallenge findOneByDeletedAt(string $deleted_at) Return the first BoardChallenge filtered by the deleted_at column
 *
 * @method array findById(int $id) Return BoardChallenge objects filtered by the id column
 * @method array findByTitle(string $title) Return BoardChallenge objects filtered by the title column
 * @method array findByUrl(string $url) Return BoardChallenge objects filtered by the url column
 * @method array findByBody(string $body) Return BoardChallenge objects filtered by the body column
 * @method array findByCreationdate(string $creationDate) Return BoardChallenge objects filtered by the creationDate column
 * @method array findByStartdate(string $startDate) Return BoardChallenge objects filtered by the startDate column
 * @method array findByEnddate(string $endDate) Return BoardChallenge objects filtered by the endDate column
 * @method array findByLastupdate(string $lastUpdate) Return BoardChallenge objects filtered by the lastUpdate column
 * @method array findByStatus(int $status) Return BoardChallenge objects filtered by the status column
 * @method array findByUserid(int $userId) Return BoardChallenge objects filtered by the userId column
 * @method array findByViews(int $views) Return BoardChallenge objects filtered by the views column
 * @method array findByDeletedAt(string $deleted_at) Return BoardChallenge objects filtered by the deleted_at column
 *
 * @package    propel.generator.board.classes.om
 */
abstract class BaseBoardChallengeQuery extends ModelCriteria
{
    // soft_delete behavior
    protected static $softDelete = true;
    protected $localSoftDelete = true;

    /**
     * Initializes internal state of BaseBoardChallengeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'BoardChallenge', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BoardChallengeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BoardChallengeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BoardChallengeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BoardChallengeQuery) {
            return $criteria;
        }
        $query = new BoardChallengeQuery();
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
     * @return   BoardChallenge|BoardChallenge[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BoardChallengePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BoardChallenge A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `TITLE`, `URL`, `BODY`, `CREATIONDATE`, `STARTDATE`, `ENDDATE`, `LASTUPDATE`, `STATUS`, `USERID`, `VIEWS`, `DELETED_AT` FROM `board_challenge` WHERE `ID` = :p0';
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
            $obj = new BoardChallenge();
            $obj->hydrate($row);
            BoardChallengePeer::addInstanceToPool($obj, (string) $key);
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
     * @return BoardChallenge|BoardChallenge[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BoardChallenge[]|mixed the list of results, formatted by the current formatter
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BoardChallengePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BoardChallengePeer::ID, $keys, Criteria::IN);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BoardChallengePeer::ID, $id, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BoardChallengePeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::URL, $url, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BoardChallengePeer::BODY, $body, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByCreationdate($creationdate = null, $comparison = null)
    {
        if (is_array($creationdate)) {
            $useMinMax = false;
            if (isset($creationdate['min'])) {
                $this->addUsingAlias(BoardChallengePeer::CREATIONDATE, $creationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationdate['max'])) {
                $this->addUsingAlias(BoardChallengePeer::CREATIONDATE, $creationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::CREATIONDATE, $creationdate, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByStartdate($startdate = null, $comparison = null)
    {
        if (is_array($startdate)) {
            $useMinMax = false;
            if (isset($startdate['min'])) {
                $this->addUsingAlias(BoardChallengePeer::STARTDATE, $startdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startdate['max'])) {
                $this->addUsingAlias(BoardChallengePeer::STARTDATE, $startdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::STARTDATE, $startdate, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByEnddate($enddate = null, $comparison = null)
    {
        if (is_array($enddate)) {
            $useMinMax = false;
            if (isset($enddate['min'])) {
                $this->addUsingAlias(BoardChallengePeer::ENDDATE, $enddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($enddate['max'])) {
                $this->addUsingAlias(BoardChallengePeer::ENDDATE, $enddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::ENDDATE, $enddate, $comparison);
    }

    /**
     * Filter the query on the lastUpdate column
     *
     * Example usage:
     * <code>
     * $query->filterByLastupdate('2011-03-14'); // WHERE lastUpdate = '2011-03-14'
     * $query->filterByLastupdate('now'); // WHERE lastUpdate = '2011-03-14'
     * $query->filterByLastupdate(array('max' => 'yesterday')); // WHERE lastUpdate > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastupdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByLastupdate($lastupdate = null, $comparison = null)
    {
        if (is_array($lastupdate)) {
            $useMinMax = false;
            if (isset($lastupdate['min'])) {
                $this->addUsingAlias(BoardChallengePeer::LASTUPDATE, $lastupdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastupdate['max'])) {
                $this->addUsingAlias(BoardChallengePeer::LASTUPDATE, $lastupdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::LASTUPDATE, $lastupdate, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(BoardChallengePeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(BoardChallengePeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::STATUS, $status, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(BoardChallengePeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(BoardChallengePeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the views column
     *
     * Example usage:
     * <code>
     * $query->filterByViews(1234); // WHERE views = 1234
     * $query->filterByViews(array(12, 34)); // WHERE views IN (12, 34)
     * $query->filterByViews(array('min' => 12)); // WHERE views > 12
     * </code>
     *
     * @param     mixed $views The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByViews($views = null, $comparison = null)
    {
        if (is_array($views)) {
            $useMinMax = false;
            if (isset($views['min'])) {
                $this->addUsingAlias(BoardChallengePeer::VIEWS, $views['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($views['max'])) {
                $this->addUsingAlias(BoardChallengePeer::VIEWS, $views['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::VIEWS, $views, $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(BoardChallengePeer::DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(BoardChallengePeer::DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardChallengePeer::DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardChallengeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(BoardChallengePeer::USERID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BoardChallengePeer::USERID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BoardChallengeQuery The current query, for fluid interface
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
     * Filter the query by a related BoardComment object
     *
     * @param   BoardComment|PropelObjectCollection $boardComment  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardChallengeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBoardComment($boardComment, $comparison = null)
    {
        if ($boardComment instanceof BoardComment) {
            return $this
                ->addUsingAlias(BoardChallengePeer::ID, $boardComment->getChallengeid(), $comparison);
        } elseif ($boardComment instanceof PropelObjectCollection) {
            return $this
                ->useBoardCommentQuery()
                ->filterByPrimaryKeys($boardComment->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBoardComment() only accepts arguments of type BoardComment or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BoardComment relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function joinBoardComment($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BoardComment');

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
            $this->addJoinObject($join, 'BoardComment');
        }

        return $this;
    }

    /**
     * Use the BoardComment relation BoardComment object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   BoardCommentQuery A secondary query class using the current class as primary query
     */
    public function useBoardCommentQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBoardComment($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BoardComment', 'BoardCommentQuery');
    }

    /**
     * Filter the query by a related BoardBondRelation object
     *
     * @param   BoardBondRelation|PropelObjectCollection $boardBondRelation  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardChallengeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBoardBondRelation($boardBondRelation, $comparison = null)
    {
        if ($boardBondRelation instanceof BoardBondRelation) {
            return $this
                ->addUsingAlias(BoardChallengePeer::ID, $boardBondRelation->getChallengeid(), $comparison);
        } elseif ($boardBondRelation instanceof PropelObjectCollection) {
            return $this
                ->useBoardBondRelationQuery()
                ->filterByPrimaryKeys($boardBondRelation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBoardBondRelation() only accepts arguments of type BoardBondRelation or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BoardBondRelation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function joinBoardBondRelation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BoardBondRelation');

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
            $this->addJoinObject($join, 'BoardBondRelation');
        }

        return $this;
    }

    /**
     * Use the BoardBondRelation relation BoardBondRelation object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   BoardBondRelationQuery A secondary query class using the current class as primary query
     */
    public function useBoardBondRelationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBoardBondRelation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BoardBondRelation', 'BoardBondRelationQuery');
    }

    /**
     * Filter the query by a related BoardBond object
     * using the board_bondRelation table as cross reference
     *
     * @param   BoardBond $boardBond the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardChallengeQuery The current query, for fluid interface
     */
    public function filterByBoardBond($boardBond, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useBoardBondRelationQuery()
            ->filterByBoardBond($boardBond, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   BoardChallenge $boardChallenge Object to remove from the list of results
     *
     * @return BoardChallengeQuery The current query, for fluid interface
     */
    public function prune($boardChallenge = null)
    {
        if ($boardChallenge) {
            $this->addUsingAlias(BoardChallengePeer::ID, $boardChallenge->getId(), Criteria::NOT_EQUAL);
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
        if (BoardChallengeQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            $this->addUsingAlias(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
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
        if (BoardChallengeQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
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
     * @see BoardChallengeQuery::disableSoftDelete() to disable the filter for more than one query
     *
     * @return BoardChallengeQuery The current query, for fluid interface
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
        return BoardChallengePeer::doForceDelete($this, $con);
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
        return BoardChallengePeer::doForceDeleteAll($con);}

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
