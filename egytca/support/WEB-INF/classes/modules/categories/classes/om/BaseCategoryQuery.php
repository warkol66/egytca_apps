<?php


/**
 * Base class that represents a query for the 'categories_category' table.
 *
 * Categorias
 *
 * @method CategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CategoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method CategoryQuery orderByModule($order = Criteria::ASC) Order by the module column
 * @method CategoryQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method CategoryQuery orderByIspublic($order = Criteria::ASC) Order by the isPublic column
 * @method CategoryQuery orderByResponsible($order = Criteria::ASC) Order by the responsible column
 * @method CategoryQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 * @method CategoryQuery orderByTreeLeft($order = Criteria::ASC) Order by the tree_left column
 * @method CategoryQuery orderByTreeRight($order = Criteria::ASC) Order by the tree_right column
 * @method CategoryQuery orderByTreeLevel($order = Criteria::ASC) Order by the tree_level column
 * @method CategoryQuery orderByScope($order = Criteria::ASC) Order by the scope column
 *
 * @method CategoryQuery groupById() Group by the id column
 * @method CategoryQuery groupByName() Group by the name column
 * @method CategoryQuery groupByModule() Group by the module column
 * @method CategoryQuery groupByActive() Group by the active column
 * @method CategoryQuery groupByIspublic() Group by the isPublic column
 * @method CategoryQuery groupByResponsible() Group by the responsible column
 * @method CategoryQuery groupByDeletedAt() Group by the deleted_at column
 * @method CategoryQuery groupByTreeLeft() Group by the tree_left column
 * @method CategoryQuery groupByTreeRight() Group by the tree_right column
 * @method CategoryQuery groupByTreeLevel() Group by the tree_level column
 * @method CategoryQuery groupByScope() Group by the scope column
 *
 * @method CategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CategoryQuery leftJoinGroupCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the GroupCategory relation
 * @method CategoryQuery rightJoinGroupCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GroupCategory relation
 * @method CategoryQuery innerJoinGroupCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the GroupCategory relation
 *
 * @method Category findOne(PropelPDO $con = null) Return the first Category matching the query
 * @method Category findOneOrCreate(PropelPDO $con = null) Return the first Category matching the query, or a new Category object populated from the query conditions when no match is found
 *
 * @method Category findOneById(int $id) Return the first Category filtered by the id column
 * @method Category findOneByName(string $name) Return the first Category filtered by the name column
 * @method Category findOneByModule(string $module) Return the first Category filtered by the module column
 * @method Category findOneByActive(boolean $active) Return the first Category filtered by the active column
 * @method Category findOneByIspublic(boolean $isPublic) Return the first Category filtered by the isPublic column
 * @method Category findOneByResponsible(string $responsible) Return the first Category filtered by the responsible column
 * @method Category findOneByDeletedAt(string $deleted_at) Return the first Category filtered by the deleted_at column
 * @method Category findOneByTreeLeft(int $tree_left) Return the first Category filtered by the tree_left column
 * @method Category findOneByTreeRight(int $tree_right) Return the first Category filtered by the tree_right column
 * @method Category findOneByTreeLevel(int $tree_level) Return the first Category filtered by the tree_level column
 * @method Category findOneByScope(int $scope) Return the first Category filtered by the scope column
 *
 * @method array findById(int $id) Return Category objects filtered by the id column
 * @method array findByName(string $name) Return Category objects filtered by the name column
 * @method array findByModule(string $module) Return Category objects filtered by the module column
 * @method array findByActive(boolean $active) Return Category objects filtered by the active column
 * @method array findByIspublic(boolean $isPublic) Return Category objects filtered by the isPublic column
 * @method array findByResponsible(string $responsible) Return Category objects filtered by the responsible column
 * @method array findByDeletedAt(string $deleted_at) Return Category objects filtered by the deleted_at column
 * @method array findByTreeLeft(int $tree_left) Return Category objects filtered by the tree_left column
 * @method array findByTreeRight(int $tree_right) Return Category objects filtered by the tree_right column
 * @method array findByTreeLevel(int $tree_level) Return Category objects filtered by the tree_level column
 * @method array findByScope(int $scope) Return Category objects filtered by the scope column
 *
 * @package    propel.generator.categories.classes.om
 */
abstract class BaseCategoryQuery extends ModelCriteria
{
    // soft_delete behavior
    protected static $softDelete = true;
    protected $localSoftDelete = true;

    /**
     * Initializes internal state of BaseCategoryQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'Category', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CategoryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CategoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CategoryQuery) {
            return $criteria;
        }
        $query = new CategoryQuery();
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
     * @return   Category|Category[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CategoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Category A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `MODULE`, `ACTIVE`, `ISPUBLIC`, `RESPONSIBLE`, `DELETED_AT`, `TREE_LEFT`, `TREE_RIGHT`, `TREE_LEVEL`, `SCOPE` FROM `categories_category` WHERE `ID` = :p0';
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
            $obj = new Category();
            $obj->hydrate($row);
            CategoryPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Category|Category[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Category[]|mixed the list of results, formatted by the current formatter
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
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoryPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoryPeer::ID, $keys, Criteria::IN);
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
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CategoryPeer::ID, $id, $comparison);
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
     * @return CategoryQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CategoryPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the module column
     *
     * Example usage:
     * <code>
     * $query->filterByModule('fooValue');   // WHERE module = 'fooValue'
     * $query->filterByModule('%fooValue%'); // WHERE module LIKE '%fooValue%'
     * </code>
     *
     * @param     string $module The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByModule($module = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($module)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $module)) {
                $module = str_replace('*', '%', $module);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoryPeer::MODULE, $module, $comparison);
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
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CategoryPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the isPublic column
     *
     * Example usage:
     * <code>
     * $query->filterByIspublic(true); // WHERE isPublic = true
     * $query->filterByIspublic('yes'); // WHERE isPublic = true
     * </code>
     *
     * @param     boolean|string $ispublic The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByIspublic($ispublic = null, $comparison = null)
    {
        if (is_string($ispublic)) {
            $isPublic = in_array(strtolower($ispublic), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CategoryPeer::ISPUBLIC, $ispublic, $comparison);
    }

    /**
     * Filter the query on the responsible column
     *
     * Example usage:
     * <code>
     * $query->filterByResponsible('fooValue');   // WHERE responsible = 'fooValue'
     * $query->filterByResponsible('%fooValue%'); // WHERE responsible LIKE '%fooValue%'
     * </code>
     *
     * @param     string $responsible The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByResponsible($responsible = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($responsible)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $responsible)) {
                $responsible = str_replace('*', '%', $responsible);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoryPeer::RESPONSIBLE, $responsible, $comparison);
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
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(CategoryPeer::DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(CategoryPeer::DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryPeer::DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Filter the query on the tree_left column
     *
     * Example usage:
     * <code>
     * $query->filterByTreeLeft(1234); // WHERE tree_left = 1234
     * $query->filterByTreeLeft(array(12, 34)); // WHERE tree_left IN (12, 34)
     * $query->filterByTreeLeft(array('min' => 12)); // WHERE tree_left > 12
     * </code>
     *
     * @param     mixed $treeLeft The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByTreeLeft($treeLeft = null, $comparison = null)
    {
        if (is_array($treeLeft)) {
            $useMinMax = false;
            if (isset($treeLeft['min'])) {
                $this->addUsingAlias(CategoryPeer::TREE_LEFT, $treeLeft['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($treeLeft['max'])) {
                $this->addUsingAlias(CategoryPeer::TREE_LEFT, $treeLeft['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryPeer::TREE_LEFT, $treeLeft, $comparison);
    }

    /**
     * Filter the query on the tree_right column
     *
     * Example usage:
     * <code>
     * $query->filterByTreeRight(1234); // WHERE tree_right = 1234
     * $query->filterByTreeRight(array(12, 34)); // WHERE tree_right IN (12, 34)
     * $query->filterByTreeRight(array('min' => 12)); // WHERE tree_right > 12
     * </code>
     *
     * @param     mixed $treeRight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByTreeRight($treeRight = null, $comparison = null)
    {
        if (is_array($treeRight)) {
            $useMinMax = false;
            if (isset($treeRight['min'])) {
                $this->addUsingAlias(CategoryPeer::TREE_RIGHT, $treeRight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($treeRight['max'])) {
                $this->addUsingAlias(CategoryPeer::TREE_RIGHT, $treeRight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryPeer::TREE_RIGHT, $treeRight, $comparison);
    }

    /**
     * Filter the query on the tree_level column
     *
     * Example usage:
     * <code>
     * $query->filterByTreeLevel(1234); // WHERE tree_level = 1234
     * $query->filterByTreeLevel(array(12, 34)); // WHERE tree_level IN (12, 34)
     * $query->filterByTreeLevel(array('min' => 12)); // WHERE tree_level > 12
     * </code>
     *
     * @param     mixed $treeLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByTreeLevel($treeLevel = null, $comparison = null)
    {
        if (is_array($treeLevel)) {
            $useMinMax = false;
            if (isset($treeLevel['min'])) {
                $this->addUsingAlias(CategoryPeer::TREE_LEVEL, $treeLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($treeLevel['max'])) {
                $this->addUsingAlias(CategoryPeer::TREE_LEVEL, $treeLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryPeer::TREE_LEVEL, $treeLevel, $comparison);
    }

    /**
     * Filter the query on the scope column
     *
     * Example usage:
     * <code>
     * $query->filterByScope(1234); // WHERE scope = 1234
     * $query->filterByScope(array(12, 34)); // WHERE scope IN (12, 34)
     * $query->filterByScope(array('min' => 12)); // WHERE scope > 12
     * </code>
     *
     * @param     mixed $scope The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function filterByScope($scope = null, $comparison = null)
    {
        if (is_array($scope)) {
            $useMinMax = false;
            if (isset($scope['min'])) {
                $this->addUsingAlias(CategoryPeer::SCOPE, $scope['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($scope['max'])) {
                $this->addUsingAlias(CategoryPeer::SCOPE, $scope['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryPeer::SCOPE, $scope, $comparison);
    }

    /**
     * Filter the query by a related GroupCategory object
     *
     * @param   GroupCategory|PropelObjectCollection $groupCategory  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CategoryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByGroupCategory($groupCategory, $comparison = null)
    {
        if ($groupCategory instanceof GroupCategory) {
            return $this
                ->addUsingAlias(CategoryPeer::ID, $groupCategory->getCategoryid(), $comparison);
        } elseif ($groupCategory instanceof PropelObjectCollection) {
            return $this
                ->useGroupCategoryQuery()
                ->filterByPrimaryKeys($groupCategory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGroupCategory() only accepts arguments of type GroupCategory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GroupCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function joinGroupCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GroupCategory');

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
            $this->addJoinObject($join, 'GroupCategory');
        }

        return $this;
    }

    /**
     * Use the GroupCategory relation GroupCategory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   GroupCategoryQuery A secondary query class using the current class as primary query
     */
    public function useGroupCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroupCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GroupCategory', 'GroupCategoryQuery');
    }

    /**
     * Filter the query by a related Group object
     * using the users_groupCategory table as cross reference
     *
     * @param   Group $group the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CategoryQuery The current query, for fluid interface
     */
    public function filterByGroup($group, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useGroupCategoryQuery()
            ->filterByGroup($group, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Category $category Object to remove from the list of results
     *
     * @return CategoryQuery The current query, for fluid interface
     */
    public function prune($category = null)
    {
        if ($category) {
            $this->addUsingAlias(CategoryPeer::ID, $category->getId(), Criteria::NOT_EQUAL);
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
        if (CategoryQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
            $this->addUsingAlias(CategoryPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CategoryPeer::enableSoftDelete();
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
        if (CategoryQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
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
     * @see CategoryQuery::disableSoftDelete() to disable the filter for more than one query
     *
     * @return CategoryQuery The current query, for fluid interface
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
        return CategoryPeer::doForceDelete($this, $con);
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
        return CategoryPeer::doForceDeleteAll($con);}

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

    // nested_set behavior

    /**
     * Filter the query to restrict the result to root objects
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function treeRoots()
    {
        return $this->addUsingAlias(CategoryPeer::LEFT_COL, 1, Criteria::EQUAL);
    }

    /**
     * Returns the objects in a certain tree, from the tree scope
     *
     * @param     int $scope		Scope to determine which objects node to return
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function inTree($scope = null)
    {
        return $this->addUsingAlias(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);
    }

    /**
     * Filter the query to restrict the result to descendants of an object
     *
     * @param     Category $category The object to use for descendant search
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function descendantsOf($category)
    {
        return $this
            ->inTree($category->getScopeValue())
            ->addUsingAlias(CategoryPeer::LEFT_COL, $category->getLeftValue(), Criteria::GREATER_THAN)
            ->addUsingAlias(CategoryPeer::LEFT_COL, $category->getRightValue(), Criteria::LESS_THAN);
    }

    /**
     * Filter the query to restrict the result to the branch of an object.
     * Same as descendantsOf(), except that it includes the object passed as parameter in the result
     *
     * @param     Category $category The object to use for branch search
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function branchOf($category)
    {
        return $this
            ->inTree($category->getScopeValue())
            ->addUsingAlias(CategoryPeer::LEFT_COL, $category->getLeftValue(), Criteria::GREATER_EQUAL)
            ->addUsingAlias(CategoryPeer::LEFT_COL, $category->getRightValue(), Criteria::LESS_EQUAL);
    }

    /**
     * Filter the query to restrict the result to children of an object
     *
     * @param     Category $category The object to use for child search
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function childrenOf($category)
    {
        return $this
            ->descendantsOf($category)
            ->addUsingAlias(CategoryPeer::LEVEL_COL, $category->getLevel() + 1, Criteria::EQUAL);
    }

    /**
     * Filter the query to restrict the result to siblings of an object.
     * The result does not include the object passed as parameter.
     *
     * @param     Category $category The object to use for sibling search
     * @param      PropelPDO $con Connection to use.
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function siblingsOf($category, PropelPDO $con = null)
    {
        if ($category->isRoot()) {
            return $this->
                add(CategoryPeer::LEVEL_COL, '1<>1', Criteria::CUSTOM);
        } else {
            return $this
                ->childrenOf($category->getParent($con))
                ->prune($category);
        }
    }

    /**
     * Filter the query to restrict the result to ancestors of an object
     *
     * @param     Category $category The object to use for ancestors search
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function ancestorsOf($category)
    {
        return $this
            ->inTree($category->getScopeValue())
            ->addUsingAlias(CategoryPeer::LEFT_COL, $category->getLeftValue(), Criteria::LESS_THAN)
            ->addUsingAlias(CategoryPeer::RIGHT_COL, $category->getRightValue(), Criteria::GREATER_THAN);
    }

    /**
     * Filter the query to restrict the result to roots of an object.
     * Same as ancestorsOf(), except that it includes the object passed as parameter in the result
     *
     * @param     Category $category The object to use for roots search
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function rootsOf($category)
    {
        return $this
            ->inTree($category->getScopeValue())
            ->addUsingAlias(CategoryPeer::LEFT_COL, $category->getLeftValue(), Criteria::LESS_EQUAL)
            ->addUsingAlias(CategoryPeer::RIGHT_COL, $category->getRightValue(), Criteria::GREATER_EQUAL);
    }

    /**
     * Order the result by branch, i.e. natural tree order
     *
     * @param     bool $reverse if true, reverses the order
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function orderByBranch($reverse = false)
    {
        if ($reverse) {
            return $this
                ->addDescendingOrderByColumn(CategoryPeer::LEFT_COL);
        } else {
            return $this
                ->addAscendingOrderByColumn(CategoryPeer::LEFT_COL);
        }
    }

    /**
     * Order the result by level, the closer to the root first
     *
     * @param     bool $reverse if true, reverses the order
     *
     * @return    CategoryQuery The current query, for fluid interface
     */
    public function orderByLevel($reverse = false)
    {
        if ($reverse) {
            return $this
                ->addAscendingOrderByColumn(CategoryPeer::RIGHT_COL);
        } else {
            return $this
                ->addDescendingOrderByColumn(CategoryPeer::RIGHT_COL);
        }
    }

    /**
     * Returns a root node for the tree
     *
     * @param      int $scope		Scope to determine which root node to return
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     Category The tree root object
     */
    public function findRoot($scope = null, $con = null)
    {
        return $this
            ->addUsingAlias(CategoryPeer::LEFT_COL, 1, Criteria::EQUAL)
            ->inTree($scope)
            ->findOne($con);
    }

    /**
     * Returns the root objects for all trees.
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return    mixed the list of results, formatted by the current formatter
     */
    public function findRoots($con = null)
    {
        return $this
            ->treeRoots()
            ->find($con);
    }

    /**
     * Returns a tree of objects
     *
     * @param      int $scope		Scope to determine which tree node to return
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findTree($scope = null, $con = null)
    {
        return $this
            ->inTree($scope)
            ->orderByBranch()
            ->find($con);
    }

}
