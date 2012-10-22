<?php


/**
 * Base class that represents a row from the 'security_action' table.
 *
 * Actions del sistema
 *
 * @package    propel.generator.security.classes.om
 */
abstract class BaseSecurityAction extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'SecurityActionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        SecurityActionPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the action field.
     * @var        string
     */
    protected $action;

    /**
     * The value for the module field.
     * @var        string
     */
    protected $module;

    /**
     * The value for the section field.
     * @var        string
     */
    protected $section;

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
     * The value for the active field.
     * @var        int
     */
    protected $active;

    /**
     * The value for the pair field.
     * @var        string
     */
    protected $pair;

    /**
     * The value for the nochecklogin field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $nochecklogin;

    /**
     * @var        SecurityModule
     */
    protected $aSecurityModule;

    /**
     * @var        PropelObjectCollection|ActionLog[] Collection to store aggregation of ActionLog objects.
     */
    protected $collActionLogs;
    protected $collActionLogsPartial;

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
    protected $actionLogsScheduledForDeletion = null;

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
     * Initializes internal state of BaseSecurityAction object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [action] column value.
     * Action pagina
     * @return string
     */
    public function getAction()
    {
        return $this->action;
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
     * Get the [section] column value.
     * Seccion
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Get the [access] column value.
     * El acceso a ese action
     * @return int
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Get the [accessaffiliateuser] column value.
     * El acceso a ese action para los usuarios por afiliados
     * @return int
     */
    public function getAccessaffiliateuser()
    {
        return $this->accessaffiliateuser;
    }

    /**
     * Get the [accessregistrationuser] column value.
     * El acceso a ese action para los usuarios por registracion
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
     * Get the [active] column value.
     * Si el action esta activo o no
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [pair] column value.
     * Par del Action
     * @return string
     */
    public function getPair()
    {
        return $this->pair;
    }

    /**
     * Get the [nochecklogin] column value.
     * Si no se chequea login ese action
     * @return boolean
     */
    public function getNochecklogin()
    {
        return $this->nochecklogin;
    }

    /**
     * Set the value of [action] column.
     * Action pagina
     * @param string $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setAction($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->action !== $v) {
            $this->action = $v;
            $this->modifiedColumns[] = SecurityActionPeer::ACTION;
        }


        return $this;
    } // setAction()

    /**
     * Set the value of [module] column.
     * Modulo
     * @param string $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setModule($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->module !== $v) {
            $this->module = $v;
            $this->modifiedColumns[] = SecurityActionPeer::MODULE;
        }

        if ($this->aSecurityModule !== null && $this->aSecurityModule->getModule() !== $v) {
            $this->aSecurityModule = null;
        }


        return $this;
    } // setModule()

    /**
     * Set the value of [section] column.
     * Seccion
     * @param string $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setSection($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->section !== $v) {
            $this->section = $v;
            $this->modifiedColumns[] = SecurityActionPeer::SECTION;
        }


        return $this;
    } // setSection()

    /**
     * Set the value of [access] column.
     * El acceso a ese action
     * @param int $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setAccess($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->access !== $v) {
            $this->access = $v;
            $this->modifiedColumns[] = SecurityActionPeer::ACCESS;
        }


        return $this;
    } // setAccess()

    /**
     * Set the value of [accessaffiliateuser] column.
     * El acceso a ese action para los usuarios por afiliados
     * @param int $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setAccessaffiliateuser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accessaffiliateuser !== $v) {
            $this->accessaffiliateuser = $v;
            $this->modifiedColumns[] = SecurityActionPeer::ACCESSAFFILIATEUSER;
        }


        return $this;
    } // setAccessaffiliateuser()

    /**
     * Set the value of [accessregistrationuser] column.
     * El acceso a ese action para los usuarios por registracion
     * @param int $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setAccessregistrationuser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accessregistrationuser !== $v) {
            $this->accessregistrationuser = $v;
            $this->modifiedColumns[] = SecurityActionPeer::ACCESSREGISTRATIONUSER;
        }


        return $this;
    } // setAccessregistrationuser()

    /**
     * Set the value of [accessclientuser] column.
     * El acceso a ese action para los usuarios por cliente
     * @param int $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setAccessclientuser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->accessclientuser !== $v) {
            $this->accessclientuser = $v;
            $this->modifiedColumns[] = SecurityActionPeer::ACCESSCLIENTUSER;
        }


        return $this;
    } // setAccessclientuser()

    /**
     * Set the value of [active] column.
     * Si el action esta activo o no
     * @param int $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = SecurityActionPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Set the value of [pair] column.
     * Par del Action
     * @param string $v new value
     * @return SecurityAction The current object (for fluent API support)
     */
    public function setPair($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pair !== $v) {
            $this->pair = $v;
            $this->modifiedColumns[] = SecurityActionPeer::PAIR;
        }


        return $this;
    } // setPair()

    /**
     * Sets the value of the [nochecklogin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Si no se chequea login ese action
     * @param boolean|integer|string $v The new value
     * @return SecurityAction The current object (for fluent API support)
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
            $this->modifiedColumns[] = SecurityActionPeer::NOCHECKLOGIN;
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

            $this->action = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->module = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->section = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->access = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->accessaffiliateuser = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->accessregistrationuser = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->accessclientuser = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->active = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->pair = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->nochecklogin = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SecurityActionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating SecurityAction object", $e);
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

        if ($this->aSecurityModule !== null && $this->module !== $this->aSecurityModule->getModule()) {
            $this->aSecurityModule = null;
        }
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
            $con = Propel::getConnection(SecurityActionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = SecurityActionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSecurityModule = null;
            $this->collActionLogs = null;

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
            $con = Propel::getConnection(SecurityActionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = SecurityActionQuery::create()
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
            $con = Propel::getConnection(SecurityActionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                SecurityActionPeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aSecurityModule !== null) {
                if ($this->aSecurityModule->isModified() || $this->aSecurityModule->isNew()) {
                    $affectedRows += $this->aSecurityModule->save($con);
                }
                $this->setSecurityModule($this->aSecurityModule);
            }

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

            if ($this->actionLogsScheduledForDeletion !== null) {
                if (!$this->actionLogsScheduledForDeletion->isEmpty()) {
                    ActionLogQuery::create()
                        ->filterByPrimaryKeys($this->actionLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->actionLogsScheduledForDeletion = null;
                }
            }

            if ($this->collActionLogs !== null) {
                foreach ($this->collActionLogs as $referrerFK) {
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
        if ($this->isColumnModified(SecurityActionPeer::ACTION)) {
            $modifiedColumns[':p' . $index++]  = '`ACTION`';
        }
        if ($this->isColumnModified(SecurityActionPeer::MODULE)) {
            $modifiedColumns[':p' . $index++]  = '`MODULE`';
        }
        if ($this->isColumnModified(SecurityActionPeer::SECTION)) {
            $modifiedColumns[':p' . $index++]  = '`SECTION`';
        }
        if ($this->isColumnModified(SecurityActionPeer::ACCESS)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESS`';
        }
        if ($this->isColumnModified(SecurityActionPeer::ACCESSAFFILIATEUSER)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESSAFFILIATEUSER`';
        }
        if ($this->isColumnModified(SecurityActionPeer::ACCESSREGISTRATIONUSER)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESSREGISTRATIONUSER`';
        }
        if ($this->isColumnModified(SecurityActionPeer::ACCESSCLIENTUSER)) {
            $modifiedColumns[':p' . $index++]  = '`ACCESSCLIENTUSER`';
        }
        if ($this->isColumnModified(SecurityActionPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }
        if ($this->isColumnModified(SecurityActionPeer::PAIR)) {
            $modifiedColumns[':p' . $index++]  = '`PAIR`';
        }
        if ($this->isColumnModified(SecurityActionPeer::NOCHECKLOGIN)) {
            $modifiedColumns[':p' . $index++]  = '`NOCHECKLOGIN`';
        }

        $sql = sprintf(
            'INSERT INTO `security_action` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ACTION`':
                        $stmt->bindValue($identifier, $this->action, PDO::PARAM_STR);
                        break;
                    case '`MODULE`':
                        $stmt->bindValue($identifier, $this->module, PDO::PARAM_STR);
                        break;
                    case '`SECTION`':
                        $stmt->bindValue($identifier, $this->section, PDO::PARAM_STR);
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
                    case '`ACTIVE`':
                        $stmt->bindValue($identifier, $this->active, PDO::PARAM_INT);
                        break;
                    case '`PAIR`':
                        $stmt->bindValue($identifier, $this->pair, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aSecurityModule !== null) {
                if (!$this->aSecurityModule->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSecurityModule->getValidationFailures());
                }
            }


            if (($retval = SecurityActionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collActionLogs !== null) {
                    foreach ($this->collActionLogs as $referrerFK) {
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
        $pos = SecurityActionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAction();
                break;
            case 1:
                return $this->getModule();
                break;
            case 2:
                return $this->getSection();
                break;
            case 3:
                return $this->getAccess();
                break;
            case 4:
                return $this->getAccessaffiliateuser();
                break;
            case 5:
                return $this->getAccessregistrationuser();
                break;
            case 6:
                return $this->getAccessclientuser();
                break;
            case 7:
                return $this->getActive();
                break;
            case 8:
                return $this->getPair();
                break;
            case 9:
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
        if (isset($alreadyDumpedObjects['SecurityAction'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['SecurityAction'][$this->getPrimaryKey()] = true;
        $keys = SecurityActionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAction(),
            $keys[1] => $this->getModule(),
            $keys[2] => $this->getSection(),
            $keys[3] => $this->getAccess(),
            $keys[4] => $this->getAccessaffiliateuser(),
            $keys[5] => $this->getAccessregistrationuser(),
            $keys[6] => $this->getAccessclientuser(),
            $keys[7] => $this->getActive(),
            $keys[8] => $this->getPair(),
            $keys[9] => $this->getNochecklogin(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aSecurityModule) {
                $result['SecurityModule'] = $this->aSecurityModule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collActionLogs) {
                $result['ActionLogs'] = $this->collActionLogs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = SecurityActionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAction($value);
                break;
            case 1:
                $this->setModule($value);
                break;
            case 2:
                $this->setSection($value);
                break;
            case 3:
                $this->setAccess($value);
                break;
            case 4:
                $this->setAccessaffiliateuser($value);
                break;
            case 5:
                $this->setAccessregistrationuser($value);
                break;
            case 6:
                $this->setAccessclientuser($value);
                break;
            case 7:
                $this->setActive($value);
                break;
            case 8:
                $this->setPair($value);
                break;
            case 9:
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
        $keys = SecurityActionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setAction($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setModule($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSection($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAccess($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAccessaffiliateuser($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAccessregistrationuser($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setAccessclientuser($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setActive($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setPair($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setNochecklogin($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SecurityActionPeer::DATABASE_NAME);

        if ($this->isColumnModified(SecurityActionPeer::ACTION)) $criteria->add(SecurityActionPeer::ACTION, $this->action);
        if ($this->isColumnModified(SecurityActionPeer::MODULE)) $criteria->add(SecurityActionPeer::MODULE, $this->module);
        if ($this->isColumnModified(SecurityActionPeer::SECTION)) $criteria->add(SecurityActionPeer::SECTION, $this->section);
        if ($this->isColumnModified(SecurityActionPeer::ACCESS)) $criteria->add(SecurityActionPeer::ACCESS, $this->access);
        if ($this->isColumnModified(SecurityActionPeer::ACCESSAFFILIATEUSER)) $criteria->add(SecurityActionPeer::ACCESSAFFILIATEUSER, $this->accessaffiliateuser);
        if ($this->isColumnModified(SecurityActionPeer::ACCESSREGISTRATIONUSER)) $criteria->add(SecurityActionPeer::ACCESSREGISTRATIONUSER, $this->accessregistrationuser);
        if ($this->isColumnModified(SecurityActionPeer::ACCESSCLIENTUSER)) $criteria->add(SecurityActionPeer::ACCESSCLIENTUSER, $this->accessclientuser);
        if ($this->isColumnModified(SecurityActionPeer::ACTIVE)) $criteria->add(SecurityActionPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(SecurityActionPeer::PAIR)) $criteria->add(SecurityActionPeer::PAIR, $this->pair);
        if ($this->isColumnModified(SecurityActionPeer::NOCHECKLOGIN)) $criteria->add(SecurityActionPeer::NOCHECKLOGIN, $this->nochecklogin);

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
        $criteria = new Criteria(SecurityActionPeer::DATABASE_NAME);
        $criteria->add(SecurityActionPeer::ACTION, $this->action);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getAction();
    }

    /**
     * Generic method to set the primary key (action column).
     *
     * @param  string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setAction($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getAction();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of SecurityAction (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setModule($this->getModule());
        $copyObj->setSection($this->getSection());
        $copyObj->setAccess($this->getAccess());
        $copyObj->setAccessaffiliateuser($this->getAccessaffiliateuser());
        $copyObj->setAccessregistrationuser($this->getAccessregistrationuser());
        $copyObj->setAccessclientuser($this->getAccessclientuser());
        $copyObj->setActive($this->getActive());
        $copyObj->setPair($this->getPair());
        $copyObj->setNochecklogin($this->getNochecklogin());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getActionLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addActionLog($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAction(NULL); // this is a auto-increment column, so set to default value
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
     * @return SecurityAction Clone of current object.
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
     * @return SecurityActionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new SecurityActionPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a SecurityModule object.
     *
     * @param             SecurityModule $v
     * @return SecurityAction The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSecurityModule(SecurityModule $v = null)
    {
        if ($v === null) {
            $this->setModule(NULL);
        } else {
            $this->setModule($v->getModule());
        }

        $this->aSecurityModule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SecurityModule object, it will not be re-added.
        if ($v !== null) {
            $v->addSecurityAction($this);
        }


        return $this;
    }


    /**
     * Get the associated SecurityModule object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return SecurityModule The associated SecurityModule object.
     * @throws PropelException
     */
    public function getSecurityModule(PropelPDO $con = null)
    {
        if ($this->aSecurityModule === null && (($this->module !== "" && $this->module !== null))) {
            $this->aSecurityModule = SecurityModuleQuery::create()->findPk($this->module, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSecurityModule->addSecurityActions($this);
             */
        }

        return $this->aSecurityModule;
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
        if ('ActionLog' == $relationName) {
            $this->initActionLogs();
        }
    }

    /**
     * Clears out the collActionLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addActionLogs()
     */
    public function clearActionLogs()
    {
        $this->collActionLogs = null; // important to set this to null since that means it is uninitialized
        $this->collActionLogsPartial = null;
    }

    /**
     * reset is the collActionLogs collection loaded partially
     *
     * @return void
     */
    public function resetPartialActionLogs($v = true)
    {
        $this->collActionLogsPartial = $v;
    }

    /**
     * Initializes the collActionLogs collection.
     *
     * By default this just sets the collActionLogs collection to an empty array (like clearcollActionLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initActionLogs($overrideExisting = true)
    {
        if (null !== $this->collActionLogs && !$overrideExisting) {
            return;
        }
        $this->collActionLogs = new PropelObjectCollection();
        $this->collActionLogs->setModel('ActionLog');
    }

    /**
     * Gets an array of ActionLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this SecurityAction is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ActionLog[] List of ActionLog objects
     * @throws PropelException
     */
    public function getActionLogs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collActionLogsPartial && !$this->isNew();
        if (null === $this->collActionLogs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collActionLogs) {
                // return empty collection
                $this->initActionLogs();
            } else {
                $collActionLogs = ActionLogQuery::create(null, $criteria)
                    ->filterBySecurityAction($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collActionLogsPartial && count($collActionLogs)) {
                      $this->initActionLogs(false);

                      foreach($collActionLogs as $obj) {
                        if (false == $this->collActionLogs->contains($obj)) {
                          $this->collActionLogs->append($obj);
                        }
                      }

                      $this->collActionLogsPartial = true;
                    }

                    return $collActionLogs;
                }

                if($partial && $this->collActionLogs) {
                    foreach($this->collActionLogs as $obj) {
                        if($obj->isNew()) {
                            $collActionLogs[] = $obj;
                        }
                    }
                }

                $this->collActionLogs = $collActionLogs;
                $this->collActionLogsPartial = false;
            }
        }

        return $this->collActionLogs;
    }

    /**
     * Sets a collection of ActionLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $actionLogs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setActionLogs(PropelCollection $actionLogs, PropelPDO $con = null)
    {
        $this->actionLogsScheduledForDeletion = $this->getActionLogs(new Criteria(), $con)->diff($actionLogs);

        foreach ($this->actionLogsScheduledForDeletion as $actionLogRemoved) {
            $actionLogRemoved->setSecurityAction(null);
        }

        $this->collActionLogs = null;
        foreach ($actionLogs as $actionLog) {
            $this->addActionLog($actionLog);
        }

        $this->collActionLogs = $actionLogs;
        $this->collActionLogsPartial = false;
    }

    /**
     * Returns the number of related ActionLog objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ActionLog objects.
     * @throws PropelException
     */
    public function countActionLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collActionLogsPartial && !$this->isNew();
        if (null === $this->collActionLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collActionLogs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getActionLogs());
                }
                $query = ActionLogQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySecurityAction($this)
                    ->count($con);
            }
        } else {
            return count($this->collActionLogs);
        }
    }

    /**
     * Method called to associate a ActionLog object to this object
     * through the ActionLog foreign key attribute.
     *
     * @param    ActionLog $l ActionLog
     * @return SecurityAction The current object (for fluent API support)
     */
    public function addActionLog(ActionLog $l)
    {
        if ($this->collActionLogs === null) {
            $this->initActionLogs();
            $this->collActionLogsPartial = true;
        }
        if (!$this->collActionLogs->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddActionLog($l);
        }

        return $this;
    }

    /**
     * @param	ActionLog $actionLog The actionLog object to add.
     */
    protected function doAddActionLog($actionLog)
    {
        $this->collActionLogs[]= $actionLog;
        $actionLog->setSecurityAction($this);
    }

    /**
     * @param	ActionLog $actionLog The actionLog object to remove.
     */
    public function removeActionLog($actionLog)
    {
        if ($this->getActionLogs()->contains($actionLog)) {
            $this->collActionLogs->remove($this->collActionLogs->search($actionLog));
            if (null === $this->actionLogsScheduledForDeletion) {
                $this->actionLogsScheduledForDeletion = clone $this->collActionLogs;
                $this->actionLogsScheduledForDeletion->clear();
            }
            $this->actionLogsScheduledForDeletion[]= $actionLog;
            $actionLog->setSecurityAction(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->action = null;
        $this->module = null;
        $this->section = null;
        $this->access = null;
        $this->accessaffiliateuser = null;
        $this->accessregistrationuser = null;
        $this->accessclientuser = null;
        $this->active = null;
        $this->pair = null;
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
            if ($this->collActionLogs) {
                foreach ($this->collActionLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collActionLogs instanceof PropelCollection) {
            $this->collActionLogs->clearIterator();
        }
        $this->collActionLogs = null;
        $this->aSecurityModule = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SecurityActionPeer::DEFAULT_STRING_FORMAT);
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
