<?php


/**
 * Base class that represents a query for the 'MER_document' table.
 *
 * Documentos del sistema
 *
 * @method     DocumentQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     DocumentQuery orderByFilename($order = Criteria::ASC) Order by the filename column
 * @method     DocumentQuery orderByRealfilename($order = Criteria::ASC) Order by the realFilename column
 * @method     DocumentQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     DocumentQuery orderByCategoryid($order = Criteria::ASC) Order by the categoryId column
 * @method     DocumentQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     DocumentQuery orderByDocumentDate($order = Criteria::ASC) Order by the document_date column
 * @method     DocumentQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     DocumentQuery orderByFulltextcontent($order = Criteria::ASC) Order by the fullTextContent column
 *
 * @method     DocumentQuery groupById() Group by the id column
 * @method     DocumentQuery groupByFilename() Group by the filename column
 * @method     DocumentQuery groupByRealfilename() Group by the realFilename column
 * @method     DocumentQuery groupByDate() Group by the date column
 * @method     DocumentQuery groupByCategoryid() Group by the categoryId column
 * @method     DocumentQuery groupByDescription() Group by the description column
 * @method     DocumentQuery groupByDocumentDate() Group by the document_date column
 * @method     DocumentQuery groupByPassword() Group by the password column
 * @method     DocumentQuery groupByFulltextcontent() Group by the fullTextContent column
 *
 * @method     DocumentQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     DocumentQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     DocumentQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     DocumentQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     DocumentQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     DocumentQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     Document findOne(PropelPDO $con = null) Return the first Document matching the query
 * @method     Document findOneOrCreate(PropelPDO $con = null) Return the first Document matching the query, or a new Document object populated from the query conditions when no match is found
 *
 * @method     Document findOneById(int $id) Return the first Document filtered by the id column
 * @method     Document findOneByFilename(string $filename) Return the first Document filtered by the filename column
 * @method     Document findOneByRealfilename(string $realFilename) Return the first Document filtered by the realFilename column
 * @method     Document findOneByDate(string $date) Return the first Document filtered by the date column
 * @method     Document findOneByCategoryid(int $categoryId) Return the first Document filtered by the categoryId column
 * @method     Document findOneByDescription(string $description) Return the first Document filtered by the description column
 * @method     Document findOneByDocumentDate(string $document_date) Return the first Document filtered by the document_date column
 * @method     Document findOneByPassword(string $password) Return the first Document filtered by the password column
 * @method     Document findOneByFulltextcontent(string $fullTextContent) Return the first Document filtered by the fullTextContent column
 *
 * @method     array findById(int $id) Return Document objects filtered by the id column
 * @method     array findByFilename(string $filename) Return Document objects filtered by the filename column
 * @method     array findByRealfilename(string $realFilename) Return Document objects filtered by the realFilename column
 * @method     array findByDate(string $date) Return Document objects filtered by the date column
 * @method     array findByCategoryid(int $categoryId) Return Document objects filtered by the categoryId column
 * @method     array findByDescription(string $description) Return Document objects filtered by the description column
 * @method     array findByDocumentDate(string $document_date) Return Document objects filtered by the document_date column
 * @method     array findByPassword(string $password) Return Document objects filtered by the password column
 * @method     array findByFulltextcontent(string $fullTextContent) Return Document objects filtered by the fullTextContent column
 *
 * @package    propel.generator.documents.classes.om
 */
abstract class BaseDocumentQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseDocumentQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Document', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new DocumentQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    DocumentQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof DocumentQuery) {
			return $criteria;
		}
		$query = new DocumentQuery();
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
	 * @return    Document|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = DocumentPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(DocumentPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(DocumentPeer::ID, $keys, Criteria::IN);
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
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(DocumentPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the filename column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFilename('fooValue');   // WHERE filename = 'fooValue'
	 * $query->filterByFilename('%fooValue%'); // WHERE filename LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $filename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByFilename($filename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($filename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $filename)) {
				$filename = str_replace('*', '%', $filename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(DocumentPeer::FILENAME, $filename, $comparison);
	}

	/**
	 * Filter the query on the realFilename column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByRealfilename('fooValue');   // WHERE realFilename = 'fooValue'
	 * $query->filterByRealfilename('%fooValue%'); // WHERE realFilename LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $realfilename The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByRealfilename($realfilename = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($realfilename)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $realfilename)) {
				$realfilename = str_replace('*', '%', $realfilename);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(DocumentPeer::REALFILENAME, $realfilename, $comparison);
	}

	/**
	 * Filter the query on the date column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
	 * $query->filterByDate('now'); // WHERE date = '2011-03-14'
	 * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $date The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByDate($date = null, $comparison = null)
	{
		if (is_array($date)) {
			$useMinMax = false;
			if (isset($date['min'])) {
				$this->addUsingAlias(DocumentPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($date['max'])) {
				$this->addUsingAlias(DocumentPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DocumentPeer::DATE, $date, $comparison);
	}

	/**
	 * Filter the query on the categoryId column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCategoryid(1234); // WHERE categoryId = 1234
	 * $query->filterByCategoryid(array(12, 34)); // WHERE categoryId IN (12, 34)
	 * $query->filterByCategoryid(array('min' => 12)); // WHERE categoryId > 12
	 * </code>
	 *
	 * @see       filterByCategory()
	 *
	 * @param     mixed $categoryid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByCategoryid($categoryid = null, $comparison = null)
	{
		if (is_array($categoryid)) {
			$useMinMax = false;
			if (isset($categoryid['min'])) {
				$this->addUsingAlias(DocumentPeer::CATEGORYID, $categoryid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($categoryid['max'])) {
				$this->addUsingAlias(DocumentPeer::CATEGORYID, $categoryid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DocumentPeer::CATEGORYID, $categoryid, $comparison);
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
	 * @return    DocumentQuery The current query, for fluid interface
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
		return $this->addUsingAlias(DocumentPeer::DESCRIPTION, $description, $comparison);
	}

	/**
	 * Filter the query on the document_date column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByDocumentDate('2011-03-14'); // WHERE document_date = '2011-03-14'
	 * $query->filterByDocumentDate('now'); // WHERE document_date = '2011-03-14'
	 * $query->filterByDocumentDate(array('max' => 'yesterday')); // WHERE document_date > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $documentDate The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByDocumentDate($documentDate = null, $comparison = null)
	{
		if (is_array($documentDate)) {
			$useMinMax = false;
			if (isset($documentDate['min'])) {
				$this->addUsingAlias(DocumentPeer::DOCUMENT_DATE, $documentDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($documentDate['max'])) {
				$this->addUsingAlias(DocumentPeer::DOCUMENT_DATE, $documentDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DocumentPeer::DOCUMENT_DATE, $documentDate, $comparison);
	}

	/**
	 * Filter the query on the password column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
	 * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $password The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByPassword($password = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($password)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $password)) {
				$password = str_replace('*', '%', $password);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(DocumentPeer::PASSWORD, $password, $comparison);
	}

	/**
	 * Filter the query on the fullTextContent column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByFulltextcontent('fooValue');   // WHERE fullTextContent = 'fooValue'
	 * $query->filterByFulltextcontent('%fooValue%'); // WHERE fullTextContent LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fulltextcontent The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByFulltextcontent($fulltextcontent = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fulltextcontent)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fulltextcontent)) {
				$fulltextcontent = str_replace('*', '%', $fulltextcontent);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(DocumentPeer::FULLTEXTCONTENT, $fulltextcontent, $comparison);
	}

	/**
	 * Filter the query by a related Category object
	 *
	 * @param     Category|PropelCollection $category The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function filterByCategory($category, $comparison = null)
	{
		if ($category instanceof Category) {
			return $this
				->addUsingAlias(DocumentPeer::CATEGORYID, $category->getId(), $comparison);
		} elseif ($category instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(DocumentPeer::CATEGORYID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCategory() only accepts arguments of type Category or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Category relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function joinCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Category');
		
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
			$this->addJoinObject($join, 'Category');
		}
		
		return $this;
	}

	/**
	 * Use the Category relation Category object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CategoryQuery A secondary query class using the current class as primary query
	 */
	public function useCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinCategory($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Category', 'CategoryQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Document $document Object to remove from the list of results
	 *
	 * @return    DocumentQuery The current query, for fluid interface
	 */
	public function prune($document = null)
	{
		if ($document) {
			$this->addUsingAlias(DocumentPeer::ID, $document->getId(), Criteria::NOT_EQUAL);
	  }
	  
		return $this;
	}

} // BaseDocumentQuery
