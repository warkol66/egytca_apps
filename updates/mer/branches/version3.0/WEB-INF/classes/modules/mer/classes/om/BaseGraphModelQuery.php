<?php


/**
 * Base class that represents a query for the 'MER_graphModel' table.
 *
 * Graficos modelos
 *
 * @method     GraphModelQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     GraphModelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     GraphModelQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     GraphModelQuery orderByActors($order = Criteria::ASC) Order by the actors column
 * @method     GraphModelQuery orderByLabelx($order = Criteria::ASC) Order by the labelX column
 * @method     GraphModelQuery orderByLabely($order = Criteria::ASC) Order by the labelY column
 * @method     GraphModelQuery orderByLabelz($order = Criteria::ASC) Order by the labelZ column
 * @method     GraphModelQuery orderByTypex($order = Criteria::ASC) Order by the typeX column
 * @method     GraphModelQuery orderByTypey($order = Criteria::ASC) Order by the typeY column
 * @method     GraphModelQuery orderByTypez($order = Criteria::ASC) Order by the typeZ column
 *
 * @method     GraphModelQuery groupById() Group by the id column
 * @method     GraphModelQuery groupByName() Group by the name column
 * @method     GraphModelQuery groupByType() Group by the type column
 * @method     GraphModelQuery groupByActors() Group by the actors column
 * @method     GraphModelQuery groupByLabelx() Group by the labelX column
 * @method     GraphModelQuery groupByLabely() Group by the labelY column
 * @method     GraphModelQuery groupByLabelz() Group by the labelZ column
 * @method     GraphModelQuery groupByTypex() Group by the typeX column
 * @method     GraphModelQuery groupByTypey() Group by the typeY column
 * @method     GraphModelQuery groupByTypez() Group by the typeZ column
 *
 * @method     GraphModelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     GraphModelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     GraphModelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     GraphModelQuery leftJoinGraphModelAxis($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphModelAxis relation
 * @method     GraphModelQuery rightJoinGraphModelAxis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphModelAxis relation
 * @method     GraphModelQuery innerJoinGraphModelAxis($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphModelAxis relation
 *
 * @method     GraphModelQuery leftJoinGraphModelJudgement($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphModelJudgement relation
 * @method     GraphModelQuery rightJoinGraphModelJudgement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphModelJudgement relation
 * @method     GraphModelQuery innerJoinGraphModelJudgement($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphModelJudgement relation
 *
 * @method     GraphModelQuery leftJoinGraphActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphActor relation
 * @method     GraphModelQuery rightJoinGraphActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphActor relation
 * @method     GraphModelQuery innerJoinGraphActor($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphActor relation
 *
 * @method     GraphModelQuery leftJoinGraphCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphCategory relation
 * @method     GraphModelQuery rightJoinGraphCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphCategory relation
 * @method     GraphModelQuery innerJoinGraphCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphCategory relation
 *
 * @method     GraphModel findOne(PropelPDO $con = null) Return the first GraphModel matching the query
 * @method     GraphModel findOneOrCreate(PropelPDO $con = null) Return the first GraphModel matching the query, or a new GraphModel object populated from the query conditions when no match is found
 *
 * @method     GraphModel findOneById(int $id) Return the first GraphModel filtered by the id column
 * @method     GraphModel findOneByName(string $name) Return the first GraphModel filtered by the name column
 * @method     GraphModel findOneByType(string $type) Return the first GraphModel filtered by the type column
 * @method     GraphModel findOneByActors(int $actors) Return the first GraphModel filtered by the actors column
 * @method     GraphModel findOneByLabelx(string $labelX) Return the first GraphModel filtered by the labelX column
 * @method     GraphModel findOneByLabely(string $labelY) Return the first GraphModel filtered by the labelY column
 * @method     GraphModel findOneByLabelz(string $labelZ) Return the first GraphModel filtered by the labelZ column
 * @method     GraphModel findOneByTypex(int $typeX) Return the first GraphModel filtered by the typeX column
 * @method     GraphModel findOneByTypey(int $typeY) Return the first GraphModel filtered by the typeY column
 * @method     GraphModel findOneByTypez(int $typeZ) Return the first GraphModel filtered by the typeZ column
 *
 * @method     array findById(int $id) Return GraphModel objects filtered by the id column
 * @method     array findByName(string $name) Return GraphModel objects filtered by the name column
 * @method     array findByType(string $type) Return GraphModel objects filtered by the type column
 * @method     array findByActors(int $actors) Return GraphModel objects filtered by the actors column
 * @method     array findByLabelx(string $labelX) Return GraphModel objects filtered by the labelX column
 * @method     array findByLabely(string $labelY) Return GraphModel objects filtered by the labelY column
 * @method     array findByLabelz(string $labelZ) Return GraphModel objects filtered by the labelZ column
 * @method     array findByTypex(int $typeX) Return GraphModel objects filtered by the typeX column
 * @method     array findByTypey(int $typeY) Return GraphModel objects filtered by the typeY column
 * @method     array findByTypez(int $typeZ) Return GraphModel objects filtered by the typeZ column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseGraphModelQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseGraphModelQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'GraphModel', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new GraphModelQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    GraphModelQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof GraphModelQuery) {
			return $criteria;
		}
		$query = new GraphModelQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    GraphModel|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = GraphModelPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
			// the object is alredy in the instance pool
			return $obj;
		} else {
			// the object has not been requested yet, or the formatter is not an object formatter
			$criteria = $this->isKeepQuery() ? clone $this : $this;
			$stmt = $criteria
				->filterByPrimaryKey($key)
				->getSelectStatement($con);
			return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
		}
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		return $this
			->filterByPrimaryKeys($keys)
			->find($con);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(GraphModelPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(GraphModelPeer::ID, $keys, Criteria::IN);
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
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(GraphModelPeer::ID, $id, $comparison);
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
	 * @return    GraphModelQuery The current query, for fluid interface
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
		return $this->addUsingAlias(GraphModelPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the type column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
	 * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $type The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByType($type = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($type)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $type)) {
				$type = str_replace('*', '%', $type);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::TYPE, $type, $comparison);
	}

	/**
	 * Filter the query on the actors column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByActors(1234); // WHERE actors = 1234
	 * $query->filterByActors(array(12, 34)); // WHERE actors IN (12, 34)
	 * $query->filterByActors(array('min' => 12)); // WHERE actors > 12
	 * </code>
	 *
	 * @param     mixed $actors The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByActors($actors = null, $comparison = null)
	{
		if (is_array($actors)) {
			$useMinMax = false;
			if (isset($actors['min'])) {
				$this->addUsingAlias(GraphModelPeer::ACTORS, $actors['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($actors['max'])) {
				$this->addUsingAlias(GraphModelPeer::ACTORS, $actors['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::ACTORS, $actors, $comparison);
	}

	/**
	 * Filter the query on the labelX column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLabelx('fooValue');   // WHERE labelX = 'fooValue'
	 * $query->filterByLabelx('%fooValue%'); // WHERE labelX LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $labelx The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByLabelx($labelx = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($labelx)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $labelx)) {
				$labelx = str_replace('*', '%', $labelx);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::LABELX, $labelx, $comparison);
	}

	/**
	 * Filter the query on the labelY column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLabely('fooValue');   // WHERE labelY = 'fooValue'
	 * $query->filterByLabely('%fooValue%'); // WHERE labelY LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $labely The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByLabely($labely = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($labely)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $labely)) {
				$labely = str_replace('*', '%', $labely);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::LABELY, $labely, $comparison);
	}

	/**
	 * Filter the query on the labelZ column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLabelz('fooValue');   // WHERE labelZ = 'fooValue'
	 * $query->filterByLabelz('%fooValue%'); // WHERE labelZ LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $labelz The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByLabelz($labelz = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($labelz)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $labelz)) {
				$labelz = str_replace('*', '%', $labelz);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::LABELZ, $labelz, $comparison);
	}

	/**
	 * Filter the query on the typeX column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTypex(1234); // WHERE typeX = 1234
	 * $query->filterByTypex(array(12, 34)); // WHERE typeX IN (12, 34)
	 * $query->filterByTypex(array('min' => 12)); // WHERE typeX > 12
	 * </code>
	 *
	 * @param     mixed $typex The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByTypex($typex = null, $comparison = null)
	{
		if (is_array($typex)) {
			$useMinMax = false;
			if (isset($typex['min'])) {
				$this->addUsingAlias(GraphModelPeer::TYPEX, $typex['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($typex['max'])) {
				$this->addUsingAlias(GraphModelPeer::TYPEX, $typex['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::TYPEX, $typex, $comparison);
	}

	/**
	 * Filter the query on the typeY column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTypey(1234); // WHERE typeY = 1234
	 * $query->filterByTypey(array(12, 34)); // WHERE typeY IN (12, 34)
	 * $query->filterByTypey(array('min' => 12)); // WHERE typeY > 12
	 * </code>
	 *
	 * @param     mixed $typey The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByTypey($typey = null, $comparison = null)
	{
		if (is_array($typey)) {
			$useMinMax = false;
			if (isset($typey['min'])) {
				$this->addUsingAlias(GraphModelPeer::TYPEY, $typey['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($typey['max'])) {
				$this->addUsingAlias(GraphModelPeer::TYPEY, $typey['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::TYPEY, $typey, $comparison);
	}

	/**
	 * Filter the query on the typeZ column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTypez(1234); // WHERE typeZ = 1234
	 * $query->filterByTypez(array(12, 34)); // WHERE typeZ IN (12, 34)
	 * $query->filterByTypez(array('min' => 12)); // WHERE typeZ > 12
	 * </code>
	 *
	 * @param     mixed $typez The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByTypez($typez = null, $comparison = null)
	{
		if (is_array($typez)) {
			$useMinMax = false;
			if (isset($typez['min'])) {
				$this->addUsingAlias(GraphModelPeer::TYPEZ, $typez['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($typez['max'])) {
				$this->addUsingAlias(GraphModelPeer::TYPEZ, $typez['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(GraphModelPeer::TYPEZ, $typez, $comparison);
	}

	/**
	 * Filter the query by a related GraphModelAxis object
	 *
	 * @param     GraphModelAxis $graphModelAxis  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByGraphModelAxis($graphModelAxis, $comparison = null)
	{
		if ($graphModelAxis instanceof GraphModelAxis) {
			return $this
				->addUsingAlias(GraphModelPeer::ID, $graphModelAxis->getGraphid(), $comparison);
		} elseif ($graphModelAxis instanceof PropelCollection) {
			return $this
				->useGraphModelAxisQuery()
					->filterByPrimaryKeys($graphModelAxis->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphModelAxis() only accepts arguments of type GraphModelAxis or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphModelAxis relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function joinGraphModelAxis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphModelAxis');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'GraphModelAxis');
		}
		
		return $this;
	}

	/**
	 * Use the GraphModelAxis relation GraphModelAxis object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelAxisQuery A secondary query class using the current class as primary query
	 */
	public function useGraphModelAxisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphModelAxis($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphModelAxis', 'GraphModelAxisQuery');
	}

	/**
	 * Filter the query by a related GraphModelJudgement object
	 *
	 * @param     GraphModelJudgement $graphModelJudgement  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByGraphModelJudgement($graphModelJudgement, $comparison = null)
	{
		if ($graphModelJudgement instanceof GraphModelJudgement) {
			return $this
				->addUsingAlias(GraphModelPeer::ID, $graphModelJudgement->getGraphid(), $comparison);
		} elseif ($graphModelJudgement instanceof PropelCollection) {
			return $this
				->useGraphModelJudgementQuery()
					->filterByPrimaryKeys($graphModelJudgement->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphModelJudgement() only accepts arguments of type GraphModelJudgement or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphModelJudgement relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function joinGraphModelJudgement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphModelJudgement');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'GraphModelJudgement');
		}
		
		return $this;
	}

	/**
	 * Use the GraphModelJudgement relation GraphModelJudgement object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelJudgementQuery A secondary query class using the current class as primary query
	 */
	public function useGraphModelJudgementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphModelJudgement($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphModelJudgement', 'GraphModelJudgementQuery');
	}

	/**
	 * Filter the query by a related GraphActor object
	 *
	 * @param     GraphActor $graphActor  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByGraphActor($graphActor, $comparison = null)
	{
		if ($graphActor instanceof GraphActor) {
			return $this
				->addUsingAlias(GraphModelPeer::ID, $graphActor->getGraphid(), $comparison);
		} elseif ($graphActor instanceof PropelCollection) {
			return $this
				->useGraphActorQuery()
					->filterByPrimaryKeys($graphActor->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphActor() only accepts arguments of type GraphActor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphActor relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function joinGraphActor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphActor');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'GraphActor');
		}
		
		return $this;
	}

	/**
	 * Use the GraphActor relation GraphActor object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphActorQuery A secondary query class using the current class as primary query
	 */
	public function useGraphActorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphActor($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphActor', 'GraphActorQuery');
	}

	/**
	 * Filter the query by a related GraphCategory object
	 *
	 * @param     GraphCategory $graphCategory  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function filterByGraphCategory($graphCategory, $comparison = null)
	{
		if ($graphCategory instanceof GraphCategory) {
			return $this
				->addUsingAlias(GraphModelPeer::ID, $graphCategory->getGraphid(), $comparison);
		} elseif ($graphCategory instanceof PropelCollection) {
			return $this
				->useGraphCategoryQuery()
					->filterByPrimaryKeys($graphCategory->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphCategory() only accepts arguments of type GraphCategory or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphCategory relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function joinGraphCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphCategory');
		
		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}
		
		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'GraphCategory');
		}
		
		return $this;
	}

	/**
	 * Use the GraphCategory relation GraphCategory object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphCategoryQuery A secondary query class using the current class as primary query
	 */
	public function useGraphCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGraphCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphCategory', 'GraphCategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     GraphModel $graphModel Object to remove from the list of results
	 *
	 * @return    GraphModelQuery The current query, for fluid interface
	 */
	public function prune($graphModel = null)
	{
		if ($graphModel) {
			$this->addUsingAlias(GraphModelPeer::ID, $graphModel->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseGraphModelQuery
