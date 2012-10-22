<?php


/**
 * Base class that represents a row from the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliate extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AffiliatePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        AffiliatePeer
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
     * The value for the ownerid field.
     * @var        int
     */
    protected $ownerid;

    /**
     * The value for the internalnumber field.
     * @var        string
     */
    protected $internalnumber;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the phone field.
     * @var        string
     */
    protected $phone;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the contact field.
     * @var        string
     */
    protected $contact;

    /**
     * The value for the contactemail field.
     * @var        string
     */
    protected $contactemail;

    /**
     * The value for the web field.
     * @var        string
     */
    protected $web;

    /**
     * The value for the memo field.
     * @var        string
     */
    protected $memo;

    /**
     * The value for the class_key field.
     * @var        int
     */
    protected $class_key;

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
     * @var        AffiliateUser
     */
    protected $aAffiliateUserRelatedByOwnerid;

    /**
     * @var        PropelObjectCollection|AffiliateUser[] Collection to store aggregation of AffiliateUser objects.
     */
    protected $collAffiliateUsersRelatedByAffiliateid;
    protected $collAffiliateUsersRelatedByAffiliateidPartial;

    /**
     * @var        PropelObjectCollection|AffiliateBranch[] Collection to store aggregation of AffiliateBranch objects.
     */
    protected $collAffiliateBranchs;
    protected $collAffiliateBranchsPartial;

    /**
     * @var        PropelObjectCollection|Requirement[] Collection to store aggregation of Requirement objects.
     */
    protected $collRequirements;
    protected $collRequirementsPartial;

    /**
     * @var        PropelObjectCollection|Development[] Collection to store aggregation of Development objects.
     */
    protected $collDevelopments;
    protected $collDevelopmentsPartial;

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
    protected $affiliateUsersRelatedByAffiliateidScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $affiliateBranchsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $requirementsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $developmentsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     * Id afiliado
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [name] column value.
     * nombre afiliado
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [ownerid] column value.
     * Id del usuario administrador del afiliado
     * @return int
     */
    public function getOwnerid()
    {
        return $this->ownerid;
    }

    /**
     * Get the [internalnumber] column value.
     * Id interno
     * @return string
     */
    public function getInternalnumber()
    {
        return $this->internalnumber;
    }

    /**
     * Get the [address] column value.
     * Direccion afiliado
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [phone] column value.
     * Telefono afiliado
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [email] column value.
     * Email afiliado
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [contact] column value.
     * Nombre de persona de contacto
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Get the [contactemail] column value.
     * Email de persona de contacto
     * @return string
     */
    public function getContactemail()
    {
        return $this->contactemail;
    }

    /**
     * Get the [web] column value.
     * Direccion web del afiliado
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Get the [memo] column value.
     * Informacion adicional del afiliado
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Get the [class_key] column value.
     *
     * @return int
     */
    public function getClassKey()
    {
        return $this->class_key;
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
     * Set the value of [id] column.
     * Id afiliado
     * @param int $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = AffiliatePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     * nombre afiliado
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = AffiliatePeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [ownerid] column.
     * Id del usuario administrador del afiliado
     * @param int $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setOwnerid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ownerid !== $v) {
            $this->ownerid = $v;
            $this->modifiedColumns[] = AffiliatePeer::OWNERID;
        }

        if ($this->aAffiliateUserRelatedByOwnerid !== null && $this->aAffiliateUserRelatedByOwnerid->getId() !== $v) {
            $this->aAffiliateUserRelatedByOwnerid = null;
        }


        return $this;
    } // setOwnerid()

    /**
     * Set the value of [internalnumber] column.
     * Id interno
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setInternalnumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->internalnumber !== $v) {
            $this->internalnumber = $v;
            $this->modifiedColumns[] = AffiliatePeer::INTERNALNUMBER;
        }


        return $this;
    } // setInternalnumber()

    /**
     * Set the value of [address] column.
     * Direccion afiliado
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[] = AffiliatePeer::ADDRESS;
        }


        return $this;
    } // setAddress()

    /**
     * Set the value of [phone] column.
     * Telefono afiliado
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[] = AffiliatePeer::PHONE;
        }


        return $this;
    } // setPhone()

    /**
     * Set the value of [email] column.
     * Email afiliado
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = AffiliatePeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [contact] column.
     * Nombre de persona de contacto
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[] = AffiliatePeer::CONTACT;
        }


        return $this;
    } // setContact()

    /**
     * Set the value of [contactemail] column.
     * Email de persona de contacto
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setContactemail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contactemail !== $v) {
            $this->contactemail = $v;
            $this->modifiedColumns[] = AffiliatePeer::CONTACTEMAIL;
        }


        return $this;
    } // setContactemail()

    /**
     * Set the value of [web] column.
     * Direccion web del afiliado
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setWeb($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->web !== $v) {
            $this->web = $v;
            $this->modifiedColumns[] = AffiliatePeer::WEB;
        }


        return $this;
    } // setWeb()

    /**
     * Set the value of [memo] column.
     * Informacion adicional del afiliado
     * @param string $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setMemo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->memo !== $v) {
            $this->memo = $v;
            $this->modifiedColumns[] = AffiliatePeer::MEMO;
        }


        return $this;
    } // setMemo()

    /**
     * Set the value of [class_key] column.
     *
     * @param int $v new value
     * @return Affiliate The current object (for fluent API support)
     */
    public function setClassKey($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->class_key !== $v) {
            $this->class_key = $v;
            $this->modifiedColumns[] = AffiliatePeer::CLASS_KEY;
        }


        return $this;
    } // setClassKey()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Affiliate The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = AffiliatePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Affiliate The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = AffiliatePeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

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
            $this->ownerid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->internalnumber = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->address = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->phone = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->email = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->contact = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->contactemail = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->web = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->memo = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->class_key = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->created_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->updated_at = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = AffiliatePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Affiliate object", $e);
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

        if ($this->aAffiliateUserRelatedByOwnerid !== null && $this->ownerid !== $this->aAffiliateUserRelatedByOwnerid->getId()) {
            $this->aAffiliateUserRelatedByOwnerid = null;
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
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = AffiliatePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAffiliateUserRelatedByOwnerid = null;
            $this->collAffiliateUsersRelatedByAffiliateid = null;

            $this->collAffiliateBranchs = null;

            $this->collRequirements = null;

            $this->collDevelopments = null;

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
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = AffiliateQuery::create()
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
            $con = Propel::getConnection(AffiliatePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(AffiliatePeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(AffiliatePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(AffiliatePeer::UPDATED_AT)) {
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
                AffiliatePeer::addInstanceToPool($this);
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

            if ($this->aAffiliateUserRelatedByOwnerid !== null) {
                if ($this->aAffiliateUserRelatedByOwnerid->isModified() || $this->aAffiliateUserRelatedByOwnerid->isNew()) {
                    $affectedRows += $this->aAffiliateUserRelatedByOwnerid->save($con);
                }
                $this->setAffiliateUserRelatedByOwnerid($this->aAffiliateUserRelatedByOwnerid);
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

            if ($this->affiliateUsersRelatedByAffiliateidScheduledForDeletion !== null) {
                if (!$this->affiliateUsersRelatedByAffiliateidScheduledForDeletion->isEmpty()) {
                    AffiliateUserQuery::create()
                        ->filterByPrimaryKeys($this->affiliateUsersRelatedByAffiliateidScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->affiliateUsersRelatedByAffiliateidScheduledForDeletion = null;
                }
            }

            if ($this->collAffiliateUsersRelatedByAffiliateid !== null) {
                foreach ($this->collAffiliateUsersRelatedByAffiliateid as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->affiliateBranchsScheduledForDeletion !== null) {
                if (!$this->affiliateBranchsScheduledForDeletion->isEmpty()) {
                    AffiliateBranchQuery::create()
                        ->filterByPrimaryKeys($this->affiliateBranchsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->affiliateBranchsScheduledForDeletion = null;
                }
            }

            if ($this->collAffiliateBranchs !== null) {
                foreach ($this->collAffiliateBranchs as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->requirementsScheduledForDeletion !== null) {
                if (!$this->requirementsScheduledForDeletion->isEmpty()) {
                    foreach ($this->requirementsScheduledForDeletion as $requirement) {
                        // need to save related object because we set the relation to null
                        $requirement->save($con);
                    }
                    $this->requirementsScheduledForDeletion = null;
                }
            }

            if ($this->collRequirements !== null) {
                foreach ($this->collRequirements as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->developmentsScheduledForDeletion !== null) {
                if (!$this->developmentsScheduledForDeletion->isEmpty()) {
                    foreach ($this->developmentsScheduledForDeletion as $development) {
                        // need to save related object because we set the relation to null
                        $development->save($con);
                    }
                    $this->developmentsScheduledForDeletion = null;
                }
            }

            if ($this->collDevelopments !== null) {
                foreach ($this->collDevelopments as $referrerFK) {
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

        $this->modifiedColumns[] = AffiliatePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AffiliatePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AffiliatePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(AffiliatePeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(AffiliatePeer::OWNERID)) {
            $modifiedColumns[':p' . $index++]  = '`OWNERID`';
        }
        if ($this->isColumnModified(AffiliatePeer::INTERNALNUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`INTERNALNUMBER`';
        }
        if ($this->isColumnModified(AffiliatePeer::ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`ADDRESS`';
        }
        if ($this->isColumnModified(AffiliatePeer::PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`PHONE`';
        }
        if ($this->isColumnModified(AffiliatePeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`EMAIL`';
        }
        if ($this->isColumnModified(AffiliatePeer::CONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACT`';
        }
        if ($this->isColumnModified(AffiliatePeer::CONTACTEMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`CONTACTEMAIL`';
        }
        if ($this->isColumnModified(AffiliatePeer::WEB)) {
            $modifiedColumns[':p' . $index++]  = '`WEB`';
        }
        if ($this->isColumnModified(AffiliatePeer::MEMO)) {
            $modifiedColumns[':p' . $index++]  = '`MEMO`';
        }
        if ($this->isColumnModified(AffiliatePeer::CLASS_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`CLASS_KEY`';
        }
        if ($this->isColumnModified(AffiliatePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(AffiliatePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `affiliates_affiliate` (%s) VALUES (%s)',
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
                    case '`OWNERID`':
                        $stmt->bindValue($identifier, $this->ownerid, PDO::PARAM_INT);
                        break;
                    case '`INTERNALNUMBER`':
                        $stmt->bindValue($identifier, $this->internalnumber, PDO::PARAM_STR);
                        break;
                    case '`ADDRESS`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`PHONE`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case '`EMAIL`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`CONTACT`':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);
                        break;
                    case '`CONTACTEMAIL`':
                        $stmt->bindValue($identifier, $this->contactemail, PDO::PARAM_STR);
                        break;
                    case '`WEB`':
                        $stmt->bindValue($identifier, $this->web, PDO::PARAM_STR);
                        break;
                    case '`MEMO`':
                        $stmt->bindValue($identifier, $this->memo, PDO::PARAM_STR);
                        break;
                    case '`CLASS_KEY`':
                        $stmt->bindValue($identifier, $this->class_key, PDO::PARAM_INT);
                        break;
                    case '`CREATED_AT`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`UPDATED_AT`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
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

            if ($this->aAffiliateUserRelatedByOwnerid !== null) {
                if (!$this->aAffiliateUserRelatedByOwnerid->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAffiliateUserRelatedByOwnerid->getValidationFailures());
                }
            }


            if (($retval = AffiliatePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collAffiliateUsersRelatedByAffiliateid !== null) {
                    foreach ($this->collAffiliateUsersRelatedByAffiliateid as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAffiliateBranchs !== null) {
                    foreach ($this->collAffiliateBranchs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRequirements !== null) {
                    foreach ($this->collRequirements as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collDevelopments !== null) {
                    foreach ($this->collDevelopments as $referrerFK) {
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
        $pos = AffiliatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getOwnerid();
                break;
            case 3:
                return $this->getInternalnumber();
                break;
            case 4:
                return $this->getAddress();
                break;
            case 5:
                return $this->getPhone();
                break;
            case 6:
                return $this->getEmail();
                break;
            case 7:
                return $this->getContact();
                break;
            case 8:
                return $this->getContactemail();
                break;
            case 9:
                return $this->getWeb();
                break;
            case 10:
                return $this->getMemo();
                break;
            case 11:
                return $this->getClassKey();
                break;
            case 12:
                return $this->getCreatedAt();
                break;
            case 13:
                return $this->getUpdatedAt();
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
        if (isset($alreadyDumpedObjects['Affiliate'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Affiliate'][$this->getPrimaryKey()] = true;
        $keys = AffiliatePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getOwnerid(),
            $keys[3] => $this->getInternalnumber(),
            $keys[4] => $this->getAddress(),
            $keys[5] => $this->getPhone(),
            $keys[6] => $this->getEmail(),
            $keys[7] => $this->getContact(),
            $keys[8] => $this->getContactemail(),
            $keys[9] => $this->getWeb(),
            $keys[10] => $this->getMemo(),
            $keys[11] => $this->getClassKey(),
            $keys[12] => $this->getCreatedAt(),
            $keys[13] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aAffiliateUserRelatedByOwnerid) {
                $result['AffiliateUserRelatedByOwnerid'] = $this->aAffiliateUserRelatedByOwnerid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAffiliateUsersRelatedByAffiliateid) {
                $result['AffiliateUsersRelatedByAffiliateid'] = $this->collAffiliateUsersRelatedByAffiliateid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAffiliateBranchs) {
                $result['AffiliateBranchs'] = $this->collAffiliateBranchs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRequirements) {
                $result['Requirements'] = $this->collRequirements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDevelopments) {
                $result['Developments'] = $this->collDevelopments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = AffiliatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setOwnerid($value);
                break;
            case 3:
                $this->setInternalnumber($value);
                break;
            case 4:
                $this->setAddress($value);
                break;
            case 5:
                $this->setPhone($value);
                break;
            case 6:
                $this->setEmail($value);
                break;
            case 7:
                $this->setContact($value);
                break;
            case 8:
                $this->setContactemail($value);
                break;
            case 9:
                $this->setWeb($value);
                break;
            case 10:
                $this->setMemo($value);
                break;
            case 11:
                $this->setClassKey($value);
                break;
            case 12:
                $this->setCreatedAt($value);
                break;
            case 13:
                $this->setUpdatedAt($value);
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
        $keys = AffiliatePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setOwnerid($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setInternalnumber($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAddress($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPhone($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEmail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setContact($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setContactemail($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setWeb($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setMemo($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setClassKey($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AffiliatePeer::DATABASE_NAME);

        if ($this->isColumnModified(AffiliatePeer::ID)) $criteria->add(AffiliatePeer::ID, $this->id);
        if ($this->isColumnModified(AffiliatePeer::NAME)) $criteria->add(AffiliatePeer::NAME, $this->name);
        if ($this->isColumnModified(AffiliatePeer::OWNERID)) $criteria->add(AffiliatePeer::OWNERID, $this->ownerid);
        if ($this->isColumnModified(AffiliatePeer::INTERNALNUMBER)) $criteria->add(AffiliatePeer::INTERNALNUMBER, $this->internalnumber);
        if ($this->isColumnModified(AffiliatePeer::ADDRESS)) $criteria->add(AffiliatePeer::ADDRESS, $this->address);
        if ($this->isColumnModified(AffiliatePeer::PHONE)) $criteria->add(AffiliatePeer::PHONE, $this->phone);
        if ($this->isColumnModified(AffiliatePeer::EMAIL)) $criteria->add(AffiliatePeer::EMAIL, $this->email);
        if ($this->isColumnModified(AffiliatePeer::CONTACT)) $criteria->add(AffiliatePeer::CONTACT, $this->contact);
        if ($this->isColumnModified(AffiliatePeer::CONTACTEMAIL)) $criteria->add(AffiliatePeer::CONTACTEMAIL, $this->contactemail);
        if ($this->isColumnModified(AffiliatePeer::WEB)) $criteria->add(AffiliatePeer::WEB, $this->web);
        if ($this->isColumnModified(AffiliatePeer::MEMO)) $criteria->add(AffiliatePeer::MEMO, $this->memo);
        if ($this->isColumnModified(AffiliatePeer::CLASS_KEY)) $criteria->add(AffiliatePeer::CLASS_KEY, $this->class_key);
        if ($this->isColumnModified(AffiliatePeer::CREATED_AT)) $criteria->add(AffiliatePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(AffiliatePeer::UPDATED_AT)) $criteria->add(AffiliatePeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(AffiliatePeer::DATABASE_NAME);
        $criteria->add(AffiliatePeer::ID, $this->id);

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
     * @param object $copyObj An object of Affiliate (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setOwnerid($this->getOwnerid());
        $copyObj->setInternalnumber($this->getInternalnumber());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setContact($this->getContact());
        $copyObj->setContactemail($this->getContactemail());
        $copyObj->setWeb($this->getWeb());
        $copyObj->setMemo($this->getMemo());
        $copyObj->setClassKey($this->getClassKey());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getAffiliateUsersRelatedByAffiliateid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAffiliateUserRelatedByAffiliateid($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAffiliateBranchs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAffiliateBranch($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRequirements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRequirement($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDevelopments() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDevelopment($relObj->copy($deepCopy));
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
     * @return Affiliate Clone of current object.
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
     * @return AffiliatePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new AffiliatePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a AffiliateUser object.
     *
     * @param             AffiliateUser $v
     * @return Affiliate The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAffiliateUserRelatedByOwnerid(AffiliateUser $v = null)
    {
        if ($v === null) {
            $this->setOwnerid(NULL);
        } else {
            $this->setOwnerid($v->getId());
        }

        $this->aAffiliateUserRelatedByOwnerid = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the AffiliateUser object, it will not be re-added.
        if ($v !== null) {
            $v->addAffiliateRelatedByOwnerid($this);
        }


        return $this;
    }


    /**
     * Get the associated AffiliateUser object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return AffiliateUser The associated AffiliateUser object.
     * @throws PropelException
     */
    public function getAffiliateUserRelatedByOwnerid(PropelPDO $con = null)
    {
        if ($this->aAffiliateUserRelatedByOwnerid === null && ($this->ownerid !== null)) {
            $this->aAffiliateUserRelatedByOwnerid = AffiliateUserQuery::create()->findPk($this->ownerid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAffiliateUserRelatedByOwnerid->addAffiliatesRelatedByOwnerid($this);
             */
        }

        return $this->aAffiliateUserRelatedByOwnerid;
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
        if ('AffiliateUserRelatedByAffiliateid' == $relationName) {
            $this->initAffiliateUsersRelatedByAffiliateid();
        }
        if ('AffiliateBranch' == $relationName) {
            $this->initAffiliateBranchs();
        }
        if ('Requirement' == $relationName) {
            $this->initRequirements();
        }
        if ('Development' == $relationName) {
            $this->initDevelopments();
        }
    }

    /**
     * Clears out the collAffiliateUsersRelatedByAffiliateid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAffiliateUsersRelatedByAffiliateid()
     */
    public function clearAffiliateUsersRelatedByAffiliateid()
    {
        $this->collAffiliateUsersRelatedByAffiliateid = null; // important to set this to null since that means it is uninitialized
        $this->collAffiliateUsersRelatedByAffiliateidPartial = null;
    }

    /**
     * reset is the collAffiliateUsersRelatedByAffiliateid collection loaded partially
     *
     * @return void
     */
    public function resetPartialAffiliateUsersRelatedByAffiliateid($v = true)
    {
        $this->collAffiliateUsersRelatedByAffiliateidPartial = $v;
    }

    /**
     * Initializes the collAffiliateUsersRelatedByAffiliateid collection.
     *
     * By default this just sets the collAffiliateUsersRelatedByAffiliateid collection to an empty array (like clearcollAffiliateUsersRelatedByAffiliateid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAffiliateUsersRelatedByAffiliateid($overrideExisting = true)
    {
        if (null !== $this->collAffiliateUsersRelatedByAffiliateid && !$overrideExisting) {
            return;
        }
        $this->collAffiliateUsersRelatedByAffiliateid = new PropelObjectCollection();
        $this->collAffiliateUsersRelatedByAffiliateid->setModel('AffiliateUser');
    }

    /**
     * Gets an array of AffiliateUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Affiliate is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AffiliateUser[] List of AffiliateUser objects
     * @throws PropelException
     */
    public function getAffiliateUsersRelatedByAffiliateid($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAffiliateUsersRelatedByAffiliateidPartial && !$this->isNew();
        if (null === $this->collAffiliateUsersRelatedByAffiliateid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAffiliateUsersRelatedByAffiliateid) {
                // return empty collection
                $this->initAffiliateUsersRelatedByAffiliateid();
            } else {
                $collAffiliateUsersRelatedByAffiliateid = AffiliateUserQuery::create(null, $criteria)
                    ->filterByAffiliateRelatedByAffiliateid($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAffiliateUsersRelatedByAffiliateidPartial && count($collAffiliateUsersRelatedByAffiliateid)) {
                      $this->initAffiliateUsersRelatedByAffiliateid(false);

                      foreach($collAffiliateUsersRelatedByAffiliateid as $obj) {
                        if (false == $this->collAffiliateUsersRelatedByAffiliateid->contains($obj)) {
                          $this->collAffiliateUsersRelatedByAffiliateid->append($obj);
                        }
                      }

                      $this->collAffiliateUsersRelatedByAffiliateidPartial = true;
                    }

                    return $collAffiliateUsersRelatedByAffiliateid;
                }

                if($partial && $this->collAffiliateUsersRelatedByAffiliateid) {
                    foreach($this->collAffiliateUsersRelatedByAffiliateid as $obj) {
                        if($obj->isNew()) {
                            $collAffiliateUsersRelatedByAffiliateid[] = $obj;
                        }
                    }
                }

                $this->collAffiliateUsersRelatedByAffiliateid = $collAffiliateUsersRelatedByAffiliateid;
                $this->collAffiliateUsersRelatedByAffiliateidPartial = false;
            }
        }

        return $this->collAffiliateUsersRelatedByAffiliateid;
    }

    /**
     * Sets a collection of AffiliateUserRelatedByAffiliateid objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $affiliateUsersRelatedByAffiliateid A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAffiliateUsersRelatedByAffiliateid(PropelCollection $affiliateUsersRelatedByAffiliateid, PropelPDO $con = null)
    {
        $this->affiliateUsersRelatedByAffiliateidScheduledForDeletion = $this->getAffiliateUsersRelatedByAffiliateid(new Criteria(), $con)->diff($affiliateUsersRelatedByAffiliateid);

        foreach ($this->affiliateUsersRelatedByAffiliateidScheduledForDeletion as $affiliateUserRelatedByAffiliateidRemoved) {
            $affiliateUserRelatedByAffiliateidRemoved->setAffiliateRelatedByAffiliateid(null);
        }

        $this->collAffiliateUsersRelatedByAffiliateid = null;
        foreach ($affiliateUsersRelatedByAffiliateid as $affiliateUserRelatedByAffiliateid) {
            $this->addAffiliateUserRelatedByAffiliateid($affiliateUserRelatedByAffiliateid);
        }

        $this->collAffiliateUsersRelatedByAffiliateid = $affiliateUsersRelatedByAffiliateid;
        $this->collAffiliateUsersRelatedByAffiliateidPartial = false;
    }

    /**
     * Returns the number of related AffiliateUser objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AffiliateUser objects.
     * @throws PropelException
     */
    public function countAffiliateUsersRelatedByAffiliateid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAffiliateUsersRelatedByAffiliateidPartial && !$this->isNew();
        if (null === $this->collAffiliateUsersRelatedByAffiliateid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAffiliateUsersRelatedByAffiliateid) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getAffiliateUsersRelatedByAffiliateid());
                }
                $query = AffiliateUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliateRelatedByAffiliateid($this)
                    ->count($con);
            }
        } else {
            return count($this->collAffiliateUsersRelatedByAffiliateid);
        }
    }

    /**
     * Method called to associate a AffiliateUser object to this object
     * through the AffiliateUser foreign key attribute.
     *
     * @param    AffiliateUser $l AffiliateUser
     * @return Affiliate The current object (for fluent API support)
     */
    public function addAffiliateUserRelatedByAffiliateid(AffiliateUser $l)
    {
        if ($this->collAffiliateUsersRelatedByAffiliateid === null) {
            $this->initAffiliateUsersRelatedByAffiliateid();
            $this->collAffiliateUsersRelatedByAffiliateidPartial = true;
        }
        if (!$this->collAffiliateUsersRelatedByAffiliateid->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddAffiliateUserRelatedByAffiliateid($l);
        }

        return $this;
    }

    /**
     * @param	AffiliateUserRelatedByAffiliateid $affiliateUserRelatedByAffiliateid The affiliateUserRelatedByAffiliateid object to add.
     */
    protected function doAddAffiliateUserRelatedByAffiliateid($affiliateUserRelatedByAffiliateid)
    {
        $this->collAffiliateUsersRelatedByAffiliateid[]= $affiliateUserRelatedByAffiliateid;
        $affiliateUserRelatedByAffiliateid->setAffiliateRelatedByAffiliateid($this);
    }

    /**
     * @param	AffiliateUserRelatedByAffiliateid $affiliateUserRelatedByAffiliateid The affiliateUserRelatedByAffiliateid object to remove.
     */
    public function removeAffiliateUserRelatedByAffiliateid($affiliateUserRelatedByAffiliateid)
    {
        if ($this->getAffiliateUsersRelatedByAffiliateid()->contains($affiliateUserRelatedByAffiliateid)) {
            $this->collAffiliateUsersRelatedByAffiliateid->remove($this->collAffiliateUsersRelatedByAffiliateid->search($affiliateUserRelatedByAffiliateid));
            if (null === $this->affiliateUsersRelatedByAffiliateidScheduledForDeletion) {
                $this->affiliateUsersRelatedByAffiliateidScheduledForDeletion = clone $this->collAffiliateUsersRelatedByAffiliateid;
                $this->affiliateUsersRelatedByAffiliateidScheduledForDeletion->clear();
            }
            $this->affiliateUsersRelatedByAffiliateidScheduledForDeletion[]= $affiliateUserRelatedByAffiliateid;
            $affiliateUserRelatedByAffiliateid->setAffiliateRelatedByAffiliateid(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Affiliate is new, it will return
     * an empty collection; or if this Affiliate has previously
     * been saved, it will retrieve related AffiliateUsersRelatedByAffiliateid from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Affiliate.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AffiliateUser[] List of AffiliateUser objects
     */
    public function getAffiliateUsersRelatedByAffiliateidJoinAffiliateLevel($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AffiliateUserQuery::create(null, $criteria);
        $query->joinWith('AffiliateLevel', $join_behavior);

        return $this->getAffiliateUsersRelatedByAffiliateid($query, $con);
    }

    /**
     * Clears out the collAffiliateBranchs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAffiliateBranchs()
     */
    public function clearAffiliateBranchs()
    {
        $this->collAffiliateBranchs = null; // important to set this to null since that means it is uninitialized
        $this->collAffiliateBranchsPartial = null;
    }

    /**
     * reset is the collAffiliateBranchs collection loaded partially
     *
     * @return void
     */
    public function resetPartialAffiliateBranchs($v = true)
    {
        $this->collAffiliateBranchsPartial = $v;
    }

    /**
     * Initializes the collAffiliateBranchs collection.
     *
     * By default this just sets the collAffiliateBranchs collection to an empty array (like clearcollAffiliateBranchs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAffiliateBranchs($overrideExisting = true)
    {
        if (null !== $this->collAffiliateBranchs && !$overrideExisting) {
            return;
        }
        $this->collAffiliateBranchs = new PropelObjectCollection();
        $this->collAffiliateBranchs->setModel('AffiliateBranch');
    }

    /**
     * Gets an array of AffiliateBranch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Affiliate is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AffiliateBranch[] List of AffiliateBranch objects
     * @throws PropelException
     */
    public function getAffiliateBranchs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAffiliateBranchsPartial && !$this->isNew();
        if (null === $this->collAffiliateBranchs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAffiliateBranchs) {
                // return empty collection
                $this->initAffiliateBranchs();
            } else {
                $collAffiliateBranchs = AffiliateBranchQuery::create(null, $criteria)
                    ->filterByAffiliate($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAffiliateBranchsPartial && count($collAffiliateBranchs)) {
                      $this->initAffiliateBranchs(false);

                      foreach($collAffiliateBranchs as $obj) {
                        if (false == $this->collAffiliateBranchs->contains($obj)) {
                          $this->collAffiliateBranchs->append($obj);
                        }
                      }

                      $this->collAffiliateBranchsPartial = true;
                    }

                    return $collAffiliateBranchs;
                }

                if($partial && $this->collAffiliateBranchs) {
                    foreach($this->collAffiliateBranchs as $obj) {
                        if($obj->isNew()) {
                            $collAffiliateBranchs[] = $obj;
                        }
                    }
                }

                $this->collAffiliateBranchs = $collAffiliateBranchs;
                $this->collAffiliateBranchsPartial = false;
            }
        }

        return $this->collAffiliateBranchs;
    }

    /**
     * Sets a collection of AffiliateBranch objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $affiliateBranchs A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAffiliateBranchs(PropelCollection $affiliateBranchs, PropelPDO $con = null)
    {
        $this->affiliateBranchsScheduledForDeletion = $this->getAffiliateBranchs(new Criteria(), $con)->diff($affiliateBranchs);

        foreach ($this->affiliateBranchsScheduledForDeletion as $affiliateBranchRemoved) {
            $affiliateBranchRemoved->setAffiliate(null);
        }

        $this->collAffiliateBranchs = null;
        foreach ($affiliateBranchs as $affiliateBranch) {
            $this->addAffiliateBranch($affiliateBranch);
        }

        $this->collAffiliateBranchs = $affiliateBranchs;
        $this->collAffiliateBranchsPartial = false;
    }

    /**
     * Returns the number of related AffiliateBranch objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AffiliateBranch objects.
     * @throws PropelException
     */
    public function countAffiliateBranchs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAffiliateBranchsPartial && !$this->isNew();
        if (null === $this->collAffiliateBranchs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAffiliateBranchs) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getAffiliateBranchs());
                }
                $query = AffiliateBranchQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliate($this)
                    ->count($con);
            }
        } else {
            return count($this->collAffiliateBranchs);
        }
    }

    /**
     * Method called to associate a AffiliateBranch object to this object
     * through the AffiliateBranch foreign key attribute.
     *
     * @param    AffiliateBranch $l AffiliateBranch
     * @return Affiliate The current object (for fluent API support)
     */
    public function addAffiliateBranch(AffiliateBranch $l)
    {
        if ($this->collAffiliateBranchs === null) {
            $this->initAffiliateBranchs();
            $this->collAffiliateBranchsPartial = true;
        }
        if (!$this->collAffiliateBranchs->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddAffiliateBranch($l);
        }

        return $this;
    }

    /**
     * @param	AffiliateBranch $affiliateBranch The affiliateBranch object to add.
     */
    protected function doAddAffiliateBranch($affiliateBranch)
    {
        $this->collAffiliateBranchs[]= $affiliateBranch;
        $affiliateBranch->setAffiliate($this);
    }

    /**
     * @param	AffiliateBranch $affiliateBranch The affiliateBranch object to remove.
     */
    public function removeAffiliateBranch($affiliateBranch)
    {
        if ($this->getAffiliateBranchs()->contains($affiliateBranch)) {
            $this->collAffiliateBranchs->remove($this->collAffiliateBranchs->search($affiliateBranch));
            if (null === $this->affiliateBranchsScheduledForDeletion) {
                $this->affiliateBranchsScheduledForDeletion = clone $this->collAffiliateBranchs;
                $this->affiliateBranchsScheduledForDeletion->clear();
            }
            $this->affiliateBranchsScheduledForDeletion[]= $affiliateBranch;
            $affiliateBranch->setAffiliate(null);
        }
    }

    /**
     * Clears out the collRequirements collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRequirements()
     */
    public function clearRequirements()
    {
        $this->collRequirements = null; // important to set this to null since that means it is uninitialized
        $this->collRequirementsPartial = null;
    }

    /**
     * reset is the collRequirements collection loaded partially
     *
     * @return void
     */
    public function resetPartialRequirements($v = true)
    {
        $this->collRequirementsPartial = $v;
    }

    /**
     * Initializes the collRequirements collection.
     *
     * By default this just sets the collRequirements collection to an empty array (like clearcollRequirements());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRequirements($overrideExisting = true)
    {
        if (null !== $this->collRequirements && !$overrideExisting) {
            return;
        }
        $this->collRequirements = new PropelObjectCollection();
        $this->collRequirements->setModel('Requirement');
    }

    /**
     * Gets an array of Requirement objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Affiliate is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Requirement[] List of Requirement objects
     * @throws PropelException
     */
    public function getRequirements($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRequirementsPartial && !$this->isNew();
        if (null === $this->collRequirements || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRequirements) {
                // return empty collection
                $this->initRequirements();
            } else {
                $collRequirements = RequirementQuery::create(null, $criteria)
                    ->filterByAffiliate($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRequirementsPartial && count($collRequirements)) {
                      $this->initRequirements(false);

                      foreach($collRequirements as $obj) {
                        if (false == $this->collRequirements->contains($obj)) {
                          $this->collRequirements->append($obj);
                        }
                      }

                      $this->collRequirementsPartial = true;
                    }

                    return $collRequirements;
                }

                if($partial && $this->collRequirements) {
                    foreach($this->collRequirements as $obj) {
                        if($obj->isNew()) {
                            $collRequirements[] = $obj;
                        }
                    }
                }

                $this->collRequirements = $collRequirements;
                $this->collRequirementsPartial = false;
            }
        }

        return $this->collRequirements;
    }

    /**
     * Sets a collection of Requirement objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $requirements A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setRequirements(PropelCollection $requirements, PropelPDO $con = null)
    {
        $this->requirementsScheduledForDeletion = $this->getRequirements(new Criteria(), $con)->diff($requirements);

        foreach ($this->requirementsScheduledForDeletion as $requirementRemoved) {
            $requirementRemoved->setAffiliate(null);
        }

        $this->collRequirements = null;
        foreach ($requirements as $requirement) {
            $this->addRequirement($requirement);
        }

        $this->collRequirements = $requirements;
        $this->collRequirementsPartial = false;
    }

    /**
     * Returns the number of related Requirement objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Requirement objects.
     * @throws PropelException
     */
    public function countRequirements(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRequirementsPartial && !$this->isNew();
        if (null === $this->collRequirements || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRequirements) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getRequirements());
                }
                $query = RequirementQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliate($this)
                    ->count($con);
            }
        } else {
            return count($this->collRequirements);
        }
    }

    /**
     * Method called to associate a Requirement object to this object
     * through the Requirement foreign key attribute.
     *
     * @param    Requirement $l Requirement
     * @return Affiliate The current object (for fluent API support)
     */
    public function addRequirement(Requirement $l)
    {
        if ($this->collRequirements === null) {
            $this->initRequirements();
            $this->collRequirementsPartial = true;
        }
        if (!$this->collRequirements->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddRequirement($l);
        }

        return $this;
    }

    /**
     * @param	Requirement $requirement The requirement object to add.
     */
    protected function doAddRequirement($requirement)
    {
        $this->collRequirements[]= $requirement;
        $requirement->setAffiliate($this);
    }

    /**
     * @param	Requirement $requirement The requirement object to remove.
     */
    public function removeRequirement($requirement)
    {
        if ($this->getRequirements()->contains($requirement)) {
            $this->collRequirements->remove($this->collRequirements->search($requirement));
            if (null === $this->requirementsScheduledForDeletion) {
                $this->requirementsScheduledForDeletion = clone $this->collRequirements;
                $this->requirementsScheduledForDeletion->clear();
            }
            $this->requirementsScheduledForDeletion[]= $requirement;
            $requirement->setAffiliate(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Affiliate is new, it will return
     * an empty collection; or if this Affiliate has previously
     * been saved, it will retrieve related Requirements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Affiliate.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Requirement[] List of Requirement objects
     */
    public function getRequirementsJoinDevelopment($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RequirementQuery::create(null, $criteria);
        $query->joinWith('Development', $join_behavior);

        return $this->getRequirements($query, $con);
    }

    /**
     * Clears out the collDevelopments collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDevelopments()
     */
    public function clearDevelopments()
    {
        $this->collDevelopments = null; // important to set this to null since that means it is uninitialized
        $this->collDevelopmentsPartial = null;
    }

    /**
     * reset is the collDevelopments collection loaded partially
     *
     * @return void
     */
    public function resetPartialDevelopments($v = true)
    {
        $this->collDevelopmentsPartial = $v;
    }

    /**
     * Initializes the collDevelopments collection.
     *
     * By default this just sets the collDevelopments collection to an empty array (like clearcollDevelopments());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDevelopments($overrideExisting = true)
    {
        if (null !== $this->collDevelopments && !$overrideExisting) {
            return;
        }
        $this->collDevelopments = new PropelObjectCollection();
        $this->collDevelopments->setModel('Development');
    }

    /**
     * Gets an array of Development objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Affiliate is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Development[] List of Development objects
     * @throws PropelException
     */
    public function getDevelopments($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collDevelopmentsPartial && !$this->isNew();
        if (null === $this->collDevelopments || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDevelopments) {
                // return empty collection
                $this->initDevelopments();
            } else {
                $collDevelopments = DevelopmentQuery::create(null, $criteria)
                    ->filterByAffiliate($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collDevelopmentsPartial && count($collDevelopments)) {
                      $this->initDevelopments(false);

                      foreach($collDevelopments as $obj) {
                        if (false == $this->collDevelopments->contains($obj)) {
                          $this->collDevelopments->append($obj);
                        }
                      }

                      $this->collDevelopmentsPartial = true;
                    }

                    return $collDevelopments;
                }

                if($partial && $this->collDevelopments) {
                    foreach($this->collDevelopments as $obj) {
                        if($obj->isNew()) {
                            $collDevelopments[] = $obj;
                        }
                    }
                }

                $this->collDevelopments = $collDevelopments;
                $this->collDevelopmentsPartial = false;
            }
        }

        return $this->collDevelopments;
    }

    /**
     * Sets a collection of Development objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $developments A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setDevelopments(PropelCollection $developments, PropelPDO $con = null)
    {
        $this->developmentsScheduledForDeletion = $this->getDevelopments(new Criteria(), $con)->diff($developments);

        foreach ($this->developmentsScheduledForDeletion as $developmentRemoved) {
            $developmentRemoved->setAffiliate(null);
        }

        $this->collDevelopments = null;
        foreach ($developments as $development) {
            $this->addDevelopment($development);
        }

        $this->collDevelopments = $developments;
        $this->collDevelopmentsPartial = false;
    }

    /**
     * Returns the number of related Development objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Development objects.
     * @throws PropelException
     */
    public function countDevelopments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collDevelopmentsPartial && !$this->isNew();
        if (null === $this->collDevelopments || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDevelopments) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getDevelopments());
                }
                $query = DevelopmentQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliate($this)
                    ->count($con);
            }
        } else {
            return count($this->collDevelopments);
        }
    }

    /**
     * Method called to associate a Development object to this object
     * through the Development foreign key attribute.
     *
     * @param    Development $l Development
     * @return Affiliate The current object (for fluent API support)
     */
    public function addDevelopment(Development $l)
    {
        if ($this->collDevelopments === null) {
            $this->initDevelopments();
            $this->collDevelopmentsPartial = true;
        }
        if (!$this->collDevelopments->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddDevelopment($l);
        }

        return $this;
    }

    /**
     * @param	Development $development The development object to add.
     */
    protected function doAddDevelopment($development)
    {
        $this->collDevelopments[]= $development;
        $development->setAffiliate($this);
    }

    /**
     * @param	Development $development The development object to remove.
     */
    public function removeDevelopment($development)
    {
        if ($this->getDevelopments()->contains($development)) {
            $this->collDevelopments->remove($this->collDevelopments->search($development));
            if (null === $this->developmentsScheduledForDeletion) {
                $this->developmentsScheduledForDeletion = clone $this->collDevelopments;
                $this->developmentsScheduledForDeletion->clear();
            }
            $this->developmentsScheduledForDeletion[]= $development;
            $development->setAffiliate(null);
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->ownerid = null;
        $this->internalnumber = null;
        $this->address = null;
        $this->phone = null;
        $this->email = null;
        $this->contact = null;
        $this->contactemail = null;
        $this->web = null;
        $this->memo = null;
        $this->class_key = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collAffiliateUsersRelatedByAffiliateid) {
                foreach ($this->collAffiliateUsersRelatedByAffiliateid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAffiliateBranchs) {
                foreach ($this->collAffiliateBranchs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRequirements) {
                foreach ($this->collRequirements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDevelopments) {
                foreach ($this->collDevelopments as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collAffiliateUsersRelatedByAffiliateid instanceof PropelCollection) {
            $this->collAffiliateUsersRelatedByAffiliateid->clearIterator();
        }
        $this->collAffiliateUsersRelatedByAffiliateid = null;
        if ($this->collAffiliateBranchs instanceof PropelCollection) {
            $this->collAffiliateBranchs->clearIterator();
        }
        $this->collAffiliateBranchs = null;
        if ($this->collRequirements instanceof PropelCollection) {
            $this->collRequirements->clearIterator();
        }
        $this->collRequirements = null;
        if ($this->collDevelopments instanceof PropelCollection) {
            $this->collDevelopments->clearIterator();
        }
        $this->collDevelopments = null;
        $this->aAffiliateUserRelatedByOwnerid = null;
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Affiliate The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = AffiliatePeer::UPDATED_AT;

        return $this;
    }

}
