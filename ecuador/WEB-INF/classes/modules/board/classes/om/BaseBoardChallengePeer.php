<?php


/**
 * Base static class for performing query and update operations on the 'board_challenge' table.
 *
 * Challenges del Board
 *
 * @package propel.generator.board.classes.om
 */
abstract class BaseBoardChallengePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'board_challenge';

    /** the related Propel class for this table */
    const OM_CLASS = 'BoardChallenge';

    /** the related TableMap class for this table */
    const TM_CLASS = 'BoardChallengeTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 12;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 12;

    /** the column name for the ID field */
    const ID = 'board_challenge.ID';

    /** the column name for the TITLE field */
    const TITLE = 'board_challenge.TITLE';

    /** the column name for the URL field */
    const URL = 'board_challenge.URL';

    /** the column name for the BODY field */
    const BODY = 'board_challenge.BODY';

    /** the column name for the CREATIONDATE field */
    const CREATIONDATE = 'board_challenge.CREATIONDATE';

    /** the column name for the STARTDATE field */
    const STARTDATE = 'board_challenge.STARTDATE';

    /** the column name for the ENDDATE field */
    const ENDDATE = 'board_challenge.ENDDATE';

    /** the column name for the LASTUPDATE field */
    const LASTUPDATE = 'board_challenge.LASTUPDATE';

    /** the column name for the STATUS field */
    const STATUS = 'board_challenge.STATUS';

    /** the column name for the USERID field */
    const USERID = 'board_challenge.USERID';

    /** the column name for the VIEWS field */
    const VIEWS = 'board_challenge.VIEWS';

    /** the column name for the DELETED_AT field */
    const DELETED_AT = 'board_challenge.DELETED_AT';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of BoardChallenge objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array BoardChallenge[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. BoardChallengePeer::$fieldNames[BoardChallengePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Title', 'Url', 'Body', 'Creationdate', 'Startdate', 'Enddate', 'Lastupdate', 'Status', 'Userid', 'Views', 'DeletedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'title', 'url', 'body', 'creationdate', 'startdate', 'enddate', 'lastupdate', 'status', 'userid', 'views', 'deletedAt', ),
        BasePeer::TYPE_COLNAME => array (BoardChallengePeer::ID, BoardChallengePeer::TITLE, BoardChallengePeer::URL, BoardChallengePeer::BODY, BoardChallengePeer::CREATIONDATE, BoardChallengePeer::STARTDATE, BoardChallengePeer::ENDDATE, BoardChallengePeer::LASTUPDATE, BoardChallengePeer::STATUS, BoardChallengePeer::USERID, BoardChallengePeer::VIEWS, BoardChallengePeer::DELETED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TITLE', 'URL', 'BODY', 'CREATIONDATE', 'STARTDATE', 'ENDDATE', 'LASTUPDATE', 'STATUS', 'USERID', 'VIEWS', 'DELETED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'title', 'url', 'body', 'creationDate', 'startDate', 'endDate', 'lastUpdate', 'status', 'userId', 'views', 'deleted_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BoardChallengePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Title' => 1, 'Url' => 2, 'Body' => 3, 'Creationdate' => 4, 'Startdate' => 5, 'Enddate' => 6, 'Lastupdate' => 7, 'Status' => 8, 'Userid' => 9, 'Views' => 10, 'DeletedAt' => 11, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'title' => 1, 'url' => 2, 'body' => 3, 'creationdate' => 4, 'startdate' => 5, 'enddate' => 6, 'lastupdate' => 7, 'status' => 8, 'userid' => 9, 'views' => 10, 'deletedAt' => 11, ),
        BasePeer::TYPE_COLNAME => array (BoardChallengePeer::ID => 0, BoardChallengePeer::TITLE => 1, BoardChallengePeer::URL => 2, BoardChallengePeer::BODY => 3, BoardChallengePeer::CREATIONDATE => 4, BoardChallengePeer::STARTDATE => 5, BoardChallengePeer::ENDDATE => 6, BoardChallengePeer::LASTUPDATE => 7, BoardChallengePeer::STATUS => 8, BoardChallengePeer::USERID => 9, BoardChallengePeer::VIEWS => 10, BoardChallengePeer::DELETED_AT => 11, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TITLE' => 1, 'URL' => 2, 'BODY' => 3, 'CREATIONDATE' => 4, 'STARTDATE' => 5, 'ENDDATE' => 6, 'LASTUPDATE' => 7, 'STATUS' => 8, 'USERID' => 9, 'VIEWS' => 10, 'DELETED_AT' => 11, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'title' => 1, 'url' => 2, 'body' => 3, 'creationDate' => 4, 'startDate' => 5, 'endDate' => 6, 'lastUpdate' => 7, 'status' => 8, 'userId' => 9, 'views' => 10, 'deleted_at' => 11, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
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
        $toNames = BoardChallengePeer::getFieldNames($toType);
        $key = isset(BoardChallengePeer::$fieldKeys[$fromType][$name]) ? BoardChallengePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(BoardChallengePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, BoardChallengePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return BoardChallengePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. BoardChallengePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(BoardChallengePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(BoardChallengePeer::ID);
            $criteria->addSelectColumn(BoardChallengePeer::TITLE);
            $criteria->addSelectColumn(BoardChallengePeer::URL);
            $criteria->addSelectColumn(BoardChallengePeer::BODY);
            $criteria->addSelectColumn(BoardChallengePeer::CREATIONDATE);
            $criteria->addSelectColumn(BoardChallengePeer::STARTDATE);
            $criteria->addSelectColumn(BoardChallengePeer::ENDDATE);
            $criteria->addSelectColumn(BoardChallengePeer::LASTUPDATE);
            $criteria->addSelectColumn(BoardChallengePeer::STATUS);
            $criteria->addSelectColumn(BoardChallengePeer::USERID);
            $criteria->addSelectColumn(BoardChallengePeer::VIEWS);
            $criteria->addSelectColumn(BoardChallengePeer::DELETED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.URL');
            $criteria->addSelectColumn($alias . '.BODY');
            $criteria->addSelectColumn($alias . '.CREATIONDATE');
            $criteria->addSelectColumn($alias . '.STARTDATE');
            $criteria->addSelectColumn($alias . '.ENDDATE');
            $criteria->addSelectColumn($alias . '.LASTUPDATE');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.USERID');
            $criteria->addSelectColumn($alias . '.VIEWS');
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
        $criteria->setPrimaryTableName(BoardChallengePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardChallengePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // soft_delete behavior
        if (BoardChallengeQuery::isSoftDeleteEnabled()) {
            $criteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
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
     * @return                 BoardChallenge
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = BoardChallengePeer::doSelect($critcopy, $con);
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
        return BoardChallengePeer::populateObjects(BoardChallengePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            BoardChallengePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);
        // soft_delete behavior
        if (BoardChallengeQuery::isSoftDeleteEnabled()) {
            $criteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
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
     * @param      BoardChallenge $obj A BoardChallenge object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            BoardChallengePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A BoardChallenge object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof BoardChallenge) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or BoardChallenge object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(BoardChallengePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   BoardChallenge Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(BoardChallengePeer::$instances[$key])) {
                return BoardChallengePeer::$instances[$key];
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
        BoardChallengePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to board_challenge
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
        $cls = BoardChallengePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = BoardChallengePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = BoardChallengePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BoardChallengePeer::addInstanceToPool($obj, $key);
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
     * @return array (BoardChallenge object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = BoardChallengePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = BoardChallengePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + BoardChallengePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BoardChallengePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            BoardChallengePeer::addInstanceToPool($obj, $key);
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
        $criteria->setPrimaryTableName(BoardChallengePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardChallengePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardChallengePeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (BoardChallengeQuery::isSoftDeleteEnabled()) {
            $criteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
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
     * Selects a collection of BoardChallenge objects pre-filled with their User objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardChallenge objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);
        }

        BoardChallengePeer::addSelectColumns($criteria);
        $startcol = BoardChallengePeer::NUM_HYDRATE_COLUMNS;
        UserPeer::addSelectColumns($criteria);

        $criteria->addJoin(BoardChallengePeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (BoardChallengeQuery::isSoftDeleteEnabled()) {
            $criteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardChallengePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardChallengePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BoardChallengePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardChallengePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (BoardChallenge) to $obj2 (User)
                $obj2->addBoardChallenge($obj1);

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
        $criteria->setPrimaryTableName(BoardChallengePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardChallengePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardChallengePeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (BoardChallengeQuery::isSoftDeleteEnabled()) {
            $criteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
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
     * Selects a collection of BoardChallenge objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardChallenge objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);
        }

        BoardChallengePeer::addSelectColumns($criteria);
        $startcol2 = BoardChallengePeer::NUM_HYDRATE_COLUMNS;

        UserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BoardChallengePeer::USERID, UserPeer::ID, $join_behavior);

        // soft_delete behavior
        if (BoardChallengeQuery::isSoftDeleteEnabled()) {
            $criteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            BoardChallengePeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardChallengePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardChallengePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BoardChallengePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardChallengePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (BoardChallenge) to the collection in $obj2 (User)
                $obj2->addBoardChallenge($obj1);
            } // if joined row not null

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
        return Propel::getDatabaseMap(BoardChallengePeer::DATABASE_NAME)->getTable(BoardChallengePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseBoardChallengePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseBoardChallengePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new BoardChallengeTableMap());
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
        return BoardChallengePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a BoardChallenge or Criteria object.
     *
     * @param      mixed $values Criteria or BoardChallenge object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from BoardChallenge object
        }

        if ($criteria->containsKey(BoardChallengePeer::ID) && $criteria->keyContainsValue(BoardChallengePeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BoardChallengePeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a BoardChallenge or Criteria object.
     *
     * @param      mixed $values Criteria or BoardChallenge object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(BoardChallengePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(BoardChallengePeer::ID);
            $value = $criteria->remove(BoardChallengePeer::ID);
            if ($value) {
                $selectCriteria->add(BoardChallengePeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BoardChallengePeer::TABLE_NAME);
            }

        } else { // $values is BoardChallenge object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the board_challenge table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doForceDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(BoardChallengePeer::TABLE_NAME, $con, BoardChallengePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BoardChallengePeer::clearInstancePool();
            BoardChallengePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a BoardChallenge or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or BoardChallenge object or primary key or array of primary keys
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
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            BoardChallengePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof BoardChallenge) { // it's a model object
            // invalidate the cache for this single object
            BoardChallengePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BoardChallengePeer::DATABASE_NAME);
            $criteria->add(BoardChallengePeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                BoardChallengePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(BoardChallengePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            BoardChallengePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given BoardChallenge object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      BoardChallenge $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(BoardChallengePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(BoardChallengePeer::TABLE_NAME);

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

        return BasePeer::doValidate(BoardChallengePeer::DATABASE_NAME, BoardChallengePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return BoardChallenge
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = BoardChallengePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(BoardChallengePeer::DATABASE_NAME);
        $criteria->add(BoardChallengePeer::ID, $pk);

        $v = BoardChallengePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return BoardChallenge[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(BoardChallengePeer::DATABASE_NAME);
            $criteria->add(BoardChallengePeer::ID, $pks, Criteria::IN);
            $objs = BoardChallengePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // soft_delete behavior

    /**
     * Enable the soft_delete behavior for this model
     */
    public static function enableSoftDelete()
    {
        BoardChallengeQuery::enableSoftDelete();
        // some soft_deleted objects may be in the instance pool
        BoardChallengePeer::clearInstancePool();
    }

    /**
     * Disable the soft_delete behavior for this model
     */
    public static function disableSoftDelete()
    {
        BoardChallengeQuery::disableSoftDelete();
    }

    /**
     * Check the soft_delete behavior for this model
     * @return boolean true if the soft_delete behavior is enabled
     */
    public static function isSoftDeleteEnabled()
    {
        return BoardChallengeQuery::isSoftDeleteEnabled();
    }

    /**
     * Soft delete records, given a BoardChallenge or Criteria object OR a primary key value.
     *
     * @param			 mixed $values Criteria or BoardChallenge object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDelete($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        if ($values instanceof Criteria) {
            // rename for clarity
            $selectCriteria = clone $values;
         } elseif ($values instanceof BoardChallenge) {
            // create criteria based on pk values
            $selectCriteria = $values->buildPkeyCriteria();
        } else {
            // it must be the primary key
            $selectCriteria = new Criteria(self::DATABASE_NAME);
             $selectCriteria->add(BoardChallengePeer::ID, (array) $values, Criteria::IN);
        }
        // Set the correct dbName
        $selectCriteria->setDbName(BoardChallengePeer::DATABASE_NAME);
        $updateCriteria = new Criteria(self::DATABASE_NAME);
        $updateCriteria->add(BoardChallengePeer::DELETED_AT, time());

         return BasePeer::doUpdate($selectCriteria, $updateCriteria, $con);
    }

    /**
     * Delete or soft delete records, depending on BoardChallengePeer::$softDelete
     *
     * @param			 mixed $values Criteria or BoardChallenge object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDelete($values, PropelPDO $con = null)
    {
        if (BoardChallengePeer::isSoftDeleteEnabled()) {
            return BoardChallengePeer::doSoftDelete($values, $con);
        } else {
            return BoardChallengePeer::doForceDelete($values, $con);
        }
    }
    /**
     * Method to soft delete all rows from the board_challenge table.
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $selectCriteria = new Criteria();
        $selectCriteria->add(BoardChallengePeer::DELETED_AT, null, Criteria::ISNULL);
        $selectCriteria->setDbName(BoardChallengePeer::DATABASE_NAME);
        $modifyCriteria = new Criteria();
        $modifyCriteria->add(BoardChallengePeer::DELETED_AT, time());

        return BasePeer::doUpdate($selectCriteria, $modifyCriteria, $con);
    }

    /**
     * Delete or soft delete all records, depending on BoardChallengePeer::$softDelete
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if (BoardChallengePeer::isSoftDeleteEnabled()) {
            return BoardChallengePeer::doSoftDeleteAll($con);
        } else {
            return BoardChallengePeer::doForceDeleteAll($con);
        }
    }

} // BaseBoardChallengePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBoardChallengePeer::buildTableMap();

