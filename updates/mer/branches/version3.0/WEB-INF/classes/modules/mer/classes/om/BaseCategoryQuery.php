<?php


/**
 * Base class that represents a query for the 'MER_category' table.
 *
 * Categorias
 *
 * @method     CategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CategoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     CategoryQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     CategoryQuery orderByHierarchyactors($order = Criteria::ASC) Order by the hierarchyActors column
 *
 * @method     CategoryQuery groupById() Group by the id column
 * @method     CategoryQuery groupByName() Group by the name column
 * @method     CategoryQuery groupByActive() Group by the active column
 * @method     CategoryQuery groupByHierarchyactors() Group by the hierarchyActors column
 *
 * @method     CategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CategoryQuery leftJoinActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Actor relation
 * @method     CategoryQuery rightJoinActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Actor relation
 * @method     CategoryQuery innerJoinActor($relationAlias = null) Adds a INNER JOIN clause to the query using the Actor relation
 *
 * @method     CategoryQuery leftJoinDocument($relationAlias = null) Adds a LEFT JOIN clause to the query using the Document relation
 * @method     CategoryQuery rightJoinDocument($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Document relation
 * @method     CategoryQuery innerJoinDocument($relationAlias = null) Adds a INNER JOIN clause to the query using the Document relation
 *
 * @method     CategoryQuery leftJoinHierarchy($relationAlias = null) Adds a LEFT JOIN clause to the query using the Hierarchy relation
 * @method     CategoryQuery rightJoinHierarchy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Hierarchy relation
 * @method     CategoryQuery innerJoinHierarchy($relationAlias = null) Adds a INNER JOIN clause to the query using the Hierarchy relation
 *
 * @method     CategoryQuery leftJoinGraphActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphActor relation
 * @method     CategoryQuery rightJoinGraphActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphActor relation
 * @method     CategoryQuery innerJoinGraphActor($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphActor relation
 *
 * @method     CategoryQuery leftJoinGraphCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphCategory relation
 * @method     CategoryQuery rightJoinGraphCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphCategory relation
 * @method     CategoryQuery innerJoinGraphCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphCategory relation
 *
 * @method     CategoryQuery leftJoinGroupCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the GroupCategory relation
 * @method     CategoryQuery rightJoinGroupCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GroupCategory relation
 * @method     CategoryQuery innerJoinGroupCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the GroupCategory relation
 *
 * @method     Category findOne(PropelPDO $con = null) Return the first Category matching the query
 * @method     Category findOneOrCreate(PropelPDO $con = null) Return the first Category matching the query, or a new Category object populated from the query conditions when no match is found
 *
 * @method     Category findOneById(int $id) Return the first Category filtered by the id column
 * @method     Category findOneByName(string $name) Return the first Category filtered by the name column
 * @method     Category findOneByActive(boolean $active) Return the first Category filtered by the active column
 * @method     Category findOneByHierarchyactors(int $hierarchyActors) Return the first Category filtered by the hierarchyActors column
 *
 * @method     array findById(int $id) Return Category objects filtered by the id column
 * @method     array findByName(string $name) Return Category objects filtered by the name column
 * @method     array findByActive(boolean $active) Return Category objects filtered by the active column
 * @method     array findByHierarchyactors(int $hierarchyActors) Return Category objects filtered by the hierarchyActors column
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseCategoryQuery extends ModelCriteria
{

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
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CategoryQuery
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
	 * Find object by primary key
	 * Use instance pooling to avoid a database query if the object exists
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Category|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = CategoryPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    CategoryQuery The current query, for fluid interface
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
	 * @return    CategoryQuery The current query, for fluid interface
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
	 * @return    CategoryQuery The current query, for fluid interface
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
	 * @return    CategoryQuery The current query, for fluid interface
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
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_string($active)) {
			$active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(CategoryPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the hierarchyActors column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByHierarchyactors(1234); // WHERE hierarchyActors = 1234
	 * $query->filterByHierarchyactors(array(12, 34)); // WHERE hierarchyActors IN (12, 34)
	 * $query->filterByHierarchyactors(array('min' => 12)); // WHERE hierarchyActors > 12
	 * </code>
	 *
	 * @param     mixed $hierarchyactors The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByHierarchyactors($hierarchyactors = null, $comparison = null)
	{
		if (is_array($hierarchyactors)) {
			$useMinMax = false;
			if (isset($hierarchyactors['min'])) {
				$this->addUsingAlias(CategoryPeer::HIERARCHYACTORS, $hierarchyactors['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hierarchyactors['max'])) {
				$this->addUsingAlias(CategoryPeer::HIERARCHYACTORS, $hierarchyactors['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CategoryPeer::HIERARCHYACTORS, $hierarchyactors, $comparison);
	}

	/**
	 * Filter the query by a related Actor object
	 *
	 * @param     Actor $actor  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByActor($actor, $comparison = null)
	{
		if ($actor instanceof Actor) {
			return $this
				->addUsingAlias(CategoryPeer::ID, $actor->getCategoryid(), $comparison);
		} elseif ($actor instanceof PropelCollection) {
			return $this
				->useActorQuery()
					->filterByPrimaryKeys($actor->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByActor() only accepts arguments of type Actor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Actor relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function joinActor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Actor');
		
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
			$this->addJoinObject($join, 'Actor');
		}
		
		return $this;
	}

	/**
	 * Use the Actor relation Actor object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery A secondary query class using the current class as primary query
	 */
	public function useActorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinActor($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Actor', 'ActorQuery');
	}

	/**
	 * Filter the query by a related Document object
	 *
	 * @param     Document $document  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByDocument($document, $comparison = null)
	{
		if ($document instanceof Document) {
			return $this
				->addUsingAlias(CategoryPeer::ID, $document->getCategoryid(), $comparison);
		} elseif ($document instanceof PropelCollection) {
			return $this
				->useDocumentQuery()
					->filterByPrimaryKeys($document->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByDocument() only accepts arguments of type Document or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Document relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function joinDocument($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Document');
		
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
			$this->addJoinObject($join, 'Document');
		}
		
		return $this;
	}

	/**
	 * Use the Document relation Document object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DocumentQuery A secondary query class using the current class as primary query
	 */
	public function useDocumentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinDocument($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Document', 'DocumentQuery');
	}

	/**
	 * Filter the query by a related Hierarchy object
	 *
	 * @param     Hierarchy $hierarchy  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByHierarchy($hierarchy, $comparison = null)
	{
		if ($hierarchy instanceof Hierarchy) {
			return $this
				->addUsingAlias(CategoryPeer::ID, $hierarchy->getCategoryid(), $comparison);
		} elseif ($hierarchy instanceof PropelCollection) {
			return $this
				->useHierarchyQuery()
					->filterByPrimaryKeys($hierarchy->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByHierarchy() only accepts arguments of type Hierarchy or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Hierarchy relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function joinHierarchy($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Hierarchy');
		
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
			$this->addJoinObject($join, 'Hierarchy');
		}
		
		return $this;
	}

	/**
	 * Use the Hierarchy relation Hierarchy object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    HierarchyQuery A secondary query class using the current class as primary query
	 */
	public function useHierarchyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinHierarchy($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Hierarchy', 'HierarchyQuery');
	}

	/**
	 * Filter the query by a related GraphActor object
	 *
	 * @param     GraphActor $graphActor  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByGraphActor($graphActor, $comparison = null)
	{
		if ($graphActor instanceof GraphActor) {
			return $this
				->addUsingAlias(CategoryPeer::ID, $graphActor->getCategoryid(), $comparison);
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
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function joinGraphActor($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useGraphActorQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByGraphCategory($graphCategory, $comparison = null)
	{
		if ($graphCategory instanceof GraphCategory) {
			return $this
				->addUsingAlias(CategoryPeer::ID, $graphCategory->getCategoryid(), $comparison);
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
	 * @return    CategoryQuery The current query, for fluid interface
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
	 * Filter the query by a related GroupCategory object
	 *
	 * @param     GroupCategory $groupCategory  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function filterByGroupCategory($groupCategory, $comparison = null)
	{
		if ($groupCategory instanceof GroupCategory) {
			return $this
				->addUsingAlias(CategoryPeer::ID, $groupCategory->getCategoryid(), $comparison);
		} elseif ($groupCategory instanceof PropelCollection) {
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
	 * @return    CategoryQuery The current query, for fluid interface
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
		if($relationAlias) {
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
	 * @return    GroupCategoryQuery A secondary query class using the current class as primary query
	 */
	public function useGroupCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinGroupCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GroupCategory', 'GroupCategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Category $category Object to remove from the list of results
	 *
	 * @return    CategoryQuery The current query, for fluid interface
	 */
	public function prune($category = null)
	{
		if ($category) {
			$this->addUsingAlias(CategoryPeer::ID, $category->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseCategoryQuery
