<?php


/**
 * Base class that represents a query for the 'board_comment' table.
 *
 * Comentarios a challenges
 *
 * @method BoardCommentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BoardCommentQuery orderByChallengeid($order = Criteria::ASC) Order by the challengeId column
 * @method BoardCommentQuery orderByText($order = Criteria::ASC) Order by the text column
 * @method BoardCommentQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method BoardCommentQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method BoardCommentQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method BoardCommentQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method BoardCommentQuery orderByCreationdate($order = Criteria::ASC) Order by the creationDate column
 * @method BoardCommentQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method BoardCommentQuery orderByUserid($order = Criteria::ASC) Order by the userId column
 * @method BoardCommentQuery orderByObjecttype($order = Criteria::ASC) Order by the objectType column
 * @method BoardCommentQuery orderByObjectid($order = Criteria::ASC) Order by the objectId column
 *
 * @method BoardCommentQuery groupById() Group by the id column
 * @method BoardCommentQuery groupByChallengeid() Group by the challengeId column
 * @method BoardCommentQuery groupByText() Group by the text column
 * @method BoardCommentQuery groupByEmail() Group by the email column
 * @method BoardCommentQuery groupByUsername() Group by the username column
 * @method BoardCommentQuery groupByUrl() Group by the url column
 * @method BoardCommentQuery groupByIp() Group by the ip column
 * @method BoardCommentQuery groupByCreationdate() Group by the creationDate column
 * @method BoardCommentQuery groupByStatus() Group by the status column
 * @method BoardCommentQuery groupByUserid() Group by the userId column
 * @method BoardCommentQuery groupByObjecttype() Group by the objectType column
 * @method BoardCommentQuery groupByObjectid() Group by the objectId column
 *
 * @method BoardCommentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BoardCommentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BoardCommentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BoardCommentQuery leftJoinBoardChallenge($relationAlias = null) Adds a LEFT JOIN clause to the query using the BoardChallenge relation
 * @method BoardCommentQuery rightJoinBoardChallenge($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BoardChallenge relation
 * @method BoardCommentQuery innerJoinBoardChallenge($relationAlias = null) Adds a INNER JOIN clause to the query using the BoardChallenge relation
 *
 * @method BoardComment findOne(PropelPDO $con = null) Return the first BoardComment matching the query
 * @method BoardComment findOneOrCreate(PropelPDO $con = null) Return the first BoardComment matching the query, or a new BoardComment object populated from the query conditions when no match is found
 *
 * @method BoardComment findOneById(int $id) Return the first BoardComment filtered by the id column
 * @method BoardComment findOneByChallengeid(int $challengeId) Return the first BoardComment filtered by the challengeId column
 * @method BoardComment findOneByText(string $text) Return the first BoardComment filtered by the text column
 * @method BoardComment findOneByEmail(string $email) Return the first BoardComment filtered by the email column
 * @method BoardComment findOneByUsername(string $username) Return the first BoardComment filtered by the username column
 * @method BoardComment findOneByUrl(string $url) Return the first BoardComment filtered by the url column
 * @method BoardComment findOneByIp(string $ip) Return the first BoardComment filtered by the ip column
 * @method BoardComment findOneByCreationdate(string $creationDate) Return the first BoardComment filtered by the creationDate column
 * @method BoardComment findOneByStatus(int $status) Return the first BoardComment filtered by the status column
 * @method BoardComment findOneByUserid(int $userId) Return the first BoardComment filtered by the userId column
 * @method BoardComment findOneByObjecttype(string $objectType) Return the first BoardComment filtered by the objectType column
 * @method BoardComment findOneByObjectid(int $objectId) Return the first BoardComment filtered by the objectId column
 *
 * @method array findById(int $id) Return BoardComment objects filtered by the id column
 * @method array findByChallengeid(int $challengeId) Return BoardComment objects filtered by the challengeId column
 * @method array findByText(string $text) Return BoardComment objects filtered by the text column
 * @method array findByEmail(string $email) Return BoardComment objects filtered by the email column
 * @method array findByUsername(string $username) Return BoardComment objects filtered by the username column
 * @method array findByUrl(string $url) Return BoardComment objects filtered by the url column
 * @method array findByIp(string $ip) Return BoardComment objects filtered by the ip column
 * @method array findByCreationdate(string $creationDate) Return BoardComment objects filtered by the creationDate column
 * @method array findByStatus(int $status) Return BoardComment objects filtered by the status column
 * @method array findByUserid(int $userId) Return BoardComment objects filtered by the userId column
 * @method array findByObjecttype(string $objectType) Return BoardComment objects filtered by the objectType column
 * @method array findByObjectid(int $objectId) Return BoardComment objects filtered by the objectId column
 *
 * @package    propel.generator.board.classes.om
 */
abstract class BaseBoardCommentQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBoardCommentQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'BoardComment', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BoardCommentQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BoardCommentQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BoardCommentQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BoardCommentQuery) {
            return $criteria;
        }
        $query = new BoardCommentQuery();
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
     * @return   BoardComment|BoardComment[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BoardCommentPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BoardComment A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CHALLENGEID`, `TEXT`, `EMAIL`, `USERNAME`, `URL`, `IP`, `CREATIONDATE`, `STATUS`, `USERID`, `OBJECTTYPE`, `OBJECTID` FROM `board_comment` WHERE `ID` = :p0';
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
            $obj = new BoardComment();
            $obj->hydrate($row);
            BoardCommentPeer::addInstanceToPool($obj, (string) $key);
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
     * @return BoardComment|BoardComment[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BoardComment[]|mixed the list of results, formatted by the current formatter
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
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BoardCommentPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BoardCommentPeer::ID, $keys, Criteria::IN);
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
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BoardCommentPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the challengeId column
     *
     * Example usage:
     * <code>
     * $query->filterByChallengeid(1234); // WHERE challengeId = 1234
     * $query->filterByChallengeid(array(12, 34)); // WHERE challengeId IN (12, 34)
     * $query->filterByChallengeid(array('min' => 12)); // WHERE challengeId > 12
     * </code>
     *
     * @see       filterByBoardChallenge()
     *
     * @param     mixed $challengeid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByChallengeid($challengeid = null, $comparison = null)
    {
        if (is_array($challengeid)) {
            $useMinMax = false;
            if (isset($challengeid['min'])) {
                $this->addUsingAlias(BoardCommentPeer::CHALLENGEID, $challengeid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($challengeid['max'])) {
                $this->addUsingAlias(BoardCommentPeer::CHALLENGEID, $challengeid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::CHALLENGEID, $challengeid, $comparison);
    }

    /**
     * Filter the query on the text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::TEXT, $text, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::USERNAME, $username, $comparison);
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
     * @return BoardCommentQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BoardCommentPeer::URL, $url, $comparison);
    }

    /**
     * Filter the query on the ip column
     *
     * Example usage:
     * <code>
     * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
     * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByIp($ip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ip)) {
                $ip = str_replace('*', '%', $ip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::IP, $ip, $comparison);
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
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByCreationdate($creationdate = null, $comparison = null)
    {
        if (is_array($creationdate)) {
            $useMinMax = false;
            if (isset($creationdate['min'])) {
                $this->addUsingAlias(BoardCommentPeer::CREATIONDATE, $creationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationdate['max'])) {
                $this->addUsingAlias(BoardCommentPeer::CREATIONDATE, $creationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::CREATIONDATE, $creationdate, $comparison);
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
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(BoardCommentPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(BoardCommentPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::STATUS, $status, $comparison);
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
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(BoardCommentPeer::USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(BoardCommentPeer::USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the objectType column
     *
     * Example usage:
     * <code>
     * $query->filterByObjecttype('fooValue');   // WHERE objectType = 'fooValue'
     * $query->filterByObjecttype('%fooValue%'); // WHERE objectType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $objecttype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByObjecttype($objecttype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($objecttype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $objecttype)) {
                $objecttype = str_replace('*', '%', $objecttype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::OBJECTTYPE, $objecttype, $comparison);
    }

    /**
     * Filter the query on the objectId column
     *
     * Example usage:
     * <code>
     * $query->filterByObjectid(1234); // WHERE objectId = 1234
     * $query->filterByObjectid(array(12, 34)); // WHERE objectId IN (12, 34)
     * $query->filterByObjectid(array('min' => 12)); // WHERE objectId > 12
     * </code>
     *
     * @param     mixed $objectid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function filterByObjectid($objectid = null, $comparison = null)
    {
        if (is_array($objectid)) {
            $useMinMax = false;
            if (isset($objectid['min'])) {
                $this->addUsingAlias(BoardCommentPeer::OBJECTID, $objectid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($objectid['max'])) {
                $this->addUsingAlias(BoardCommentPeer::OBJECTID, $objectid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoardCommentPeer::OBJECTID, $objectid, $comparison);
    }

    /**
     * Filter the query by a related BoardChallenge object
     *
     * @param   BoardChallenge|PropelObjectCollection $boardChallenge The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardCommentQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBoardChallenge($boardChallenge, $comparison = null)
    {
        if ($boardChallenge instanceof BoardChallenge) {
            return $this
                ->addUsingAlias(BoardCommentPeer::CHALLENGEID, $boardChallenge->getId(), $comparison);
        } elseif ($boardChallenge instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BoardCommentPeer::CHALLENGEID, $boardChallenge->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBoardChallenge() only accepts arguments of type BoardChallenge or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BoardChallenge relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function joinBoardChallenge($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BoardChallenge');

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
            $this->addJoinObject($join, 'BoardChallenge');
        }

        return $this;
    }

    /**
     * Use the BoardChallenge relation BoardChallenge object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   BoardChallengeQuery A secondary query class using the current class as primary query
     */
    public function useBoardChallengeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBoardChallenge($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BoardChallenge', 'BoardChallengeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BoardComment $boardComment Object to remove from the list of results
     *
     * @return BoardCommentQuery The current query, for fluid interface
     */
    public function prune($boardComment = null)
    {
        if ($boardComment) {
            $this->addUsingAlias(BoardCommentPeer::ID, $boardComment->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
