<?php


/**
 * Base class that represents a row from the 'services_scheduleSubscription' table.
 *
 * Suscripciones de schedulea
 *
 * @package    propel.generator.services.classes.om
 */
abstract class BaseScheduleSubscription extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'ScheduleSubscriptionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ScheduleSubscriptionPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the entityname field.
     * @var        string
     */
    protected $entityname;

    /**
     * The value for the entitydatefielduniquename field.
     * @var        string
     */
    protected $entitydatefielduniquename;

    /**
     * The value for the entitybooleanfielduniquename field.
     * @var        string
     */
    protected $entitybooleanfielduniquename;

    /**
     * The value for the anticipationdays field.
     * @var        int
     */
    protected $anticipationdays;

    /**
     * The value for the entitynamefielduniquename field.
     * @var        string
     */
    protected $entitynamefielduniquename;

    /**
     * The value for the extrarecipients field.
     * @var        string
     */
    protected $extrarecipients;

    /**
     * @var        ModuleEntity
     */
    protected $aModuleEntity;

    /**
     * @var        ModuleEntityField
     */
    protected $aModuleEntityFieldRelatedByEntitynamefielduniquename;

    /**
     * @var        ModuleEntityField
     */
    protected $aModuleEntityFieldRelatedByEntitydatefielduniquename;

    /**
     * @var        ModuleEntityField
     */
    protected $aModuleEntityFieldRelatedByEntitybooleanfielduniquename;

    /**
     * @var        PropelObjectCollection|ScheduleSubscriptionUser[] Collection to store aggregation of ScheduleSubscriptionUser objects.
     */
    protected $collScheduleSubscriptionUsers;
    protected $collScheduleSubscriptionUsersPartial;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsers;

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
    protected $usersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $scheduleSubscriptionUsersScheduledForDeletion = null;

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
     * Get the [name] column value.
     * Nombre de la suscripcion
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [entityname] column value.
     * Nombre unico de la entidad asociada.
     * @return string
     */
    public function getEntityname()
    {
        return $this->entityname;
    }

    /**
     * Get the [entitydatefielduniquename] column value.
     * Nombre unico del campo fecha
     * @return string
     */
    public function getEntitydatefielduniquename()
    {
        return $this->entitydatefielduniquename;
    }

    /**
     * Get the [entitybooleanfielduniquename] column value.
     * Nombre unico del campo a evaluar por verdadero o falso.
     * @return string
     */
    public function getEntitybooleanfielduniquename()
    {
        return $this->entitybooleanfielduniquename;
    }

    /**
     * Get the [anticipationdays] column value.
     * Cantidad de dias de anticipacion. Se usa para evaluar campos tipo fecha.
     * @return int
     */
    public function getAnticipationdays()
    {
        return $this->anticipationdays;
    }

    /**
     * Get the [entitynamefielduniquename] column value.
     * Campo a imprimir en representacion del nombre de cada instancia de la entidad
     * @return string
     */
    public function getEntitynamefielduniquename()
    {
        return $this->entitynamefielduniquename;
    }

    /**
     * Get the [extrarecipients] column value.
     * Destinatarios extra
     * @return string
     */
    public function getExtrarecipients()
    {
        return $this->extrarecipients;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     * Nombre de la suscripcion
     * @param string $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [entityname] column.
     * Nombre unico de la entidad asociada.
     * @param string $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setEntityname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->entityname !== $v) {
            $this->entityname = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::ENTITYNAME;
        }

        if ($this->aModuleEntity !== null && $this->aModuleEntity->getName() !== $v) {
            $this->aModuleEntity = null;
        }


        return $this;
    } // setEntityname()

    /**
     * Set the value of [entitydatefielduniquename] column.
     * Nombre unico del campo fecha
     * @param string $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setEntitydatefielduniquename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->entitydatefielduniquename !== $v) {
            $this->entitydatefielduniquename = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME;
        }

        if ($this->aModuleEntityFieldRelatedByEntitydatefielduniquename !== null && $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->getUniquename() !== $v) {
            $this->aModuleEntityFieldRelatedByEntitydatefielduniquename = null;
        }


        return $this;
    } // setEntitydatefielduniquename()

    /**
     * Set the value of [entitybooleanfielduniquename] column.
     * Nombre unico del campo a evaluar por verdadero o falso.
     * @param string $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setEntitybooleanfielduniquename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->entitybooleanfielduniquename !== $v) {
            $this->entitybooleanfielduniquename = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME;
        }

        if ($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename !== null && $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->getUniquename() !== $v) {
            $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename = null;
        }


        return $this;
    } // setEntitybooleanfielduniquename()

    /**
     * Set the value of [anticipationdays] column.
     * Cantidad de dias de anticipacion. Se usa para evaluar campos tipo fecha.
     * @param int $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setAnticipationdays($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->anticipationdays !== $v) {
            $this->anticipationdays = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::ANTICIPATIONDAYS;
        }


        return $this;
    } // setAnticipationdays()

    /**
     * Set the value of [entitynamefielduniquename] column.
     * Campo a imprimir en representacion del nombre de cada instancia de la entidad
     * @param string $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setEntitynamefielduniquename($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->entitynamefielduniquename !== $v) {
            $this->entitynamefielduniquename = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME;
        }

        if ($this->aModuleEntityFieldRelatedByEntitynamefielduniquename !== null && $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->getUniquename() !== $v) {
            $this->aModuleEntityFieldRelatedByEntitynamefielduniquename = null;
        }


        return $this;
    } // setEntitynamefielduniquename()

    /**
     * Set the value of [extrarecipients] column.
     * Destinatarios extra
     * @param string $v new value
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function setExtrarecipients($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->extrarecipients !== $v) {
            $this->extrarecipients = $v;
            $this->modifiedColumns[] = ScheduleSubscriptionPeer::EXTRARECIPIENTS;
        }


        return $this;
    } // setExtrarecipients()

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

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->entityname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->entitydatefielduniquename = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->entitybooleanfielduniquename = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->anticipationdays = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->entitynamefielduniquename = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->extrarecipients = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = ScheduleSubscriptionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating ScheduleSubscription object", $e);
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

        if ($this->aModuleEntity !== null && $this->entityname !== $this->aModuleEntity->getName()) {
            $this->aModuleEntity = null;
        }
        if ($this->aModuleEntityFieldRelatedByEntitydatefielduniquename !== null && $this->entitydatefielduniquename !== $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->getUniquename()) {
            $this->aModuleEntityFieldRelatedByEntitydatefielduniquename = null;
        }
        if ($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename !== null && $this->entitybooleanfielduniquename !== $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->getUniquename()) {
            $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename = null;
        }
        if ($this->aModuleEntityFieldRelatedByEntitynamefielduniquename !== null && $this->entitynamefielduniquename !== $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->getUniquename()) {
            $this->aModuleEntityFieldRelatedByEntitynamefielduniquename = null;
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
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ScheduleSubscriptionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aModuleEntity = null;
            $this->aModuleEntityFieldRelatedByEntitynamefielduniquename = null;
            $this->aModuleEntityFieldRelatedByEntitydatefielduniquename = null;
            $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename = null;
            $this->collScheduleSubscriptionUsers = null;

            $this->collUsers = null;
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
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ScheduleSubscriptionQuery::create()
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
            $con = Propel::getConnection(ScheduleSubscriptionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ScheduleSubscriptionPeer::addInstanceToPool($this);
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

            if ($this->aModuleEntity !== null) {
                if ($this->aModuleEntity->isModified() || $this->aModuleEntity->isNew()) {
                    $affectedRows += $this->aModuleEntity->save($con);
                }
                $this->setModuleEntity($this->aModuleEntity);
            }

            if ($this->aModuleEntityFieldRelatedByEntitynamefielduniquename !== null) {
                if ($this->aModuleEntityFieldRelatedByEntitynamefielduniquename->isModified() || $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->isNew()) {
                    $affectedRows += $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->save($con);
                }
                $this->setModuleEntityFieldRelatedByEntitynamefielduniquename($this->aModuleEntityFieldRelatedByEntitynamefielduniquename);
            }

            if ($this->aModuleEntityFieldRelatedByEntitydatefielduniquename !== null) {
                if ($this->aModuleEntityFieldRelatedByEntitydatefielduniquename->isModified() || $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->isNew()) {
                    $affectedRows += $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->save($con);
                }
                $this->setModuleEntityFieldRelatedByEntitydatefielduniquename($this->aModuleEntityFieldRelatedByEntitydatefielduniquename);
            }

            if ($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename !== null) {
                if ($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->isModified() || $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->isNew()) {
                    $affectedRows += $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->save($con);
                }
                $this->setModuleEntityFieldRelatedByEntitybooleanfielduniquename($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename);
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

            if ($this->usersScheduledForDeletion !== null) {
                if (!$this->usersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->usersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    ScheduleSubscriptionUserQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->usersScheduledForDeletion = null;
                }

                foreach ($this->getUsers() as $user) {
                    if ($user->isModified()) {
                        $user->save($con);
                    }
                }
            }

            if ($this->scheduleSubscriptionUsersScheduledForDeletion !== null) {
                if (!$this->scheduleSubscriptionUsersScheduledForDeletion->isEmpty()) {
                    ScheduleSubscriptionUserQuery::create()
                        ->filterByPrimaryKeys($this->scheduleSubscriptionUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->scheduleSubscriptionUsersScheduledForDeletion = null;
                }
            }

            if ($this->collScheduleSubscriptionUsers !== null) {
                foreach ($this->collScheduleSubscriptionUsers as $referrerFK) {
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

        $this->modifiedColumns[] = ScheduleSubscriptionPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ScheduleSubscriptionPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYNAME)) {
            $modifiedColumns[':p' . $index++]  = '`ENTITYNAME`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME)) {
            $modifiedColumns[':p' . $index++]  = '`ENTITYDATEFIELDUNIQUENAME`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME)) {
            $modifiedColumns[':p' . $index++]  = '`ENTITYBOOLEANFIELDUNIQUENAME`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ANTICIPATIONDAYS)) {
            $modifiedColumns[':p' . $index++]  = '`ANTICIPATIONDAYS`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME)) {
            $modifiedColumns[':p' . $index++]  = '`ENTITYNAMEFIELDUNIQUENAME`';
        }
        if ($this->isColumnModified(ScheduleSubscriptionPeer::EXTRARECIPIENTS)) {
            $modifiedColumns[':p' . $index++]  = '`EXTRARECIPIENTS`';
        }

        $sql = sprintf(
            'INSERT INTO `services_scheduleSubscription` (%s) VALUES (%s)',
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
                    case '`NAME`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`ENTITYNAME`':
                        $stmt->bindValue($identifier, $this->entityname, PDO::PARAM_STR);
                        break;
                    case '`ENTITYDATEFIELDUNIQUENAME`':
                        $stmt->bindValue($identifier, $this->entitydatefielduniquename, PDO::PARAM_STR);
                        break;
                    case '`ENTITYBOOLEANFIELDUNIQUENAME`':
                        $stmt->bindValue($identifier, $this->entitybooleanfielduniquename, PDO::PARAM_STR);
                        break;
                    case '`ANTICIPATIONDAYS`':
                        $stmt->bindValue($identifier, $this->anticipationdays, PDO::PARAM_INT);
                        break;
                    case '`ENTITYNAMEFIELDUNIQUENAME`':
                        $stmt->bindValue($identifier, $this->entitynamefielduniquename, PDO::PARAM_STR);
                        break;
                    case '`EXTRARECIPIENTS`':
                        $stmt->bindValue($identifier, $this->extrarecipients, PDO::PARAM_STR);
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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aModuleEntity !== null) {
                if (!$this->aModuleEntity->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aModuleEntity->getValidationFailures());
                }
            }

            if ($this->aModuleEntityFieldRelatedByEntitynamefielduniquename !== null) {
                if (!$this->aModuleEntityFieldRelatedByEntitynamefielduniquename->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->getValidationFailures());
                }
            }

            if ($this->aModuleEntityFieldRelatedByEntitydatefielduniquename !== null) {
                if (!$this->aModuleEntityFieldRelatedByEntitydatefielduniquename->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->getValidationFailures());
                }
            }

            if ($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename !== null) {
                if (!$this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->getValidationFailures());
                }
            }


            if (($retval = ScheduleSubscriptionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collScheduleSubscriptionUsers !== null) {
                    foreach ($this->collScheduleSubscriptionUsers as $referrerFK) {
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
        $pos = ScheduleSubscriptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getEntityname();
                break;
            case 3:
                return $this->getEntitydatefielduniquename();
                break;
            case 4:
                return $this->getEntitybooleanfielduniquename();
                break;
            case 5:
                return $this->getAnticipationdays();
                break;
            case 6:
                return $this->getEntitynamefielduniquename();
                break;
            case 7:
                return $this->getExtrarecipients();
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
        if (isset($alreadyDumpedObjects['ScheduleSubscription'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['ScheduleSubscription'][$this->getPrimaryKey()] = true;
        $keys = ScheduleSubscriptionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getEntityname(),
            $keys[3] => $this->getEntitydatefielduniquename(),
            $keys[4] => $this->getEntitybooleanfielduniquename(),
            $keys[5] => $this->getAnticipationdays(),
            $keys[6] => $this->getEntitynamefielduniquename(),
            $keys[7] => $this->getExtrarecipients(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aModuleEntity) {
                $result['ModuleEntity'] = $this->aModuleEntity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aModuleEntityFieldRelatedByEntitynamefielduniquename) {
                $result['ModuleEntityFieldRelatedByEntitynamefielduniquename'] = $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aModuleEntityFieldRelatedByEntitydatefielduniquename) {
                $result['ModuleEntityFieldRelatedByEntitydatefielduniquename'] = $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename) {
                $result['ModuleEntityFieldRelatedByEntitybooleanfielduniquename'] = $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collScheduleSubscriptionUsers) {
                $result['ScheduleSubscriptionUsers'] = $this->collScheduleSubscriptionUsers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ScheduleSubscriptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
                $this->setEntityname($value);
                break;
            case 3:
                $this->setEntitydatefielduniquename($value);
                break;
            case 4:
                $this->setEntitybooleanfielduniquename($value);
                break;
            case 5:
                $this->setAnticipationdays($value);
                break;
            case 6:
                $this->setEntitynamefielduniquename($value);
                break;
            case 7:
                $this->setExtrarecipients($value);
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
        $keys = ScheduleSubscriptionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEntityname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEntitydatefielduniquename($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEntitybooleanfielduniquename($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setAnticipationdays($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEntitynamefielduniquename($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setExtrarecipients($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);

        if ($this->isColumnModified(ScheduleSubscriptionPeer::ID)) $criteria->add(ScheduleSubscriptionPeer::ID, $this->id);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::NAME)) $criteria->add(ScheduleSubscriptionPeer::NAME, $this->name);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYNAME)) $criteria->add(ScheduleSubscriptionPeer::ENTITYNAME, $this->entityname);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME)) $criteria->add(ScheduleSubscriptionPeer::ENTITYDATEFIELDUNIQUENAME, $this->entitydatefielduniquename);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME)) $criteria->add(ScheduleSubscriptionPeer::ENTITYBOOLEANFIELDUNIQUENAME, $this->entitybooleanfielduniquename);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ANTICIPATIONDAYS)) $criteria->add(ScheduleSubscriptionPeer::ANTICIPATIONDAYS, $this->anticipationdays);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME)) $criteria->add(ScheduleSubscriptionPeer::ENTITYNAMEFIELDUNIQUENAME, $this->entitynamefielduniquename);
        if ($this->isColumnModified(ScheduleSubscriptionPeer::EXTRARECIPIENTS)) $criteria->add(ScheduleSubscriptionPeer::EXTRARECIPIENTS, $this->extrarecipients);

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
        $criteria = new Criteria(ScheduleSubscriptionPeer::DATABASE_NAME);
        $criteria->add(ScheduleSubscriptionPeer::ID, $this->id);

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
     * @param object $copyObj An object of ScheduleSubscription (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setEntityname($this->getEntityname());
        $copyObj->setEntitydatefielduniquename($this->getEntitydatefielduniquename());
        $copyObj->setEntitybooleanfielduniquename($this->getEntitybooleanfielduniquename());
        $copyObj->setAnticipationdays($this->getAnticipationdays());
        $copyObj->setEntitynamefielduniquename($this->getEntitynamefielduniquename());
        $copyObj->setExtrarecipients($this->getExtrarecipients());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getScheduleSubscriptionUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addScheduleSubscriptionUser($relObj->copy($deepCopy));
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
     * @return ScheduleSubscription Clone of current object.
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
     * @return ScheduleSubscriptionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ScheduleSubscriptionPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a ModuleEntity object.
     *
     * @param             ModuleEntity $v
     * @return ScheduleSubscription The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModuleEntity(ModuleEntity $v = null)
    {
        if ($v === null) {
            $this->setEntityname(NULL);
        } else {
            $this->setEntityname($v->getName());
        }

        $this->aModuleEntity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ModuleEntity object, it will not be re-added.
        if ($v !== null) {
            $v->addScheduleSubscription($this);
        }


        return $this;
    }


    /**
     * Get the associated ModuleEntity object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return ModuleEntity The associated ModuleEntity object.
     * @throws PropelException
     */
    public function getModuleEntity(PropelPDO $con = null)
    {
        if ($this->aModuleEntity === null && (($this->entityname !== "" && $this->entityname !== null))) {
            $this->aModuleEntity = ModuleEntityQuery::create()->findPk($this->entityname, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModuleEntity->addScheduleSubscriptions($this);
             */
        }

        return $this->aModuleEntity;
    }

    /**
     * Declares an association between this object and a ModuleEntityField object.
     *
     * @param             ModuleEntityField $v
     * @return ScheduleSubscription The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModuleEntityFieldRelatedByEntitynamefielduniquename(ModuleEntityField $v = null)
    {
        if ($v === null) {
            $this->setEntitynamefielduniquename(NULL);
        } else {
            $this->setEntitynamefielduniquename($v->getUniquename());
        }

        $this->aModuleEntityFieldRelatedByEntitynamefielduniquename = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ModuleEntityField object, it will not be re-added.
        if ($v !== null) {
            $v->addScheduleSubscriptionRelatedByEntitynamefielduniquename($this);
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
    public function getModuleEntityFieldRelatedByEntitynamefielduniquename(PropelPDO $con = null)
    {
        if ($this->aModuleEntityFieldRelatedByEntitynamefielduniquename === null && (($this->entitynamefielduniquename !== "" && $this->entitynamefielduniquename !== null))) {
            $this->aModuleEntityFieldRelatedByEntitynamefielduniquename = ModuleEntityFieldQuery::create()->findPk($this->entitynamefielduniquename, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModuleEntityFieldRelatedByEntitynamefielduniquename->addScheduleSubscriptionsRelatedByEntitynamefielduniquename($this);
             */
        }

        return $this->aModuleEntityFieldRelatedByEntitynamefielduniquename;
    }

    /**
     * Declares an association between this object and a ModuleEntityField object.
     *
     * @param             ModuleEntityField $v
     * @return ScheduleSubscription The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModuleEntityFieldRelatedByEntitydatefielduniquename(ModuleEntityField $v = null)
    {
        if ($v === null) {
            $this->setEntitydatefielduniquename(NULL);
        } else {
            $this->setEntitydatefielduniquename($v->getUniquename());
        }

        $this->aModuleEntityFieldRelatedByEntitydatefielduniquename = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ModuleEntityField object, it will not be re-added.
        if ($v !== null) {
            $v->addScheduleSubscriptionRelatedByEntitydatefielduniquename($this);
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
    public function getModuleEntityFieldRelatedByEntitydatefielduniquename(PropelPDO $con = null)
    {
        if ($this->aModuleEntityFieldRelatedByEntitydatefielduniquename === null && (($this->entitydatefielduniquename !== "" && $this->entitydatefielduniquename !== null))) {
            $this->aModuleEntityFieldRelatedByEntitydatefielduniquename = ModuleEntityFieldQuery::create()->findPk($this->entitydatefielduniquename, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModuleEntityFieldRelatedByEntitydatefielduniquename->addScheduleSubscriptionsRelatedByEntitydatefielduniquename($this);
             */
        }

        return $this->aModuleEntityFieldRelatedByEntitydatefielduniquename;
    }

    /**
     * Declares an association between this object and a ModuleEntityField object.
     *
     * @param             ModuleEntityField $v
     * @return ScheduleSubscription The current object (for fluent API support)
     * @throws PropelException
     */
    public function setModuleEntityFieldRelatedByEntitybooleanfielduniquename(ModuleEntityField $v = null)
    {
        if ($v === null) {
            $this->setEntitybooleanfielduniquename(NULL);
        } else {
            $this->setEntitybooleanfielduniquename($v->getUniquename());
        }

        $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ModuleEntityField object, it will not be re-added.
        if ($v !== null) {
            $v->addScheduleSubscriptionRelatedByEntitybooleanfielduniquename($this);
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
    public function getModuleEntityFieldRelatedByEntitybooleanfielduniquename(PropelPDO $con = null)
    {
        if ($this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename === null && (($this->entitybooleanfielduniquename !== "" && $this->entitybooleanfielduniquename !== null))) {
            $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename = ModuleEntityFieldQuery::create()->findPk($this->entitybooleanfielduniquename, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename->addScheduleSubscriptionsRelatedByEntitybooleanfielduniquename($this);
             */
        }

        return $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename;
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
        if ('ScheduleSubscriptionUser' == $relationName) {
            $this->initScheduleSubscriptionUsers();
        }
    }

    /**
     * Clears out the collScheduleSubscriptionUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addScheduleSubscriptionUsers()
     */
    public function clearScheduleSubscriptionUsers()
    {
        $this->collScheduleSubscriptionUsers = null; // important to set this to null since that means it is uninitialized
        $this->collScheduleSubscriptionUsersPartial = null;
    }

    /**
     * reset is the collScheduleSubscriptionUsers collection loaded partially
     *
     * @return void
     */
    public function resetPartialScheduleSubscriptionUsers($v = true)
    {
        $this->collScheduleSubscriptionUsersPartial = $v;
    }

    /**
     * Initializes the collScheduleSubscriptionUsers collection.
     *
     * By default this just sets the collScheduleSubscriptionUsers collection to an empty array (like clearcollScheduleSubscriptionUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initScheduleSubscriptionUsers($overrideExisting = true)
    {
        if (null !== $this->collScheduleSubscriptionUsers && !$overrideExisting) {
            return;
        }
        $this->collScheduleSubscriptionUsers = new PropelObjectCollection();
        $this->collScheduleSubscriptionUsers->setModel('ScheduleSubscriptionUser');
    }

    /**
     * Gets an array of ScheduleSubscriptionUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ScheduleSubscription is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ScheduleSubscriptionUser[] List of ScheduleSubscriptionUser objects
     * @throws PropelException
     */
    public function getScheduleSubscriptionUsers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collScheduleSubscriptionUsersPartial && !$this->isNew();
        if (null === $this->collScheduleSubscriptionUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collScheduleSubscriptionUsers) {
                // return empty collection
                $this->initScheduleSubscriptionUsers();
            } else {
                $collScheduleSubscriptionUsers = ScheduleSubscriptionUserQuery::create(null, $criteria)
                    ->filterByScheduleSubscription($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collScheduleSubscriptionUsersPartial && count($collScheduleSubscriptionUsers)) {
                      $this->initScheduleSubscriptionUsers(false);

                      foreach($collScheduleSubscriptionUsers as $obj) {
                        if (false == $this->collScheduleSubscriptionUsers->contains($obj)) {
                          $this->collScheduleSubscriptionUsers->append($obj);
                        }
                      }

                      $this->collScheduleSubscriptionUsersPartial = true;
                    }

                    return $collScheduleSubscriptionUsers;
                }

                if($partial && $this->collScheduleSubscriptionUsers) {
                    foreach($this->collScheduleSubscriptionUsers as $obj) {
                        if($obj->isNew()) {
                            $collScheduleSubscriptionUsers[] = $obj;
                        }
                    }
                }

                $this->collScheduleSubscriptionUsers = $collScheduleSubscriptionUsers;
                $this->collScheduleSubscriptionUsersPartial = false;
            }
        }

        return $this->collScheduleSubscriptionUsers;
    }

    /**
     * Sets a collection of ScheduleSubscriptionUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $scheduleSubscriptionUsers A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setScheduleSubscriptionUsers(PropelCollection $scheduleSubscriptionUsers, PropelPDO $con = null)
    {
        $this->scheduleSubscriptionUsersScheduledForDeletion = $this->getScheduleSubscriptionUsers(new Criteria(), $con)->diff($scheduleSubscriptionUsers);

        foreach ($this->scheduleSubscriptionUsersScheduledForDeletion as $scheduleSubscriptionUserRemoved) {
            $scheduleSubscriptionUserRemoved->setScheduleSubscription(null);
        }

        $this->collScheduleSubscriptionUsers = null;
        foreach ($scheduleSubscriptionUsers as $scheduleSubscriptionUser) {
            $this->addScheduleSubscriptionUser($scheduleSubscriptionUser);
        }

        $this->collScheduleSubscriptionUsers = $scheduleSubscriptionUsers;
        $this->collScheduleSubscriptionUsersPartial = false;
    }

    /**
     * Returns the number of related ScheduleSubscriptionUser objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ScheduleSubscriptionUser objects.
     * @throws PropelException
     */
    public function countScheduleSubscriptionUsers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collScheduleSubscriptionUsersPartial && !$this->isNew();
        if (null === $this->collScheduleSubscriptionUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collScheduleSubscriptionUsers) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getScheduleSubscriptionUsers());
                }
                $query = ScheduleSubscriptionUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByScheduleSubscription($this)
                    ->count($con);
            }
        } else {
            return count($this->collScheduleSubscriptionUsers);
        }
    }

    /**
     * Method called to associate a ScheduleSubscriptionUser object to this object
     * through the ScheduleSubscriptionUser foreign key attribute.
     *
     * @param    ScheduleSubscriptionUser $l ScheduleSubscriptionUser
     * @return ScheduleSubscription The current object (for fluent API support)
     */
    public function addScheduleSubscriptionUser(ScheduleSubscriptionUser $l)
    {
        if ($this->collScheduleSubscriptionUsers === null) {
            $this->initScheduleSubscriptionUsers();
            $this->collScheduleSubscriptionUsersPartial = true;
        }
        if (!$this->collScheduleSubscriptionUsers->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddScheduleSubscriptionUser($l);
        }

        return $this;
    }

    /**
     * @param	ScheduleSubscriptionUser $scheduleSubscriptionUser The scheduleSubscriptionUser object to add.
     */
    protected function doAddScheduleSubscriptionUser($scheduleSubscriptionUser)
    {
        $this->collScheduleSubscriptionUsers[]= $scheduleSubscriptionUser;
        $scheduleSubscriptionUser->setScheduleSubscription($this);
    }

    /**
     * @param	ScheduleSubscriptionUser $scheduleSubscriptionUser The scheduleSubscriptionUser object to remove.
     */
    public function removeScheduleSubscriptionUser($scheduleSubscriptionUser)
    {
        if ($this->getScheduleSubscriptionUsers()->contains($scheduleSubscriptionUser)) {
            $this->collScheduleSubscriptionUsers->remove($this->collScheduleSubscriptionUsers->search($scheduleSubscriptionUser));
            if (null === $this->scheduleSubscriptionUsersScheduledForDeletion) {
                $this->scheduleSubscriptionUsersScheduledForDeletion = clone $this->collScheduleSubscriptionUsers;
                $this->scheduleSubscriptionUsersScheduledForDeletion->clear();
            }
            $this->scheduleSubscriptionUsersScheduledForDeletion[]= $scheduleSubscriptionUser;
            $scheduleSubscriptionUser->setScheduleSubscription(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this ScheduleSubscription is new, it will return
     * an empty collection; or if this ScheduleSubscription has previously
     * been saved, it will retrieve related ScheduleSubscriptionUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in ScheduleSubscription.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ScheduleSubscriptionUser[] List of ScheduleSubscriptionUser objects
     */
    public function getScheduleSubscriptionUsersJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ScheduleSubscriptionUserQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getScheduleSubscriptionUsers($query, $con);
    }

    /**
     * Clears out the collUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsers()
     */
    public function clearUsers()
    {
        $this->collUsers = null; // important to set this to null since that means it is uninitialized
        $this->collUsersPartial = null;
    }

    /**
     * Initializes the collUsers collection.
     *
     * By default this just sets the collUsers collection to an empty collection (like clearUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initUsers()
    {
        $this->collUsers = new PropelObjectCollection();
        $this->collUsers->setModel('User');
    }

    /**
     * Gets a collection of User objects related by a many-to-many relationship
     * to the current object by way of the services_scheduleSubscriptionUser cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ScheduleSubscription is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|User[] List of User objects
     */
    public function getUsers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collUsers) {
                // return empty collection
                $this->initUsers();
            } else {
                $collUsers = UserQuery::create(null, $criteria)
                    ->filterByScheduleSubscription($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collUsers;
                }
                $this->collUsers = $collUsers;
            }
        }

        return $this->collUsers;
    }

    /**
     * Sets a collection of User objects related by a many-to-many relationship
     * to the current object by way of the services_scheduleSubscriptionUser cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $users A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setUsers(PropelCollection $users, PropelPDO $con = null)
    {
        $this->clearUsers();
        $currentUsers = $this->getUsers();

        $this->usersScheduledForDeletion = $currentUsers->diff($users);

        foreach ($users as $user) {
            if (!$currentUsers->contains($user)) {
                $this->doAddUser($user);
            }
        }

        $this->collUsers = $users;
    }

    /**
     * Gets the number of User objects related by a many-to-many relationship
     * to the current object by way of the services_scheduleSubscriptionUser cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related User objects
     */
    public function countUsers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collUsers) {
                return 0;
            } else {
                $query = UserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByScheduleSubscription($this)
                    ->count($con);
            }
        } else {
            return count($this->collUsers);
        }
    }

    /**
     * Associate a User object to this object
     * through the services_scheduleSubscriptionUser cross reference table.
     *
     * @param  User $user The ScheduleSubscriptionUser object to relate
     * @return void
     */
    public function addUser(User $user)
    {
        if ($this->collUsers === null) {
            $this->initUsers();
        }
        if (!$this->collUsers->contains($user)) { // only add it if the **same** object is not already associated
            $this->doAddUser($user);

            $this->collUsers[]= $user;
        }
    }

    /**
     * @param	User $user The user object to add.
     */
    protected function doAddUser($user)
    {
        $scheduleSubscriptionUser = new ScheduleSubscriptionUser();
        $scheduleSubscriptionUser->setUser($user);
        $this->addScheduleSubscriptionUser($scheduleSubscriptionUser);
    }

    /**
     * Remove a User object to this object
     * through the services_scheduleSubscriptionUser cross reference table.
     *
     * @param User $user The ScheduleSubscriptionUser object to relate
     * @return void
     */
    public function removeUser(User $user)
    {
        if ($this->getUsers()->contains($user)) {
            $this->collUsers->remove($this->collUsers->search($user));
            if (null === $this->usersScheduledForDeletion) {
                $this->usersScheduledForDeletion = clone $this->collUsers;
                $this->usersScheduledForDeletion->clear();
            }
            $this->usersScheduledForDeletion[]= $user;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->entityname = null;
        $this->entitydatefielduniquename = null;
        $this->entitybooleanfielduniquename = null;
        $this->anticipationdays = null;
        $this->entitynamefielduniquename = null;
        $this->extrarecipients = null;
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
            if ($this->collScheduleSubscriptionUsers) {
                foreach ($this->collScheduleSubscriptionUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsers) {
                foreach ($this->collUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collScheduleSubscriptionUsers instanceof PropelCollection) {
            $this->collScheduleSubscriptionUsers->clearIterator();
        }
        $this->collScheduleSubscriptionUsers = null;
        if ($this->collUsers instanceof PropelCollection) {
            $this->collUsers->clearIterator();
        }
        $this->collUsers = null;
        $this->aModuleEntity = null;
        $this->aModuleEntityFieldRelatedByEntitynamefielduniquename = null;
        $this->aModuleEntityFieldRelatedByEntitydatefielduniquename = null;
        $this->aModuleEntityFieldRelatedByEntitybooleanfielduniquename = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ScheduleSubscriptionPeer::DEFAULT_STRING_FORMAT);
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
