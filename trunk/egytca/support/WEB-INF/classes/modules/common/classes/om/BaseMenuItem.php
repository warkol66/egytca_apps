<?php


/**
 * Base class that represents a row from the 'common_menuItem' table.
 *
 * Items de los menues dinamicos
 *
 * @package    propel.generator.common.classes.om
 */
abstract class BaseMenuItem extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'MenuItemPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        MenuItemPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the action field.
     * @var        string
     */
    protected $action;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the order field.
     * @var        int
     */
    protected $order;

    /**
     * The value for the parentid field.
     * @var        int
     */
    protected $parentid;

    /**
     * The value for the newwindow field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $newwindow;

    /**
     * @var        PropelObjectCollection|MenuItemInfo[] Collection to store aggregation of MenuItemInfo objects.
     */
    protected $collMenuItemInfos;
    protected $collMenuItemInfosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $menuItemInfosScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->newwindow = false;
    }

    /**
     * Initializes internal state of BaseMenuItem object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [action] column value.
     * Nombre de la accion a ejecutar
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get the [url] column value.
     * Direccion del enlace
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [order] column value.
     * Indice de ordenamiento
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Get the [parentid] column value.
     * Id item padre
     * @return int
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Get the [newwindow] column value.
     * Abrir el enlace en nueva ventana
     * @return boolean
     */
    public function getNewwindow()
    {
        return $this->newwindow;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return MenuItem The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = MenuItemPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [action] column.
     * Nombre de la accion a ejecutar
     * @param string $v new value
     * @return MenuItem The current object (for fluent API support)
     */
    public function setAction($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->action !== $v) {
            $this->action = $v;
            $this->modifiedColumns[] = MenuItemPeer::ACTION;
        }


        return $this;
    } // setAction()

    /**
     * Set the value of [url] column.
     * Direccion del enlace
     * @param string $v new value
     * @return MenuItem The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[] = MenuItemPeer::URL;
        }


        return $this;
    } // setUrl()

    /**
     * Set the value of [order] column.
     * Indice de ordenamiento
     * @param int $v new value
     * @return MenuItem The current object (for fluent API support)
     */
    public function setOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->order !== $v) {
            $this->order = $v;
            $this->modifiedColumns[] = MenuItemPeer::ORDER;
        }


        return $this;
    } // setOrder()

    /**
     * Set the value of [parentid] column.
     * Id item padre
     * @param int $v new value
     * @return MenuItem The current object (for fluent API support)
     */
    public function setParentid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parentid !== $v) {
            $this->parentid = $v;
            $this->modifiedColumns[] = MenuItemPeer::PARENTID;
        }


        return $this;
    } // setParentid()

    /**
     * Sets the value of the [newwindow] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Abrir el enlace en nueva ventana
     * @param boolean|integer|string $v The new value
     * @return MenuItem The current object (for fluent API support)
     */
    public function setNewwindow($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->newwindow !== $v) {
            $this->newwindow = $v;
            $this->modifiedColumns[] = MenuItemPeer::NEWWINDOW;
        }


        return $this;
    } // setNewwindow()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->newwindow !== false) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->action = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->url = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->order = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->parentid = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->newwindow = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = MenuItemPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating MenuItem object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(MenuItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = MenuItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMenuItemInfos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(MenuItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = MenuItemQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(MenuItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                MenuItemPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->menuItemInfosScheduledForDeletion !== null) {
                if (!$this->menuItemInfosScheduledForDeletion->isEmpty()) {
                    MenuItemInfoQuery::create()
                        ->filterByPrimaryKeys($this->menuItemInfosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->menuItemInfosScheduledForDeletion = null;
                }
            }

            if ($this->collMenuItemInfos !== null) {
                foreach ($this->collMenuItemInfos as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = MenuItemPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . MenuItemPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(MenuItemPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(MenuItemPeer::ACTION)) {
            $modifiedColumns[':p' . $index++]  = '`ACTION`';
        }
        if ($this->isColumnModified(MenuItemPeer::URL)) {
            $modifiedColumns[':p' . $index++]  = '`URL`';
        }
        if ($this->isColumnModified(MenuItemPeer::ORDER)) {
            $modifiedColumns[':p' . $index++]  = '`ORDER`';
        }
        if ($this->isColumnModified(MenuItemPeer::PARENTID)) {
            $modifiedColumns[':p' . $index++]  = '`PARENTID`';
        }
        if ($this->isColumnModified(MenuItemPeer::NEWWINDOW)) {
            $modifiedColumns[':p' . $index++]  = '`NEWWINDOW`';
        }

        $sql = sprintf(
            'INSERT INTO `common_menuItem` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`ACTION`':
                        $stmt->bindValue($identifier, $this->action, PDO::PARAM_STR);
                        break;
                    case '`URL`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case '`ORDER`':
                        $stmt->bindValue($identifier, $this->order, PDO::PARAM_INT);
                        break;
                    case '`PARENTID`':
                        $stmt->bindValue($identifier, $this->parentid, PDO::PARAM_INT);
                        break;
                    case '`NEWWINDOW`':
                        $stmt->bindValue($identifier, (int) $this->newwindow, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = MenuItemPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collMenuItemInfos !== null) {
                    foreach ($this->collMenuItemInfos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = MenuItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getAction();
                break;
            case 2:
                return $this->getUrl();
                break;
            case 3:
                return $this->getOrder();
                break;
            case 4:
                return $this->getParentid();
                break;
            case 5:
                return $this->getNewwindow();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['MenuItem'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['MenuItem'][$this->getPrimaryKey()] = true;
        $keys = MenuItemPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAction(),
            $keys[2] => $this->getUrl(),
            $keys[3] => $this->getOrder(),
            $keys[4] => $this->getParentid(),
            $keys[5] => $this->getNewwindow(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collMenuItemInfos) {
                $result['MenuItemInfos'] = $this->collMenuItemInfos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = MenuItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAction($value);
                break;
            case 2:
                $this->setUrl($value);
                break;
            case 3:
                $this->setOrder($value);
                break;
            case 4:
                $this->setParentid($value);
                break;
            case 5:
                $this->setNewwindow($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = MenuItemPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAction($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUrl($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setOrder($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setParentid($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setNewwindow($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(MenuItemPeer::DATABASE_NAME);

        if ($this->isColumnModified(MenuItemPeer::ID)) $criteria->add(MenuItemPeer::ID, $this->id);
        if ($this->isColumnModified(MenuItemPeer::ACTION)) $criteria->add(MenuItemPeer::ACTION, $this->action);
        if ($this->isColumnModified(MenuItemPeer::URL)) $criteria->add(MenuItemPeer::URL, $this->url);
        if ($this->isColumnModified(MenuItemPeer::ORDER)) $criteria->add(MenuItemPeer::ORDER, $this->order);
        if ($this->isColumnModified(MenuItemPeer::PARENTID)) $criteria->add(MenuItemPeer::PARENTID, $this->parentid);
        if ($this->isColumnModified(MenuItemPeer::NEWWINDOW)) $criteria->add(MenuItemPeer::NEWWINDOW, $this->newwindow);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(MenuItemPeer::DATABASE_NAME);
        $criteria->add(MenuItemPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of MenuItem (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAction($this->getAction());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setOrder($this->getOrder());
        $copyObj->setParentid($this->getParentid());
        $copyObj->setNewwindow($this->getNewwindow());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getMenuItemInfos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMenuItemInfo($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return MenuItem Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return MenuItemPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new MenuItemPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('MenuItemInfo' == $relationName) {
            $this->initMenuItemInfos();
        }
    }

    /**
     * Clears out the collMenuItemInfos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMenuItemInfos()
     */
    public function clearMenuItemInfos()
    {
        $this->collMenuItemInfos = null; // important to set this to null since that means it is uninitialized
        $this->collMenuItemInfosPartial = null;
    }

    /**
     * reset is the collMenuItemInfos collection loaded partially
     *
     * @return void
     */
    public function resetPartialMenuItemInfos($v = true)
    {
        $this->collMenuItemInfosPartial = $v;
    }

    /**
     * Initializes the collMenuItemInfos collection.
     *
     * By default this just sets the collMenuItemInfos collection to an empty array (like clearcollMenuItemInfos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMenuItemInfos($overrideExisting = true)
    {
        if (null !== $this->collMenuItemInfos && !$overrideExisting) {
            return;
        }
        $this->collMenuItemInfos = new PropelObjectCollection();
        $this->collMenuItemInfos->setModel('MenuItemInfo');
    }

    /**
     * Gets an array of MenuItemInfo objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this MenuItem is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MenuItemInfo[] List of MenuItemInfo objects
     * @throws PropelException
     */
    public function getMenuItemInfos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMenuItemInfosPartial && !$this->isNew();
        if (null === $this->collMenuItemInfos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMenuItemInfos) {
                // return empty collection
                $this->initMenuItemInfos();
            } else {
                $collMenuItemInfos = MenuItemInfoQuery::create(null, $criteria)
                    ->filterByMenuItem($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMenuItemInfosPartial && count($collMenuItemInfos)) {
                      $this->initMenuItemInfos(false);

                      foreach($collMenuItemInfos as $obj) {
                        if (false == $this->collMenuItemInfos->contains($obj)) {
                          $this->collMenuItemInfos->append($obj);
                        }
                      }

                      $this->collMenuItemInfosPartial = true;
                    }

                    return $collMenuItemInfos;
                }

                if($partial && $this->collMenuItemInfos) {
                    foreach($this->collMenuItemInfos as $obj) {
                        if($obj->isNew()) {
                            $collMenuItemInfos[] = $obj;
                        }
                    }
                }

                $this->collMenuItemInfos = $collMenuItemInfos;
                $this->collMenuItemInfosPartial = false;
            }
        }

        return $this->collMenuItemInfos;
    }

    /**
     * Sets a collection of MenuItemInfo objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $menuItemInfos A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setMenuItemInfos(PropelCollection $menuItemInfos, PropelPDO $con = null)
    {
        $this->menuItemInfosScheduledForDeletion = $this->getMenuItemInfos(new Criteria(), $con)->diff($menuItemInfos);

        foreach ($this->menuItemInfosScheduledForDeletion as $menuItemInfoRemoved) {
            $menuItemInfoRemoved->setMenuItem(null);
        }

        $this->collMenuItemInfos = null;
        foreach ($menuItemInfos as $menuItemInfo) {
            $this->addMenuItemInfo($menuItemInfo);
        }

        $this->collMenuItemInfos = $menuItemInfos;
        $this->collMenuItemInfosPartial = false;
    }

    /**
     * Returns the number of related MenuItemInfo objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MenuItemInfo objects.
     * @throws PropelException
     */
    public function countMenuItemInfos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMenuItemInfosPartial && !$this->isNew();
        if (null === $this->collMenuItemInfos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMenuItemInfos) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getMenuItemInfos());
                }
                $query = MenuItemInfoQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByMenuItem($this)
                    ->count($con);
            }
        } else {
            return count($this->collMenuItemInfos);
        }
    }

    /**
     * Method called to associate a MenuItemInfo object to this object
     * through the MenuItemInfo foreign key attribute.
     *
     * @param    MenuItemInfo $l MenuItemInfo
     * @return MenuItem The current object (for fluent API support)
     */
    public function addMenuItemInfo(MenuItemInfo $l)
    {
        if ($this->collMenuItemInfos === null) {
            $this->initMenuItemInfos();
            $this->collMenuItemInfosPartial = true;
        }
        if (!$this->collMenuItemInfos->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddMenuItemInfo($l);
        }

        return $this;
    }

    /**
     * @param	MenuItemInfo $menuItemInfo The menuItemInfo object to add.
     */
    protected function doAddMenuItemInfo($menuItemInfo)
    {
        $this->collMenuItemInfos[]= $menuItemInfo;
        $menuItemInfo->setMenuItem($this);
    }

    /**
     * @param	MenuItemInfo $menuItemInfo The menuItemInfo object to remove.
     */
    public function removeMenuItemInfo($menuItemInfo)
    {
        if ($this->getMenuItemInfos()->contains($menuItemInfo)) {
            $this->collMenuItemInfos->remove($this->collMenuItemInfos->search($menuItemInfo));
            if (null === $this->menuItemInfosScheduledForDeletion) {
                $this->menuItemInfosScheduledForDeletion = clone $this->collMenuItemInfos;
                $this->menuItemInfosScheduledForDeletion->clear();
            }
            $this->menuItemInfosScheduledForDeletion[]= $menuItemInfo;
            $menuItemInfo->setMenuItem(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->action = null;
        $this->url = null;
        $this->order = null;
        $this->parentid = null;
        $this->newwindow = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collMenuItemInfos) {
                foreach ($this->collMenuItemInfos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collMenuItemInfos instanceof PropelCollection) {
            $this->collMenuItemInfos->clearIterator();
        }
        $this->collMenuItemInfos = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(MenuItemPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
