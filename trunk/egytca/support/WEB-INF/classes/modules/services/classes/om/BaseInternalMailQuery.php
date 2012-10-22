<?php


/**
 * Base class that represents a query for the 'services_internalMail' table.
 *
 * Mensajes internos
 *
 * @method InternalMailQuery orderById($order = Criteria::ASC) Order by the id column
 * @method InternalMailQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method InternalMailQuery orderByBody($order = Criteria::ASC) Order by the body column
 * @method InternalMailQuery orderByRecipientid($order = Criteria::ASC) Order by the recipientId column
 * @method InternalMailQuery orderByRecipienttype($order = Criteria::ASC) Order by the recipientType column
 * @method InternalMailQuery orderByReadon($order = Criteria::ASC) Order by the readOn column
 * @method InternalMailQuery orderByFromid($order = Criteria::ASC) Order by the fromId column
 * @method InternalMailQuery orderByFromtype($order = Criteria::ASC) Order by the fromType column
 * @method InternalMailQuery orderByTo($order = Criteria::ASC) Order by the to column
 * @method InternalMailQuery orderByReplyid($order = Criteria::ASC) Order by the replyId column
 * @method InternalMailQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method InternalMailQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method InternalMailQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 *
 * @method InternalMailQuery groupById() Group by the id column
 * @method InternalMailQuery groupBySubject() Group by the subject column
 * @method InternalMailQuery groupByBody() Group by the body column
 * @method InternalMailQuery groupByRecipientid() Group by the recipientId column
 * @method InternalMailQuery groupByRecipienttype() Group by the recipientType column
 * @method InternalMailQuery groupByReadon() Group by the readOn column
 * @method InternalMailQuery groupByFromid() Group by the fromId column
 * @method InternalMailQuery groupByFromtype() Group by the fromType column
 * @method InternalMailQuery groupByTo() Group by the to column
 * @method InternalMailQuery groupByReplyid() Group by the replyId column
 * @method InternalMailQuery groupByCreatedAt() Group by the created_at column
 * @method InternalMailQuery groupByUpdatedAt() Group by the updated_at column
 * @method InternalMailQuery groupByDeletedAt() Group by the deleted_at column
 *
 * @method InternalMailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method InternalMailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method InternalMailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method InternalMailQuery leftJoinInternalMailRelatedByReplyid($relationAlias = null) Adds a LEFT JOIN clause to the query using the InternalMailRelatedByReplyid relation
 * @method InternalMailQuery rightJoinInternalMailRelatedByReplyid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InternalMailRelatedByReplyid relation
 * @method InternalMailQuery innerJoinInternalMailRelatedByReplyid($relationAlias = null) Adds a INNER JOIN clause to the query using the InternalMailRelatedByReplyid relation
 *
 * @method InternalMailQuery leftJoinInternalMailRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the InternalMailRelatedById relation
 * @method InternalMailQuery rightJoinInternalMailRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the InternalMailRelatedById relation
 * @method InternalMailQuery innerJoinInternalMailRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the InternalMailRelatedById relation
 *
 * @method InternalMail findOne(PropelPDO $con = null) Return the first InternalMail matching the query
 * @method InternalMail findOneOrCreate(PropelPDO $con = null) Return the first InternalMail matching the query, or a new InternalMail object populated from the query conditions when no match is found
 *
 * @method InternalMail findOneById(int $id) Return the first InternalMail filtered by the id column
 * @method InternalMail findOneBySubject(string $subject) Return the first InternalMail filtered by the subject column
 * @method InternalMail findOneByBody(string $body) Return the first InternalMail filtered by the body column
 * @method InternalMail findOneByRecipientid(int $recipientId) Return the first InternalMail filtered by the recipientId column
 * @method InternalMail findOneByRecipienttype(string $recipientType) Return the first InternalMail filtered by the recipientType column
 * @method InternalMail findOneByReadon(string $readOn) Return the first InternalMail filtered by the readOn column
 * @method InternalMail findOneByFromid(int $fromId) Return the first InternalMail filtered by the fromId column
 * @method InternalMail findOneByFromtype(string $fromType) Return the first InternalMail filtered by the fromType column
 * @method InternalMail findOneByTo(resource $to) Return the first InternalMail filtered by the to column
 * @method InternalMail findOneByReplyid(int $replyId) Return the first InternalMail filtered by the replyId column
 * @method InternalMail findOneByCreatedAt(string $created_at) Return the first InternalMail filtered by the created_at column
 * @method InternalMail findOneByUpdatedAt(string $updated_at) Return the first InternalMail filtered by the updated_at column
 * @method InternalMail findOneByDeletedAt(string $deleted_at) Return the first InternalMail filtered by the deleted_at column
 *
 * @method array findById(int $id) Return InternalMail objects filtered by the id column
 * @method array findBySubject(string $subject) Return InternalMail objects filtered by the subject column
 * @method array findByBody(string $body) Return InternalMail objects filtered by the body column
 * @method array findByRecipientid(int $recipientId) Return InternalMail objects filtered by the recipientId column
 * @method array findByRecipienttype(string $recipientType) Return InternalMail objects filtered by the recipientType column
 * @method array findByReadon(string $readOn) Return InternalMail objects filtered by the readOn column
 * @method array findByFromid(int $fromId) Return InternalMail objects filtered by the fromId column
 * @method array findByFromtype(string $fromType) Return InternalMail objects filtered by the fromType column
 * @method array findByTo(resource $to) Return InternalMail objects filtered by the to column
 * @method array findByReplyid(int $replyId) Return InternalMail objects filtered by the replyId column
 * @method array findByCreatedAt(string $created_at) Return InternalMail objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return InternalMail objects filtered by the updated_at column
 * @method array findByDeletedAt(string $deleted_at) Return InternalMail objects filtered by the deleted_at column
 *
 * @package    propel.generator.services.classes.om
 */
abstract class BaseInternalMailQuery extends ModelCriteria
{
    // soft_delete behavior
    protected static $softDelete = true;
    protected $localSoftDelete = true;

    /**
     * Initializes internal state of BaseInternalMailQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'InternalMail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new InternalMailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     InternalMailQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return InternalMailQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof InternalMailQuery) {
            return $criteria;
        }
        $query = new InternalMailQuery();
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
     * @return   InternalMail|InternalMail[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = InternalMailPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   InternalMail A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `SUBJECT`, `BODY`, `RECIPIENTID`, `RECIPIENTTYPE`, `READON`, `FROMID`, `FROMTYPE`, `TO`, `REPLYID`, `CREATED_AT`, `UPDATED_AT`, `DELETED_AT` FROM `services_internalMail` WHERE `ID` = :p0';
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
            $obj = new InternalMail();
            $obj->hydrate($row);
            InternalMailPeer::addInstanceToPool($obj, (string) $key);
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
     * @return InternalMail|InternalMail[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|InternalMail[]|mixed the list of results, formatted by the current formatter
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
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InternalMailPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InternalMailPeer::ID, $keys, Criteria::IN);
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
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(InternalMailPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%'); // WHERE subject LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subject The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterBySubject($subject = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subject)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subject)) {
                $subject = str_replace('*', '%', $subject);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::SUBJECT, $subject, $comparison);
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
     * @return InternalMailQuery The current query, for fluid interface
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

        return $this->addUsingAlias(InternalMailPeer::BODY, $body, $comparison);
    }

    /**
     * Filter the query on the recipientId column
     *
     * Example usage:
     * <code>
     * $query->filterByRecipientid(1234); // WHERE recipientId = 1234
     * $query->filterByRecipientid(array(12, 34)); // WHERE recipientId IN (12, 34)
     * $query->filterByRecipientid(array('min' => 12)); // WHERE recipientId > 12
     * </code>
     *
     * @param     mixed $recipientid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByRecipientid($recipientid = null, $comparison = null)
    {
        if (is_array($recipientid)) {
            $useMinMax = false;
            if (isset($recipientid['min'])) {
                $this->addUsingAlias(InternalMailPeer::RECIPIENTID, $recipientid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recipientid['max'])) {
                $this->addUsingAlias(InternalMailPeer::RECIPIENTID, $recipientid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::RECIPIENTID, $recipientid, $comparison);
    }

    /**
     * Filter the query on the recipientType column
     *
     * Example usage:
     * <code>
     * $query->filterByRecipienttype('fooValue');   // WHERE recipientType = 'fooValue'
     * $query->filterByRecipienttype('%fooValue%'); // WHERE recipientType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $recipienttype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByRecipienttype($recipienttype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($recipienttype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $recipienttype)) {
                $recipienttype = str_replace('*', '%', $recipienttype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::RECIPIENTTYPE, $recipienttype, $comparison);
    }

    /**
     * Filter the query on the readOn column
     *
     * Example usage:
     * <code>
     * $query->filterByReadon('2011-03-14'); // WHERE readOn = '2011-03-14'
     * $query->filterByReadon('now'); // WHERE readOn = '2011-03-14'
     * $query->filterByReadon(array('max' => 'yesterday')); // WHERE readOn > '2011-03-13'
     * </code>
     *
     * @param     mixed $readon The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByReadon($readon = null, $comparison = null)
    {
        if (is_array($readon)) {
            $useMinMax = false;
            if (isset($readon['min'])) {
                $this->addUsingAlias(InternalMailPeer::READON, $readon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($readon['max'])) {
                $this->addUsingAlias(InternalMailPeer::READON, $readon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::READON, $readon, $comparison);
    }

    /**
     * Filter the query on the fromId column
     *
     * Example usage:
     * <code>
     * $query->filterByFromid(1234); // WHERE fromId = 1234
     * $query->filterByFromid(array(12, 34)); // WHERE fromId IN (12, 34)
     * $query->filterByFromid(array('min' => 12)); // WHERE fromId > 12
     * </code>
     *
     * @param     mixed $fromid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByFromid($fromid = null, $comparison = null)
    {
        if (is_array($fromid)) {
            $useMinMax = false;
            if (isset($fromid['min'])) {
                $this->addUsingAlias(InternalMailPeer::FROMID, $fromid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fromid['max'])) {
                $this->addUsingAlias(InternalMailPeer::FROMID, $fromid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::FROMID, $fromid, $comparison);
    }

    /**
     * Filter the query on the fromType column
     *
     * Example usage:
     * <code>
     * $query->filterByFromtype('fooValue');   // WHERE fromType = 'fooValue'
     * $query->filterByFromtype('%fooValue%'); // WHERE fromType LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fromtype The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByFromtype($fromtype = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fromtype)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fromtype)) {
                $fromtype = str_replace('*', '%', $fromtype);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::FROMTYPE, $fromtype, $comparison);
    }

    /**
     * Filter the query on the to column
     *
     * @param     mixed $to The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByTo($to = null, $comparison = null)
    {

        return $this->addUsingAlias(InternalMailPeer::TO, $to, $comparison);
    }

    /**
     * Filter the query on the replyId column
     *
     * Example usage:
     * <code>
     * $query->filterByReplyid(1234); // WHERE replyId = 1234
     * $query->filterByReplyid(array(12, 34)); // WHERE replyId IN (12, 34)
     * $query->filterByReplyid(array('min' => 12)); // WHERE replyId > 12
     * </code>
     *
     * @see       filterByInternalMailRelatedByReplyid()
     *
     * @param     mixed $replyid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByReplyid($replyid = null, $comparison = null)
    {
        if (is_array($replyid)) {
            $useMinMax = false;
            if (isset($replyid['min'])) {
                $this->addUsingAlias(InternalMailPeer::REPLYID, $replyid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($replyid['max'])) {
                $this->addUsingAlias(InternalMailPeer::REPLYID, $replyid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::REPLYID, $replyid, $comparison);
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
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(InternalMailPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(InternalMailPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(InternalMailPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(InternalMailPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(InternalMailPeer::DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(InternalMailPeer::DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InternalMailPeer::DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Filter the query by a related InternalMail object
     *
     * @param   InternalMail|PropelObjectCollection $internalMail The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   InternalMailQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByInternalMailRelatedByReplyid($internalMail, $comparison = null)
    {
        if ($internalMail instanceof InternalMail) {
            return $this
                ->addUsingAlias(InternalMailPeer::REPLYID, $internalMail->getId(), $comparison);
        } elseif ($internalMail instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InternalMailPeer::REPLYID, $internalMail->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByInternalMailRelatedByReplyid() only accepts arguments of type InternalMail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InternalMailRelatedByReplyid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function joinInternalMailRelatedByReplyid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InternalMailRelatedByReplyid');

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
            $this->addJoinObject($join, 'InternalMailRelatedByReplyid');
        }

        return $this;
    }

    /**
     * Use the InternalMailRelatedByReplyid relation InternalMail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   InternalMailQuery A secondary query class using the current class as primary query
     */
    public function useInternalMailRelatedByReplyidQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInternalMailRelatedByReplyid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InternalMailRelatedByReplyid', 'InternalMailQuery');
    }

    /**
     * Filter the query by a related InternalMail object
     *
     * @param   InternalMail|PropelObjectCollection $internalMail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   InternalMailQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByInternalMailRelatedById($internalMail, $comparison = null)
    {
        if ($internalMail instanceof InternalMail) {
            return $this
                ->addUsingAlias(InternalMailPeer::ID, $internalMail->getReplyid(), $comparison);
        } elseif ($internalMail instanceof PropelObjectCollection) {
            return $this
                ->useInternalMailRelatedByIdQuery()
                ->filterByPrimaryKeys($internalMail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInternalMailRelatedById() only accepts arguments of type InternalMail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the InternalMailRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function joinInternalMailRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('InternalMailRelatedById');

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
            $this->addJoinObject($join, 'InternalMailRelatedById');
        }

        return $this;
    }

    /**
     * Use the InternalMailRelatedById relation InternalMail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   InternalMailQuery A secondary query class using the current class as primary query
     */
    public function useInternalMailRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInternalMailRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'InternalMailRelatedById', 'InternalMailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   InternalMail $internalMail Object to remove from the list of results
     *
     * @return InternalMailQuery The current query, for fluid interface
     */
    public function prune($internalMail = null)
    {
        if ($internalMail) {
            $this->addUsingAlias(InternalMailPeer::ID, $internalMail->getId(), Criteria::NOT_EQUAL);
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
        if (InternalMailQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            $this->addUsingAlias(InternalMailPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            InternalMailPeer::enableSoftDelete();
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
        if (InternalMailQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            return $this->softDelete($con);
        } else {
            return $this->hasWhereClause() ? $this->forceDelete($con) : $this->forceDeleteAll($con);
        }

        return $this->preDelete($con);
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     InternalMailQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(InternalMailPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     InternalMailQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(InternalMailPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     InternalMailQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(InternalMailPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     InternalMailQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(InternalMailPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     InternalMailQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(InternalMailPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     InternalMailQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(InternalMailPeer::CREATED_AT);
    }
    // soft_delete behavior

    /**
     * Temporarily disable the filter on deleted rows
     * Valid only for the current query
     *
     * @see InternalMailQuery::disableSoftDelete() to disable the filter for more than one query
     *
     * @return InternalMailQuery The current query, for fluid interface
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
        return InternalMailPeer::doForceDelete($this, $con);
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
        return InternalMailPeer::doForceDeleteAll($con);}

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
