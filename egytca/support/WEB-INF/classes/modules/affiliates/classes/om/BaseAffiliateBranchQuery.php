<?php


/**
 * Base class that represents a query for the 'affiliates_branch' table.
 *
 * Sucursales de Afiliados
 *
 * @method AffiliateBranchQuery orderById($order = Criteria::ASC) Order by the id column
 * @method AffiliateBranchQuery orderByAffiliateid($order = Criteria::ASC) Order by the affiliateId column
 * @method AffiliateBranchQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method AffiliateBranchQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method AffiliateBranchQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method AffiliateBranchQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method AffiliateBranchQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method AffiliateBranchQuery orderByContactemail($order = Criteria::ASC) Order by the contactEmail column
 * @method AffiliateBranchQuery orderByMemo($order = Criteria::ASC) Order by the memo column
 *
 * @method AffiliateBranchQuery groupById() Group by the id column
 * @method AffiliateBranchQuery groupByAffiliateid() Group by the affiliateId column
 * @method AffiliateBranchQuery groupByNumber() Group by the number column
 * @method AffiliateBranchQuery groupByCode() Group by the code column
 * @method AffiliateBranchQuery groupByName() Group by the name column
 * @method AffiliateBranchQuery groupByPhone() Group by the phone column
 * @method AffiliateBranchQuery groupByContact() Group by the contact column
 * @method AffiliateBranchQuery groupByContactemail() Group by the contactEmail column
 * @method AffiliateBranchQuery groupByMemo() Group by the memo column
 *
 * @method AffiliateBranchQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AffiliateBranchQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AffiliateBranchQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AffiliateBranchQuery leftJoinAffiliate($relationAlias = null) Adds a LEFT JOIN clause to the query using the Affiliate relation
 * @method AffiliateBranchQuery rightJoinAffiliate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Affiliate relation
 * @method AffiliateBranchQuery innerJoinAffiliate($relationAlias = null) Adds a INNER JOIN clause to the query using the Affiliate relation
 *
 * @method AffiliateBranch findOne(PropelPDO $con = null) Return the first AffiliateBranch matching the query
 * @method AffiliateBranch findOneOrCreate(PropelPDO $con = null) Return the first AffiliateBranch matching the query, or a new AffiliateBranch object populated from the query conditions when no match is found
 *
 * @method AffiliateBranch findOneById(int $id) Return the first AffiliateBranch filtered by the id column
 * @method AffiliateBranch findOneByAffiliateid(int $affiliateId) Return the first AffiliateBranch filtered by the affiliateId column
 * @method AffiliateBranch findOneByNumber(int $number) Return the first AffiliateBranch filtered by the number column
 * @method AffiliateBranch findOneByCode(string $code) Return the first AffiliateBranch filtered by the code column
 * @method AffiliateBranch findOneByName(string $name) Return the first AffiliateBranch filtered by the name column
 * @method AffiliateBranch findOneByPhone(string $phone) Return the first AffiliateBranch filtered by the phone column
 * @method AffiliateBranch findOneByContact(string $contact) Return the first AffiliateBranch filtered by the contact column
 * @method AffiliateBranch findOneByContactemail(string $contactEmail) Return the first AffiliateBranch filtered by the contactEmail column
 * @method AffiliateBranch findOneByMemo(string $memo) Return the first AffiliateBranch filtered by the memo column
 *
 * @method array findById(int $id) Return AffiliateBranch objects filtered by the id column
 * @method array findByAffiliateid(int $affiliateId) Return AffiliateBranch objects filtered by the affiliateId column
 * @method array findByNumber(int $number) Return AffiliateBranch objects filtered by the number column
 * @method array findByCode(string $code) Return AffiliateBranch objects filtered by the code column
 * @method array findByName(string $name) Return AffiliateBranch objects filtered by the name column
 * @method array findByPhone(string $phone) Return AffiliateBranch objects filtered by the phone column
 * @method array findByContact(string $contact) Return AffiliateBranch objects filtered by the contact column
 * @method array findByContactemail(string $contactEmail) Return AffiliateBranch objects filtered by the contactEmail column
 * @method array findByMemo(string $memo) Return AffiliateBranch objects filtered by the memo column
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateBranchQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAffiliateBranchQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'application', $modelName = 'AffiliateBranch', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AffiliateBranchQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     AffiliateBranchQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AffiliateBranchQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AffiliateBranchQuery) {
            return $criteria;
        }
        $query = new AffiliateBranchQuery();
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
     * @return   AffiliateBranch|AffiliateBranch[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AffiliateBranchPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AffiliateBranchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   AffiliateBranch A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `AFFILIATEID`, `NUMBER`, `CODE`, `NAME`, `PHONE`, `CONTACT`, `CONTACTEMAIL`, `MEMO` FROM `affiliates_branch` WHERE `ID` = :p0';
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
            $obj = new AffiliateBranch();
            $obj->hydrate($row);
            AffiliateBranchPeer::addInstanceToPool($obj, (string) $key);
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
     * @return AffiliateBranch|AffiliateBranch[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|AffiliateBranch[]|mixed the list of results, formatted by the current formatter
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
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AffiliateBranchPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AffiliateBranchPeer::ID, $keys, Criteria::IN);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(AffiliateBranchPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the affiliateId column
     *
     * Example usage:
     * <code>
     * $query->filterByAffiliateid(1234); // WHERE affiliateId = 1234
     * $query->filterByAffiliateid(array(12, 34)); // WHERE affiliateId IN (12, 34)
     * $query->filterByAffiliateid(array('min' => 12)); // WHERE affiliateId > 12
     * </code>
     *
     * @see       filterByAffiliate()
     *
     * @param     mixed $affiliateid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function filterByAffiliateid($affiliateid = null, $comparison = null)
    {
        if (is_array($affiliateid)) {
            $useMinMax = false;
            if (isset($affiliateid['min'])) {
                $this->addUsingAlias(AffiliateBranchPeer::AFFILIATEID, $affiliateid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($affiliateid['max'])) {
                $this->addUsingAlias(AffiliateBranchPeer::AFFILIATEID, $affiliateid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliateBranchPeer::AFFILIATEID, $affiliateid, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber(1234); // WHERE number = 1234
     * $query->filterByNumber(array(12, 34)); // WHERE number IN (12, 34)
     * $query->filterByNumber(array('min' => 12)); // WHERE number > 12
     * </code>
     *
     * @param     mixed $number The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (is_array($number)) {
            $useMinMax = false;
            if (isset($number['min'])) {
                $this->addUsingAlias(AffiliateBranchPeer::NUMBER, $number['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($number['max'])) {
                $this->addUsingAlias(AffiliateBranchPeer::NUMBER, $number['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AffiliateBranchPeer::NUMBER, $number, $comparison);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateBranchPeer::CODE, $code, $comparison);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateBranchPeer::NAME, $name, $comparison);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateBranchPeer::PHONE, $phone, $comparison);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateBranchPeer::CONTACT, $contact, $comparison);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateBranchPeer::CONTACTEMAIL, $contactemail, $comparison);
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
     * @return AffiliateBranchQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AffiliateBranchPeer::MEMO, $memo, $comparison);
    }

    /**
     * Filter the query by a related Affiliate object
     *
     * @param   Affiliate|PropelObjectCollection $affiliate The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   AffiliateBranchQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByAffiliate($affiliate, $comparison = null)
    {
        if ($affiliate instanceof Affiliate) {
            return $this
                ->addUsingAlias(AffiliateBranchPeer::AFFILIATEID, $affiliate->getId(), $comparison);
        } elseif ($affiliate instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AffiliateBranchPeer::AFFILIATEID, $affiliate->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAffiliate() only accepts arguments of type Affiliate or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Affiliate relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function joinAffiliate($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Affiliate');

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
            $this->addJoinObject($join, 'Affiliate');
        }

        return $this;
    }

    /**
     * Use the Affiliate relation Affiliate object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AffiliateQuery A secondary query class using the current class as primary query
     */
    public function useAffiliateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAffiliate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Affiliate', 'AffiliateQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   AffiliateBranch $affiliateBranch Object to remove from the list of results
     *
     * @return AffiliateBranchQuery The current query, for fluid interface
     */
    public function prune($affiliateBranch = null)
    {
        if ($affiliateBranch) {
            $this->addUsingAlias(AffiliateBranchPeer::ID, $affiliateBranch->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
