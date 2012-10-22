<?php


/**
 * Base class that represents a query for the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * @method AffiliateQuery orderById($order = Criteria::ASC) Order by the id column
 * @method AffiliateQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method AffiliateQuery orderByOwnerid($order = Criteria::ASC) Order by the ownerId column
 * @method AffiliateQuery orderByInternalnumber($order = Criteria::ASC) Order by the internalNumber column
 * @method AffiliateQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method AffiliateQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method AffiliateQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method AffiliateQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method AffiliateQuery orderByContactemail($order = Criteria::ASC) Order by the contactEmail column
 * @method AffiliateQuery orderByWeb($order = Criteria::ASC) Order by the web column
 * @method AffiliateQuery orderByMemo($order = Criteria::ASC) Order by the memo column
 * @method AffiliateQuery orderByClassKey($order = Criteria::ASC) Order by the class_key column
 * @method AffiliateQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method AffiliateQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method AffiliateQuery groupById() Group by the id column
 * @method AffiliateQuery groupByName() Group by the name column
 * @method AffiliateQuery groupByOwnerid() Group by the ownerId column
 * @method AffiliateQuery groupByInternalnumber() Group by the internalNumber column
 * @method AffiliateQuery groupByAddress() Group by the address column
 * @method AffiliateQuery groupByPhone() Group by the phone column
 * @method AffiliateQuery groupByEmail() Group by the email column
 * @method AffiliateQuery groupByContact() Group by the contact column
 * @method AffiliateQuery groupByContactemail() Group by the contactEmail column
 * @method AffiliateQuery groupByWeb() Group by the web column
 * @method AffiliateQuery groupByMemo() Group by the memo column
 * @method AffiliateQuery groupByClassKey() Group by the class_key column
 * @method AffiliateQuery groupByCreatedAt() Group by the created_at column
 * @method AffiliateQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method AffiliateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AffiliateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AffiliateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AffiliateQuery leftJoinAffiliateUserRelatedByOwnerid($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateUserRelatedByOwnerid relation
 * @method AffiliateQuery rightJoinAffiliateUserRelatedByOwnerid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateUserRelatedByOwnerid relation
 * @method AffiliateQuery innerJoinAffiliateUserRelatedByOwnerid($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateUserRelatedByOwnerid relation
 *
 * @method AffiliateQuery leftJoinAffiliateUserRelatedByAffiliateid($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateUserRelatedByAffiliateid relation
 * @method AffiliateQuery rightJoinAffiliateUserRelatedByAffiliateid($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateUserRelatedByAffiliateid relation
 * @method AffiliateQuery innerJoinAffiliateUserRelatedByAffiliateid($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateUserRelatedByAffiliateid relation
 *
 * @method AffiliateQuery leftJoinAffiliateBranch($relationAlias = null) Adds a LEFT JOIN clause to the query using the AffiliateBranch relation
 * @method AffiliateQuery rightJoinAffiliateBranch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AffiliateBranch relation
 * @method AffiliateQuery innerJoinAffiliateBranch($relationAlias = null) Adds a INNER JOIN clause to the query using the AffiliateBranch relation
 *
 * @method AffiliateQuery leftJoinRequirement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Requirement relation
 * @method AffiliateQuery rightJoinRequirement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Requirement relation
 * @method AffiliateQuery innerJoinRequirement($relationAlias = null) Adds a INNER JOIN clause to the query using the Requirement relation
 *
 * @method AffiliateQuery leftJoinDevelopment($relationAlias = null) Adds a LEFT JOIN clause to the query using the Development relation
 * @method AffiliateQuery rightJoinDevelopment($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Development relation
 * @method AffiliateQuery innerJoinDevelopment($relationAlias = null) Adds a INNER JOIN clause to the query using the Development relation
 *
 * @method Affiliate findOne(PropelPDO $con = null) Return the first Affiliate matching the query
 * @method Affiliate findOneOrCreate(PropelPDO $con = null) Return the first Affiliate matching the query, or a new Affiliate object populated from the query conditions when no match is found
 *
 * @method Affiliate findOneById(int $id) Return the first Affiliate filtered by the id column
 * @method Affiliate findOneByName(string $name) Return the first Affiliate filtered by the name column
 * @method Affiliate findOneByOwnerid(int $ownerId) Return the first Affiliate filtered by the ownerId column
 * @method Affiliate findOneByInternalnumber(string $internalNumber) Return the first Affiliate filtered by the internalNumber column
 * @method Affiliate findOneByAddress(string $address) Return the first Affiliate filtered by the address column
 * @method Affiliate findOneByPhone(string $phone) Return the first Affiliate filtered by the phone column
 * @method Affiliate findOneByEmail(string $email) Return the first Affiliate filtered by the email column
 * @method Affiliate findOneByContact(string $contact) Return the first Affiliate filtered by the contact column
 * @method Affiliate findOneByContactemail(string $contactEmail) Return the first Affiliate filtered by the contactEmail column
 * @method Affiliate findOneByWeb(string $web) Return the first Affiliate filtered by the web column
 * @method Affiliate findOneByMemo(string $memo) Return the first Affiliate filtered by the memo column
 * @method Affiliate findOneByClassKey(int $class_key) Return the first Affiliate filtered by the class_key column
 * @method Affiliate findOneByCreatedAt(string $created_at) Return the first Affiliate filtered by the created_at column
 * @method Affiliate findOneByUpdatedAt(string $updated_at) Return the first Affiliate filtered by the updated_at column
 *
 * @method array findById(int $id) Return Affiliate objects filtered by the id column
 * @method array findByName(string $name) Return Affiliate objects filtered by the name column
 * @method array findByOwnerid(int $ownerId) Return Affiliate objects filtered by the ownerId column
 * @method array findByInternalnumber(string $internalNumber) Return Affiliate objects filtered by the internalNumber column
 * @method array findByAddress(string $address) Return Affiliate objects filtered by the address column
 * @method array findByPhone(string $phone) Return Affiliate objects filtered by the phone column
 * @method array findByEmail(string $email) Return Affiliate objects filtered by the email column
 * @method array findByContact(string $contact) Return Affiliate objects filtered by the contact column
 * @method array findByContactemail(string $contactEmail) Return Affiliate objects filtered by the contactEmail column
 * @method array findByWeb(string $web) Return Affiliate objects filtered by the web column
 * @method array findByMemo(string $memo) Return Affiliate objects filtered by the memo column
 * @method array findByClassKey(int $class_key) Return Affiliate objects filtered by the class_key column
 * @method array findByCreatedAt(string $created_at) Return Affiliate objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Affiliate objects filtered by the updated_at column
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAffiliateQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'Affiliate', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AffiliateQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AffiliateQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AffiliateQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AffiliateQuery) {
            return $criteria;
        }
        $query = new AffiliateQuery();
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
     * @return   Affiliate|Affiliate[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AffiliatePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Affiliate A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `OWNERID`, `INTERNALNUMBER`, `ADDRESS`, `PHONE`, `EMAIL`, `CONTACT`, `CONTACTEMAIL`, `WEB`, `MEMO`, `CLASS_KEY`, `CREATED_AT`, `UPDATED_AT` FROM `affiliates_affiliate` WHERE `ID` = :p0';
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
            $cls = AffiliatePeer::getOMClass($row, 0);
            $obj = new $cls();
            $obj->hydrate($row);
            AffiliatePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Affiliate|Affiliate[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Affiliate[]|mixed the list of results, formatted by the current formatter
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
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AffiliatePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AffiliatePeer::ID, $keys, Criteria::IN);
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
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AffiliatePeer::ID, $id, $comparison);
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
     * @return AffiliateQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliatePeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the ownerId column
     *
     * Example usage:
     * <code>
     * $query->filterByOwnerid(1234); // WHERE ownerId = 1234
     * $query->filterByOwnerid(array(12, 34)); // WHERE ownerId IN (12, 34)
     * $query->filterByOwnerid(array('min' => 12)); // WHERE ownerId > 12
     * </code>
     *
     * @see       filterByAffiliateUserRelatedByOwnerid()
     *
     * @param     mixed $ownerid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByOwnerid($ownerid = null, $comparison = null)
    {
        if (is_array($ownerid)) {
            $useMinMax = false;
            if (isset($ownerid['min'])) {
                $this->addUsingAlias(AffiliatePeer::OWNERID, $ownerid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ownerid['max'])) {
                $this->addUsingAlias(AffiliatePeer::OWNERID, $ownerid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::OWNERID, $ownerid, $comparison);
    }

    /**
     * Filter the query on the internalNumber column
     *
     * Example usage:
     * <code>
     * $query->filterByInternalnumber('fooValue');   // WHERE internalNumber = 'fooValue'
     * $query->filterByInternalnumber('%fooValue%'); // WHERE internalNumber LIKE '%fooValue%'
     * </code>
     *
     * @param     string $internalnumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByInternalnumber($internalnumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($internalnumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $internalnumber)) {
                $internalnumber = str_replace('*', '%', $internalnumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::INTERNALNUMBER, $internalnumber, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::PHONE, $phone, $comparison);
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
     * @return AffiliateQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliatePeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the contact column
     *
     * Example usage:
     * <code>
     * $query->filterByContact('fooValue');   // WHERE contact = 'fooValue'
     * $query->filterByContact('%fooValue%'); // WHERE contact LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contact The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByContact($contact = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contact)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contact)) {
                $contact = str_replace('*', '%', $contact);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::CONTACT, $contact, $comparison);
    }

    /**
     * Filter the query on the contactEmail column
     *
     * Example usage:
     * <code>
     * $query->filterByContactemail('fooValue');   // WHERE contactEmail = 'fooValue'
     * $query->filterByContactemail('%fooValue%'); // WHERE contactEmail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactemail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByContactemail($contactemail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactemail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactemail)) {
                $contactemail = str_replace('*', '%', $contactemail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::CONTACTEMAIL, $contactemail, $comparison);
    }

    /**
     * Filter the query on the web column
     *
     * Example usage:
     * <code>
     * $query->filterByWeb('fooValue');   // WHERE web = 'fooValue'
     * $query->filterByWeb('%fooValue%'); // WHERE web LIKE '%fooValue%'
     * </code>
     *
     * @param     string $web The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByWeb($web = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($web)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $web)) {
                $web = str_replace('*', '%', $web);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::WEB, $web, $comparison);
    }

    /**
     * Filter the query on the memo column
     *
     * Example usage:
     * <code>
     * $query->filterByMemo('fooValue');   // WHERE memo = 'fooValue'
     * $query->filterByMemo('%fooValue%'); // WHERE memo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $memo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByMemo($memo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($memo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $memo)) {
                $memo = str_replace('*', '%', $memo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::MEMO, $memo, $comparison);
    }

    /**
     * Filter the query on the class_key column
     *
     * Example usage:
     * <code>
     * $query->filterByClassKey(1234); // WHERE class_key = 1234
     * $query->filterByClassKey(array(12, 34)); // WHERE class_key IN (12, 34)
     * $query->filterByClassKey(array('min' => 12)); // WHERE class_key > 12
     * </code>
     *
     * @param     mixed $classKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByClassKey($classKey = null, $comparison = null)
    {
        if (is_array($classKey)) {
            $useMinMax = false;
            if (isset($classKey['min'])) {
                $this->addUsingAlias(AffiliatePeer::CLASS_KEY, $classKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($classKey['max'])) {
                $this->addUsingAlias(AffiliatePeer::CLASS_KEY, $classKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::CLASS_KEY, $classKey, $comparison);
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
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(AffiliatePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AffiliatePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(AffiliatePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AffiliatePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliatePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related AffiliateUser object
     *
     * @param   AffiliateUser|PropelObjectCollection $affiliateUser The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateUserRelatedByOwnerid($affiliateUser, $comparison = null)
    {
        if ($affiliateUser instanceof AffiliateUser) {
            return $this
                ->addUsingAlias(AffiliatePeer::OWNERID, $affiliateUser->getId(), $comparison);
        } elseif ($affiliateUser instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AffiliatePeer::OWNERID, $affiliateUser->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAffiliateUserRelatedByOwnerid() only accepts arguments of type AffiliateUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AffiliateUserRelatedByOwnerid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function joinAffiliateUserRelatedByOwnerid($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AffiliateUserRelatedByOwnerid');

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
            $this->addJoinObject($join, 'AffiliateUserRelatedByOwnerid');
        }

        return $this;
    }

    /**
     * Use the AffiliateUserRelatedByOwnerid relation AffiliateUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateUserQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateUserRelatedByOwneridQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAffiliateUserRelatedByOwnerid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateUserRelatedByOwnerid', 'AffiliateUserQuery');
    }

    /**
     * Filter the query by a related AffiliateUser object
     *
     * @param   AffiliateUser|PropelObjectCollection $affiliateUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateUserRelatedByAffiliateid($affiliateUser, $comparison = null)
    {
        if ($affiliateUser instanceof AffiliateUser) {
            return $this
                ->addUsingAlias(AffiliatePeer::ID, $affiliateUser->getAffiliateid(), $comparison);
        } elseif ($affiliateUser instanceof PropelObjectCollection) {
            return $this
                ->useAffiliateUserRelatedByAffiliateidQuery()
                ->filterByPrimaryKeys($affiliateUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAffiliateUserRelatedByAffiliateid() only accepts arguments of type AffiliateUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AffiliateUserRelatedByAffiliateid relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function joinAffiliateUserRelatedByAffiliateid($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AffiliateUserRelatedByAffiliateid');

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
            $this->addJoinObject($join, 'AffiliateUserRelatedByAffiliateid');
        }

        return $this;
    }

    /**
     * Use the AffiliateUserRelatedByAffiliateid relation AffiliateUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateUserQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateUserRelatedByAffiliateidQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAffiliateUserRelatedByAffiliateid($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateUserRelatedByAffiliateid', 'AffiliateUserQuery');
    }

    /**
     * Filter the query by a related AffiliateBranch object
     *
     * @param   AffiliateBranch|PropelObjectCollection $affiliateBranch  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliateBranch($affiliateBranch, $comparison = null)
    {
        if ($affiliateBranch instanceof AffiliateBranch) {
            return $this
                ->addUsingAlias(AffiliatePeer::ID, $affiliateBranch->getAffiliateid(), $comparison);
        } elseif ($affiliateBranch instanceof PropelObjectCollection) {
            return $this
                ->useAffiliateBranchQuery()
                ->filterByPrimaryKeys($affiliateBranch->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAffiliateBranch() only accepts arguments of type AffiliateBranch or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AffiliateBranch relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function joinAffiliateBranch($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AffiliateBranch');

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
            $this->addJoinObject($join, 'AffiliateBranch');
        }

        return $this;
    }

    /**
     * Use the AffiliateBranch relation AffiliateBranch object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateBranchQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateBranchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAffiliateBranch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AffiliateBranch', 'AffiliateBranchQuery');
    }

    /**
     * Filter the query by a related Requirement object
     *
     * @param   Requirement|PropelObjectCollection $requirement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRequirement($requirement, $comparison = null)
    {
        if ($requirement instanceof Requirement) {
            return $this
                ->addUsingAlias(AffiliatePeer::ID, $requirement->getClientid(), $comparison);
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
     * @return AffiliateQuery The current query, for fluid interface
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
     * Filter the query by a related Development object
     *
     * @param   Development|PropelObjectCollection $development  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDevelopment($development, $comparison = null)
    {
        if ($development instanceof Development) {
            return $this
                ->addUsingAlias(AffiliatePeer::ID, $development->getClientid(), $comparison);
        } elseif ($development instanceof PropelObjectCollection) {
            return $this
                ->useDevelopmentQuery()
                ->filterByPrimaryKeys($development->getPrimaryKeys())
                ->endUse();
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
     * @return AffiliateQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Affiliate $affiliate Object to remove from the list of results
     *
     * @return AffiliateQuery The current query, for fluid interface
     */
    public function prune($affiliate = null)
    {
        if ($affiliate) {
            $this->addUsingAlias(AffiliatePeer::ID, $affiliate->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     AffiliateQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(AffiliatePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     AffiliateQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(AffiliatePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     AffiliateQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(AffiliatePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     AffiliateQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(AffiliatePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     AffiliateQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(AffiliatePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     AffiliateQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(AffiliatePeer::CREATED_AT);
    }
}
