<?php


/**
 * Base class that represents a query for the 'users_user' table.
 *
 * Users
 *
 * @method UserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method UserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method UserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method UserQuery orderByPasswordupdated($order = Criteria::ASC) Order by the passwordUpdated column
 * @method UserQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method UserQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method UserQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method UserQuery orderByLevelid($order = Criteria::ASC) Order by the levelId column
 * @method UserQuery orderByLastlogin($order = Criteria::ASC) Order by the lastLogin column
 * @method UserQuery orderByTimezone($order = Criteria::ASC) Order by the timezone column
 * @method UserQuery orderByRecoveryhash($order = Criteria::ASC) Order by the recoveryHash column
 * @method UserQuery orderByRecoveryhashcreatedon($order = Criteria::ASC) Order by the recoveryHashCreatedOn column
 * @method UserQuery orderByMailaddress($order = Criteria::ASC) Order by the mailAddress column
 * @method UserQuery orderByMailaddressalt($order = Criteria::ASC) Order by the mailAddressAlt column
 * @method UserQuery orderBySession($order = Criteria::ASC) Order by the session column
 * @method UserQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 * @method UserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UserQuery groupById() Group by the id column
 * @method UserQuery groupByUsername() Group by the username column
 * @method UserQuery groupByPassword() Group by the password column
 * @method UserQuery groupByPasswordupdated() Group by the passwordUpdated column
 * @method UserQuery groupByName() Group by the name column
 * @method UserQuery groupBySurname() Group by the surname column
 * @method UserQuery groupByActive() Group by the active column
 * @method UserQuery groupByLevelid() Group by the levelId column
 * @method UserQuery groupByLastlogin() Group by the lastLogin column
 * @method UserQuery groupByTimezone() Group by the timezone column
 * @method UserQuery groupByRecoveryhash() Group by the recoveryHash column
 * @method UserQuery groupByRecoveryhashcreatedon() Group by the recoveryHashCreatedOn column
 * @method UserQuery groupByMailaddress() Group by the mailAddress column
 * @method UserQuery groupByMailaddressalt() Group by the mailAddressAlt column
 * @method UserQuery groupBySession() Group by the session column
 * @method UserQuery groupByDeletedAt() Group by the deleted_at column
 * @method UserQuery groupByCreatedAt() Group by the created_at column
 * @method UserQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserQuery leftJoinLevel($relationAlias = null) Adds a LEFT JOIN clause to the query using the Level relation
 * @method UserQuery rightJoinLevel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Level relation
 * @method UserQuery innerJoinLevel($relationAlias = null) Adds a INNER JOIN clause to the query using the Level relation
 *
 * @method UserQuery leftJoinAlertSubscriptionUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the AlertSubscriptionUser relation
 * @method UserQuery rightJoinAlertSubscriptionUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AlertSubscriptionUser relation
 * @method UserQuery innerJoinAlertSubscriptionUser($relationAlias = null) Adds a INNER JOIN clause to the query using the AlertSubscriptionUser relation
 *
 * @method UserQuery leftJoinScheduleSubscriptionUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the ScheduleSubscriptionUser relation
 * @method UserQuery rightJoinScheduleSubscriptionUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ScheduleSubscriptionUser relation
 * @method UserQuery innerJoinScheduleSubscriptionUser($relationAlias = null) Adds a INNER JOIN clause to the query using the ScheduleSubscriptionUser relation
 *
 * @method UserQuery leftJoinUserGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserGroup relation
 * @method UserQuery rightJoinUserGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserGroup relation
 * @method UserQuery innerJoinUserGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the UserGroup relation
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneById(int $id) Return the first User filtered by the id column
 * @method User findOneByUsername(string $username) Return the first User filtered by the username column
 * @method User findOneByPassword(string $password) Return the first User filtered by the password column
 * @method User findOneByPasswordupdated(string $passwordUpdated) Return the first User filtered by the passwordUpdated column
 * @method User findOneByName(string $name) Return the first User filtered by the name column
 * @method User findOneBySurname(string $surname) Return the first User filtered by the surname column
 * @method User findOneByActive(boolean $active) Return the first User filtered by the active column
 * @method User findOneByLevelid(int $levelId) Return the first User filtered by the levelId column
 * @method User findOneByLastlogin(string $lastLogin) Return the first User filtered by the lastLogin column
 * @method User findOneByTimezone(string $timezone) Return the first User filtered by the timezone column
 * @method User findOneByRecoveryhash(string $recoveryHash) Return the first User filtered by the recoveryHash column
 * @method User findOneByRecoveryhashcreatedon(string $recoveryHashCreatedOn) Return the first User filtered by the recoveryHashCreatedOn column
 * @method User findOneByMailaddress(string $mailAddress) Return the first User filtered by the mailAddress column
 * @method User findOneByMailaddressalt(string $mailAddressAlt) Return the first User filtered by the mailAddressAlt column
 * @method User findOneBySession(string $session) Return the first User filtered by the session column
 * @method User findOneByDeletedAt(string $deleted_at) Return the first User filtered by the deleted_at column
 * @method User findOneByCreatedAt(string $created_at) Return the first User filtered by the created_at column
 * @method User findOneByUpdatedAt(string $updated_at) Return the first User filtered by the updated_at column
 *
 * @method array findById(int $id) Return User objects filtered by the id column
 * @method array findByUsername(string $username) Return User objects filtered by the username column
 * @method array findByPassword(string $password) Return User objects filtered by the password column
 * @method array findByPasswordupdated(string $passwordUpdated) Return User objects filtered by the passwordUpdated column
 * @method array findByName(string $name) Return User objects filtered by the name column
 * @method array findBySurname(string $surname) Return User objects filtered by the surname column
 * @method array findByActive(boolean $active) Return User objects filtered by the active column
 * @method array findByLevelid(int $levelId) Return User objects filtered by the levelId column
 * @method array findByLastlogin(string $lastLogin) Return User objects filtered by the lastLogin column
 * @method array findByTimezone(string $timezone) Return User objects filtered by the timezone column
 * @method array findByRecoveryhash(string $recoveryHash) Return User objects filtered by the recoveryHash column
 * @method array findByRecoveryhashcreatedon(string $recoveryHashCreatedOn) Return User objects filtered by the recoveryHashCreatedOn column
 * @method array findByMailaddress(string $mailAddress) Return User objects filtered by the mailAddress column
 * @method array findByMailaddressalt(string $mailAddressAlt) Return User objects filtered by the mailAddressAlt column
 * @method array findBySession(string $session) Return User objects filtered by the session column
 * @method array findByDeletedAt(string $deleted_at) Return User objects filtered by the deleted_at column
 * @method array findByCreatedAt(string $created_at) Return User objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return User objects filtered by the updated_at column
 *
 * @package    propel.generator.users.classes.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    // soft_delete behavior
    protected static $softDelete = true;
    protected $localSoftDelete = true;

    /**
     * Initializes internal state of BaseUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery();
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
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   User A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `USERNAME`, `PASSWORD`, `PASSWORDUPDATED`, `NAME`, `SURNAME`, `ACTIVE`, `LEVELID`, `LASTLOGIN`, `TIMEZONE`, `RECOVERYHASH`, `RECOVERYHASHCREATEDON`, `MAILADDRESS`, `MAILADDRESSALT`, `SESSION`, `DELETED_AT`, `CREATED_AT`, `UPDATED_AT` FROM `users_user` WHERE `ID` = :p0';
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
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return User|User[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::ID, $keys, Criteria::IN);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(UserPeer::ID, $id, $comparison);
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
     * @return UserQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserPeer::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the passwordUpdated column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordupdated('2011-03-14'); // WHERE passwordUpdated = '2011-03-14'
     * $query->filterByPasswordupdated('now'); // WHERE passwordUpdated = '2011-03-14'
     * $query->filterByPasswordupdated(array('max' => 'yesterday')); // WHERE passwordUpdated > '2011-03-13'
     * </code>
     *
     * @param     mixed $passwordupdated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPasswordupdated($passwordupdated = null, $comparison = null)
    {
        if (is_array($passwordupdated)) {
            $useMinMax = false;
            if (isset($passwordupdated['min'])) {
                $this->addUsingAlias(UserPeer::PASSWORDUPDATED, $passwordupdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($passwordupdated['max'])) {
                $this->addUsingAlias(UserPeer::PASSWORDUPDATED, $passwordupdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::PASSWORDUPDATED, $passwordupdated, $comparison);
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
     * @return UserQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the surname column
     *
     * Example usage:
     * <code>
     * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
     * $query->filterBySurname('%fooValue%'); // WHERE surname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $surname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterBySurname($surname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $surname)) {
                $surname = str_replace('*', '%', $surname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::SURNAME, $surname, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the levelId column
     *
     * Example usage:
     * <code>
     * $query->filterByLevelid(1234); // WHERE levelId = 1234
     * $query->filterByLevelid(array(12, 34)); // WHERE levelId IN (12, 34)
     * $query->filterByLevelid(array('min' => 12)); // WHERE levelId > 12
     * </code>
     *
     * @see       filterByLevel()
     *
     * @param     mixed $levelid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLevelid($levelid = null, $comparison = null)
    {
        if (is_array($levelid)) {
            $useMinMax = false;
            if (isset($levelid['min'])) {
                $this->addUsingAlias(UserPeer::LEVELID, $levelid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($levelid['max'])) {
                $this->addUsingAlias(UserPeer::LEVELID, $levelid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::LEVELID, $levelid, $comparison);
    }

    /**
     * Filter the query on the lastLogin column
     *
     * Example usage:
     * <code>
     * $query->filterByLastlogin('2011-03-14'); // WHERE lastLogin = '2011-03-14'
     * $query->filterByLastlogin('now'); // WHERE lastLogin = '2011-03-14'
     * $query->filterByLastlogin(array('max' => 'yesterday')); // WHERE lastLogin > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastlogin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByLastlogin($lastlogin = null, $comparison = null)
    {
        if (is_array($lastlogin)) {
            $useMinMax = false;
            if (isset($lastlogin['min'])) {
                $this->addUsingAlias(UserPeer::LASTLOGIN, $lastlogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastlogin['max'])) {
                $this->addUsingAlias(UserPeer::LASTLOGIN, $lastlogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::LASTLOGIN, $lastlogin, $comparison);
    }

    /**
     * Filter the query on the timezone column
     *
     * Example usage:
     * <code>
     * $query->filterByTimezone('fooValue');   // WHERE timezone = 'fooValue'
     * $query->filterByTimezone('%fooValue%'); // WHERE timezone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $timezone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByTimezone($timezone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timezone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $timezone)) {
                $timezone = str_replace('*', '%', $timezone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::TIMEZONE, $timezone, $comparison);
    }

    /**
     * Filter the query on the recoveryHash column
     *
     * Example usage:
     * <code>
     * $query->filterByRecoveryhash('fooValue');   // WHERE recoveryHash = 'fooValue'
     * $query->filterByRecoveryhash('%fooValue%'); // WHERE recoveryHash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $recoveryhash The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByRecoveryhash($recoveryhash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($recoveryhash)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $recoveryhash)) {
                $recoveryhash = str_replace('*', '%', $recoveryhash);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::RECOVERYHASH, $recoveryhash, $comparison);
    }

    /**
     * Filter the query on the recoveryHashCreatedOn column
     *
     * Example usage:
     * <code>
     * $query->filterByRecoveryhashcreatedon('2011-03-14'); // WHERE recoveryHashCreatedOn = '2011-03-14'
     * $query->filterByRecoveryhashcreatedon('now'); // WHERE recoveryHashCreatedOn = '2011-03-14'
     * $query->filterByRecoveryhashcreatedon(array('max' => 'yesterday')); // WHERE recoveryHashCreatedOn > '2011-03-13'
     * </code>
     *
     * @param     mixed $recoveryhashcreatedon The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByRecoveryhashcreatedon($recoveryhashcreatedon = null, $comparison = null)
    {
        if (is_array($recoveryhashcreatedon)) {
            $useMinMax = false;
            if (isset($recoveryhashcreatedon['min'])) {
                $this->addUsingAlias(UserPeer::RECOVERYHASHCREATEDON, $recoveryhashcreatedon['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recoveryhashcreatedon['max'])) {
                $this->addUsingAlias(UserPeer::RECOVERYHASHCREATEDON, $recoveryhashcreatedon['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::RECOVERYHASHCREATEDON, $recoveryhashcreatedon, $comparison);
    }

    /**
     * Filter the query on the mailAddress column
     *
     * Example usage:
     * <code>
     * $query->filterByMailaddress('fooValue');   // WHERE mailAddress = 'fooValue'
     * $query->filterByMailaddress('%fooValue%'); // WHERE mailAddress LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mailaddress The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByMailaddress($mailaddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mailaddress)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mailaddress)) {
                $mailaddress = str_replace('*', '%', $mailaddress);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::MAILADDRESS, $mailaddress, $comparison);
    }

    /**
     * Filter the query on the mailAddressAlt column
     *
     * Example usage:
     * <code>
     * $query->filterByMailaddressalt('fooValue');   // WHERE mailAddressAlt = 'fooValue'
     * $query->filterByMailaddressalt('%fooValue%'); // WHERE mailAddressAlt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mailaddressalt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByMailaddressalt($mailaddressalt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mailaddressalt)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mailaddressalt)) {
                $mailaddressalt = str_replace('*', '%', $mailaddressalt);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::MAILADDRESSALT, $mailaddressalt, $comparison);
    }

    /**
     * Filter the query on the session column
     *
     * Example usage:
     * <code>
     * $query->filterBySession('fooValue');   // WHERE session = 'fooValue'
     * $query->filterBySession('%fooValue%'); // WHERE session LIKE '%fooValue%'
     * </code>
     *
     * @param     string $session The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterBySession($session = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($session)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $session)) {
                $session = str_replace('*', '%', $session);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::SESSION, $session, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(UserPeer::DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(UserPeer::DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::DELETED_AT, $deletedAt, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Level object
     *
     * @param   Level|PropelObjectCollection $level The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByLevel($level, $comparison = null)
    {
        if ($level instanceof Level) {
            return $this
                ->addUsingAlias(UserPeer::LEVELID, $level->getId(), $comparison);
        } elseif ($level instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::LEVELID, $level->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLevel() only accepts arguments of type Level or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Level relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinLevel($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Level');

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
            $this->addJoinObject($join, 'Level');
        }

        return $this;
    }

    /**
     * Use the Level relation Level object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   LevelQuery A secondary query class using the current class as primary query
     */
    public function useLevelQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLevel($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Level', 'LevelQuery');
    }

    /**
     * Filter the query by a related AlertSubscriptionUser object
     *
     * @param   AlertSubscriptionUser|PropelObjectCollection $alertSubscriptionUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAlertSubscriptionUser($alertSubscriptionUser, $comparison = null)
    {
        if ($alertSubscriptionUser instanceof AlertSubscriptionUser) {
            return $this
                ->addUsingAlias(UserPeer::ID, $alertSubscriptionUser->getUserid(), $comparison);
        } elseif ($alertSubscriptionUser instanceof PropelObjectCollection) {
            return $this
                ->useAlertSubscriptionUserQuery()
                ->filterByPrimaryKeys($alertSubscriptionUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAlertSubscriptionUser() only accepts arguments of type AlertSubscriptionUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AlertSubscriptionUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinAlertSubscriptionUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AlertSubscriptionUser');

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
            $this->addJoinObject($join, 'AlertSubscriptionUser');
        }

        return $this;
    }

    /**
     * Use the AlertSubscriptionUser relation AlertSubscriptionUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AlertSubscriptionUserQuery A secondary query class using the current class as primary query
     */
    public function useAlertSubscriptionUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAlertSubscriptionUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AlertSubscriptionUser', 'AlertSubscriptionUserQuery');
    }

    /**
     * Filter the query by a related ScheduleSubscriptionUser object
     *
     * @param   ScheduleSubscriptionUser|PropelObjectCollection $scheduleSubscriptionUser  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByScheduleSubscriptionUser($scheduleSubscriptionUser, $comparison = null)
    {
        if ($scheduleSubscriptionUser instanceof ScheduleSubscriptionUser) {
            return $this
                ->addUsingAlias(UserPeer::ID, $scheduleSubscriptionUser->getUserid(), $comparison);
        } elseif ($scheduleSubscriptionUser instanceof PropelObjectCollection) {
            return $this
                ->useScheduleSubscriptionUserQuery()
                ->filterByPrimaryKeys($scheduleSubscriptionUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByScheduleSubscriptionUser() only accepts arguments of type ScheduleSubscriptionUser or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ScheduleSubscriptionUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinScheduleSubscriptionUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ScheduleSubscriptionUser');

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
            $this->addJoinObject($join, 'ScheduleSubscriptionUser');
        }

        return $this;
    }

    /**
     * Use the ScheduleSubscriptionUser relation ScheduleSubscriptionUser object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ScheduleSubscriptionUserQuery A secondary query class using the current class as primary query
     */
    public function useScheduleSubscriptionUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinScheduleSubscriptionUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ScheduleSubscriptionUser', 'ScheduleSubscriptionUserQuery');
    }

    /**
     * Filter the query by a related UserGroup object
     *
     * @param   UserGroup|PropelObjectCollection $userGroup  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByUserGroup($userGroup, $comparison = null)
    {
        if ($userGroup instanceof UserGroup) {
            return $this
                ->addUsingAlias(UserPeer::ID, $userGroup->getUserid(), $comparison);
        } elseif ($userGroup instanceof PropelObjectCollection) {
            return $this
                ->useUserGroupQuery()
                ->filterByPrimaryKeys($userGroup->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserGroup() only accepts arguments of type UserGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUserGroup($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserGroup');

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
            $this->addJoinObject($join, 'UserGroup');
        }

        return $this;
    }

    /**
     * Use the UserGroup relation UserGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   UserGroupQuery A secondary query class using the current class as primary query
     */
    public function useUserGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserGroup', 'UserGroupQuery');
    }

    /**
     * Filter the query by a related AlertSubscription object
     * using the services_alertSubscriptionUser table as cross reference
     *
     * @param   AlertSubscription $alertSubscription the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByAlertSubscription($alertSubscription, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useAlertSubscriptionUserQuery()
            ->filterByAlertSubscription($alertSubscription, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related ScheduleSubscription object
     * using the services_scheduleSubscriptionUser table as cross reference
     *
     * @param   ScheduleSubscription $scheduleSubscription the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByScheduleSubscription($scheduleSubscription, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useScheduleSubscriptionUserQuery()
            ->filterByScheduleSubscription($scheduleSubscription, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Group object
     * using the users_userGroup table as cross reference
     *
     * @param   Group $group the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   UserQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useUserGroupQuery()
            ->filterByGroup($group, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::ID, $user->getId(), Criteria::NOT_EQUAL);
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
        if (UserQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            $this->addUsingAlias(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
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
        if (UserQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
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
     * @see UserQuery::disableSoftDelete() to disable the filter for more than one query
     *
     * @return UserQuery The current query, for fluid interface
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
        return UserPeer::doForceDelete($this, $con);
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
        return UserPeer::doForceDeleteAll($con);}

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

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeer::CREATED_AT);
    }
}
