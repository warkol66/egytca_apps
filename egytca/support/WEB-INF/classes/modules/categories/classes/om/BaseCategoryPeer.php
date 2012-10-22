<?php


/**
 * Base static class for performing query and update operations on the 'categories_category' table.
 *
 * Categorias
 *
 * @package propel.generator.categories.classes.om
 */
abstract class BaseCategoryPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'application';

    /** the table name for this class */
    const TABLE_NAME = 'categories_category';

    /** the related Propel class for this table */
    const OM_CLASS = 'Category';

    /** the related TableMap class for this table */
    const TM_CLASS = 'CategoryTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 11;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 11;

    /** the column name for the ID field */
    const ID = 'categories_category.ID';

    /** the column name for the NAME field */
    const NAME = 'categories_category.NAME';

    /** the column name for the MODULE field */
    const MODULE = 'categories_category.MODULE';

    /** the column name for the ACTIVE field */
    const ACTIVE = 'categories_category.ACTIVE';

    /** the column name for the ISPUBLIC field */
    const ISPUBLIC = 'categories_category.ISPUBLIC';

    /** the column name for the RESPONSIBLE field */
    const RESPONSIBLE = 'categories_category.RESPONSIBLE';

    /** the column name for the DELETED_AT field */
    const DELETED_AT = 'categories_category.DELETED_AT';

    /** the column name for the TREE_LEFT field */
    const TREE_LEFT = 'categories_category.TREE_LEFT';

    /** the column name for the TREE_RIGHT field */
    const TREE_RIGHT = 'categories_category.TREE_RIGHT';

    /** the column name for the TREE_LEVEL field */
    const TREE_LEVEL = 'categories_category.TREE_LEVEL';

    /** the column name for the SCOPE field */
    const SCOPE = 'categories_category.SCOPE';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Category objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Category[]
     */
    public static $instances = array();


    // nested_set behavior

    /**
     * Left column for the set
     */
    const LEFT_COL = 'categories_category.TREE_LEFT';

    /**
     * Right column for the set
     */
    const RIGHT_COL = 'categories_category.TREE_RIGHT';

    /**
     * Level column for the set
     */
    const LEVEL_COL = 'categories_category.TREE_LEVEL';

    /**
     * Scope column for the set
     */
    const SCOPE_COL = 'categories_category.SCOPE';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. CategoryPeer::$fieldNames[CategoryPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Module', 'Active', 'Ispublic', 'Responsible', 'DeletedAt', 'TreeLeft', 'TreeRight', 'TreeLevel', 'Scope', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'name', 'module', 'active', 'ispublic', 'responsible', 'deletedAt', 'treeLeft', 'treeRight', 'treeLevel', 'scope', ),
        BasePeer::TYPE_COLNAME => array (CategoryPeer::ID, CategoryPeer::NAME, CategoryPeer::MODULE, CategoryPeer::ACTIVE, CategoryPeer::ISPUBLIC, CategoryPeer::RESPONSIBLE, CategoryPeer::DELETED_AT, CategoryPeer::TREE_LEFT, CategoryPeer::TREE_RIGHT, CategoryPeer::TREE_LEVEL, CategoryPeer::SCOPE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NAME', 'MODULE', 'ACTIVE', 'ISPUBLIC', 'RESPONSIBLE', 'DELETED_AT', 'TREE_LEFT', 'TREE_RIGHT', 'TREE_LEVEL', 'SCOPE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'module', 'active', 'isPublic', 'responsible', 'deleted_at', 'tree_left', 'tree_right', 'tree_level', 'scope', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. CategoryPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Module' => 2, 'Active' => 3, 'Ispublic' => 4, 'Responsible' => 5, 'DeletedAt' => 6, 'TreeLeft' => 7, 'TreeRight' => 8, 'TreeLevel' => 9, 'Scope' => 10, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'name' => 1, 'module' => 2, 'active' => 3, 'ispublic' => 4, 'responsible' => 5, 'deletedAt' => 6, 'treeLeft' => 7, 'treeRight' => 8, 'treeLevel' => 9, 'scope' => 10, ),
        BasePeer::TYPE_COLNAME => array (CategoryPeer::ID => 0, CategoryPeer::NAME => 1, CategoryPeer::MODULE => 2, CategoryPeer::ACTIVE => 3, CategoryPeer::ISPUBLIC => 4, CategoryPeer::RESPONSIBLE => 5, CategoryPeer::DELETED_AT => 6, CategoryPeer::TREE_LEFT => 7, CategoryPeer::TREE_RIGHT => 8, CategoryPeer::TREE_LEVEL => 9, CategoryPeer::SCOPE => 10, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NAME' => 1, 'MODULE' => 2, 'ACTIVE' => 3, 'ISPUBLIC' => 4, 'RESPONSIBLE' => 5, 'DELETED_AT' => 6, 'TREE_LEFT' => 7, 'TREE_RIGHT' => 8, 'TREE_LEVEL' => 9, 'SCOPE' => 10, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'module' => 2, 'active' => 3, 'isPublic' => 4, 'responsible' => 5, 'deleted_at' => 6, 'tree_left' => 7, 'tree_right' => 8, 'tree_level' => 9, 'scope' => 10, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $toNames = CategoryPeer::getFieldNames($toType);
        $key = isset(CategoryPeer::$fieldKeys[$fromType][$name]) ? CategoryPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(CategoryPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, CategoryPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return CategoryPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. CategoryPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(CategoryPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(CategoryPeer::ID);
            $criteria->addSelectColumn(CategoryPeer::NAME);
            $criteria->addSelectColumn(CategoryPeer::MODULE);
            $criteria->addSelectColumn(CategoryPeer::ACTIVE);
            $criteria->addSelectColumn(CategoryPeer::ISPUBLIC);
            $criteria->addSelectColumn(CategoryPeer::RESPONSIBLE);
            $criteria->addSelectColumn(CategoryPeer::DELETED_AT);
            $criteria->addSelectColumn(CategoryPeer::TREE_LEFT);
            $criteria->addSelectColumn(CategoryPeer::TREE_RIGHT);
            $criteria->addSelectColumn(CategoryPeer::TREE_LEVEL);
            $criteria->addSelectColumn(CategoryPeer::SCOPE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.NAME');
            $criteria->addSelectColumn($alias . '.MODULE');
            $criteria->addSelectColumn($alias . '.ACTIVE');
            $criteria->addSelectColumn($alias . '.ISPUBLIC');
            $criteria->addSelectColumn($alias . '.RESPONSIBLE');
            $criteria->addSelectColumn($alias . '.DELETED_AT');
            $criteria->addSelectColumn($alias . '.TREE_LEFT');
            $criteria->addSelectColumn($alias . '.TREE_RIGHT');
            $criteria->addSelectColumn($alias . '.TREE_LEVEL');
            $criteria->addSelectColumn($alias . '.SCOPE');
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
        $criteria->setPrimaryTableName(CategoryPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CategoryPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(CategoryPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // soft_delete behavior
        if (CategoryQuery::isSoftDeleteEnabled()) {
            $criteria->add(CategoryPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CategoryPeer::enableSoftDelete();
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
     * @return                 Category
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = CategoryPeer::doSelect($critcopy, $con);
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
        return CategoryPeer::populateObjects(CategoryPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            CategoryPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(CategoryPeer::DATABASE_NAME);
        // soft_delete behavior
        if (CategoryQuery::isSoftDeleteEnabled()) {
            $criteria->add(CategoryPeer::DELETED_AT, null, Criteria::ISNULL);
        } else {
            CategoryPeer::enableSoftDelete();
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
     * @param      Category $obj A Category object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            CategoryPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Category object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Category) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Category object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(CategoryPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Category Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(CategoryPeer::$instances[$key])) {
                return CategoryPeer::$instances[$key];
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
        CategoryPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to categories_category
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in GroupCategoryPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        GroupCategoryPeer::clearInstancePool();
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
        $cls = CategoryPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = CategoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = CategoryPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CategoryPeer::addInstanceToPool($obj, $key);
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
     * @return array (Category object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = CategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = CategoryPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + CategoryPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CategoryPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            CategoryPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        return Propel::getDatabaseMap(CategoryPeer::DATABASE_NAME)->getTable(CategoryPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseCategoryPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseCategoryPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new CategoryTableMap());
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
        return CategoryPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Category or Criteria object.
     *
     * @param      mixed $values Criteria or Category object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Category object
        }

        if ($criteria->containsKey(CategoryPeer::ID) && $criteria->keyContainsValue(CategoryPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CategoryPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(CategoryPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Category or Criteria object.
     *
     * @param      mixed $values Criteria or Category object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(CategoryPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(CategoryPeer::ID);
            $value = $criteria->remove(CategoryPeer::ID);
            if ($value) {
                $selectCriteria->add(CategoryPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(CategoryPeer::TABLE_NAME);
            }

        } else { // $values is Category object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(CategoryPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the categories_category table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doForceDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += CategoryPeer::doOnDeleteCascade(new Criteria(CategoryPeer::DATABASE_NAME), $con);
            $affectedRows += BasePeer::doDeleteAll(CategoryPeer::TABLE_NAME, $con, CategoryPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoryPeer::clearInstancePool();
            CategoryPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Category or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Category object or primary key or array of primary keys
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
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Category) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CategoryPeer::DATABASE_NAME);
            $criteria->add(CategoryPeer::ID, (array) $values, Criteria::IN);
        }

        // Set the correct dbName
        $criteria->setDbName(CategoryPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            // cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
            $c = clone $criteria;
            $affectedRows += CategoryPeer::doOnDeleteCascade($c, $con);

            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            if ($values instanceof Criteria) {
                CategoryPeer::clearInstancePool();
            } elseif ($values instanceof Category) { // it's a model object
                CategoryPeer::removeInstanceFromPool($values);
            } else { // it's a primary key, or an array of pks
                foreach ((array) $values as $singleval) {
                    CategoryPeer::removeInstanceFromPool($singleval);
                }
            }

            $affectedRows += BasePeer::doDelete($criteria, $con);
            CategoryPeer::clearRelatedInstancePool();
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
        $objects = CategoryPeer::doSelect($criteria, $con);
        foreach ($objects as $obj) {


            // delete related GroupCategory objects
            $criteria = new Criteria(GroupCategoryPeer::DATABASE_NAME);

            $criteria->add(GroupCategoryPeer::CATEGORYID, $obj->getId());
            $affectedRows += GroupCategoryPeer::doDelete($criteria, $con);
        }

        return $affectedRows;
    }

    /**
     * Validates all modified columns of given Category object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Category $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(CategoryPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(CategoryPeer::TABLE_NAME);

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

        return BasePeer::doValidate(CategoryPeer::DATABASE_NAME, CategoryPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Category
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = CategoryPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $criteria->add(CategoryPeer::ID, $pk);

        $v = CategoryPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Category[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(CategoryPeer::DATABASE_NAME);
            $criteria->add(CategoryPeer::ID, $pks, Criteria::IN);
            $objs = CategoryPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // soft_delete behavior

    /**
     * Enable the soft_delete behavior for this model
     */
    public static function enableSoftDelete()
    {
        CategoryQuery::enableSoftDelete();
        // some soft_deleted objects may be in the instance pool
        CategoryPeer::clearInstancePool();
    }

    /**
     * Disable the soft_delete behavior for this model
     */
    public static function disableSoftDelete()
    {
        CategoryQuery::disableSoftDelete();
    }

    /**
     * Check the soft_delete behavior for this model
     * @return boolean true if the soft_delete behavior is enabled
     */
    public static function isSoftDeleteEnabled()
    {
        return CategoryQuery::isSoftDeleteEnabled();
    }

    /**
     * Soft delete records, given a Category or Criteria object OR a primary key value.
     *
     * @param			 mixed $values Criteria or Category object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDelete($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        if ($values instanceof Criteria) {
            // rename for clarity
            $selectCriteria = clone $values;
         } elseif ($values instanceof Category) {
            // create criteria based on pk values
            $selectCriteria = $values->buildPkeyCriteria();
        } else {
            // it must be the primary key
            $selectCriteria = new Criteria(self::DATABASE_NAME);
             $selectCriteria->add(CategoryPeer::ID, (array) $values, Criteria::IN);
        }
        // Set the correct dbName
        $selectCriteria->setDbName(CategoryPeer::DATABASE_NAME);
        $updateCriteria = new Criteria(self::DATABASE_NAME);
        $updateCriteria->add(CategoryPeer::DELETED_AT, time());

         return BasePeer::doUpdate($selectCriteria, $updateCriteria, $con);
    }

    /**
     * Delete or soft delete records, depending on CategoryPeer::$softDelete
     *
     * @param			 mixed $values Criteria or Category object or primary key or array of primary keys
     *							which is used to create the DELETE statement
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDelete($values, PropelPDO $con = null)
    {
        if (CategoryPeer::isSoftDeleteEnabled()) {
            return CategoryPeer::doSoftDelete($values, $con);
        } else {
            return CategoryPeer::doForceDelete($values, $con);
        }
    }
    /**
     * Method to soft delete all rows from the categories_category table.
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doSoftDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $selectCriteria = new Criteria();
        $selectCriteria->add(CategoryPeer::DELETED_AT, null, Criteria::ISNULL);
        $selectCriteria->setDbName(CategoryPeer::DATABASE_NAME);
        $modifyCriteria = new Criteria();
        $modifyCriteria->add(CategoryPeer::DELETED_AT, time());

        return BasePeer::doUpdate($selectCriteria, $modifyCriteria, $con);
    }

    /**
     * Delete or soft delete all records, depending on CategoryPeer::$softDelete
     *
     * @param			 PropelPDO $con the connection to use
     * @return		 int	The number of affected rows (if supported by underlying database driver).
     * @throws		 PropelException Any exceptions caught during processing will be
     *							rethrown wrapped into a PropelException.
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if (CategoryPeer::isSoftDeleteEnabled()) {
            return CategoryPeer::doSoftDeleteAll($con);
        } else {
            return CategoryPeer::doForceDeleteAll($con);
        }
    }

    // nested_set behavior

    /**
     * Returns the root nodes for the tree
     *
     * @param      PropelPDO $con	Connection to use.
     * @return     Category			Propel object for root node
     */
    public static function retrieveRoots(Criteria $criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null) {
            $criteria = new Criteria(CategoryPeer::DATABASE_NAME);
        }
        $criteria->add(CategoryPeer::LEFT_COL, 1, Criteria::EQUAL);

        return CategoryPeer::doSelect($criteria, $con);
    }

    /**
     * Returns the root node for a given scope
     *
     * @param      int $scope		Scope to determine which root node to return
     * @param      PropelPDO $con	Connection to use.
     * @return     Category			Propel object for root node
     */
    public static function retrieveRoot($scope = null, PropelPDO $con = null)
    {
        $c = new Criteria(CategoryPeer::DATABASE_NAME);
        $c->add(CategoryPeer::LEFT_COL, 1, Criteria::EQUAL);
        $c->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);

        return CategoryPeer::doSelectOne($c, $con);
    }

    /**
     * Returns the whole tree node for a given scope
     *
     * @param      int $scope		Scope to determine which root node to return
     * @param      Criteria $criteria	Optional Criteria to filter the query
     * @param      PropelPDO $con	Connection to use.
     * @return     Category			Propel object for root node
     */
    public static function retrieveTree($scope = null, Criteria $criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null) {
            $criteria = new Criteria(CategoryPeer::DATABASE_NAME);
        }
        $criteria->addAscendingOrderByColumn(CategoryPeer::LEFT_COL);
        $criteria->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);

        return CategoryPeer::doSelect($criteria, $con);
    }

    /**
     * Tests if node is valid
     *
     * @param      Category $node	Propel object for src node
     * @return     bool
     */
    public static function isValid(Category $node = null)
    {
        if (is_object($node) && $node->getRightValue() > $node->getLeftValue()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete an entire tree
     *
     * @param      int $scope		Scope to determine which tree to delete
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     int  The number of deleted nodes
     */
    public static function deleteTree($scope = null, PropelPDO $con = null)
    {
        $c = new Criteria(CategoryPeer::DATABASE_NAME);
        $c->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);

        return CategoryPeer::doDelete($c, $con);
    }

    /**
     * Adds $delta to all L and R values that are >= $first and <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta		Value to be shifted by, can be negative
     * @param      int $first		First node to be shifted
     * @param      int $last			Last node to be shifted (optional)
     * @param      int $scope		Scope to use for the shift
     * @param      PropelPDO $con		Connection to use.
     */
    public static function shiftRLValues($delta, $first, $last = null, $scope = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        // Shift left column values
        $whereCriteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(CategoryPeer::LEFT_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(CategoryPeer::LEFT_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);
        $whereCriteria->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);

        $valuesCriteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $valuesCriteria->add(CategoryPeer::LEFT_COL, array('raw' => CategoryPeer::LEFT_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);

        // Shift right column values
        $whereCriteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(CategoryPeer::RIGHT_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(CategoryPeer::RIGHT_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);
        $whereCriteria->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);

        $valuesCriteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $valuesCriteria->add(CategoryPeer::RIGHT_COL, array('raw' => CategoryPeer::RIGHT_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);
    }

    /**
     * Adds $delta to level for nodes having left value >= $first and right value <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta		Value to be shifted by, can be negative
     * @param      int $first		First node to be shifted
     * @param      int $last			Last node to be shifted
     * @param      int $scope		Scope to use for the shift
     * @param      PropelPDO $con		Connection to use.
     */
    public static function shiftLevel($delta, $first, $last, $scope = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $whereCriteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $whereCriteria->add(CategoryPeer::LEFT_COL, $first, Criteria::GREATER_EQUAL);
        $whereCriteria->add(CategoryPeer::RIGHT_COL, $last, Criteria::LESS_EQUAL);
        $whereCriteria->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);

        $valuesCriteria = new Criteria(CategoryPeer::DATABASE_NAME);
        $valuesCriteria->add(CategoryPeer::LEVEL_COL, array('raw' => CategoryPeer::LEVEL_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);
    }

    /**
     * Reload all already loaded nodes to sync them with updated db
     *
     * @param      Category $prune		Object to prune from the update
     * @param      PropelPDO $con		Connection to use.
     */
    public static function updateLoadedNodes($prune = null, PropelPDO $con = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            $keys = array();
            foreach (CategoryPeer::$instances as $obj) {
                if (!$prune || !$prune->equals($obj)) {
                    $keys[] = $obj->getPrimaryKey();
                }
            }

            if (!empty($keys)) {
                // We don't need to alter the object instance pool; we're just modifying these ones
                // already in the pool.
                $criteria = new Criteria(CategoryPeer::DATABASE_NAME);
                $criteria->add(CategoryPeer::ID, $keys, Criteria::IN);
                $stmt = CategoryPeer::doSelectStmt($criteria, $con);
                while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                    $key = CategoryPeer::getPrimaryKeyHashFromRow($row, 0);
                    if (null !== ($object = CategoryPeer::getInstanceFromPool($key))) {
                        $object->setLeftValue($row[7]);
                        $object->setRightValue($row[8]);
                        $object->setLevel($row[9]);
                        $object->clearNestedSetChildren();
                    }
                }
                $stmt->closeCursor();
            }
        }
    }

    /**
     * Update the tree to allow insertion of a leaf at the specified position
     *
     * @param      int $left	left column value
     * @param      integer $scope	scope column value
     * @param      mixed $prune	Object to prune from the shift
     * @param      PropelPDO $con	Connection to use.
     */
    public static function makeRoomForLeaf($left, $scope, $prune = null, PropelPDO $con = null)
    {
        // Update database nodes
        CategoryPeer::shiftRLValues(2, $left, null, $scope, $con);

        // Update all loaded nodes
        CategoryPeer::updateLoadedNodes($prune, $con);
    }

    /**
     * Update the tree to allow insertion of a leaf at the specified position
     *
     * @param      integer $scope	scope column value
     * @param      PropelPDO $con	Connection to use.
     */
    public static function fixLevels($scope, PropelPDO $con = null)
    {
        $c = new Criteria();
        $c->add(CategoryPeer::SCOPE_COL, $scope, Criteria::EQUAL);
        $c->addAscendingOrderByColumn(CategoryPeer::LEFT_COL);
        $stmt = CategoryPeer::doSelectStmt($c, $con);

        // set the class once to avoid overhead in the loop
        $cls = CategoryPeer::getOMClass(false);
        $level = null;
        // iterate over the statement
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

            // hydrate object
            $key = CategoryPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null === ($obj = CategoryPeer::getInstanceFromPool($key))) {
                $obj = new $cls();
                $obj->hydrate($row);
                CategoryPeer::addInstanceToPool($obj, $key);
            }

            // compute level
            // Algorithm shamelessly stolen from sfPropelActAsNestedSetBehaviorPlugin
            // Probably authored by Tristan Rivoallan
            if ($level === null) {
                $level = 0;
                $i = 0;
                $prev = array($obj->getRightValue());
            } else {
                while ($obj->getRightValue() > $prev[$i]) {
                    $i--;
                }
                $level = ++$i;
                $prev[$i] = $obj->getRightValue();
            }

            // update level in node if necessary
            if ($obj->getLevel() !== $level) {
                $obj->setLevel($level);
                $obj->save($con);
            }
        }
        $stmt->closeCursor();
    }

} // BaseCategoryPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseCategoryPeer::buildTableMap();

