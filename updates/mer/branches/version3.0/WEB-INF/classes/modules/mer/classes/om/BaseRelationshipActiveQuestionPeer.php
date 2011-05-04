<?php


/**
 * Base static class for performing query and update operations on the 'MER_relationshipActiveQuestion' table.
 *
 * 
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseRelationshipActiveQuestionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'application';

	/** the table name for this class */
	const TABLE_NAME = 'MER_relationshipActiveQuestion';

	/** the related Propel class for this table */
	const OM_CLASS = 'RelationshipActiveQuestion';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'mer.classes.RelationshipActiveQuestion';

	/** the related TableMap class for this table */
	const TM_CLASS = 'RelationshipActiveQuestionTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 3;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 3;

	/** the column name for the ACTOR1ID field */
	const ACTOR1ID = 'MER_relationshipActiveQuestion.ACTOR1ID';

	/** the column name for the ACTOR2ID field */
	const ACTOR2ID = 'MER_relationshipActiveQuestion.ACTOR2ID';

	/** the column name for the QUESTIONID field */
	const QUESTIONID = 'MER_relationshipActiveQuestion.QUESTIONID';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';
	
	/**
	 * An identiy map to hold any loaded instances of RelationshipActiveQuestion objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array RelationshipActiveQuestion[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Actor1id', 'Actor2id', 'Questionid', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('actor1id', 'actor2id', 'questionid', ),
		BasePeer::TYPE_COLNAME => array (self::ACTOR1ID, self::ACTOR2ID, self::QUESTIONID, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ACTOR1ID', 'ACTOR2ID', 'QUESTIONID', ),
		BasePeer::TYPE_FIELDNAME => array ('actor1Id', 'actor2Id', 'questionId', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Actor1id' => 0, 'Actor2id' => 1, 'Questionid' => 2, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('actor1id' => 0, 'actor2id' => 1, 'questionid' => 2, ),
		BasePeer::TYPE_COLNAME => array (self::ACTOR1ID => 0, self::ACTOR2ID => 1, self::QUESTIONID => 2, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ACTOR1ID' => 0, 'ACTOR2ID' => 1, 'QUESTIONID' => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('actor1Id' => 0, 'actor2Id' => 1, 'questionId' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. RelationshipActiveQuestionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RelationshipActiveQuestionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(RelationshipActiveQuestionPeer::ACTOR1ID);
			$criteria->addSelectColumn(RelationshipActiveQuestionPeer::ACTOR2ID);
			$criteria->addSelectColumn(RelationshipActiveQuestionPeer::QUESTIONID);
		} else {
			$criteria->addSelectColumn($alias . '.ACTOR1ID');
			$criteria->addSelectColumn($alias . '.ACTOR2ID');
			$criteria->addSelectColumn($alias . '.QUESTIONID');
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     RelationshipActiveQuestion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RelationshipActiveQuestionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RelationshipActiveQuestionPeer::populateObjects(RelationshipActiveQuestionPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      RelationshipActiveQuestion $value A RelationshipActiveQuestion object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getActor1id(), (string) $obj->getActor2id(), (string) $obj->getQuestionid()));
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A RelationshipActiveQuestion object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RelationshipActiveQuestion) {
				$key = serialize(array((string) $value->getActor1id(), (string) $value->getActor2id(), (string) $value->getQuestionid()));
			} elseif (is_array($value) && count($value) === 3) {
				// assume we've been passed a primary key
				$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RelationshipActiveQuestion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     RelationshipActiveQuestion Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to MER_relationshipActiveQuestion
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol], (string) $row[$startcol + 1], (string) $row[$startcol + 2]));
	}

	/**
	 * Retrieves the primary key from the DB resultset row 
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return array((int) $row[$startcol], (int) $row[$startcol + 1], (int) $row[$startcol + 2]);
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = RelationshipActiveQuestionPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RelationshipActiveQuestionPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RelationshipActiveQuestionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (RelationshipActiveQuestion object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = RelationshipActiveQuestionPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = RelationshipActiveQuestionPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			RelationshipActiveQuestionPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}

	/**
	 * Returns the number of rows matching criteria, joining the related ActorRelatedByActor1id table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinActorRelatedByActor1id(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR1ID, ActorPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ActorRelatedByActor2id table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinActorRelatedByActor2id(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR2ID, ActorPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Question table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinQuestion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with their Actor objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinActorRelatedByActor1id(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;
		ActorPeer::addSelectColumns($criteria);

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR1ID, ActorPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ActorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ActorPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ActorPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to $obj2 (Actor)
				$obj2->addRelationshipActiveQuestionRelatedByActor1id($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with their Actor objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinActorRelatedByActor2id(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;
		ActorPeer::addSelectColumns($criteria);

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR2ID, ActorPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ActorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ActorPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ActorPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to $obj2 (Actor)
				$obj2->addRelationshipActiveQuestionRelatedByActor2id($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with their Question objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinQuestion(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;
		QuestionPeer::addSelectColumns($criteria);

		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = QuestionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = QuestionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = QuestionPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					QuestionPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to $obj2 (Question)
				$obj2->addRelationshipActiveQuestion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR1ID, ActorPeer::ID, $join_behavior);

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR2ID, ActorPeer::ID, $join_behavior);

		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol2 = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;

		ActorPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + ActorPeer::NUM_HYDRATE_COLUMNS;

		ActorPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + ActorPeer::NUM_HYDRATE_COLUMNS;

		QuestionPeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + QuestionPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR1ID, ActorPeer::ID, $join_behavior);

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR2ID, ActorPeer::ID, $join_behavior);

		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Actor rows

			$key2 = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ActorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ActorPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ActorPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj2 (Actor)
				$obj2->addRelationshipActiveQuestionRelatedByActor1id($obj1);
			} // if joined row not null

			// Add objects for joined Actor rows

			$key3 = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ActorPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = ActorPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ActorPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj3 (Actor)
				$obj3->addRelationshipActiveQuestionRelatedByActor2id($obj1);
			} // if joined row not null

			// Add objects for joined Question rows

			$key4 = QuestionPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = QuestionPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$cls = QuestionPeer::getOMClass(false);

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					QuestionPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj4 (Question)
				$obj4->addRelationshipActiveQuestion($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ActorRelatedByActor1id table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptActorRelatedByActor1id(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ActorRelatedByActor2id table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptActorRelatedByActor2id(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Question table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptQuestion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR1ID, ActorPeer::ID, $join_behavior);

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR2ID, ActorPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with all related objects except ActorRelatedByActor1id.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptActorRelatedByActor1id(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol2 = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;

		QuestionPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + QuestionPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Question rows

				$key2 = QuestionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = QuestionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = QuestionPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					QuestionPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj2 (Question)
				$obj2->addRelationshipActiveQuestion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with all related objects except ActorRelatedByActor2id.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptActorRelatedByActor2id(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol2 = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;

		QuestionPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + QuestionPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(RelationshipActiveQuestionPeer::QUESTIONID, QuestionPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Question rows

				$key2 = QuestionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = QuestionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = QuestionPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					QuestionPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj2 (Question)
				$obj2->addRelationshipActiveQuestion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of RelationshipActiveQuestion objects pre-filled with all related objects except Question.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of RelationshipActiveQuestion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptQuestion(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		RelationshipActiveQuestionPeer::addSelectColumns($criteria);
		$startcol2 = RelationshipActiveQuestionPeer::NUM_HYDRATE_COLUMNS;

		ActorPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + ActorPeer::NUM_HYDRATE_COLUMNS;

		ActorPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + ActorPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR1ID, ActorPeer::ID, $join_behavior);

		$criteria->addJoin(RelationshipActiveQuestionPeer::ACTOR2ID, ActorPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RelationshipActiveQuestionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RelationshipActiveQuestionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = RelationshipActiveQuestionPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				RelationshipActiveQuestionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Actor rows

				$key2 = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ActorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = ActorPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ActorPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj2 (Actor)
				$obj2->addRelationshipActiveQuestionRelatedByActor1id($obj1);

			} // if joined row is not null

				// Add objects for joined Actor rows

				$key3 = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ActorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = ActorPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ActorPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (RelationshipActiveQuestion) to the collection in $obj3 (Actor)
				$obj3->addRelationshipActiveQuestionRelatedByActor2id($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseRelationshipActiveQuestionPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseRelationshipActiveQuestionPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new RelationshipActiveQuestionTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean $withPrefix Whether or not to return the path with the class name
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? RelationshipActiveQuestionPeer::CLASS_DEFAULT : RelationshipActiveQuestionPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a RelationshipActiveQuestion or Criteria object.
	 *
	 * @param      mixed $values Criteria or RelationshipActiveQuestion object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from RelationshipActiveQuestion object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a RelationshipActiveQuestion or Criteria object.
	 *
	 * @param      mixed $values Criteria or RelationshipActiveQuestion object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(RelationshipActiveQuestionPeer::ACTOR1ID);
			$value = $criteria->remove(RelationshipActiveQuestionPeer::ACTOR1ID);
			if ($value) {
				$selectCriteria->add(RelationshipActiveQuestionPeer::ACTOR1ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);
			}

			$comparison = $criteria->getComparison(RelationshipActiveQuestionPeer::ACTOR2ID);
			$value = $criteria->remove(RelationshipActiveQuestionPeer::ACTOR2ID);
			if ($value) {
				$selectCriteria->add(RelationshipActiveQuestionPeer::ACTOR2ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);
			}

			$comparison = $criteria->getComparison(RelationshipActiveQuestionPeer::QUESTIONID);
			$value = $criteria->remove(RelationshipActiveQuestionPeer::QUESTIONID);
			if ($value) {
				$selectCriteria->add(RelationshipActiveQuestionPeer::QUESTIONID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(RelationshipActiveQuestionPeer::TABLE_NAME);
			}

		} else { // $values is RelationshipActiveQuestion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the MER_relationshipActiveQuestion table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RelationshipActiveQuestionPeer::TABLE_NAME, $con, RelationshipActiveQuestionPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			RelationshipActiveQuestionPeer::clearInstancePool();
			RelationshipActiveQuestionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RelationshipActiveQuestion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RelationshipActiveQuestion object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			RelationshipActiveQuestionPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof RelationshipActiveQuestion) { // it's a model object
			// invalidate the cache for this single object
			RelationshipActiveQuestionPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey values
			if (count($values) == count($values, COUNT_RECURSIVE)) {
				// array is not multi-dimensional
				$values = array($values);
			}
			foreach ($values as $value) {
				$criterion = $criteria->getNewCriterion(RelationshipActiveQuestionPeer::ACTOR1ID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(RelationshipActiveQuestionPeer::ACTOR2ID, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(RelationshipActiveQuestionPeer::QUESTIONID, $value[2]));
				$criteria->addOr($criterion);
				// we can invalidate the cache for this single PK
				RelationshipActiveQuestionPeer::removeInstanceFromPool($value);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			RelationshipActiveQuestionPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given RelationshipActiveQuestion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RelationshipActiveQuestion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RelationshipActiveQuestionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RelationshipActiveQuestionPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(RelationshipActiveQuestionPeer::DATABASE_NAME, RelationshipActiveQuestionPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param      int $actor1id
	 * @param      int $actor2id
	 * @param      int $questionid
	 * @param      PropelPDO $con
	 * @return     RelationshipActiveQuestion
	 */
	public static function retrieveByPK($actor1id, $actor2id, $questionid, PropelPDO $con = null) {
		$_instancePoolKey = serialize(array((string) $actor1id, (string) $actor2id, (string) $questionid));
 		if (null !== ($obj = RelationshipActiveQuestionPeer::getInstanceFromPool($_instancePoolKey))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RelationshipActiveQuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(RelationshipActiveQuestionPeer::DATABASE_NAME);
		$criteria->add(RelationshipActiveQuestionPeer::ACTOR1ID, $actor1id);
		$criteria->add(RelationshipActiveQuestionPeer::ACTOR2ID, $actor2id);
		$criteria->add(RelationshipActiveQuestionPeer::QUESTIONID, $questionid);
		$v = RelationshipActiveQuestionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseRelationshipActiveQuestionPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseRelationshipActiveQuestionPeer::buildTableMap();

