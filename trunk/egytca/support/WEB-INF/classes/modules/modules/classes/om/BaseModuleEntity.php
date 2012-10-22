<?php


/**
 * Base class that represents a row from the 'modules_entity' table.
 *
 * Entidades de modulos
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleEntity extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ModuleEntityPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ModuleEntityPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the modulename field.
     * @var        string
     */
    protected $modulename;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the phpname field.
     * @var        string
     */
    protected $phpname;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the softdelete field.
     * @var        boolean
     */
    protected $softdelete;

    /**
     * The value for the relation field.
     * @var        boolean
     */
    protected $relation;

    /**
     * The value for the savelog field.
     * @var        boolean
     */
    protected $savelog;

    /**
     * The value for the nestedset field.
     * @var        boolean
     */
    protected $nestedset;

    /**
     * The value for the scopefielduniquename field.
     * @var        string
     */
    protected $scopefielduniquename;

    /**
     * The value for the behaviors field.
     * @var        resource
     */
    protected $behaviors;

    /**
     * @var        Module
     */
    protected $aModule;

    /**
     * @var        ModuleEntityField
     */
    protected $aModuleEntityFieldRelatedByScopefielduniquename;

    /**
     * @var        PropelObjectCollection|ModuleEntityField[] Collection to store aggregation of ModuleEntityField objects.
     */
    protected $collModuleEntityFieldsRelatedByEntityname;
    protected $collModuleEntityFieldsRelatedByEntitynamePartial;

    /**
     * @var        PropelObjectCollection|ModuleEntityField[] Collection to store aggregation of ModuleEntityField objects.
     */
    protected $collModuleEntityFieldsRelatedByForeignkeytable;
    protected $collModuleEntityFieldsRelatedByForeignkeytablePartial;

    /**
     * @var        PropelObjectCollection|AlertSubscription[] Collection to store aggregation of AlertSubscription objects.
     */
    protected $collAlertSubscriptions;
    protected $collAlertSubscriptionsPartial;

    /**
     * @var        PropelObjectCollection|ScheduleSubscription[] Collection to store aggregation of ScheduleSubscription objects.
     */
    protected $collScheduleSubscriptions;
    protected $collScheduleSubscriptionsPartial;

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
    protected $moduleEntityFieldsRelatedByEntitynameScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $alertSubscriptionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $scheduleSubscriptionsScheduledForDeletion = null;

    /**
     * Get the [modulename] column value.
     * nombre del modulo
     * @return string
     */
    public function getModulename()
    {
        return $this->modulename;
    }

    /**
     * Get the [name] column value.
     * Nombre de la entidad
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [phpname] column value.
     * Nombre de la Clase
     * @return string
     */
    public function getPhpname()
    {
        return $this->phpname;
    }

    /**
     * Get the [description] column value.
     * Descripcion de la entidad
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [softdelete] column value.
     * Indica si usa softdelete
     * @return boolean
     */
    public function getSoftdelete()
    {
        return $this->softdelete;
    }

    /**
     * Get the [relation] column value.
     * Indica si es una entidad principal o una relacion de dos entidades
     * @return boolean
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * Get the [savelog] column value.
     * Indica si guarda log de cambios
     * @return boolean
     */
    public function getSavelog()
    {
        return $this->savelog;
    }

    /**
     * Get the [nestedset] column value.
     * Indica si es una entidad nestedset
     * @return boolean
     */
    public function getNestedset()
    {
        return $this->nestedset;
    }

    /**
     * Get the [scopefielduniquename] column value.
     * Indica el campo que es usado como scope en el nestedset
     * @return string
     */
    public function getScopefielduniquename()
    {
        return $this->scopefielduniquename;
    }

    /**
     * Get the [behaviors] column value.
     * Indica los behaviors que tiene la entidad
     * @return resource
     */
    public function getBehaviors()
    {
        return $this->behaviors;
    }

    /**
     * Set the value of [modulename] column.
     * nombre del modulo
     * @param string $v new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setModulename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->modulename !== $v) {
            $this->modulename = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::MODULENAME;
        }

        if ($this->aModule !== null && $this->aModule->getName() !== $v) {
            $this->aModule = null;
        }


        return $this;
    } // setModulename()

    /**
     * Set the value of [name] column.
     * Nombre de la entidad
     * @param string $v new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [phpname] column.
     * Nombre de la Clase
     * @param string $v new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setPhpname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phpname !== $v) {
            $this->phpname = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::PHPNAME;
        }


        return $this;
    } // setPhpname()

    /**
     * Set the value of [description] column.
     * Descripcion de la entidad
     * @param string $v new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Sets the value of the [softdelete] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Indica si usa softdelete
     * @param boolean|integer|string $v The new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setSoftdelete($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->softdelete !== $v) {
            $this->softdelete = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::SOFTDELETE;
        }


        return $this;
    } // setSoftdelete()

    /**
     * Sets the value of the [relation] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Indica si es una entidad principal o una relacion de dos entidades
     * @param boolean|integer|string $v The new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setRelation($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->relation !== $v) {
            $this->relation = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::RELATION;
        }


        return $this;
    } // setRelation()

    /**
     * Sets the value of the [savelog] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Indica si guarda log de cambios
     * @param boolean|integer|string $v The new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setSavelog($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->savelog !== $v) {
            $this->savelog = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::SAVELOG;
        }


        return $this;
    } // setSavelog()

    /**
     * Sets the value of the [nestedset] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * Indica si es una entidad nestedset
     * @param boolean|integer|string $v The new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setNestedset($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->nestedset !== $v) {
            $this->nestedset = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::NESTEDSET;
        }


        return $this;
    } // setNestedset()

    /**
     * Set the value of [scopefielduniquename] column.
     * Indica el campo que es usado como scope en el nestedset
     * @param string $v new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setScopefielduniquename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->scopefielduniquename !== $v) {
            $this->scopefielduniquename = $v;
            $this->modifiedColumns[] = ModuleEntityPeer::SCOPEFIELDUNIQUENAME;
        }

        if ($this->aModuleEntityFieldRelatedByScopefielduniquename !== null && $this->aModuleEntityFieldRelatedByScopefielduniquename->getUniquename() !== $v) {
            $this->aModuleEntityFieldRelatedByScopefielduniquename = null;
        }


        return $this;
    } // setScopefielduniquename()

    /**
     * Set the value of [behaviors] column.
     * Indica los behaviors que tiene la entidad
     * @param resource $v new value
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function setBehaviors($v)
    {
        // Because BLOB columns are streams in PDO we have to assume that they are
        // always modified when a new value is passed in.  For example, the contents
        // of the stream itself may have changed externally.
        if (!is_resource($v) && $v !== null) {
            $this->behaviors = fopen('php://memory', 'r+');
            fwrite($this->behaviors, $v);
            rewind($this->behaviors);
        } else { // it's already a stream
            $this->behaviors = $v;
        }
        $this->modifiedColumns[] = ModuleEntityPeer::BEHAVIORS;


        return $this;
    } // setBehaviors()

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

            $this->modulename = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->phpname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->softdelete = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->relation = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->savelog = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
            $this->nestedset = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
            $this->scopefielduniquename = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            if ($row[$startcol + 9] !== null) {
                $this->behaviors = fopen('php://memory', 'r+');
                fwrite($this->behaviors, $row[$startcol + 9]);
                rewind($this->behaviors);
            } else {
                $this->behaviors = null;
            }
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = ModuleEntityPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating ModuleEntity object", $e);
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

        if ($this->aModule !== null && $this->modulename !== $this->aModule->getName()) {
            $this->aModule = null;
        }
        if ($this->aModuleEntityFieldRelatedByScopefielduniquename !== null && $this->scopefielduniquename !== $this->aModuleEntityFieldRelatedByScopefielduniquename->getUniquename()) {
            $this->aModuleEntityFieldRelatedByScopefielduniquename = null;
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
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ModuleEntityPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aModule = null;
            $this->aModuleEntityFieldRelatedByScopefielduniquename = null;
            $this->collModuleEntityFieldsRelatedByEntityname = null;

            $this->collModuleEntityFieldsRelatedByForeignkeytable = null;

            $this->collAlertSubscriptions = null;

            $this->collScheduleSubscriptions = null;

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
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ModuleEntityQuery::create()
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
            $con = Propel::getConnection(ModuleEntityPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ModuleEntityPeer::addInstanceToPool($this);
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

            if ($this->aModule !== null) {
                if ($this->aModule->isModified() || $this->aModule->isNew()) {
                    $affectedRows += $this->aModule->save($con);
                }
                $this->setModule($this->aModule);
            }

            if ($this->aModuleEntityFieldRelatedByScopefielduniquename !== null) {
                if ($this->aModuleEntityFieldRelatedByScopefielduniquename->isModified() || $this->aModuleEntityFieldRelatedByScopefielduniquename->isNew()) {
                    $affectedRows += $this->aModuleEntityFieldRelatedByScopefielduniquename->save($con);
                }
                $this->setModuleEntityFieldRelatedByScopefielduniquename($this->aModuleEntityFieldRelatedByScopefielduniquename);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                // Rewind the behaviors LOB column, since PDO does not rewind after inserting value.
                if ($this->behaviors !== null && is_resource($this->behaviors)) {
                    rewind($this->behaviors);
                }

                $this->resetModified();
            }

            if ($this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion !== null) {
                if (!$this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion->isEmpty()) {
                    ModuleEntityFieldQuery::create()
                        ->filterByPrimaryKeys($this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion = null;
                }
            }

            if ($this->collModuleEntityFieldsRelatedByEntityname !== null) {
                foreach ($this->collModuleEntityFieldsRelatedByEntityname as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion !== null) {
                if (!$this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion->isEmpty()) {
                    foreach ($this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion as $moduleEntityFieldRelatedByForeignkeytable) {
                        // need to save related object because we set the relation to null
                        $moduleEntityFieldRelatedByForeignkeytable->save($con);
                    }
                    $this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion = null;
                }
            }

            if ($this->collModuleEntityFieldsRelatedByForeignkeytable !== null) {
                foreach ($this->collModuleEntityFieldsRelatedByForeignkeytable as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->alertSubscriptionsScheduledForDeletion !== null) {
                if (!$this->alertSubscriptionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->alertSubscriptionsScheduledForDeletion as $alertSubscription) {
                        // need to save related object because we set the relation to null
                        $alertSubscription->save($con);
                    }
                    $this->alertSubscriptionsScheduledForDeletion = null;
                }
            }

            if ($this->collAlertSubscriptions !== null) {
                foreach ($this->collAlertSubscriptions as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->scheduleSubscriptionsScheduledForDeletion !== null) {
                if (!$this->scheduleSubscriptionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->scheduleSubscriptionsScheduledForDeletion as $scheduleSubscription) {
                        // need to save related object because we set the relation to null
                        $scheduleSubscription->save($con);
                    }
                    $this->scheduleSubscriptionsScheduledForDeletion = null;
                }
            }

            if ($this->collScheduleSubscriptions !== null) {
                foreach ($this->collScheduleSubscriptions as $referrerFK) {
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
        if ($this->isColumnModified(ModuleEntityPeer::MODULENAME)) {
            $modifiedColumns[':p' . $index++]  = '`MODULENAME`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::PHPNAME)) {
            $modifiedColumns[':p' . $index++]  = '`PHPNAME`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`DESCRIPTION`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::SOFTDELETE)) {
            $modifiedColumns[':p' . $index++]  = '`SOFTDELETE`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::RELATION)) {
            $modifiedColumns[':p' . $index++]  = '`RELATION`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::SAVELOG)) {
            $modifiedColumns[':p' . $index++]  = '`SAVELOG`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::NESTEDSET)) {
            $modifiedColumns[':p' . $index++]  = '`NESTEDSET`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::SCOPEFIELDUNIQUENAME)) {
            $modifiedColumns[':p' . $index++]  = '`SCOPEFIELDUNIQUENAME`';
        }
        if ($this->isColumnModified(ModuleEntityPeer::BEHAVIORS)) {
            $modifiedColumns[':p' . $index++]  = '`BEHAVIORS`';
        }

        $sql = sprintf(
            'INSERT INTO `modules_entity` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`MODULENAME`':
                        $stmt->bindValue($identifier, $this->modulename, PDO::PARAM_STR);
                        break;
                    case '`NAME`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`PHPNAME`':
                        $stmt->bindValue($identifier, $this->phpname, PDO::PARAM_STR);
                        break;
                    case '`DESCRIPTION`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`SOFTDELETE`':
                        $stmt->bindValue($identifier, (int) $this->softdelete, PDO::PARAM_INT);
                        break;
                    case '`RELATION`':
                        $stmt->bindValue($identifier, (int) $this->relation, PDO::PARAM_INT);
                        break;
                    case '`SAVELOG`':
                        $stmt->bindValue($identifier, (int) $this->savelog, PDO::PARAM_INT);
                        break;
                    case '`NESTEDSET`':
                        $stmt->bindValue($identifier, (int) $this->nestedset, PDO::PARAM_INT);
                        break;
                    case '`SCOPEFIELDUNIQUENAME`':
                        $stmt->bindValue($identifier, $this->scopefielduniquename, PDO::PARAM_STR);
                        break;
                    case '`BEHAVIORS`':
                        if (is_resource($this->behaviors)) {
                            rewind($this->behaviors);
                        }
                        $stmt->bindValue($identifier, $this->behaviors, PDO::PARAM_LOB);
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

            if ($this->aModule !== null) {
                if (!$this->aModule->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aModule->getValidationFailures());
                }
            }

            if ($this->aModuleEntityFieldRelatedByScopefielduniquename !== null) {
                if (!$this->aModuleEntityFieldRelatedByScopefielduniquename->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aModuleEntityFieldRelatedByScopefielduniquename->getValidationFailures());
                }
            }


            if (($retval = ModuleEntityPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collModuleEntityFieldsRelatedByEntityname !== null) {
                    foreach ($this->collModuleEntityFieldsRelatedByEntityname as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collModuleEntityFieldsRelatedByForeignkeytable !== null) {
                    foreach ($this->collModuleEntityFieldsRelatedByForeignkeytable as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAlertSubscriptions !== null) {
                    foreach ($this->collAlertSubscriptions as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collScheduleSubscriptions !== null) {
                    foreach ($this->collScheduleSubscriptions as $referrerFK) {
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
        $pos = ModuleEntityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getModulename();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getPhpname();
                break;
            case 3:
                return $this->getDescription();
                break;
            case 4:
                return $this->getSoftdelete();
                break;
            case 5:
                return $this->getRelation();
                break;
            case 6:
                return $this->getSavelog();
                break;
            case 7:
                return $this->getNestedset();
                break;
            case 8:
                return $this->getScopefielduniquename();
                break;
            case 9:
                return $this->getBehaviors();
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
        if (isset($alreadyDumpedObjects['ModuleEntity'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ModuleEntity'][$this->getPrimaryKey()] = true;
        $keys = ModuleEntityPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getModulename(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getPhpname(),
            $keys[3] => $this->getDescription(),
            $keys[4] => $this->getSoftdelete(),
            $keys[5] => $this->getRelation(),
            $keys[6] => $this->getSavelog(),
            $keys[7] => $this->getNestedset(),
            $keys[8] => $this->getScopefielduniquename(),
            $keys[9] => $this->getBehaviors(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aModule) {
                $result['Module'] = $this->aModule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aModuleEntityFieldRelatedByScopefielduniquename) {
                $result['ModuleEntityFieldRelatedByScopefielduniquename'] = $this->aModuleEntityFieldRelatedByScopefielduniquename->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collModuleEntityFieldsRelatedByEntityname) {
                $result['ModuleEntityFieldsRelatedByEntityname'] = $this->collModuleEntityFieldsRelatedByEntityname->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collModuleEntityFieldsRelatedByForeignkeytable) {
                $result['ModuleEntityFieldsRelatedByForeignkeytable'] = $this->collModuleEntityFieldsRelatedByForeignkeytable->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAlertSubscriptions) {
                $result['AlertSubscriptions'] = $this->collAlertSubscriptions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collScheduleSubscriptions) {
                $result['ScheduleSubscriptions'] = $this->collScheduleSubscriptions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ModuleEntityPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setModulename($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setPhpname($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
            case 4:
                $this->setSoftdelete($value);
                break;
            case 5:
                $this->setRelation($value);
                break;
            case 6:
                $this->setSavelog($value);
                break;
            case 7:
                $this->setNestedset($value);
                break;
            case 8:
                $this->setScopefielduniquename($value);
                break;
            case 9:
                $this->setBehaviors($value);
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
        $keys = ModuleEntityPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setModulename($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPhpname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSoftdelete($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRelation($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setSavelog($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setNestedset($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setScopefielduniquename($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setBehaviors($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);

        if ($this->isColumnModified(ModuleEntityPeer::MODULENAME)) $criteria->add(ModuleEntityPeer::MODULENAME, $this->modulename);
        if ($this->isColumnModified(ModuleEntityPeer::NAME)) $criteria->add(ModuleEntityPeer::NAME, $this->name);
        if ($this->isColumnModified(ModuleEntityPeer::PHPNAME)) $criteria->add(ModuleEntityPeer::PHPNAME, $this->phpname);
        if ($this->isColumnModified(ModuleEntityPeer::DESCRIPTION)) $criteria->add(ModuleEntityPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(ModuleEntityPeer::SOFTDELETE)) $criteria->add(ModuleEntityPeer::SOFTDELETE, $this->softdelete);
        if ($this->isColumnModified(ModuleEntityPeer::RELATION)) $criteria->add(ModuleEntityPeer::RELATION, $this->relation);
        if ($this->isColumnModified(ModuleEntityPeer::SAVELOG)) $criteria->add(ModuleEntityPeer::SAVELOG, $this->savelog);
        if ($this->isColumnModified(ModuleEntityPeer::NESTEDSET)) $criteria->add(ModuleEntityPeer::NESTEDSET, $this->nestedset);
        if ($this->isColumnModified(ModuleEntityPeer::SCOPEFIELDUNIQUENAME)) $criteria->add(ModuleEntityPeer::SCOPEFIELDUNIQUENAME, $this->scopefielduniquename);
        if ($this->isColumnModified(ModuleEntityPeer::BEHAVIORS)) $criteria->add(ModuleEntityPeer::BEHAVIORS, $this->behaviors);

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
        $criteria = new Criteria(ModuleEntityPeer::DATABASE_NAME);
        $criteria->add(ModuleEntityPeer::NAME, $this->name);

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
     * @param object $copyObj An object of ModuleEntity (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setModulename($this->getModulename());
        $copyObj->setPhpname($this->getPhpname());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setSoftdelete($this->getSoftdelete());
        $copyObj->setRelation($this->getRelation());
        $copyObj->setSavelog($this->getSavelog());
        $copyObj->setNestedset($this->getNestedset());
        $copyObj->setScopefielduniquename($this->getScopefielduniquename());
        $copyObj->setBehaviors($this->getBehaviors());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getModuleEntityFieldsRelatedByEntityname() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addModuleEntityFieldRelatedByEntityname($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getModuleEntityFieldsRelatedByForeignkeytable() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addModuleEntityFieldRelatedByForeignkeytable($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAlertSubscriptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAlertSubscription($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getScheduleSubscriptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addScheduleSubscription($relObj->copy($deepCopy));
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
     * @return ModuleEntity Clone of current object.
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
     * @return ModuleEntityPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ModuleEntityPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Module object.
     *
     * @param             Module $v
     * @return ModuleEntity The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModule(Module $v = null)
    {
        if ($v === null) {
            $this->setModulename(NULL);
        } else {
            $this->setModulename($v->getName());
        }

        $this->aModule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Module object, it will not be re-added.
        if ($v !== null) {
            $v->addModuleEntity($this);
        }


        return $this;
    }


    /**
     * Get the associated Module object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Module The associated Module object.
     * @throws PropelException
     */
    public function getModule(PropelPDO $con = null)
    {
        if ($this->aModule === null && (($this->modulename !== "" && $this->modulename !== null))) {
            $this->aModule = ModuleQuery::create()->findPk($this->modulename, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModule->addModuleEntitys($this);
             */
        }

        return $this->aModule;
    }

    /**
     * Declares an association between this object and a ModuleEntityField object.
     *
     * @param             ModuleEntityField $v
     * @return ModuleEntity The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModuleEntityFieldRelatedByScopefielduniquename(ModuleEntityField $v = null)
    {
        if ($v === null) {
            $this->setScopefielduniquename(NULL);
        } else {
            $this->setScopefielduniquename($v->getUniquename());
        }

        $this->aModuleEntityFieldRelatedByScopefielduniquename = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ModuleEntityField object, it will not be re-added.
        if ($v !== null) {
            $v->addModuleEntityRelatedByScopefielduniquename($this);
        }


        return $this;
    }


    /**
     * Get the associated ModuleEntityField object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return ModuleEntityField The associated ModuleEntityField object.
     * @throws PropelException
     */
    public function getModuleEntityFieldRelatedByScopefielduniquename(PropelPDO $con = null)
    {
        if ($this->aModuleEntityFieldRelatedByScopefielduniquename === null && (($this->scopefielduniquename !== "" && $this->scopefielduniquename !== null))) {
            $this->aModuleEntityFieldRelatedByScopefielduniquename = ModuleEntityFieldQuery::create()->findPk($this->scopefielduniquename, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModuleEntityFieldRelatedByScopefielduniquename->addModuleEntitysRelatedByScopefielduniquename($this);
             */
        }

        return $this->aModuleEntityFieldRelatedByScopefielduniquename;
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
        if ('ModuleEntityFieldRelatedByEntityname' == $relationName) {
            $this->initModuleEntityFieldsRelatedByEntityname();
        }
        if ('ModuleEntityFieldRelatedByForeignkeytable' == $relationName) {
            $this->initModuleEntityFieldsRelatedByForeignkeytable();
        }
        if ('AlertSubscription' == $relationName) {
            $this->initAlertSubscriptions();
        }
        if ('ScheduleSubscription' == $relationName) {
            $this->initScheduleSubscriptions();
        }
    }

    /**
     * Clears out the collModuleEntityFieldsRelatedByEntityname collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addModuleEntityFieldsRelatedByEntityname()
     */
    public function clearModuleEntityFieldsRelatedByEntityname()
    {
        $this->collModuleEntityFieldsRelatedByEntityname = null; // important to set this to null since that means it is uninitialized
        $this->collModuleEntityFieldsRelatedByEntitynamePartial = null;
    }

    /**
     * reset is the collModuleEntityFieldsRelatedByEntityname collection loaded partially
     *
     * @return void
     */
    public function resetPartialModuleEntityFieldsRelatedByEntityname($v = true)
    {
        $this->collModuleEntityFieldsRelatedByEntitynamePartial = $v;
    }

    /**
     * Initializes the collModuleEntityFieldsRelatedByEntityname collection.
     *
     * By default this just sets the collModuleEntityFieldsRelatedByEntityname collection to an empty array (like clearcollModuleEntityFieldsRelatedByEntityname());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initModuleEntityFieldsRelatedByEntityname($overrideExisting = true)
    {
        if (null !== $this->collModuleEntityFieldsRelatedByEntityname && !$overrideExisting) {
            return;
        }
        $this->collModuleEntityFieldsRelatedByEntityname = new PropelObjectCollection();
        $this->collModuleEntityFieldsRelatedByEntityname->setModel('ModuleEntityField');
    }

    /**
     * Gets an array of ModuleEntityField objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ModuleEntity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ModuleEntityField[] List of ModuleEntityField objects
     * @throws PropelException
     */
    public function getModuleEntityFieldsRelatedByEntityname($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collModuleEntityFieldsRelatedByEntitynamePartial && !$this->isNew();
        if (null === $this->collModuleEntityFieldsRelatedByEntityname || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collModuleEntityFieldsRelatedByEntityname) {
                // return empty collection
                $this->initModuleEntityFieldsRelatedByEntityname();
            } else {
                $collModuleEntityFieldsRelatedByEntityname = ModuleEntityFieldQuery::create(null, $criteria)
                    ->filterByModuleEntityRelatedByEntityname($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collModuleEntityFieldsRelatedByEntitynamePartial && count($collModuleEntityFieldsRelatedByEntityname)) {
                      $this->initModuleEntityFieldsRelatedByEntityname(false);

                      foreach($collModuleEntityFieldsRelatedByEntityname as $obj) {
                        if (false == $this->collModuleEntityFieldsRelatedByEntityname->contains($obj)) {
                          $this->collModuleEntityFieldsRelatedByEntityname->append($obj);
                        }
                      }

                      $this->collModuleEntityFieldsRelatedByEntitynamePartial = true;
                    }

                    return $collModuleEntityFieldsRelatedByEntityname;
                }

                if($partial && $this->collModuleEntityFieldsRelatedByEntityname) {
                    foreach($this->collModuleEntityFieldsRelatedByEntityname as $obj) {
                        if($obj->isNew()) {
                            $collModuleEntityFieldsRelatedByEntityname[] = $obj;
                        }
                    }
                }

                $this->collModuleEntityFieldsRelatedByEntityname = $collModuleEntityFieldsRelatedByEntityname;
                $this->collModuleEntityFieldsRelatedByEntitynamePartial = false;
            }
        }

        return $this->collModuleEntityFieldsRelatedByEntityname;
    }

    /**
     * Sets a collection of ModuleEntityFieldRelatedByEntityname objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $moduleEntityFieldsRelatedByEntityname A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setModuleEntityFieldsRelatedByEntityname(PropelCollection $moduleEntityFieldsRelatedByEntityname, PropelPDO $con = null)
    {
        $this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion = $this->getModuleEntityFieldsRelatedByEntityname(new Criteria(), $con)->diff($moduleEntityFieldsRelatedByEntityname);

        foreach ($this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion as $moduleEntityFieldRelatedByEntitynameRemoved) {
            $moduleEntityFieldRelatedByEntitynameRemoved->setModuleEntityRelatedByEntityname(null);
        }

        $this->collModuleEntityFieldsRelatedByEntityname = null;
        foreach ($moduleEntityFieldsRelatedByEntityname as $moduleEntityFieldRelatedByEntityname) {
            $this->addModuleEntityFieldRelatedByEntityname($moduleEntityFieldRelatedByEntityname);
        }

        $this->collModuleEntityFieldsRelatedByEntityname = $moduleEntityFieldsRelatedByEntityname;
        $this->collModuleEntityFieldsRelatedByEntitynamePartial = false;
    }

    /**
     * Returns the number of related ModuleEntityField objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ModuleEntityField objects.
     * @throws PropelException
     */
    public function countModuleEntityFieldsRelatedByEntityname(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collModuleEntityFieldsRelatedByEntitynamePartial && !$this->isNew();
        if (null === $this->collModuleEntityFieldsRelatedByEntityname || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collModuleEntityFieldsRelatedByEntityname) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getModuleEntityFieldsRelatedByEntityname());
                }
                $query = ModuleEntityFieldQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModuleEntityRelatedByEntityname($this)
                    ->count($con);
            }
        } else {
            return count($this->collModuleEntityFieldsRelatedByEntityname);
        }
    }

    /**
     * Method called to associate a ModuleEntityField object to this object
     * through the ModuleEntityField foreign key attribute.
     *
     * @param    ModuleEntityField $l ModuleEntityField
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function addModuleEntityFieldRelatedByEntityname(ModuleEntityField $l)
    {
        if ($this->collModuleEntityFieldsRelatedByEntityname === null) {
            $this->initModuleEntityFieldsRelatedByEntityname();
            $this->collModuleEntityFieldsRelatedByEntitynamePartial = true;
        }
        if (!$this->collModuleEntityFieldsRelatedByEntityname->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddModuleEntityFieldRelatedByEntityname($l);
        }

        return $this;
    }

    /**
     * @param	ModuleEntityFieldRelatedByEntityname $moduleEntityFieldRelatedByEntityname The moduleEntityFieldRelatedByEntityname object to add.
     */
    protected function doAddModuleEntityFieldRelatedByEntityname($moduleEntityFieldRelatedByEntityname)
    {
        $this->collModuleEntityFieldsRelatedByEntityname[]= $moduleEntityFieldRelatedByEntityname;
        $moduleEntityFieldRelatedByEntityname->setModuleEntityRelatedByEntityname($this);
    }

    /**
     * @param	ModuleEntityFieldRelatedByEntityname $moduleEntityFieldRelatedByEntityname The moduleEntityFieldRelatedByEntityname object to remove.
     */
    public function removeModuleEntityFieldRelatedByEntityname($moduleEntityFieldRelatedByEntityname)
    {
        if ($this->getModuleEntityFieldsRelatedByEntityname()->contains($moduleEntityFieldRelatedByEntityname)) {
            $this->collModuleEntityFieldsRelatedByEntityname->remove($this->collModuleEntityFieldsRelatedByEntityname->search($moduleEntityFieldRelatedByEntityname));
            if (null === $this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion) {
                $this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion = clone $this->collModuleEntityFieldsRelatedByEntityname;
                $this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion->clear();
            }
            $this->moduleEntityFieldsRelatedByEntitynameScheduledForDeletion[]= $moduleEntityFieldRelatedByEntityname;
            $moduleEntityFieldRelatedByEntityname->setModuleEntityRelatedByEntityname(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related ModuleEntityFieldsRelatedByEntityname from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ModuleEntityField[] List of ModuleEntityField objects
     */
    public function getModuleEntityFieldsRelatedByEntitynameJoinModuleEntityFieldRelatedByForeignkeyremote($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ModuleEntityFieldQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByForeignkeyremote', $join_behavior);

        return $this->getModuleEntityFieldsRelatedByEntityname($query, $con);
    }

    /**
     * Clears out the collModuleEntityFieldsRelatedByForeignkeytable collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addModuleEntityFieldsRelatedByForeignkeytable()
     */
    public function clearModuleEntityFieldsRelatedByForeignkeytable()
    {
        $this->collModuleEntityFieldsRelatedByForeignkeytable = null; // important to set this to null since that means it is uninitialized
        $this->collModuleEntityFieldsRelatedByForeignkeytablePartial = null;
    }

    /**
     * reset is the collModuleEntityFieldsRelatedByForeignkeytable collection loaded partially
     *
     * @return void
     */
    public function resetPartialModuleEntityFieldsRelatedByForeignkeytable($v = true)
    {
        $this->collModuleEntityFieldsRelatedByForeignkeytablePartial = $v;
    }

    /**
     * Initializes the collModuleEntityFieldsRelatedByForeignkeytable collection.
     *
     * By default this just sets the collModuleEntityFieldsRelatedByForeignkeytable collection to an empty array (like clearcollModuleEntityFieldsRelatedByForeignkeytable());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initModuleEntityFieldsRelatedByForeignkeytable($overrideExisting = true)
    {
        if (null !== $this->collModuleEntityFieldsRelatedByForeignkeytable && !$overrideExisting) {
            return;
        }
        $this->collModuleEntityFieldsRelatedByForeignkeytable = new PropelObjectCollection();
        $this->collModuleEntityFieldsRelatedByForeignkeytable->setModel('ModuleEntityField');
    }

    /**
     * Gets an array of ModuleEntityField objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ModuleEntity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ModuleEntityField[] List of ModuleEntityField objects
     * @throws PropelException
     */
    public function getModuleEntityFieldsRelatedByForeignkeytable($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collModuleEntityFieldsRelatedByForeignkeytablePartial && !$this->isNew();
        if (null === $this->collModuleEntityFieldsRelatedByForeignkeytable || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collModuleEntityFieldsRelatedByForeignkeytable) {
                // return empty collection
                $this->initModuleEntityFieldsRelatedByForeignkeytable();
            } else {
                $collModuleEntityFieldsRelatedByForeignkeytable = ModuleEntityFieldQuery::create(null, $criteria)
                    ->filterByModuleEntityRelatedByForeignkeytable($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collModuleEntityFieldsRelatedByForeignkeytablePartial && count($collModuleEntityFieldsRelatedByForeignkeytable)) {
                      $this->initModuleEntityFieldsRelatedByForeignkeytable(false);

                      foreach($collModuleEntityFieldsRelatedByForeignkeytable as $obj) {
                        if (false == $this->collModuleEntityFieldsRelatedByForeignkeytable->contains($obj)) {
                          $this->collModuleEntityFieldsRelatedByForeignkeytable->append($obj);
                        }
                      }

                      $this->collModuleEntityFieldsRelatedByForeignkeytablePartial = true;
                    }

                    return $collModuleEntityFieldsRelatedByForeignkeytable;
                }

                if($partial && $this->collModuleEntityFieldsRelatedByForeignkeytable) {
                    foreach($this->collModuleEntityFieldsRelatedByForeignkeytable as $obj) {
                        if($obj->isNew()) {
                            $collModuleEntityFieldsRelatedByForeignkeytable[] = $obj;
                        }
                    }
                }

                $this->collModuleEntityFieldsRelatedByForeignkeytable = $collModuleEntityFieldsRelatedByForeignkeytable;
                $this->collModuleEntityFieldsRelatedByForeignkeytablePartial = false;
            }
        }

        return $this->collModuleEntityFieldsRelatedByForeignkeytable;
    }

    /**
     * Sets a collection of ModuleEntityFieldRelatedByForeignkeytable objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $moduleEntityFieldsRelatedByForeignkeytable A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setModuleEntityFieldsRelatedByForeignkeytable(PropelCollection $moduleEntityFieldsRelatedByForeignkeytable, PropelPDO $con = null)
    {
        $this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion = $this->getModuleEntityFieldsRelatedByForeignkeytable(new Criteria(), $con)->diff($moduleEntityFieldsRelatedByForeignkeytable);

        foreach ($this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion as $moduleEntityFieldRelatedByForeignkeytableRemoved) {
            $moduleEntityFieldRelatedByForeignkeytableRemoved->setModuleEntityRelatedByForeignkeytable(null);
        }

        $this->collModuleEntityFieldsRelatedByForeignkeytable = null;
        foreach ($moduleEntityFieldsRelatedByForeignkeytable as $moduleEntityFieldRelatedByForeignkeytable) {
            $this->addModuleEntityFieldRelatedByForeignkeytable($moduleEntityFieldRelatedByForeignkeytable);
        }

        $this->collModuleEntityFieldsRelatedByForeignkeytable = $moduleEntityFieldsRelatedByForeignkeytable;
        $this->collModuleEntityFieldsRelatedByForeignkeytablePartial = false;
    }

    /**
     * Returns the number of related ModuleEntityField objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ModuleEntityField objects.
     * @throws PropelException
     */
    public function countModuleEntityFieldsRelatedByForeignkeytable(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collModuleEntityFieldsRelatedByForeignkeytablePartial && !$this->isNew();
        if (null === $this->collModuleEntityFieldsRelatedByForeignkeytable || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collModuleEntityFieldsRelatedByForeignkeytable) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getModuleEntityFieldsRelatedByForeignkeytable());
                }
                $query = ModuleEntityFieldQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModuleEntityRelatedByForeignkeytable($this)
                    ->count($con);
            }
        } else {
            return count($this->collModuleEntityFieldsRelatedByForeignkeytable);
        }
    }

    /**
     * Method called to associate a ModuleEntityField object to this object
     * through the ModuleEntityField foreign key attribute.
     *
     * @param    ModuleEntityField $l ModuleEntityField
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function addModuleEntityFieldRelatedByForeignkeytable(ModuleEntityField $l)
    {
        if ($this->collModuleEntityFieldsRelatedByForeignkeytable === null) {
            $this->initModuleEntityFieldsRelatedByForeignkeytable();
            $this->collModuleEntityFieldsRelatedByForeignkeytablePartial = true;
        }
        if (!$this->collModuleEntityFieldsRelatedByForeignkeytable->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddModuleEntityFieldRelatedByForeignkeytable($l);
        }

        return $this;
    }

    /**
     * @param	ModuleEntityFieldRelatedByForeignkeytable $moduleEntityFieldRelatedByForeignkeytable The moduleEntityFieldRelatedByForeignkeytable object to add.
     */
    protected function doAddModuleEntityFieldRelatedByForeignkeytable($moduleEntityFieldRelatedByForeignkeytable)
    {
        $this->collModuleEntityFieldsRelatedByForeignkeytable[]= $moduleEntityFieldRelatedByForeignkeytable;
        $moduleEntityFieldRelatedByForeignkeytable->setModuleEntityRelatedByForeignkeytable($this);
    }

    /**
     * @param	ModuleEntityFieldRelatedByForeignkeytable $moduleEntityFieldRelatedByForeignkeytable The moduleEntityFieldRelatedByForeignkeytable object to remove.
     */
    public function removeModuleEntityFieldRelatedByForeignkeytable($moduleEntityFieldRelatedByForeignkeytable)
    {
        if ($this->getModuleEntityFieldsRelatedByForeignkeytable()->contains($moduleEntityFieldRelatedByForeignkeytable)) {
            $this->collModuleEntityFieldsRelatedByForeignkeytable->remove($this->collModuleEntityFieldsRelatedByForeignkeytable->search($moduleEntityFieldRelatedByForeignkeytable));
            if (null === $this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion) {
                $this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion = clone $this->collModuleEntityFieldsRelatedByForeignkeytable;
                $this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion->clear();
            }
            $this->moduleEntityFieldsRelatedByForeignkeytableScheduledForDeletion[]= $moduleEntityFieldRelatedByForeignkeytable;
            $moduleEntityFieldRelatedByForeignkeytable->setModuleEntityRelatedByForeignkeytable(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related ModuleEntityFieldsRelatedByForeignkeytable from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ModuleEntityField[] List of ModuleEntityField objects
     */
    public function getModuleEntityFieldsRelatedByForeignkeytableJoinModuleEntityFieldRelatedByForeignkeyremote($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ModuleEntityFieldQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByForeignkeyremote', $join_behavior);

        return $this->getModuleEntityFieldsRelatedByForeignkeytable($query, $con);
    }

    /**
     * Clears out the collAlertSubscriptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAlertSubscriptions()
     */
    public function clearAlertSubscriptions()
    {
        $this->collAlertSubscriptions = null; // important to set this to null since that means it is uninitialized
        $this->collAlertSubscriptionsPartial = null;
    }

    /**
     * reset is the collAlertSubscriptions collection loaded partially
     *
     * @return void
     */
    public function resetPartialAlertSubscriptions($v = true)
    {
        $this->collAlertSubscriptionsPartial = $v;
    }

    /**
     * Initializes the collAlertSubscriptions collection.
     *
     * By default this just sets the collAlertSubscriptions collection to an empty array (like clearcollAlertSubscriptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAlertSubscriptions($overrideExisting = true)
    {
        if (null !== $this->collAlertSubscriptions && !$overrideExisting) {
            return;
        }
        $this->collAlertSubscriptions = new PropelObjectCollection();
        $this->collAlertSubscriptions->setModel('AlertSubscription');
    }

    /**
     * Gets an array of AlertSubscription objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ModuleEntity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AlertSubscription[] List of AlertSubscription objects
     * @throws PropelException
     */
    public function getAlertSubscriptions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAlertSubscriptionsPartial && !$this->isNew();
        if (null === $this->collAlertSubscriptions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAlertSubscriptions) {
                // return empty collection
                $this->initAlertSubscriptions();
            } else {
                $collAlertSubscriptions = AlertSubscriptionQuery::create(null, $criteria)
                    ->filterByModuleEntity($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAlertSubscriptionsPartial && count($collAlertSubscriptions)) {
                      $this->initAlertSubscriptions(false);

                      foreach($collAlertSubscriptions as $obj) {
                        if (false == $this->collAlertSubscriptions->contains($obj)) {
                          $this->collAlertSubscriptions->append($obj);
                        }
                      }

                      $this->collAlertSubscriptionsPartial = true;
                    }

                    return $collAlertSubscriptions;
                }

                if($partial && $this->collAlertSubscriptions) {
                    foreach($this->collAlertSubscriptions as $obj) {
                        if($obj->isNew()) {
                            $collAlertSubscriptions[] = $obj;
                        }
                    }
                }

                $this->collAlertSubscriptions = $collAlertSubscriptions;
                $this->collAlertSubscriptionsPartial = false;
            }
        }

        return $this->collAlertSubscriptions;
    }

    /**
     * Sets a collection of AlertSubscription objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $alertSubscriptions A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAlertSubscriptions(PropelCollection $alertSubscriptions, PropelPDO $con = null)
    {
        $this->alertSubscriptionsScheduledForDeletion = $this->getAlertSubscriptions(new Criteria(), $con)->diff($alertSubscriptions);

        foreach ($this->alertSubscriptionsScheduledForDeletion as $alertSubscriptionRemoved) {
            $alertSubscriptionRemoved->setModuleEntity(null);
        }

        $this->collAlertSubscriptions = null;
        foreach ($alertSubscriptions as $alertSubscription) {
            $this->addAlertSubscription($alertSubscription);
        }

        $this->collAlertSubscriptions = $alertSubscriptions;
        $this->collAlertSubscriptionsPartial = false;
    }

    /**
     * Returns the number of related AlertSubscription objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AlertSubscription objects.
     * @throws PropelException
     */
    public function countAlertSubscriptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAlertSubscriptionsPartial && !$this->isNew();
        if (null === $this->collAlertSubscriptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAlertSubscriptions) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getAlertSubscriptions());
                }
                $query = AlertSubscriptionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModuleEntity($this)
                    ->count($con);
            }
        } else {
            return count($this->collAlertSubscriptions);
        }
    }

    /**
     * Method called to associate a AlertSubscription object to this object
     * through the AlertSubscription foreign key attribute.
     *
     * @param    AlertSubscription $l AlertSubscription
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function addAlertSubscription(AlertSubscription $l)
    {
        if ($this->collAlertSubscriptions === null) {
            $this->initAlertSubscriptions();
            $this->collAlertSubscriptionsPartial = true;
        }
        if (!$this->collAlertSubscriptions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddAlertSubscription($l);
        }

        return $this;
    }

    /**
     * @param	AlertSubscription $alertSubscription The alertSubscription object to add.
     */
    protected function doAddAlertSubscription($alertSubscription)
    {
        $this->collAlertSubscriptions[]= $alertSubscription;
        $alertSubscription->setModuleEntity($this);
    }

    /**
     * @param	AlertSubscription $alertSubscription The alertSubscription object to remove.
     */
    public function removeAlertSubscription($alertSubscription)
    {
        if ($this->getAlertSubscriptions()->contains($alertSubscription)) {
            $this->collAlertSubscriptions->remove($this->collAlertSubscriptions->search($alertSubscription));
            if (null === $this->alertSubscriptionsScheduledForDeletion) {
                $this->alertSubscriptionsScheduledForDeletion = clone $this->collAlertSubscriptions;
                $this->alertSubscriptionsScheduledForDeletion->clear();
            }
            $this->alertSubscriptionsScheduledForDeletion[]= $alertSubscription;
            $alertSubscription->setModuleEntity(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related AlertSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AlertSubscription[] List of AlertSubscription objects
     */
    public function getAlertSubscriptionsJoinModuleEntityFieldRelatedByEntitynamefielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AlertSubscriptionQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByEntitynamefielduniquename', $join_behavior);

        return $this->getAlertSubscriptions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related AlertSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AlertSubscription[] List of AlertSubscription objects
     */
    public function getAlertSubscriptionsJoinModuleEntityFieldRelatedByEntitydatefielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AlertSubscriptionQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByEntitydatefielduniquename', $join_behavior);

        return $this->getAlertSubscriptions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related AlertSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AlertSubscription[] List of AlertSubscription objects
     */
    public function getAlertSubscriptionsJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AlertSubscriptionQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByEntitybooleanfielduniquename', $join_behavior);

        return $this->getAlertSubscriptions($query, $con);
    }

    /**
     * Clears out the collScheduleSubscriptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addScheduleSubscriptions()
     */
    public function clearScheduleSubscriptions()
    {
        $this->collScheduleSubscriptions = null; // important to set this to null since that means it is uninitialized
        $this->collScheduleSubscriptionsPartial = null;
    }

    /**
     * reset is the collScheduleSubscriptions collection loaded partially
     *
     * @return void
     */
    public function resetPartialScheduleSubscriptions($v = true)
    {
        $this->collScheduleSubscriptionsPartial = $v;
    }

    /**
     * Initializes the collScheduleSubscriptions collection.
     *
     * By default this just sets the collScheduleSubscriptions collection to an empty array (like clearcollScheduleSubscriptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initScheduleSubscriptions($overrideExisting = true)
    {
        if (null !== $this->collScheduleSubscriptions && !$overrideExisting) {
            return;
        }
        $this->collScheduleSubscriptions = new PropelObjectCollection();
        $this->collScheduleSubscriptions->setModel('ScheduleSubscription');
    }

    /**
     * Gets an array of ScheduleSubscription objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ModuleEntity is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ScheduleSubscription[] List of ScheduleSubscription objects
     * @throws PropelException
     */
    public function getScheduleSubscriptions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collScheduleSubscriptionsPartial && !$this->isNew();
        if (null === $this->collScheduleSubscriptions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collScheduleSubscriptions) {
                // return empty collection
                $this->initScheduleSubscriptions();
            } else {
                $collScheduleSubscriptions = ScheduleSubscriptionQuery::create(null, $criteria)
                    ->filterByModuleEntity($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collScheduleSubscriptionsPartial && count($collScheduleSubscriptions)) {
                      $this->initScheduleSubscriptions(false);

                      foreach($collScheduleSubscriptions as $obj) {
                        if (false == $this->collScheduleSubscriptions->contains($obj)) {
                          $this->collScheduleSubscriptions->append($obj);
                        }
                      }

                      $this->collScheduleSubscriptionsPartial = true;
                    }

                    return $collScheduleSubscriptions;
                }

                if($partial && $this->collScheduleSubscriptions) {
                    foreach($this->collScheduleSubscriptions as $obj) {
                        if($obj->isNew()) {
                            $collScheduleSubscriptions[] = $obj;
                        }
                    }
                }

                $this->collScheduleSubscriptions = $collScheduleSubscriptions;
                $this->collScheduleSubscriptionsPartial = false;
            }
        }

        return $this->collScheduleSubscriptions;
    }

    /**
     * Sets a collection of ScheduleSubscription objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $scheduleSubscriptions A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setScheduleSubscriptions(PropelCollection $scheduleSubscriptions, PropelPDO $con = null)
    {
        $this->scheduleSubscriptionsScheduledForDeletion = $this->getScheduleSubscriptions(new Criteria(), $con)->diff($scheduleSubscriptions);

        foreach ($this->scheduleSubscriptionsScheduledForDeletion as $scheduleSubscriptionRemoved) {
            $scheduleSubscriptionRemoved->setModuleEntity(null);
        }

        $this->collScheduleSubscriptions = null;
        foreach ($scheduleSubscriptions as $scheduleSubscription) {
            $this->addScheduleSubscription($scheduleSubscription);
        }

        $this->collScheduleSubscriptions = $scheduleSubscriptions;
        $this->collScheduleSubscriptionsPartial = false;
    }

    /**
     * Returns the number of related ScheduleSubscription objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ScheduleSubscription objects.
     * @throws PropelException
     */
    public function countScheduleSubscriptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collScheduleSubscriptionsPartial && !$this->isNew();
        if (null === $this->collScheduleSubscriptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collScheduleSubscriptions) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getScheduleSubscriptions());
                }
                $query = ScheduleSubscriptionQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByModuleEntity($this)
                    ->count($con);
            }
        } else {
            return count($this->collScheduleSubscriptions);
        }
    }

    /**
     * Method called to associate a ScheduleSubscription object to this object
     * through the ScheduleSubscription foreign key attribute.
     *
     * @param    ScheduleSubscription $l ScheduleSubscription
     * @return ModuleEntity The current object (for fluent API support)
     */
    public function addScheduleSubscription(ScheduleSubscription $l)
    {
        if ($this->collScheduleSubscriptions === null) {
            $this->initScheduleSubscriptions();
            $this->collScheduleSubscriptionsPartial = true;
        }
        if (!$this->collScheduleSubscriptions->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddScheduleSubscription($l);
        }

        return $this;
    }

    /**
     * @param	ScheduleSubscription $scheduleSubscription The scheduleSubscription object to add.
     */
    protected function doAddScheduleSubscription($scheduleSubscription)
    {
        $this->collScheduleSubscriptions[]= $scheduleSubscription;
        $scheduleSubscription->setModuleEntity($this);
    }

    /**
     * @param	ScheduleSubscription $scheduleSubscription The scheduleSubscription object to remove.
     */
    public function removeScheduleSubscription($scheduleSubscription)
    {
        if ($this->getScheduleSubscriptions()->contains($scheduleSubscription)) {
            $this->collScheduleSubscriptions->remove($this->collScheduleSubscriptions->search($scheduleSubscription));
            if (null === $this->scheduleSubscriptionsScheduledForDeletion) {
                $this->scheduleSubscriptionsScheduledForDeletion = clone $this->collScheduleSubscriptions;
                $this->scheduleSubscriptionsScheduledForDeletion->clear();
            }
            $this->scheduleSubscriptionsScheduledForDeletion[]= $scheduleSubscription;
            $scheduleSubscription->setModuleEntity(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related ScheduleSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ScheduleSubscription[] List of ScheduleSubscription objects
     */
    public function getScheduleSubscriptionsJoinModuleEntityFieldRelatedByEntitynamefielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ScheduleSubscriptionQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByEntitynamefielduniquename', $join_behavior);

        return $this->getScheduleSubscriptions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related ScheduleSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ScheduleSubscription[] List of ScheduleSubscription objects
     */
    public function getScheduleSubscriptionsJoinModuleEntityFieldRelatedByEntitydatefielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ScheduleSubscriptionQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByEntitydatefielduniquename', $join_behavior);

        return $this->getScheduleSubscriptions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ModuleEntity is new, it will return
     * an empty collection; or if this ModuleEntity has previously
     * been saved, it will retrieve related ScheduleSubscriptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ModuleEntity.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ScheduleSubscription[] List of ScheduleSubscription objects
     */
    public function getScheduleSubscriptionsJoinModuleEntityFieldRelatedByEntitybooleanfielduniquename($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ScheduleSubscriptionQuery::create(null, $criteria);
        $query->joinWith('ModuleEntityFieldRelatedByEntitybooleanfielduniquename', $join_behavior);

        return $this->getScheduleSubscriptions($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->modulename = null;
        $this->name = null;
        $this->phpname = null;
        $this->description = null;
        $this->softdelete = null;
        $this->relation = null;
        $this->savelog = null;
        $this->nestedset = null;
        $this->scopefielduniquename = null;
        $this->behaviors = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
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
            if ($this->collModuleEntityFieldsRelatedByEntityname) {
                foreach ($this->collModuleEntityFieldsRelatedByEntityname as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collModuleEntityFieldsRelatedByForeignkeytable) {
                foreach ($this->collModuleEntityFieldsRelatedByForeignkeytable as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAlertSubscriptions) {
                foreach ($this->collAlertSubscriptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collScheduleSubscriptions) {
                foreach ($this->collScheduleSubscriptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collModuleEntityFieldsRelatedByEntityname instanceof PropelCollection) {
            $this->collModuleEntityFieldsRelatedByEntityname->clearIterator();
        }
        $this->collModuleEntityFieldsRelatedByEntityname = null;
        if ($this->collModuleEntityFieldsRelatedByForeignkeytable instanceof PropelCollection) {
            $this->collModuleEntityFieldsRelatedByForeignkeytable->clearIterator();
        }
        $this->collModuleEntityFieldsRelatedByForeignkeytable = null;
        if ($this->collAlertSubscriptions instanceof PropelCollection) {
            $this->collAlertSubscriptions->clearIterator();
        }
        $this->collAlertSubscriptions = null;
        if ($this->collScheduleSubscriptions instanceof PropelCollection) {
            $this->collScheduleSubscriptions->clearIterator();
        }
        $this->collScheduleSubscriptions = null;
        $this->aModule = null;
        $this->aModuleEntityFieldRelatedByScopefielduniquename = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ModuleEntityPeer::DEFAULT_STRING_FORMAT);
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
