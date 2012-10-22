<?php


/**
 * Base static class for performing query and update operations on the 'services_internalMail' table.
 *
 * Mensajes internos
 *
 * @package propel.generator.services.classes.om
 */
abstract class BaseInternalMailPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'services_internalMail';

    /** the related Propel class for this table */
    const OM_CLASS = 'InternalMail';

    /** the related TableMap class for this table */
    const TM_CLASS = 'InternalMailTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 13;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 13;

    /** the column name for the ID field */
    const ID = 'services_internalMail.ID';

    /** the column name for the SUBJECT field */
    const SUBJECT = 'services_internalMail.SUBJECT';

    /** the column name for the BODY field */
    const BODY = 'services_internalMail.BODY';

    /** the column name for the RECIPIENTID field */
    const RECIPIENTID = 'services_internalMail.RECIPIENTID';

    /** the column name for the RECIPIENTTYPE field */
    const RECIPIENTTYPE = 'services_internalMail.RECIPIENTTYPE';

    /** the column name for the READON field */
    const READON = 'services_internalMail.READON';

    /** the column name for the FROMID field */
    const FROMID = 'services_internalMail.FROMID';

    /** the column name for the FROMTYPE field */
    const FROMTYPE = 'services_internalMail.FROMTYPE';

    /** the column name for the TO field */
    const TO = 'services_internalMail.TO';

    /** the column name for the REPLYID field */
    const REPLYID = 'services_internalMail.REPLYID';

    /** the column name for the CREATED_AT field */
    const CREATED_AT = 'services_internalMail.CREATED_AT';

    /** the column name for the UPDATED_AT field */
    const UPDATED_AT = 'services_internalMail.UPDATED_AT';

    /** the column name for the DELETED_AT field */
    const DELETED_AT = 'services_internalMail.DELETED_AT';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of InternalMail objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array InternalMail[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. InternalMailPeer::$fieldNames[InternalMailPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Subject', 'Body', 'Recipientid', 'Recipienttype', 'Readon', 'Fromid', 'Fromtype', 'To', 'Replyid', 'CreatedAt', 'UpdatedAt', 'DeletedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'subject', 'body', 'recipientid', 'recipienttype', 'readon', 'fromid', 'fromtype', 'to', 'replyid', 'createdAt', 'updatedAt', 'deletedAt', ),
        BasePeer::TYPE_COLNAME => array (InternalMailPeer::ID, InternalMailPeer::SUBJECT, InternalMailPeer::BODY, InternalMailPeer::RECIPIENTID, InternalMailPeer::RECIPIENTTYPE, InternalMailPeer::READON, InternalMailPeer::FROMID, InternalMailPeer::FROMTYPE, InternalMailPeer::TO, InternalMailPeer::REPLYID, InternalMailPeer::CREATED_AT, InternalMailPeer::UPDATED_AT, InternalMailPeer::DELETED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'SUBJECT', 'BODY', 'RECIPIENTID', 'RECIPIENTTYPE', 'READON', 'FROMID', 'FROMTYPE', 'TO', 'REPLYID', 'CREATED_AT', 'UPDATED_AT', 'DELETED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'subject', 'body', 'recipientId', 'recipientType', 'readOn', 'fromId', 'fromType', 'to', 'replyId', 'created_at', 'updated_at', 'deleted_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. InternalMailPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Subject' => 1, 'Body' => 2, 'Recipientid' => 3, 'Recipienttype' => 4, 'Readon' => 5, 'Fromid' => 6, 'Fromtype' => 7, 'To' => 8, 'Replyid' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, 'DeletedAt' => 12, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'subject' => 1, 'body' => 2, 'recipientid' => 3, 'recipienttype' => 4, 'readon' => 5, 'fromid' => 6, 'fromtype' => 7, 'to' => 8, 'replyid' => 9, 'createdAt' => 10, 'updatedAt' => 11, 'deletedAt' => 12, ),
        BasePeer::TYPE_COLNAME => array (InternalMailPeer::ID => 0, InternalMailPeer::SUBJECT => 1, InternalMailPeer::BODY => 2, InternalMailPeer::RECIPIENTID => 3, InternalMailPeer::RECIPIENTTYPE => 4, InternalMailPeer::READON => 5, InternalMailPeer::FROMID => 6, InternalMailPeer::FROMTYPE => 7, InternalMailPeer::TO => 8, InternalMailPeer::REPLYID => 9, InternalMailPeer::CREATED_AT => 10, InternalMailPeer::UPDATED_AT => 11, InternalMailPeer::DELETED_AT => 12, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'SUBJECT' => 1, 'BODY' => 2, 'RECIPIENTID' => 3, 'RECIPIENTTYPE' => 4, 'READON' => 5, 'FROMID' => 6, 'FROMTYPE' => 7, 'TO' => 8, 'REPLYID' => 9, 'CREATED_AT' => 10, 'UPDATED_AT' => 11, 'DELETED_AT' => 12, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'subject' => 1, 'body' => 2, 'recipientId' => 3, 'recipientType' => 4, 'readOn' => 5, 'fromId' => 6, 'fromType' => 7, 'to' => 8, 'replyId' => 9, 'created_at' => 10, 'updated_at' => 11, 'deleted_at' => 12, ),
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
        $toNames = InternalMailPeer::getFieldNames($toType);
        $key = isset(InternalMailPeer::$fieldKeys[$fromType][$name]) ? InternalMailPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(InternalMailPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, InternalMailPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return InternalMailPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. InternalMailPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(InternalMailPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(InternalMailPeer::ID);
            $criteria->addSelectColumn(InternalMailPeer::SUBJECT);
            $criteria->addSelectColumn(InternalMailPeer::BODY);
            $criteria->addSelectColumn(InternalMailPeer::RECIPIENTID);
            $criteria->addSelectColumn(InternalMailPeer::RECIPIENTTYPE);
            $criteria->addSelectColumn(InternalMailPeer::READON);
            $criteria->addSelectColumn(InternalMailPeer::FROMID);
            $criteria->addSelectColumn(InternalMailPeer::FROMTYPE);
            $criteria->addSelectColumn(InternalMailPeer::TO);
            $criteria->addSelectColumn(InternalMailPeer::REPLYID);
            $criteria->addSelectColumn(InternalMailPeer::CREATED_AT);
            $criteria->addSelectColumn(InternalMailPeer::UPDATED_AT);
            $criteria->addSelectColumn(InternalMailPeer::DELETED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.SUBJECT');
            $criteria->addSelectColumn($alias . '.BODY');
            $criteria->addSelectColumn($alias . '.RECIPIENTID');
            $criteria->addSelectColumn($alias . '.RECIPIENTTYPE');
            $criteria->addSelectColumn($alias . '.READON');
            $criteria->addSelectColumn($alias . '.FROMID');
            $criteria->addSelectColumn($alias . '.FROMTYPE');
            $criteria->addSelectColumn($alias . '.TO');
            $criteria->addSelectColumn($alias . '.REPLYID');
            $criteria->addSelectColumn($alias . '.CREATED_AT');
            $criteria->addSelectColumn($alias . '.UPDATED_AT');
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
        $criteria->setPrimaryTableName(InternalMailPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            InternalMailPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(InternalMailPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // soft_delete behavior
        if (InternalMailQuery::isSoftDeleteEnabled()) {
            $criteria->add(InternalMailPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            InternalMailPeer::enableSoftDelete();
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
     * @return                 InternalMail
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = InternalMailPeer::doSelect($critcopy, $con);
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
        return InternalMailPeer::populateObjects(InternalMailPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            InternalMailPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(InternalMailPeer::DATABASE_NAME);
        // soft_delete behavior
        if (InternalMailQuery::isSoftDeleteEnabled()) {
            $criteria->add(InternalMailPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            InternalMailPeer::enableSoftDelete();
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
     * @param      InternalMail $obj A InternalMail object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            InternalMailPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A InternalMail object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof InternalMail) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InternalMail object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(InternalMailPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   InternalMail Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(InternalMailPeer::$instances[$key])) {
                return InternalMailPeer::$instances[$key];
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
        InternalMailPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to services_internalMail
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
        $cls = InternalMailPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = InternalMailPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = InternalMailPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                InternalMailPeer::addInstanceToPool($obj, $key);
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
     * @return array (InternalMail object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = InternalMailPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = InternalMailPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + InternalMailPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = InternalMailPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            InternalMailPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        $criteria->setPrimaryTableName(InternalMailPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            InternalMailPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(InternalMailPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // soft_delete behavior
        if (InternalMailQuery::isSoftDeleteEnabled()) {
            $criteria->add(InternalMailPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            InternalMailPeer::enableSoftDelete();
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
     * Selects a collection of InternalMail objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of InternalMail objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(InternalMailPeer::DATABASE_NAME);
        }

        InternalMailPeer::addSelectColumns($criteria);
        $startcol2 = InternalMailPeer::NUM_HYDRATE_COLUMNS;

        // soft_delete behavior
        if (InternalMailQuery::isSoftDeleteEnabled()) {
            $criteria->add(InternalMailPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            InternalMailPeer::enableSoftDelete();
        }
        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = InternalMailPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = InternalMailPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = InternalMailPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                InternalMailPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

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
        return Propel::getDatabaseMap(InternalMailPeer::DATABASE_NAME)->getTable(InternalMailPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseInternalMailPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseInternalMailPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new InternalMailTableMap());
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
        return InternalMailPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a InternalMail or Criteria object.
     *
     * @param      mixed $values Criteria or InternalMail object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from InternalMail object
        }

        if ($criteria->containsKey(InternalMailPeer::ID) && $criteria->keyContainsValue(InternalMailPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.InternalMailPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(InternalMailPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a InternalMail or Criteria object.
     *
     * @param      mixed $values Criteria or InternalMail object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(InternalMailPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(InternalMailPeer::ID);
            $value = $criteria->remove(InternalMailPeer::ID);
            if ($value) {
                $selectCriteria->add(InternalMailPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(InternalMailPeer::TABLE_NAME);
            }

        } else { // $values is InternalMail object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(InternalMailPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the services_internalMail table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doForceDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(InternalMailPeer::TABLE_NAME, $con, InternalMailPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InternalMailPeer::clearInstancePool();
            InternalMailPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a InternalMail or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or InternalMail object or primary key or array of primary keys
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
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            InternalMailPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof InternalMail) { // it's a model object
            // invalidate the cache for this single object
            InternalMailPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(InternalMailPeer::DATABASE_NAME);
            $criteria->add(InternalMailPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                InternalMailPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(InternalMailPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            InternalMailPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given InternalMail object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      InternalMail $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(InternalMailPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(InternalMailPeer::TABLE_NAME);

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

        return BasePeer::doValidate(InternalMailPeer::DATABASE_NAME, InternalMailPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return InternalMail
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = InternalMailPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(InternalMailPeer::DATABASE_NAME);
        $criteria->add(InternalMailPeer::ID, $pk);

        $v = InternalMailPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return InternalMail[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(InternalMailPeer::DATABASE_NAME);
            $criteria->add(InternalMailPeer::ID, $pks, Criteria::IN);
            $objs = InternalMailPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // soft_delete behavior

    /**
     * Enable the soft_delete behavior for this model
     */
    public static function enableSoftDelete()
    {
        InternalMailQuery::enableSoftDelete();
        // some soft_deleted objects may be in the instance pool
        InternalMailPeer::clearInstancePool();
    }

    /**
     * Disable the soft_delete behavior for this model
     */
    public static function disableSoftDelete()
    {
        InternalMailQuery::disableSoftDelete();
    }

    /**
     * Check the soft_delete behavior for this model
     * @return boolean true if the soft_delete behavior is enabled
     */
    public static function isSoftDeleteEnabled()
    {
        return InternalMailQuery::isSoftDeleteEnabled();
    }

    /**
     * Soft delete records, given a InternalMail or Criteria object OR a primary key value.
     *
     * @param			 mixed $values Criteria or InternalMail object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDelete($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        if ($values instanceof Criteria) {
            // rename for clarity
            $selectCriteria = clone $values;
         } elseif ($values instanceof InternalMail) {
            // create criteria based on pk values
            $selectCriteria = $values->buildPkeyCriteria();
        } else {
            // it must be the primary key
            $selectCriteria = new Criteria(self::DATABASE_NAME);
             $selectCriteria->add(InternalMailPeer::ID, (array) $values, Criteria::IN);
        }
        // Set the correct dbName
        $selectCriteria->setDbName(InternalMailPeer::DATABASE_NAME);
        $updateCriteria = new Criteria(self::DATABASE_NAME);
        $updateCriteria->add(InternalMailPeer::DELETED_AT, time());

         return BasePeer::doUpdate($selectCriteria, $updateCriteria, $con);
    }

    /**
     * Delete or soft delete records, depending on InternalMailPeer::$softDelete
     *
     * @param			 mixed $values Criteria or InternalMail object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDelete($values, PropelPDO $con = null)
    {
        if (InternalMailPeer::isSoftDeleteEnabled()) {
            return InternalMailPeer::doSoftDelete($values, $con);
        } else {
            return InternalMailPeer::doForceDelete($values, $con);
        }
    }
    /**
     * Method to soft delete all rows from the services_internalMail table.
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $selectCriteria = new Criteria();
        $selectCriteria->add(InternalMailPeer::DELETED_AT, null, Criteria::ISNULL);
        $selectCriteria->setDbName(InternalMailPeer::DATABASE_NAME);
        $modifyCriteria = new Criteria();
        $modifyCriteria->add(InternalMailPeer::DELETED_AT, time());

        return BasePeer::doUpdate($selectCriteria, $modifyCriteria, $con);
    }

    /**
     * Delete or soft delete all records, depending on InternalMailPeer::$softDelete
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if (InternalMailPeer::isSoftDeleteEnabled()) {
            return InternalMailPeer::doSoftDeleteAll($con);
        } else {
            return InternalMailPeer::doForceDeleteAll($con);
        }
    }

} // BaseInternalMailPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseInternalMailPeer::buildTableMap();

