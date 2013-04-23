<?php


/**
 * Base class that represents a row from the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * @package    propel.generator.calendar.classes.om
 */
abstract class BaseCalendarEvent extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'CalendarEventPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        CalendarEventPeer
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
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the summary field.
     * @var        string
     */
    protected $summary;

    /**
     * The value for the body field.
     * @var        string
     */
    protected $body;

    /**
     * The value for the creationdate field.
     * @var        string
     */
    protected $creationdate;

    /**
     * The value for the startdate field.
     * @var        string
     */
    protected $startdate;

    /**
     * The value for the enddate field.
     * @var        string
     */
    protected $enddate;

    /**
     * The value for the sourcecontact field.
     * @var        string
     */
    protected $sourcecontact;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the regionid field.
     * @var        int
     */
    protected $regionid;

    /**
     * The value for the categoryid field.
     * @var        int
     */
    protected $categoryid;

    /**
     * The value for the userid field.
     * @var        int
     */
    protected $userid;

    /**
     * The value for the deleted_at field.
     * @var        string
     */
    protected $deleted_at;

    /**
     * @var        User
     */
    protected $aUser;

    /**
     * @var        Category
     */
    protected $aCategory;

    /**
     * @var        PropelObjectCollection|CalendarMedia[] Collection to store aggregation of CalendarMedia objects.
     */
    protected $collCalendarMedias;
    protected $collCalendarMediasPartial;

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
    protected $calendarMediasScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     * Id evento
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [title] column value.
     * Titulo
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the [summary] column value.
     * Resumen
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Get the [body] column value.
     * Texto
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get the [optionally formatted] temporal [creationdate] column value.
     * Fecha creacion Actividad
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreationdate($format = 'Y-m-d H:i:s')
    {
        if ($this->creationdate === null) {
            return null;
        }

        if ($this->creationdate === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->creationdate);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->creationdate, true), $x);
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
     * Get the [optionally formatted] temporal [startdate] column value.
     * Fecha inicio Actividad
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartdate($format = 'Y-m-d H:i:s')
    {
        if ($this->startdate === null) {
            return null;
        }

        if ($this->startdate === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->startdate);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->startdate, true), $x);
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
     * Get the [optionally formatted] temporal [enddate] column value.
     * Fecha fin Actividad
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEnddate($format = 'Y-m-d H:i:s')
    {
        if ($this->enddate === null) {
            return null;
        }

        if ($this->enddate === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->enddate);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->enddate, true), $x);
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
     * Get the [sourcecontact] column value.
     * Mas informacion
     * @return string
     */
    public function getSourcecontact()
    {
        return $this->sourcecontact;
    }

    /**
     * Get the [status] column value.
     * Estado del evento
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [regionid] column value.
     * Id de la provincia
     * @return int
     */
    public function getRegionid()
    {
        return $this->regionid;
    }

    /**
     * Get the [categoryid] column value.
     * Id de la categoria
     * @return int
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * Get the [userid] column value.
     * Id del usuario
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Get the [optionally formatted] temporal [deleted_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDeletedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->deleted_at === null) {
            return null;
        }

        if ($this->deleted_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->deleted_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->deleted_at, true), $x);
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
     * Set the value of [id] column.
     * Id evento
     * @param int $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = CalendarEventPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     * Titulo
     * @param string $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = CalendarEventPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [summary] column.
     * Resumen
     * @param string $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setSummary($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->summary !== $v) {
            $this->summary = $v;
            $this->modifiedColumns[] = CalendarEventPeer::SUMMARY;
        }


        return $this;
    } // setSummary()

    /**
     * Set the value of [body] column.
     * Texto
     * @param string $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->body !== $v) {
            $this->body = $v;
            $this->modifiedColumns[] = CalendarEventPeer::BODY;
        }


        return $this;
    } // setBody()

    /**
     * Sets the value of [creationdate] column to a normalized version of the date/time value specified.
     * Fecha creacion Actividad
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setCreationdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creationdate !== null || $dt !== null) {
            $currentDateAsString = ($this->creationdate !== null && $tmpDt = new DateTime($this->creationdate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->creationdate = $newDateAsString;
                $this->modifiedColumns[] = CalendarEventPeer::CREATIONDATE;
            }
        } // if either are not null


        return $this;
    } // setCreationdate()

    /**
     * Sets the value of [startdate] column to a normalized version of the date/time value specified.
     * Fecha inicio Actividad
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setStartdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->startdate !== null || $dt !== null) {
            $currentDateAsString = ($this->startdate !== null && $tmpDt = new DateTime($this->startdate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->startdate = $newDateAsString;
                $this->modifiedColumns[] = CalendarEventPeer::STARTDATE;
            }
        } // if either are not null


        return $this;
    } // setStartdate()

    /**
     * Sets the value of [enddate] column to a normalized version of the date/time value specified.
     * Fecha fin Actividad
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setEnddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->enddate !== null || $dt !== null) {
            $currentDateAsString = ($this->enddate !== null && $tmpDt = new DateTime($this->enddate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->enddate = $newDateAsString;
                $this->modifiedColumns[] = CalendarEventPeer::ENDDATE;
            }
        } // if either are not null


        return $this;
    } // setEnddate()

    /**
     * Set the value of [sourcecontact] column.
     * Mas informacion
     * @param string $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setSourcecontact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sourcecontact !== $v) {
            $this->sourcecontact = $v;
            $this->modifiedColumns[] = CalendarEventPeer::SOURCECONTACT;
        }


        return $this;
    } // setSourcecontact()

    /**
     * Set the value of [status] column.
     * Estado del evento
     * @param int $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = CalendarEventPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [regionid] column.
     * Id de la provincia
     * @param int $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setRegionid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->regionid !== $v) {
            $this->regionid = $v;
            $this->modifiedColumns[] = CalendarEventPeer::REGIONID;
        }


        return $this;
    } // setRegionid()

    /**
     * Set the value of [categoryid] column.
     * Id de la categoria
     * @param int $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setCategoryid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->categoryid !== $v) {
            $this->categoryid = $v;
            $this->modifiedColumns[] = CalendarEventPeer::CATEGORYID;
        }

        if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
            $this->aCategory = null;
        }


        return $this;
    } // setCategoryid()

    /**
     * Set the value of [userid] column.
     * Id del usuario
     * @param int $v new value
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setUserid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->userid !== $v) {
            $this->userid = $v;
            $this->modifiedColumns[] = CalendarEventPeer::USERID;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }


        return $this;
    } // setUserid()

    /**
     * Sets the value of [deleted_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function setDeletedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->deleted_at !== null || $dt !== null) {
            $currentDateAsString = ($this->deleted_at !== null && $tmpDt = new DateTime($this->deleted_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->deleted_at = $newDateAsString;
                $this->modifiedColumns[] = CalendarEventPeer::DELETED_AT;
            }
        } // if either are not null


        return $this;
    } // setDeletedAt()

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
            $this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->summary = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->body = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->creationdate = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->startdate = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->enddate = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->sourcecontact = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->status = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->regionid = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->categoryid = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->userid = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->deleted_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = CalendarEventPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating CalendarEvent object", $e);
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

        if ($this->aCategory !== null && $this->categoryid !== $this->aCategory->getId()) {
            $this->aCategory = null;
        }
        if ($this->aUser !== null && $this->userid !== $this->aUser->getId()) {
            $this->aUser = null;
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
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = CalendarEventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->aCategory = null;
            $this->collCalendarMedias = null;

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
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = CalendarEventQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // soft_delete behavior
            if (!empty($ret) && CalendarEventQuery::isSoftDeleteEnabled()) {
                $this->setDeletedAt(time());
                $this->save($con);
                $this->postDelete($con);
                $con->commit();
                CalendarEventPeer::removeInstanceFromPool($this);

                return;
            }

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
            $con = Propel::getConnection(CalendarEventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                CalendarEventPeer::addInstanceToPool($this);
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

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->aCategory !== null) {
                if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
                    $affectedRows += $this->aCategory->save($con);
                }
                $this->setCategory($this->aCategory);
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

            if ($this->calendarMediasScheduledForDeletion !== null) {
                if (!$this->calendarMediasScheduledForDeletion->isEmpty()) {
                    CalendarMediaQuery::create()
                        ->filterByPrimaryKeys($this->calendarMediasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->calendarMediasScheduledForDeletion = null;
                }
            }

            if ($this->collCalendarMedias !== null) {
                foreach ($this->collCalendarMedias as $referrerFK) {
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

        $this->modifiedColumns[] = CalendarEventPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CalendarEventPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CalendarEventPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(CalendarEventPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`TITLE`';
        }
        if ($this->isColumnModified(CalendarEventPeer::SUMMARY)) {
            $modifiedColumns[':p' . $index++]  = '`SUMMARY`';
        }
        if ($this->isColumnModified(CalendarEventPeer::BODY)) {
            $modifiedColumns[':p' . $index++]  = '`BODY`';
        }
        if ($this->isColumnModified(CalendarEventPeer::CREATIONDATE)) {
            $modifiedColumns[':p' . $index++]  = '`CREATIONDATE`';
        }
        if ($this->isColumnModified(CalendarEventPeer::STARTDATE)) {
            $modifiedColumns[':p' . $index++]  = '`STARTDATE`';
        }
        if ($this->isColumnModified(CalendarEventPeer::ENDDATE)) {
            $modifiedColumns[':p' . $index++]  = '`ENDDATE`';
        }
        if ($this->isColumnModified(CalendarEventPeer::SOURCECONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`SOURCECONTACT`';
        }
        if ($this->isColumnModified(CalendarEventPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`STATUS`';
        }
        if ($this->isColumnModified(CalendarEventPeer::REGIONID)) {
            $modifiedColumns[':p' . $index++]  = '`REGIONID`';
        }
        if ($this->isColumnModified(CalendarEventPeer::CATEGORYID)) {
            $modifiedColumns[':p' . $index++]  = '`CATEGORYID`';
        }
        if ($this->isColumnModified(CalendarEventPeer::USERID)) {
            $modifiedColumns[':p' . $index++]  = '`USERID`';
        }
        if ($this->isColumnModified(CalendarEventPeer::DELETED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`DELETED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `calendar_event` (%s) VALUES (%s)',
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
                    case '`TITLE`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`SUMMARY`':
                        $stmt->bindValue($identifier, $this->summary, PDO::PARAM_STR);
                        break;
                    case '`BODY`':
                        $stmt->bindValue($identifier, $this->body, PDO::PARAM_STR);
                        break;
                    case '`CREATIONDATE`':
                        $stmt->bindValue($identifier, $this->creationdate, PDO::PARAM_STR);
                        break;
                    case '`STARTDATE`':
                        $stmt->bindValue($identifier, $this->startdate, PDO::PARAM_STR);
                        break;
                    case '`ENDDATE`':
                        $stmt->bindValue($identifier, $this->enddate, PDO::PARAM_STR);
                        break;
                    case '`SOURCECONTACT`':
                        $stmt->bindValue($identifier, $this->sourcecontact, PDO::PARAM_STR);
                        break;
                    case '`STATUS`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`REGIONID`':
                        $stmt->bindValue($identifier, $this->regionid, PDO::PARAM_INT);
                        break;
                    case '`CATEGORYID`':
                        $stmt->bindValue($identifier, $this->categoryid, PDO::PARAM_INT);
                        break;
                    case '`USERID`':
                        $stmt->bindValue($identifier, $this->userid, PDO::PARAM_INT);
                        break;
                    case '`DELETED_AT`':
                        $stmt->bindValue($identifier, $this->deleted_at, PDO::PARAM_STR);
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

            if ($this->aUser !== null) {
                if (!$this->aUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
                }
            }

            if ($this->aCategory !== null) {
                if (!$this->aCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
                }
            }


            if (($retval = CalendarEventPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collCalendarMedias !== null) {
                    foreach ($this->collCalendarMedias as $referrerFK) {
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
        $pos = CalendarEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getTitle();
                break;
            case 2:
                return $this->getSummary();
                break;
            case 3:
                return $this->getBody();
                break;
            case 4:
                return $this->getCreationdate();
                break;
            case 5:
                return $this->getStartdate();
                break;
            case 6:
                return $this->getEnddate();
                break;
            case 7:
                return $this->getSourcecontact();
                break;
            case 8:
                return $this->getStatus();
                break;
            case 9:
                return $this->getRegionid();
                break;
            case 10:
                return $this->getCategoryid();
                break;
            case 11:
                return $this->getUserid();
                break;
            case 12:
                return $this->getDeletedAt();
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
        if (isset($alreadyDumpedObjects['CalendarEvent'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CalendarEvent'][$this->getPrimaryKey()] = true;
        $keys = CalendarEventPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getSummary(),
            $keys[3] => $this->getBody(),
            $keys[4] => $this->getCreationdate(),
            $keys[5] => $this->getStartdate(),
            $keys[6] => $this->getEnddate(),
            $keys[7] => $this->getSourcecontact(),
            $keys[8] => $this->getStatus(),
            $keys[9] => $this->getRegionid(),
            $keys[10] => $this->getCategoryid(),
            $keys[11] => $this->getUserid(),
            $keys[12] => $this->getDeletedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUser) {
                $result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategory) {
                $result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCalendarMedias) {
                $result['CalendarMedias'] = $this->collCalendarMedias->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = CalendarEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setTitle($value);
                break;
            case 2:
                $this->setSummary($value);
                break;
            case 3:
                $this->setBody($value);
                break;
            case 4:
                $this->setCreationdate($value);
                break;
            case 5:
                $this->setStartdate($value);
                break;
            case 6:
                $this->setEnddate($value);
                break;
            case 7:
                $this->setSourcecontact($value);
                break;
            case 8:
                $this->setStatus($value);
                break;
            case 9:
                $this->setRegionid($value);
                break;
            case 10:
                $this->setCategoryid($value);
                break;
            case 11:
                $this->setUserid($value);
                break;
            case 12:
                $this->setDeletedAt($value);
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
        $keys = CalendarEventPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSummary($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCreationdate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStartdate($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEnddate($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setSourcecontact($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setStatus($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setRegionid($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCategoryid($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUserid($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setDeletedAt($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CalendarEventPeer::DATABASE_NAME);

        if ($this->isColumnModified(CalendarEventPeer::ID)) $criteria->add(CalendarEventPeer::ID, $this->id);
        if ($this->isColumnModified(CalendarEventPeer::TITLE)) $criteria->add(CalendarEventPeer::TITLE, $this->title);
        if ($this->isColumnModified(CalendarEventPeer::SUMMARY)) $criteria->add(CalendarEventPeer::SUMMARY, $this->summary);
        if ($this->isColumnModified(CalendarEventPeer::BODY)) $criteria->add(CalendarEventPeer::BODY, $this->body);
        if ($this->isColumnModified(CalendarEventPeer::CREATIONDATE)) $criteria->add(CalendarEventPeer::CREATIONDATE, $this->creationdate);
        if ($this->isColumnModified(CalendarEventPeer::STARTDATE)) $criteria->add(CalendarEventPeer::STARTDATE, $this->startdate);
        if ($this->isColumnModified(CalendarEventPeer::ENDDATE)) $criteria->add(CalendarEventPeer::ENDDATE, $this->enddate);
        if ($this->isColumnModified(CalendarEventPeer::SOURCECONTACT)) $criteria->add(CalendarEventPeer::SOURCECONTACT, $this->sourcecontact);
        if ($this->isColumnModified(CalendarEventPeer::STATUS)) $criteria->add(CalendarEventPeer::STATUS, $this->status);
        if ($this->isColumnModified(CalendarEventPeer::REGIONID)) $criteria->add(CalendarEventPeer::REGIONID, $this->regionid);
        if ($this->isColumnModified(CalendarEventPeer::CATEGORYID)) $criteria->add(CalendarEventPeer::CATEGORYID, $this->categoryid);
        if ($this->isColumnModified(CalendarEventPeer::USERID)) $criteria->add(CalendarEventPeer::USERID, $this->userid);
        if ($this->isColumnModified(CalendarEventPeer::DELETED_AT)) $criteria->add(CalendarEventPeer::DELETED_AT, $this->deleted_at);

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
        $criteria = new Criteria(CalendarEventPeer::DATABASE_NAME);
        $criteria->add(CalendarEventPeer::ID, $this->id);

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
     * @param object $copyObj An object of CalendarEvent (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setSummary($this->getSummary());
        $copyObj->setBody($this->getBody());
        $copyObj->setCreationdate($this->getCreationdate());
        $copyObj->setStartdate($this->getStartdate());
        $copyObj->setEnddate($this->getEnddate());
        $copyObj->setSourcecontact($this->getSourcecontact());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setRegionid($this->getRegionid());
        $copyObj->setCategoryid($this->getCategoryid());
        $copyObj->setUserid($this->getUserid());
        $copyObj->setDeletedAt($this->getDeletedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getCalendarMedias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCalendarMedia($relObj->copy($deepCopy));
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
     * @return CalendarEvent Clone of current object.
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
     * @return CalendarEventPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new CalendarEventPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return CalendarEvent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(User $v = null)
    {
        if ($v === null) {
            $this->setUserid(NULL);
        } else {
            $this->setUserid($v->getId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addCalendarEvent($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUser(PropelPDO $con = null)
    {
        if ($this->aUser === null && ($this->userid !== null)) {
            $this->aUser = UserQuery::create()->findPk($this->userid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addCalendarEvents($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Declares an association between this object and a Category object.
     *
     * @param             Category $v
     * @return CalendarEvent The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategory(Category $v = null)
    {
        if ($v === null) {
            $this->setCategoryid(NULL);
        } else {
            $this->setCategoryid($v->getId());
        }

        $this->aCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Category object, it will not be re-added.
        if ($v !== null) {
            $v->addCalendarEvent($this);
        }


        return $this;
    }


    /**
     * Get the associated Category object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Category The associated Category object.
     * @throws PropelException
     */
    public function getCategory(PropelPDO $con = null)
    {
        if ($this->aCategory === null && ($this->categoryid !== null)) {
            $this->aCategory = CategoryQuery::create()->findPk($this->categoryid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategory->addCalendarEvents($this);
             */
        }

        return $this->aCategory;
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
        if ('CalendarMedia' == $relationName) {
            $this->initCalendarMedias();
        }
    }

    /**
     * Clears out the collCalendarMedias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCalendarMedias()
     */
    public function clearCalendarMedias()
    {
        $this->collCalendarMedias = null; // important to set this to null since that means it is uninitialized
        $this->collCalendarMediasPartial = null;
    }

    /**
     * reset is the collCalendarMedias collection loaded partially
     *
     * @return void
     */
    public function resetPartialCalendarMedias($v = true)
    {
        $this->collCalendarMediasPartial = $v;
    }

    /**
     * Initializes the collCalendarMedias collection.
     *
     * By default this just sets the collCalendarMedias collection to an empty array (like clearcollCalendarMedias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCalendarMedias($overrideExisting = true)
    {
        if (null !== $this->collCalendarMedias && !$overrideExisting) {
            return;
        }
        $this->collCalendarMedias = new PropelObjectCollection();
        $this->collCalendarMedias->setModel('CalendarMedia');
    }

    /**
     * Gets an array of CalendarMedia objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this CalendarEvent is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CalendarMedia[] List of CalendarMedia objects
     * @throws PropelException
     */
    public function getCalendarMedias($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCalendarMediasPartial && !$this->isNew();
        if (null === $this->collCalendarMedias || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCalendarMedias) {
                // return empty collection
                $this->initCalendarMedias();
            } else {
                $collCalendarMedias = CalendarMediaQuery::create(null, $criteria)
                    ->filterByCalendarEvent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCalendarMediasPartial && count($collCalendarMedias)) {
                      $this->initCalendarMedias(false);

                      foreach($collCalendarMedias as $obj) {
                        if (false == $this->collCalendarMedias->contains($obj)) {
                          $this->collCalendarMedias->append($obj);
                        }
                      }

                      $this->collCalendarMediasPartial = true;
                    }

                    return $collCalendarMedias;
                }

                if($partial && $this->collCalendarMedias) {
                    foreach($this->collCalendarMedias as $obj) {
                        if($obj->isNew()) {
                            $collCalendarMedias[] = $obj;
                        }
                    }
                }

                $this->collCalendarMedias = $collCalendarMedias;
                $this->collCalendarMediasPartial = false;
            }
        }

        return $this->collCalendarMedias;
    }

    /**
     * Sets a collection of CalendarMedia objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $calendarMedias A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setCalendarMedias(PropelCollection $calendarMedias, PropelPDO $con = null)
    {
        $this->calendarMediasScheduledForDeletion = $this->getCalendarMedias(new Criteria(), $con)->diff($calendarMedias);

        foreach ($this->calendarMediasScheduledForDeletion as $calendarMediaRemoved) {
            $calendarMediaRemoved->setCalendarEvent(null);
        }

        $this->collCalendarMedias = null;
        foreach ($calendarMedias as $calendarMedia) {
            $this->addCalendarMedia($calendarMedia);
        }

        $this->collCalendarMedias = $calendarMedias;
        $this->collCalendarMediasPartial = false;
    }

    /**
     * Returns the number of related CalendarMedia objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CalendarMedia objects.
     * @throws PropelException
     */
    public function countCalendarMedias(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCalendarMediasPartial && !$this->isNew();
        if (null === $this->collCalendarMedias || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCalendarMedias) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getCalendarMedias());
                }
                $query = CalendarMediaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByCalendarEvent($this)
                    ->count($con);
            }
        } else {
            return count($this->collCalendarMedias);
        }
    }

    /**
     * Method called to associate a CalendarMedia object to this object
     * through the CalendarMedia foreign key attribute.
     *
     * @param    CalendarMedia $l CalendarMedia
     * @return CalendarEvent The current object (for fluent API support)
     */
    public function addCalendarMedia(CalendarMedia $l)
    {
        if ($this->collCalendarMedias === null) {
            $this->initCalendarMedias();
            $this->collCalendarMediasPartial = true;
        }
        if (!$this->collCalendarMedias->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddCalendarMedia($l);
        }

        return $this;
    }

    /**
     * @param	CalendarMedia $calendarMedia The calendarMedia object to add.
     */
    protected function doAddCalendarMedia($calendarMedia)
    {
        $this->collCalendarMedias[]= $calendarMedia;
        $calendarMedia->setCalendarEvent($this);
    }

    /**
     * @param	CalendarMedia $calendarMedia The calendarMedia object to remove.
     */
    public function removeCalendarMedia($calendarMedia)
    {
        if ($this->getCalendarMedias()->contains($calendarMedia)) {
            $this->collCalendarMedias->remove($this->collCalendarMedias->search($calendarMedia));
            if (null === $this->calendarMediasScheduledForDeletion) {
                $this->calendarMediasScheduledForDeletion = clone $this->collCalendarMedias;
                $this->calendarMediasScheduledForDeletion->clear();
            }
            $this->calendarMediasScheduledForDeletion[]= $calendarMedia;
            $calendarMedia->setCalendarEvent(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this CalendarEvent is new, it will return
     * an empty collection; or if this CalendarEvent has previously
     * been saved, it will retrieve related CalendarMedias from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in CalendarEvent.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CalendarMedia[] List of CalendarMedia objects
     */
    public function getCalendarMediasJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CalendarMediaQuery::create(null, $criteria);
        $query->joinWith('User', $join_behavior);

        return $this->getCalendarMedias($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->summary = null;
        $this->body = null;
        $this->creationdate = null;
        $this->startdate = null;
        $this->enddate = null;
        $this->sourcecontact = null;
        $this->status = null;
        $this->regionid = null;
        $this->categoryid = null;
        $this->userid = null;
        $this->deleted_at = null;
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
            if ($this->collCalendarMedias) {
                foreach ($this->collCalendarMedias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collCalendarMedias instanceof PropelCollection) {
            $this->collCalendarMedias->clearIterator();
        }
        $this->collCalendarMedias = null;
        $this->aUser = null;
        $this->aCategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CalendarEventPeer::DEFAULT_STRING_FORMAT);
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

    // soft_delete behavior

    /**
     * Bypass the soft_delete behavior and force a hard delete of the current object
     */
    public function forceDelete(PropelPDO $con = null)
    {
        if ($isSoftDeleteEnabled = CalendarEventPeer::isSoftDeleteEnabled()) {
            CalendarEventPeer::disableSoftDelete();
        }
        $this->delete($con);
        if ($isSoftDeleteEnabled) {
            CalendarEventPeer::enableSoftDelete();
        }
    }

    /**
     * Undelete a row that was soft_deleted
     *
     * @return		 int The number of rows affected by this update and any referring fk objects' save() operations.
     */
    public function unDelete(PropelPDO $con = null)
    {
        $this->setDeletedAt(null);

        return $this->save($con);
    }

}
