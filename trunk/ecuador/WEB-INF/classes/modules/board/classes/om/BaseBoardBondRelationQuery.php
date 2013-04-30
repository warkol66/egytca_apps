<?php


/**
 * Base class that represents a query for the 'board_bondRelation' table.
 *
 * Asociacion entre Challenges y Compromisos
 *
 * @method BoardBondRelationQuery orderByChallengeid($order = Criteria::ASC) Order by the challengeId column
 * @method BoardBondRelationQuery orderByBondid($order = Criteria::ASC) Order by the bondId column
 *
 * @method BoardBondRelationQuery groupByChallengeid() Group by the challengeId column
 * @method BoardBondRelationQuery groupByBondid() Group by the bondId column
 *
 * @method BoardBondRelationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BoardBondRelationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BoardBondRelationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BoardBondRelationQuery leftJoinBoardChallenge($relationAlias = null) Adds a LEFT JOIN clause to the query using the BoardChallenge relation
 * @method BoardBondRelationQuery rightJoinBoardChallenge($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BoardChallenge relation
 * @method BoardBondRelationQuery innerJoinBoardChallenge($relationAlias = null) Adds a INNER JOIN clause to the query using the BoardChallenge relation
 *
 * @method BoardBondRelationQuery leftJoinBoardBond($relationAlias = null) Adds a LEFT JOIN clause to the query using the BoardBond relation
 * @method BoardBondRelationQuery rightJoinBoardBond($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BoardBond relation
 * @method BoardBondRelationQuery innerJoinBoardBond($relationAlias = null) Adds a INNER JOIN clause to the query using the BoardBond relation
 *
 * @method BoardBondRelation findOne(PropelPDO $con = null) Return the first BoardBondRelation matching the query
 * @method BoardBondRelation findOneOrCreate(PropelPDO $con = null) Return the first BoardBondRelation matching the query, or a new BoardBondRelation object populated from the query conditions when no match is found
 *
 * @method BoardBondRelation findOneByChallengeid(int $challengeId) Return the first BoardBondRelation filtered by the challengeId column
 * @method BoardBondRelation findOneByBondid(int $bondId) Return the first BoardBondRelation filtered by the bondId column
 *
 * @method array findByChallengeid(int $challengeId) Return BoardBondRelation objects filtered by the challengeId column
 * @method array findByBondid(int $bondId) Return BoardBondRelation objects filtered by the bondId column
 *
 * @package    propel.generator.board.classes.om
 */
abstract class BaseBoardBondRelationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBoardBondRelationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'BoardBondRelation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BoardBondRelationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BoardBondRelationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BoardBondRelationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BoardBondRelationQuery) {
            return $criteria;
        }
        $query = new BoardBondRelationQuery();
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
                         A Primary key composition: [$challengeId, $bondId]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   BoardBondRelation|BoardBondRelation[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BoardBondRelationPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BoardBondRelationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BoardBondRelation A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `CHALLENGEID`, `BONDID` FROM `board_bondRelation` WHERE `CHALLENGEID` = :p0 AND `BONDID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new BoardBondRelation();
            $obj->hydrate($row);
            BoardBondRelationPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BoardBondRelation|BoardBondRelation[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BoardBondRelation[]|mixed the list of results, formatted by the current formatter
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
     * @return BoardBondRelationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BoardBondRelationPeer::CHALLENGEID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BoardBondRelationPeer::BONDID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BoardBondRelationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BoardBondRelationPeer::CHALLENGEID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BoardBondRelationPeer::BONDID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return BoardBondRelationQuery The current query, for fluid interface
     */
    public function filterByChallengeid($challengeid = null, $comparison = null)
    {
        if (is_array($challengeid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BoardBondRelationPeer::CHALLENGEID, $challengeid, $comparison);
    }

    /**
     * Filter the query on the bondId column
     *
     * Example usage:
     * <code>
     * $query->filterByBondid(1234); // WHERE bondId = 1234
     * $query->filterByBondid(array(12, 34)); // WHERE bondId IN (12, 34)
     * $query->filterByBondid(array('min' => 12)); // WHERE bondId > 12
     * </code>
     *
     * @see       filterByBoardBond()
     *
     * @param     mixed $bondid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BoardBondRelationQuery The current query, for fluid interface
     */
    public function filterByBondid($bondid = null, $comparison = null)
    {
        if (is_array($bondid) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BoardBondRelationPeer::BONDID, $bondid, $comparison);
    }

    /**
     * Filter the query by a related BoardChallenge object
     *
     * @param   BoardChallenge|PropelObjectCollection $boardChallenge The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardBondRelationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBoardChallenge($boardChallenge, $comparison = null)
    {
        if ($boardChallenge instanceof BoardChallenge) {
            return $this
                ->addUsingAlias(BoardBondRelationPeer::CHALLENGEID, $boardChallenge->getId(), $comparison);
        } elseif ($boardChallenge instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BoardBondRelationPeer::CHALLENGEID, $boardChallenge->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BoardBondRelationQuery The current query, for fluid interface
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
     * Filter the query by a related BoardBond object
     *
     * @param   BoardBond|PropelObjectCollection $boardBond The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BoardBondRelationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBoardBond($boardBond, $comparison = null)
    {
        if ($boardBond instanceof BoardBond) {
            return $this
                ->addUsingAlias(BoardBondRelationPeer::BONDID, $boardBond->getId(), $comparison);
        } elseif ($boardBond instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BoardBondRelationPeer::BONDID, $boardBond->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBoardBond() only accepts arguments of type BoardBond or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BoardBond relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BoardBondRelationQuery The current query, for fluid interface
     */
    public function joinBoardBond($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BoardBond');

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
            $this->addJoinObject($join, 'BoardBond');
        }

        return $this;
    }

    /**
     * Use the BoardBond relation BoardBond object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   BoardBondQuery A secondary query class using the current class as primary query
     */
    public function useBoardBondQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBoardBond($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BoardBond', 'BoardBondQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BoardBondRelation $boardBondRelation Object to remove from the list of results
     *
     * @return BoardBondRelationQuery The current query, for fluid interface
     */
    public function prune($boardBondRelation = null)
    {
        if ($boardBondRelation) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BoardBondRelationPeer::CHALLENGEID), $boardBondRelation->getChallengeid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BoardBondRelationPeer::BONDID), $boardBondRelation->getBondid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
