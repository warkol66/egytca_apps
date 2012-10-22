<?php


/**
 * Base static class for performing query and update operations on the 'services_scheduleSubscription' table.
 *
 * Suscripciones de schedulea
 *
 * @package propel.generator.services.classes.om
 */
abstract class BaseScheduleSubscriptionPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'services_scheduleSubscription';

    /** the related Propel class for this table */
    const OM_CLASS = 'ScheduleSubscription';

    /** the related TableMap class for this table */
    const TM_CLASS = 'ScheduleSubscriptionTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 8;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 8;

    /** the column name for the ID field */
    const ID = 'services_scheduleSubscription.ID';

    /** the column name for the NAME field */
    const NAME = 'services_scheduleSubscription.NAME';

    /** the column name for the ENTITYNAME field */
    const ENTITYNAME = 'services_scheduleSubscription.ENTITYNAME';

    /** the column name for the ENTITYDATEFIELDUNIQUENAME field */
    const ENTITYDATEFIELDUNIQUENAME = 'services_scheduleSubscription.ENTITYDATEFIELDUNIQUENAME';

    /** the column name for the ENTITYBOOLEANFIELDUNIQUENAME field */
    const ENTITYBOOLEANFIELDUNIQUENAME = 'services_scheduleSubscription.ENTITYBOOLEANFIELDUNIQUENAME';

    /** the column name for the ANTICIPATIONDAYS field */
    const ANTICIPATIONDAYS = 'services_scheduleSubscription.ANTICIPATIONDAYS';

    /** the column name for the ENTITYNAMEFIELDUNIQUENAME field */
    const ENTITYNAMEFIELDUNIQUENAME = 'services_scheduleSubscription.ENTITYNAMEFIELDUNIQUENAME';

    /** the column name for the EXTRARECIPIENTS field */
    const EXTRARECIPIENTS = 'services_scheduleSubscription.EXTRARECIPIENTS';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of ScheduleSubscription objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array ScheduleSubscription[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. ScheduleSubscriptionPeer::$fieldNames[ScheduleSubscriptionPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Entityname', 'Entitydatefielduniquename', 'Entitybooleanfielduniquename', 'Anticipationdays', 'Entitynamefielduniquename', 'Extrarecipients', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'entityname', 'entitydatefielduniquename', 'entitybooleanfielduniquename', 'anticipationdays', 'entitynamefielduniquename', 'extrarecipients', ),
        BasePeer::TYPE_COLNAME => array (ScheduleSubscriptionPeer::ID, ScheduleSubscriptionPeer::NAME, ScheduleSubscriptionPeer::ENTITYNAME, ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ScheduleSubscriptionPeer::ANTICIPATIONDAYS, ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ScheduleSubscriptionPeer::EXTRARECIPIENTS, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NAME', 'ENTITYNAME', 'ENTITYDATEFIELDUNIQUENAME', 'ENTITYBOOLEANFIELDUNIQUENAME', 'ANTICIPATIONDAYS', 'ENTITYNAMEFIELDUNIQUENAME', 'EXTRARECIPIENTS', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'entityName', 'entityDateFieldUniqueName', 'entityBooleanFieldUniqueName', 'anticipationDays', 'entityNameFieldUniqueName', 'extraRecipients', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. ScheduleSubscriptionPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Entityname' => 2, 'Entitydatefielduniquename' => 3, 'Entitybooleanfielduniquename' => 4, 'Anticipationdays' => 5, 'Entitynamefielduniquename' => 6, 'Extrarecipients' => 7, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'entityname' => 2, 'entitydatefielduniquename' => 3, 'entitybooleanfielduniquename' => 4, 'anticipationdays' => 5, 'entitynamefielduniquename' => 6, 'extrarecipients' => 7, ),
        BasePeer::TYPE_COLNAME => array (ScheduleSubscriptionPeer::ID => 0, ScheduleSubscriptionPeer::NAME => 1, ScheduleSubscriptionPeer::ENTITYNAME => 2, ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME => 3, ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME => 4, ScheduleSubscriptionPeer::ANTICIPATIONDAYS => 5, ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME => 6, ScheduleSubscriptionPeer::EXTRARECIPIENTS => 7, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NAME' => 1, 'ENTITYNAME' => 2, 'ENTITYDATEFIELDUNIQUENAME' => 3, 'ENTITYBOOLEANFIELDUNIQUENAME' => 4, 'ANTICIPATIONDAYS' => 5, 'ENTITYNAMEFIELDUNIQUENAME' => 6, 'EXTRARECIPIENTS' => 7, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'entityName' => 2, 'entityDateFieldUniqueName' => 3, 'entityBooleanFieldUniqueName' => 4, 'anticipationDays' => 5, 'entityNameFieldUniqueName' => 6, 'extraRecipients' => 7, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = ScheduleSubscriptionPeer::getFieldNames($toType);
        $key = isset(ScheduleSubscriptionPeer::$fieldKeys[$fromType][$name]) ? ScheduleSubscriptionPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(ScheduleSubscriptionPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, ScheduleSubscriptionPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return ScheduleSubscriptionPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. ScheduleSubscriptionPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(ScheduleSubscriptionPeer::TABLE_NAME.'.', $alias.'.', $column);
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
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::ID);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::NAME);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::ENTITYNAME);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::ANTICIPATIONDAYS);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME);
            $criteria->addSelectColumn(ScheduleSubscriptionPeer::EXTRARECIPIENTS);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.ENTITYNAME');
            $criteria->addSelectColumn($alias . '.ENTITYDATEFIELDUNIQUENAME');
            $criteria->addSelectColumn($alias . '.ENTITYBOOLEANFIELDUNIQUENAME');
            $criteria->addSelectColumn($alias . '.ANTICIPATIONDAYS');
            $criteria->addSelectColumn($alias . '.ENTITYNAMEFIELDUNIQUENAME');
            $criteria->addSelectColumn($alias . '.EXTRARECIPIENTS');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 ScheduleSubscription
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = ScheduleSubscriptionPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return ScheduleSubscriptionPeer::populateObjects(ScheduleSubscriptionPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement durirectly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

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
     * @param      ScheduleSubscription $obj A ScheduleSubscription object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            ScheduleSubscriptionPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A ScheduleSubscription object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof ScheduleSubscription) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ScheduleSubscription object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(ScheduleSubscriptionPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   ScheduleSubscription Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(ScheduleSubscriptionPeer::$instances[$key])) {
                return ScheduleSubscriptionPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool()
    {
        ScheduleSubscriptionPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to services_scheduleSubscription
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ScheduleSubscriptionUserPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ScheduleSubscriptionUserPeer::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
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
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = ScheduleSubscriptionPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = ScheduleSubscriptionPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ScheduleSubscriptionPeer::addInstanceToPool($obj, $key);
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
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (ScheduleSubscription object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = ScheduleSubscriptionPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ScheduleSubscriptionPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            ScheduleSubscriptionPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related ModuleEntity table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinModuleEntity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByEntitynamefielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinModuleEntityFieldRelatedByEntitynamefielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByEntitydatefielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinModuleEntityFieldRelatedByEntitydatefielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByEntitybooleanfielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Selects a collection of ScheduleSubscription objects pre-filled with their ModuleEntity objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinModuleEntity(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;
        ModuleEntityPeer::addSelectColumns($criteria);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModuleEntityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ModuleEntityPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to $obj2 (ModuleEntity)
                $obj2->addScheduleSubscription($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ScheduleSubscription objects pre-filled with their ModuleEntityField objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinModuleEntityFieldRelatedByEntitynamefielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;
        ModuleEntityFieldPeer::addSelectColumns($criteria);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ModuleEntityFieldPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ModuleEntityFieldPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to $obj2 (ModuleEntityField)
                $obj2->addScheduleSubscriptionRelatedByEntitynamefielduniquename($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ScheduleSubscription objects pre-filled with their ModuleEntityField objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinModuleEntityFieldRelatedByEntitydatefielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;
        ModuleEntityFieldPeer::addSelectColumns($criteria);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ModuleEntityFieldPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ModuleEntityFieldPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to $obj2 (ModuleEntityField)
                $obj2->addScheduleSubscriptionRelatedByEntitydatefielduniquename($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ScheduleSubscription objects pre-filled with their ModuleEntityField objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;
        ModuleEntityFieldPeer::addSelectColumns($criteria);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ModuleEntityFieldPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ModuleEntityFieldPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to $obj2 (ModuleEntityField)
                $obj2->addScheduleSubscriptionRelatedByEntitybooleanfielduniquename($obj1);

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
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Selects a collection of ScheduleSubscription objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol2 = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined ModuleEntity rows

            $key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModuleEntityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModuleEntityPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj2 (ModuleEntity)
                $obj2->addScheduleSubscription($obj1);
            } // if joined row not null

            // Add objects for joined ModuleEntityField rows

            $key3 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = ModuleEntityFieldPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ModuleEntityFieldPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj3 (ModuleEntityField)
                $obj3->addScheduleSubscriptionRelatedByEntitynamefielduniquename($obj1);
            } // if joined row not null

            // Add objects for joined ModuleEntityField rows

            $key4 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = ModuleEntityFieldPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ModuleEntityFieldPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj4 (ModuleEntityField)
                $obj4->addScheduleSubscriptionRelatedByEntitydatefielduniquename($obj1);
            } // if joined row not null

            // Add objects for joined ModuleEntityField rows

            $key5 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = ModuleEntityFieldPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    ModuleEntityFieldPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj5 (ModuleEntityField)
                $obj5->addScheduleSubscriptionRelatedByEntitybooleanfielduniquename($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related ModuleEntity table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptModuleEntity(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByEntitynamefielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptModuleEntityFieldRelatedByEntitynamefielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByEntitydatefielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptModuleEntityFieldRelatedByEntitydatefielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByEntitybooleanfielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptModuleEntityFieldRelatedByEntitybooleanfielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ScheduleSubscriptionPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);

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
     * Selects a collection of ScheduleSubscription objects pre-filled with all related objects except ModuleEntity.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptModuleEntity(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol2 = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined ModuleEntityField rows

                $key2 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ModuleEntityFieldPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModuleEntityFieldPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj2 (ModuleEntityField)
                $obj2->addScheduleSubscriptionRelatedByEntitynamefielduniquename($obj1);

            } // if joined row is not null

                // Add objects for joined ModuleEntityField rows

                $key3 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = ModuleEntityFieldPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ModuleEntityFieldPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj3 (ModuleEntityField)
                $obj3->addScheduleSubscriptionRelatedByEntitydatefielduniquename($obj1);

            } // if joined row is not null

                // Add objects for joined ModuleEntityField rows

                $key4 = ModuleEntityFieldPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ModuleEntityFieldPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ModuleEntityFieldPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ModuleEntityFieldPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj4 (ModuleEntityField)
                $obj4->addScheduleSubscriptionRelatedByEntitybooleanfielduniquename($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ScheduleSubscription objects pre-filled with all related objects except ModuleEntityFieldRelatedByEntitynamefielduniquename.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptModuleEntityFieldRelatedByEntitynamefielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol2 = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined ModuleEntity rows

                $key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ModuleEntityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModuleEntityPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj2 (ModuleEntity)
                $obj2->addScheduleSubscription($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ScheduleSubscription objects pre-filled with all related objects except ModuleEntityFieldRelatedByEntitydatefielduniquename.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptModuleEntityFieldRelatedByEntitydatefielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol2 = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined ModuleEntity rows

                $key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ModuleEntityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModuleEntityPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj2 (ModuleEntity)
                $obj2->addScheduleSubscription($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ScheduleSubscription objects pre-filled with all related objects except ModuleEntityFieldRelatedByEntitybooleanfielduniquename.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ScheduleSubscription objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptModuleEntityFieldRelatedByEntitybooleanfielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);
        }

        ScheduleSubscriptionPeer::addSelectColumns($criteria);
        $startcol2 = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ScheduleSubscriptionPeer::ENTITYNAME, ModuleEntityPeer::NAME, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ScheduleSubscriptionPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ScheduleSubscriptionPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ScheduleSubscriptionPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ScheduleSubscriptionPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined ModuleEntity rows

                $key2 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ModuleEntityPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ModuleEntityPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModuleEntityPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ScheduleSubscription) to the collection in $obj2 (ModuleEntity)
                $obj2->addScheduleSubscription($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(ScheduleSubscriptionPeer::DATABASE_NAME)->getTable(ScheduleSubscriptionPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseScheduleSubscriptionPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseScheduleSubscriptionPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new ScheduleSubscriptionTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return ScheduleSubscriptionPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a ScheduleSubscription or Criteria object.
     *
     * @param      mixed $values Criteria or ScheduleSubscription object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from ScheduleSubscription object
        }

        if ($criteria->containsKey(ScheduleSubscriptionPeer::ID) && $criteria->keyContainsValue(ScheduleSubscriptionPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ScheduleSubscriptionPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a ScheduleSubscription or Criteria object.
     *
     * @param      mixed $values Criteria or ScheduleSubscription object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(ScheduleSubscriptionPeer::ID);
            $value = $criteria->remove(ScheduleSubscriptionPeer::ID);
            if ($value) {
                $selectCriteria->add(ScheduleSubscriptionPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(ScheduleSubscriptionPeer::TABLE_NAME);
            }

        } else { // $values is ScheduleSubscription object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the services_scheduleSubscription table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += ScheduleSubscriptionPeer::doOnDeleteCascade(new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(ScheduleSubscriptionPeer::TABLE_NAME, $con, ScheduleSubscriptionPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ScheduleSubscriptionPeer::clearInstancePool();
            ScheduleSubscriptionPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a ScheduleSubscription or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or ScheduleSubscription object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof ScheduleSubscription) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);
            $criteria->add(ScheduleSubscriptionPeer::ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(ScheduleSubscriptionPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += ScheduleSubscriptionPeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                ScheduleSubscriptionPeer::clearInstancePool();
            } elseif ($values instanceof ScheduleSubscription) { // it's a model object
                ScheduleSubscriptionPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    ScheduleSubscriptionPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            ScheduleSubscriptionPeer::clearRelatedInstancePool();
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
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
    {
        // initialize var to track total num of affected rows
        $affectedRows = 0;

        // first find the objects that are implicated by the $criteria
        $objects = ScheduleSubscriptionPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related ScheduleSubscriptionUser objects
            $criteria = new Criteria(ScheduleSubscriptionUserPeer::DATABASE_NAME);

            $criteria->add(ScheduleSubscriptionUserPeer::SCHEDULESUBSCRIPTIONID, $obj->getId());
            $affectedRows += ScheduleSubscriptionUserPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given ScheduleSubscription object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      ScheduleSubscription $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(ScheduleSubscriptionPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(ScheduleSubscriptionPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(ScheduleSubscriptionPeer::DATABASE_NAME, ScheduleSubscriptionPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return ScheduleSubscription
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = ScheduleSubscriptionPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);
        $criteria->add(ScheduleSubscriptionPeer::ID, $pk);

        $v = ScheduleSubscriptionPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return ScheduleSubscription[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);
            $criteria->add(ScheduleSubscriptionPeer::ID, $pks, Criteria::IN);
            $objs = ScheduleSubscriptionPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseScheduleSubscriptionPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseScheduleSubscriptionPeer::buildTableMap();

