<?php


/**
 * Base static class for performing query and update operations on the 'MER_actor' table.
 *
 * Actors
 *
 * @package    propel.generator.actors.classes.om
 */
abstract class BaseActorPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'application';

	/** the table name for this class */
	const TABLE_NAME = 'MER_actor';

	/** the related Propel class for this table */
	const OM_CLASS = 'Actor';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'actors.classes.Actor';

	/** the related TableMap class for this table */
	const TM_CLASS = 'ActorTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 13;

	/** the column name for the ID field */
	const ID = 'MER_actor.ID';

	/** the column name for the TITLE field */
	const TITLE = 'MER_actor.TITLE';

	/** the column name for the NAME field */
	const NAME = 'MER_actor.NAME';

	/** the column name for the SURNAME field */
	const SURNAME = 'MER_actor.SURNAME';

	/** the column name for the CATEGORYID field */
	const CATEGORYID = 'MER_actor.CATEGORYID';

	/** the column name for the ACTIVE field */
	const ACTIVE = 'MER_actor.ACTIVE';

	/** the column name for the STRATEGY field */
	const STRATEGY = 'MER_actor.STRATEGY';

	/** the column name for the TACTIC field */
	const TACTIC = 'MER_actor.TACTIC';

	/** the column name for the COMMENTS field */
	const COMMENTS = 'MER_actor.COMMENTS';

	/** the column name for the OBSERVATIONS field */
	const OBSERVATIONS = 'MER_actor.OBSERVATIONS';

	/** the column name for the DELETED_AT field */
	const DELETED_AT = 'MER_actor.DELETED_AT';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'MER_actor.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'MER_actor.UPDATED_AT';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';
	
	/**
	 * An identiy map to hold any loaded instances of Actor objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Actor[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Name', 'Surname', 'Categoryid', 'Active', 'Strategy', 'Tactic', 'Comments', 'Observations', 'DeletedAt', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'name', 'surname', 'categoryid', 'active', 'strategy', 'tactic', 'comments', 'observations', 'deletedAt', 'createdAt', 'updatedAt', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::TITLE, self::NAME, self::SURNAME, self::CATEGORYID, self::ACTIVE, self::STRATEGY, self::TACTIC, self::COMMENTS, self::OBSERVATIONS, self::DELETED_AT, self::CREATED_AT, self::UPDATED_AT, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TITLE', 'NAME', 'SURNAME', 'CATEGORYID', 'ACTIVE', 'STRATEGY', 'TACTIC', 'COMMENTS', 'OBSERVATIONS', 'DELETED_AT', 'CREATED_AT', 'UPDATED_AT', ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'name', 'surname', 'categoryId', 'active', 'strategy', 'tactic', 'comments', 'observations', 'deleted_at', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Name' => 2, 'Surname' => 3, 'Categoryid' => 4, 'Active' => 5, 'Strategy' => 6, 'Tactic' => 7, 'Comments' => 8, 'Observations' => 9, 'DeletedAt' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'name' => 2, 'surname' => 3, 'categoryid' => 4, 'active' => 5, 'strategy' => 6, 'tactic' => 7, 'comments' => 8, 'observations' => 9, 'deletedAt' => 10, 'createdAt' => 11, 'updatedAt' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::TITLE => 1, self::NAME => 2, self::SURNAME => 3, self::CATEGORYID => 4, self::ACTIVE => 5, self::STRATEGY => 6, self::TACTIC => 7, self::COMMENTS => 8, self::OBSERVATIONS => 9, self::DELETED_AT => 10, self::CREATED_AT => 11, self::UPDATED_AT => 12, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TITLE' => 1, 'NAME' => 2, 'SURNAME' => 3, 'CATEGORYID' => 4, 'ACTIVE' => 5, 'STRATEGY' => 6, 'TACTIC' => 7, 'COMMENTS' => 8, 'OBSERVATIONS' => 9, 'DELETED_AT' => 10, 'CREATED_AT' => 11, 'UPDATED_AT' => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'name' => 2, 'surname' => 3, 'categoryId' => 4, 'active' => 5, 'strategy' => 6, 'tactic' => 7, 'comments' => 8, 'observations' => 9, 'deleted_at' => 10, 'created_at' => 11, 'updated_at' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
	 * @param      string $column The column name for current table. (i.e. ActorPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ActorPeer::TABLE_NAME.'.', $alias.'.', $column);
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
			$criteria->addSelectColumn(ActorPeer::ID);
			$criteria->addSelectColumn(ActorPeer::TITLE);
			$criteria->addSelectColumn(ActorPeer::NAME);
			$criteria->addSelectColumn(ActorPeer::SURNAME);
			$criteria->addSelectColumn(ActorPeer::CATEGORYID);
			$criteria->addSelectColumn(ActorPeer::ACTIVE);
			$criteria->addSelectColumn(ActorPeer::STRATEGY);
			$criteria->addSelectColumn(ActorPeer::TACTIC);
			$criteria->addSelectColumn(ActorPeer::COMMENTS);
			$criteria->addSelectColumn(ActorPeer::OBSERVATIONS);
			$criteria->addSelectColumn(ActorPeer::DELETED_AT);
			$criteria->addSelectColumn(ActorPeer::CREATED_AT);
			$criteria->addSelectColumn(ActorPeer::UPDATED_AT);
		} else {
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.TITLE');
			$criteria->addSelectColumn($alias . '.NAME');
			$criteria->addSelectColumn($alias . '.SURNAME');
			$criteria->addSelectColumn($alias . '.CATEGORYID');
			$criteria->addSelectColumn($alias . '.ACTIVE');
			$criteria->addSelectColumn($alias . '.STRATEGY');
			$criteria->addSelectColumn($alias . '.TACTIC');
			$criteria->addSelectColumn($alias . '.COMMENTS');
			$criteria->addSelectColumn($alias . '.OBSERVATIONS');
			$criteria->addSelectColumn($alias . '.DELETED_AT');
			$criteria->addSelectColumn($alias . '.CREATED_AT');
			$criteria->addSelectColumn($alias . '.UPDATED_AT');
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
		$criteria->setPrimaryTableName(ActorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ActorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// soft_delete behavior
		if (ActorQuery::isSoftDeleteEnabled()) {
			$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
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
	 * @return     Actor
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ActorPeer::doSelect($critcopy, $con);
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
		return ActorPeer::populateObjects(ActorPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ActorPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);
		// soft_delete behavior
		if (ActorQuery::isSoftDeleteEnabled()) {
			$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
		}

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
	 * @param      Actor $value A Actor object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
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
	 * @param      mixed $value A Actor object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Actor) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Actor object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Actor Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to MER_actor
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
		// Invalidate objects in AnswerPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		AnswerPeer::clearInstancePool();
		// Invalidate objects in GraphActorPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		GraphActorPeer::clearInstancePool();
		// Invalidate objects in GraphRelationPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		GraphRelationPeer::clearInstancePool();
		// Invalidate objects in GraphRelationPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		GraphRelationPeer::clearInstancePool();
		// Invalidate objects in JudgementActorPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		JudgementActorPeer::clearInstancePool();
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
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
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
		return (int) $row[$startcol];
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
		$cls = ActorPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ActorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ActorPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ActorPeer::addInstanceToPool($obj, $key);
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
	 * @return     array (Actor object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = ActorPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = ActorPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + ActorPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = ActorPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			ActorPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Category table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ActorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ActorPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ActorPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

		// soft_delete behavior
		if (ActorQuery::isSoftDeleteEnabled()) {
			$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
		}
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
	 * Selects a collection of Actor objects pre-filled with their Category objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Actor objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ActorPeer::addSelectColumns($criteria);
		$startcol = ActorPeer::NUM_HYDRATE_COLUMNS;
		CategoryPeer::addSelectColumns($criteria);

		$criteria->addJoin(ActorPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

		// soft_delete behavior
		if (ActorQuery::isSoftDeleteEnabled()) {
			$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
		}
		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ActorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ActorPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = ActorPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ActorPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CategoryPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = CategoryPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CategoryPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Actor) to $obj2 (Category)
				$obj2->addActor($obj1);

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
		$criteria->setPrimaryTableName(ActorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ActorPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ActorPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

		// soft_delete behavior
		if (ActorQuery::isSoftDeleteEnabled()) {
			$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
		}
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
	 * Selects a collection of Actor objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Actor objects.
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

		ActorPeer::addSelectColumns($criteria);
		$startcol2 = ActorPeer::NUM_HYDRATE_COLUMNS;

		CategoryPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + CategoryPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(ActorPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

		// soft_delete behavior
		if (ActorQuery::isSoftDeleteEnabled()) {
			$criteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		} else {
			ActorPeer::enableSoftDelete();
		}
		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ActorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ActorPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = ActorPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ActorPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Category rows

			$key2 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CategoryPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = CategoryPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CategoryPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Actor) to the collection in $obj2 (Category)
				$obj2->addActor($obj1);
			} // if joined row not null

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
	  $dbMap = Propel::getDatabaseMap(BaseActorPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseActorPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new ActorTableMap());
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
		return $withPrefix ? ActorPeer::CLASS_DEFAULT : ActorPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a Actor or Criteria object.
	 *
	 * @param      mixed $values Criteria or Actor object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Actor object
		}

		if ($criteria->containsKey(ActorPeer::ID) && $criteria->keyContainsValue(ActorPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ActorPeer::ID.')');
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
	 * Method perform an UPDATE on the database, given a Actor or Criteria object.
	 *
	 * @param      mixed $values Criteria or Actor object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ActorPeer::ID);
			$value = $criteria->remove(ActorPeer::ID);
			if ($value) {
				$selectCriteria->add(ActorPeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(ActorPeer::TABLE_NAME);
			}

		} else { // $values is Actor object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the MER_actor table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doForceDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += ActorPeer::doOnDeleteCascade(new Criteria(ActorPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(ActorPeer::TABLE_NAME, $con, ActorPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			ActorPeer::clearInstancePool();
			ActorPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Actor or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Actor object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doForceDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Actor) { // it's a model object
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ActorPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			// cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
			$c = clone $criteria;
			$affectedRows += ActorPeer::doOnDeleteCascade($c, $con);
			
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			if ($values instanceof Criteria) {
				ActorPeer::clearInstancePool();
			} elseif ($values instanceof Actor) { // it's a model object
				ActorPeer::removeInstanceFromPool($values);
			} else { // it's a primary key, or an array of pks
				foreach ((array) $values as $singleval) {
					ActorPeer::removeInstanceFromPool($singleval);
				}
			}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			ActorPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = ActorPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related Answer objects
			$criteria = new Criteria(AnswerPeer::DATABASE_NAME);
			
			$criteria->add(AnswerPeer::ACTORID, $obj->getId());
			$affectedRows += AnswerPeer::doDelete($criteria, $con);

			// delete related GraphActor objects
			$criteria = new Criteria(GraphActorPeer::DATABASE_NAME);
			
			$criteria->add(GraphActorPeer::ACTORID, $obj->getId());
			$affectedRows += GraphActorPeer::doDelete($criteria, $con);

			// delete related GraphRelation objects
			$criteria = new Criteria(GraphRelationPeer::DATABASE_NAME);
			
			$criteria->add(GraphRelationPeer::ACTOR1ID, $obj->getId());
			$affectedRows += GraphRelationPeer::doDelete($criteria, $con);

			// delete related GraphRelation objects
			$criteria = new Criteria(GraphRelationPeer::DATABASE_NAME);
			
			$criteria->add(GraphRelationPeer::ACTOR2ID, $obj->getId());
			$affectedRows += GraphRelationPeer::doDelete($criteria, $con);

			// delete related JudgementActor objects
			$criteria = new Criteria(JudgementActorPeer::DATABASE_NAME);
			
			$criteria->add(JudgementActorPeer::ACTORID, $obj->getId());
			$affectedRows += JudgementActorPeer::doDelete($criteria, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given Actor object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Actor $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ActorPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ActorPeer::TABLE_NAME);

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

		return BasePeer::doValidate(ActorPeer::DATABASE_NAME, ActorPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Actor
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ActorPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ActorPeer::DATABASE_NAME);
		$criteria->add(ActorPeer::ID, $pk);

		$v = ActorPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ActorPeer::DATABASE_NAME);
			$criteria->add(ActorPeer::ID, $pks, Criteria::IN);
			$objs = ActorPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	// soft_delete behavior
	
	/**
	 * Enable the soft_delete behavior for this model
	 */
	public static function enableSoftDelete()
	{
		ActorQuery::enableSoftDelete();
		// some soft_deleted objects may be in the instance pool
		ActorPeer::clearInstancePool();
	}
	
	/**
	 * Disable the soft_delete behavior for this model
	 */
	public static function disableSoftDelete()
	{
		ActorQuery::disableSoftDelete();
	}
	
	/**
	 * Check the soft_delete behavior for this model
	 * @return boolean true if the soft_delete behavior is enabled
	 */
	public static function isSoftDeleteEnabled()
	{
		return ActorQuery::isSoftDeleteEnabled();
	}
	
	/**
	 * Soft delete records, given a Actor or Criteria object OR a primary key value.
	 *
	 * @param			 mixed $values Criteria or Actor object or primary key or array of primary keys
	 *							which is used to create the DELETE statement
	 * @param			 PropelPDO $con the connection to use
	 * @return		 int	The number of affected rows (if supported by underlying database driver).
	 * @throws		 PropelException Any exceptions caught during processing will be
	 *							rethrown wrapped into a PropelException.
	 */
	public static function doSoftDelete($values, PropelPDO $con = null)
	{
		if ($values instanceof Criteria) {
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Actor) {
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ActorPeer::ID, (array) $values, Criteria::IN);
		}
		$criteria->add(ActorPeer::DELETED_AT, time());
		return ActorPeer::doUpdate($criteria, $con);
	}
	
	/**
	 * Delete or soft delete records, depending on ActorPeer::$softDelete
	 *
	 * @param			 mixed $values Criteria or Actor object or primary key or array of primary keys
	 *							which is used to create the DELETE statement
	 * @param			 PropelPDO $con the connection to use
	 * @return		 int	The number of affected rows (if supported by underlying database driver).
	 * @throws		 PropelException Any exceptions caught during processing will be
	 *							rethrown wrapped into a PropelException.
	 */
	public static function doDelete($values, PropelPDO $con = null)
	{
		if (ActorPeer::isSoftDeleteEnabled()) {
			return ActorPeer::doSoftDelete($values, $con);
		} else {
			return ActorPeer::doForceDelete($values, $con);
		} 
	}
	/**
	 * Method to soft delete all rows from the MER_actor table.
	 *
	 * @param			 PropelPDO $con the connection to use
	 * @return		 int The number of affected rows (if supported by underlying database driver).
	 * @throws		 PropelException Any exceptions caught during processing will be
	 *							rethrown wrapped into a PropelException.
	 */
	public static function doSoftDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$selectCriteria = new Criteria();
		$selectCriteria->add(ActorPeer::DELETED_AT, null, Criteria::ISNULL);
		$selectCriteria->setDbName(ActorPeer::DATABASE_NAME);
		$modifyCriteria = new Criteria();
		$modifyCriteria->add(ActorPeer::DELETED_AT, time());
		return BasePeer::doUpdate($selectCriteria, $modifyCriteria, $con);
	}
	
	/**
	 * Delete or soft delete all records, depending on ActorPeer::$softDelete
	 *
	 * @param			 PropelPDO $con the connection to use
	 * @return		 int	The number of affected rows (if supported by underlying database driver).
	 * @throws		 PropelException Any exceptions caught during processing will be
	 *							rethrown wrapped into a PropelException.
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if (ActorPeer::isSoftDeleteEnabled()) {
			return ActorPeer::doSoftDeleteAll($con);
		} else {
			return ActorPeer::doForceDeleteAll($con);
		} 
	}

} // BaseActorPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseActorPeer::buildTableMap();

