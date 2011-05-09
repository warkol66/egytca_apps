<?php


/**
 * Base class that represents a query for the 'MER_actor' table.
 *
 * Actors
 *
 * @method     ActorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ActorQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ActorQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ActorQuery orderBySurname($order = Criteria::ASC) Order by the surname column
 * @method     ActorQuery orderByCategoryid($order = Criteria::ASC) Order by the categoryId column
 * @method     ActorQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ActorQuery orderByStrategy($order = Criteria::ASC) Order by the strategy column
 * @method     ActorQuery orderByTactic($order = Criteria::ASC) Order by the tactic column
 * @method     ActorQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ActorQuery orderByObservations($order = Criteria::ASC) Order by the observations column
 * @method     ActorQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 * @method     ActorQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ActorQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ActorQuery groupById() Group by the id column
 * @method     ActorQuery groupByTitle() Group by the title column
 * @method     ActorQuery groupByName() Group by the name column
 * @method     ActorQuery groupBySurname() Group by the surname column
 * @method     ActorQuery groupByCategoryid() Group by the categoryId column
 * @method     ActorQuery groupByActive() Group by the active column
 * @method     ActorQuery groupByStrategy() Group by the strategy column
 * @method     ActorQuery groupByTactic() Group by the tactic column
 * @method     ActorQuery groupByComments() Group by the comments column
 * @method     ActorQuery groupByObservations() Group by the observations column
 * @method     ActorQuery groupByDeletedAt() Group by the deleted_at column
 * @method     ActorQuery groupByCreatedAt() Group by the created_at column
 * @method     ActorQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ActorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ActorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ActorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ActorQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ActorQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ActorQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ActorQuery leftJoinHierarchy($relationAlias = null) Adds a LEFT JOIN clause to the query using the Hierarchy relation
 * @method     ActorQuery rightJoinHierarchy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Hierarchy relation
 * @method     ActorQuery innerJoinHierarchy($relationAlias = null) Adds a INNER JOIN clause to the query using the Hierarchy relation
 *
 * @method     ActorQuery leftJoinRelationshipRelatedByActor1id($relationAlias = null) Adds a LEFT JOIN clause to the query using the RelationshipRelatedByActor1id relation
 * @method     ActorQuery rightJoinRelationshipRelatedByActor1id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RelationshipRelatedByActor1id relation
 * @method     ActorQuery innerJoinRelationshipRelatedByActor1id($relationAlias = null) Adds a INNER JOIN clause to the query using the RelationshipRelatedByActor1id relation
 *
 * @method     ActorQuery leftJoinRelationshipRelatedByActor2id($relationAlias = null) Adds a LEFT JOIN clause to the query using the RelationshipRelatedByActor2id relation
 * @method     ActorQuery rightJoinRelationshipRelatedByActor2id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RelationshipRelatedByActor2id relation
 * @method     ActorQuery innerJoinRelationshipRelatedByActor2id($relationAlias = null) Adds a INNER JOIN clause to the query using the RelationshipRelatedByActor2id relation
 *
 * @method     ActorQuery leftJoinActorActiveQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActorActiveQuestion relation
 * @method     ActorQuery rightJoinActorActiveQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActorActiveQuestion relation
 * @method     ActorQuery innerJoinActorActiveQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the ActorActiveQuestion relation
 *
 * @method     ActorQuery leftJoinRelationshipActiveQuestionRelatedByActor1id($relationAlias = null) Adds a LEFT JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor1id relation
 * @method     ActorQuery rightJoinRelationshipActiveQuestionRelatedByActor1id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor1id relation
 * @method     ActorQuery innerJoinRelationshipActiveQuestionRelatedByActor1id($relationAlias = null) Adds a INNER JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor1id relation
 *
 * @method     ActorQuery leftJoinRelationshipActiveQuestionRelatedByActor2id($relationAlias = null) Adds a LEFT JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor2id relation
 * @method     ActorQuery rightJoinRelationshipActiveQuestionRelatedByActor2id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor2id relation
 * @method     ActorQuery innerJoinRelationshipActiveQuestionRelatedByActor2id($relationAlias = null) Adds a INNER JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor2id relation
 *
 * @method     ActorQuery leftJoinAnswer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Answer relation
 * @method     ActorQuery rightJoinAnswer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Answer relation
 * @method     ActorQuery innerJoinAnswer($relationAlias = null) Adds a INNER JOIN clause to the query using the Answer relation
 *
 * @method     ActorQuery leftJoinGraphActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphActor relation
 * @method     ActorQuery rightJoinGraphActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphActor relation
 * @method     ActorQuery innerJoinGraphActor($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphActor relation
 *
 * @method     ActorQuery leftJoinGraphRelationRelatedByActor1id($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphRelationRelatedByActor1id relation
 * @method     ActorQuery rightJoinGraphRelationRelatedByActor1id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphRelationRelatedByActor1id relation
 * @method     ActorQuery innerJoinGraphRelationRelatedByActor1id($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphRelationRelatedByActor1id relation
 *
 * @method     ActorQuery leftJoinGraphRelationRelatedByActor2id($relationAlias = null) Adds a LEFT JOIN clause to the query using the GraphRelationRelatedByActor2id relation
 * @method     ActorQuery rightJoinGraphRelationRelatedByActor2id($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GraphRelationRelatedByActor2id relation
 * @method     ActorQuery innerJoinGraphRelationRelatedByActor2id($relationAlias = null) Adds a INNER JOIN clause to the query using the GraphRelationRelatedByActor2id relation
 *
 * @method     ActorQuery leftJoinJudgementActor($relationAlias = null) Adds a LEFT JOIN clause to the query using the JudgementActor relation
 * @method     ActorQuery rightJoinJudgementActor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the JudgementActor relation
 * @method     ActorQuery innerJoinJudgementActor($relationAlias = null) Adds a INNER JOIN clause to the query using the JudgementActor relation
 *
 * @method     Actor findOne(PropelPDO $con = null) Return the first Actor matching the query
 * @method     Actor findOneOrCreate(PropelPDO $con = null) Return the first Actor matching the query, or a new Actor object populated from the query conditions when no match is found
 *
 * @method     Actor findOneById(int $id) Return the first Actor filtered by the id column
 * @method     Actor findOneByTitle(string $title) Return the first Actor filtered by the title column
 * @method     Actor findOneByName(string $name) Return the first Actor filtered by the name column
 * @method     Actor findOneBySurname(string $surname) Return the first Actor filtered by the surname column
 * @method     Actor findOneByCategoryid(int $categoryId) Return the first Actor filtered by the categoryId column
 * @method     Actor findOneByActive(boolean $active) Return the first Actor filtered by the active column
 * @method     Actor findOneByStrategy(string $strategy) Return the first Actor filtered by the strategy column
 * @method     Actor findOneByTactic(string $tactic) Return the first Actor filtered by the tactic column
 * @method     Actor findOneByComments(string $comments) Return the first Actor filtered by the comments column
 * @method     Actor findOneByObservations(string $observations) Return the first Actor filtered by the observations column
 * @method     Actor findOneByDeletedAt(string $deleted_at) Return the first Actor filtered by the deleted_at column
 * @method     Actor findOneByCreatedAt(string $created_at) Return the first Actor filtered by the created_at column
 * @method     Actor findOneByUpdatedAt(string $updated_at) Return the first Actor filtered by the updated_at column
 *
 * @method     array findById(int $id) Return Actor objects filtered by the id column
 * @method     array findByTitle(string $title) Return Actor objects filtered by the title column
 * @method     array findByName(string $name) Return Actor objects filtered by the name column
 * @method     array findBySurname(string $surname) Return Actor objects filtered by the surname column
 * @method     array findByCategoryid(int $categoryId) Return Actor objects filtered by the categoryId column
 * @method     array findByActive(boolean $active) Return Actor objects filtered by the active column
 * @method     array findByStrategy(string $strategy) Return Actor objects filtered by the strategy column
 * @method     array findByTactic(string $tactic) Return Actor objects filtered by the tactic column
 * @method     array findByComments(string $comments) Return Actor objects filtered by the comments column
 * @method     array findByObservations(string $observations) Return Actor objects filtered by the observations column
 * @method     array findByDeletedAt(string $deleted_at) Return Actor objects filtered by the deleted_at column
 * @method     array findByCreatedAt(string $created_at) Return Actor objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Actor objects filtered by the updated_at column
 *
 * @package    propel.generator.actors.classes.om
 */
abstract class BaseActorQuery extends ModelCriteria
{

	// soft_delete behavior
	protected static $softDelete = true;
	protected $localSoftDelete = true;

	/**
	 * Initializes internal state of BaseActorQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'application', $modelName = 'Actor', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ActorQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ActorQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ActorQuery) {
			return $criteria;
		}
		$query = new ActorQuery();
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
	 * @return    Actor|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ((null !== ($obj = ActorPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ActorPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ActorPeer::ID, $keys, Criteria::IN);
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
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ActorPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the title column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActorPeer::TITLE, $title, $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
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
		return $this->addUsingAlias(ActorPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the surname column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterBySurname('fooValue');   // WHERE surname = 'fooValue'
	 * $query->filterBySurname('%fooValue%'); // WHERE surname LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $surname The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterBySurname($surname = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($surname)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $surname)) {
				$surname = str_replace('*', '%', $surname);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActorPeer::SURNAME, $surname, $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByCategoryid($categoryid = null, $comparison = null)
	{
		if (is_array($categoryid)) {
			$useMinMax = false;
			if (isset($categoryid['min'])) {
				$this->addUsingAlias(ActorPeer::CATEGORYID, $categoryid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($categoryid['max'])) {
				$this->addUsingAlias(ActorPeer::CATEGORYID, $categoryid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ActorPeer::CATEGORYID, $categoryid, $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByActive($active = null, $comparison = null)
	{
		if (is_string($active)) {
			$active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
		}
		return $this->addUsingAlias(ActorPeer::ACTIVE, $active, $comparison);
	}

	/**
	 * Filter the query on the strategy column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByStrategy('fooValue');   // WHERE strategy = 'fooValue'
	 * $query->filterByStrategy('%fooValue%'); // WHERE strategy LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $strategy The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByStrategy($strategy = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($strategy)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $strategy)) {
				$strategy = str_replace('*', '%', $strategy);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActorPeer::STRATEGY, $strategy, $comparison);
	}

	/**
	 * Filter the query on the tactic column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByTactic('fooValue');   // WHERE tactic = 'fooValue'
	 * $query->filterByTactic('%fooValue%'); // WHERE tactic LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $tactic The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByTactic($tactic = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($tactic)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $tactic)) {
				$tactic = str_replace('*', '%', $tactic);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActorPeer::TACTIC, $tactic, $comparison);
	}

	/**
	 * Filter the query on the comments column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
	 * $query->filterByComments('%fooValue%'); // WHERE comments LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $comments The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByComments($comments = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($comments)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $comments)) {
				$comments = str_replace('*', '%', $comments);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActorPeer::COMMENTS, $comments, $comparison);
	}

	/**
	 * Filter the query on the observations column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByObservations('fooValue');   // WHERE observations = 'fooValue'
	 * $query->filterByObservations('%fooValue%'); // WHERE observations LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $observations The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByObservations($observations = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($observations)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $observations)) {
				$observations = str_replace('*', '%', $observations);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ActorPeer::OBSERVATIONS, $observations, $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByDeletedAt($deletedAt = null, $comparison = null)
	{
		if (is_array($deletedAt)) {
			$useMinMax = false;
			if (isset($deletedAt['min'])) {
				$this->addUsingAlias(ActorPeer::DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deletedAt['max'])) {
				$this->addUsingAlias(ActorPeer::DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ActorPeer::DELETED_AT, $deletedAt, $comparison);
	}

	/**
	 * Filter the query on the created_at column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
	 * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
	 * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $createdAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(ActorPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(ActorPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ActorPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Filter the query on the updated_at column
	 * 
	 * Example usage:
	 * <code>
	 * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
	 * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
	 * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $updatedAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(ActorPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(ActorPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ActorPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Category object
	 *
	 * @param     Category|PropelCollection $category The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByCategory($category, $comparison = null)
	{
		if ($category instanceof Category) {
			return $this
				->addUsingAlias(ActorPeer::CATEGORYID, $category->getId(), $comparison);
		} elseif ($category instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ActorPeer::CATEGORYID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
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
	 * Filter the query by a related Hierarchy object
	 *
	 * @param     Hierarchy $hierarchy  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByHierarchy($hierarchy, $comparison = null)
	{
		if ($hierarchy instanceof Hierarchy) {
			return $this
				->addUsingAlias(ActorPeer::ID, $hierarchy->getActorid(), $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
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
	 * Filter the query by a related Relationship object
	 *
	 * @param     Relationship $relationship  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByRelationshipRelatedByActor1id($relationship, $comparison = null)
	{
		if ($relationship instanceof Relationship) {
			return $this
				->addUsingAlias(ActorPeer::ID, $relationship->getActor1id(), $comparison);
		} elseif ($relationship instanceof PropelCollection) {
			return $this
				->useRelationshipRelatedByActor1idQuery()
					->filterByPrimaryKeys($relationship->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRelationshipRelatedByActor1id() only accepts arguments of type Relationship or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the RelationshipRelatedByActor1id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinRelationshipRelatedByActor1id($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('RelationshipRelatedByActor1id');
		
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
			$this->addJoinObject($join, 'RelationshipRelatedByActor1id');
		}
		
		return $this;
	}

	/**
	 * Use the RelationshipRelatedByActor1id relation Relationship object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RelationshipQuery A secondary query class using the current class as primary query
	 */
	public function useRelationshipRelatedByActor1idQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRelationshipRelatedByActor1id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'RelationshipRelatedByActor1id', 'RelationshipQuery');
	}

	/**
	 * Filter the query by a related Relationship object
	 *
	 * @param     Relationship $relationship  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByRelationshipRelatedByActor2id($relationship, $comparison = null)
	{
		if ($relationship instanceof Relationship) {
			return $this
				->addUsingAlias(ActorPeer::ID, $relationship->getActor2id(), $comparison);
		} elseif ($relationship instanceof PropelCollection) {
			return $this
				->useRelationshipRelatedByActor2idQuery()
					->filterByPrimaryKeys($relationship->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRelationshipRelatedByActor2id() only accepts arguments of type Relationship or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the RelationshipRelatedByActor2id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinRelationshipRelatedByActor2id($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('RelationshipRelatedByActor2id');
		
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
			$this->addJoinObject($join, 'RelationshipRelatedByActor2id');
		}
		
		return $this;
	}

	/**
	 * Use the RelationshipRelatedByActor2id relation Relationship object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RelationshipQuery A secondary query class using the current class as primary query
	 */
	public function useRelationshipRelatedByActor2idQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRelationshipRelatedByActor2id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'RelationshipRelatedByActor2id', 'RelationshipQuery');
	}

	/**
	 * Filter the query by a related ActorActiveQuestion object
	 *
	 * @param     ActorActiveQuestion $actorActiveQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByActorActiveQuestion($actorActiveQuestion, $comparison = null)
	{
		if ($actorActiveQuestion instanceof ActorActiveQuestion) {
			return $this
				->addUsingAlias(ActorPeer::ID, $actorActiveQuestion->getActorid(), $comparison);
		} elseif ($actorActiveQuestion instanceof PropelCollection) {
			return $this
				->useActorActiveQuestionQuery()
					->filterByPrimaryKeys($actorActiveQuestion->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByActorActiveQuestion() only accepts arguments of type ActorActiveQuestion or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ActorActiveQuestion relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinActorActiveQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ActorActiveQuestion');
		
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
			$this->addJoinObject($join, 'ActorActiveQuestion');
		}
		
		return $this;
	}

	/**
	 * Use the ActorActiveQuestion relation ActorActiveQuestion object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorActiveQuestionQuery A secondary query class using the current class as primary query
	 */
	public function useActorActiveQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinActorActiveQuestion($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ActorActiveQuestion', 'ActorActiveQuestionQuery');
	}

	/**
	 * Filter the query by a related RelationshipActiveQuestion object
	 *
	 * @param     RelationshipActiveQuestion $relationshipActiveQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByRelationshipActiveQuestionRelatedByActor1id($relationshipActiveQuestion, $comparison = null)
	{
		if ($relationshipActiveQuestion instanceof RelationshipActiveQuestion) {
			return $this
				->addUsingAlias(ActorPeer::ID, $relationshipActiveQuestion->getActor1id(), $comparison);
		} elseif ($relationshipActiveQuestion instanceof PropelCollection) {
			return $this
				->useRelationshipActiveQuestionRelatedByActor1idQuery()
					->filterByPrimaryKeys($relationshipActiveQuestion->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRelationshipActiveQuestionRelatedByActor1id() only accepts arguments of type RelationshipActiveQuestion or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor1id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinRelationshipActiveQuestionRelatedByActor1id($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('RelationshipActiveQuestionRelatedByActor1id');
		
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
			$this->addJoinObject($join, 'RelationshipActiveQuestionRelatedByActor1id');
		}
		
		return $this;
	}

	/**
	 * Use the RelationshipActiveQuestionRelatedByActor1id relation RelationshipActiveQuestion object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RelationshipActiveQuestionQuery A secondary query class using the current class as primary query
	 */
	public function useRelationshipActiveQuestionRelatedByActor1idQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRelationshipActiveQuestionRelatedByActor1id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'RelationshipActiveQuestionRelatedByActor1id', 'RelationshipActiveQuestionQuery');
	}

	/**
	 * Filter the query by a related RelationshipActiveQuestion object
	 *
	 * @param     RelationshipActiveQuestion $relationshipActiveQuestion  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByRelationshipActiveQuestionRelatedByActor2id($relationshipActiveQuestion, $comparison = null)
	{
		if ($relationshipActiveQuestion instanceof RelationshipActiveQuestion) {
			return $this
				->addUsingAlias(ActorPeer::ID, $relationshipActiveQuestion->getActor2id(), $comparison);
		} elseif ($relationshipActiveQuestion instanceof PropelCollection) {
			return $this
				->useRelationshipActiveQuestionRelatedByActor2idQuery()
					->filterByPrimaryKeys($relationshipActiveQuestion->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByRelationshipActiveQuestionRelatedByActor2id() only accepts arguments of type RelationshipActiveQuestion or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the RelationshipActiveQuestionRelatedByActor2id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinRelationshipActiveQuestionRelatedByActor2id($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('RelationshipActiveQuestionRelatedByActor2id');
		
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
			$this->addJoinObject($join, 'RelationshipActiveQuestionRelatedByActor2id');
		}
		
		return $this;
	}

	/**
	 * Use the RelationshipActiveQuestionRelatedByActor2id relation RelationshipActiveQuestion object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    RelationshipActiveQuestionQuery A secondary query class using the current class as primary query
	 */
	public function useRelationshipActiveQuestionRelatedByActor2idQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinRelationshipActiveQuestionRelatedByActor2id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'RelationshipActiveQuestionRelatedByActor2id', 'RelationshipActiveQuestionQuery');
	}

	/**
	 * Filter the query by a related Answer object
	 *
	 * @param     Answer $answer  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByAnswer($answer, $comparison = null)
	{
		if ($answer instanceof Answer) {
			return $this
				->addUsingAlias(ActorPeer::ID, $answer->getActorid(), $comparison);
		} elseif ($answer instanceof PropelCollection) {
			return $this
				->useAnswerQuery()
					->filterByPrimaryKeys($answer->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByAnswer() only accepts arguments of type Answer or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Answer relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinAnswer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Answer');
		
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
			$this->addJoinObject($join, 'Answer');
		}
		
		return $this;
	}

	/**
	 * Use the Answer relation Answer object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    AnswerQuery A secondary query class using the current class as primary query
	 */
	public function useAnswerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinAnswer($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Answer', 'AnswerQuery');
	}

	/**
	 * Filter the query by a related GraphActor object
	 *
	 * @param     GraphActor $graphActor  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByGraphActor($graphActor, $comparison = null)
	{
		if ($graphActor instanceof GraphActor) {
			return $this
				->addUsingAlias(ActorPeer::ID, $graphActor->getActorid(), $comparison);
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
	 * @return    ActorQuery The current query, for fluid interface
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
	 * Filter the query by a related GraphRelation object
	 *
	 * @param     GraphRelation $graphRelation  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByGraphRelationRelatedByActor1id($graphRelation, $comparison = null)
	{
		if ($graphRelation instanceof GraphRelation) {
			return $this
				->addUsingAlias(ActorPeer::ID, $graphRelation->getActor1id(), $comparison);
		} elseif ($graphRelation instanceof PropelCollection) {
			return $this
				->useGraphRelationRelatedByActor1idQuery()
					->filterByPrimaryKeys($graphRelation->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphRelationRelatedByActor1id() only accepts arguments of type GraphRelation or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphRelationRelatedByActor1id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinGraphRelationRelatedByActor1id($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphRelationRelatedByActor1id');
		
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
			$this->addJoinObject($join, 'GraphRelationRelatedByActor1id');
		}
		
		return $this;
	}

	/**
	 * Use the GraphRelationRelatedByActor1id relation GraphRelation object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuery A secondary query class using the current class as primary query
	 */
	public function useGraphRelationRelatedByActor1idQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinGraphRelationRelatedByActor1id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphRelationRelatedByActor1id', 'GraphRelationQuery');
	}

	/**
	 * Filter the query by a related GraphRelation object
	 *
	 * @param     GraphRelation $graphRelation  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByGraphRelationRelatedByActor2id($graphRelation, $comparison = null)
	{
		if ($graphRelation instanceof GraphRelation) {
			return $this
				->addUsingAlias(ActorPeer::ID, $graphRelation->getActor2id(), $comparison);
		} elseif ($graphRelation instanceof PropelCollection) {
			return $this
				->useGraphRelationRelatedByActor2idQuery()
					->filterByPrimaryKeys($graphRelation->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByGraphRelationRelatedByActor2id() only accepts arguments of type GraphRelation or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the GraphRelationRelatedByActor2id relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinGraphRelationRelatedByActor2id($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('GraphRelationRelatedByActor2id');
		
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
			$this->addJoinObject($join, 'GraphRelationRelatedByActor2id');
		}
		
		return $this;
	}

	/**
	 * Use the GraphRelationRelatedByActor2id relation GraphRelation object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    GraphRelationQuery A secondary query class using the current class as primary query
	 */
	public function useGraphRelationRelatedByActor2idQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinGraphRelationRelatedByActor2id($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'GraphRelationRelatedByActor2id', 'GraphRelationQuery');
	}

	/**
	 * Filter the query by a related JudgementActor object
	 *
	 * @param     JudgementActor $judgementActor  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function filterByJudgementActor($judgementActor, $comparison = null)
	{
		if ($judgementActor instanceof JudgementActor) {
			return $this
				->addUsingAlias(ActorPeer::ID, $judgementActor->getActorid(), $comparison);
		} elseif ($judgementActor instanceof PropelCollection) {
			return $this
				->useJudgementActorQuery()
					->filterByPrimaryKeys($judgementActor->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByJudgementActor() only accepts arguments of type JudgementActor or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the JudgementActor relation
	 * 
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function joinJudgementActor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('JudgementActor');
		
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
			$this->addJoinObject($join, 'JudgementActor');
		}
		
		return $this;
	}

	/**
	 * Use the JudgementActor relation JudgementActor object
	 *
	 * @see       useQuery()
	 * 
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    JudgementActorQuery A secondary query class using the current class as primary query
	 */
	public function useJudgementActorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinJudgementActor($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'JudgementActor', 'JudgementActorQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Actor $actor Object to remove from the list of results
	 *
	 * @return    ActorQuery The current query, for fluid interface
	 */
	public function prune($actor = null)
	{
		if ($actor) {
			$this->addUsingAlias(ActorPeer::ID, $actor->getId(), Criteria::NOT_EQUAL);
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
		if (ActorQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
			$this->addUsingAlias(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
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
		if (ActorQuery::isSoftDeleteEnabled() && $this->localSoftDelete) {
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
	 * @see ActorQuery::disableSoftDelete() to disable the filter for more than one query
	 *
	 * @return ActorQuery The current query, for fluid interface
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
		return ActorPeer::doForceDelete($this, $con);
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
		return ActorPeer::doForceDeleteAll($con);}
	
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

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     ActorQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(ActorPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     ActorQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(ActorPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     ActorQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(ActorPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     ActorQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(ActorPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     ActorQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(ActorPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     ActorQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(ActorPeer::CREATED_AT);
	}

} // BaseActorQuery
