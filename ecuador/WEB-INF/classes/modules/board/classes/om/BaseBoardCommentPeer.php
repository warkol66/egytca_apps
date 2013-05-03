<?php


/**
 * Base static class for performing query and update operations on the 'board_comment' table.
 *
 * Comentarios a challenges
 *
 * @package propel.generator.board.classes.om
 */
abstract class BaseBoardCommentPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'board_comment';

    /** the related Propel class for this table */
    const OM_CLASS = 'BoardComment';

    /** the related TableMap class for this table */
    const TM_CLASS = 'BoardCommentTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 14;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 14;

    /** the column name for the ID field */
    const ID = 'board_comment.ID';

    /** the column name for the CHALLENGEID field */
    const CHALLENGEID = 'board_comment.CHALLENGEID';

    /** the column name for the BONDID field */
    const BONDID = 'board_comment.BONDID';

    /** the column name for the PARENTID field */
    const PARENTID = 'board_comment.PARENTID';

    /** the column name for the TEXT field */
    const TEXT = 'board_comment.TEXT';

    /** the column name for the EMAIL field */
    const EMAIL = 'board_comment.EMAIL';

    /** the column name for the USERNAME field */
    const USERNAME = 'board_comment.USERNAME';

    /** the column name for the URL field */
    const URL = 'board_comment.URL';

    /** the column name for the IP field */
    const IP = 'board_comment.IP';

    /** the column name for the CREATIONDATE field */
    const CREATIONDATE = 'board_comment.CREATIONDATE';

    /** the column name for the STATUS field */
    const STATUS = 'board_comment.STATUS';

    /** the column name for the USERID field */
    const USERID = 'board_comment.USERID';

    /** the column name for the OBJECTTYPE field */
    const OBJECTTYPE = 'board_comment.OBJECTTYPE';

    /** the column name for the OBJECTID field */
    const OBJECTID = 'board_comment.OBJECTID';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of BoardComment objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array BoardComment[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. BoardCommentPeer::$fieldNames[BoardCommentPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Challengeid', 'Bondid', 'Parentid', 'Text', 'Email', 'Username', 'Url', 'Ip', 'Creationdate', 'Status', 'Userid', 'Objecttype', 'Objectid', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'challengeid', 'bondid', 'parentid', 'text', 'email', 'username', 'url', 'ip', 'creationdate', 'status', 'userid', 'objecttype', 'objectid', ),
        BasePeer::TYPE_COLNAME => array (BoardCommentPeer::ID, BoardCommentPeer::CHALLENGEID, BoardCommentPeer::BONDID, BoardCommentPeer::PARENTID, BoardCommentPeer::TEXT, BoardCommentPeer::EMAIL, BoardCommentPeer::USERNAME, BoardCommentPeer::URL, BoardCommentPeer::IP, BoardCommentPeer::CREATIONDATE, BoardCommentPeer::STATUS, BoardCommentPeer::USERID, BoardCommentPeer::OBJECTTYPE, BoardCommentPeer::OBJECTID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'CHALLENGEID', 'BONDID', 'PARENTID', 'TEXT', 'EMAIL', 'USERNAME', 'URL', 'IP', 'CREATIONDATE', 'STATUS', 'USERID', 'OBJECTTYPE', 'OBJECTID', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'challengeId', 'bondId', 'parentId', 'text', 'email', 'username', 'url', 'ip', 'creationDate', 'status', 'userId', 'objectType', 'objectId', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BoardCommentPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Challengeid' => 1, 'Bondid' => 2, 'Parentid' => 3, 'Text' => 4, 'Email' => 5, 'Username' => 6, 'Url' => 7, 'Ip' => 8, 'Creationdate' => 9, 'Status' => 10, 'Userid' => 11, 'Objecttype' => 12, 'Objectid' => 13, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'challengeid' => 1, 'bondid' => 2, 'parentid' => 3, 'text' => 4, 'email' => 5, 'username' => 6, 'url' => 7, 'ip' => 8, 'creationdate' => 9, 'status' => 10, 'userid' => 11, 'objecttype' => 12, 'objectid' => 13, ),
        BasePeer::TYPE_COLNAME => array (BoardCommentPeer::ID => 0, BoardCommentPeer::CHALLENGEID => 1, BoardCommentPeer::BONDID => 2, BoardCommentPeer::PARENTID => 3, BoardCommentPeer::TEXT => 4, BoardCommentPeer::EMAIL => 5, BoardCommentPeer::USERNAME => 6, BoardCommentPeer::URL => 7, BoardCommentPeer::IP => 8, BoardCommentPeer::CREATIONDATE => 9, BoardCommentPeer::STATUS => 10, BoardCommentPeer::USERID => 11, BoardCommentPeer::OBJECTTYPE => 12, BoardCommentPeer::OBJECTID => 13, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'CHALLENGEID' => 1, 'BONDID' => 2, 'PARENTID' => 3, 'TEXT' => 4, 'EMAIL' => 5, 'USERNAME' => 6, 'URL' => 7, 'IP' => 8, 'CREATIONDATE' => 9, 'STATUS' => 10, 'USERID' => 11, 'OBJECTTYPE' => 12, 'OBJECTID' => 13, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'challengeId' => 1, 'bondId' => 2, 'parentId' => 3, 'text' => 4, 'email' => 5, 'username' => 6, 'url' => 7, 'ip' => 8, 'creationDate' => 9, 'status' => 10, 'userId' => 11, 'objectType' => 12, 'objectId' => 13, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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
        $toNames = BoardCommentPeer::getFieldNames($toType);
        $key = isset(BoardCommentPeer::$fieldKeys[$fromType][$name]) ? BoardCommentPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(BoardCommentPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, BoardCommentPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return BoardCommentPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. BoardCommentPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(BoardCommentPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(BoardCommentPeer::ID);
            $criteria->addSelectColumn(BoardCommentPeer::CHALLENGEID);
            $criteria->addSelectColumn(BoardCommentPeer::BONDID);
            $criteria->addSelectColumn(BoardCommentPeer::PARENTID);
            $criteria->addSelectColumn(BoardCommentPeer::TEXT);
            $criteria->addSelectColumn(BoardCommentPeer::EMAIL);
            $criteria->addSelectColumn(BoardCommentPeer::USERNAME);
            $criteria->addSelectColumn(BoardCommentPeer::URL);
            $criteria->addSelectColumn(BoardCommentPeer::IP);
            $criteria->addSelectColumn(BoardCommentPeer::CREATIONDATE);
            $criteria->addSelectColumn(BoardCommentPeer::STATUS);
            $criteria->addSelectColumn(BoardCommentPeer::USERID);
            $criteria->addSelectColumn(BoardCommentPeer::OBJECTTYPE);
            $criteria->addSelectColumn(BoardCommentPeer::OBJECTID);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.CHALLENGEID');
            $criteria->addSelectColumn($alias . '.BONDID');
            $criteria->addSelectColumn($alias . '.PARENTID');
            $criteria->addSelectColumn($alias . '.TEXT');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.USERNAME');
            $criteria->addSelectColumn($alias . '.URL');
            $criteria->addSelectColumn($alias . '.IP');
            $criteria->addSelectColumn($alias . '.CREATIONDATE');
            $criteria->addSelectColumn($alias . '.STATUS');
            $criteria->addSelectColumn($alias . '.USERID');
            $criteria->addSelectColumn($alias . '.OBJECTTYPE');
            $criteria->addSelectColumn($alias . '.OBJECTID');
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
        $criteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardCommentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 BoardComment
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = BoardCommentPeer::doSelect($critcopy, $con);
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
        return BoardCommentPeer::populateObjects(BoardCommentPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            BoardCommentPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

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
     * @param      BoardComment $obj A BoardComment object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            BoardCommentPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A BoardComment object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof BoardComment) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or BoardComment object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(BoardCommentPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   BoardComment Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(BoardCommentPeer::$instances[$key])) {
                return BoardCommentPeer::$instances[$key];
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
        BoardCommentPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to board_comment
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
        $cls = BoardCommentPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = BoardCommentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = BoardCommentPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BoardCommentPeer::addInstanceToPool($obj, $key);
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
     * @return array (BoardComment object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = BoardCommentPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = BoardCommentPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + BoardCommentPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BoardCommentPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            BoardCommentPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related BoardChallenge table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBoardChallenge(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardCommentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardCommentPeer::CHALLENGEID, BoardChallengePeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related BoardBond table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBoardBond(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardCommentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardCommentPeer::BONDID, BoardBondPeer::ID, $join_behavior);

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
     * Selects a collection of BoardComment objects pre-filled with their BoardChallenge objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardComment objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBoardChallenge(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);
        }

        BoardCommentPeer::addSelectColumns($criteria);
        $startcol = BoardCommentPeer::NUM_HYDRATE_COLUMNS;
        BoardChallengePeer::addSelectColumns($criteria);

        $criteria->addJoin(BoardCommentPeer::CHALLENGEID, BoardChallengePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardCommentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardCommentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BoardCommentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardCommentPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BoardChallengePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BoardChallengePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BoardChallengePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BoardChallengePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (BoardComment) to $obj2 (BoardChallenge)
                $obj2->addBoardComment($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of BoardComment objects pre-filled with their BoardBond objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardComment objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBoardBond(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);
        }

        BoardCommentPeer::addSelectColumns($criteria);
        $startcol = BoardCommentPeer::NUM_HYDRATE_COLUMNS;
        BoardBondPeer::addSelectColumns($criteria);

        $criteria->addJoin(BoardCommentPeer::BONDID, BoardBondPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardCommentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardCommentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BoardCommentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardCommentPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BoardBondPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BoardBondPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BoardBondPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BoardBondPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (BoardComment) to $obj2 (BoardBond)
                $obj2->addBoardComment($obj1);

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
        $criteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardCommentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardCommentPeer::CHALLENGEID, BoardChallengePeer::ID, $join_behavior);

        $criteria->addJoin(BoardCommentPeer::BONDID, BoardBondPeer::ID, $join_behavior);

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
     * Selects a collection of BoardComment objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardComment objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);
        }

        BoardCommentPeer::addSelectColumns($criteria);
        $startcol2 = BoardCommentPeer::NUM_HYDRATE_COLUMNS;

        BoardChallengePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BoardChallengePeer::NUM_HYDRATE_COLUMNS;

        BoardBondPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + BoardBondPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BoardCommentPeer::CHALLENGEID, BoardChallengePeer::ID, $join_behavior);

        $criteria->addJoin(BoardCommentPeer::BONDID, BoardBondPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardCommentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardCommentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BoardCommentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardCommentPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined BoardChallenge rows

            $key2 = BoardChallengePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = BoardChallengePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BoardChallengePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BoardChallengePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (BoardComment) to the collection in $obj2 (BoardChallenge)
                $obj2->addBoardComment($obj1);
            } // if joined row not null

            // Add objects for joined BoardBond rows

            $key3 = BoardBondPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = BoardBondPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = BoardBondPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    BoardBondPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (BoardComment) to the collection in $obj3 (BoardBond)
                $obj3->addBoardComment($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related BoardChallenge table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBoardChallenge(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardCommentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardCommentPeer::BONDID, BoardBondPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related BoardBond table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBoardBond(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BoardCommentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BoardCommentPeer::CHALLENGEID, BoardChallengePeer::ID, $join_behavior);

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
     * Selects a collection of BoardComment objects pre-filled with all related objects except BoardChallenge.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardComment objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBoardChallenge(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);
        }

        BoardCommentPeer::addSelectColumns($criteria);
        $startcol2 = BoardCommentPeer::NUM_HYDRATE_COLUMNS;

        BoardBondPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BoardBondPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BoardCommentPeer::BONDID, BoardBondPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardCommentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardCommentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BoardCommentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardCommentPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BoardBond rows

                $key2 = BoardBondPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BoardBondPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BoardBondPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BoardBondPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (BoardComment) to the collection in $obj2 (BoardBond)
                $obj2->addBoardComment($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of BoardComment objects pre-filled with all related objects except BoardBond.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BoardComment objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBoardBond(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);
        }

        BoardCommentPeer::addSelectColumns($criteria);
        $startcol2 = BoardCommentPeer::NUM_HYDRATE_COLUMNS;

        BoardChallengePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BoardChallengePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BoardCommentPeer::CHALLENGEID, BoardChallengePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BoardCommentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BoardCommentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BoardCommentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BoardCommentPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BoardChallenge rows

                $key2 = BoardChallengePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BoardChallengePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BoardChallengePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BoardChallengePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (BoardComment) to the collection in $obj2 (BoardChallenge)
                $obj2->addBoardComment($obj1);

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
        return Propel::getDatabaseMap(BoardCommentPeer::DATABASE_NAME)->getTable(BoardCommentPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseBoardCommentPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseBoardCommentPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new BoardCommentTableMap());
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
        return BoardCommentPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a BoardComment or Criteria object.
     *
     * @param      mixed $values Criteria or BoardComment object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from BoardComment object
        }

        if ($criteria->containsKey(BoardCommentPeer::ID) && $criteria->keyContainsValue(BoardCommentPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BoardCommentPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a BoardComment or Criteria object.
     *
     * @param      mixed $values Criteria or BoardComment object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(BoardCommentPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(BoardCommentPeer::ID);
            $value = $criteria->remove(BoardCommentPeer::ID);
            if ($value) {
                $selectCriteria->add(BoardCommentPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BoardCommentPeer::TABLE_NAME);
            }

        } else { // $values is BoardComment object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the board_comment table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(BoardCommentPeer::TABLE_NAME, $con, BoardCommentPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BoardCommentPeer::clearInstancePool();
            BoardCommentPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a BoardComment or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or BoardComment object or primary key or array of primary keys
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
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            BoardCommentPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof BoardComment) { // it's a model object
            // invalidate the cache for this single object
            BoardCommentPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BoardCommentPeer::DATABASE_NAME);
            $criteria->add(BoardCommentPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                BoardCommentPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(BoardCommentPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            BoardCommentPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given BoardComment object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      BoardComment $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(BoardCommentPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(BoardCommentPeer::TABLE_NAME);

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

        return BasePeer::doValidate(BoardCommentPeer::DATABASE_NAME, BoardCommentPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return BoardComment
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = BoardCommentPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(BoardCommentPeer::DATABASE_NAME);
        $criteria->add(BoardCommentPeer::ID, $pk);

        $v = BoardCommentPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return BoardComment[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(BoardCommentPeer::DATABASE_NAME);
            $criteria->add(BoardCommentPeer::ID, $pks, Criteria::IN);
            $objs = BoardCommentPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseBoardCommentPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBoardCommentPeer::buildTableMap();
