<?php


/**
 * Base class that represents a row from the 'board_challenge' table.
 *
 * Challenges del Board
 *
 * @package    propel.generator.board.classes.om
 */
abstract class BaseBoardChallenge extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'BoardChallengePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BoardChallengePeer
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
     * The value for the url field.
     * @var        string
     */
    protected $url;

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
     * The value for the lastupdate field.
     * @var        string
     */
    protected $lastupdate;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the userid field.
     * @var        int
     */
    protected $userid;

    /**
     * The value for the views field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $views;

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
     * @var        PropelObjectCollection|BoardComment[] Collection to store aggregation of BoardComment objects.
     */
    protected $collBoardComments;
    protected $collBoardCommentsPartial;

    /**
     * @var        PropelObjectCollection|BoardBondRelation[] Collection to store aggregation of BoardBondRelation objects.
     */
    protected $collBoardBondRelations;
    protected $collBoardBondRelationsPartial;

    /**
     * @var        PropelObjectCollection|BoardBond[] Collection to store aggregation of BoardBond objects.
     */
    protected $collBoardBonds;

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
    protected $boardBondsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $boardCommentsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $boardBondRelationsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->views = 0;
    }

    /**
     * Initializes internal state of BaseBoardChallenge object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     * Id del challenge
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
     * Get the [url] column value.
     * Url a partir del titulo
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [body] column value.
     * Texto de la entrada
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get the [optionally formatted] temporal [creationdate] column value.
     * Fecha de creacion
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
     * Fecha de inicio
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
     * Fecha fin
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
     * Get the [optionally formatted] temporal [lastupdate] column value.
     * Fecha de ultima actualizacion
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastupdate($format = 'Y-m-d H:i:s')
    {
        if ($this->lastupdate === null) {
            return null;
        }

        if ($this->lastupdate === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->lastupdate);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->lastupdate, true), $x);
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
     * Get the [status] column value.
     * Estado del challenge
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
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
     * Get the [views] column value.
     * Cantidad de vistas a la entrada
     * @return int
     */
    public function getViews()
    {
        return $this->views;
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
     * Id del challenge
     * @param int $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BoardChallengePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [title] column.
     * Titulo
     * @param string $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = BoardChallengePeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [url] column.
     * Url a partir del titulo
     * @param string $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[] = BoardChallengePeer::URL;
        }


        return $this;
    } // setUrl()

    /**
     * Set the value of [body] column.
     * Texto de la entrada
     * @param string $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->body !== $v) {
            $this->body = $v;
            $this->modifiedColumns[] = BoardChallengePeer::BODY;
        }


        return $this;
    } // setBody()

    /**
     * Sets the value of [creationdate] column to a normalized version of the date/time value specified.
     * Fecha de creacion
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setCreationdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creationdate !== null || $dt !== null) {
            $currentDateAsString = ($this->creationdate !== null && $tmpDt = new DateTime($this->creationdate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->creationdate = $newDateAsString;
                $this->modifiedColumns[] = BoardChallengePeer::CREATIONDATE;
            }
        } // if either are not null


        return $this;
    } // setCreationdate()

    /**
     * Sets the value of [startdate] column to a normalized version of the date/time value specified.
     * Fecha de inicio
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setStartdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->startdate !== null || $dt !== null) {
            $currentDateAsString = ($this->startdate !== null && $tmpDt = new DateTime($this->startdate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->startdate = $newDateAsString;
                $this->modifiedColumns[] = BoardChallengePeer::STARTDATE;
            }
        } // if either are not null


        return $this;
    } // setStartdate()

    /**
     * Sets the value of [enddate] column to a normalized version of the date/time value specified.
     * Fecha fin
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setEnddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->enddate !== null || $dt !== null) {
            $currentDateAsString = ($this->enddate !== null && $tmpDt = new DateTime($this->enddate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->enddate = $newDateAsString;
                $this->modifiedColumns[] = BoardChallengePeer::ENDDATE;
            }
        } // if either are not null


        return $this;
    } // setEnddate()

    /**
     * Sets the value of [lastupdate] column to a normalized version of the date/time value specified.
     * Fecha de ultima actualizacion
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setLastupdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lastupdate !== null || $dt !== null) {
            $currentDateAsString = ($this->lastupdate !== null && $tmpDt = new DateTime($this->lastupdate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->lastupdate = $newDateAsString;
                $this->modifiedColumns[] = BoardChallengePeer::LASTUPDATE;
            }
        } // if either are not null


        return $this;
    } // setLastupdate()

    /**
     * Set the value of [status] column.
     * Estado del challenge
     * @param int $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = BoardChallengePeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [userid] column.
     * Id del usuario
     * @param int $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setUserid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->userid !== $v) {
            $this->userid = $v;
            $this->modifiedColumns[] = BoardChallengePeer::USERID;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }


        return $this;
    } // setUserid()

    /**
     * Set the value of [views] column.
     * Cantidad de vistas a la entrada
     * @param int $v new value
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setViews($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->views !== $v) {
            $this->views = $v;
            $this->modifiedColumns[] = BoardChallengePeer::VIEWS;
        }


        return $this;
    } // setViews()

    /**
     * Sets the value of [deleted_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function setDeletedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->deleted_at !== null || $dt !== null) {
            $currentDateAsString = ($this->deleted_at !== null && $tmpDt = new DateTime($this->deleted_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->deleted_at = $newDateAsString;
                $this->modifiedColumns[] = BoardChallengePeer::DELETED_AT;
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
            if ($this->views !== 0) {
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
            $this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->url = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->body = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->creationdate = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->startdate = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->enddate = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->lastupdate = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->status = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->userid = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->views = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->deleted_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = BoardChallengePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BoardChallenge object", $e);
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
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BoardChallengePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->collBoardComments = null;

            $this->collBoardBondRelations = null;

            $this->collBoardBonds = null;
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
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BoardChallengeQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // soft_delete behavior
            if (!empty($ret) && BoardChallengeQuery::isSoftDeleteEnabled()) {
                $this->setDeletedAt(time());
                $this->save($con);
                $this->postDelete($con);
                $con->commit();
                BoardChallengePeer::removeInstanceFromPool($this);

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
            $con = Propel::getConnection(BoardChallengePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                BoardChallengePeer::addInstanceToPool($this);
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

            if ($this->boardBondsScheduledForDeletion !== null) {
                if (!$this->boardBondsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->boardBondsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    BoardBondRelationQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->boardBondsScheduledForDeletion = null;
                }

                foreach ($this->getBoardBonds() as $boardBond) {
                    if ($boardBond->isModified()) {
                        $boardBond->save($con);
                    }
                }
            }

            if ($this->boardCommentsScheduledForDeletion !== null) {
                if (!$this->boardCommentsScheduledForDeletion->isEmpty()) {
                    BoardCommentQuery::create()
                        ->filterByPrimaryKeys($this->boardCommentsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->boardCommentsScheduledForDeletion = null;
                }
            }

            if ($this->collBoardComments !== null) {
                foreach ($this->collBoardComments as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->boardBondRelationsScheduledForDeletion !== null) {
                if (!$this->boardBondRelationsScheduledForDeletion->isEmpty()) {
                    BoardBondRelationQuery::create()
                        ->filterByPrimaryKeys($this->boardBondRelationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->boardBondRelationsScheduledForDeletion = null;
                }
            }

            if ($this->collBoardBondRelations !== null) {
                foreach ($this->collBoardBondRelations as $referrerFK) {
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

        $this->modifiedColumns[] = BoardChallengePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BoardChallengePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BoardChallengePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(BoardChallengePeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`TITLE`';
        }
        if ($this->isColumnModified(BoardChallengePeer::URL)) {
            $modifiedColumns[':p' . $index++]  = '`URL`';
        }
        if ($this->isColumnModified(BoardChallengePeer::BODY)) {
            $modifiedColumns[':p' . $index++]  = '`BODY`';
        }
        if ($this->isColumnModified(BoardChallengePeer::CREATIONDATE)) {
            $modifiedColumns[':p' . $index++]  = '`CREATIONDATE`';
        }
        if ($this->isColumnModified(BoardChallengePeer::STARTDATE)) {
            $modifiedColumns[':p' . $index++]  = '`STARTDATE`';
        }
        if ($this->isColumnModified(BoardChallengePeer::ENDDATE)) {
            $modifiedColumns[':p' . $index++]  = '`ENDDATE`';
        }
        if ($this->isColumnModified(BoardChallengePeer::LASTUPDATE)) {
            $modifiedColumns[':p' . $index++]  = '`LASTUPDATE`';
        }
        if ($this->isColumnModified(BoardChallengePeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`STATUS`';
        }
        if ($this->isColumnModified(BoardChallengePeer::USERID)) {
            $modifiedColumns[':p' . $index++]  = '`USERID`';
        }
        if ($this->isColumnModified(BoardChallengePeer::VIEWS)) {
            $modifiedColumns[':p' . $index++]  = '`VIEWS`';
        }
        if ($this->isColumnModified(BoardChallengePeer::DELETED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`DELETED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `board_challenge` (%s) VALUES (%s)',
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
                    case '`URL`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
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
                    case '`LASTUPDATE`':
                        $stmt->bindValue($identifier, $this->lastupdate, PDO::PARAM_STR);
                        break;
                    case '`STATUS`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`USERID`':
                        $stmt->bindValue($identifier, $this->userid, PDO::PARAM_INT);
                        break;
                    case '`VIEWS`':
                        $stmt->bindValue($identifier, $this->views, PDO::PARAM_INT);
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


            if (($retval = BoardChallengePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBoardComments !== null) {
                    foreach ($this->collBoardComments as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBoardBondRelations !== null) {
                    foreach ($this->collBoardBondRelations as $referrerFK) {
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
        $pos = BoardChallengePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getUrl();
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
                return $this->getLastupdate();
                break;
            case 8:
                return $this->getStatus();
                break;
            case 9:
                return $this->getUserid();
                break;
            case 10:
                return $this->getViews();
                break;
            case 11:
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
        if (isset($alreadyDumpedObjects['BoardChallenge'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BoardChallenge'][$this->getPrimaryKey()] = true;
        $keys = BoardChallengePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getTitle(),
            $keys[2] => $this->getUrl(),
            $keys[3] => $this->getBody(),
            $keys[4] => $this->getCreationdate(),
            $keys[5] => $this->getStartdate(),
            $keys[6] => $this->getEnddate(),
            $keys[7] => $this->getLastupdate(),
            $keys[8] => $this->getStatus(),
            $keys[9] => $this->getUserid(),
            $keys[10] => $this->getViews(),
            $keys[11] => $this->getDeletedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUser) {
                $result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBoardComments) {
                $result['BoardComments'] = $this->collBoardComments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBoardBondRelations) {
                $result['BoardBondRelations'] = $this->collBoardBondRelations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BoardChallengePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setUrl($value);
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
                $this->setLastupdate($value);
                break;
            case 8:
                $this->setStatus($value);
                break;
            case 9:
                $this->setUserid($value);
                break;
            case 10:
                $this->setViews($value);
                break;
            case 11:
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
        $keys = BoardChallengePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUrl($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setCreationdate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStartdate($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEnddate($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setLastupdate($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setStatus($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setUserid($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setViews($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDeletedAt($arr[$keys[11]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BoardChallengePeer::DATABASE_NAME);

        if ($this->isColumnModified(BoardChallengePeer::ID)) $criteria->add(BoardChallengePeer::ID, $this->id);
        if ($this->isColumnModified(BoardChallengePeer::TITLE)) $criteria->add(BoardChallengePeer::TITLE, $this->title);
        if ($this->isColumnModified(BoardChallengePeer::URL)) $criteria->add(BoardChallengePeer::URL, $this->url);
        if ($this->isColumnModified(BoardChallengePeer::BODY)) $criteria->add(BoardChallengePeer::BODY, $this->body);
        if ($this->isColumnModified(BoardChallengePeer::CREATIONDATE)) $criteria->add(BoardChallengePeer::CREATIONDATE, $this->creationdate);
        if ($this->isColumnModified(BoardChallengePeer::STARTDATE)) $criteria->add(BoardChallengePeer::STARTDATE, $this->startdate);
        if ($this->isColumnModified(BoardChallengePeer::ENDDATE)) $criteria->add(BoardChallengePeer::ENDDATE, $this->enddate);
        if ($this->isColumnModified(BoardChallengePeer::LASTUPDATE)) $criteria->add(BoardChallengePeer::LASTUPDATE, $this->lastupdate);
        if ($this->isColumnModified(BoardChallengePeer::STATUS)) $criteria->add(BoardChallengePeer::STATUS, $this->status);
        if ($this->isColumnModified(BoardChallengePeer::USERID)) $criteria->add(BoardChallengePeer::USERID, $this->userid);
        if ($this->isColumnModified(BoardChallengePeer::VIEWS)) $criteria->add(BoardChallengePeer::VIEWS, $this->views);
        if ($this->isColumnModified(BoardChallengePeer::DELETED_AT)) $criteria->add(BoardChallengePeer::DELETED_AT, $this->deleted_at);

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
        $criteria = new Criteria(BoardChallengePeer::DATABASE_NAME);
        $criteria->add(BoardChallengePeer::ID, $this->id);

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
     * @param object $copyObj An object of BoardChallenge (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitle($this->getTitle());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setBody($this->getBody());
        $copyObj->setCreationdate($this->getCreationdate());
        $copyObj->setStartdate($this->getStartdate());
        $copyObj->setEnddate($this->getEnddate());
        $copyObj->setLastupdate($this->getLastupdate());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setUserid($this->getUserid());
        $copyObj->setViews($this->getViews());
        $copyObj->setDeletedAt($this->getDeletedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBoardComments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBoardComment($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBoardBondRelations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBoardBondRelation($relObj->copy($deepCopy));
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
     * @return BoardChallenge Clone of current object.
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
     * @return BoardChallengePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BoardChallengePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return BoardChallenge The current object (for fluent API support)
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
            $v->addBoardChallenge($this);
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
                $this->aUser->addBoardChallenges($this);
             */
        }

        return $this->aUser;
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
        if ('BoardComment' == $relationName) {
            $this->initBoardComments();
        }
        if ('BoardBondRelation' == $relationName) {
            $this->initBoardBondRelations();
        }
    }

    /**
     * Clears out the collBoardComments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBoardComments()
     */
    public function clearBoardComments()
    {
        $this->collBoardComments = null; // important to set this to null since that means it is uninitialized
        $this->collBoardCommentsPartial = null;
    }

    /**
     * reset is the collBoardComments collection loaded partially
     *
     * @return void
     */
    public function resetPartialBoardComments($v = true)
    {
        $this->collBoardCommentsPartial = $v;
    }

    /**
     * Initializes the collBoardComments collection.
     *
     * By default this just sets the collBoardComments collection to an empty array (like clearcollBoardComments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBoardComments($overrideExisting = true)
    {
        if (null !== $this->collBoardComments && !$overrideExisting) {
            return;
        }
        $this->collBoardComments = new PropelObjectCollection();
        $this->collBoardComments->setModel('BoardComment');
    }

    /**
     * Gets an array of BoardComment objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BoardChallenge is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BoardComment[] List of BoardComment objects
     * @throws PropelException
     */
    public function getBoardComments($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBoardCommentsPartial && !$this->isNew();
        if (null === $this->collBoardComments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBoardComments) {
                // return empty collection
                $this->initBoardComments();
            } else {
                $collBoardComments = BoardCommentQuery::create(null, $criteria)
                    ->filterByBoardChallenge($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBoardCommentsPartial && count($collBoardComments)) {
                      $this->initBoardComments(false);

                      foreach($collBoardComments as $obj) {
                        if (false == $this->collBoardComments->contains($obj)) {
                          $this->collBoardComments->append($obj);
                        }
                      }

                      $this->collBoardCommentsPartial = true;
                    }

                    return $collBoardComments;
                }

                if($partial && $this->collBoardComments) {
                    foreach($this->collBoardComments as $obj) {
                        if($obj->isNew()) {
                            $collBoardComments[] = $obj;
                        }
                    }
                }

                $this->collBoardComments = $collBoardComments;
                $this->collBoardCommentsPartial = false;
            }
        }

        return $this->collBoardComments;
    }

    /**
     * Sets a collection of BoardComment objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $boardComments A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setBoardComments(PropelCollection $boardComments, PropelPDO $con = null)
    {
        $this->boardCommentsScheduledForDeletion = $this->getBoardComments(new Criteria(), $con)->diff($boardComments);

        foreach ($this->boardCommentsScheduledForDeletion as $boardCommentRemoved) {
            $boardCommentRemoved->setBoardChallenge(null);
        }

        $this->collBoardComments = null;
        foreach ($boardComments as $boardComment) {
            $this->addBoardComment($boardComment);
        }

        $this->collBoardComments = $boardComments;
        $this->collBoardCommentsPartial = false;
    }

    /**
     * Returns the number of related BoardComment objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BoardComment objects.
     * @throws PropelException
     */
    public function countBoardComments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBoardCommentsPartial && !$this->isNew();
        if (null === $this->collBoardComments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBoardComments) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getBoardComments());
                }
                $query = BoardCommentQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBoardChallenge($this)
                    ->count($con);
            }
        } else {
            return count($this->collBoardComments);
        }
    }

    /**
     * Method called to associate a BoardComment object to this object
     * through the BoardComment foreign key attribute.
     *
     * @param    BoardComment $l BoardComment
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function addBoardComment(BoardComment $l)
    {
        if ($this->collBoardComments === null) {
            $this->initBoardComments();
            $this->collBoardCommentsPartial = true;
        }
        if (!$this->collBoardComments->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddBoardComment($l);
        }

        return $this;
    }

    /**
     * @param	BoardComment $boardComment The boardComment object to add.
     */
    protected function doAddBoardComment($boardComment)
    {
        $this->collBoardComments[]= $boardComment;
        $boardComment->setBoardChallenge($this);
    }

    /**
     * @param	BoardComment $boardComment The boardComment object to remove.
     */
    public function removeBoardComment($boardComment)
    {
        if ($this->getBoardComments()->contains($boardComment)) {
            $this->collBoardComments->remove($this->collBoardComments->search($boardComment));
            if (null === $this->boardCommentsScheduledForDeletion) {
                $this->boardCommentsScheduledForDeletion = clone $this->collBoardComments;
                $this->boardCommentsScheduledForDeletion->clear();
            }
            $this->boardCommentsScheduledForDeletion[]= $boardComment;
            $boardComment->setBoardChallenge(null);
        }
    }

    /**
     * Clears out the collBoardBondRelations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBoardBondRelations()
     */
    public function clearBoardBondRelations()
    {
        $this->collBoardBondRelations = null; // important to set this to null since that means it is uninitialized
        $this->collBoardBondRelationsPartial = null;
    }

    /**
     * reset is the collBoardBondRelations collection loaded partially
     *
     * @return void
     */
    public function resetPartialBoardBondRelations($v = true)
    {
        $this->collBoardBondRelationsPartial = $v;
    }

    /**
     * Initializes the collBoardBondRelations collection.
     *
     * By default this just sets the collBoardBondRelations collection to an empty array (like clearcollBoardBondRelations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBoardBondRelations($overrideExisting = true)
    {
        if (null !== $this->collBoardBondRelations && !$overrideExisting) {
            return;
        }
        $this->collBoardBondRelations = new PropelObjectCollection();
        $this->collBoardBondRelations->setModel('BoardBondRelation');
    }

    /**
     * Gets an array of BoardBondRelation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BoardChallenge is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BoardBondRelation[] List of BoardBondRelation objects
     * @throws PropelException
     */
    public function getBoardBondRelations($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBoardBondRelationsPartial && !$this->isNew();
        if (null === $this->collBoardBondRelations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBoardBondRelations) {
                // return empty collection
                $this->initBoardBondRelations();
            } else {
                $collBoardBondRelations = BoardBondRelationQuery::create(null, $criteria)
                    ->filterByBoardChallenge($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBoardBondRelationsPartial && count($collBoardBondRelations)) {
                      $this->initBoardBondRelations(false);

                      foreach($collBoardBondRelations as $obj) {
                        if (false == $this->collBoardBondRelations->contains($obj)) {
                          $this->collBoardBondRelations->append($obj);
                        }
                      }

                      $this->collBoardBondRelationsPartial = true;
                    }

                    return $collBoardBondRelations;
                }

                if($partial && $this->collBoardBondRelations) {
                    foreach($this->collBoardBondRelations as $obj) {
                        if($obj->isNew()) {
                            $collBoardBondRelations[] = $obj;
                        }
                    }
                }

                $this->collBoardBondRelations = $collBoardBondRelations;
                $this->collBoardBondRelationsPartial = false;
            }
        }

        return $this->collBoardBondRelations;
    }

    /**
     * Sets a collection of BoardBondRelation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $boardBondRelations A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setBoardBondRelations(PropelCollection $boardBondRelations, PropelPDO $con = null)
    {
        $this->boardBondRelationsScheduledForDeletion = $this->getBoardBondRelations(new Criteria(), $con)->diff($boardBondRelations);

        foreach ($this->boardBondRelationsScheduledForDeletion as $boardBondRelationRemoved) {
            $boardBondRelationRemoved->setBoardChallenge(null);
        }

        $this->collBoardBondRelations = null;
        foreach ($boardBondRelations as $boardBondRelation) {
            $this->addBoardBondRelation($boardBondRelation);
        }

        $this->collBoardBondRelations = $boardBondRelations;
        $this->collBoardBondRelationsPartial = false;
    }

    /**
     * Returns the number of related BoardBondRelation objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BoardBondRelation objects.
     * @throws PropelException
     */
    public function countBoardBondRelations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBoardBondRelationsPartial && !$this->isNew();
        if (null === $this->collBoardBondRelations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBoardBondRelations) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getBoardBondRelations());
                }
                $query = BoardBondRelationQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBoardChallenge($this)
                    ->count($con);
            }
        } else {
            return count($this->collBoardBondRelations);
        }
    }

    /**
     * Method called to associate a BoardBondRelation object to this object
     * through the BoardBondRelation foreign key attribute.
     *
     * @param    BoardBondRelation $l BoardBondRelation
     * @return BoardChallenge The current object (for fluent API support)
     */
    public function addBoardBondRelation(BoardBondRelation $l)
    {
        if ($this->collBoardBondRelations === null) {
            $this->initBoardBondRelations();
            $this->collBoardBondRelationsPartial = true;
        }
        if (!$this->collBoardBondRelations->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddBoardBondRelation($l);
        }

        return $this;
    }

    /**
     * @param	BoardBondRelation $boardBondRelation The boardBondRelation object to add.
     */
    protected function doAddBoardBondRelation($boardBondRelation)
    {
        $this->collBoardBondRelations[]= $boardBondRelation;
        $boardBondRelation->setBoardChallenge($this);
    }

    /**
     * @param	BoardBondRelation $boardBondRelation The boardBondRelation object to remove.
     */
    public function removeBoardBondRelation($boardBondRelation)
    {
        if ($this->getBoardBondRelations()->contains($boardBondRelation)) {
            $this->collBoardBondRelations->remove($this->collBoardBondRelations->search($boardBondRelation));
            if (null === $this->boardBondRelationsScheduledForDeletion) {
                $this->boardBondRelationsScheduledForDeletion = clone $this->collBoardBondRelations;
                $this->boardBondRelationsScheduledForDeletion->clear();
            }
            $this->boardBondRelationsScheduledForDeletion[]= $boardBondRelation;
            $boardBondRelation->setBoardChallenge(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BoardChallenge is new, it will return
     * an empty collection; or if this BoardChallenge has previously
     * been saved, it will retrieve related BoardBondRelations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BoardChallenge.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BoardBondRelation[] List of BoardBondRelation objects
     */
    public function getBoardBondRelationsJoinBoardBond($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BoardBondRelationQuery::create(null, $criteria);
        $query->joinWith('BoardBond', $join_behavior);

        return $this->getBoardBondRelations($query, $con);
    }

    /**
     * Clears out the collBoardBonds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBoardBonds()
     */
    public function clearBoardBonds()
    {
        $this->collBoardBonds = null; // important to set this to null since that means it is uninitialized
        $this->collBoardBondsPartial = null;
    }

    /**
     * Initializes the collBoardBonds collection.
     *
     * By default this just sets the collBoardBonds collection to an empty collection (like clearBoardBonds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initBoardBonds()
    {
        $this->collBoardBonds = new PropelObjectCollection();
        $this->collBoardBonds->setModel('BoardBond');
    }

    /**
     * Gets a collection of BoardBond objects related by a many-to-many relationship
     * to the current object by way of the board_bondRelation cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BoardChallenge is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|BoardBond[] List of BoardBond objects
     */
    public function getBoardBonds($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collBoardBonds || null !== $criteria) {
            if ($this->isNew() && null === $this->collBoardBonds) {
                // return empty collection
                $this->initBoardBonds();
            } else {
                $collBoardBonds = BoardBondQuery::create(null, $criteria)
                    ->filterByBoardChallenge($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collBoardBonds;
                }
                $this->collBoardBonds = $collBoardBonds;
            }
        }

        return $this->collBoardBonds;
    }

    /**
     * Sets a collection of BoardBond objects related by a many-to-many relationship
     * to the current object by way of the board_bondRelation cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $boardBonds A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setBoardBonds(PropelCollection $boardBonds, PropelPDO $con = null)
    {
        $this->clearBoardBonds();
        $currentBoardBonds = $this->getBoardBonds();

        $this->boardBondsScheduledForDeletion = $currentBoardBonds->diff($boardBonds);

        foreach ($boardBonds as $boardBond) {
            if (!$currentBoardBonds->contains($boardBond)) {
                $this->doAddBoardBond($boardBond);
            }
        }

        $this->collBoardBonds = $boardBonds;
    }

    /**
     * Gets the number of BoardBond objects related by a many-to-many relationship
     * to the current object by way of the board_bondRelation cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related BoardBond objects
     */
    public function countBoardBonds($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collBoardBonds || null !== $criteria) {
            if ($this->isNew() && null === $this->collBoardBonds) {
                return 0;
            } else {
                $query = BoardBondQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByBoardChallenge($this)
                    ->count($con);
            }
        } else {
            return count($this->collBoardBonds);
        }
    }

    /**
     * Associate a BoardBond object to this object
     * through the board_bondRelation cross reference table.
     *
     * @param  BoardBond $boardBond The BoardBondRelation object to relate
     * @return void
     */
    public function addBoardBond(BoardBond $boardBond)
    {
        if ($this->collBoardBonds === null) {
            $this->initBoardBonds();
        }
        if (!$this->collBoardBonds->contains($boardBond)) { // only add it if the **same** object is not already associated
            $this->doAddBoardBond($boardBond);

            $this->collBoardBonds[]= $boardBond;
        }
    }

    /**
     * @param	BoardBond $boardBond The boardBond object to add.
     */
    protected function doAddBoardBond($boardBond)
    {
        $boardBondRelation = new BoardBondRelation();
        $boardBondRelation->setBoardBond($boardBond);
        $this->addBoardBondRelation($boardBondRelation);
    }

    /**
     * Remove a BoardBond object to this object
     * through the board_bondRelation cross reference table.
     *
     * @param BoardBond $boardBond The BoardBondRelation object to relate
     * @return void
     */
    public function removeBoardBond(BoardBond $boardBond)
    {
        if ($this->getBoardBonds()->contains($boardBond)) {
            $this->collBoardBonds->remove($this->collBoardBonds->search($boardBond));
            if (null === $this->boardBondsScheduledForDeletion) {
                $this->boardBondsScheduledForDeletion = clone $this->collBoardBonds;
                $this->boardBondsScheduledForDeletion->clear();
            }
            $this->boardBondsScheduledForDeletion[]= $boardBond;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->title = null;
        $this->url = null;
        $this->body = null;
        $this->creationdate = null;
        $this->startdate = null;
        $this->enddate = null;
        $this->lastupdate = null;
        $this->status = null;
        $this->userid = null;
        $this->views = null;
        $this->deleted_at = null;
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
            if ($this->collBoardComments) {
                foreach ($this->collBoardComments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBoardBondRelations) {
                foreach ($this->collBoardBondRelations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBoardBonds) {
                foreach ($this->collBoardBonds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collBoardComments instanceof PropelCollection) {
            $this->collBoardComments->clearIterator();
        }
        $this->collBoardComments = null;
        if ($this->collBoardBondRelations instanceof PropelCollection) {
            $this->collBoardBondRelations->clearIterator();
        }
        $this->collBoardBondRelations = null;
        if ($this->collBoardBonds instanceof PropelCollection) {
            $this->collBoardBonds->clearIterator();
        }
        $this->collBoardBonds = null;
        $this->aUser = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BoardChallengePeer::DEFAULT_STRING_FORMAT);
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
        if ($isSoftDeleteEnabled = BoardChallengePeer::isSoftDeleteEnabled()) {
            BoardChallengePeer::disableSoftDelete();
        }
        $this->delete($con);
        if ($isSoftDeleteEnabled) {
            BoardChallengePeer::enableSoftDelete();
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
