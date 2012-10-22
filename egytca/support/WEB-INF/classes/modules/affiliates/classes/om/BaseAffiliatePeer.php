<?php


/**
 * Base static class for performing query and update operations on the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * @package propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliatePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'affiliates_affiliate';

    /** the related Propel class for this table */
    const OM_CLASS = 'Affiliate';

    /** the related TableMap class for this table */
    const TM_CLASS = 'AffiliateTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 14;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 14;

    /** the column name for the ID field */
    const ID = 'affiliates_affiliate.ID';

    /** the column name for the NAME field */
    const NAME = 'affiliates_affiliate.NAME';

    /** the column name for the OWNERID field */
    const OWNERID = 'affiliates_affiliate.OWNERID';

    /** the column name for the INTERNALNUMBER field */
    const INTERNALNUMBER = 'affiliates_affiliate.INTERNALNUMBER';

    /** the column name for the ADDRESS field */
    const ADDRESS = 'affiliates_affiliate.ADDRESS';

    /** the column name for the PHONE field */
    const PHONE = 'affiliates_affiliate.PHONE';

    /** the column name for the EMAIL field */
    const EMAIL = 'affiliates_affiliate.EMAIL';

    /** the column name for the CONTACT field */
    const CONTACT = 'affiliates_affiliate.CONTACT';

    /** the column name for the CONTACTEMAIL field */
    const CONTACTEMAIL = 'affiliates_affiliate.CONTACTEMAIL';

    /** the column name for the WEB field */
    const WEB = 'affiliates_affiliate.WEB';

    /** the column name for the MEMO field */
    const MEMO = 'affiliates_affiliate.MEMO';

    /** the column name for the CLASS_KEY field */
    const CLASS_KEY = 'affiliates_affiliate.CLASS_KEY';

    /** the column name for the CREATED_AT field */
    const CREATED_AT = 'affiliates_affiliate.CREATED_AT';

    /** the column name for the UPDATED_AT field */
    const UPDATED_AT = 'affiliates_affiliate.UPDATED_AT';

    /** A key representing a particular subclass */
    const CLASSKEY_1 = '1';

    /** A key representing a particular subclass */
    const CLASSKEY_AFFILIATE = '1';

    /** A class that can be returned by this peer. */
    const CLASSNAME_1 = 'Affiliate';

    /** A key representing a particular subclass */
    const CLASSKEY_2 = '2';

    /** A key representing a particular subclass */
    const CLASSKEY_CLIENT = '2';

    /** A class that can be returned by this peer. */
    const CLASSNAME_2 = 'Client';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Affiliate objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Affiliate[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. AffiliatePeer::$fieldNames[AffiliatePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Ownerid', 'Internalnumber', 'Address', 'Phone', 'Email', 'Contact', 'Contactemail', 'Web', 'Memo', 'ClassKey', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'ownerid', 'internalnumber', 'address', 'phone', 'email', 'contact', 'contactemail', 'web', 'memo', 'classKey', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (AffiliatePeer::ID, AffiliatePeer::NAME, AffiliatePeer::OWNERID, AffiliatePeer::INTERNALNUMBER, AffiliatePeer::ADDRESS, AffiliatePeer::PHONE, AffiliatePeer::EMAIL, AffiliatePeer::CONTACT, AffiliatePeer::CONTACTEMAIL, AffiliatePeer::WEB, AffiliatePeer::MEMO, AffiliatePeer::CLASS_KEY, AffiliatePeer::CREATED_AT, AffiliatePeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NAME', 'OWNERID', 'INTERNALNUMBER', 'ADDRESS', 'PHONE', 'EMAIL', 'CONTACT', 'CONTACTEMAIL', 'WEB', 'MEMO', 'CLASS_KEY', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'ownerId', 'internalNumber', 'address', 'phone', 'email', 'contact', 'contactEmail', 'web', 'memo', 'class_key', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. AffiliatePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Ownerid' => 2, 'Internalnumber' => 3, 'Address' => 4, 'Phone' => 5, 'Email' => 6, 'Contact' => 7, 'Contactemail' => 8, 'Web' => 9, 'Memo' => 10, 'ClassKey' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'ownerid' => 2, 'internalnumber' => 3, 'address' => 4, 'phone' => 5, 'email' => 6, 'contact' => 7, 'contactemail' => 8, 'web' => 9, 'memo' => 10, 'classKey' => 11, 'createdAt' => 12, 'updatedAt' => 13, ),
        BasePeer::TYPE_COLNAME => array (AffiliatePeer::ID => 0, AffiliatePeer::NAME => 1, AffiliatePeer::OWNERID => 2, AffiliatePeer::INTERNALNUMBER => 3, AffiliatePeer::ADDRESS => 4, AffiliatePeer::PHONE => 5, AffiliatePeer::EMAIL => 6, AffiliatePeer::CONTACT => 7, AffiliatePeer::CONTACTEMAIL => 8, AffiliatePeer::WEB => 9, AffiliatePeer::MEMO => 10, AffiliatePeer::CLASS_KEY => 11, AffiliatePeer::CREATED_AT => 12, AffiliatePeer::UPDATED_AT => 13, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NAME' => 1, 'OWNERID' => 2, 'INTERNALNUMBER' => 3, 'ADDRESS' => 4, 'PHONE' => 5, 'EMAIL' => 6, 'CONTACT' => 7, 'CONTACTEMAIL' => 8, 'WEB' => 9, 'MEMO' => 10, 'CLASS_KEY' => 11, 'CREATED_AT' => 12, 'UPDATED_AT' => 13, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'ownerId' => 2, 'internalNumber' => 3, 'address' => 4, 'phone' => 5, 'email' => 6, 'contact' => 7, 'contactEmail' => 8, 'web' => 9, 'memo' => 10, 'class_key' => 11, 'created_at' => 12, 'updated_at' => 13, ),
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
        $toNames = AffiliatePeer::getFieldNames($toType);
        $key = isset(AffiliatePeer::$fieldKeys[$fromType][$name]) ? AffiliatePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(AffiliatePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, AffiliatePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return AffiliatePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. AffiliatePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(AffiliatePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(AffiliatePeer::ID);
            $criteria->addSelectColumn(AffiliatePeer::NAME);
            $criteria->addSelectColumn(AffiliatePeer::OWNERID);
            $criteria->addSelectColumn(AffiliatePeer::INTERNALNUMBER);
            $criteria->addSelectColumn(AffiliatePeer::ADDRESS);
            $criteria->addSelectColumn(AffiliatePeer::PHONE);
            $criteria->addSelectColumn(AffiliatePeer::EMAIL);
            $criteria->addSelectColumn(AffiliatePeer::CONTACT);
            $criteria->addSelectColumn(AffiliatePeer::CONTACTEMAIL);
            $criteria->addSelectColumn(AffiliatePeer::WEB);
            $criteria->addSelectColumn(AffiliatePeer::MEMO);
            $criteria->addSelectColumn(AffiliatePeer::CLASS_KEY);
            $criteria->addSelectColumn(AffiliatePeer::CREATED_AT);
            $criteria->addSelectColumn(AffiliatePeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.OWNERID');
            $criteria->addSelectColumn($alias . '.INTERNALNUMBER');
            $criteria->addSelectColumn($alias . '.ADDRESS');
            $criteria->addSelectColumn($alias . '.PHONE');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.CONTACT');
            $criteria->addSelectColumn($alias . '.CONTACTEMAIL');
            $criteria->addSelectColumn($alias . '.WEB');
            $criteria->addSelectColumn($alias . '.MEMO');
            $criteria->addSelectColumn($alias . '.CLASS_KEY');
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
        $criteria->setPrimaryTableName(AffiliatePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            AffiliatePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Affiliate
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = AffiliatePeer::doSelect($critcopy, $con);
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
        return AffiliatePeer::populateObjects(AffiliatePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            AffiliatePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME);

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
     * @param      Affiliate $obj A Affiliate object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            AffiliatePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Affiliate object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Affiliate) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Affiliate object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(AffiliatePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Affiliate Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(AffiliatePeer::$instances[$key])) {
                return AffiliatePeer::$instances[$key];
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
        AffiliatePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to affiliates_affiliate
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in RequirementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        RequirementPeer::clearInstancePool();
        // Invalidate objects in DevelopmentPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        DevelopmentPeer::clearInstancePool();
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

        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = AffiliatePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = AffiliatePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                // class must be set each time from the record row
                $cls = AffiliatePeer::getOMClass($row, 0);
                $cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AffiliatePeer::addInstanceToPool($obj, $key);
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
     * @return array (Affiliate object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = AffiliatePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = AffiliatePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + AffiliatePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AffiliatePeer::getOMClass($row, $startcol);
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            AffiliatePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related AffiliateUserRelatedByOwnerid table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAffiliateUserRelatedByOwnerid(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(AffiliatePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            AffiliatePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(AffiliatePeer::OWNERID, AffiliateUserPeer::ID, $join_behavior);

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
     * Selects a collection of Affiliate objects pre-filled with their AffiliateUser objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Affiliate objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAffiliateUserRelatedByOwnerid(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(AffiliatePeer::DATABASE_NAME);
        }

        AffiliatePeer::addSelectColumns($criteria);
        $startcol = AffiliatePeer::NUM_HYDRATE_COLUMNS;
        AffiliateUserPeer::addSelectColumns($criteria);

        $criteria->addJoin(AffiliatePeer::OWNERID, AffiliateUserPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = AffiliatePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = AffiliatePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $omClass = AffiliatePeer::getOMClass($row, 0);
                $cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);

                $obj1 = new $cls();
                $obj1->hydrate($row);
                AffiliatePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = AffiliateUserPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = AffiliateUserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = AffiliateUserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    AffiliateUserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Affiliate) to $obj2 (AffiliateUser)
                $obj2->addAffiliateRelatedByOwnerid($obj1);

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
        $criteria->setPrimaryTableName(AffiliatePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            AffiliatePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(AffiliatePeer::OWNERID, AffiliateUserPeer::ID, $join_behavior);

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
     * Selects a collection of Affiliate objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Affiliate objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(AffiliatePeer::DATABASE_NAME);
        }

        AffiliatePeer::addSelectColumns($criteria);
        $startcol2 = AffiliatePeer::NUM_HYDRATE_COLUMNS;

        AffiliateUserPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + AffiliateUserPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(AffiliatePeer::OWNERID, AffiliateUserPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = AffiliatePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = AffiliatePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $omClass = AffiliatePeer::getOMClass($row, 0);
        $cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);

                $obj1 = new $cls();
                $obj1->hydrate($row);
                AffiliatePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined AffiliateUser rows

            $key2 = AffiliateUserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = AffiliateUserPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = AffiliateUserPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    AffiliateUserPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Affiliate) to the collection in $obj2 (AffiliateUser)
                $obj2->addAffiliateRelatedByOwnerid($obj1);
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
        return Propel::getDatabaseMap(AffiliatePeer::DATABASE_NAME)->getTable(AffiliatePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseAffiliatePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseAffiliatePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new AffiliateTableMap());
      }
    }

    /**
     * The returned Class will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param      array $row PropelPDO result row.
     * @param      int $colnum Column to examine for OM class information (first is 0).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getOMClass($row, $colnum)
    {
        try {

            $omClass = null;
            $classKey = $row[$colnum + 11];

            switch ($classKey) {

                case AffiliatePeer::CLASSKEY_1:
                    $omClass = AffiliatePeer::CLASSNAME_1;
                    break;

                case AffiliatePeer::CLASSKEY_2:
                    $omClass = AffiliatePeer::CLASSNAME_2;
                    break;

                default:
                    $omClass = AffiliatePeer::OM_CLASS;

            } // switch

        } catch (Exception $e) {
            throw new PropelException('Unable to get OM class.', $e);
        }

        return $omClass;
    }

    /**
     * Performs an INSERT on the database, given a Affiliate or Criteria object.
     *
     * @param      mixed $values Criteria or Affiliate object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Affiliate object
        }

        if ($criteria->containsKey(AffiliatePeer::ID) && $criteria->keyContainsValue(AffiliatePeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AffiliatePeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Affiliate or Criteria object.
     *
     * @param      mixed $values Criteria or Affiliate object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(AffiliatePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(AffiliatePeer::ID);
            $value = $criteria->remove(AffiliatePeer::ID);
            if ($value) {
                $selectCriteria->add(AffiliatePeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(AffiliatePeer::TABLE_NAME);
            }

        } else { // $values is Affiliate object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the affiliates_affiliate table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += AffiliatePeer::doOnDeleteCascade(new Criteria(AffiliatePeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(AffiliatePeer::TABLE_NAME, $con, AffiliatePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AffiliatePeer::clearInstancePool();
            AffiliatePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Affiliate or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Affiliate object or primary key or array of primary keys
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
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Affiliate) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AffiliatePeer::DATABASE_NAME);
            $criteria->add(AffiliatePeer::ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(AffiliatePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += AffiliatePeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                AffiliatePeer::clearInstancePool();
            } elseif ($values instanceof Affiliate) { // it's a model object
                AffiliatePeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    AffiliatePeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            AffiliatePeer::clearRelatedInstancePool();
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
        $objects = AffiliatePeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related Requirement objects
            $criteria = new Criteria(RequirementPeer::DATABASE_NAME);

            $criteria->add(RequirementPeer::CLIENTID, $obj->getId());
            $affectedRows += RequirementPeer::doDelete($criteria, $con);

            // delete related Development objects
            $criteria = new Criteria(DevelopmentPeer::DATABASE_NAME);

            $criteria->add(DevelopmentPeer::CLIENTID, $obj->getId());
            $affectedRows += DevelopmentPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given Affiliate object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Affiliate $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(AffiliatePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(AffiliatePeer::TABLE_NAME);

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

        return BasePeer::doValidate(AffiliatePeer::DATABASE_NAME, AffiliatePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Affiliate
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = AffiliatePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(AffiliatePeer::DATABASE_NAME);
        $criteria->add(AffiliatePeer::ID, $pk);

        $v = AffiliatePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Affiliate[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(AffiliatePeer::DATABASE_NAME);
            $criteria->add(AffiliatePeer::ID, $pks, Criteria::IN);
            $objs = AffiliatePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseAffiliatePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseAffiliatePeer::buildTableMap();

