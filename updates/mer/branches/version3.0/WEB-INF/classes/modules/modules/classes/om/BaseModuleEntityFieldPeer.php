<?php


/**
 * Base static class for performing query and update operations on the 'modules_entityField' table.
 *
 * Campos de las entidades de modulos
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleEntityFieldPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'application';

	/** the table name for this class */
	const TABLE_NAME = 'modules_entityField';

	/** the related Propel class for this table */
	const OM_CLASS = 'ModuleEntityField';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'modules.classes.ModuleEntityField';

	/** the related TableMap class for this table */
	const TM_CLASS = 'ModuleEntityFieldTableMap';
	
	/** The total number of columns. */
	const NUM_COLUMNS = 22;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 22;

	/** the column name for the UNIQUENAME field */
	const UNIQUENAME = 'modules_entityField.UNIQUENAME';

	/** the column name for the ENTITYNAME field */
	const ENTITYNAME = 'modules_entityField.ENTITYNAME';

	/** the column name for the NAME field */
	const NAME = 'modules_entityField.NAME';

	/** the column name for the DESCRIPTION field */
	const DESCRIPTION = 'modules_entityField.DESCRIPTION';

	/** the column name for the ISREQUIRED field */
	const ISREQUIRED = 'modules_entityField.ISREQUIRED';

	/** the column name for the DEFAULTVALUE field */
	const DEFAULTVALUE = 'modules_entityField.DEFAULTVALUE';

	/** the column name for the ISPRIMARYKEY field */
	const ISPRIMARYKEY = 'modules_entityField.ISPRIMARYKEY';

	/** the column name for the ISAUTOINCREMENT field */
	const ISAUTOINCREMENT = 'modules_entityField.ISAUTOINCREMENT';

	/** the column name for the ORDER field */
	const ORDER = 'modules_entityField.ORDER';

	/** the column name for the TYPE field */
	const TYPE = 'modules_entityField.TYPE';

	/** the column name for the UNIQUE field */
	const UNIQUE = 'modules_entityField.UNIQUE';

	/** the column name for the SIZE field */
	const SIZE = 'modules_entityField.SIZE';

	/** the column name for the AGGREGATEEXPRESSION field */
	const AGGREGATEEXPRESSION = 'modules_entityField.AGGREGATEEXPRESSION';

	/** the column name for the LABEL field */
	const LABEL = 'modules_entityField.LABEL';

	/** the column name for the FORMFIELDTYPE field */
	const FORMFIELDTYPE = 'modules_entityField.FORMFIELDTYPE';

	/** the column name for the FORMFIELDSIZE field */
	const FORMFIELDSIZE = 'modules_entityField.FORMFIELDSIZE';

	/** the column name for the FORMFIELDLINES field */
	const FORMFIELDLINES = 'modules_entityField.FORMFIELDLINES';

	/** the column name for the FORMFIELDUSECALENDAR field */
	const FORMFIELDUSECALENDAR = 'modules_entityField.FORMFIELDUSECALENDAR';

	/** the column name for the FOREIGNKEYTABLE field */
	const FOREIGNKEYTABLE = 'modules_entityField.FOREIGNKEYTABLE';

	/** the column name for the FOREIGNKEYREMOTE field */
	const FOREIGNKEYREMOTE = 'modules_entityField.FOREIGNKEYREMOTE';

	/** the column name for the ONDELETE field */
	const ONDELETE = 'modules_entityField.ONDELETE';

	/** the column name for the AUTOMATIC field */
	const AUTOMATIC = 'modules_entityField.AUTOMATIC';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';
	
	/**
	 * An identiy map to hold any loaded instances of ModuleEntityField objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array ModuleEntityField[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Uniquename', 'Entityname', 'Name', 'Description', 'Isrequired', 'Defaultvalue', 'Isprimarykey', 'Isautoincrement', 'Order', 'Type', 'Unique', 'Size', 'Aggregateexpression', 'Label', 'Formfieldtype', 'Formfieldsize', 'Formfieldlines', 'Formfieldusecalendar', 'Foreignkeytable', 'Foreignkeyremote', 'Ondelete', 'Automatic', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('uniquename', 'entityname', 'name', 'description', 'isrequired', 'defaultvalue', 'isprimarykey', 'isautoincrement', 'order', 'type', 'unique', 'size', 'aggregateexpression', 'label', 'formfieldtype', 'formfieldsize', 'formfieldlines', 'formfieldusecalendar', 'foreignkeytable', 'foreignkeyremote', 'ondelete', 'automatic', ),
		BasePeer::TYPE_COLNAME => array (self::UNIQUENAME, self::ENTITYNAME, self::NAME, self::DESCRIPTION, self::ISREQUIRED, self::DEFAULTVALUE, self::ISPRIMARYKEY, self::ISAUTOINCREMENT, self::ORDER, self::TYPE, self::UNIQUE, self::SIZE, self::AGGREGATEEXPRESSION, self::LABEL, self::FORMFIELDTYPE, self::FORMFIELDSIZE, self::FORMFIELDLINES, self::FORMFIELDUSECALENDAR, self::FOREIGNKEYTABLE, self::FOREIGNKEYREMOTE, self::ONDELETE, self::AUTOMATIC, ),
		BasePeer::TYPE_RAW_COLNAME => array ('UNIQUENAME', 'ENTITYNAME', 'NAME', 'DESCRIPTION', 'ISREQUIRED', 'DEFAULTVALUE', 'ISPRIMARYKEY', 'ISAUTOINCREMENT', 'ORDER', 'TYPE', 'UNIQUE', 'SIZE', 'AGGREGATEEXPRESSION', 'LABEL', 'FORMFIELDTYPE', 'FORMFIELDSIZE', 'FORMFIELDLINES', 'FORMFIELDUSECALENDAR', 'FOREIGNKEYTABLE', 'FOREIGNKEYREMOTE', 'ONDELETE', 'AUTOMATIC', ),
		BasePeer::TYPE_FIELDNAME => array ('uniqueName', 'entityName', 'name', 'description', 'isRequired', 'defaultValue', 'isPrimaryKey', 'isAutoIncrement', 'order', 'type', 'unique', 'size', 'aggregateExpression', 'label', 'formFieldType', 'formFieldSize', 'formFieldLines', 'formFieldUseCalendar', 'foreignKeyTable', 'foreignKeyRemote', 'onDelete', 'automatic', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Uniquename' => 0, 'Entityname' => 1, 'Name' => 2, 'Description' => 3, 'Isrequired' => 4, 'Defaultvalue' => 5, 'Isprimarykey' => 6, 'Isautoincrement' => 7, 'Order' => 8, 'Type' => 9, 'Unique' => 10, 'Size' => 11, 'Aggregateexpression' => 12, 'Label' => 13, 'Formfieldtype' => 14, 'Formfieldsize' => 15, 'Formfieldlines' => 16, 'Formfieldusecalendar' => 17, 'Foreignkeytable' => 18, 'Foreignkeyremote' => 19, 'Ondelete' => 20, 'Automatic' => 21, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('uniquename' => 0, 'entityname' => 1, 'name' => 2, 'description' => 3, 'isrequired' => 4, 'defaultvalue' => 5, 'isprimarykey' => 6, 'isautoincrement' => 7, 'order' => 8, 'type' => 9, 'unique' => 10, 'size' => 11, 'aggregateexpression' => 12, 'label' => 13, 'formfieldtype' => 14, 'formfieldsize' => 15, 'formfieldlines' => 16, 'formfieldusecalendar' => 17, 'foreignkeytable' => 18, 'foreignkeyremote' => 19, 'ondelete' => 20, 'automatic' => 21, ),
		BasePeer::TYPE_COLNAME => array (self::UNIQUENAME => 0, self::ENTITYNAME => 1, self::NAME => 2, self::DESCRIPTION => 3, self::ISREQUIRED => 4, self::DEFAULTVALUE => 5, self::ISPRIMARYKEY => 6, self::ISAUTOINCREMENT => 7, self::ORDER => 8, self::TYPE => 9, self::UNIQUE => 10, self::SIZE => 11, self::AGGREGATEEXPRESSION => 12, self::LABEL => 13, self::FORMFIELDTYPE => 14, self::FORMFIELDSIZE => 15, self::FORMFIELDLINES => 16, self::FORMFIELDUSECALENDAR => 17, self::FOREIGNKEYTABLE => 18, self::FOREIGNKEYREMOTE => 19, self::ONDELETE => 20, self::AUTOMATIC => 21, ),
		BasePeer::TYPE_RAW_COLNAME => array ('UNIQUENAME' => 0, 'ENTITYNAME' => 1, 'NAME' => 2, 'DESCRIPTION' => 3, 'ISREQUIRED' => 4, 'DEFAULTVALUE' => 5, 'ISPRIMARYKEY' => 6, 'ISAUTOINCREMENT' => 7, 'ORDER' => 8, 'TYPE' => 9, 'UNIQUE' => 10, 'SIZE' => 11, 'AGGREGATEEXPRESSION' => 12, 'LABEL' => 13, 'FORMFIELDTYPE' => 14, 'FORMFIELDSIZE' => 15, 'FORMFIELDLINES' => 16, 'FORMFIELDUSECALENDAR' => 17, 'FOREIGNKEYTABLE' => 18, 'FOREIGNKEYREMOTE' => 19, 'ONDELETE' => 20, 'AUTOMATIC' => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('uniqueName' => 0, 'entityName' => 1, 'name' => 2, 'description' => 3, 'isRequired' => 4, 'defaultValue' => 5, 'isPrimaryKey' => 6, 'isAutoIncrement' => 7, 'order' => 8, 'type' => 9, 'unique' => 10, 'size' => 11, 'aggregateExpression' => 12, 'label' => 13, 'formFieldType' => 14, 'formFieldSize' => 15, 'formFieldLines' => 16, 'formFieldUseCalendar' => 17, 'foreignKeyTable' => 18, 'foreignKeyRemote' => 19, 'onDelete' => 20, 'automatic' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
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
	 * @param      string $column The column name for current table. (i.e. ModuleEntityFieldPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ModuleEntityFieldPeer::TABLE_NAME.'.', $alias.'.', $column);
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
			$criteria->addSelectColumn(ModuleEntityFieldPeer::UNIQUENAME);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::ENTITYNAME);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::NAME);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::DESCRIPTION);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::ISREQUIRED);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::DEFAULTVALUE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::ISPRIMARYKEY);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::ISAUTOINCREMENT);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::ORDER);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::TYPE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::UNIQUE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::SIZE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::AGGREGATEEXPRESSION);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::LABEL);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::FORMFIELDTYPE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::FORMFIELDSIZE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::FORMFIELDLINES);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::FORMFIELDUSECALENDAR);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::FOREIGNKEYTABLE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::FOREIGNKEYREMOTE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::ONDELETE);
			$criteria->addSelectColumn(ModuleEntityFieldPeer::AUTOMATIC);
		} else {
			$criteria->addSelectColumn($alias . '.UNIQUENAME');
			$criteria->addSelectColumn($alias . '.ENTITYNAME');
			$criteria->addSelectColumn($alias . '.NAME');
			$criteria->addSelectColumn($alias . '.DESCRIPTION');
			$criteria->addSelectColumn($alias . '.ISREQUIRED');
			$criteria->addSelectColumn($alias . '.DEFAULTVALUE');
			$criteria->addSelectColumn($alias . '.ISPRIMARYKEY');
			$criteria->addSelectColumn($alias . '.ISAUTOINCREMENT');
			$criteria->addSelectColumn($alias . '.ORDER');
			$criteria->addSelectColumn($alias . '.TYPE');
			$criteria->addSelectColumn($alias . '.UNIQUE');
			$criteria->addSelectColumn($alias . '.SIZE');
			$criteria->addSelectColumn($alias . '.AGGREGATEEXPRESSION');
			$criteria->addSelectColumn($alias . '.LABEL');
			$criteria->addSelectColumn($alias . '.FORMFIELDTYPE');
			$criteria->addSelectColumn($alias . '.FORMFIELDSIZE');
			$criteria->addSelectColumn($alias . '.FORMFIELDLINES');
			$criteria->addSelectColumn($alias . '.FORMFIELDUSECALENDAR');
			$criteria->addSelectColumn($alias . '.FOREIGNKEYTABLE');
			$criteria->addSelectColumn($alias . '.FOREIGNKEYREMOTE');
			$criteria->addSelectColumn($alias . '.ONDELETE');
			$criteria->addSelectColumn($alias . '.AUTOMATIC');
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
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     ModuleEntityField
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ModuleEntityFieldPeer::doSelect($critcopy, $con);
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
		return ModuleEntityFieldPeer::populateObjects(ModuleEntityFieldPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ModuleEntityFieldPeer::addSelectColumns($criteria);
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
	 * @param      ModuleEntityField $value A ModuleEntityField object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getUniquename();
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
	 * @param      mixed $value A ModuleEntityField object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ModuleEntityField) {
				$key = (string) $value->getUniquename();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ModuleEntityField object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     ModuleEntityField Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to modules_entityField
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
		// Invalidate objects in ModuleEntityFieldPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		ModuleEntityFieldPeer::clearInstancePool();
		// Invalidate objects in ModuleEntityFieldValidationPeer instance pool, 
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		ModuleEntityFieldValidationPeer::clearInstancePool();
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
		return (string) $row[$startcol];
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
		$cls = ModuleEntityFieldPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ModuleEntityFieldPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ModuleEntityFieldPeer::addInstanceToPool($obj, $key);
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
	 * @return     array (ModuleEntityField object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = ModuleEntityFieldPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = ModuleEntityFieldPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			ModuleEntityFieldPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}

	/**
	 * Returns the number of rows matching criteria, joining the related ModuleEntityRelatedByEntityname table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinModuleEntityRelatedByEntityname(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ModuleEntityFieldPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related ModuleEntityRelatedByForeignkeytable table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinModuleEntityRelatedByForeignkeytable(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ModuleEntityFieldPeer::FOREIGNKEYTABLE, ModuleEntityPeer::NAME, $join_behavior);

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
	 * Selects a collection of ModuleEntityField objects pre-filled with their ModuleEntity objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ModuleEntityField objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinModuleEntityRelatedByEntityname(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ModuleEntityFieldPeer::addSelectColumns($criteria);
		$startcol = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;
		ModuleEntityPeer::addSelectColumns($criteria);

		$criteria->addJoin(ModuleEntityFieldPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ModuleEntityFieldPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = ModuleEntityFieldPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ModuleEntityFieldPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ModuleEntityPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ModuleEntityPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (ModuleEntityField) to $obj2 (ModuleEntity)
				$obj2->addModuleEntityFieldRelatedByEntityname($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of ModuleEntityField objects pre-filled with their ModuleEntity objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ModuleEntityField objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinModuleEntityRelatedByForeignkeytable(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ModuleEntityFieldPeer::addSelectColumns($criteria);
		$startcol = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;
		ModuleEntityPeer::addSelectColumns($criteria);

		$criteria->addJoin(ModuleEntityFieldPeer::FOREIGNKEYTABLE, ModuleEntityPeer::NAME, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ModuleEntityFieldPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = ModuleEntityFieldPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ModuleEntityFieldPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ModuleEntityPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ModuleEntityPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (ModuleEntityField) to $obj2 (ModuleEntity)
				$obj2->addModuleEntityFieldRelatedByForeignkeytable($obj1);

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
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(ModuleEntityFieldPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

		$criteria->addJoin(ModuleEntityFieldPeer::FOREIGNKEYTABLE, ModuleEntityPeer::NAME, $join_behavior);

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
	 * Selects a collection of ModuleEntityField objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ModuleEntityField objects.
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

		ModuleEntityFieldPeer::addSelectColumns($criteria);
		$startcol2 = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

		ModuleEntityPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

		ModuleEntityPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(ModuleEntityFieldPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

		$criteria->addJoin(ModuleEntityFieldPeer::FOREIGNKEYTABLE, ModuleEntityPeer::NAME, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ModuleEntityFieldPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = ModuleEntityFieldPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ModuleEntityFieldPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined ModuleEntity rows

			$key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = ModuleEntityPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ModuleEntityPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (ModuleEntityField) to the collection in $obj2 (ModuleEntity)
				$obj2->addModuleEntityFieldRelatedByEntityname($obj1);
			} // if joined row not null

			// Add objects for joined ModuleEntity rows

			$key3 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ModuleEntityPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = ModuleEntityPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ModuleEntityPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (ModuleEntityField) to the collection in $obj3 (ModuleEntity)
				$obj3->addModuleEntityFieldRelatedByForeignkeytable($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related ModuleEntityRelatedByEntityname table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptModuleEntityRelatedByEntityname(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * Returns the number of rows matching criteria, joining the related ModuleEntityRelatedByForeignkeytable table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptModuleEntityRelatedByForeignkeytable(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByForeignkeyremote table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptModuleEntityFieldRelatedByForeignkeyremote(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);
		
		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ModuleEntityFieldPeer::addSelectColumns($criteria);
		}
		
		$criteria->clearOrderByColumns(); // ORDER BY should not affect count
		
		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(ModuleEntityFieldPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

		$criteria->addJoin(ModuleEntityFieldPeer::FOREIGNKEYTABLE, ModuleEntityPeer::NAME, $join_behavior);

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
	 * Selects a collection of ModuleEntityField objects pre-filled with all related objects except ModuleEntityRelatedByEntityname.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ModuleEntityField objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptModuleEntityRelatedByEntityname(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ModuleEntityFieldPeer::addSelectColumns($criteria);
		$startcol2 = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ModuleEntityFieldPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = ModuleEntityFieldPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ModuleEntityFieldPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of ModuleEntityField objects pre-filled with all related objects except ModuleEntityRelatedByForeignkeytable.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ModuleEntityField objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptModuleEntityRelatedByForeignkeytable(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ModuleEntityFieldPeer::addSelectColumns($criteria);
		$startcol2 = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ModuleEntityFieldPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = ModuleEntityFieldPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ModuleEntityFieldPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of ModuleEntityField objects pre-filled with all related objects except ModuleEntityFieldRelatedByForeignkeyremote.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of ModuleEntityField objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptModuleEntityFieldRelatedByForeignkeyremote(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		ModuleEntityFieldPeer::addSelectColumns($criteria);
		$startcol2 = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

		ModuleEntityPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

		ModuleEntityPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(ModuleEntityFieldPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

		$criteria->addJoin(ModuleEntityFieldPeer::FOREIGNKEYTABLE, ModuleEntityPeer::NAME, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ModuleEntityFieldPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = ModuleEntityFieldPeer::getOMClass(false);

				$obj1 = new $cls();
				$obj1->hydrate($row);
				ModuleEntityFieldPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined ModuleEntity rows

				$key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = ModuleEntityPeer::getOMClass(false);

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ModuleEntityPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (ModuleEntityField) to the collection in $obj2 (ModuleEntity)
				$obj2->addModuleEntityFieldRelatedByEntityname($obj1);

			} // if joined row is not null

				// Add objects for joined ModuleEntity rows

				$key3 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ModuleEntityPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = ModuleEntityPeer::getOMClass(false);

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ModuleEntityPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (ModuleEntityField) to the collection in $obj3 (ModuleEntity)
				$obj3->addModuleEntityFieldRelatedByForeignkeytable($obj1);

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
	  $dbMap = Propel::getDatabaseMap(BaseModuleEntityFieldPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseModuleEntityFieldPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new ModuleEntityFieldTableMap());
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
		return $withPrefix ? ModuleEntityFieldPeer::CLASS_DEFAULT : ModuleEntityFieldPeer::OM_CLASS;
	}

	/**
	 * Method perform an INSERT on the database, given a ModuleEntityField or Criteria object.
	 *
	 * @param      mixed $values Criteria or ModuleEntityField object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from ModuleEntityField object
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
	 * Method perform an UPDATE on the database, given a ModuleEntityField or Criteria object.
	 *
	 * @param      mixed $values Criteria or ModuleEntityField object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ModuleEntityFieldPeer::UNIQUENAME);
			$value = $criteria->remove(ModuleEntityFieldPeer::UNIQUENAME);
			if ($value) {
				$selectCriteria->add(ModuleEntityFieldPeer::UNIQUENAME, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(ModuleEntityFieldPeer::TABLE_NAME);
			}

		} else { // $values is ModuleEntityField object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the modules_entityField table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += ModuleEntityFieldPeer::doOnDeleteCascade(new Criteria(ModuleEntityFieldPeer::DATABASE_NAME), $con);
			ModuleEntityFieldPeer::doOnDeleteSetNull(new Criteria(ModuleEntityFieldPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(ModuleEntityFieldPeer::TABLE_NAME, $con, ModuleEntityFieldPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			ModuleEntityFieldPeer::clearInstancePool();
			ModuleEntityFieldPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a ModuleEntityField or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or ModuleEntityField object or primary key or array of primary keys
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
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof ModuleEntityField) { // it's a model object
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ModuleEntityFieldPeer::UNIQUENAME, (array) $values, Criteria::IN);
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
			$affectedRows += ModuleEntityFieldPeer::doOnDeleteCascade($c, $con);
			
			// cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
			$c = clone $criteria;
			ModuleEntityFieldPeer::doOnDeleteSetNull($c, $con);
			
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			if ($values instanceof Criteria) {
				ModuleEntityFieldPeer::clearInstancePool();
			} elseif ($values instanceof ModuleEntityField) { // it's a model object
				ModuleEntityFieldPeer::removeInstanceFromPool($values);
			} else { // it's a primary key, or an array of pks
				foreach ((array) $values as $singleval) {
					ModuleEntityFieldPeer::removeInstanceFromPool($singleval);
				}
			}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			ModuleEntityFieldPeer::clearRelatedInstancePool();
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
		$objects = ModuleEntityFieldPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related ModuleEntityFieldValidation objects
			$criteria = new Criteria(ModuleEntityFieldValidationPeer::DATABASE_NAME);
			
			$criteria->add(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME, $obj->getUniquename());
			$affectedRows += ModuleEntityFieldValidationPeer::doDelete($criteria, $con);
		}
		return $affectedRows;
	}

	/**
	 * This is a method for emulating ON DELETE SET NULL DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     void
	 */
	protected static function doOnDeleteSetNull(Criteria $criteria, PropelPDO $con)
	{

		// first find the objects that are implicated by the $criteria
		$objects = ModuleEntityFieldPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {

			// set fkey col in related ModuleEntityField rows to NULL
			$selectCriteria = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);
			$updateValues = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);
			$selectCriteria->add(ModuleEntityFieldPeer::FOREIGNKEYREMOTE, $obj->getUniquename());
			$updateValues->add(ModuleEntityFieldPeer::FOREIGNKEYREMOTE, null);

			BasePeer::doUpdate($selectCriteria, $updateValues, $con); // use BasePeer because generated Peer doUpdate() methods only update using pkey

		}
	}

	/**
	 * Validates all modified columns of given ModuleEntityField object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      ModuleEntityField $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ModuleEntityFieldPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ModuleEntityFieldPeer::TABLE_NAME);

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

		return BasePeer::doValidate(ModuleEntityFieldPeer::DATABASE_NAME, ModuleEntityFieldPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     ModuleEntityField
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ModuleEntityFieldPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);
		$criteria->add(ModuleEntityFieldPeer::UNIQUENAME, $pk);

		$v = ModuleEntityFieldPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);
			$criteria->add(ModuleEntityFieldPeer::UNIQUENAME, $pks, Criteria::IN);
			$objs = ModuleEntityFieldPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseModuleEntityFieldPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseModuleEntityFieldPeer::buildTableMap();

