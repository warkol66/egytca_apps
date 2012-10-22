<?php


/**
 * Base class that represents a query for the 'security_actionLabel' table.
 *
 * etiquetas de actions de seguridad
 *
 * @method SecurityActionLabelQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SecurityActionLabelQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method SecurityActionLabelQuery orderByLanguage($order = Criteria::ASC) Order by the language column
 * @method SecurityActionLabelQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method SecurityActionLabelQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method SecurityActionLabelQuery groupById() Group by the id column
 * @method SecurityActionLabelQuery groupByAction() Group by the action column
 * @method SecurityActionLabelQuery groupByLanguage() Group by the language column
 * @method SecurityActionLabelQuery groupByLabel() Group by the label column
 * @method SecurityActionLabelQuery groupByDescription() Group by the description column
 *
 * @method SecurityActionLabelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SecurityActionLabelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SecurityActionLabelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SecurityActionLabel findOne(PropelPDO $con = null) Return the first SecurityActionLabel matching the query
 * @method SecurityActionLabel findOneOrCreate(PropelPDO $con = null) Return the first SecurityActionLabel matching the query, or a new SecurityActionLabel object populated from the query conditions when no match is found
 *
 * @method SecurityActionLabel findOneById(int $id) Return the first SecurityActionLabel filtered by the id column
 * @method SecurityActionLabel findOneByAction(string $action) Return the first SecurityActionLabel filtered by the action column
 * @method SecurityActionLabel findOneByLanguage(string $language) Return the first SecurityActionLabel filtered by the language column
 * @method SecurityActionLabel findOneByLabel(string $label) Return the first SecurityActionLabel filtered by the label column
 * @method SecurityActionLabel findOneByDescription(string $description) Return the first SecurityActionLabel filtered by the description column
 *
 * @method array findById(int $id) Return SecurityActionLabel objects filtered by the id column
 * @method array findByAction(string $action) Return SecurityActionLabel objects filtered by the action column
 * @method array findByLanguage(string $language) Return SecurityActionLabel objects filtered by the language column
 * @method array findByLabel(string $label) Return SecurityActionLabel objects filtered by the label column
 * @method array findByDescription(string $description) Return SecurityActionLabel objects filtered by the description column
 *
 * @package    propel.generator.security.classes.om
 */
abstract class BaseSecurityActionLabelQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSecurityActionLabelQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'SecurityActionLabel', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SecurityActionLabelQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SecurityActionLabelQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SecurityActionLabelQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SecurityActionLabelQuery) {
            return $criteria;
        }
        $query = new SecurityActionLabelQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$id, $action]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   SecurityActionLabel|SecurityActionLabel[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SecurityActionLabelPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SecurityActionLabelPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   SecurityActionLabel A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `ACTION`, `LANGUAGE`, `LABEL`, `DESCRIPTION` FROM `security_actionLabel` WHERE `ID` = :p0 AND `ACTION` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new SecurityActionLabel();
            $obj->hydrate($row);
            SecurityActionLabelPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return SecurityActionLabel|SecurityActionLabel[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|SecurityActionLabel[]|mixed the list of results, formatted by the current formatter
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
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SecurityActionLabelPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SecurityActionLabelPeer::ACTION, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SecurityActionLabelPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SecurityActionLabelPeer::ACTION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SecurityActionLabelPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the action column
     *
     * Example usage:
     * <code>
     * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
     * $query->filterByAction('%fooValue%'); // WHERE action LIKE '%fooValue%'
     * </code>
     *
     * @param     string $action The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function filterByAction($action = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($action)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $action)) {
                $action = str_replace('*', '%', $action);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SecurityActionLabelPeer::ACTION, $action, $comparison);
    }

    /**
     * Filter the query on the language column
     *
     * Example usage:
     * <code>
     * $query->filterByLanguage('fooValue');   // WHERE language = 'fooValue'
     * $query->filterByLanguage('%fooValue%'); // WHERE language LIKE '%fooValue%'
     * </code>
     *
     * @param     string $language The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function filterByLanguage($language = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($language)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $language)) {
                $language = str_replace('*', '%', $language);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SecurityActionLabelPeer::LANGUAGE, $language, $comparison);
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $label The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $label)) {
                $label = str_replace('*', '%', $label);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SecurityActionLabelPeer::LABEL, $label, $comparison);
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
     * @return SecurityActionLabelQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SecurityActionLabelPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   SecurityActionLabel $securityActionLabel Object to remove from the list of results
     *
     * @return SecurityActionLabelQuery The current query, for fluid interface
     */
    public function prune($securityActionLabel = null)
    {
        if ($securityActionLabel) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SecurityActionLabelPeer::ID), $securityActionLabel->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SecurityActionLabelPeer::ACTION), $securityActionLabel->getAction(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
