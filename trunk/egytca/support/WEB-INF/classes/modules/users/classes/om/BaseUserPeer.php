<?php


/**
 * Base static class for performing query and update operations on the 'users_user' table.
 *
 * Users
 *
 * @package propel.generator.users.classes.om
 */
abstract class BaseUserPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'users_user';

    /** the related Propel class for this table */
    const OM_CLASS = 'User';

    /** the related TableMap class for this table */
    const TM_CLASS = 'UserTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 18;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 18;

    /** the column name for the ID field */
    const ID = 'users_user.ID';

    /** the column name for the USERNAME field */
    const USERNAME = 'users_user.USERNAME';

    /** the column name for the PASSWORD field */
    const PASSWORD = 'users_user.PASSWORD';

    /** the column name for the PASSWORDUPDATED field */
    const PASSWORDUPDATED = 'users_user.PASSWORDUPDATED';

    /** the column name for the NAME field */
    const NAME = 'users_user.NAME';

    /** the column name for the SURNAME field */
    const SURNAME = 'users_user.SURNAME';

    /** the column name for the ACTIVE field */
    const ACTIVE = 'users_user.ACTIVE';

    /** the column name for the LEVELID field */
    const LEVELID = 'users_user.LEVELID';

    /** the column name for the LASTLOGIN field */
    const LASTLOGIN = 'users_user.LASTLOGIN';

    /** the column name for the TIMEZONE field */
    const TIMEZONE = 'users_user.TIMEZONE';

    /** the column name for the RECOVERYHASH field */
    const RECOVERYHASH = 'users_user.RECOVERYHASH';

    /** the column name for the RECOVERYHASHCREATEDON field */
    const RECOVERYHASHCREATEDON = 'users_user.RECOVERYHASHCREATEDON';

    /** the column name for the MAILADDRESS field */
    const MAILADDRESS = 'users_user.MAILADDRESS';

    /** the column name for the MAILADDRESSALT field */
    const MAILADDRESSALT = 'users_user.MAILADDRESSALT';

    /** the column name for the SESSION field */
    const SESSION = 'users_user.SESSION';

    /** the column name for the DELETED_AT field */
    const DELETED_AT = 'users_user.DELETED_AT';

    /** the column name for the CREATED_AT field */
    const CREATED_AT = 'users_user.CREATED_AT';

    /** the column name for the UPDATED_AT field */
    const UPDATED_AT = 'users_user.UPDATED_AT';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of User objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array User[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. UserPeer::$fieldNames[UserPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Username', 'Password', 'Passwordupdated', 'Name', 'Surname', 'Active', 'Levelid', 'Lastlogin', 'Timezone', 'Recoveryhash', 'Recoveryhashcreatedon', 'Mailaddress', 'Mailaddressalt', 'Session', 'DeletedAt', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'username', 'password', 'passwordupdated', 'name', 'surname', 'active', 'levelid', 'lastlogin', 'timezone', 'recoveryhash', 'recoveryhashcreatedon', 'mailaddress', 'mailaddressalt', 'session', 'deletedAt', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (UserPeer::ID, UserPeer::USERNAME, UserPeer::PASSWORD, UserPeer::PASSWORDUPDATED, UserPeer::NAME, UserPeer::SURNAME, UserPeer::ACTIVE, UserPeer::LEVELID, UserPeer::LASTLOGIN, UserPeer::TIMEZONE, UserPeer::RECOVERYHASH, UserPeer::RECOVERYHASHCREATEDON, UserPeer::MAILADDRESS, UserPeer::MAILADDRESSALT, UserPeer::SESSION, UserPeer::DELETED_AT, UserPeer::CREATED_AT, UserPeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'USERNAME', 'PASSWORD', 'PASSWORDUPDATED', 'NAME', 'SURNAME', 'ACTIVE', 'LEVELID', 'LASTLOGIN', 'TIMEZONE', 'RECOVERYHASH', 'RECOVERYHASHCREATEDON', 'MAILADDRESS', 'MAILADDRESSALT', 'SESSION', 'DELETED_AT', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'username', 'password', 'passwordUpdated', 'name', 'surname', 'active', 'levelId', 'lastLogin', 'timezone', 'recoveryHash', 'recoveryHashCreatedOn', 'mailAddress', 'mailAddressAlt', 'session', 'deleted_at', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. UserPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Username' => 1, 'Password' => 2, 'Passwordupdated' => 3, 'Name' => 4, 'Surname' => 5, 'Active' => 6, 'Levelid' => 7, 'Lastlogin' => 8, 'Timezone' => 9, 'Recoveryhash' => 10, 'Recoveryhashcreatedon' => 11, 'Mailaddress' => 12, 'Mailaddressalt' => 13, 'Session' => 14, 'DeletedAt' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'username' => 1, 'password' => 2, 'passwordupdated' => 3, 'name' => 4, 'surname' => 5, 'active' => 6, 'levelid' => 7, 'lastlogin' => 8, 'timezone' => 9, 'recoveryhash' => 10, 'recoveryhashcreatedon' => 11, 'mailaddress' => 12, 'mailaddressalt' => 13, 'session' => 14, 'deletedAt' => 15, 'createdAt' => 16, 'updatedAt' => 17, ),
        BasePeer::TYPE_COLNAME => array (UserPeer::ID => 0, UserPeer::USERNAME => 1, UserPeer::PASSWORD => 2, UserPeer::PASSWORDUPDATED => 3, UserPeer::NAME => 4, UserPeer::SURNAME => 5, UserPeer::ACTIVE => 6, UserPeer::LEVELID => 7, UserPeer::LASTLOGIN => 8, UserPeer::TIMEZONE => 9, UserPeer::RECOVERYHASH => 10, UserPeer::RECOVERYHASHCREATEDON => 11, UserPeer::MAILADDRESS => 12, UserPeer::MAILADDRESSALT => 13, UserPeer::SESSION => 14, UserPeer::DELETED_AT => 15, UserPeer::CREATED_AT => 16, UserPeer::UPDATED_AT => 17, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'USERNAME' => 1, 'PASSWORD' => 2, 'PASSWORDUPDATED' => 3, 'NAME' => 4, 'SURNAME' => 5, 'ACTIVE' => 6, 'LEVELID' => 7, 'LASTLOGIN' => 8, 'TIMEZONE' => 9, 'RECOVERYHASH' => 10, 'RECOVERYHASHCREATEDON' => 11, 'MAILADDRESS' => 12, 'MAILADDRESSALT' => 13, 'SESSION' => 14, 'DELETED_AT' => 15, 'CREATED_AT' => 16, 'UPDATED_AT' => 17, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'username' => 1, 'password' => 2, 'passwordUpdated' => 3, 'name' => 4, 'surname' => 5, 'active' => 6, 'levelId' => 7, 'lastLogin' => 8, 'timezone' => 9, 'recoveryHash' => 10, 'recoveryHashCreatedOn' => 11, 'mailAddress' => 12, 'mailAddressAlt' => 13, 'session' => 14, 'deleted_at' => 15, 'created_at' => 16, 'updated_at' => 17, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
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
        $toNames = UserPeer::getFieldNames($toType);
        $key = isset(UserPeer::$fieldKeys[$fromType][$name]) ? UserPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(UserPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, UserPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return UserPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. UserPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(UserPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(UserPeer::ID);
            $criteria->addSelectColumn(UserPeer::USERNAME);
            $criteria->addSelectColumn(UserPeer::PASSWORD);
            $criteria->addSelectColumn(UserPeer::PASSWORDUPDATED);
            $criteria->addSelectColumn(UserPeer::NAME);
            $criteria->addSelectColumn(UserPeer::SURNAME);
            $criteria->addSelectColumn(UserPeer::ACTIVE);
            $criteria->addSelectColumn(UserPeer::LEVELID);
            $criteria->addSelectColumn(UserPeer::LASTLOGIN);
            $criteria->addSelectColumn(UserPeer::TIMEZONE);
            $criteria->addSelectColumn(UserPeer::RECOVERYHASH);
            $criteria->addSelectColumn(UserPeer::RECOVERYHASHCREATEDON);
            $criteria->addSelectColumn(UserPeer::MAILADDRESS);
            $criteria->addSelectColumn(UserPeer::MAILADDRESSALT);
            $criteria->addSelectColumn(UserPeer::SESSION);
            $criteria->addSelectColumn(UserPeer::DELETED_AT);
            $criteria->addSelectColumn(UserPeer::CREATED_AT);
            $criteria->addSelectColumn(UserPeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.USERNAME');
            $criteria->addSelectColumn($alias . '.PASSWORD');
            $criteria->addSelectColumn($alias . '.PASSWORDUPDATED');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.SURNAME');
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.LEVELID');
            $criteria->addSelectColumn($alias . '.LASTLOGIN');
            $criteria->addSelectColumn($alias . '.TIMEZONE');
            $criteria->addSelectColumn($alias . '.RECOVERYHASH');
            $criteria->addSelectColumn($alias . '.RECOVERYHASHCREATEDON');
            $criteria->addSelectColumn($alias . '.MAILADDRESS');
            $criteria->addSelectColumn($alias . '.MAILADDRESSALT');
            $criteria->addSelectColumn($alias . '.SESSION');
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
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UserPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(UserPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // soft_delete behavior
        if (UserQuery::isSoftDeleteEnabled()) {
            $criteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
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
     * @return                 User
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = UserPeer::doSelect($critcopy, $con);
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
        return UserPeer::populateObjects(UserPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            UserPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);
        // soft_delete behavior
        if (UserQuery::isSoftDeleteEnabled()) {
            $criteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
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
     * @param      User $obj A User object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            UserPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A User object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof User) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or User object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(UserPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   User Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(UserPeer::$instances[$key])) {
                return UserPeer::$instances[$key];
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
        UserPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to users_user
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in AlertSubscriptionUserPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        AlertSubscriptionUserPeer::clearInstancePool();
        // Invalidate objects in ScheduleSubscriptionUserPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ScheduleSubscriptionUserPeer::clearInstancePool();
        // Invalidate objects in UserGroupPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        UserGroupPeer::clearInstancePool();
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
        $cls = UserPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = UserPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserPeer::addInstanceToPool($obj, $key);
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
     * @return array (User object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + UserPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            UserPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Level table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinLevel(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UserPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(UserPeer::LEVELID, LevelPeer::ID, $join_behavior);

        // soft_delete behavior
        if (UserQuery::isSoftDeleteEnabled()) {
            $criteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
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
     * Selects a collection of User objects pre-filled with their Level objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of User objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinLevel(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(UserPeer::DATABASE_NAME);
        }

        UserPeer::addSelectColumns($criteria);
        $startcol = UserPeer::NUM_HYDRATE_COLUMNS;
        LevelPeer::addSelectColumns($criteria);

        $criteria->addJoin(UserPeer::LEVELID, LevelPeer::ID, $join_behavior);

        // soft_delete behavior
        if (UserQuery::isSoftDeleteEnabled()) {
            $criteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = UserPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = UserPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = UserPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                UserPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = LevelPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = LevelPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LevelPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    LevelPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (User) to $obj2 (Level)
                $obj2->addUser($obj1);

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
        $criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            UserPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(UserPeer::LEVELID, LevelPeer::ID, $join_behavior);

        // soft_delete behavior
        if (UserQuery::isSoftDeleteEnabled()) {
            $criteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
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
     * Selects a collection of User objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of User objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(UserPeer::DATABASE_NAME);
        }

        UserPeer::addSelectColumns($criteria);
        $startcol2 = UserPeer::NUM_HYDRATE_COLUMNS;

        LevelPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + LevelPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(UserPeer::LEVELID, LevelPeer::ID, $join_behavior);

        // soft_delete behavior
        if (UserQuery::isSoftDeleteEnabled()) {
            $criteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            UserPeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = UserPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = UserPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = UserPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                UserPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Level rows

            $key2 = LevelPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = LevelPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = LevelPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    LevelPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (User) to the collection in $obj2 (Level)
                $obj2->addUser($obj1);
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
        return Propel::getDatabaseMap(UserPeer::DATABASE_NAME)->getTable(UserPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseUserPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseUserPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new UserTableMap());
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
        return UserPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a User or Criteria object.
     *
     * @param      mixed $values Criteria or User object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from User object
        }

        if ($criteria->containsKey(UserPeer::ID) && $criteria->keyContainsValue(UserPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a User or Criteria object.
     *
     * @param      mixed $values Criteria or User object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(UserPeer::ID);
            $value = $criteria->remove(UserPeer::ID);
            if ($value) {
                $selectCriteria->add(UserPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(UserPeer::TABLE_NAME);
            }

        } else { // $values is User object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the users_user table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doForceDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += UserPeer::doOnDeleteCascade(new Criteria(UserPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(UserPeer::TABLE_NAME, $con, UserPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserPeer::clearInstancePool();
            UserPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or User object or primary key or array of primary keys
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof User) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserPeer::DATABASE_NAME);
            $criteria->add(UserPeer::ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(UserPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += UserPeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                UserPeer::clearInstancePool();
            } elseif ($values instanceof User) { // it's a model object
                UserPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    UserPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            UserPeer::clearRelatedInstancePool();
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
        $objects = UserPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related AlertSubscriptionUser objects
            $criteria = new Criteria(AlertSubscriptionUserPeer::DATABASE_NAME);

            $criteria->add(AlertSubscriptionUserPeer::USERID, $obj->getId());
            $affectedRows += AlertSubscriptionUserPeer::doDelete($criteria, $con);

            // delete related ScheduleSubscriptionUser objects
            $criteria = new Criteria(ScheduleSubscriptionUserPeer::DATABASE_NAME);

            $criteria->add(ScheduleSubscriptionUserPeer::USERID, $obj->getId());
            $affectedRows += ScheduleSubscriptionUserPeer::doDelete($criteria, $con);

            // delete related UserGroup objects
            $criteria = new Criteria(UserGroupPeer::DATABASE_NAME);

            $criteria->add(UserGroupPeer::USERID, $obj->getId());
            $affectedRows += UserGroupPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given User object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      User $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(UserPeer::TABLE_NAME);

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

        return BasePeer::doValidate(UserPeer::DATABASE_NAME, UserPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return User
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = UserPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $pk);

        $v = UserPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return User[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(UserPeer::DATABASE_NAME);
            $criteria->add(UserPeer::ID, $pks, Criteria::IN);
            $objs = UserPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // soft_delete behavior

    /**
     * Enable the soft_delete behavior for this model
     */
    public static function enableSoftDelete()
    {
        UserQuery::enableSoftDelete();
        // some soft_deleted objects may be in the instance pool
        UserPeer::clearInstancePool();
    }

    /**
     * Disable the soft_delete behavior for this model
     */
    public static function disableSoftDelete()
    {
        UserQuery::disableSoftDelete();
    }

    /**
     * Check the soft_delete behavior for this model
     * @return boolean true if the soft_delete behavior is enabled
     */
    public static function isSoftDeleteEnabled()
    {
        return UserQuery::isSoftDeleteEnabled();
    }

    /**
     * Soft delete records, given a User or Criteria object OR a primary key value.
     *
     * @param			 mixed $values Criteria or User object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDelete($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        if ($values instanceof Criteria) {
            // rename for clarity
            $selectCriteria = clone $values;
         } elseif ($values instanceof User) {
            // create criteria based on pk values
            $selectCriteria = $values->buildPkeyCriteria();
        } else {
            // it must be the primary key
            $selectCriteria = new Criteria(self::DATABASE_NAME);
             $selectCriteria->add(UserPeer::ID, (array) $values, Criteria::IN);
        }
        // Set the correct dbName
        $selectCriteria->setDbName(UserPeer::DATABASE_NAME);
        $updateCriteria = new Criteria(self::DATABASE_NAME);
        $updateCriteria->add(UserPeer::DELETED_AT, time());

         return BasePeer::doUpdate($selectCriteria, $updateCriteria, $con);
    }

    /**
     * Delete or soft delete records, depending on UserPeer::$softDelete
     *
     * @param			 mixed $values Criteria or User object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDelete($values, PropelPDO $con = null)
    {
        if (UserPeer::isSoftDeleteEnabled()) {
            return UserPeer::doSoftDelete($values, $con);
        } else {
            return UserPeer::doForceDelete($values, $con);
        }
    }
    /**
     * Method to soft delete all rows from the users_user table.
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $selectCriteria = new Criteria();
        $selectCriteria->add(UserPeer::DELETED_AT, null, Criteria::ISNULL);
        $selectCriteria->setDbName(UserPeer::DATABASE_NAME);
        $modifyCriteria = new Criteria();
        $modifyCriteria->add(UserPeer::DELETED_AT, time());

        return BasePeer::doUpdate($selectCriteria, $modifyCriteria, $con);
    }

    /**
     * Delete or soft delete all records, depending on UserPeer::$softDelete
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if (UserPeer::isSoftDeleteEnabled()) {
            return UserPeer::doSoftDeleteAll($con);
        } else {
            return UserPeer::doForceDeleteAll($con);
        }
    }

} // BaseUserPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUserPeer::buildTableMap();

