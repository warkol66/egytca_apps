<?php


/**
 * Base class that represents a query for the 'common_menuItem' table.
 *
 * Items de los menues dinamicos
 *
 * @method MenuItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MenuItemQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method MenuItemQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method MenuItemQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method MenuItemQuery orderByParentid($order = Criteria::ASC) Order by the parentId column
 * @method MenuItemQuery orderByNewwindow($order = Criteria::ASC) Order by the newWindow column
 *
 * @method MenuItemQuery groupById() Group by the id column
 * @method MenuItemQuery groupByAction() Group by the action column
 * @method MenuItemQuery groupByUrl() Group by the url column
 * @method MenuItemQuery groupByOrder() Group by the order column
 * @method MenuItemQuery groupByParentid() Group by the parentId column
 * @method MenuItemQuery groupByNewwindow() Group by the newWindow column
 *
 * @method MenuItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MenuItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MenuItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MenuItemQuery leftJoinMenuItemInfo($relationAlias = null) Adds a LEFT JOIN clause to the query using the MenuItemInfo relation
 * @method MenuItemQuery rightJoinMenuItemInfo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MenuItemInfo relation
 * @method MenuItemQuery innerJoinMenuItemInfo($relationAlias = null) Adds a INNER JOIN clause to the query using the MenuItemInfo relation
 *
 * @method MenuItem findOne(PropelPDO $con = null) Return the first MenuItem matching the query
 * @method MenuItem findOneOrCreate(PropelPDO $con = null) Return the first MenuItem matching the query, or a new MenuItem object populated from the query conditions when no match is found
 *
 * @method MenuItem findOneById(int $id) Return the first MenuItem filtered by the id column
 * @method MenuItem findOneByAction(string $action) Return the first MenuItem filtered by the action column
 * @method MenuItem findOneByUrl(string $url) Return the first MenuItem filtered by the url column
 * @method MenuItem findOneByOrder(int $order) Return the first MenuItem filtered by the order column
 * @method MenuItem findOneByParentid(int $parentId) Return the first MenuItem filtered by the parentId column
 * @method MenuItem findOneByNewwindow(boolean $newWindow) Return the first MenuItem filtered by the newWindow column
 *
 * @method array findById(int $id) Return MenuItem objects filtered by the id column
 * @method array findByAction(string $action) Return MenuItem objects filtered by the action column
 * @method array findByUrl(string $url) Return MenuItem objects filtered by the url column
 * @method array findByOrder(int $order) Return MenuItem objects filtered by the order column
 * @method array findByParentid(int $parentId) Return MenuItem objects filtered by the parentId column
 * @method array findByNewwindow(boolean $newWindow) Return MenuItem objects filtered by the newWindow column
 *
 * @package    propel.generator.common.classes.om
 */
abstract class BaseMenuItemQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMenuItemQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'MenuItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MenuItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MenuItemQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MenuItemQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MenuItemQuery) {
            return $criteria;
        }
        $query = new MenuItemQuery();
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
     * @return   MenuItem|MenuItem[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MenuItemPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MenuItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MenuItem A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `ACTION`, `URL`, `ORDER`, `PARENTID`, `NEWWINDOW` FROM `common_menuItem` WHERE `ID` = :p0';
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
            $obj = new MenuItem();
            $obj->hydrate($row);
            MenuItemPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MenuItem|MenuItem[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MenuItem[]|mixed the list of results, formatted by the current formatter
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
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MenuItemPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MenuItemPeer::ID, $keys, Criteria::IN);
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
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MenuItemPeer::ID, $id, $comparison);
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
     * @return MenuItemQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuItemPeer::ACTION, $action, $comparison);
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
     * @return MenuItemQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuItemPeer::URL, $url, $comparison);
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
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(MenuItemPeer::ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(MenuItemPeer::ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemPeer::ORDER, $order, $comparison);
    }

    /**
     * Filter the query on the parentId column
     *
     * Example usage:
     * <code>
     * $query->filterByParentid(1234); // WHERE parentId = 1234
     * $query->filterByParentid(array(12, 34)); // WHERE parentId IN (12, 34)
     * $query->filterByParentid(array('min' => 12)); // WHERE parentId > 12
     * </code>
     *
     * @param     mixed $parentid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function filterByParentid($parentid = null, $comparison = null)
    {
        if (is_array($parentid)) {
            $useMinMax = false;
            if (isset($parentid['min'])) {
                $this->addUsingAlias(MenuItemPeer::PARENTID, $parentid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentid['max'])) {
                $this->addUsingAlias(MenuItemPeer::PARENTID, $parentid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemPeer::PARENTID, $parentid, $comparison);
    }

    /**
     * Filter the query on the newWindow column
     *
     * Example usage:
     * <code>
     * $query->filterByNewwindow(true); // WHERE newWindow = true
     * $query->filterByNewwindow('yes'); // WHERE newWindow = true
     * </code>
     *
     * @param     boolean|string $newwindow The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function filterByNewwindow($newwindow = null, $comparison = null)
    {
        if (is_string($newwindow)) {
            $newWindow = in_array(strtolower($newwindow), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MenuItemPeer::NEWWINDOW, $newwindow, $comparison);
    }

    /**
     * Filter the query by a related MenuItemInfo object
     *
     * @param   MenuItemInfo|PropelObjectCollection $menuItemInfo  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MenuItemQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMenuItemInfo($menuItemInfo, $comparison = null)
    {
        if ($menuItemInfo instanceof MenuItemInfo) {
            return $this
                ->addUsingAlias(MenuItemPeer::ID, $menuItemInfo->getMenuitemid(), $comparison);
        } elseif ($menuItemInfo instanceof PropelObjectCollection) {
            return $this
                ->useMenuItemInfoQuery()
                ->filterByPrimaryKeys($menuItemInfo->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMenuItemInfo() only accepts arguments of type MenuItemInfo or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MenuItemInfo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function joinMenuItemInfo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MenuItemInfo');

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
            $this->addJoinObject($join, 'MenuItemInfo');
        }

        return $this;
    }

    /**
     * Use the MenuItemInfo relation MenuItemInfo object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   MenuItemInfoQuery A secondary query class using the current class as primary query
     */
    public function useMenuItemInfoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMenuItemInfo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MenuItemInfo', 'MenuItemInfoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MenuItem $menuItem Object to remove from the list of results
     *
     * @return MenuItemQuery The current query, for fluid interface
     */
    public function prune($menuItem = null)
    {
        if ($menuItem) {
            $this->addUsingAlias(MenuItemPeer::ID, $menuItem->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
