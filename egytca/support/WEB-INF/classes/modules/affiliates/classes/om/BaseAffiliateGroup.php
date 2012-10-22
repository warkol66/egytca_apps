<?php


/**
 * Base class that represents a row from the 'affiliates_group' table.
 *
 * Groups
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateGroup extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AffiliateGroupPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        AffiliateGroupPeer
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
     * The value for the created field.
     * @var        string
     */
    protected $created;

    /**
     * The value for the updated field.
     * @var        string
     */
    protected $updated;

    /**
     * The value for the bitlevel field.
     * @var        int
     */
    protected $bitlevel;

    /**
     * @var        PropelObjectCollection|AffiliateUserGroup[] Collection to store aggregation of AffiliateUserGroup objects.
     */
    protected $collAffiliateUserGroups;
    protected $collAffiliateUserGroupsPartial;

    /**
     * @var        PropelObjectCollection|AffiliateUser[] Collection to store aggregation of AffiliateUser objects.
     */
    protected $collAffiliateUsers;

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
    protected $affiliateUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $affiliateUserGroupsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     * Group ID
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [name] column value.
     * Group Name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [optionally formatted] temporal [created] column value.
     * Creation date for
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = 'Y-m-d H:i:s')
    {
        if ($this->created === null) {
            return null;
        }

        if ($this->created === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->created);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated] column value.
     * Last update date
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdated($format = 'Y-m-d H:i:s')
    {
        if ($this->updated === null) {
            return null;
        }

        if ($this->updated === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->updated);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [bitlevel] column value.
     * Nivel
     * @return int
     */
    public function getBitlevel()
    {
        return $this->bitlevel;
    }

    /**
     * Set the value of [id] column.
     * Group ID
     * @param int $v new value
     * @return AffiliateGroup The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = AffiliateGroupPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     * Group Name
     * @param string $v new value
     * @return AffiliateGroup The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = AffiliateGroupPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of [created] column to a normalized version of the date/time value specified.
     * Creation date for
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateGroup The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created !== null || $dt !== null) {
            $currentDateAsString = ($this->created !== null && $tmpDt = new DateTime($this->created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created = $newDateAsString;
                $this->modifiedColumns[] = AffiliateGroupPeer::CREATED;
            }
        } // if either are not null


        return $this;
    } // setCreated()

    /**
     * Sets the value of [updated] column to a normalized version of the date/time value specified.
     * Last update date
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateGroup The current object (for fluent API support)
     */
    public function setUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated !== null || $dt !== null) {
            $currentDateAsString = ($this->updated !== null && $tmpDt = new DateTime($this->updated)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated = $newDateAsString;
                $this->modifiedColumns[] = AffiliateGroupPeer::UPDATED;
            }
        } // if either are not null


        return $this;
    } // setUpdated()

    /**
     * Set the value of [bitlevel] column.
     * Nivel
     * @param int $v new value
     * @return AffiliateGroup The current object (for fluent API support)
     */
    public function setBitlevel($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bitlevel !== $v) {
            $this->bitlevel = $v;
            $this->modifiedColumns[] = AffiliateGroupPeer::BITLEVEL;
        }


        return $this;
    } // setBitlevel()

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
            $this->created = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->updated = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->bitlevel = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 5; // 5 = AffiliateGroupPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating AffiliateGroup object", $e);
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
            $con = Propel::getConnection(AffiliateGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = AffiliateGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAffiliateUserGroups = null;

            $this->collAffiliateUsers = null;
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
            $con = Propel::getConnection(AffiliateGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = AffiliateGroupQuery::create()
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
            $con = Propel::getConnection(AffiliateGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                AffiliateGroupPeer::addInstanceToPool($this);
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

            if ($this->affiliateUsersScheduledForDeletion !== null) {
                if (!$this->affiliateUsersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->affiliateUsersScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    AffiliateUserGroupQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->affiliateUsersScheduledForDeletion = null;
                }

                foreach ($this->getAffiliateUsers() as $affiliateUser) {
                    if ($affiliateUser->isModified()) {
                        $affiliateUser->save($con);
                    }
                }
            }

            if ($this->affiliateUserGroupsScheduledForDeletion !== null) {
                if (!$this->affiliateUserGroupsScheduledForDeletion->isEmpty()) {
                    AffiliateUserGroupQuery::create()
                        ->filterByPrimaryKeys($this->affiliateUserGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->affiliateUserGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collAffiliateUserGroups !== null) {
                foreach ($this->collAffiliateUserGroups as $referrerFK) {
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

        $this->modifiedColumns[] = AffiliateGroupPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AffiliateGroupPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AffiliateGroupPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(AffiliateGroupPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(AffiliateGroupPeer::CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED`';
        }
        if ($this->isColumnModified(AffiliateGroupPeer::UPDATED)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED`';
        }
        if ($this->isColumnModified(AffiliateGroupPeer::BITLEVEL)) {
            $modifiedColumns[':p' . $index++]  = '`BITLEVEL`';
        }

        $sql = sprintf(
            'INSERT INTO `affiliates_group` (%s) VALUES (%s)',
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
                    case '`CREATED`':
                        $stmt->bindValue($identifier, $this->created, PDO::PARAM_STR);
                        break;
                    case '`UPDATED`':
                        $stmt->bindValue($identifier, $this->updated, PDO::PARAM_STR);
                        break;
                    case '`BITLEVEL`':
                        $stmt->bindValue($identifier, $this->bitlevel, PDO::PARAM_INT);
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


            if (($retval = AffiliateGroupPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collAffiliateUserGroups !== null) {
                    foreach ($this->collAffiliateUserGroups as $referrerFK) {
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
        $pos = AffiliateGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getCreated();
                break;
            case 3:
                return $this->getUpdated();
                break;
            case 4:
                return $this->getBitlevel();
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
        if (isset($alreadyDumpedObjects['AffiliateGroup'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['AffiliateGroup'][$this->getPrimaryKey()] = true;
        $keys = AffiliateGroupPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getCreated(),
            $keys[3] => $this->getUpdated(),
            $keys[4] => $this->getBitlevel(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collAffiliateUserGroups) {
                $result['AffiliateUserGroups'] = $this->collAffiliateUserGroups->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = AffiliateGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setCreated($value);
                break;
            case 3:
                $this->setUpdated($value);
                break;
            case 4:
                $this->setBitlevel($value);
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
        $keys = AffiliateGroupPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCreated($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUpdated($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBitlevel($arr[$keys[4]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AffiliateGroupPeer::DATABASE_NAME);

        if ($this->isColumnModified(AffiliateGroupPeer::ID)) $criteria->add(AffiliateGroupPeer::ID, $this->id);
        if ($this->isColumnModified(AffiliateGroupPeer::NAME)) $criteria->add(AffiliateGroupPeer::NAME, $this->name);
        if ($this->isColumnModified(AffiliateGroupPeer::CREATED)) $criteria->add(AffiliateGroupPeer::CREATED, $this->created);
        if ($this->isColumnModified(AffiliateGroupPeer::UPDATED)) $criteria->add(AffiliateGroupPeer::UPDATED, $this->updated);
        if ($this->isColumnModified(AffiliateGroupPeer::BITLEVEL)) $criteria->add(AffiliateGroupPeer::BITLEVEL, $this->bitlevel);

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
        $criteria = new Criteria(AffiliateGroupPeer::DATABASE_NAME);
        $criteria->add(AffiliateGroupPeer::ID, $this->id);

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
     * @param object $copyObj An object of AffiliateGroup (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setCreated($this->getCreated());
        $copyObj->setUpdated($this->getUpdated());
        $copyObj->setBitlevel($this->getBitlevel());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getAffiliateUserGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAffiliateUserGroup($relObj->copy($deepCopy));
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
     * @return AffiliateGroup Clone of current object.
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
     * @return AffiliateGroupPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new AffiliateGroupPeer();
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
        if ('AffiliateUserGroup' == $relationName) {
            $this->initAffiliateUserGroups();
        }
    }

    /**
     * Clears out the collAffiliateUserGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAffiliateUserGroups()
     */
    public function clearAffiliateUserGroups()
    {
        $this->collAffiliateUserGroups = null; // important to set this to null since that means it is uninitialized
        $this->collAffiliateUserGroupsPartial = null;
    }

    /**
     * reset is the collAffiliateUserGroups collection loaded partially
     *
     * @return void
     */
    public function resetPartialAffiliateUserGroups($v = true)
    {
        $this->collAffiliateUserGroupsPartial = $v;
    }

    /**
     * Initializes the collAffiliateUserGroups collection.
     *
     * By default this just sets the collAffiliateUserGroups collection to an empty array (like clearcollAffiliateUserGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAffiliateUserGroups($overrideExisting = true)
    {
        if (null !== $this->collAffiliateUserGroups && !$overrideExisting) {
            return;
        }
        $this->collAffiliateUserGroups = new PropelObjectCollection();
        $this->collAffiliateUserGroups->setModel('AffiliateUserGroup');
    }

    /**
     * Gets an array of AffiliateUserGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AffiliateGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AffiliateUserGroup[] List of AffiliateUserGroup objects
     * @throws PropelException
     */
    public function getAffiliateUserGroups($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAffiliateUserGroupsPartial && !$this->isNew();
        if (null === $this->collAffiliateUserGroups || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAffiliateUserGroups) {
                // return empty collection
                $this->initAffiliateUserGroups();
            } else {
                $collAffiliateUserGroups = AffiliateUserGroupQuery::create(null, $criteria)
                    ->filterByAffiliateGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAffiliateUserGroupsPartial && count($collAffiliateUserGroups)) {
                      $this->initAffiliateUserGroups(false);

                      foreach($collAffiliateUserGroups as $obj) {
                        if (false == $this->collAffiliateUserGroups->contains($obj)) {
                          $this->collAffiliateUserGroups->append($obj);
                        }
                      }

                      $this->collAffiliateUserGroupsPartial = true;
                    }

                    return $collAffiliateUserGroups;
                }

                if($partial && $this->collAffiliateUserGroups) {
                    foreach($this->collAffiliateUserGroups as $obj) {
                        if($obj->isNew()) {
                            $collAffiliateUserGroups[] = $obj;
                        }
                    }
                }

                $this->collAffiliateUserGroups = $collAffiliateUserGroups;
                $this->collAffiliateUserGroupsPartial = false;
            }
        }

        return $this->collAffiliateUserGroups;
    }

    /**
     * Sets a collection of AffiliateUserGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $affiliateUserGroups A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAffiliateUserGroups(PropelCollection $affiliateUserGroups, PropelPDO $con = null)
    {
        $this->affiliateUserGroupsScheduledForDeletion = $this->getAffiliateUserGroups(new Criteria(), $con)->diff($affiliateUserGroups);

        foreach ($this->affiliateUserGroupsScheduledForDeletion as $affiliateUserGroupRemoved) {
            $affiliateUserGroupRemoved->setAffiliateGroup(null);
        }

        $this->collAffiliateUserGroups = null;
        foreach ($affiliateUserGroups as $affiliateUserGroup) {
            $this->addAffiliateUserGroup($affiliateUserGroup);
        }

        $this->collAffiliateUserGroups = $affiliateUserGroups;
        $this->collAffiliateUserGroupsPartial = false;
    }

    /**
     * Returns the number of related AffiliateUserGroup objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AffiliateUserGroup objects.
     * @throws PropelException
     */
    public function countAffiliateUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAffiliateUserGroupsPartial && !$this->isNew();
        if (null === $this->collAffiliateUserGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAffiliateUserGroups) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getAffiliateUserGroups());
                }
                $query = AffiliateUserGroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliateGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collAffiliateUserGroups);
        }
    }

    /**
     * Method called to associate a AffiliateUserGroup object to this object
     * through the AffiliateUserGroup foreign key attribute.
     *
     * @param    AffiliateUserGroup $l AffiliateUserGroup
     * @return AffiliateGroup The current object (for fluent API support)
     */
    public function addAffiliateUserGroup(AffiliateUserGroup $l)
    {
        if ($this->collAffiliateUserGroups === null) {
            $this->initAffiliateUserGroups();
            $this->collAffiliateUserGroupsPartial = true;
        }
        if (!$this->collAffiliateUserGroups->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddAffiliateUserGroup($l);
        }

        return $this;
    }

    /**
     * @param	AffiliateUserGroup $affiliateUserGroup The affiliateUserGroup object to add.
     */
    protected function doAddAffiliateUserGroup($affiliateUserGroup)
    {
        $this->collAffiliateUserGroups[]= $affiliateUserGroup;
        $affiliateUserGroup->setAffiliateGroup($this);
    }

    /**
     * @param	AffiliateUserGroup $affiliateUserGroup The affiliateUserGroup object to remove.
     */
    public function removeAffiliateUserGroup($affiliateUserGroup)
    {
        if ($this->getAffiliateUserGroups()->contains($affiliateUserGroup)) {
            $this->collAffiliateUserGroups->remove($this->collAffiliateUserGroups->search($affiliateUserGroup));
            if (null === $this->affiliateUserGroupsScheduledForDeletion) {
                $this->affiliateUserGroupsScheduledForDeletion = clone $this->collAffiliateUserGroups;
                $this->affiliateUserGroupsScheduledForDeletion->clear();
            }
            $this->affiliateUserGroupsScheduledForDeletion[]= $affiliateUserGroup;
            $affiliateUserGroup->setAffiliateGroup(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this AffiliateGroup is new, it will return
     * an empty collection; or if this AffiliateGroup has previously
     * been saved, it will retrieve related AffiliateUserGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in AffiliateGroup.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AffiliateUserGroup[] List of AffiliateUserGroup objects
     */
    public function getAffiliateUserGroupsJoinAffiliateUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AffiliateUserGroupQuery::create(null, $criteria);
        $query->joinWith('AffiliateUser', $join_behavior);

        return $this->getAffiliateUserGroups($query, $con);
    }

    /**
     * Clears out the collAffiliateUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAffiliateUsers()
     */
    public function clearAffiliateUsers()
    {
        $this->collAffiliateUsers = null; // important to set this to null since that means it is uninitialized
        $this->collAffiliateUsersPartial = null;
    }

    /**
     * Initializes the collAffiliateUsers collection.
     *
     * By default this just sets the collAffiliateUsers collection to an empty collection (like clearAffiliateUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initAffiliateUsers()
    {
        $this->collAffiliateUsers = new PropelObjectCollection();
        $this->collAffiliateUsers->setModel('AffiliateUser');
    }

    /**
     * Gets a collection of AffiliateUser objects related by a many-to-many relationship
     * to the current object by way of the affiliates_userGroup cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AffiliateGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|AffiliateUser[] List of AffiliateUser objects
     */
    public function getAffiliateUsers($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collAffiliateUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collAffiliateUsers) {
                // return empty collection
                $this->initAffiliateUsers();
            } else {
                $collAffiliateUsers = AffiliateUserQuery::create(null, $criteria)
                    ->filterByAffiliateGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collAffiliateUsers;
                }
                $this->collAffiliateUsers = $collAffiliateUsers;
            }
        }

        return $this->collAffiliateUsers;
    }

    /**
     * Sets a collection of AffiliateUser objects related by a many-to-many relationship
     * to the current object by way of the affiliates_userGroup cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $affiliateUsers A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAffiliateUsers(PropelCollection $affiliateUsers, PropelPDO $con = null)
    {
        $this->clearAffiliateUsers();
        $currentAffiliateUsers = $this->getAffiliateUsers();

        $this->affiliateUsersScheduledForDeletion = $currentAffiliateUsers->diff($affiliateUsers);

        foreach ($affiliateUsers as $affiliateUser) {
            if (!$currentAffiliateUsers->contains($affiliateUser)) {
                $this->doAddAffiliateUser($affiliateUser);
            }
        }

        $this->collAffiliateUsers = $affiliateUsers;
    }

    /**
     * Gets the number of AffiliateUser objects related by a many-to-many relationship
     * to the current object by way of the affiliates_userGroup cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related AffiliateUser objects
     */
    public function countAffiliateUsers($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collAffiliateUsers || null !== $criteria) {
            if ($this->isNew() && null === $this->collAffiliateUsers) {
                return 0;
            } else {
                $query = AffiliateUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliateGroup($this)
                    ->count($con);
            }
        } else {
            return count($this->collAffiliateUsers);
        }
    }

    /**
     * Associate a AffiliateUser object to this object
     * through the affiliates_userGroup cross reference table.
     *
     * @param  AffiliateUser $affiliateUser The AffiliateUserGroup object to relate
     * @return void
     */
    public function addAffiliateUser(AffiliateUser $affiliateUser)
    {
        if ($this->collAffiliateUsers === null) {
            $this->initAffiliateUsers();
        }
        if (!$this->collAffiliateUsers->contains($affiliateUser)) { // only add it if the **same** object is not already associated
            $this->doAddAffiliateUser($affiliateUser);

            $this->collAffiliateUsers[]= $affiliateUser;
        }
    }

    /**
     * @param	AffiliateUser $affiliateUser The affiliateUser object to add.
     */
    protected function doAddAffiliateUser($affiliateUser)
    {
        $affiliateUserGroup = new AffiliateUserGroup();
        $affiliateUserGroup->setAffiliateUser($affiliateUser);
        $this->addAffiliateUserGroup($affiliateUserGroup);
    }

    /**
     * Remove a AffiliateUser object to this object
     * through the affiliates_userGroup cross reference table.
     *
     * @param AffiliateUser $affiliateUser The AffiliateUserGroup object to relate
     * @return void
     */
    public function removeAffiliateUser(AffiliateUser $affiliateUser)
    {
        if ($this->getAffiliateUsers()->contains($affiliateUser)) {
            $this->collAffiliateUsers->remove($this->collAffiliateUsers->search($affiliateUser));
            if (null === $this->affiliateUsersScheduledForDeletion) {
                $this->affiliateUsersScheduledForDeletion = clone $this->collAffiliateUsers;
                $this->affiliateUsersScheduledForDeletion->clear();
            }
            $this->affiliateUsersScheduledForDeletion[]= $affiliateUser;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->created = null;
        $this->updated = null;
        $this->bitlevel = null;
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
            if ($this->collAffiliateUserGroups) {
                foreach ($this->collAffiliateUserGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAffiliateUsers) {
                foreach ($this->collAffiliateUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collAffiliateUserGroups instanceof PropelCollection) {
            $this->collAffiliateUserGroups->clearIterator();
        }
        $this->collAffiliateUserGroups = null;
        if ($this->collAffiliateUsers instanceof PropelCollection) {
            $this->collAffiliateUsers->clearIterator();
        }
        $this->collAffiliateUsers = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string The value of the 'name' column
     */
    public function __toString()
    {
        return (string) $this->getName();
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
