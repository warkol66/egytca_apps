<?php


/**
 * Base class that represents a row from the 'modules_module' table.
 *
 *  Registro de modulos
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModule extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ModulePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ModulePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $active;

    /**
     * The value for the alwaysactive field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $alwaysactive;

    /**
     * The value for the hascategories field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $hascategories;

    /**
     * @var        PropelObjectCollection|ModuleDependency[] Collection to store aggregation of ModuleDependency objects.
     */
    protected $collModuleDependencys;
    protected $collModuleDependencysPartial;

    /**
     * @var        PropelObjectCollection|ModuleLabel[] Collection to store aggregation of ModuleLabel objects.
     */
    protected $collModuleLabels;
    protected $collModuleLabelsPartial;

    /**
     * @var        PropelObjectCollection|ModuleEntity[] Collection to store aggregation of ModuleEntity objects.
     */
    protected $collModuleEntitys;
    protected $collModuleEntitysPartial;

    /**
     * @var        PropelObjectCollection|MultilangText[] Collection to store aggregation of MultilangText objects.
     */
    protected $collMultilangTexts;
    protected $collMultilangTextsPartial;

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
    protected $moduleDependencysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $moduleLabelsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $moduleEntitysScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $multilangTextsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->active = false;
        $this->alwaysactive = false;
        $this->hascategories = false;
    }

    /**
     * Initializes internal state of BaseModule object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [name] column value.
     * nombre del modulo
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [active] column value.
     * Estado del modulo
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get the [alwaysactive] column value.
     * Modulo siempre activo
     * @return boolean
     */
    public function getAlwaysactive()
    {
        return $this->alwaysactive;
    }

    /**
     * Get the [hascategories] column value.
     * El Modulo tiene categorias relacionadas?
     * @return boolean
     */
    public function getHascategories()
    {
        return $this->hascategories;
    }

    /**
     * Set the value of [name] column.
     * nombre del modulo
     * @param string $v new value
     * @return Module The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ModulePeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Estado del modulo
     * @param boolean|integer|string $v The new value
     * @return Module The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = ModulePeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Sets the value of the [alwaysactive] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Modulo siempre activo
     * @param boolean|integer|string $v The new value
     * @return Module The current object (for fluent API support)
     */
    public function setAlwaysactive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->alwaysactive !== $v) {
            $this->alwaysactive = $v;
            $this->modifiedColumns[] = ModulePeer::ALWAYSACTIVE;
        }


        return $this;
    } // setAlwaysactive()

    /**
     * Sets the value of the [hascategories] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * El Modulo tiene categorias relacionadas?
     * @param boolean|integer|string $v The new value
     * @return Module The current object (for fluent API support)
     */
    public function setHascategories($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->hascategories !== $v) {
            $this->hascategories = $v;
            $this->modifiedColumns[] = ModulePeer::HASCATEGORIES;
        }


        return $this;
    } // setHascategories()

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
            if ($this->active !== false) {
                return false;
            }

            if ($this->alwaysactive !== false) {
                return false;
            }

            if ($this->hascategories !== false) {
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

            $this->name = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->active = ($row[$startcol + 1] !== null) ? (boolean) $row[$startcol + 1] : null;
            $this->alwaysactive = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->hascategories = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = ModulePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Module object", $e);
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
            $con = Propel::getConnection(ModulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ModulePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collModuleDependencys = null;

            $this->collModuleLabels = null;

            $this->collModuleEntitys = null;

            $this->collMultilangTexts = null;

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
            $con = Propel::getConnection(ModulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ModuleQuery::create()
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
            $con = Propel::getConnection(ModulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ModulePeer::addInstanceToPool($this);
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

            if ($this->moduleDependencysScheduledForDeletion !== null) {
                if (!$this->moduleDependencysScheduledForDeletion->isEmpty()) {
                    ModuleDependencyQuery::create()
                        ->filterByPrimaryKeys($this->moduleDependencysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->moduleDependencysScheduledForDeletion = null;
                }
            }

            if ($this->collModuleDependencys !== null) {
                foreach ($this->collModuleDependencys as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->moduleLabelsScheduledForDeletion !== null) {
                if (!$this->moduleLabelsScheduledForDeletion->isEmpty()) {
                    ModuleLabelQuery::create()
                        ->filterByPrimaryKeys($this->moduleLabelsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->moduleLabelsScheduledForDeletion = null;
                }
            }

            if ($this->collModuleLabels !== null) {
                foreach ($this->collModuleLabels as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->moduleEntitysScheduledForDeletion !== null) {
                if (!$this->moduleEntitysScheduledForDeletion->isEmpty()) {
                    ModuleEntityQuery::create()
                        ->filterByPrimaryKeys($this->moduleEntitysScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->moduleEntitysScheduledForDeletion = null;
                }
            }

            if ($this->collModuleEntitys !== null) {
                foreach ($this->collModuleEntitys as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->multilangTextsScheduledForDeletion !== null) {
                if (!$this->multilangTextsScheduledForDeletion->isEmpty()) {
                    MultilangTextQuery::create()
                        ->filterByPrimaryKeys($this->multilangTextsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->multilangTextsScheduledForDeletion = null;
                }
            }

            if ($this->collMultilangTexts !== null) {
                foreach ($this->collMultilangTexts as $referrerFK) {
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
        if ($this->isColumnModified(ModulePeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(ModulePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }
        if ($this->isColumnModified(ModulePeer::ALWAYSACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ALWAYSACTIVE`';
        }
        if ($this->isColumnModified(ModulePeer::HASCATEGORIES)) {
            $modifiedColumns[':p' . $index++]  = '`HASCATEGORIES`';
        }

        $sql = sprintf(
            'INSERT INTO `modules_module` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`NAME`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`ACTIVE`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                    case '`ALWAYSACTIVE`':
                        $stmt->bindValue($identifier, (int) $this->alwaysactive, PDO::PARAM_INT);
                        break;
                    case '`HASCATEGORIES`':
                        $stmt->bindValue($identifier, (int) $this->hascategories, PDO::PARAM_INT);
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


            if (($retval = ModulePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collModuleDependencys !== null) {
                    foreach ($this->collModuleDependencys as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collModuleLabels !== null) {
                    foreach ($this->collModuleLabels as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collModuleEntitys !== null) {
                    foreach ($this->collModuleEntitys as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collMultilangTexts !== null) {
                    foreach ($this->collMultilangTexts as $referrerFK) {
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
        $pos = ModulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 1:
                return $this->getActive();
                break;
            case 2:
                return $this->getAlwaysactive();
                break;
            case 3:
                return $this->getHascategories();
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
        if (isset($alreadyDumpedObjects['Module'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Module'][$this->getPrimaryKey()] = true;
        $keys = ModulePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getName(),
            $keys[1] => $this->getActive(),
            $keys[2] => $this->getAlwaysactive(),
            $keys[3] => $this->getHascategories(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collModuleDependencys) {
                $result['ModuleDependencys'] = $this->collModuleDependencys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collModuleLabels) {
                $result['ModuleLabels'] = $this->collModuleLabels->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collModuleEntitys) {
                $result['ModuleEntitys'] = $this->collModuleEntitys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMultilangTexts) {
                $result['MultilangTexts'] = $this->collMultilangTexts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ModulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 1:
                $this->setActive($value);
                break;
            case 2:
                $this->setAlwaysactive($value);
                break;
            case 3:
                $this->setHascategories($value);
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
        $keys = ModulePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setName($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setActive($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setAlwaysactive($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setHascategories($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ModulePeer::DATABASE_NAME);

        if ($this->isColumnModified(ModulePeer::NAME)) $criteria->add(ModulePeer::NAME, $this->name);
        if ($this->isColumnModified(ModulePeer::ACTIVE)) $criteria->add(ModulePeer::ACTIVE, $this->active);
        if ($this->isColumnModified(ModulePeer::ALWAYSACTIVE)) $criteria->add(ModulePeer::ALWAYSACTIVE, $this->alwaysactive);
        if ($this->isColumnModified(ModulePeer::HASCATEGORIES)) $criteria->add(ModulePeer::HASCATEGORIES, $this->hascategories);

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
        $criteria = new Criteria(ModulePeer::DATABASE_NAME);
        $criteria->add(ModulePeer::NAME, $this->name);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getName();
    }

    /**
     * Generic method to set the primary key (name column).
     *
     * @param  string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setName($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getName();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Module (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setActive($this->getActive());
        $copyObj->setAlwaysactive($this->getAlwaysactive());
        $copyObj->setHascategories($this->getHascategories());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getModuleDependencys() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addModuleDependency($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getModuleLabels() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addModuleLabel($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getModuleEntitys() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addModuleEntity($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMultilangTexts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMultilangText($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setName(NULL); // this is a auto-increment column, so set to default value
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
     * @return Module Clone of current object.
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
     * @return ModulePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ModulePeer();
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
        if ('ModuleDependency' == $relationName) {
            $this->initModuleDependencys();
        }
        if ('ModuleLabel' == $relationName) {
            $this->initModuleLabels();
        }
        if ('ModuleEntity' == $relationName) {
            $this->initModuleEntitys();
        }
        if ('MultilangText' == $relationName) {
            $this->initMultilangTexts();
        }
    }

    /**
     * Clears out the collModuleDependencys collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addModuleDependencys()
     */
    public function clearModuleDependencys()
    {
        $this->collModuleDependencys = null; // important to set this to null since that means it is uninitialized
        $this->collModuleDependencysPartial = null;
    }

    /**
     * reset is the collModuleDependencys collection loaded partially
     *
     * @return void
     */
    public function resetPartialModuleDependencys($v = true)
    {
        $this->collModuleDependencysPartial = $v;
    }

    /**
     * Initializes the collModuleDependencys collection.
     *
     * By default this just sets the collModuleDependencys collection to an empty array (like clearcollModuleDependencys());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initModuleDependencys($overrideExisting = true)
    {
        if (null !== $this->collModuleDependencys && !$overrideExisting) {
            return;
        }
        $this->collModuleDependencys = new PropelObjectCollection();
        $this->collModuleDependencys->setModel('ModuleDependency');
    }

    /**
     * Gets an array of ModuleDependency objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Module is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ModuleDependency[] List of ModuleDependency objects
     * @throws PropelException
     */
    public function getModuleDependencys($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collModuleDependencysPartial && !$this->isNew();
        if (null === $this->collModuleDependencys || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collModuleDependencys) {
                // return empty collection
                $this->initModuleDependencys();
            } else {
                $collModuleDependencys = ModuleDependencyQuery::create(null, $criteria)
                    ->filterByModule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collModuleDependencysPartial && count($collModuleDependencys)) {
                      $this->initModuleDependencys(false);

                      foreach($collModuleDependencys as $obj) {
                        if (false == $this->collModuleDependencys->contains($obj)) {
                          $this->collModuleDependencys->append($obj);
                        }
                      }

                      $this->collModuleDependencysPartial = true;
                    }

                    return $collModuleDependencys;
                }

                if($partial && $this->collModuleDependencys) {
                    foreach($this->collModuleDependencys as $obj) {
                        if($obj->isNew()) {
                            $collModuleDependencys[] = $obj;
                        }
                    }
                }

                $this->collModuleDependencys = $collModuleDependencys;
                $this->collModuleDependencysPartial = false;
            }
        }

        return $this->collModuleDependencys;
    }

    /**
     * Sets a collection of ModuleDependency objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $moduleDependencys A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setModuleDependencys(PropelCollection $moduleDependencys, PropelPDO $con = null)
    {
        $this->moduleDependencysScheduledForDeletion = $this->getModuleDependencys(new Criteria(), $con)->diff($moduleDependencys);

        foreach ($this->moduleDependencysScheduledForDeletion as $moduleDependencyRemoved) {
            $moduleDependencyRemoved->setModule(null);
        }

        $this->collModuleDependencys = null;
        foreach ($moduleDependencys as $moduleDependency) {
            $this->addModuleDependency($moduleDependency);
        }

        $this->collModuleDependencys = $moduleDependencys;
        $this->collModuleDependencysPartial = false;
    }

    /**
     * Returns the number of related ModuleDependency objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ModuleDependency objects.
     * @throws PropelException
     */
    public function countModuleDependencys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collModuleDependencysPartial && !$this->isNew();
        if (null === $this->collModuleDependencys || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collModuleDependencys) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getModuleDependencys());
                }
                $query = ModuleDependencyQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModule($this)
                    ->count($con);
            }
        } else {
            return count($this->collModuleDependencys);
        }
    }

    /**
     * Method called to associate a ModuleDependency object to this object
     * through the ModuleDependency foreign key attribute.
     *
     * @param    ModuleDependency $l ModuleDependency
     * @return Module The current object (for fluent API support)
     */
    public function addModuleDependency(ModuleDependency $l)
    {
        if ($this->collModuleDependencys === null) {
            $this->initModuleDependencys();
            $this->collModuleDependencysPartial = true;
        }
        if (!$this->collModuleDependencys->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddModuleDependency($l);
        }

        return $this;
    }

    /**
     * @param	ModuleDependency $moduleDependency The moduleDependency object to add.
     */
    protected function doAddModuleDependency($moduleDependency)
    {
        $this->collModuleDependencys[]= $moduleDependency;
        $moduleDependency->setModule($this);
    }

    /**
     * @param	ModuleDependency $moduleDependency The moduleDependency object to remove.
     */
    public function removeModuleDependency($moduleDependency)
    {
        if ($this->getModuleDependencys()->contains($moduleDependency)) {
            $this->collModuleDependencys->remove($this->collModuleDependencys->search($moduleDependency));
            if (null === $this->moduleDependencysScheduledForDeletion) {
                $this->moduleDependencysScheduledForDeletion = clone $this->collModuleDependencys;
                $this->moduleDependencysScheduledForDeletion->clear();
            }
            $this->moduleDependencysScheduledForDeletion[]= $moduleDependency;
            $moduleDependency->setModule(null);
        }
    }

    /**
     * Clears out the collModuleLabels collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addModuleLabels()
     */
    public function clearModuleLabels()
    {
        $this->collModuleLabels = null; // important to set this to null since that means it is uninitialized
        $this->collModuleLabelsPartial = null;
    }

    /**
     * reset is the collModuleLabels collection loaded partially
     *
     * @return void
     */
    public function resetPartialModuleLabels($v = true)
    {
        $this->collModuleLabelsPartial = $v;
    }

    /**
     * Initializes the collModuleLabels collection.
     *
     * By default this just sets the collModuleLabels collection to an empty array (like clearcollModuleLabels());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initModuleLabels($overrideExisting = true)
    {
        if (null !== $this->collModuleLabels && !$overrideExisting) {
            return;
        }
        $this->collModuleLabels = new PropelObjectCollection();
        $this->collModuleLabels->setModel('ModuleLabel');
    }

    /**
     * Gets an array of ModuleLabel objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Module is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ModuleLabel[] List of ModuleLabel objects
     * @throws PropelException
     */
    public function getModuleLabels($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collModuleLabelsPartial && !$this->isNew();
        if (null === $this->collModuleLabels || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collModuleLabels) {
                // return empty collection
                $this->initModuleLabels();
            } else {
                $collModuleLabels = ModuleLabelQuery::create(null, $criteria)
                    ->filterByModule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collModuleLabelsPartial && count($collModuleLabels)) {
                      $this->initModuleLabels(false);

                      foreach($collModuleLabels as $obj) {
                        if (false == $this->collModuleLabels->contains($obj)) {
                          $this->collModuleLabels->append($obj);
                        }
                      }

                      $this->collModuleLabelsPartial = true;
                    }

                    return $collModuleLabels;
                }

                if($partial && $this->collModuleLabels) {
                    foreach($this->collModuleLabels as $obj) {
                        if($obj->isNew()) {
                            $collModuleLabels[] = $obj;
                        }
                    }
                }

                $this->collModuleLabels = $collModuleLabels;
                $this->collModuleLabelsPartial = false;
            }
        }

        return $this->collModuleLabels;
    }

    /**
     * Sets a collection of ModuleLabel objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $moduleLabels A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setModuleLabels(PropelCollection $moduleLabels, PropelPDO $con = null)
    {
        $this->moduleLabelsScheduledForDeletion = $this->getModuleLabels(new Criteria(), $con)->diff($moduleLabels);

        foreach ($this->moduleLabelsScheduledForDeletion as $moduleLabelRemoved) {
            $moduleLabelRemoved->setModule(null);
        }

        $this->collModuleLabels = null;
        foreach ($moduleLabels as $moduleLabel) {
            $this->addModuleLabel($moduleLabel);
        }

        $this->collModuleLabels = $moduleLabels;
        $this->collModuleLabelsPartial = false;
    }

    /**
     * Returns the number of related ModuleLabel objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ModuleLabel objects.
     * @throws PropelException
     */
    public function countModuleLabels(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collModuleLabelsPartial && !$this->isNew();
        if (null === $this->collModuleLabels || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collModuleLabels) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getModuleLabels());
                }
                $query = ModuleLabelQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModule($this)
                    ->count($con);
            }
        } else {
            return count($this->collModuleLabels);
        }
    }

    /**
     * Method called to associate a ModuleLabel object to this object
     * through the ModuleLabel foreign key attribute.
     *
     * @param    ModuleLabel $l ModuleLabel
     * @return Module The current object (for fluent API support)
     */
    public function addModuleLabel(ModuleLabel $l)
    {
        if ($this->collModuleLabels === null) {
            $this->initModuleLabels();
            $this->collModuleLabelsPartial = true;
        }
        if (!$this->collModuleLabels->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddModuleLabel($l);
        }

        return $this;
    }

    /**
     * @param	ModuleLabel $moduleLabel The moduleLabel object to add.
     */
    protected function doAddModuleLabel($moduleLabel)
    {
        $this->collModuleLabels[]= $moduleLabel;
        $moduleLabel->setModule($this);
    }

    /**
     * @param	ModuleLabel $moduleLabel The moduleLabel object to remove.
     */
    public function removeModuleLabel($moduleLabel)
    {
        if ($this->getModuleLabels()->contains($moduleLabel)) {
            $this->collModuleLabels->remove($this->collModuleLabels->search($moduleLabel));
            if (null === $this->moduleLabelsScheduledForDeletion) {
                $this->moduleLabelsScheduledForDeletion = clone $this->collModuleLabels;
                $this->moduleLabelsScheduledForDeletion->clear();
            }
            $this->moduleLabelsScheduledForDeletion[]= $moduleLabel;
            $moduleLabel->setModule(null);
        }
    }

    /**
     * Clears out the collModuleEntitys collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addModuleEntitys()
     */
    public function clearModuleEntitys()
    {
        $this->collModuleEntitys = null; // important to set this to null since that means it is uninitialized
        $this->collModuleEntitysPartial = null;
    }

    /**
     * reset is the collModuleEntitys collection loaded partially
     *
     * @return void
     */
    public function resetPartialModuleEntitys($v = true)
    {
        $this->collModuleEntitysPartial = $v;
    }

    /**
     * Initializes the collModuleEntitys collection.
     *
     * By default this just sets the collModuleEntitys collection to an empty array (like clearcollModuleEntitys());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initModuleEntitys($overrideExisting = true)
    {
        if (null !== $this->collModuleEntitys && !$overrideExisting) {
            return;
        }
        $this->collModuleEntitys = new PropelObjectCollection();
        $this->collModuleEntitys->setModel('ModuleEntity');
    }

    /**
     * Gets an array of ModuleEntity objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Module is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ModuleEntity[] List of ModuleEntity objects
     * @throws PropelException
     */
    public function getModuleEntitys($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collModuleEntitysPartial && !$this->isNew();
        if (null === $this->collModuleEntitys || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collModuleEntitys) {
                // return empty collection
                $this->initModuleEntitys();
            } else {
                $collModuleEntitys = ModuleEntityQuery::create(null, $criteria)
                    ->filterByModule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collModuleEntitysPartial && count($collModuleEntitys)) {
                      $this->initModuleEntitys(false);

                      foreach($collModuleEntitys as $obj) {
                        if (false == $this->collModuleEntitys->contains($obj)) {
                          $this->collModuleEntitys->append($obj);
                        }
                      }

                      $this->collModuleEntitysPartial = true;
                    }

                    return $collModuleEntitys;
                }

                if($partial && $this->collModuleEntitys) {
                    foreach($this->collModuleEntitys as $obj) {
                        if($obj->isNew()) {
                            $collModuleEntitys[] = $obj;
                        }
                    }
                }

                $this->collModuleEntitys = $collModuleEntitys;
                $this->collModuleEntitysPartial = false;
            }
        }

        return $this->collModuleEntitys;
    }

    /**
     * Sets a collection of ModuleEntity objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $moduleEntitys A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setModuleEntitys(PropelCollection $moduleEntitys, PropelPDO $con = null)
    {
        $this->moduleEntitysScheduledForDeletion = $this->getModuleEntitys(new Criteria(), $con)->diff($moduleEntitys);

        foreach ($this->moduleEntitysScheduledForDeletion as $moduleEntityRemoved) {
            $moduleEntityRemoved->setModule(null);
        }

        $this->collModuleEntitys = null;
        foreach ($moduleEntitys as $moduleEntity) {
            $this->addModuleEntity($moduleEntity);
        }

        $this->collModuleEntitys = $moduleEntitys;
        $this->collModuleEntitysPartial = false;
    }

    /**
     * Returns the number of related ModuleEntity objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ModuleEntity objects.
     * @throws PropelException
     */
    public function countModuleEntitys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collModuleEntitysPartial && !$this->isNew();
        if (null === $this->collModuleEntitys || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collModuleEntitys) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getModuleEntitys());
                }
                $query = ModuleEntityQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModule($this)
                    ->count($con);
            }
        } else {
            return count($this->collModuleEntitys);
        }
    }

    /**
     * Method called to associate a ModuleEntity object to this object
     * through the ModuleEntity foreign key attribute.
     *
     * @param    ModuleEntity $l ModuleEntity
     * @return Module The current object (for fluent API support)
     */
    public function addModuleEntity(ModuleEntity $l)
    {
        if ($this->collModuleEntitys === null) {
            $this->initModuleEntitys();
            $this->collModuleEntitysPartial = true;
        }
        if (!$this->collModuleEntitys->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddModuleEntity($l);
        }

        return $this;
    }

    /**
     * @param	ModuleEntity $moduleEntity The moduleEntity object to add.
     */
    protected function doAddModuleEntity($moduleEntity)
    {
        $this->collModuleEntitys[]= $moduleEntity;
        $moduleEntity->setModule($this);
    }

    /**
     * @param	ModuleEntity $moduleEntity The moduleEntity object to remove.
     */
    public function removeModuleEntity($moduleEntity)
    {
        if ($this->getModuleEntitys()->contains($moduleEntity)) {
            $this->collModuleEntitys->remove($this->collModuleEntitys->search($moduleEntity));
            if (null === $this->moduleEntitysScheduledForDeletion) {
                $this->moduleEntitysScheduledForDeletion = clone $this->collModuleEntitys;
                $this->moduleEntitysScheduledForDeletion->clear();
            }
            $this->moduleEntitysScheduledForDeletion[]= $moduleEntity;
            $moduleEntity->setModule(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Module is new, it will return
     * an empty collection; or if this Module has previously
     * been saved, it will retrieve related ModuleEntitys from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Module.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ModuleEntity[] List of ModuleEntity objects
     */
    public function getModuleEntitysJoinModuleEntityFieldRelatedByScopefielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ModuleEntityQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByScopefielduniquename', $join_behavior);

        return $this->getModuleEntitys($query, $con);
    }

    /**
     * Clears out the collMultilangTexts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMultilangTexts()
     */
    public function clearMultilangTexts()
    {
        $this->collMultilangTexts = null; // important to set this to null since that means it is uninitialized
        $this->collMultilangTextsPartial = null;
    }

    /**
     * reset is the collMultilangTexts collection loaded partially
     *
     * @return void
     */
    public function resetPartialMultilangTexts($v = true)
    {
        $this->collMultilangTextsPartial = $v;
    }

    /**
     * Initializes the collMultilangTexts collection.
     *
     * By default this just sets the collMultilangTexts collection to an empty array (like clearcollMultilangTexts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMultilangTexts($overrideExisting = true)
    {
        if (null !== $this->collMultilangTexts && !$overrideExisting) {
            return;
        }
        $this->collMultilangTexts = new PropelObjectCollection();
        $this->collMultilangTexts->setModel('MultilangText');
    }

    /**
     * Gets an array of MultilangText objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Module is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MultilangText[] List of MultilangText objects
     * @throws PropelException
     */
    public function getMultilangTexts($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMultilangTextsPartial && !$this->isNew();
        if (null === $this->collMultilangTexts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMultilangTexts) {
                // return empty collection
                $this->initMultilangTexts();
            } else {
                $collMultilangTexts = MultilangTextQuery::create(null, $criteria)
                    ->filterByModule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMultilangTextsPartial && count($collMultilangTexts)) {
                      $this->initMultilangTexts(false);

                      foreach($collMultilangTexts as $obj) {
                        if (false == $this->collMultilangTexts->contains($obj)) {
                          $this->collMultilangTexts->append($obj);
                        }
                      }

                      $this->collMultilangTextsPartial = true;
                    }

                    return $collMultilangTexts;
                }

                if($partial && $this->collMultilangTexts) {
                    foreach($this->collMultilangTexts as $obj) {
                        if($obj->isNew()) {
                            $collMultilangTexts[] = $obj;
                        }
                    }
                }

                $this->collMultilangTexts = $collMultilangTexts;
                $this->collMultilangTextsPartial = false;
            }
        }

        return $this->collMultilangTexts;
    }

    /**
     * Sets a collection of MultilangText objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $multilangTexts A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setMultilangTexts(PropelCollection $multilangTexts, PropelPDO $con = null)
    {
        $this->multilangTextsScheduledForDeletion = $this->getMultilangTexts(new Criteria(), $con)->diff($multilangTexts);

        foreach ($this->multilangTextsScheduledForDeletion as $multilangTextRemoved) {
            $multilangTextRemoved->setModule(null);
        }

        $this->collMultilangTexts = null;
        foreach ($multilangTexts as $multilangText) {
            $this->addMultilangText($multilangText);
        }

        $this->collMultilangTexts = $multilangTexts;
        $this->collMultilangTextsPartial = false;
    }

    /**
     * Returns the number of related MultilangText objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MultilangText objects.
     * @throws PropelException
     */
    public function countMultilangTexts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMultilangTextsPartial && !$this->isNew();
        if (null === $this->collMultilangTexts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMultilangTexts) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getMultilangTexts());
                }
                $query = MultilangTextQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModule($this)
                    ->count($con);
            }
        } else {
            return count($this->collMultilangTexts);
        }
    }

    /**
     * Method called to associate a MultilangText object to this object
     * through the MultilangText foreign key attribute.
     *
     * @param    MultilangText $l MultilangText
     * @return Module The current object (for fluent API support)
     */
    public function addMultilangText(MultilangText $l)
    {
        if ($this->collMultilangTexts === null) {
            $this->initMultilangTexts();
            $this->collMultilangTextsPartial = true;
        }
        if (!$this->collMultilangTexts->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddMultilangText($l);
        }

        return $this;
    }

    /**
     * @param	MultilangText $multilangText The multilangText object to add.
     */
    protected function doAddMultilangText($multilangText)
    {
        $this->collMultilangTexts[]= $multilangText;
        $multilangText->setModule($this);
    }

    /**
     * @param	MultilangText $multilangText The multilangText object to remove.
     */
    public function removeMultilangText($multilangText)
    {
        if ($this->getMultilangTexts()->contains($multilangText)) {
            $this->collMultilangTexts->remove($this->collMultilangTexts->search($multilangText));
            if (null === $this->multilangTextsScheduledForDeletion) {
                $this->multilangTextsScheduledForDeletion = clone $this->collMultilangTexts;
                $this->multilangTextsScheduledForDeletion->clear();
            }
            $this->multilangTextsScheduledForDeletion[]= $multilangText;
            $multilangText->setModule(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Module is new, it will return
     * an empty collection; or if this Module has previously
     * been saved, it will retrieve related MultilangTexts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Module.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MultilangText[] List of MultilangText objects
     */
    public function getMultilangTextsJoinMultilangLanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MultilangTextQuery::create(null, $criteria);
        $query->joinWith('MultilangLanguage', $join_behavior);

        return $this->getMultilangTexts($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->name = null;
        $this->active = null;
        $this->alwaysactive = null;
        $this->hascategories = null;
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
            if ($this->collModuleDependencys) {
                foreach ($this->collModuleDependencys as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collModuleLabels) {
                foreach ($this->collModuleLabels as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collModuleEntitys) {
                foreach ($this->collModuleEntitys as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMultilangTexts) {
                foreach ($this->collMultilangTexts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collModuleDependencys instanceof PropelCollection) {
            $this->collModuleDependencys->clearIterator();
        }
        $this->collModuleDependencys = null;
        if ($this->collModuleLabels instanceof PropelCollection) {
            $this->collModuleLabels->clearIterator();
        }
        $this->collModuleLabels = null;
        if ($this->collModuleEntitys instanceof PropelCollection) {
            $this->collModuleEntitys->clearIterator();
        }
        $this->collModuleEntitys = null;
        if ($this->collMultilangTexts instanceof PropelCollection) {
            $this->collMultilangTexts->clearIterator();
        }
        $this->collMultilangTexts = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ModulePeer::DEFAULT_STRING_FORMAT);
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
