<?php


/**
 * Base class that represents a query for the 'board_bond' table.
 *
 * Compromiso con el challenge
 *
 * @method BoardBondQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BoardBondQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method BoardBondQuery groupById() Group by the id column
 * @method BoardBondQuery groupByName() Group by the name column
 *
 * @method BoardBondQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BoardBondQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BoardBondQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BoardBondQuery leftJoinBoardBondRelation($relationAlias = null) Adds a LEFT JOIN clause to the query using the BoardBondRelation relation
 * @method BoardBondQuery rightJoinBoardBondRelation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BoardBondRelation relation
 * @method BoardBondQuery innerJoinBoardBondRelation($relationAlias = null) Adds a INNER JOIN clause to the query using the BoardBondRelation relation
 *
 * @method BoardBond findOne(PropelPDO $con = null) Return the first BoardBond matching the query
 * @method BoardBond findOneOrCreate(PropelPDO $con = null) Return the first BoardBond matching the query, or a new BoardBond object populated from the query conditions when no match is found
 *
 * @method BoardBond findOneById(int $id) Return the first BoardBond filtered by the id column
 * @method BoardBond findOneByName(string $name) Return the first BoardBond filtered by the name column
 *
 * @method array findById(int $id) Return BoardBond objects filtered by the id column
 * @method array findByName(string $name) Return BoardBond objects filtered by the name column
 *
 * @package    propel.generator.board.classes.om
 */
abstract class BaseBoardBondQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBoardBondQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'BoardBond', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BoardBondQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BoardBondQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BoardBondQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BoardBondQuery) {
            return $criteria;
        }
        $query = new BoardBondQuery();
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
     * @return   BoardBond|BoardBond[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BoardBondPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BoardBondPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BoardBond A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME` FROM `board_bond` WHERE `ID` = :p0';
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
            $obj = new BoardBond();
            $obj->hydrate($row);
            BoardBondPeer::addInstanceToPool($obj, (string) $key);
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
     * @return BoardBond|BoardBond[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BoardBond[]|mixed the list of results, formatted by the current formatter
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
     * @return BoardBondQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BoardBondPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BoardBondQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BoardBondPeer::ID, $keys, Criteria::IN);
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
     * @return BoardBondQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BoardBondPeer::ID, $id, $comparison);
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
     * @return BoardBondQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BoardBondPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related BoardBondRelation object
     *
     * @param   BoardBondRelation|PropelObjectCollection $boardBondRelation  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardBondQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBoardBondRelation($boardBondRelation, $comparison = null)
    {
        if ($boardBondRelation instanceof BoardBondRelation) {
            return $this
                ->addUsingAlias(BoardBondPeer::ID, $boardBondRelation->getBondid(), $comparison);
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
     * @return BoardBondQuery The current query, for fluid interface
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
     * Filter the query by a related BoardChallenge object
     * using the board_bondRelation table as cross reference
     *
     * @param   BoardChallenge $boardChallenge the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardBondQuery The current query, for fluid interface
     */
    public function filterByBoardChallenge($boardChallenge, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useBoardBondRelationQuery()
            ->filterByBoardChallenge($boardChallenge, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   BoardBond $boardBond Object to remove from the list of results
     *
     * @return BoardBondQuery The current query, for fluid interface
     */
    public function prune($boardBond = null)
    {
        if ($boardBond) {
            $this->addUsingAlias(BoardBondPeer::ID, $boardBond->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
