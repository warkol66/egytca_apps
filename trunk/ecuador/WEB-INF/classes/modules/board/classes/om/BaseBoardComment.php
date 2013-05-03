<?php


/**
 * Base class that represents a row from the 'board_comment' table.
 *
 * Comentarios a challenges
 *
 * @package    propel.generator.board.classes.om
 */
abstract class BaseBoardComment extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'BoardCommentPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BoardCommentPeer
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
     * The value for the challengeid field.
     * @var        int
     */
    protected $challengeid;

    /**
     * The value for the bondid field.
     * @var        int
     */
    protected $bondid;

    /**
     * The value for the parentid field.
     * @var        int
     */
    protected $parentid;

    /**
     * The value for the text field.
     * @var        string
     */
    protected $text;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the ip field.
     * @var        string
     */
    protected $ip;

    /**
     * The value for the creationdate field.
     * @var        string
     */
    protected $creationdate;

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
     * The value for the objecttype field.
     * @var        string
     */
    protected $objecttype;

    /**
     * The value for the objectid field.
     * @var        int
     */
    protected $objectid;

    /**
     * @var        BoardChallenge
     */
    protected $aBoardChallenge;

    /**
     * @var        BoardBond
     */
    protected $aBoardBond;

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
     * Get the [id] column value.
     * Id comentario
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [challengeid] column value.
     * Id del challenge
     * @return int
     */
    public function getChallengeid()
    {
        return $this->challengeid;
    }

    /**
     * Get the [bondid] column value.
     * Id del compromiso
     * @return int
     */
    public function getBondid()
    {
        return $this->bondid;
    }

    /**
     * Get the [parentid] column value.
     * Id de comentario padre
     * @return int
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Get the [text] column value.
     * Comentario
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the [email] column value.
     * Email del usuario
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [username] column value.
     * Nombre del usuario
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [url] column value.
     * Url del usuario
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [ip] column value.
     * IP del usuario
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
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
     * Get the [status] column value.
     * Estado del comentario
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [userid] column value.
     * Id del usuario por registracion
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Get the [objecttype] column value.
     * Tipo de usuario
     * @return string
     */
    public function getObjecttype()
    {
        return $this->objecttype;
    }

    /**
     * Get the [objectid] column value.
     * Id del usuario
     * @return int
     */
    public function getObjectid()
    {
        return $this->objectid;
    }

    /**
     * Set the value of [id] column.
     * Id comentario
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BoardCommentPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [challengeid] column.
     * Id del challenge
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setChallengeid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->challengeid !== $v) {
            $this->challengeid = $v;
            $this->modifiedColumns[] = BoardCommentPeer::CHALLENGEID;
        }

        if ($this->aBoardChallenge !== null && $this->aBoardChallenge->getId() !== $v) {
            $this->aBoardChallenge = null;
        }


        return $this;
    } // setChallengeid()

    /**
     * Set the value of [bondid] column.
     * Id del compromiso
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setBondid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bondid !== $v) {
            $this->bondid = $v;
            $this->modifiedColumns[] = BoardCommentPeer::BONDID;
        }

        if ($this->aBoardBond !== null && $this->aBoardBond->getId() !== $v) {
            $this->aBoardBond = null;
        }


        return $this;
    } // setBondid()

    /**
     * Set the value of [parentid] column.
     * Id de comentario padre
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setParentid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->parentid !== $v) {
            $this->parentid = $v;
            $this->modifiedColumns[] = BoardCommentPeer::PARENTID;
        }


        return $this;
    } // setParentid()

    /**
     * Set the value of [text] column.
     * Comentario
     * @param string $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setText($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->text !== $v) {
            $this->text = $v;
            $this->modifiedColumns[] = BoardCommentPeer::TEXT;
        }


        return $this;
    } // setText()

    /**
     * Set the value of [email] column.
     * Email del usuario
     * @param string $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = BoardCommentPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [username] column.
     * Nombre del usuario
     * @param string $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[] = BoardCommentPeer::USERNAME;
        }


        return $this;
    } // setUsername()

    /**
     * Set the value of [url] column.
     * Url del usuario
     * @param string $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[] = BoardCommentPeer::URL;
        }


        return $this;
    } // setUrl()

    /**
     * Set the value of [ip] column.
     * IP del usuario
     * @param string $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setIp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ip !== $v) {
            $this->ip = $v;
            $this->modifiedColumns[] = BoardCommentPeer::IP;
        }


        return $this;
    } // setIp()

    /**
     * Sets the value of [creationdate] column to a normalized version of the date/time value specified.
     * Fecha de creacion
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BoardComment The current object (for fluent API support)
     */
    public function setCreationdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->creationdate !== null || $dt !== null) {
            $currentDateAsString = ($this->creationdate !== null && $tmpDt = new DateTime($this->creationdate)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->creationdate = $newDateAsString;
                $this->modifiedColumns[] = BoardCommentPeer::CREATIONDATE;
            }
        } // if either are not null


        return $this;
    } // setCreationdate()

    /**
     * Set the value of [status] column.
     * Estado del comentario
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = BoardCommentPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [userid] column.
     * Id del usuario por registracion
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setUserid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->userid !== $v) {
            $this->userid = $v;
            $this->modifiedColumns[] = BoardCommentPeer::USERID;
        }


        return $this;
    } // setUserid()

    /**
     * Set the value of [objecttype] column.
     * Tipo de usuario
     * @param string $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setObjecttype($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->objecttype !== $v) {
            $this->objecttype = $v;
            $this->modifiedColumns[] = BoardCommentPeer::OBJECTTYPE;
        }


        return $this;
    } // setObjecttype()

    /**
     * Set the value of [objectid] column.
     * Id del usuario
     * @param int $v new value
     * @return BoardComment The current object (for fluent API support)
     */
    public function setObjectid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->objectid !== $v) {
            $this->objectid = $v;
            $this->modifiedColumns[] = BoardCommentPeer::OBJECTID;
        }


        return $this;
    } // setObjectid()

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
            $this->challengeid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->bondid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->parentid = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->text = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->email = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->username = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->url = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->ip = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->creationdate = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->status = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->userid = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->objecttype = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->objectid = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = BoardCommentPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BoardComment object", $e);
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

        if ($this->aBoardChallenge !== null && $this->challengeid !== $this->aBoardChallenge->getId()) {
            $this->aBoardChallenge = null;
        }
        if ($this->aBoardBond !== null && $this->bondid !== $this->aBoardBond->getId()) {
            $this->aBoardBond = null;
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
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BoardCommentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBoardChallenge = null;
            $this->aBoardBond = null;
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
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BoardCommentQuery::create()
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
            $con = Propel::getConnection(BoardCommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                BoardCommentPeer::addInstanceToPool($this);
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

            if ($this->aBoardChallenge !== null) {
                if ($this->aBoardChallenge->isModified() || $this->aBoardChallenge->isNew()) {
                    $affectedRows += $this->aBoardChallenge->save($con);
                }
                $this->setBoardChallenge($this->aBoardChallenge);
            }

            if ($this->aBoardBond !== null) {
                if ($this->aBoardBond->isModified() || $this->aBoardBond->isNew()) {
                    $affectedRows += $this->aBoardBond->save($con);
                }
                $this->setBoardBond($this->aBoardBond);
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

        $this->modifiedColumns[] = BoardCommentPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BoardCommentPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BoardCommentPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(BoardCommentPeer::CHALLENGEID)) {
            $modifiedColumns[':p' . $index++]  = '`CHALLENGEID`';
        }
        if ($this->isColumnModified(BoardCommentPeer::BONDID)) {
            $modifiedColumns[':p' . $index++]  = '`BONDID`';
        }
        if ($this->isColumnModified(BoardCommentPeer::PARENTID)) {
            $modifiedColumns[':p' . $index++]  = '`PARENTID`';
        }
        if ($this->isColumnModified(BoardCommentPeer::TEXT)) {
            $modifiedColumns[':p' . $index++]  = '`TEXT`';
        }
        if ($this->isColumnModified(BoardCommentPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`EMAIL`';
        }
        if ($this->isColumnModified(BoardCommentPeer::USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USERNAME`';
        }
        if ($this->isColumnModified(BoardCommentPeer::URL)) {
            $modifiedColumns[':p' . $index++]  = '`URL`';
        }
        if ($this->isColumnModified(BoardCommentPeer::IP)) {
            $modifiedColumns[':p' . $index++]  = '`IP`';
        }
        if ($this->isColumnModified(BoardCommentPeer::CREATIONDATE)) {
            $modifiedColumns[':p' . $index++]  = '`CREATIONDATE`';
        }
        if ($this->isColumnModified(BoardCommentPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`STATUS`';
        }
        if ($this->isColumnModified(BoardCommentPeer::USERID)) {
            $modifiedColumns[':p' . $index++]  = '`USERID`';
        }
        if ($this->isColumnModified(BoardCommentPeer::OBJECTTYPE)) {
            $modifiedColumns[':p' . $index++]  = '`OBJECTTYPE`';
        }
        if ($this->isColumnModified(BoardCommentPeer::OBJECTID)) {
            $modifiedColumns[':p' . $index++]  = '`OBJECTID`';
        }

        $sql = sprintf(
            'INSERT INTO `board_comment` (%s) VALUES (%s)',
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
                    case '`CHALLENGEID`':
                        $stmt->bindValue($identifier, $this->challengeid, PDO::PARAM_INT);
                        break;
                    case '`BONDID`':
                        $stmt->bindValue($identifier, $this->bondid, PDO::PARAM_INT);
                        break;
                    case '`PARENTID`':
                        $stmt->bindValue($identifier, $this->parentid, PDO::PARAM_INT);
                        break;
                    case '`TEXT`':
                        $stmt->bindValue($identifier, $this->text, PDO::PARAM_STR);
                        break;
                    case '`EMAIL`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`USERNAME`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case '`URL`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case '`IP`':
                        $stmt->bindValue($identifier, $this->ip, PDO::PARAM_STR);
                        break;
                    case '`CREATIONDATE`':
                        $stmt->bindValue($identifier, $this->creationdate, PDO::PARAM_STR);
                        break;
                    case '`STATUS`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`USERID`':
                        $stmt->bindValue($identifier, $this->userid, PDO::PARAM_INT);
                        break;
                    case '`OBJECTTYPE`':
                        $stmt->bindValue($identifier, $this->objecttype, PDO::PARAM_STR);
                        break;
                    case '`OBJECTID`':
                        $stmt->bindValue($identifier, $this->objectid, PDO::PARAM_INT);
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

            if ($this->aBoardChallenge !== null) {
                if (!$this->aBoardChallenge->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBoardChallenge->getValidationFailures());
                }
            }

            if ($this->aBoardBond !== null) {
                if (!$this->aBoardBond->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBoardBond->getValidationFailures());
                }
            }


            if (($retval = BoardCommentPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = BoardCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getChallengeid();
                break;
            case 2:
                return $this->getBondid();
                break;
            case 3:
                return $this->getParentid();
                break;
            case 4:
                return $this->getText();
                break;
            case 5:
                return $this->getEmail();
                break;
            case 6:
                return $this->getUsername();
                break;
            case 7:
                return $this->getUrl();
                break;
            case 8:
                return $this->getIp();
                break;
            case 9:
                return $this->getCreationdate();
                break;
            case 10:
                return $this->getStatus();
                break;
            case 11:
                return $this->getUserid();
                break;
            case 12:
                return $this->getObjecttype();
                break;
            case 13:
                return $this->getObjectid();
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
        if (isset($alreadyDumpedObjects['BoardComment'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BoardComment'][$this->getPrimaryKey()] = true;
        $keys = BoardCommentPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getChallengeid(),
            $keys[2] => $this->getBondid(),
            $keys[3] => $this->getParentid(),
            $keys[4] => $this->getText(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getUsername(),
            $keys[7] => $this->getUrl(),
            $keys[8] => $this->getIp(),
            $keys[9] => $this->getCreationdate(),
            $keys[10] => $this->getStatus(),
            $keys[11] => $this->getUserid(),
            $keys[12] => $this->getObjecttype(),
            $keys[13] => $this->getObjectid(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aBoardChallenge) {
                $result['BoardChallenge'] = $this->aBoardChallenge->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBoardBond) {
                $result['BoardBond'] = $this->aBoardBond->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = BoardCommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setChallengeid($value);
                break;
            case 2:
                $this->setBondid($value);
                break;
            case 3:
                $this->setParentid($value);
                break;
            case 4:
                $this->setText($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setUsername($value);
                break;
            case 7:
                $this->setUrl($value);
                break;
            case 8:
                $this->setIp($value);
                break;
            case 9:
                $this->setCreationdate($value);
                break;
            case 10:
                $this->setStatus($value);
                break;
            case 11:
                $this->setUserid($value);
                break;
            case 12:
                $this->setObjecttype($value);
                break;
            case 13:
                $this->setObjectid($value);
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
        $keys = BoardCommentPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setChallengeid($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setBondid($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setParentid($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setText($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setEmail($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUsername($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setUrl($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setIp($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreationdate($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setStatus($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setUserid($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setObjecttype($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setObjectid($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BoardCommentPeer::DATABASE_NAME);

        if ($this->isColumnModified(BoardCommentPeer::ID)) $criteria->add(BoardCommentPeer::ID, $this->id);
        if ($this->isColumnModified(BoardCommentPeer::CHALLENGEID)) $criteria->add(BoardCommentPeer::CHALLENGEID, $this->challengeid);
        if ($this->isColumnModified(BoardCommentPeer::BONDID)) $criteria->add(BoardCommentPeer::BONDID, $this->bondid);
        if ($this->isColumnModified(BoardCommentPeer::PARENTID)) $criteria->add(BoardCommentPeer::PARENTID, $this->parentid);
        if ($this->isColumnModified(BoardCommentPeer::TEXT)) $criteria->add(BoardCommentPeer::TEXT, $this->text);
        if ($this->isColumnModified(BoardCommentPeer::EMAIL)) $criteria->add(BoardCommentPeer::EMAIL, $this->email);
        if ($this->isColumnModified(BoardCommentPeer::USERNAME)) $criteria->add(BoardCommentPeer::USERNAME, $this->username);
        if ($this->isColumnModified(BoardCommentPeer::URL)) $criteria->add(BoardCommentPeer::URL, $this->url);
        if ($this->isColumnModified(BoardCommentPeer::IP)) $criteria->add(BoardCommentPeer::IP, $this->ip);
        if ($this->isColumnModified(BoardCommentPeer::CREATIONDATE)) $criteria->add(BoardCommentPeer::CREATIONDATE, $this->creationdate);
        if ($this->isColumnModified(BoardCommentPeer::STATUS)) $criteria->add(BoardCommentPeer::STATUS, $this->status);
        if ($this->isColumnModified(BoardCommentPeer::USERID)) $criteria->add(BoardCommentPeer::USERID, $this->userid);
        if ($this->isColumnModified(BoardCommentPeer::OBJECTTYPE)) $criteria->add(BoardCommentPeer::OBJECTTYPE, $this->objecttype);
        if ($this->isColumnModified(BoardCommentPeer::OBJECTID)) $criteria->add(BoardCommentPeer::OBJECTID, $this->objectid);

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
        $criteria = new Criteria(BoardCommentPeer::DATABASE_NAME);
        $criteria->add(BoardCommentPeer::ID, $this->id);

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
     * @param object $copyObj An object of BoardComment (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setChallengeid($this->getChallengeid());
        $copyObj->setBondid($this->getBondid());
        $copyObj->setParentid($this->getParentid());
        $copyObj->setText($this->getText());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setIp($this->getIp());
        $copyObj->setCreationdate($this->getCreationdate());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setUserid($this->getUserid());
        $copyObj->setObjecttype($this->getObjecttype());
        $copyObj->setObjectid($this->getObjectid());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return BoardComment Clone of current object.
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
     * @return BoardCommentPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BoardCommentPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a BoardChallenge object.
     *
     * @param             BoardChallenge $v
     * @return BoardComment The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBoardChallenge(BoardChallenge $v = null)
    {
        if ($v === null) {
            $this->setChallengeid(NULL);
        } else {
            $this->setChallengeid($v->getId());
        }

        $this->aBoardChallenge = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BoardChallenge object, it will not be re-added.
        if ($v !== null) {
            $v->addBoardComment($this);
        }


        return $this;
    }


    /**
     * Get the associated BoardChallenge object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return BoardChallenge The associated BoardChallenge object.
     * @throws PropelException
     */
    public function getBoardChallenge(PropelPDO $con = null)
    {
        if ($this->aBoardChallenge === null && ($this->challengeid !== null)) {
            $this->aBoardChallenge = BoardChallengeQuery::create()->findPk($this->challengeid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBoardChallenge->addBoardComments($this);
             */
        }

        return $this->aBoardChallenge;
    }

    /**
     * Declares an association between this object and a BoardBond object.
     *
     * @param             BoardBond $v
     * @return BoardComment The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBoardBond(BoardBond $v = null)
    {
        if ($v === null) {
            $this->setBondid(NULL);
        } else {
            $this->setBondid($v->getId());
        }

        $this->aBoardBond = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BoardBond object, it will not be re-added.
        if ($v !== null) {
            $v->addBoardComment($this);
        }


        return $this;
    }


    /**
     * Get the associated BoardBond object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return BoardBond The associated BoardBond object.
     * @throws PropelException
     */
    public function getBoardBond(PropelPDO $con = null)
    {
        if ($this->aBoardBond === null && ($this->bondid !== null)) {
            $this->aBoardBond = BoardBondQuery::create()->findPk($this->bondid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBoardBond->addBoardComments($this);
             */
        }

        return $this->aBoardBond;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->challengeid = null;
        $this->bondid = null;
        $this->parentid = null;
        $this->text = null;
        $this->email = null;
        $this->username = null;
        $this->url = null;
        $this->ip = null;
        $this->creationdate = null;
        $this->status = null;
        $this->userid = null;
        $this->objecttype = null;
        $this->objectid = null;
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
        } // if ($deep)

        $this->aBoardChallenge = null;
        $this->aBoardBond = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BoardCommentPeer::DEFAULT_STRING_FORMAT);
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
