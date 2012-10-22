<?php


/**
 * Base class that represents a query for the 'multilang_language' table.
 *
 *
 *
 * @method MultilangLanguageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MultilangLanguageQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method MultilangLanguageQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method MultilangLanguageQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 *
 * @method MultilangLanguageQuery groupById() Group by the id column
 * @method MultilangLanguageQuery groupByName() Group by the name column
 * @method MultilangLanguageQuery groupByCode() Group by the code column
 * @method MultilangLanguageQuery groupByLocale() Group by the locale column
 *
 * @method MultilangLanguageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MultilangLanguageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MultilangLanguageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MultilangLanguageQuery leftJoinMultilangText($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultilangText relation
 * @method MultilangLanguageQuery rightJoinMultilangText($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultilangText relation
 * @method MultilangLanguageQuery innerJoinMultilangText($relationAlias = null) Adds a INNER JOIN clause to the query using the MultilangText relation
 *
 * @method MultilangLanguage findOne(PropelPDO $con = null) Return the first MultilangLanguage matching the query
 * @method MultilangLanguage findOneOrCreate(PropelPDO $con = null) Return the first MultilangLanguage matching the query, or a new MultilangLanguage object populated from the query conditions when no match is found
 *
 * @method MultilangLanguage findOneById(int $id) Return the first MultilangLanguage filtered by the id column
 * @method MultilangLanguage findOneByName(string $name) Return the first MultilangLanguage filtered by the name column
 * @method MultilangLanguage findOneByCode(string $code) Return the first MultilangLanguage filtered by the code column
 * @method MultilangLanguage findOneByLocale(string $locale) Return the first MultilangLanguage filtered by the locale column
 *
 * @method array findById(int $id) Return MultilangLanguage objects filtered by the id column
 * @method array findByName(string $name) Return MultilangLanguage objects filtered by the name column
 * @method array findByCode(string $code) Return MultilangLanguage objects filtered by the code column
 * @method array findByLocale(string $locale) Return MultilangLanguage objects filtered by the locale column
 *
 * @package    propel.generator.services.classes.om
 */
abstract class BaseMultilangLanguageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMultilangLanguageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'MultilangLanguage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MultilangLanguageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MultilangLanguageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MultilangLanguageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MultilangLanguageQuery) {
            return $criteria;
        }
        $query = new MultilangLanguageQuery();
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
     * @return   MultilangLanguage|MultilangLanguage[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MultilangLanguagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MultilangLanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MultilangLanguage A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `CODE`, `LOCALE` FROM `multilang_language` WHERE `ID` = :p0';
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
            $obj = new MultilangLanguage();
            $obj->hydrate($row);
            MultilangLanguagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return MultilangLanguage|MultilangLanguage[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MultilangLanguage[]|mixed the list of results, formatted by the current formatter
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
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MultilangLanguagePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MultilangLanguagePeer::ID, $keys, Criteria::IN);
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
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MultilangLanguagePeer::ID, $id, $comparison);
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
     * @return MultilangLanguageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MultilangLanguagePeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MultilangLanguagePeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MultilangLanguagePeer::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query by a related MultilangText object
     *
     * @param   MultilangText|PropelObjectCollection $multilangText  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultilangLanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMultilangText($multilangText, $comparison = null)
    {
        if ($multilangText instanceof MultilangText) {
            return $this
                ->addUsingAlias(MultilangLanguagePeer::CODE, $multilangText->getLanguagecode(), $comparison);
        } elseif ($multilangText instanceof PropelObjectCollection) {
            return $this
                ->useMultilangTextQuery()
                ->filterByPrimaryKeys($multilangText->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMultilangText() only accepts arguments of type MultilangText or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultilangText relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function joinMultilangText($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultilangText');

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
            $this->addJoinObject($join, 'MultilangText');
        }

        return $this;
    }

    /**
     * Use the MultilangText relation MultilangText object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   MultilangTextQuery A secondary query class using the current class as primary query
     */
    public function useMultilangTextQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMultilangText($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultilangText', 'MultilangTextQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MultilangLanguage $multilangLanguage Object to remove from the list of results
     *
     * @return MultilangLanguageQuery The current query, for fluid interface
     */
    public function prune($multilangLanguage = null)
    {
        if ($multilangLanguage) {
            $this->addUsingAlias(MultilangLanguagePeer::ID, $multilangLanguage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
