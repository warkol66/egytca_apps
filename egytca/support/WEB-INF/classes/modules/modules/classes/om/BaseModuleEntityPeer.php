<?php


/**
 * Base static class for performing query and update operations on the 'modules_entity' table.
 *
 * Entidades de modulos
 *
 * @package propel.generator.modules.classes.om
 */
abstract class BaseModuleEntityPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'modules_entity';

    /** the related Propel class for this table */
    const OM_CLASS = 'ModuleEntity';

    /** the related TableMap class for this table */
    const TM_CLASS = 'ModuleEntityTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 10;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 10;

    /** the column name for the MODULENAME field */
    const MODULENAME = 'modules_entity.MODULENAME';

    /** the column name for the NAME field */
    const NAME = 'modules_entity.NAME';

    /** the column name for the PHPNAME field */
    const PHPNAME = 'modules_entity.PHPNAME';

    /** the column name for the DESCRIPTION field */
    const DESCRIPTION = 'modules_entity.DESCRIPTION';

    /** the column name for the SOFTDELETE field */
    const SOFTDELETE = 'modules_entity.SOFTDELETE';

    /** the column name for the RELATION field */
    const RELATION = 'modules_entity.RELATION';

    /** the column name for the SAVELOG field */
    const SAVELOG = 'modules_entity.SAVELOG';

    /** the column name for the NESTEDSET field */
    const NESTEDSET = 'modules_entity.NESTEDSET';

    /** the column name for the SCOPEFIELDUNIQUENAME field */
    const SCOPEFIELDUNIQUENAME = 'modules_entity.SCOPEFIELDUNIQUENAME';

    /** the column name for the BEHAVIORS field */
    const BEHAVIORS = 'modules_entity.BEHAVIORS';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of ModuleEntity objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array ModuleEntity[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. ModuleEntityPeer::$fieldNames[ModuleEntityPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Modulename', 'Name', 'Phpname', 'Description', 'Softdelete', 'Relation', 'Savelog', 'Nestedset', 'Scopefielduniquename', 'Behaviors', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('modulename', 'name', 'phpname', 'description', 'softdelete', 'relation', 'savelog', 'nestedset', 'scopefielduniquename', 'behaviors', ),
        BasePeer::TYPE_COLNAME => array (ModuleEntityPeer::MODULENAME, ModuleEntityPeer::NAME, ModuleEntityPeer::PHPNAME, ModuleEntityPeer::DESCRIPTION, ModuleEntityPeer::SOFTDELETE, ModuleEntityPeer::RELATION, ModuleEntityPeer::SAVELOG, ModuleEntityPeer::NESTEDSET, ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityPeer::BEHAVIORS, ),
        BasePeer::TYPE_RAW_COLNAME => array ('MODULENAME', 'NAME', 'PHPNAME', 'DESCRIPTION', 'SOFTDELETE', 'RELATION', 'SAVELOG', 'NESTEDSET', 'SCOPEFIELDUNIQUENAME', 'BEHAVIORS', ),
        BasePeer::TYPE_FIELDNAME => array ('moduleName', 'name', 'phpName', 'description', 'softDelete', 'relation', 'saveLog', 'nestedset', 'scopeFieldUniqueName', 'behaviors', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. ModuleEntityPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Modulename' => 0, 'Name' => 1, 'Phpname' => 2, 'Description' => 3, 'Softdelete' => 4, 'Relation' => 5, 'Savelog' => 6, 'Nestedset' => 7, 'Scopefielduniquename' => 8, 'Behaviors' => 9, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('modulename' => 0, 'name' => 1, 'phpname' => 2, 'description' => 3, 'softdelete' => 4, 'relation' => 5, 'savelog' => 6, 'nestedset' => 7, 'scopefielduniquename' => 8, 'behaviors' => 9, ),
        BasePeer::TYPE_COLNAME => array (ModuleEntityPeer::MODULENAME => 0, ModuleEntityPeer::NAME => 1, ModuleEntityPeer::PHPNAME => 2, ModuleEntityPeer::DESCRIPTION => 3, ModuleEntityPeer::SOFTDELETE => 4, ModuleEntityPeer::RELATION => 5, ModuleEntityPeer::SAVELOG => 6, ModuleEntityPeer::NESTEDSET => 7, ModuleEntityPeer::SCOPEFIELDUNIQUENAME => 8, ModuleEntityPeer::BEHAVIORS => 9, ),
        BasePeer::TYPE_RAW_COLNAME => array ('MODULENAME' => 0, 'NAME' => 1, 'PHPNAME' => 2, 'DESCRIPTION' => 3, 'SOFTDELETE' => 4, 'RELATION' => 5, 'SAVELOG' => 6, 'NESTEDSET' => 7, 'SCOPEFIELDUNIQUENAME' => 8, 'BEHAVIORS' => 9, ),
        BasePeer::TYPE_FIELDNAME => array ('moduleName' => 0, 'name' => 1, 'phpName' => 2, 'description' => 3, 'softDelete' => 4, 'relation' => 5, 'saveLog' => 6, 'nestedset' => 7, 'scopeFieldUniqueName' => 8, 'behaviors' => 9, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $toNames = ModuleEntityPeer::getFieldNames($toType);
        $key = isset(ModuleEntityPeer::$fieldKeys[$fromType][$name]) ? ModuleEntityPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(ModuleEntityPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, ModuleEntityPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return ModuleEntityPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. ModuleEntityPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(ModuleEntityPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(ModuleEntityPeer::MODULENAME);
            $criteria->addSelectColumn(ModuleEntityPeer::NAME);
            $criteria->addSelectColumn(ModuleEntityPeer::PHPNAME);
            $criteria->addSelectColumn(ModuleEntityPeer::DESCRIPTION);
            $criteria->addSelectColumn(ModuleEntityPeer::SOFTDELETE);
            $criteria->addSelectColumn(ModuleEntityPeer::RELATION);
            $criteria->addSelectColumn(ModuleEntityPeer::SAVELOG);
            $criteria->addSelectColumn(ModuleEntityPeer::NESTEDSET);
            $criteria->addSelectColumn(ModuleEntityPeer::SCOPEFIELDUNIQUENAME);
            $criteria->addSelectColumn(ModuleEntityPeer::BEHAVIORS);
        } else {
            $criteria->addSelectColumn($alias . '.MODULENAME');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.PHPNAME');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.SOFTDELETE');
            $criteria->addSelectColumn($alias . '.RELATION');
            $criteria->addSelectColumn($alias . '.SAVELOG');
            $criteria->addSelectColumn($alias . '.NESTEDSET');
            $criteria->addSelectColumn($alias . '.SCOPEFIELDUNIQUENAME');
            $criteria->addSelectColumn($alias . '.BEHAVIORS');
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
        $criteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 ModuleEntity
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = ModuleEntityPeer::doSelect($critcopy, $con);
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
        return ModuleEntityPeer::populateObjects(ModuleEntityPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

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
     * @param      ModuleEntity $obj A ModuleEntity object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getName();
            } // if key === null
            ModuleEntityPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A ModuleEntity object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof ModuleEntity) {
                $key = (string) $value->getName();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ModuleEntity object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(ModuleEntityPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   ModuleEntity Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(ModuleEntityPeer::$instances[$key])) {
                return ModuleEntityPeer::$instances[$key];
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
        ModuleEntityPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to modules_entity
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ModuleEntityFieldPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ModuleEntityFieldPeer::clearInstancePool();
        // Invalidate objects in ModuleEntityFieldPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ModuleEntityFieldPeer::clearInstancePool();
        // Invalidate objects in AlertSubscriptionPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AlertSubscriptionPeer::clearInstancePool();
        // Invalidate objects in ScheduleSubscriptionPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ScheduleSubscriptionPeer::clearInstancePool();
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
        if ($row[$startcol + 1] === null) {
            return null;
        }

        return (string) $row[$startcol + 1];
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

        return (string) $row[$startcol + 1];
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
        $cls = ModuleEntityPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = ModuleEntityPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ModuleEntityPeer::addInstanceToPool($obj, $key);
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
     * @return array (ModuleEntity object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = ModuleEntityPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + ModuleEntityPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ModuleEntityPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            ModuleEntityPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Module table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinModule(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ModuleEntityPeer::MODULENAME, ModulePeer::NAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByScopefielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinModuleEntityFieldRelatedByScopefielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Selects a collection of ModuleEntity objects pre-filled with their Module objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ModuleEntity objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinModule(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);
        }

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol = ModuleEntityPeer::NUM_HYDRATE_COLUMNS;
        ModulePeer::addSelectColumns($criteria);

        $criteria->addJoin(ModuleEntityPeer::MODULENAME, ModulePeer::NAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ModuleEntityPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ModuleEntityPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ModuleEntityPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ModulePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModulePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ModulePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (ModuleEntity) to $obj2 (Module)
                $obj2->addModuleEntity($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ModuleEntity objects pre-filled with their ModuleEntityField objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ModuleEntity objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinModuleEntityFieldRelatedByScopefielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);
        }

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol = ModuleEntityPeer::NUM_HYDRATE_COLUMNS;
        ModuleEntityFieldPeer::addSelectColumns($criteria);

        $criteria->addJoin(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ModuleEntityPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ModuleEntityPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ModuleEntityPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (ModuleEntity) to $obj2 (ModuleEntityField)
                $obj2->addModuleEntityRelatedByScopefielduniquename($obj1);

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
        $criteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ModuleEntityPeer::MODULENAME, ModulePeer::NAME, $join_behavior);

        $criteria->addJoin(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Selects a collection of ModuleEntity objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ModuleEntity objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);
        }

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol2 = ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        ModulePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModulePeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ModuleEntityPeer::MODULENAME, ModulePeer::NAME, $join_behavior);

        $criteria->addJoin(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ModuleEntityPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ModuleEntityPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ModuleEntityPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Module rows

            $key2 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = ModulePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ModulePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModulePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (ModuleEntity) to the collection in $obj2 (Module)
                $obj2->addModuleEntity($obj1);
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

                // Add the $obj1 (ModuleEntity) to the collection in $obj3 (ModuleEntityField)
                $obj3->addModuleEntityRelatedByScopefielduniquename($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Module table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptModule(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ModuleEntityFieldRelatedByScopefielduniquename table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptModuleEntityFieldRelatedByScopefielduniquename(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ModuleEntityPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ModuleEntityPeer::MODULENAME, ModulePeer::NAME, $join_behavior);

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
     * Selects a collection of ModuleEntity objects pre-filled with all related objects except Module.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ModuleEntity objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptModule(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);
        }

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol2 = ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        ModuleEntityFieldPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, ModuleEntityFieldPeer::UNIQUENAME, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ModuleEntityPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ModuleEntityPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ModuleEntityPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (ModuleEntity) to the collection in $obj2 (ModuleEntityField)
                $obj2->addModuleEntityRelatedByScopefielduniquename($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of ModuleEntity objects pre-filled with all related objects except ModuleEntityFieldRelatedByScopefielduniquename.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of ModuleEntity objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptModuleEntityFieldRelatedByScopefielduniquename(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);
        }

        ModuleEntityPeer::addSelectColumns($criteria);
        $startcol2 = ModuleEntityPeer::NUM_HYDRATE_COLUMNS;

        ModulePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ModulePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ModuleEntityPeer::MODULENAME, ModulePeer::NAME, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ModuleEntityPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ModuleEntityPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ModuleEntityPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ModuleEntityPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Module rows

                $key2 = ModulePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ModulePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ModulePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ModulePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (ModuleEntity) to the collection in $obj2 (Module)
                $obj2->addModuleEntity($obj1);

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
        return Propel::getDatabaseMap(ModuleEntityPeer::DATABASE_NAME)->getTable(ModuleEntityPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseModuleEntityPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseModuleEntityPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new ModuleEntityTableMap());
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
        return ModuleEntityPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a ModuleEntity or Criteria object.
     *
     * @param      mixed $values Criteria or ModuleEntity object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from ModuleEntity object
        }


        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a ModuleEntity or Criteria object.
     *
     * @param      mixed $values Criteria or ModuleEntity object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(ModuleEntityPeer::NAME);
            $value = $criteria->remove(ModuleEntityPeer::NAME);
            if ($value) {
                $selectCriteria->add(ModuleEntityPeer::NAME, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(ModuleEntityPeer::TABLE_NAME);
            }

        } else { // $values is ModuleEntity object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the modules_entity table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += ModuleEntityPeer::doOnDeleteCascade(new Criteria(ModuleEntityPeer::DATABASE_NAME), $con);
            ModuleEntityPeer::doOnDeleteSetNull(new Criteria(ModuleEntityPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(ModuleEntityPeer::TABLE_NAME, $con, ModuleEntityPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ModuleEntityPeer::clearInstancePool();
            ModuleEntityPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a ModuleEntity or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or ModuleEntity object or primary key or array of primary keys
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
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof ModuleEntity) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);
            $criteria->add(ModuleEntityPeer::NAME, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(ModuleEntityPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += ModuleEntityPeer::doOnDeleteCascade($c, $con);

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            ModuleEntityPeer::doOnDeleteSetNull($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                ModuleEntityPeer::clearInstancePool();
            } elseif ($values instanceof ModuleEntity) { // it's a model object
                ModuleEntityPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    ModuleEntityPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            ModuleEntityPeer::clearRelatedInstancePool();
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
        $objects = ModuleEntityPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related ModuleEntityField objects
            $criteria = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);

            $criteria->add(ModuleEntityFieldPeer::ENTITYNAME, $obj->getName());
            $affectedRows += ModuleEntityFieldPeer::doDelete($criteria, $con);

            // delete related AlertSubscription objects
            $criteria = new Criteria(AlertSubscriptionPeer::DATABASE_NAME);

            $criteria->add(AlertSubscriptionPeer::ENTITYNAME, $obj->getName());
            $affectedRows += AlertSubscriptionPeer::doDelete($criteria, $con);

            // delete related ScheduleSubscription objects
            $criteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);

            $criteria->add(ScheduleSubscriptionPeer::ENTITYNAME, $obj->getName());
            $affectedRows += ScheduleSubscriptionPeer::doDelete($criteria, $con);
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
     * @return void
     */
    protected static function doOnDeleteSetNull(Criteria $criteria, PropelPDO $con)
    {

        // first find the objects that are implicated by the $criteria
        $objects = ModuleEntityPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {

            // set fkey col in related ModuleEntityField rows to null
            $selectCriteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);
            $updateValues = new Criteria(ModuleEntityPeer::DATABASE_NAME);
            $selectCriteria->add(ModuleEntityFieldPeer::FOREIGNKEYTABLE, $obj->getName());
            $updateValues->add(ModuleEntityFieldPeer::FOREIGNKEYTABLE, null);

            BasePeer::doUpdate($selectCriteria, $updateValues, $con); // use BasePeer because generated Peer doUpdate() methods only update using pkey

        }
    }

    /**
     * Validates all modified columns of given ModuleEntity object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      ModuleEntity $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(ModuleEntityPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(ModuleEntityPeer::TABLE_NAME);

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

        return BasePeer::doValidate(ModuleEntityPeer::DATABASE_NAME, ModuleEntityPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      string $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return ModuleEntity
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = ModuleEntityPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);
        $criteria->add(ModuleEntityPeer::NAME, $pk);

        $v = ModuleEntityPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return ModuleEntity[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);
            $criteria->add(ModuleEntityPeer::NAME, $pks, Criteria::IN);
            $objs = ModuleEntityPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseModuleEntityPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseModuleEntityPeer::buildTableMap();

