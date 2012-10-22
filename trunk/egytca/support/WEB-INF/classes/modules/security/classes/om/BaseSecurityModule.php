<?php


/**
 * Base class that represents a row from the 'security_module' table.
 *
 * Modulos del sistema
 *
 * @package    propel.generator.security.classes.om
 */
abstract class BaseSecurityModule extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'SecurityModulePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SecurityModulePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the module field.
     * @var        string
     */
    protected $module;

    /**
     * The value for the access field.
     * @var        int
     */
    protected $access;

    /**
     * The value for the accessaffiliateuser field.
     * @var        int
     */
    protected $accessaffiliateuser;

    /**
     * The value for the accessregistrationuser field.
     * @var        int
     */
    protected $accessregistrationuser;

    /**
     * The value for the accessclientuser field.
     * @var        int
     */
    protected $accessclientuser;

    /**
     * The value for the nochecklogin field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $nochecklogin;

    /**
     * @var        PropelObjectCollection|SecurityAction[] Collection to store aggregation of SecurityAction objects.
     */
    protected $collSecurityActions;
    protected $collSecurityActionsPartial;

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
    protected $securityActionsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->nochecklogin = false;
    }

    /**
     * Initializes internal state of BaseSecurityModule object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [module] column value.
     * Modulo
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Get the [access] column value.
     * El acceso a ese modulo
     * @return int
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Get the [accessaffiliateuser] column value.
     * El acceso a ese modulo para los usuarios por afiliados
     * @return int
     */
    public function getAccessaffiliateuser()
    {
        return $this->accessaffiliateuser;
    }

    /**
     * Get the [accessregistrationuser] column value.
     * El acceso a ese modulo para los usuarios por registracion
     * @return int
     */
    public function getAccessregistrationuser()
    {
        return $this->accessregistrationuser;
    }

    /**
     * Get the [accessclientuser] column value.
     * El acceso a ese action para los usuarios por cliente
     * @return int
     */
    public function getAccessclientuser()
    {
        return $this->accessclientuser;
    }

    /**
     * Get the [nochecklogin] column value.
     * Si no se chequea login ese modulo
     * @return boolean
     */
    public function getNochecklogin()
    {
        return $this->nochecklogin;
    }

    /**
     * Set the value of [module] column.
     * Modulo
     * @param string $v new value
     * @return SecurityModule The current object (for fluent API support)
     */
    public function setModule($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->module !== $v) {
            $this->module = $v;
            $this->modifiedColumns[] = SecurityModulePeer::MODULE;
        }


        return $this;
    } // setModule()

    /**
     * Set the value of [access] column.
     * El acceso a ese modulo
     * @param int $v new value
     * @return SecurityModule The current object (for fluent API support)
     */
    public function setAccess($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->access !== $v) {
            $this->access = $v;
            $this->modifiedColumns[] = SecurityModulePeer::ACCESS;
        }


        return $this;
    } // setAccess()

    /**
     * Set the value of [accessaffiliateuser] column.
     * El acceso a ese modulo para los usuarios por afiliados
     * @param int $v new value
     * @return SecurityModule The current object (for fluent API support)
     */
    public function setAccessaffiliateuser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accessaffiliateuser !== $v) {
            $this->accessaffiliateuser = $v;
            $this->modifiedColumns[] = SecurityModulePeer::ACCESSAFFILIATEUSER;
        }


        return $this;
    } // setAccessaffiliateuser()

    /**
     * Set the value of [accessregistrationuser] column.
     * El acceso a ese modulo para los usuarios por registracion
     * @param int $v new value
     * @return SecurityModule The current object (for fluent API support)
     */
    public function setAccessregistrationuser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accessregistrationuser !== $v) {
            $this->accessregistrationuser = $v;
            $this->modifiedColumns[] = SecurityModulePeer::ACCESSREGISTRATIONUSER;
        }


        return $this;
    } // setAccessregistrationuser()

    /**
     * Set the value of [accessclientuser] column.
     * El acceso a ese action para los usuarios por cliente
     * @param int $v new value
     * @return SecurityModule The current object (for fluent API support)
     */
    public function setAccessclientuser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accessclientuser !== $v) {
            $this->accessclientuser = $v;
            $this->modifiedColumns[] = SecurityModulePeer::ACCESSCLIENTUSER;
        }


        return $this;
    } // setAccessclientuser()

    /**
     * Sets the value of the [nochecklogin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Si no se chequea login ese modulo
     * @param boolean|integer|string $v The new value
     * @return SecurityModule The current object (for fluent API support)
     */
    public function setNochecklogin($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->nochecklogin !== $v) {
            $this->nochecklogin = $v;
            $this->modifiedColumns[] = SecurityModulePeer::NOCHECKLOGIN;
        }


        return $this;
    } // setNochecklogin()

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
            if ($this->nochecklogin !== false) {
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

            $this->module = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->access = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->accessaffiliateuser = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->accessregistrationuser = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->accessclientuser = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->nochecklogin = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = SecurityModulePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating SecurityModule object", $e);
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
            $con = Propel::getConnection(SecurityModulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SecurityModulePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSecurityActions = null;

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
            $con = Propel::getConnection(SecurityModulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SecurityModuleQuery::create()
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
            $con = Propel::getConnection(SecurityModulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                SecurityModulePeer::addInstanceToPool($this);
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

            if ($this->securityActionsScheduledForDeletion !== null) {
                if (!$this->securityActionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->securityActionsScheduledForDeletion as $securityAction) {
                        // need to save related object because we set the relation to null
                        $securityAction->save($con);
                    }
                    $this->securityActionsScheduledForDeletion = null;
                }
            }

            if ($this->collSecurityActions !== null) {
                foreach ($this->collSecurityActions as $referrerFK) {
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SecurityModulePeer::MODULE)) {
            $modifiedColumns[':p' . $index++]  = '`MODULE`';
        }
        if ($this->isColumnModified(SecurityModulePeer::ACCESS)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESS`';
        }
        if ($this->isColumnModified(SecurityModulePeer::ACCESSAFFILIATEUSER)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESSAFFILIATEUSER`';
        }
        if ($this->isColumnModified(SecurityModulePeer::ACCESSREGISTRATIONUSER)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESSREGISTRATIONUSER`';
        }
        if ($this->isColumnModified(SecurityModulePeer::ACCESSCLIENTUSER)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESSCLIENTUSER`';
        }
        if ($this->isColumnModified(SecurityModulePeer::NOCHECKLOGIN)) {
            $modifiedColumns[':p' . $index++]  = '`NOCHECKLOGIN`';
        }

        $sql = sprintf(
            'INSERT INTO `security_module` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`MODULE`':
                        $stmt->bindValue($identifier, $this->module, PDO::PARAM_STR);
                        break;
                    case '`ACCESS`':
                        $stmt->bindValue($identifier, $this->access, PDO::PARAM_INT);
                        break;
                    case '`ACCESSAFFILIATEUSER`':
                        $stmt->bindValue($identifier, $this->accessaffiliateuser, PDO::PARAM_INT);
                        break;
                    case '`ACCESSREGISTRATIONUSER`':
                        $stmt->bindValue($identifier, $this->accessregistrationuser, PDO::PARAM_INT);
                        break;
                    case '`ACCESSCLIENTUSER`':
                        $stmt->bindValue($identifier, $this->accessclientuser, PDO::PARAM_INT);
                        break;
                    case '`NOCHECKLOGIN`':
                        $stmt->bindValue($identifier, (int) $this->nochecklogin, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

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


            if (($retval = SecurityModulePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collSecurityActions !== null) {
                    foreach ($this->collSecurityActions as $referrerFK) {
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
        $pos = SecurityModulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getModule();
                break;
            case 1:
                return $this->getAccess();
                break;
            case 2:
                return $this->getAccessaffiliateuser();
                break;
            case 3:
                return $this->getAccessregistrationuser();
                break;
            case 4:
                return $this->getAccessclientuser();
                break;
            case 5:
                return $this->getNochecklogin();
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
        if (isset($alreadyDumpedObjects['SecurityModule'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SecurityModule'][$this->getPrimaryKey()] = true;
        $keys = SecurityModulePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getModule(),
            $keys[1] => $this->getAccess(),
            $keys[2] => $this->getAccessaffiliateuser(),
            $keys[3] => $this->getAccessregistrationuser(),
            $keys[4] => $this->getAccessclientuser(),
            $keys[5] => $this->getNochecklogin(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collSecurityActions) {
                $result['SecurityActions'] = $this->collSecurityActions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SecurityModulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setModule($value);
                break;
            case 1:
                $this->setAccess($value);
                break;
            case 2:
                $this->setAccessaffiliateuser($value);
                break;
            case 3:
                $this->setAccessregistrationuser($value);
                break;
            case 4:
                $this->setAccessclientuser($value);
                break;
            case 5:
                $this->setNochecklogin($value);
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
        $keys = SecurityModulePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setModule($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAccess($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAccessaffiliateuser($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAccessregistrationuser($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAccessclientuser($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setNochecklogin($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SecurityModulePeer::DATABASE_NAME);

        if ($this->isColumnModified(SecurityModulePeer::MODULE)) $criteria->add(SecurityModulePeer::MODULE, $this->module);
        if ($this->isColumnModified(SecurityModulePeer::ACCESS)) $criteria->add(SecurityModulePeer::ACCESS, $this->access);
        if ($this->isColumnModified(SecurityModulePeer::ACCESSAFFILIATEUSER)) $criteria->add(SecurityModulePeer::ACCESSAFFILIATEUSER, $this->accessaffiliateuser);
        if ($this->isColumnModified(SecurityModulePeer::ACCESSREGISTRATIONUSER)) $criteria->add(SecurityModulePeer::ACCESSREGISTRATIONUSER, $this->accessregistrationuser);
        if ($this->isColumnModified(SecurityModulePeer::ACCESSCLIENTUSER)) $criteria->add(SecurityModulePeer::ACCESSCLIENTUSER, $this->accessclientuser);
        if ($this->isColumnModified(SecurityModulePeer::NOCHECKLOGIN)) $criteria->add(SecurityModulePeer::NOCHECKLOGIN, $this->nochecklogin);

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
        $criteria = new Criteria(SecurityModulePeer::DATABASE_NAME);
        $criteria->add(SecurityModulePeer::MODULE, $this->module);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getModule();
    }

    /**
     * Generic method to set the primary key (module column).
     *
     * @param  string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setModule($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getModule();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of SecurityModule (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAccess($this->getAccess());
        $copyObj->setAccessaffiliateuser($this->getAccessaffiliateuser());
        $copyObj->setAccessregistrationuser($this->getAccessregistrationuser());
        $copyObj->setAccessclientuser($this->getAccessclientuser());
        $copyObj->setNochecklogin($this->getNochecklogin());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getSecurityActions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSecurityAction($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setModule(NULL); // this is a auto-increment column, so set to default value
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
     * @return SecurityModule Clone of current object.
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
     * @return SecurityModulePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SecurityModulePeer();
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
        if ('SecurityAction' == $relationName) {
            $this->initSecurityActions();
        }
    }

    /**
     * Clears out the collSecurityActions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSecurityActions()
     */
    public function clearSecurityActions()
    {
        $this->collSecurityActions = null; // important to set this to null since that means it is uninitialized
        $this->collSecurityActionsPartial = null;
    }

    /**
     * reset is the collSecurityActions collection loaded partially
     *
     * @return void
     */
    public function resetPartialSecurityActions($v = true)
    {
        $this->collSecurityActionsPartial = $v;
    }

    /**
     * Initializes the collSecurityActions collection.
     *
     * By default this just sets the collSecurityActions collection to an empty array (like clearcollSecurityActions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSecurityActions($overrideExisting = true)
    {
        if (null !== $this->collSecurityActions && !$overrideExisting) {
            return;
        }
        $this->collSecurityActions = new PropelObjectCollection();
        $this->collSecurityActions->setModel('SecurityAction');
    }

    /**
     * Gets an array of SecurityAction objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this SecurityModule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|SecurityAction[] List of SecurityAction objects
     * @throws PropelException
     */
    public function getSecurityActions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSecurityActionsPartial && !$this->isNew();
        if (null === $this->collSecurityActions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSecurityActions) {
                // return empty collection
                $this->initSecurityActions();
            } else {
                $collSecurityActions = SecurityActionQuery::create(null, $criteria)
                    ->filterBySecurityModule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSecurityActionsPartial && count($collSecurityActions)) {
                      $this->initSecurityActions(false);

                      foreach($collSecurityActions as $obj) {
                        if (false == $this->collSecurityActions->contains($obj)) {
                          $this->collSecurityActions->append($obj);
                        }
                      }

                      $this->collSecurityActionsPartial = true;
                    }

                    return $collSecurityActions;
                }

                if($partial && $this->collSecurityActions) {
                    foreach($this->collSecurityActions as $obj) {
                        if($obj->isNew()) {
                            $collSecurityActions[] = $obj;
                        }
                    }
                }

                $this->collSecurityActions = $collSecurityActions;
                $this->collSecurityActionsPartial = false;
            }
        }

        return $this->collSecurityActions;
    }

    /**
     * Sets a collection of SecurityAction objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $securityActions A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setSecurityActions(PropelCollection $securityActions, PropelPDO $con = null)
    {
        $this->securityActionsScheduledForDeletion = $this->getSecurityActions(new Criteria(), $con)->diff($securityActions);

        foreach ($this->securityActionsScheduledForDeletion as $securityActionRemoved) {
            $securityActionRemoved->setSecurityModule(null);
        }

        $this->collSecurityActions = null;
        foreach ($securityActions as $securityAction) {
            $this->addSecurityAction($securityAction);
        }

        $this->collSecurityActions = $securityActions;
        $this->collSecurityActionsPartial = false;
    }

    /**
     * Returns the number of related SecurityAction objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related SecurityAction objects.
     * @throws PropelException
     */
    public function countSecurityActions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSecurityActionsPartial && !$this->isNew();
        if (null === $this->collSecurityActions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSecurityActions) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getSecurityActions());
                }
                $query = SecurityActionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySecurityModule($this)
                    ->count($con);
            }
        } else {
            return count($this->collSecurityActions);
        }
    }

    /**
     * Method called to associate a SecurityAction object to this object
     * through the SecurityAction foreign key attribute.
     *
     * @param    SecurityAction $l SecurityAction
     * @return SecurityModule The current object (for fluent API support)
     */
    public function addSecurityAction(SecurityAction $l)
    {
        if ($this->collSecurityActions === null) {
            $this->initSecurityActions();
            $this->collSecurityActionsPartial = true;
        }
        if (!$this->collSecurityActions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddSecurityAction($l);
        }

        return $this;
    }

    /**
     * @param	SecurityAction $securityAction The securityAction object to add.
     */
    protected function doAddSecurityAction($securityAction)
    {
        $this->collSecurityActions[]= $securityAction;
        $securityAction->setSecurityModule($this);
    }

    /**
     * @param	SecurityAction $securityAction The securityAction object to remove.
     */
    public function removeSecurityAction($securityAction)
    {
        if ($this->getSecurityActions()->contains($securityAction)) {
            $this->collSecurityActions->remove($this->collSecurityActions->search($securityAction));
            if (null === $this->securityActionsScheduledForDeletion) {
                $this->securityActionsScheduledForDeletion = clone $this->collSecurityActions;
                $this->securityActionsScheduledForDeletion->clear();
            }
            $this->securityActionsScheduledForDeletion[]= $securityAction;
            $securityAction->setSecurityModule(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->module = null;
        $this->access = null;
        $this->accessaffiliateuser = null;
        $this->accessregistrationuser = null;
        $this->accessclientuser = null;
        $this->nochecklogin = null;
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
            if ($this->collSecurityActions) {
                foreach ($this->collSecurityActions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collSecurityActions instanceof PropelCollection) {
            $this->collSecurityActions->clearIterator();
        }
        $this->collSecurityActions = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SecurityModulePeer::DEFAULT_STRING_FORMAT);
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
