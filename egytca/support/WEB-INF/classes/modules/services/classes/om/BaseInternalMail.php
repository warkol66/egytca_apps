<?php


/**
 * Base class that represents a row from the 'services_internalMail' table.
 *
 * Mensajes internos
 *
 * @package    propel.generator.services.classes.om
 */
abstract class BaseInternalMail extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'InternalMailPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        InternalMailPeer
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
     * The value for the subject field.
     * @var        string
     */
    protected $subject;

    /**
     * The value for the body field.
     * @var        string
     */
    protected $body;

    /**
     * The value for the recipientid field.
     * @var        int
     */
    protected $recipientid;

    /**
     * The value for the recipienttype field.
     * @var        string
     */
    protected $recipienttype;

    /**
     * The value for the readon field.
     * @var        string
     */
    protected $readon;

    /**
     * The value for the fromid field.
     * @var        int
     */
    protected $fromid;

    /**
     * The value for the fromtype field.
     * @var        string
     */
    protected $fromtype;

    /**
     * The value for the to field.
     * @var        resource
     */
    protected $to;

    /**
     * The value for the replyid field.
     * @var        int
     */
    protected $replyid;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * The value for the deleted_at field.
     * @var        string
     */
    protected $deleted_at;

    /**
     * @var        InternalMail
     */
    protected $aInternalMailRelatedByReplyid;

    /**
     * @var        PropelObjectCollection|InternalMail[] Collection to store aggregation of InternalMail objects.
     */
    protected $collInternalMailsRelatedById;
    protected $collInternalMailsRelatedByIdPartial;

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
    protected $internalMailsRelatedByIdScheduledForDeletion = null;

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
     * Get the [subject] column value.
     * Asunto
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get the [body] column value.
     * Cuerpo del mensaje
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get the [recipientid] column value.
     * Receptor del mensaje
     * @return int
     */
    public function getRecipientid()
    {
        return $this->recipientid;
    }

    /**
     * Get the [recipienttype] column value.
     * Tipo de receptor del mensaje
     * @return string
     */
    public function getRecipienttype()
    {
        return $this->recipienttype;
    }

    /**
     * Get the [optionally formatted] temporal [readon] column value.
     * Momento en que el mensaje fue leido
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getReadon($format = 'Y-m-d H:i:s')
    {
        if ($this->readon === null) {
            return null;
        }

        if ($this->readon === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->readon);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->readon, true), $x);
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
     * Get the [fromid] column value.
     * Remitente
     * @return int
     */
    public function getFromid()
    {
        return $this->fromid;
    }

    /**
     * Get the [fromtype] column value.
     * Tipo de remitente
     * @return string
     */
    public function getFromtype()
    {
        return $this->fromtype;
    }

    /**
     * Get the [to] column value.
     * Destinatarios
     * @return resource
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Get the [replyid] column value.
     * Id del mensaje al que responde
     * @return int
     */
    public function getReplyid()
    {
        return $this->replyid;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->created_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
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
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->updated_at);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
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
     *
     * @param int $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = InternalMailPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [subject] column.
     * Asunto
     * @param string $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setSubject($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subject !== $v) {
            $this->subject = $v;
            $this->modifiedColumns[] = InternalMailPeer::SUBJECT;
        }


        return $this;
    } // setSubject()

    /**
     * Set the value of [body] column.
     * Cuerpo del mensaje
     * @param string $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setBody($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->body !== $v) {
            $this->body = $v;
            $this->modifiedColumns[] = InternalMailPeer::BODY;
        }


        return $this;
    } // setBody()

    /**
     * Set the value of [recipientid] column.
     * Receptor del mensaje
     * @param int $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setRecipientid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->recipientid !== $v) {
            $this->recipientid = $v;
            $this->modifiedColumns[] = InternalMailPeer::RECIPIENTID;
        }


        return $this;
    } // setRecipientid()

    /**
     * Set the value of [recipienttype] column.
     * Tipo de receptor del mensaje
     * @param string $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setRecipienttype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->recipienttype !== $v) {
            $this->recipienttype = $v;
            $this->modifiedColumns[] = InternalMailPeer::RECIPIENTTYPE;
        }


        return $this;
    } // setRecipienttype()

    /**
     * Sets the value of [readon] column to a normalized version of the date/time value specified.
     * Momento en que el mensaje fue leido
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return InternalMail The current object (for fluent API support)
     */
    public function setReadon($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->readon !== null || $dt !== null) {
            $currentDateAsString = ($this->readon !== null && $tmpDt = new DateTime($this->readon)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->readon = $newDateAsString;
                $this->modifiedColumns[] = InternalMailPeer::READON;
            }
        } // if either are not null


        return $this;
    } // setReadon()

    /**
     * Set the value of [fromid] column.
     * Remitente
     * @param int $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setFromid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fromid !== $v) {
            $this->fromid = $v;
            $this->modifiedColumns[] = InternalMailPeer::FROMID;
        }


        return $this;
    } // setFromid()

    /**
     * Set the value of [fromtype] column.
     * Tipo de remitente
     * @param string $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setFromtype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fromtype !== $v) {
            $this->fromtype = $v;
            $this->modifiedColumns[] = InternalMailPeer::FROMTYPE;
        }


        return $this;
    } // setFromtype()

    /**
     * Set the value of [to] column.
     * Destinatarios
     * @param resource $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setTo($v)
    {
        // Because BLOB columns are streams in PDO we have to assume that they are
        // always modified when a new value is passed in.  For example, the contents
        // of the stream itself may have changed externally.
        if (!is_resource($v) && $v !== null) {
            $this->to = fopen('php://memory', 'r+');
            fwrite($this->to, $v);
            rewind($this->to);
        } else { // it's already a stream
            $this->to = $v;
        }
        $this->modifiedColumns[] = InternalMailPeer::TO;


        return $this;
    } // setTo()

    /**
     * Set the value of [replyid] column.
     * Id del mensaje al que responde
     * @param int $v new value
     * @return InternalMail The current object (for fluent API support)
     */
    public function setReplyid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->replyid !== $v) {
            $this->replyid = $v;
            $this->modifiedColumns[] = InternalMailPeer::REPLYID;
        }

        if ($this->aInternalMailRelatedByReplyid !== null && $this->aInternalMailRelatedByReplyid->getId() !== $v) {
            $this->aInternalMailRelatedByReplyid = null;
        }


        return $this;
    } // setReplyid()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return InternalMail The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = InternalMailPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return InternalMail The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = InternalMailPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Sets the value of [deleted_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return InternalMail The current object (for fluent API support)
     */
    public function setDeletedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->deleted_at !== null || $dt !== null) {
            $currentDateAsString = ($this->deleted_at !== null && $tmpDt = new DateTime($this->deleted_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->deleted_at = $newDateAsString;
                $this->modifiedColumns[] = InternalMailPeer::DELETED_AT;
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
            $this->subject = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->body = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->recipientid = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->recipienttype = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->readon = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->fromid = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->fromtype = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            if ($row[$startcol + 8] !== null) {
                $this->to = fopen('php://memory', 'r+');
                fwrite($this->to, $row[$startcol + 8]);
                rewind($this->to);
            } else {
                $this->to = null;
            }
            $this->replyid = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->deleted_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = InternalMailPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating InternalMail object", $e);
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

        if ($this->aInternalMailRelatedByReplyid !== null && $this->replyid !== $this->aInternalMailRelatedByReplyid->getId()) {
            $this->aInternalMailRelatedByReplyid = null;
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
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = InternalMailPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aInternalMailRelatedByReplyid = null;
            $this->collInternalMailsRelatedById = null;

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
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = InternalMailQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            // soft_delete behavior
            if (!empty($ret) && InternalMailQuery::isSoftDeleteEnabled()) {
                $this->keepUpdateDateUnchanged();
                $this->setDeletedAt(time());
                $this->save($con);
                $this->postDelete($con);
                $con->commit();
                InternalMailPeer::removeInstanceFromPool($this);

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
            $con = Propel::getConnection(InternalMailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(InternalMailPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(InternalMailPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(InternalMailPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                InternalMailPeer::addInstanceToPool($this);
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

            if ($this->aInternalMailRelatedByReplyid !== null) {
                if ($this->aInternalMailRelatedByReplyid->isModified() || $this->aInternalMailRelatedByReplyid->isNew()) {
                    $affectedRows += $this->aInternalMailRelatedByReplyid->save($con);
                }
                $this->setInternalMailRelatedByReplyid($this->aInternalMailRelatedByReplyid);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                // Rewind the to LOB column, since PDO does not rewind after inserting value.
                if ($this->to !== null && is_resource($this->to)) {
                    rewind($this->to);
                }

                $this->resetModified();
            }

            if ($this->internalMailsRelatedByIdScheduledForDeletion !== null) {
                if (!$this->internalMailsRelatedByIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->internalMailsRelatedByIdScheduledForDeletion as $internalMailRelatedById) {
                        // need to save related object because we set the relation to null
                        $internalMailRelatedById->save($con);
                    }
                    $this->internalMailsRelatedByIdScheduledForDeletion = null;
                }
            }

            if ($this->collInternalMailsRelatedById !== null) {
                foreach ($this->collInternalMailsRelatedById as $referrerFK) {
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

        $this->modifiedColumns[] = InternalMailPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . InternalMailPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(InternalMailPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(InternalMailPeer::SUBJECT)) {
            $modifiedColumns[':p' . $index++]  = '`SUBJECT`';
        }
        if ($this->isColumnModified(InternalMailPeer::BODY)) {
            $modifiedColumns[':p' . $index++]  = '`BODY`';
        }
        if ($this->isColumnModified(InternalMailPeer::RECIPIENTID)) {
            $modifiedColumns[':p' . $index++]  = '`RECIPIENTID`';
        }
        if ($this->isColumnModified(InternalMailPeer::RECIPIENTTYPE)) {
            $modifiedColumns[':p' . $index++]  = '`RECIPIENTTYPE`';
        }
        if ($this->isColumnModified(InternalMailPeer::READON)) {
            $modifiedColumns[':p' . $index++]  = '`READON`';
        }
        if ($this->isColumnModified(InternalMailPeer::FROMID)) {
            $modifiedColumns[':p' . $index++]  = '`FROMID`';
        }
        if ($this->isColumnModified(InternalMailPeer::FROMTYPE)) {
            $modifiedColumns[':p' . $index++]  = '`FROMTYPE`';
        }
        if ($this->isColumnModified(InternalMailPeer::TO)) {
            $modifiedColumns[':p' . $index++]  = '`TO`';
        }
        if ($this->isColumnModified(InternalMailPeer::REPLYID)) {
            $modifiedColumns[':p' . $index++]  = '`REPLYID`';
        }
        if ($this->isColumnModified(InternalMailPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(InternalMailPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }
        if ($this->isColumnModified(InternalMailPeer::DELETED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`DELETED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `services_internalMail` (%s) VALUES (%s)',
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
                    case '`SUBJECT`':
                        $stmt->bindValue($identifier, $this->subject, PDO::PARAM_STR);
                        break;
                    case '`BODY`':
                        $stmt->bindValue($identifier, $this->body, PDO::PARAM_STR);
                        break;
                    case '`RECIPIENTID`':
                        $stmt->bindValue($identifier, $this->recipientid, PDO::PARAM_INT);
                        break;
                    case '`RECIPIENTTYPE`':
                        $stmt->bindValue($identifier, $this->recipienttype, PDO::PARAM_STR);
                        break;
                    case '`READON`':
                        $stmt->bindValue($identifier, $this->readon, PDO::PARAM_STR);
                        break;
                    case '`FROMID`':
                        $stmt->bindValue($identifier, $this->fromid, PDO::PARAM_INT);
                        break;
                    case '`FROMTYPE`':
                        $stmt->bindValue($identifier, $this->fromtype, PDO::PARAM_STR);
                        break;
                    case '`TO`':
                        if (is_resource($this->to)) {
                            rewind($this->to);
                        }
                        $stmt->bindValue($identifier, $this->to, PDO::PARAM_LOB);
                        break;
                    case '`REPLYID`':
                        $stmt->bindValue($identifier, $this->replyid, PDO::PARAM_INT);
                        break;
                    case '`CREATED_AT`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
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

            if ($this->aInternalMailRelatedByReplyid !== null) {
                if (!$this->aInternalMailRelatedByReplyid->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aInternalMailRelatedByReplyid->getValidationFailures());
                }
            }


            if (($retval = InternalMailPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collInternalMailsRelatedById !== null) {
                    foreach ($this->collInternalMailsRelatedById as $referrerFK) {
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
        $pos = InternalMailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getSubject();
                break;
            case 2:
                return $this->getBody();
                break;
            case 3:
                return $this->getRecipientid();
                break;
            case 4:
                return $this->getRecipienttype();
                break;
            case 5:
                return $this->getReadon();
                break;
            case 6:
                return $this->getFromid();
                break;
            case 7:
                return $this->getFromtype();
                break;
            case 8:
                return $this->getTo();
                break;
            case 9:
                return $this->getReplyid();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
                return $this->getUpdatedAt();
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
        if (isset($alreadyDumpedObjects['InternalMail'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['InternalMail'][$this->getPrimaryKey()] = true;
        $keys = InternalMailPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getSubject(),
            $keys[2] => $this->getBody(),
            $keys[3] => $this->getRecipientid(),
            $keys[4] => $this->getRecipienttype(),
            $keys[5] => $this->getReadon(),
            $keys[6] => $this->getFromid(),
            $keys[7] => $this->getFromtype(),
            $keys[8] => $this->getTo(),
            $keys[9] => $this->getReplyid(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
            $keys[12] => $this->getDeletedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aInternalMailRelatedByReplyid) {
                $result['InternalMailRelatedByReplyid'] = $this->aInternalMailRelatedByReplyid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collInternalMailsRelatedById) {
                $result['InternalMailsRelatedById'] = $this->collInternalMailsRelatedById->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = InternalMailPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setSubject($value);
                break;
            case 2:
                $this->setBody($value);
                break;
            case 3:
                $this->setRecipientid($value);
                break;
            case 4:
                $this->setRecipienttype($value);
                break;
            case 5:
                $this->setReadon($value);
                break;
            case 6:
                $this->setFromid($value);
                break;
            case 7:
                $this->setFromtype($value);
                break;
            case 8:
                $this->setTo($value);
                break;
            case 9:
                $this->setReplyid($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
                $this->setUpdatedAt($value);
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
        $keys = InternalMailPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setSubject($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setBody($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setRecipientid($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setRecipienttype($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setReadon($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setFromid($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setFromtype($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setTo($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setReplyid($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setDeletedAt($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(InternalMailPeer::DATABASE_NAME);

        if ($this->isColumnModified(InternalMailPeer::ID)) $criteria->add(InternalMailPeer::ID, $this->id);
        if ($this->isColumnModified(InternalMailPeer::SUBJECT)) $criteria->add(InternalMailPeer::SUBJECT, $this->subject);
        if ($this->isColumnModified(InternalMailPeer::BODY)) $criteria->add(InternalMailPeer::BODY, $this->body);
        if ($this->isColumnModified(InternalMailPeer::RECIPIENTID)) $criteria->add(InternalMailPeer::RECIPIENTID, $this->recipientid);
        if ($this->isColumnModified(InternalMailPeer::RECIPIENTTYPE)) $criteria->add(InternalMailPeer::RECIPIENTTYPE, $this->recipienttype);
        if ($this->isColumnModified(InternalMailPeer::READON)) $criteria->add(InternalMailPeer::READON, $this->readon);
        if ($this->isColumnModified(InternalMailPeer::FROMID)) $criteria->add(InternalMailPeer::FROMID, $this->fromid);
        if ($this->isColumnModified(InternalMailPeer::FROMTYPE)) $criteria->add(InternalMailPeer::FROMTYPE, $this->fromtype);
        if ($this->isColumnModified(InternalMailPeer::TO)) $criteria->add(InternalMailPeer::TO, $this->to);
        if ($this->isColumnModified(InternalMailPeer::REPLYID)) $criteria->add(InternalMailPeer::REPLYID, $this->replyid);
        if ($this->isColumnModified(InternalMailPeer::CREATED_AT)) $criteria->add(InternalMailPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(InternalMailPeer::UPDATED_AT)) $criteria->add(InternalMailPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(InternalMailPeer::DELETED_AT)) $criteria->add(InternalMailPeer::DELETED_AT, $this->deleted_at);

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
        $criteria = new Criteria(InternalMailPeer::DATABASE_NAME);
        $criteria->add(InternalMailPeer::ID, $this->id);

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
     * @param object $copyObj An object of InternalMail (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSubject($this->getSubject());
        $copyObj->setBody($this->getBody());
        $copyObj->setRecipientid($this->getRecipientid());
        $copyObj->setRecipienttype($this->getRecipienttype());
        $copyObj->setReadon($this->getReadon());
        $copyObj->setFromid($this->getFromid());
        $copyObj->setFromtype($this->getFromtype());
        $copyObj->setTo($this->getTo());
        $copyObj->setReplyid($this->getReplyid());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setDeletedAt($this->getDeletedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getInternalMailsRelatedById() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInternalMailRelatedById($relObj->copy($deepCopy));
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
     * @return InternalMail Clone of current object.
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
     * @return InternalMailPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new InternalMailPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a InternalMail object.
     *
     * @param             InternalMail $v
     * @return InternalMail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setInternalMailRelatedByReplyid(InternalMail $v = null)
    {
        if ($v === null) {
            $this->setReplyid(NULL);
        } else {
            $this->setReplyid($v->getId());
        }

        $this->aInternalMailRelatedByReplyid = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the InternalMail object, it will not be re-added.
        if ($v !== null) {
            $v->addInternalMailRelatedById($this);
        }


        return $this;
    }


    /**
     * Get the associated InternalMail object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return InternalMail The associated InternalMail object.
     * @throws PropelException
     */
    public function getInternalMailRelatedByReplyid(PropelPDO $con = null)
    {
        if ($this->aInternalMailRelatedByReplyid === null && ($this->replyid !== null)) {
            $this->aInternalMailRelatedByReplyid = InternalMailQuery::create()->findPk($this->replyid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aInternalMailRelatedByReplyid->addInternalMailsRelatedById($this);
             */
        }

        return $this->aInternalMailRelatedByReplyid;
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
        if ('InternalMailRelatedById' == $relationName) {
            $this->initInternalMailsRelatedById();
        }
    }

    /**
     * Clears out the collInternalMailsRelatedById collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInternalMailsRelatedById()
     */
    public function clearInternalMailsRelatedById()
    {
        $this->collInternalMailsRelatedById = null; // important to set this to null since that means it is uninitialized
        $this->collInternalMailsRelatedByIdPartial = null;
    }

    /**
     * reset is the collInternalMailsRelatedById collection loaded partially
     *
     * @return void
     */
    public function resetPartialInternalMailsRelatedById($v = true)
    {
        $this->collInternalMailsRelatedByIdPartial = $v;
    }

    /**
     * Initializes the collInternalMailsRelatedById collection.
     *
     * By default this just sets the collInternalMailsRelatedById collection to an empty array (like clearcollInternalMailsRelatedById());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInternalMailsRelatedById($overrideExisting = true)
    {
        if (null !== $this->collInternalMailsRelatedById && !$overrideExisting) {
            return;
        }
        $this->collInternalMailsRelatedById = new PropelObjectCollection();
        $this->collInternalMailsRelatedById->setModel('InternalMail');
    }

    /**
     * Gets an array of InternalMail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this InternalMail is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|InternalMail[] List of InternalMail objects
     * @throws PropelException
     */
    public function getInternalMailsRelatedById($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collInternalMailsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collInternalMailsRelatedById || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInternalMailsRelatedById) {
                // return empty collection
                $this->initInternalMailsRelatedById();
            } else {
                $collInternalMailsRelatedById = InternalMailQuery::create(null, $criteria)
                    ->filterByInternalMailRelatedByReplyid($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collInternalMailsRelatedByIdPartial && count($collInternalMailsRelatedById)) {
                      $this->initInternalMailsRelatedById(false);

                      foreach($collInternalMailsRelatedById as $obj) {
                        if (false == $this->collInternalMailsRelatedById->contains($obj)) {
                          $this->collInternalMailsRelatedById->append($obj);
                        }
                      }

                      $this->collInternalMailsRelatedByIdPartial = true;
                    }

                    return $collInternalMailsRelatedById;
                }

                if($partial && $this->collInternalMailsRelatedById) {
                    foreach($this->collInternalMailsRelatedById as $obj) {
                        if($obj->isNew()) {
                            $collInternalMailsRelatedById[] = $obj;
                        }
                    }
                }

                $this->collInternalMailsRelatedById = $collInternalMailsRelatedById;
                $this->collInternalMailsRelatedByIdPartial = false;
            }
        }

        return $this->collInternalMailsRelatedById;
    }

    /**
     * Sets a collection of InternalMailRelatedById objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $internalMailsRelatedById A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setInternalMailsRelatedById(PropelCollection $internalMailsRelatedById, PropelPDO $con = null)
    {
        $this->internalMailsRelatedByIdScheduledForDeletion = $this->getInternalMailsRelatedById(new Criteria(), $con)->diff($internalMailsRelatedById);

        foreach ($this->internalMailsRelatedByIdScheduledForDeletion as $internalMailRelatedByIdRemoved) {
            $internalMailRelatedByIdRemoved->setInternalMailRelatedByReplyid(null);
        }

        $this->collInternalMailsRelatedById = null;
        foreach ($internalMailsRelatedById as $internalMailRelatedById) {
            $this->addInternalMailRelatedById($internalMailRelatedById);
        }

        $this->collInternalMailsRelatedById = $internalMailsRelatedById;
        $this->collInternalMailsRelatedByIdPartial = false;
    }

    /**
     * Returns the number of related InternalMail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related InternalMail objects.
     * @throws PropelException
     */
    public function countInternalMailsRelatedById(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collInternalMailsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collInternalMailsRelatedById || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInternalMailsRelatedById) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getInternalMailsRelatedById());
                }
                $query = InternalMailQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByInternalMailRelatedByReplyid($this)
                    ->count($con);
            }
        } else {
            return count($this->collInternalMailsRelatedById);
        }
    }

    /**
     * Method called to associate a InternalMail object to this object
     * through the InternalMail foreign key attribute.
     *
     * @param    InternalMail $l InternalMail
     * @return InternalMail The current object (for fluent API support)
     */
    public function addInternalMailRelatedById(InternalMail $l)
    {
        if ($this->collInternalMailsRelatedById === null) {
            $this->initInternalMailsRelatedById();
            $this->collInternalMailsRelatedByIdPartial = true;
        }
        if (!$this->collInternalMailsRelatedById->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddInternalMailRelatedById($l);
        }

        return $this;
    }

    /**
     * @param	InternalMailRelatedById $internalMailRelatedById The internalMailRelatedById object to add.
     */
    protected function doAddInternalMailRelatedById($internalMailRelatedById)
    {
        $this->collInternalMailsRelatedById[]= $internalMailRelatedById;
        $internalMailRelatedById->setInternalMailRelatedByReplyid($this);
    }

    /**
     * @param	InternalMailRelatedById $internalMailRelatedById The internalMailRelatedById object to remove.
     */
    public function removeInternalMailRelatedById($internalMailRelatedById)
    {
        if ($this->getInternalMailsRelatedById()->contains($internalMailRelatedById)) {
            $this->collInternalMailsRelatedById->remove($this->collInternalMailsRelatedById->search($internalMailRelatedById));
            if (null === $this->internalMailsRelatedByIdScheduledForDeletion) {
                $this->internalMailsRelatedByIdScheduledForDeletion = clone $this->collInternalMailsRelatedById;
                $this->internalMailsRelatedByIdScheduledForDeletion->clear();
            }
            $this->internalMailsRelatedByIdScheduledForDeletion[]= $internalMailRelatedById;
            $internalMailRelatedById->setInternalMailRelatedByReplyid(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->subject = null;
        $this->body = null;
        $this->recipientid = null;
        $this->recipienttype = null;
        $this->readon = null;
        $this->fromid = null;
        $this->fromtype = null;
        $this->to = null;
        $this->replyid = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collInternalMailsRelatedById) {
                foreach ($this->collInternalMailsRelatedById as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collInternalMailsRelatedById instanceof PropelCollection) {
            $this->collInternalMailsRelatedById->clearIterator();
        }
        $this->collInternalMailsRelatedById = null;
        $this->aInternalMailRelatedByReplyid = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(InternalMailPeer::DEFAULT_STRING_FORMAT);
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     InternalMail The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = InternalMailPeer::UPDATED_AT;

        return $this;
    }

    // soft_delete behavior

    /**
     * Bypass the soft_delete behavior and force a hard delete of the current object
     */
    public function forceDelete(PropelPDO $con = null)
    {
        if ($isSoftDeleteEnabled = InternalMailPeer::isSoftDeleteEnabled()) {
            InternalMailPeer::disableSoftDelete();
        }
        $this->delete($con);
        if ($isSoftDeleteEnabled) {
            InternalMailPeer::enableSoftDelete();
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
