<?php


/**
 * Base static class for performing query and update operations on the 'requirements_development' table.
 *
 * Desarrollo
 *
 * @package propel.generator.requirements.classes.om
 */
abstract class BaseDevelopmentPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'requirements_development';

    /** the related Propel class for this table */
    const OM_CLASS = 'Development';

    /** the related TableMap class for this table */
    const TM_CLASS = 'DevelopmentTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 18;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 18;

    /** the column name for the ID field */
    const ID = 'requirements_development.ID';

    /** the column name for the NAME field */
    const NAME = 'requirements_development.NAME';

    /** the column name for the DESCRIPTION field */
    const DESCRIPTION = 'requirements_development.DESCRIPTION';

    /** the column name for the OUTPUT field */
    const OUTPUT = 'requirements_development.OUTPUT';

    /** the column name for the INPUT field */
    const INPUT = 'requirements_development.INPUT';

    /** the column name for the PROCESS field */
    const PROCESS = 'requirements_development.PROCESS';

    /** the column name for the OTHER field */
    const OTHER = 'requirements_development.OTHER';

    /** the column name for the ESTIMATEDDELIVERY field */
    const ESTIMATEDDELIVERY = 'requirements_development.ESTIMATEDDELIVERY';

    /** the column name for the REALDELIVERY field */
    const REALDELIVERY = 'requirements_development.REALDELIVERY';

    /** the column name for the DELIVERED field */
    const DELIVERED = 'requirements_development.DELIVERED';

    /** the column name for the CLIENTID field */
    const CLIENTID = 'requirements_development.CLIENTID';

    /** the column name for the ESTIMATEDHOURS field */
    const ESTIMATEDHOURS = 'requirements_development.ESTIMATEDHOURS';

    /** the column name for the ESTIMATEDCOST field */
    const ESTIMATEDCOST = 'requirements_development.ESTIMATEDCOST';

    /** the column name for the REALHOURS field */
    const REALHOURS = 'requirements_development.REALHOURS';

    /** the column name for the REALCOST field */
    const REALCOST = 'requirements_development.REALCOST';

    /** the column name for the QUOTATION field */
    const QUOTATION = 'requirements_development.QUOTATION';

    /** the column name for the CREATED_AT field */
    const CREATED_AT = 'requirements_development.CREATED_AT';

    /** the column name for the UPDATED_AT field */
    const UPDATED_AT = 'requirements_development.UPDATED_AT';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Development objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Development[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. DevelopmentPeer::$fieldNames[DevelopmentPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'Output', 'Input', 'Process', 'Other', 'Estimateddelivery', 'Realdelivery', 'Delivered', 'Clientid', 'Estimatedhours', 'Estimatedcost', 'Realhours', 'Realcost', 'Quotation', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'description', 'output', 'input', 'process', 'other', 'estimateddelivery', 'realdelivery', 'delivered', 'clientid', 'estimatedhours', 'estimatedcost', 'realhours', 'realcost', 'quotation', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (DevelopmentPeer::ID, DevelopmentPeer::NAME, DevelopmentPeer::DESCRIPTION, DevelopmentPeer::OUTPUT, DevelopmentPeer::INPUT, DevelopmentPeer::PROCESS, DevelopmentPeer::OTHER, DevelopmentPeer::ESTIMATEDDELIVERY, DevelopmentPeer::REALDELIVERY, DevelopmentPeer::DELIVERED, DevelopmentPeer::CLIENTID, DevelopmentPeer::ESTIMATEDHOURS, DevelopmentPeer::ESTIMATEDCOST, DevelopmentPeer::REALHOURS, DevelopmentPeer::REALCOST, DevelopmentPeer::QUOTATION, DevelopmentPeer::CREATED_AT, DevelopmentPeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NAME', 'DESCRIPTION', 'OUTPUT', 'INPUT', 'PROCESS', 'OTHER', 'ESTIMATEDDELIVERY', 'REALDELIVERY', 'DELIVERED', 'CLIENTID', 'ESTIMATEDHOURS', 'ESTIMATEDCOST', 'REALHOURS', 'REALCOST', 'QUOTATION', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'output', 'input', 'process', 'other', 'estimatedDelivery', 'realDelivery', 'delivered', 'clientId', 'estimatedHours', 'estimatedCost', 'realHours', 'realCost', 'quotation', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. DevelopmentPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'Output' => 3, 'Input' => 4, 'Process' => 5, 'Other' => 6, 'Estimateddelivery' => 7, 'Realdelivery' => 8, 'Delivered' => 9, 'Clientid' => 10, 'Estimatedhours' => 11, 'Estimatedcost' => 12, 'Realhours' => 13, 'Realcost' => 14, 'Quotation' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'output' => 3, 'input' => 4, 'process' => 5, 'other' => 6, 'estimateddelivery' => 7, 'realdelivery' => 8, 'delivered' => 9, 'clientid' => 10, 'estimatedhours' => 11, 'estimatedcost' => 12, 'realhours' => 13, 'realcost' => 14, 'quotation' => 15, 'createdAt' => 16, 'updatedAt' => 17, ),
        BasePeer::TYPE_COLNAME => array (DevelopmentPeer::ID => 0, DevelopmentPeer::NAME => 1, DevelopmentPeer::DESCRIPTION => 2, DevelopmentPeer::OUTPUT => 3, DevelopmentPeer::INPUT => 4, DevelopmentPeer::PROCESS => 5, DevelopmentPeer::OTHER => 6, DevelopmentPeer::ESTIMATEDDELIVERY => 7, DevelopmentPeer::REALDELIVERY => 8, DevelopmentPeer::DELIVERED => 9, DevelopmentPeer::CLIENTID => 10, DevelopmentPeer::ESTIMATEDHOURS => 11, DevelopmentPeer::ESTIMATEDCOST => 12, DevelopmentPeer::REALHOURS => 13, DevelopmentPeer::REALCOST => 14, DevelopmentPeer::QUOTATION => 15, DevelopmentPeer::CREATED_AT => 16, DevelopmentPeer::UPDATED_AT => 17, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NAME' => 1, 'DESCRIPTION' => 2, 'OUTPUT' => 3, 'INPUT' => 4, 'PROCESS' => 5, 'OTHER' => 6, 'ESTIMATEDDELIVERY' => 7, 'REALDELIVERY' => 8, 'DELIVERED' => 9, 'CLIENTID' => 10, 'ESTIMATEDHOURS' => 11, 'ESTIMATEDCOST' => 12, 'REALHOURS' => 13, 'REALCOST' => 14, 'QUOTATION' => 15, 'CREATED_AT' => 16, 'UPDATED_AT' => 17, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'output' => 3, 'input' => 4, 'process' => 5, 'other' => 6, 'estimatedDelivery' => 7, 'realDelivery' => 8, 'delivered' => 9, 'clientId' => 10, 'estimatedHours' => 11, 'estimatedCost' => 12, 'realHours' => 13, 'realCost' => 14, 'quotation' => 15, 'created_at' => 16, 'updated_at' => 17, ),
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
        $toNames = DevelopmentPeer::getFieldNames($toType);
        $key = isset(DevelopmentPeer::$fieldKeys[$fromType][$name]) ? DevelopmentPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(DevelopmentPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, DevelopmentPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return DevelopmentPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. DevelopmentPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(DevelopmentPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(DevelopmentPeer::ID);
            $criteria->addSelectColumn(DevelopmentPeer::NAME);
            $criteria->addSelectColumn(DevelopmentPeer::DESCRIPTION);
            $criteria->addSelectColumn(DevelopmentPeer::OUTPUT);
            $criteria->addSelectColumn(DevelopmentPeer::INPUT);
            $criteria->addSelectColumn(DevelopmentPeer::PROCESS);
            $criteria->addSelectColumn(DevelopmentPeer::OTHER);
            $criteria->addSelectColumn(DevelopmentPeer::ESTIMATEDDELIVERY);
            $criteria->addSelectColumn(DevelopmentPeer::REALDELIVERY);
            $criteria->addSelectColumn(DevelopmentPeer::DELIVERED);
            $criteria->addSelectColumn(DevelopmentPeer::CLIENTID);
            $criteria->addSelectColumn(DevelopmentPeer::ESTIMATEDHOURS);
            $criteria->addSelectColumn(DevelopmentPeer::ESTIMATEDCOST);
            $criteria->addSelectColumn(DevelopmentPeer::REALHOURS);
            $criteria->addSelectColumn(DevelopmentPeer::REALCOST);
            $criteria->addSelectColumn(DevelopmentPeer::QUOTATION);
            $criteria->addSelectColumn(DevelopmentPeer::CREATED_AT);
            $criteria->addSelectColumn(DevelopmentPeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.OUTPUT');
            $criteria->addSelectColumn($alias . '.INPUT');
            $criteria->addSelectColumn($alias . '.PROCESS');
            $criteria->addSelectColumn($alias . '.OTHER');
            $criteria->addSelectColumn($alias . '.ESTIMATEDDELIVERY');
            $criteria->addSelectColumn($alias . '.REALDELIVERY');
            $criteria->addSelectColumn($alias . '.DELIVERED');
            $criteria->addSelectColumn($alias . '.CLIENTID');
            $criteria->addSelectColumn($alias . '.ESTIMATEDHOURS');
            $criteria->addSelectColumn($alias . '.ESTIMATEDCOST');
            $criteria->addSelectColumn($alias . '.REALHOURS');
            $criteria->addSelectColumn($alias . '.REALCOST');
            $criteria->addSelectColumn($alias . '.QUOTATION');
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
        $criteria->setPrimaryTableName(DevelopmentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevelopmentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Development
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = DevelopmentPeer::doSelect($critcopy, $con);
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
        return DevelopmentPeer::populateObjects(DevelopmentPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            DevelopmentPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);

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
     * @param      Development $obj A Development object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            DevelopmentPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Development object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Development) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Development object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(DevelopmentPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Development Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(DevelopmentPeer::$instances[$key])) {
                return DevelopmentPeer::$instances[$key];
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
        DevelopmentPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to requirements_development
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in RequirementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        RequirementPeer::clearInstancePool();
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
        $cls = DevelopmentPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = DevelopmentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = DevelopmentPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DevelopmentPeer::addInstanceToPool($obj, $key);
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
     * @return array (Development object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = DevelopmentPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = DevelopmentPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + DevelopmentPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DevelopmentPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            DevelopmentPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Affiliate table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAffiliate(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(DevelopmentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevelopmentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevelopmentPeer::CLIENTID, AffiliatePeer::ID, $join_behavior);

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
     * Selects a collection of Development objects pre-filled with their Affiliate objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Development objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAffiliate(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);
        }

        DevelopmentPeer::addSelectColumns($criteria);
        $startcol = DevelopmentPeer::NUM_HYDRATE_COLUMNS;
        AffiliatePeer::addSelectColumns($criteria);

        $criteria->addJoin(DevelopmentPeer::CLIENTID, AffiliatePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevelopmentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevelopmentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = DevelopmentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevelopmentPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = AffiliatePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = AffiliatePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $omClass = AffiliatePeer::getOMClass($row, $startcol);
                    $cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    AffiliatePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Development) to $obj2 (Affiliate)
                $obj2->addDevelopment($obj1);

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
        $criteria->setPrimaryTableName(DevelopmentPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DevelopmentPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DevelopmentPeer::CLIENTID, AffiliatePeer::ID, $join_behavior);

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
     * Selects a collection of Development objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Development objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);
        }

        DevelopmentPeer::addSelectColumns($criteria);
        $startcol2 = DevelopmentPeer::NUM_HYDRATE_COLUMNS;

        AffiliatePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + AffiliatePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(DevelopmentPeer::CLIENTID, AffiliatePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DevelopmentPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DevelopmentPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = DevelopmentPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DevelopmentPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Affiliate rows

            $key2 = AffiliatePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = AffiliatePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $omClass = AffiliatePeer::getOMClass($row, $startcol2);
          $cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    AffiliatePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Development) to the collection in $obj2 (Affiliate)
                $obj2->addDevelopment($obj1);
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
        return Propel::getDatabaseMap(DevelopmentPeer::DATABASE_NAME)->getTable(DevelopmentPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseDevelopmentPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseDevelopmentPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new DevelopmentTableMap());
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
        return DevelopmentPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Development or Criteria object.
     *
     * @param      mixed $values Criteria or Development object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Development object
        }

        if ($criteria->containsKey(DevelopmentPeer::ID) && $criteria->keyContainsValue(DevelopmentPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DevelopmentPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Development or Criteria object.
     *
     * @param      mixed $values Criteria or Development object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(DevelopmentPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(DevelopmentPeer::ID);
            $value = $criteria->remove(DevelopmentPeer::ID);
            if ($value) {
                $selectCriteria->add(DevelopmentPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(DevelopmentPeer::TABLE_NAME);
            }

        } else { // $values is Development object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the requirements_development table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += DevelopmentPeer::doOnDeleteCascade(new Criteria(DevelopmentPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(DevelopmentPeer::TABLE_NAME, $con, DevelopmentPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DevelopmentPeer::clearInstancePool();
            DevelopmentPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Development or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Development object or primary key or array of primary keys
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
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Development) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DevelopmentPeer::DATABASE_NAME);
            $criteria->add(DevelopmentPeer::ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(DevelopmentPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += DevelopmentPeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                DevelopmentPeer::clearInstancePool();
            } elseif ($values instanceof Development) { // it's a model object
                DevelopmentPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    DevelopmentPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            DevelopmentPeer::clearRelatedInstancePool();
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
        $objects = DevelopmentPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related Requirement objects
            $criteria = new Criteria(RequirementPeer::DATABASE_NAME);

            $criteria->add(RequirementPeer::DEVELOPMENTID, $obj->getId());
            $affectedRows += RequirementPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given Development object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Development $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(DevelopmentPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(DevelopmentPeer::TABLE_NAME);

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

        return BasePeer::doValidate(DevelopmentPeer::DATABASE_NAME, DevelopmentPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Development
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = DevelopmentPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(DevelopmentPeer::DATABASE_NAME);
        $criteria->add(DevelopmentPeer::ID, $pk);

        $v = DevelopmentPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Development[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(DevelopmentPeer::DATABASE_NAME);
            $criteria->add(DevelopmentPeer::ID, $pks, Criteria::IN);
            $objs = DevelopmentPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseDevelopmentPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseDevelopmentPeer::buildTableMap();

