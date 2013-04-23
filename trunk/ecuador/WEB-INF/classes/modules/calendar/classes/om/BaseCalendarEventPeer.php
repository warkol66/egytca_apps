<?php


/**
 * Base static class for performing query and update operations on the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * @package propel.generator.calendar.classes.om
 */
abstract class BaseCalendarEventPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'calendar_event';

    /** the related Propel class for this table */
    const OM_CLASS = 'CalendarEvent';

    /** the related TableMap class for this table */
    const TM_CLASS = 'CalendarEventTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 13;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 13;

    /** the column name for the ID field */
    const ID = 'calendar_event.ID';

    /** the column name for the TITLE field */
    const TITLE = 'calendar_event.TITLE';

    /** the column name for the SUMMARY field */
    const SUMMARY = 'calendar_event.SUMMARY';

    /** the column name for the BODY field */
    const BODY = 'calendar_event.BODY';

    /** the column name for the CREATIONDATE field */
    const CREATIONDATE = 'calendar_event.CREATIONDATE';

    /** the column name for the STARTDATE field */
    const STARTDATE = 'calendar_event.STARTDATE';

    /** the column name for the ENDDATE field */
    const ENDDATE = 'calendar_event.ENDDATE';

    /** the column name for the SOURCECONTACT field */
    const SOURCECONTACT = 'calendar_event.SOURCECONTACT';

    /** the column name for the STATUS field */
    const STATUS = 'calendar_event.STATUS';

    /** the column name for the REGIONID field */
    const REGIONID = 'calendar_event.REGIONID';

    /** the column name for the CATEGORYID field */
    const CATEGORYID = 'calendar_event.CATEGORYID';

    /** the column name for the USERID field */
    const USERID = 'calendar_event.USERID';

    /** the column name for the DELETED_AT field */
    const DELETED_AT = 'calendar_event.DELETED_AT';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of CalendarEvent objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array CalendarEvent[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. CalendarEventPeer::$fieldNames[CalendarEventPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Summary', 'Body', 'Creationdate', 'Startdate', 'Enddate', 'Sourcecontact', 'Status', 'Regionid', 'Categoryid', 'Userid', 'DeletedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'summary', 'body', 'creationdate', 'startdate', 'enddate', 'sourcecontact', 'status', 'regionid', 'categoryid', 'userid', 'deletedAt', ),
        BasePeer::TYPE_COLNAME => array (CalendarEventPeer::ID, CalendarEventPeer::TITLE, CalendarEventPeer::SUMMARY, CalendarEventPeer::BODY, CalendarEventPeer::CREATIONDATE, CalendarEventPeer::STARTDATE, CalendarEventPeer::ENDDATE, CalendarEventPeer::SOURCECONTACT, CalendarEventPeer::STATUS, CalendarEventPeer::REGIONID, CalendarEventPeer::CATEGORYID, CalendarEventPeer::USERID, CalendarEventPeer::DELETED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TITLE', 'SUMMARY', 'BODY', 'CREATIONDATE', 'STARTDATE', 'ENDDATE', 'SOURCECONTACT', 'STATUS', 'REGIONID', 'CATEGORYID', 'USERID', 'DELETED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'summary', 'body', 'creationDate', 'startDate', 'endDate', 'sourceContact', 'status', 'regionId', 'categoryId', 'userId', 'deleted_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. CalendarEventPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Summary' => 2, 'Body' => 3, 'Creationdate' => 4, 'Startdate' => 5, 'Enddate' => 6, 'Sourcecontact' => 7, 'Status' => 8, 'Regionid' => 9, 'Categoryid' => 10, 'Userid' => 11, 'DeletedAt' => 12, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'summary' => 2, 'body' => 3, 'creationdate' => 4, 'startdate' => 5, 'enddate' => 6, 'sourcecontact' => 7, 'status' => 8, 'regionid' => 9, 'categoryid' => 10, 'userid' => 11, 'deletedAt' => 12, ),
        BasePeer::TYPE_COLNAME => array (CalendarEventPeer::ID => 0, CalendarEventPeer::TITLE => 1, CalendarEventPeer::SUMMARY => 2, CalendarEventPeer::BODY => 3, CalendarEventPeer::CREATIONDATE => 4, CalendarEventPeer::STARTDATE => 5, CalendarEventPeer::ENDDATE => 6, CalendarEventPeer::SOURCECONTACT => 7, CalendarEventPeer::STATUS => 8, CalendarEventPeer::REGIONID => 9, CalendarEventPeer::CATEGORYID => 10, CalendarEventPeer::USERID => 11, CalendarEventPeer::DELETED_AT => 12, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TITLE' => 1, 'SUMMARY' => 2, 'BODY' => 3, 'CREATIONDATE' => 4, 'STARTDATE' => 5, 'ENDDATE' => 6, 'SOURCECONTACT' => 7, 'STATUS' => 8, 'REGIONID' => 9, 'CATEGORYID' => 10, 'USERID' => 11, 'DELETED_AT' => 12, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'summary' => 2, 'body' => 3, 'creationDate' => 4, 'startDate' => 5, 'endDate' => 6, 'sourceContact' => 7, 'status' => 8, 'regionId' => 9, 'categoryId' => 10, 'userId' => 11, 'deleted_at' => 12, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
        $toNames = CalendarEventPeer::getFieldNames($toType);
        $key = isset(CalendarEventPeer::$fieldKeys[$fromType][$name]) ? CalendarEventPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(CalendarEventPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, CalendarEventPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return CalendarEventPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. CalendarEventPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(CalendarEventPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(CalendarEventPeer::ID);
            $criteria->addSelectColumn(CalendarEventPeer::TITLE);
            $criteria->addSelectColumn(CalendarEventPeer::SUMMARY);
            $criteria->addSelectColumn(CalendarEventPeer::BODY);
            $criteria->addSelectColumn(CalendarEventPeer::CREATIONDATE);
            $criteria->addSelectColumn(CalendarEventPeer::STARTDATE);
            $criteria->addSelectColumn(CalendarEventPeer::ENDDATE);
            $criteria->addSelectColumn(CalendarEventPeer::SOURCECONTACT);
            $criteria->addSelectColumn(CalendarEventPeer::STATUS);
            $criteria->addSelectColumn(CalendarEventPeer::REGIONID);
            $criteria->addSelectColumn(CalendarEventPeer::CATEGORYID);
            $criteria->addSelectColumn(CalendarEventPeer::USERID);
            $criteria->addSelectColumn(CalendarEventPeer::DELETED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.SUMMARY');
            $criteria->addSelectColumn($alias . '.BODY');
            $criteria->addSelectColumn($alias . '.CREATIONDATE');
            $criteria->addSelectColumn($alias . '.STARTDATE');
            $criteria->addSelectColumn($alias . '.ENDDATE');
            $criteria->addSelectColumn($alias . '.SOURCECONTACT');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.REGIONID');
            $criteria->addSelectColumn($alias . '.CATEGORYID');
            $criteria->addSelectColumn($alias . '.USERID');
            $criteria->addSelectColumn($alias . '.DELETED_AT');
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
        $criteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CalendarEventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * @return                 CalendarEvent
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = CalendarEventPeer::doSelect($critcopy, $con);
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
        return CalendarEventPeer::populateObjects(CalendarEventPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            CalendarEventPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * @param      CalendarEvent $obj A CalendarEvent object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            CalendarEventPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A CalendarEvent object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof CalendarEvent) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CalendarEvent object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(CalendarEventPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   CalendarEvent Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(CalendarEventPeer::$instances[$key])) {
                return CalendarEventPeer::$instances[$key];
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
        CalendarEventPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to calendar_event
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
        $cls = CalendarEventPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = CalendarEventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = CalendarEventPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CalendarEventPeer::addInstanceToPool($obj, $key);
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
     * @return array (CalendarEvent object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = CalendarEventPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = CalendarEventPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + CalendarEventPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CalendarEventPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            CalendarEventPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related User table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CalendarEventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CalendarEventPeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * Returns the number of rows matching criteria, joining the related Category table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CalendarEventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CalendarEventPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * Selects a collection of CalendarEvent objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CalendarEvent objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        }

        CalendarEventPeer::addSelectColumns($criteria);
        $startcol = CalendarEventPeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(CalendarEventPeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CalendarEventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CalendarEventPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CalendarEventPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CalendarEventPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CalendarEvent) to $obj2 (User)
                $obj2->addCalendarEvent($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CalendarEvent objects pre-filled with their Category objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CalendarEvent objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        }

        CalendarEventPeer::addSelectColumns($criteria);
        $startcol = CalendarEventPeer::NUM_HYDRATE_COLUMNS;
        CategoryPeer::addSelectColumns($criteria);

        $criteria->addJoin(CalendarEventPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CalendarEventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CalendarEventPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CalendarEventPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CalendarEventPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = CategoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    CategoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CalendarEvent) to $obj2 (Category)
                $obj2->addCalendarEvent($obj1);

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
        $criteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CalendarEventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CalendarEventPeer::USERID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(CalendarEventPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * Selects a collection of CalendarEvent objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CalendarEvent objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        }

        CalendarEventPeer::addSelectColumns($criteria);
        $startcol2 = CalendarEventPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        CategoryPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + CategoryPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CalendarEventPeer::USERID, UserPeer::ID, $join_behavior);

        $criteria->addJoin(CalendarEventPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CalendarEventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CalendarEventPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CalendarEventPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CalendarEventPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined User rows

            $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = UserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (CalendarEvent) to the collection in $obj2 (User)
                $obj2->addCalendarEvent($obj1);
            } // if joined row not null

            // Add objects for joined Category rows

            $key3 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = CategoryPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = CategoryPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    CategoryPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (CalendarEvent) to the collection in $obj3 (Category)
                $obj3->addCalendarEvent($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related User table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CalendarEventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CalendarEventPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * Returns the number of rows matching criteria, joining the related Category table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CalendarEventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CalendarEventPeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
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
     * Selects a collection of CalendarEvent objects pre-filled with all related objects except User.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CalendarEvent objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        }

        CalendarEventPeer::addSelectColumns($criteria);
        $startcol2 = CalendarEventPeer::NUM_HYDRATE_COLUMNS;

        CategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + CategoryPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CalendarEventPeer::CATEGORYID, CategoryPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
        }

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CalendarEventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CalendarEventPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CalendarEventPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CalendarEventPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Category rows

                $key2 = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = CategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = CategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    CategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CalendarEvent) to the collection in $obj2 (Category)
                $obj2->addCalendarEvent($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CalendarEvent objects pre-filled with all related objects except Category.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CalendarEvent objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        }

        CalendarEventPeer::addSelectColumns($criteria);
        $startcol2 = CalendarEventPeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CalendarEventPeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (CalendarEventQuery::isSoftDeleteEnabled()) {
            $criteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CalendarEventPeer::enableSoftDelete();
        }

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CalendarEventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CalendarEventPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CalendarEventPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CalendarEventPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined User rows

                $key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = UserPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = UserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    UserPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CalendarEvent) to the collection in $obj2 (User)
                $obj2->addCalendarEvent($obj1);

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
        return Propel::getDatabaseMap(CalendarEventPeer::DATABASE_NAME)->getTable(CalendarEventPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseCalendarEventPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseCalendarEventPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new CalendarEventTableMap());
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
        return CalendarEventPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a CalendarEvent or Criteria object.
     *
     * @param      mixed $values Criteria or CalendarEvent object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from CalendarEvent object
        }

        if ($criteria->containsKey(CalendarEventPeer::ID) && $criteria->keyContainsValue(CalendarEventPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CalendarEventPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a CalendarEvent or Criteria object.
     *
     * @param      mixed $values Criteria or CalendarEvent object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(CalendarEventPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(CalendarEventPeer::ID);
            $value = $criteria->remove(CalendarEventPeer::ID);
            if ($value) {
                $selectCriteria->add(CalendarEventPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(CalendarEventPeer::TABLE_NAME);
            }

        } else { // $values is CalendarEvent object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the calendar_event table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doForceDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(CalendarEventPeer::TABLE_NAME, $con, CalendarEventPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CalendarEventPeer::clearInstancePool();
            CalendarEventPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a CalendarEvent or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or CalendarEvent object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doForceDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            CalendarEventPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof CalendarEvent) { // it's a model object
            // invalidate the cache for this single object
            CalendarEventPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CalendarEventPeer::DATABASE_NAME);
            $criteria->add(CalendarEventPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                CalendarEventPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(CalendarEventPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            CalendarEventPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given CalendarEvent object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      CalendarEvent $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(CalendarEventPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(CalendarEventPeer::TABLE_NAME);

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

        return BasePeer::doValidate(CalendarEventPeer::DATABASE_NAME, CalendarEventPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return CalendarEvent
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = CalendarEventPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(CalendarEventPeer::DATABASE_NAME);
        $criteria->add(CalendarEventPeer::ID, $pk);

        $v = CalendarEventPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return CalendarEvent[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(CalendarEventPeer::DATABASE_NAME);
            $criteria->add(CalendarEventPeer::ID, $pks, Criteria::IN);
            $objs = CalendarEventPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // soft_delete behavior

    /**
     * Enable the soft_delete behavior for this model
     */
    public static function enableSoftDelete()
    {
        CalendarEventQuery::enableSoftDelete();
        // some soft_deleted objects may be in the instance pool
        CalendarEventPeer::clearInstancePool();
    }

    /**
     * Disable the soft_delete behavior for this model
     */
    public static function disableSoftDelete()
    {
        CalendarEventQuery::disableSoftDelete();
    }

    /**
     * Check the soft_delete behavior for this model
     * @return boolean true if the soft_delete behavior is enabled
     */
    public static function isSoftDeleteEnabled()
    {
        return CalendarEventQuery::isSoftDeleteEnabled();
    }

    /**
     * Soft delete records, given a CalendarEvent or Criteria object OR a primary key value.
     *
     * @param			 mixed $values Criteria or CalendarEvent object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDelete($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        if ($values instanceof Criteria) {
            // rename for clarity
            $selectCriteria = clone $values;
         } elseif ($values instanceof CalendarEvent) {
            // create criteria based on pk values
            $selectCriteria = $values->buildPkeyCriteria();
        } else {
            // it must be the primary key
            $selectCriteria = new Criteria(self::DATABASE_NAME);
             $selectCriteria->add(CalendarEventPeer::ID, (array) $values, Criteria::IN);
        }
        // Set the correct dbName
        $selectCriteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        $updateCriteria = new Criteria(self::DATABASE_NAME);
        $updateCriteria->add(CalendarEventPeer::DELETED_AT, time());

         return BasePeer::doUpdate($selectCriteria, $updateCriteria, $con);
    }

    /**
     * Delete or soft delete records, depending on CalendarEventPeer::$softDelete
     *
     * @param			 mixed $values Criteria or CalendarEvent object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDelete($values, PropelPDO $con = null)
    {
        if (CalendarEventPeer::isSoftDeleteEnabled()) {
            return CalendarEventPeer::doSoftDelete($values, $con);
        } else {
            return CalendarEventPeer::doForceDelete($values, $con);
        }
    }
    /**
     * Method to soft delete all rows from the calendar_event table.
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $selectCriteria = new Criteria();
        $selectCriteria->add(CalendarEventPeer::DELETED_AT, null, Criteria::ISNULL);
        $selectCriteria->setDbName(CalendarEventPeer::DATABASE_NAME);
        $modifyCriteria = new Criteria();
        $modifyCriteria->add(CalendarEventPeer::DELETED_AT, time());

        return BasePeer::doUpdate($selectCriteria, $modifyCriteria, $con);
    }

    /**
     * Delete or soft delete all records, depending on CalendarEventPeer::$softDelete
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if (CalendarEventPeer::isSoftDeleteEnabled()) {
            return CalendarEventPeer::doSoftDeleteAll($con);
        } else {
            return CalendarEventPeer::doForceDeleteAll($con);
        }
    }

} // BaseCalendarEventPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseCalendarEventPeer::buildTableMap();

