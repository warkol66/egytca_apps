<?php


/**
 * Base class that represents a query for the 'multilang_text' table.
 *
 * 
 *
 * @method     MultilangTextQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MultilangTextQuery orderByModulename($order = Criteria::ASC) Order by the moduleName column
 * @method     MultilangTextQuery orderByLanguagecode($order = Criteria::ASC) Order by the languageCode column
 * @method     MultilangTextQuery orderByText($order = Criteria::ASC) Order by the text column
 *
 * @method     MultilangTextQuery groupById() Group by the id column
 * @method     MultilangTextQuery groupByModulename() Group by the moduleName column
 * @method     MultilangTextQuery groupByLanguagecode() Group by the languageCode column
 * @method     MultilangTextQuery groupByText() Group by the text column
 *
 * @method     MultilangTextQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MultilangTextQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MultilangTextQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MultilangTextQuery leftJoinMultilangLanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultilangLanguage relation
 * @method     MultilangTextQuery rightJoinMultilangLanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultilangLanguage relation
 * @method     MultilangTextQuery innerJoinMultilangLanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the MultilangLanguage relation
 *
 * @method     MultilangTextQuery leftJoinModule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Module relation
 * @method     MultilangTextQuery rightJoinModule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Module relation
 * @method     MultilangTextQuery innerJoinModule($relationAlias = null) Adds a INNER JOIN clause to the query using the Module relation
 *
 * @method     MultilangText findOne(PropelPDO $con = null) Return the first MultilangText matching the query
 * @method     MultilangText findOneOrCreate(PropelPDO $con = null) Return the first MultilangText matching the query, or a new MultilangText object populated from the query conditions when no match is found
 *
 * @method     MultilangText findOneById(int $id) Return the first MultilangText filtered by the id column
 * @method     MultilangText findOneByModulename(string $moduleName) Return the first MultilangText filtered by the moduleName column
 * @method     MultilangText findOneByLanguagecode(string $languageCode) Return the first MultilangText filtered by the languageCode column
 * @method     MultilangText findOneByText(string $text) Return the first MultilangText filtered by the text column
 *
 * @method     array findById(int $id) Return MultilangText objects filtered by the id column
 * @method     array findByModulename(string $moduleName) Return MultilangText objects filtered by the moduleName column
 * @method     array findByLanguagecode(string $languageCode) Return MultilangText objects filtered by the languageCode column
 * @method     array findByText(string $text) Return MultilangText objects filtered by the text column
 *
 * @package    propel.generator.multilang.classes.om
 */
abstract class BaseMultilangTextQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseMultilangTextQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'MultilangText', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new MultilangTextQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    MultilangTextQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof MultilangTextQuery) {
			return $criteria;
		}
		$query = new MultilangTextQuery();
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
	 * <code>
	 * $obj = $c->findPk(array(12, 34, 56), $con);
	 * </code>
	 * @param     array[$id, $moduleName, $languageCode] $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    MultilangText|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = MultilangTextPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		$this->addUsingAlias(MultilangTextPeer::ID, $key[0], Criteria::EQUAL);
		$this->addUsingAlias(MultilangTextPeer::MODULENAME, $key[1], Criteria::EQUAL);
		$this->addUsingAlias(MultilangTextPeer::LANGUAGECODE, $key[2], Criteria::EQUAL);
		
		return $this;
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		if (empty($keys)) {
			return $this->add(null, '1<>1', Criteria::CUSTOM);
		}
		foreach ($keys as $key) {
			$cton0 = $this->getNewCriterion(MultilangTextPeer::ID, $key[0], Criteria::EQUAL);
			$cton1 = $this->getNewCriterion(MultilangTextPeer::MODULENAME, $key[1], Criteria::EQUAL);
			$cton0->addAnd($cton1);
			$cton2 = $this->getNewCriterion(MultilangTextPeer::LANGUAGECODE, $key[2], Criteria::EQUAL);
			$cton0->addAnd($cton2);
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
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(MultilangTextPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the moduleName column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByModulename('fooValue');   // WHERE moduleName = 'fooValue'
	 * $query->filterByModulename('%fooValue%'); // WHERE moduleName LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $modulename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByModulename($modulename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($modulename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $modulename)) {
				$modulename = str_replace('*', '%', $modulename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MultilangTextPeer::MODULENAME, $modulename, $comparison);
	}

	/**
	 * Filter the query on the languageCode column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByLanguagecode('fooValue');   // WHERE languageCode = 'fooValue'
	 * $query->filterByLanguagecode('%fooValue%'); // WHERE languageCode LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $languagecode The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByLanguagecode($languagecode = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($languagecode)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $languagecode)) {
				$languagecode = str_replace('*', '%', $languagecode);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MultilangTextPeer::LANGUAGECODE, $languagecode, $comparison);
	}

	/**
	 * Filter the query on the text column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByText('fooValue');   // WHERE text = 'fooValue'
	 * $query->filterByText('%fooValue%'); // WHERE text LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $text The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByText($text = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($text)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $text)) {
				$text = str_replace('*', '%', $text);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(MultilangTextPeer::TEXT, $text, $comparison);
	}

	/**
	 * Filter the query by a related MultilangLanguage object
	 *
	 * @param     MultilangLanguage|PropelCollection $multilangLanguage The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByMultilangLanguage($multilangLanguage, $comparison = null)
	{
		if ($multilangLanguage instanceof MultilangLanguage) {
			return $this
				->addUsingAlias(MultilangTextPeer::LANGUAGECODE, $multilangLanguage->getCode(), $comparison);
		} elseif ($multilangLanguage instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MultilangTextPeer::LANGUAGECODE, $multilangLanguage->toKeyValue('PrimaryKey', 'Code'), $comparison);
		} else {
			throw new PropelException('filterByMultilangLanguage() only accepts arguments of type MultilangLanguage or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MultilangLanguage relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function joinMultilangLanguage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MultilangLanguage');
		
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
			$this->addJoinObject($join, 'MultilangLanguage');
		}
		
		return $this;
	}

	/**
	 * Use the MultilangLanguage relation MultilangLanguage object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MultilangLanguageQuery A secondary query class using the current class as primary query
	 */
	public function useMultilangLanguageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinMultilangLanguage($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MultilangLanguage', 'MultilangLanguageQuery');
	}

	/**
	 * Filter the query by a related Module object
	 *
	 * @param     Module|PropelCollection $module The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function filterByModule($module, $comparison = null)
	{
		if ($module instanceof Module) {
			return $this
				->addUsingAlias(MultilangTextPeer::MODULENAME, $module->getName(), $comparison);
		} elseif ($module instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(MultilangTextPeer::MODULENAME, $module->toKeyValue('PrimaryKey', 'Name'), $comparison);
		} else {
			throw new PropelException('filterByModule() only accepts arguments of type Module or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Module relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function joinModule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Module');
		
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
			$this->addJoinObject($join, 'Module');
		}
		
		return $this;
	}

	/**
	 * Use the Module relation Module object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ModuleQuery A secondary query class using the current class as primary query
	 */
	public function useModuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinModule($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Module', 'ModuleQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     MultilangText $multilangText Object to remove from the list of results
	 *
	 * @return    MultilangTextQuery The current query, for fluid interface
	 */
	public function prune($multilangText = null)
	{
		if ($multilangText) {
			$this->addCond('pruneCond0', $this->getAliasedColName(MultilangTextPeer::ID), $multilangText->getId(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond1', $this->getAliasedColName(MultilangTextPeer::MODULENAME), $multilangText->getModulename(), Criteria::NOT_EQUAL);
			$this->addCond('pruneCond2', $this->getAliasedColName(MultilangTextPeer::LANGUAGECODE), $multilangText->getLanguagecode(), Criteria::NOT_EQUAL);
			$this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
	  }
	  
		return $this;
	}

} // BaseMultilangTextQuery
