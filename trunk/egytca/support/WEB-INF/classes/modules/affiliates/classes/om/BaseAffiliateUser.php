<?php


/**
 * Base class that represents a row from the 'affiliates_user' table.
 *
 * Usuarios de afiliado
 *
 * @package    propel.generator.affiliates.classes.om
 */
abstract class BaseAffiliateUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AffiliateUserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        AffiliateUserPeer
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
     * The value for the affiliateid field.
     * @var        int
     */
    protected $affiliateid;

    /**
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the passwordupdated field.
     * @var        string
     */
    protected $passwordupdated;

    /**
     * The value for the levelid field.
     * @var        int
     */
    protected $levelid;

    /**
     * The value for the lastlogin field.
     * @var        string
     */
    protected $lastlogin;

    /**
     * The value for the timezone field.
     * @var        string
     */
    protected $timezone;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the surname field.
     * @var        string
     */
    protected $surname;

    /**
     * The value for the mailaddress field.
     * @var        string
     */
    protected $mailaddress;

    /**
     * The value for the mailaddressalt field.
     * @var        string
     */
    protected $mailaddressalt;

    /**
     * The value for the recoveryhash field.
     * @var        string
     */
    protected $recoveryhash;

    /**
     * The value for the recoveryhashcreatedon field.
     * @var        string
     */
    protected $recoveryhashcreatedon;

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
     * @var        AffiliateLevel
     */
    protected $aAffiliateLevel;

    /**
     * @var        Affiliate
     */
    protected $aAffiliateRelatedByAffiliateid;

    /**
     * @var        PropelObjectCollection|Affiliate[] Collection to store aggregation of Affiliate objects.
     */
    protected $collAffiliatesRelatedByOwnerid;
    protected $collAffiliatesRelatedByOwneridPartial;

    /**
     * @var        PropelObjectCollection|AffiliateUserGroup[] Collection to store aggregation of AffiliateUserGroup objects.
     */
    protected $collAffiliateUserGroups;
    protected $collAffiliateUserGroupsPartial;

    /**
     * @var        PropelObjectCollection|AffiliateGroup[] Collection to store aggregation of AffiliateGroup objects.
     */
    protected $collAffiliateGroups;

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
    protected $affiliateGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $affiliatesRelatedByOwneridScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $affiliateUserGroupsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     * User Id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [affiliateid] column value.
     * Id afiliado
     * @return int
     */
    public function getAffiliateid()
    {
        return $this->affiliateid;
    }

    /**
     * Get the [username] column value.
     * username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [password] column value.
     * password
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [optionally formatted] temporal [passwordupdated] column value.
     * Fecha de actualizacion de la clave
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPasswordupdated($format = '%Y/%m/%d')
    {
        if ($this->passwordupdated === null) {
            return null;
        }

        if ($this->passwordupdated === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->passwordupdated);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->passwordupdated, true), $x);
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
     * Get the [levelid] column value.
     * User Level
     * @return int
     */
    public function getLevelid()
    {
        return $this->levelid;
    }

    /**
     * Get the [optionally formatted] temporal [lastlogin] column value.
     * Fecha del ultimo login del usuario
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastlogin($format = 'Y-m-d H:i:s')
    {
        if ($this->lastlogin === null) {
            return null;
        }

        if ($this->lastlogin === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->lastlogin);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->lastlogin, true), $x);
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
     * Get the [timezone] column value.
     * Timezone GMT del usuario
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Get the [name] column value.
     * name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [surname] column value.
     * surname
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Get the [mailaddress] column value.
     * Email
     * @return string
     */
    public function getMailaddress()
    {
        return $this->mailaddress;
    }

    /**
     * Get the [mailaddressalt] column value.
     * Direccion electronica alternativa
     * @return string
     */
    public function getMailaddressalt()
    {
        return $this->mailaddressalt;
    }

    /**
     * Get the [recoveryhash] column value.
     * Hash enviado para la recuperacion de clave
     * @return string
     */
    public function getRecoveryhash()
    {
        return $this->recoveryhash;
    }

    /**
     * Get the [optionally formatted] temporal [recoveryhashcreatedon] column value.
     * Momento de la solicitud para la recuperacion de clave
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRecoveryhashcreatedon($format = 'Y-m-d H:i:s')
    {
        if ($this->recoveryhashcreatedon === null) {
            return null;
        }

        if ($this->recoveryhashcreatedon === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->recoveryhashcreatedon);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->recoveryhashcreatedon, true), $x);
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
     * User Id
     * @param int $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [affiliateid] column.
     * Id afiliado
     * @param int $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setAffiliateid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->affiliateid !== $v) {
            $this->affiliateid = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::AFFILIATEID;
        }

        if ($this->aAffiliateRelatedByAffiliateid !== null && $this->aAffiliateRelatedByAffiliateid->getId() !== $v) {
            $this->aAffiliateRelatedByAffiliateid = null;
        }


        return $this;
    } // setAffiliateid()

    /**
     * Set the value of [username] column.
     * username
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::USERNAME;
        }


        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     * password
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Sets the value of [passwordupdated] column to a normalized version of the date/time value specified.
     * Fecha de actualizacion de la clave
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setPasswordupdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->passwordupdated !== null || $dt !== null) {
            $currentDateAsString = ($this->passwordupdated !== null && $tmpDt = new DateTime($this->passwordupdated)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->passwordupdated = $newDateAsString;
                $this->modifiedColumns[] = AffiliateUserPeer::PASSWORDUPDATED;
            }
        } // if either are not null


        return $this;
    } // setPasswordupdated()

    /**
     * Set the value of [levelid] column.
     * User Level
     * @param int $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setLevelid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->levelid !== $v) {
            $this->levelid = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::LEVELID;
        }

        if ($this->aAffiliateLevel !== null && $this->aAffiliateLevel->getId() !== $v) {
            $this->aAffiliateLevel = null;
        }


        return $this;
    } // setLevelid()

    /**
     * Sets the value of [lastlogin] column to a normalized version of the date/time value specified.
     * Fecha del ultimo login del usuario
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setLastlogin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lastlogin !== null || $dt !== null) {
            $currentDateAsString = ($this->lastlogin !== null && $tmpDt = new DateTime($this->lastlogin)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->lastlogin = $newDateAsString;
                $this->modifiedColumns[] = AffiliateUserPeer::LASTLOGIN;
            }
        } // if either are not null


        return $this;
    } // setLastlogin()

    /**
     * Set the value of [timezone] column.
     * Timezone GMT del usuario
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setTimezone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->timezone !== $v) {
            $this->timezone = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::TIMEZONE;
        }


        return $this;
    } // setTimezone()

    /**
     * Set the value of [name] column.
     * name
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [surname] column.
     * surname
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setSurname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->surname !== $v) {
            $this->surname = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::SURNAME;
        }


        return $this;
    } // setSurname()

    /**
     * Set the value of [mailaddress] column.
     * Email
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setMailaddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mailaddress !== $v) {
            $this->mailaddress = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::MAILADDRESS;
        }


        return $this;
    } // setMailaddress()

    /**
     * Set the value of [mailaddressalt] column.
     * Direccion electronica alternativa
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setMailaddressalt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mailaddressalt !== $v) {
            $this->mailaddressalt = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::MAILADDRESSALT;
        }


        return $this;
    } // setMailaddressalt()

    /**
     * Set the value of [recoveryhash] column.
     * Hash enviado para la recuperacion de clave
     * @param string $v new value
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setRecoveryhash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->recoveryhash !== $v) {
            $this->recoveryhash = $v;
            $this->modifiedColumns[] = AffiliateUserPeer::RECOVERYHASH;
        }


        return $this;
    } // setRecoveryhash()

    /**
     * Sets the value of [recoveryhashcreatedon] column to a normalized version of the date/time value specified.
     * Momento de la solicitud para la recuperacion de clave
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setRecoveryhashcreatedon($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->recoveryhashcreatedon !== null || $dt !== null) {
            $currentDateAsString = ($this->recoveryhashcreatedon !== null && $tmpDt = new DateTime($this->recoveryhashcreatedon)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->recoveryhashcreatedon = $newDateAsString;
                $this->modifiedColumns[] = AffiliateUserPeer::RECOVERYHASHCREATEDON;
            }
        } // if either are not null


        return $this;
    } // setRecoveryhashcreatedon()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = AffiliateUserPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = AffiliateUserPeer::UPDATED_AT;
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
            $this->affiliateid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->username = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->password = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->passwordupdated = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->levelid = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->lastlogin = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->timezone = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->name = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->surname = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->mailaddress = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->mailaddressalt = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->recoveryhash = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->recoveryhashcreatedon = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->created_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->updated_at = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = AffiliateUserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating AffiliateUser object", $e);
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

        if ($this->aAffiliateRelatedByAffiliateid !== null && $this->affiliateid !== $this->aAffiliateRelatedByAffiliateid->getId()) {
            $this->aAffiliateRelatedByAffiliateid = null;
        }
        if ($this->aAffiliateLevel !== null && $this->levelid !== $this->aAffiliateLevel->getId()) {
            $this->aAffiliateLevel = null;
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
            $con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = AffiliateUserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAffiliateLevel = null;
            $this->aAffiliateRelatedByAffiliateid = null;
            $this->collAffiliatesRelatedByOwnerid = null;

            $this->collAffiliateUserGroups = null;

            $this->collAffiliateGroups = null;
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
            $con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = AffiliateUserQuery::create()
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
            $con = Propel::getConnection(AffiliateUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(AffiliateUserPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(AffiliateUserPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(AffiliateUserPeer::UPDATED_AT)) {
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
                AffiliateUserPeer::addInstanceToPool($this);
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

            if ($this->aAffiliateLevel !== null) {
                if ($this->aAffiliateLevel->isModified() || $this->aAffiliateLevel->isNew()) {
                    $affectedRows += $this->aAffiliateLevel->save($con);
                }
                $this->setAffiliateLevel($this->aAffiliateLevel);
            }

            if ($this->aAffiliateRelatedByAffiliateid !== null) {
                if ($this->aAffiliateRelatedByAffiliateid->isModified() || $this->aAffiliateRelatedByAffiliateid->isNew()) {
                    $affectedRows += $this->aAffiliateRelatedByAffiliateid->save($con);
                }
                $this->setAffiliateRelatedByAffiliateid($this->aAffiliateRelatedByAffiliateid);
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

            if ($this->affiliateGroupsScheduledForDeletion !== null) {
                if (!$this->affiliateGroupsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->affiliateGroupsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    AffiliateUserGroupQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->affiliateGroupsScheduledForDeletion = null;
                }

                foreach ($this->getAffiliateGroups() as $affiliateGroup) {
                    if ($affiliateGroup->isModified()) {
                        $affiliateGroup->save($con);
                    }
                }
            }

            if ($this->affiliatesRelatedByOwneridScheduledForDeletion !== null) {
                if (!$this->affiliatesRelatedByOwneridScheduledForDeletion->isEmpty()) {
                    foreach ($this->affiliatesRelatedByOwneridScheduledForDeletion as $affiliateRelatedByOwnerid) {
                        // need to save related object because we set the relation to null
                        $affiliateRelatedByOwnerid->save($con);
                    }
                    $this->affiliatesRelatedByOwneridScheduledForDeletion = null;
                }
            }

            if ($this->collAffiliatesRelatedByOwnerid !== null) {
                foreach ($this->collAffiliatesRelatedByOwnerid as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
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

        $this->modifiedColumns[] = AffiliateUserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AffiliateUserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AffiliateUserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::AFFILIATEID)) {
            $modifiedColumns[':p' . $index++]  = '`AFFILIATEID`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`USERNAME`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`PASSWORD`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::PASSWORDUPDATED)) {
            $modifiedColumns[':p' . $index++]  = '`PASSWORDUPDATED`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::LEVELID)) {
            $modifiedColumns[':p' . $index++]  = '`LEVELID`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::LASTLOGIN)) {
            $modifiedColumns[':p' . $index++]  = '`LASTLOGIN`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::TIMEZONE)) {
            $modifiedColumns[':p' . $index++]  = '`TIMEZONE`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::SURNAME)) {
            $modifiedColumns[':p' . $index++]  = '`SURNAME`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::MAILADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`MAILADDRESS`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::MAILADDRESSALT)) {
            $modifiedColumns[':p' . $index++]  = '`MAILADDRESSALT`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::RECOVERYHASH)) {
            $modifiedColumns[':p' . $index++]  = '`RECOVERYHASH`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::RECOVERYHASHCREATEDON)) {
            $modifiedColumns[':p' . $index++]  = '`RECOVERYHASHCREATEDON`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(AffiliateUserPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `affiliates_user` (%s) VALUES (%s)',
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
                    case '`AFFILIATEID`':
                        $stmt->bindValue($identifier, $this->affiliateid, PDO::PARAM_INT);
                        break;
                    case '`USERNAME`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case '`PASSWORD`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`PASSWORDUPDATED`':
                        $stmt->bindValue($identifier, $this->passwordupdated, PDO::PARAM_STR);
                        break;
                    case '`LEVELID`':
                        $stmt->bindValue($identifier, $this->levelid, PDO::PARAM_INT);
                        break;
                    case '`LASTLOGIN`':
                        $stmt->bindValue($identifier, $this->lastlogin, PDO::PARAM_STR);
                        break;
                    case '`TIMEZONE`':
                        $stmt->bindValue($identifier, $this->timezone, PDO::PARAM_STR);
                        break;
                    case '`NAME`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`SURNAME`':
                        $stmt->bindValue($identifier, $this->surname, PDO::PARAM_STR);
                        break;
                    case '`MAILADDRESS`':
                        $stmt->bindValue($identifier, $this->mailaddress, PDO::PARAM_STR);
                        break;
                    case '`MAILADDRESSALT`':
                        $stmt->bindValue($identifier, $this->mailaddressalt, PDO::PARAM_STR);
                        break;
                    case '`RECOVERYHASH`':
                        $stmt->bindValue($identifier, $this->recoveryhash, PDO::PARAM_STR);
                        break;
                    case '`RECOVERYHASHCREATEDON`':
                        $stmt->bindValue($identifier, $this->recoveryhashcreatedon, PDO::PARAM_STR);
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

            if ($this->aAffiliateLevel !== null) {
                if (!$this->aAffiliateLevel->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAffiliateLevel->getValidationFailures());
                }
            }

            if ($this->aAffiliateRelatedByAffiliateid !== null) {
                if (!$this->aAffiliateRelatedByAffiliateid->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAffiliateRelatedByAffiliateid->getValidationFailures());
                }
            }


            if (($retval = AffiliateUserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collAffiliatesRelatedByOwnerid !== null) {
                    foreach ($this->collAffiliatesRelatedByOwnerid as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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
        $pos = AffiliateUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getAffiliateid();
                break;
            case 2:
                return $this->getUsername();
                break;
            case 3:
                return $this->getPassword();
                break;
            case 4:
                return $this->getPasswordupdated();
                break;
            case 5:
                return $this->getLevelid();
                break;
            case 6:
                return $this->getLastlogin();
                break;
            case 7:
                return $this->getTimezone();
                break;
            case 8:
                return $this->getName();
                break;
            case 9:
                return $this->getSurname();
                break;
            case 10:
                return $this->getMailaddress();
                break;
            case 11:
                return $this->getMailaddressalt();
                break;
            case 12:
                return $this->getRecoveryhash();
                break;
            case 13:
                return $this->getRecoveryhashcreatedon();
                break;
            case 14:
                return $this->getCreatedAt();
                break;
            case 15:
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
        if (isset($alreadyDumpedObjects['AffiliateUser'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['AffiliateUser'][$this->getPrimaryKey()] = true;
        $keys = AffiliateUserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAffiliateid(),
            $keys[2] => $this->getUsername(),
            $keys[3] => $this->getPassword(),
            $keys[4] => $this->getPasswordupdated(),
            $keys[5] => $this->getLevelid(),
            $keys[6] => $this->getLastlogin(),
            $keys[7] => $this->getTimezone(),
            $keys[8] => $this->getName(),
            $keys[9] => $this->getSurname(),
            $keys[10] => $this->getMailaddress(),
            $keys[11] => $this->getMailaddressalt(),
            $keys[12] => $this->getRecoveryhash(),
            $keys[13] => $this->getRecoveryhashcreatedon(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aAffiliateLevel) {
                $result['AffiliateLevel'] = $this->aAffiliateLevel->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAffiliateRelatedByAffiliateid) {
                $result['AffiliateRelatedByAffiliateid'] = $this->aAffiliateRelatedByAffiliateid->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAffiliatesRelatedByOwnerid) {
                $result['AffiliatesRelatedByOwnerid'] = $this->collAffiliatesRelatedByOwnerid->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
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
        $pos = AffiliateUserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setAffiliateid($value);
                break;
            case 2:
                $this->setUsername($value);
                break;
            case 3:
                $this->setPassword($value);
                break;
            case 4:
                $this->setPasswordupdated($value);
                break;
            case 5:
                $this->setLevelid($value);
                break;
            case 6:
                $this->setLastlogin($value);
                break;
            case 7:
                $this->setTimezone($value);
                break;
            case 8:
                $this->setName($value);
                break;
            case 9:
                $this->setSurname($value);
                break;
            case 10:
                $this->setMailaddress($value);
                break;
            case 11:
                $this->setMailaddressalt($value);
                break;
            case 12:
                $this->setRecoveryhash($value);
                break;
            case 13:
                $this->setRecoveryhashcreatedon($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
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
        $keys = AffiliateUserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setAffiliateid($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUsername($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPasswordupdated($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setLevelid($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setLastlogin($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setTimezone($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setName($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setSurname($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setMailaddress($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setMailaddressalt($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setRecoveryhash($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setRecoveryhashcreatedon($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AffiliateUserPeer::DATABASE_NAME);

        if ($this->isColumnModified(AffiliateUserPeer::ID)) $criteria->add(AffiliateUserPeer::ID, $this->id);
        if ($this->isColumnModified(AffiliateUserPeer::AFFILIATEID)) $criteria->add(AffiliateUserPeer::AFFILIATEID, $this->affiliateid);
        if ($this->isColumnModified(AffiliateUserPeer::USERNAME)) $criteria->add(AffiliateUserPeer::USERNAME, $this->username);
        if ($this->isColumnModified(AffiliateUserPeer::PASSWORD)) $criteria->add(AffiliateUserPeer::PASSWORD, $this->password);
        if ($this->isColumnModified(AffiliateUserPeer::PASSWORDUPDATED)) $criteria->add(AffiliateUserPeer::PASSWORDUPDATED, $this->passwordupdated);
        if ($this->isColumnModified(AffiliateUserPeer::LEVELID)) $criteria->add(AffiliateUserPeer::LEVELID, $this->levelid);
        if ($this->isColumnModified(AffiliateUserPeer::LASTLOGIN)) $criteria->add(AffiliateUserPeer::LASTLOGIN, $this->lastlogin);
        if ($this->isColumnModified(AffiliateUserPeer::TIMEZONE)) $criteria->add(AffiliateUserPeer::TIMEZONE, $this->timezone);
        if ($this->isColumnModified(AffiliateUserPeer::NAME)) $criteria->add(AffiliateUserPeer::NAME, $this->name);
        if ($this->isColumnModified(AffiliateUserPeer::SURNAME)) $criteria->add(AffiliateUserPeer::SURNAME, $this->surname);
        if ($this->isColumnModified(AffiliateUserPeer::MAILADDRESS)) $criteria->add(AffiliateUserPeer::MAILADDRESS, $this->mailaddress);
        if ($this->isColumnModified(AffiliateUserPeer::MAILADDRESSALT)) $criteria->add(AffiliateUserPeer::MAILADDRESSALT, $this->mailaddressalt);
        if ($this->isColumnModified(AffiliateUserPeer::RECOVERYHASH)) $criteria->add(AffiliateUserPeer::RECOVERYHASH, $this->recoveryhash);
        if ($this->isColumnModified(AffiliateUserPeer::RECOVERYHASHCREATEDON)) $criteria->add(AffiliateUserPeer::RECOVERYHASHCREATEDON, $this->recoveryhashcreatedon);
        if ($this->isColumnModified(AffiliateUserPeer::CREATED_AT)) $criteria->add(AffiliateUserPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(AffiliateUserPeer::UPDATED_AT)) $criteria->add(AffiliateUserPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(AffiliateUserPeer::DATABASE_NAME);
        $criteria->add(AffiliateUserPeer::ID, $this->id);

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
     * @param object $copyObj An object of AffiliateUser (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAffiliateid($this->getAffiliateid());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setPasswordupdated($this->getPasswordupdated());
        $copyObj->setLevelid($this->getLevelid());
        $copyObj->setLastlogin($this->getLastlogin());
        $copyObj->setTimezone($this->getTimezone());
        $copyObj->setName($this->getName());
        $copyObj->setSurname($this->getSurname());
        $copyObj->setMailaddress($this->getMailaddress());
        $copyObj->setMailaddressalt($this->getMailaddressalt());
        $copyObj->setRecoveryhash($this->getRecoveryhash());
        $copyObj->setRecoveryhashcreatedon($this->getRecoveryhashcreatedon());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getAffiliatesRelatedByOwnerid() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAffiliateRelatedByOwnerid($relObj->copy($deepCopy));
                }
            }

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
     * @return AffiliateUser Clone of current object.
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
     * @return AffiliateUserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new AffiliateUserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a AffiliateLevel object.
     *
     * @param             AffiliateLevel $v
     * @return AffiliateUser The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAffiliateLevel(AffiliateLevel $v = null)
    {
        if ($v === null) {
            $this->setLevelid(NULL);
        } else {
            $this->setLevelid($v->getId());
        }

        $this->aAffiliateLevel = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the AffiliateLevel object, it will not be re-added.
        if ($v !== null) {
            $v->addAffiliateUser($this);
        }


        return $this;
    }


    /**
     * Get the associated AffiliateLevel object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return AffiliateLevel The associated AffiliateLevel object.
     * @throws PropelException
     */
    public function getAffiliateLevel(PropelPDO $con = null)
    {
        if ($this->aAffiliateLevel === null && ($this->levelid !== null)) {
            $this->aAffiliateLevel = AffiliateLevelQuery::create()->findPk($this->levelid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAffiliateLevel->addAffiliateUsers($this);
             */
        }

        return $this->aAffiliateLevel;
    }

    /**
     * Declares an association between this object and a Affiliate object.
     *
     * @param             Affiliate $v
     * @return AffiliateUser The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAffiliateRelatedByAffiliateid(Affiliate $v = null)
    {
        if ($v === null) {
            $this->setAffiliateid(NULL);
        } else {
            $this->setAffiliateid($v->getId());
        }

        $this->aAffiliateRelatedByAffiliateid = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Affiliate object, it will not be re-added.
        if ($v !== null) {
            $v->addAffiliateUserRelatedByAffiliateid($this);
        }


        return $this;
    }


    /**
     * Get the associated Affiliate object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return Affiliate The associated Affiliate object.
     * @throws PropelException
     */
    public function getAffiliateRelatedByAffiliateid(PropelPDO $con = null)
    {
        if ($this->aAffiliateRelatedByAffiliateid === null && ($this->affiliateid !== null)) {
            $this->aAffiliateRelatedByAffiliateid = AffiliateQuery::create()->findPk($this->affiliateid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAffiliateRelatedByAffiliateid->addAffiliateUsersRelatedByAffiliateid($this);
             */
        }

        return $this->aAffiliateRelatedByAffiliateid;
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
        if ('AffiliateRelatedByOwnerid' == $relationName) {
            $this->initAffiliatesRelatedByOwnerid();
        }
        if ('AffiliateUserGroup' == $relationName) {
            $this->initAffiliateUserGroups();
        }
    }

    /**
     * Clears out the collAffiliatesRelatedByOwnerid collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAffiliatesRelatedByOwnerid()
     */
    public function clearAffiliatesRelatedByOwnerid()
    {
        $this->collAffiliatesRelatedByOwnerid = null; // important to set this to null since that means it is uninitialized
        $this->collAffiliatesRelatedByOwneridPartial = null;
    }

    /**
     * reset is the collAffiliatesRelatedByOwnerid collection loaded partially
     *
     * @return void
     */
    public function resetPartialAffiliatesRelatedByOwnerid($v = true)
    {
        $this->collAffiliatesRelatedByOwneridPartial = $v;
    }

    /**
     * Initializes the collAffiliatesRelatedByOwnerid collection.
     *
     * By default this just sets the collAffiliatesRelatedByOwnerid collection to an empty array (like clearcollAffiliatesRelatedByOwnerid());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAffiliatesRelatedByOwnerid($overrideExisting = true)
    {
        if (null !== $this->collAffiliatesRelatedByOwnerid && !$overrideExisting) {
            return;
        }
        $this->collAffiliatesRelatedByOwnerid = new PropelObjectCollection();
        $this->collAffiliatesRelatedByOwnerid->setModel('Affiliate');
    }

    /**
     * Gets an array of Affiliate objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AffiliateUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Affiliate[] List of Affiliate objects
     * @throws PropelException
     */
    public function getAffiliatesRelatedByOwnerid($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAffiliatesRelatedByOwneridPartial && !$this->isNew();
        if (null === $this->collAffiliatesRelatedByOwnerid || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAffiliatesRelatedByOwnerid) {
                // return empty collection
                $this->initAffiliatesRelatedByOwnerid();
            } else {
                $collAffiliatesRelatedByOwnerid = AffiliateQuery::create(null, $criteria)
                    ->filterByAffiliateUserRelatedByOwnerid($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAffiliatesRelatedByOwneridPartial && count($collAffiliatesRelatedByOwnerid)) {
                      $this->initAffiliatesRelatedByOwnerid(false);

                      foreach($collAffiliatesRelatedByOwnerid as $obj) {
                        if (false == $this->collAffiliatesRelatedByOwnerid->contains($obj)) {
                          $this->collAffiliatesRelatedByOwnerid->append($obj);
                        }
                      }

                      $this->collAffiliatesRelatedByOwneridPartial = true;
                    }

                    return $collAffiliatesRelatedByOwnerid;
                }

                if($partial && $this->collAffiliatesRelatedByOwnerid) {
                    foreach($this->collAffiliatesRelatedByOwnerid as $obj) {
                        if($obj->isNew()) {
                            $collAffiliatesRelatedByOwnerid[] = $obj;
                        }
                    }
                }

                $this->collAffiliatesRelatedByOwnerid = $collAffiliatesRelatedByOwnerid;
                $this->collAffiliatesRelatedByOwneridPartial = false;
            }
        }

        return $this->collAffiliatesRelatedByOwnerid;
    }

    /**
     * Sets a collection of AffiliateRelatedByOwnerid objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $affiliatesRelatedByOwnerid A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAffiliatesRelatedByOwnerid(PropelCollection $affiliatesRelatedByOwnerid, PropelPDO $con = null)
    {
        $this->affiliatesRelatedByOwneridScheduledForDeletion = $this->getAffiliatesRelatedByOwnerid(new Criteria(), $con)->diff($affiliatesRelatedByOwnerid);

        foreach ($this->affiliatesRelatedByOwneridScheduledForDeletion as $affiliateRelatedByOwneridRemoved) {
            $affiliateRelatedByOwneridRemoved->setAffiliateUserRelatedByOwnerid(null);
        }

        $this->collAffiliatesRelatedByOwnerid = null;
        foreach ($affiliatesRelatedByOwnerid as $affiliateRelatedByOwnerid) {
            $this->addAffiliateRelatedByOwnerid($affiliateRelatedByOwnerid);
        }

        $this->collAffiliatesRelatedByOwnerid = $affiliatesRelatedByOwnerid;
        $this->collAffiliatesRelatedByOwneridPartial = false;
    }

    /**
     * Returns the number of related Affiliate objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Affiliate objects.
     * @throws PropelException
     */
    public function countAffiliatesRelatedByOwnerid(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAffiliatesRelatedByOwneridPartial && !$this->isNew();
        if (null === $this->collAffiliatesRelatedByOwnerid || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAffiliatesRelatedByOwnerid) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getAffiliatesRelatedByOwnerid());
                }
                $query = AffiliateQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliateUserRelatedByOwnerid($this)
                    ->count($con);
            }
        } else {
            return count($this->collAffiliatesRelatedByOwnerid);
        }
    }

    /**
     * Method called to associate a BaseAffiliate object to this object
     * through the BaseAffiliate foreign key attribute.
     *
     * @param    BaseAffiliate $l BaseAffiliate
     * @return AffiliateUser The current object (for fluent API support)
     */
    public function addAffiliateRelatedByOwnerid(BaseAffiliate $l)
    {
        if ($this->collAffiliatesRelatedByOwnerid === null) {
            $this->initAffiliatesRelatedByOwnerid();
            $this->collAffiliatesRelatedByOwneridPartial = true;
        }
        if (!$this->collAffiliatesRelatedByOwnerid->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddAffiliateRelatedByOwnerid($l);
        }

        return $this;
    }

    /**
     * @param	AffiliateRelatedByOwnerid $affiliateRelatedByOwnerid The affiliateRelatedByOwnerid object to add.
     */
    protected function doAddAffiliateRelatedByOwnerid($affiliateRelatedByOwnerid)
    {
        $this->collAffiliatesRelatedByOwnerid[]= $affiliateRelatedByOwnerid;
        $affiliateRelatedByOwnerid->setAffiliateUserRelatedByOwnerid($this);
    }

    /**
     * @param	AffiliateRelatedByOwnerid $affiliateRelatedByOwnerid The affiliateRelatedByOwnerid object to remove.
     */
    public function removeAffiliateRelatedByOwnerid($affiliateRelatedByOwnerid)
    {
        if ($this->getAffiliatesRelatedByOwnerid()->contains($affiliateRelatedByOwnerid)) {
            $this->collAffiliatesRelatedByOwnerid->remove($this->collAffiliatesRelatedByOwnerid->search($affiliateRelatedByOwnerid));
            if (null === $this->affiliatesRelatedByOwneridScheduledForDeletion) {
                $this->affiliatesRelatedByOwneridScheduledForDeletion = clone $this->collAffiliatesRelatedByOwnerid;
                $this->affiliatesRelatedByOwneridScheduledForDeletion->clear();
            }
            $this->affiliatesRelatedByOwneridScheduledForDeletion[]= $affiliateRelatedByOwnerid;
            $affiliateRelatedByOwnerid->setAffiliateUserRelatedByOwnerid(null);
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
     * If this AffiliateUser is new, it will return
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
                    ->filterByAffiliateUser($this)
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
            $affiliateUserGroupRemoved->setAffiliateUser(null);
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
                    ->filterByAffiliateUser($this)
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
     * @return AffiliateUser The current object (for fluent API support)
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
        $affiliateUserGroup->setAffiliateUser($this);
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
            $affiliateUserGroup->setAffiliateUser(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this AffiliateUser is new, it will return
     * an empty collection; or if this AffiliateUser has previously
     * been saved, it will retrieve related AffiliateUserGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in AffiliateUser.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AffiliateUserGroup[] List of AffiliateUserGroup objects
     */
    public function getAffiliateUserGroupsJoinAffiliateGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AffiliateUserGroupQuery::create(null, $criteria);
        $query->joinWith('AffiliateGroup', $join_behavior);

        return $this->getAffiliateUserGroups($query, $con);
    }

    /**
     * Clears out the collAffiliateGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAffiliateGroups()
     */
    public function clearAffiliateGroups()
    {
        $this->collAffiliateGroups = null; // important to set this to null since that means it is uninitialized
        $this->collAffiliateGroupsPartial = null;
    }

    /**
     * Initializes the collAffiliateGroups collection.
     *
     * By default this just sets the collAffiliateGroups collection to an empty collection (like clearAffiliateGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initAffiliateGroups()
    {
        $this->collAffiliateGroups = new PropelObjectCollection();
        $this->collAffiliateGroups->setModel('AffiliateGroup');
    }

    /**
     * Gets a collection of AffiliateGroup objects related by a many-to-many relationship
     * to the current object by way of the affiliates_userGroup cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AffiliateUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|AffiliateGroup[] List of AffiliateGroup objects
     */
    public function getAffiliateGroups($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collAffiliateGroups || null !== $criteria) {
            if ($this->isNew() && null === $this->collAffiliateGroups) {
                // return empty collection
                $this->initAffiliateGroups();
            } else {
                $collAffiliateGroups = AffiliateGroupQuery::create(null, $criteria)
                    ->filterByAffiliateUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collAffiliateGroups;
                }
                $this->collAffiliateGroups = $collAffiliateGroups;
            }
        }

        return $this->collAffiliateGroups;
    }

    /**
     * Sets a collection of AffiliateGroup objects related by a many-to-many relationship
     * to the current object by way of the affiliates_userGroup cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $affiliateGroups A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setAffiliateGroups(PropelCollection $affiliateGroups, PropelPDO $con = null)
    {
        $this->clearAffiliateGroups();
        $currentAffiliateGroups = $this->getAffiliateGroups();

        $this->affiliateGroupsScheduledForDeletion = $currentAffiliateGroups->diff($affiliateGroups);

        foreach ($affiliateGroups as $affiliateGroup) {
            if (!$currentAffiliateGroups->contains($affiliateGroup)) {
                $this->doAddAffiliateGroup($affiliateGroup);
            }
        }

        $this->collAffiliateGroups = $affiliateGroups;
    }

    /**
     * Gets the number of AffiliateGroup objects related by a many-to-many relationship
     * to the current object by way of the affiliates_userGroup cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related AffiliateGroup objects
     */
    public function countAffiliateGroups($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collAffiliateGroups || null !== $criteria) {
            if ($this->isNew() && null === $this->collAffiliateGroups) {
                return 0;
            } else {
                $query = AffiliateGroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByAffiliateUser($this)
                    ->count($con);
            }
        } else {
            return count($this->collAffiliateGroups);
        }
    }

    /**
     * Associate a AffiliateGroup object to this object
     * through the affiliates_userGroup cross reference table.
     *
     * @param  AffiliateGroup $affiliateGroup The AffiliateUserGroup object to relate
     * @return void
     */
    public function addAffiliateGroup(AffiliateGroup $affiliateGroup)
    {
        if ($this->collAffiliateGroups === null) {
            $this->initAffiliateGroups();
        }
        if (!$this->collAffiliateGroups->contains($affiliateGroup)) { // only add it if the **same** object is not already associated
            $this->doAddAffiliateGroup($affiliateGroup);

            $this->collAffiliateGroups[]= $affiliateGroup;
        }
    }

    /**
     * @param	AffiliateGroup $affiliateGroup The affiliateGroup object to add.
     */
    protected function doAddAffiliateGroup($affiliateGroup)
    {
        $affiliateUserGroup = new AffiliateUserGroup();
        $affiliateUserGroup->setAffiliateGroup($affiliateGroup);
        $this->addAffiliateUserGroup($affiliateUserGroup);
    }

    /**
     * Remove a AffiliateGroup object to this object
     * through the affiliates_userGroup cross reference table.
     *
     * @param AffiliateGroup $affiliateGroup The AffiliateUserGroup object to relate
     * @return void
     */
    public function removeAffiliateGroup(AffiliateGroup $affiliateGroup)
    {
        if ($this->getAffiliateGroups()->contains($affiliateGroup)) {
            $this->collAffiliateGroups->remove($this->collAffiliateGroups->search($affiliateGroup));
            if (null === $this->affiliateGroupsScheduledForDeletion) {
                $this->affiliateGroupsScheduledForDeletion = clone $this->collAffiliateGroups;
                $this->affiliateGroupsScheduledForDeletion->clear();
            }
            $this->affiliateGroupsScheduledForDeletion[]= $affiliateGroup;
        }
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->affiliateid = null;
        $this->username = null;
        $this->password = null;
        $this->passwordupdated = null;
        $this->levelid = null;
        $this->lastlogin = null;
        $this->timezone = null;
        $this->name = null;
        $this->surname = null;
        $this->mailaddress = null;
        $this->mailaddressalt = null;
        $this->recoveryhash = null;
        $this->recoveryhashcreatedon = null;
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
            if ($this->collAffiliatesRelatedByOwnerid) {
                foreach ($this->collAffiliatesRelatedByOwnerid as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAffiliateUserGroups) {
                foreach ($this->collAffiliateUserGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAffiliateGroups) {
                foreach ($this->collAffiliateGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collAffiliatesRelatedByOwnerid instanceof PropelCollection) {
            $this->collAffiliatesRelatedByOwnerid->clearIterator();
        }
        $this->collAffiliatesRelatedByOwnerid = null;
        if ($this->collAffiliateUserGroups instanceof PropelCollection) {
            $this->collAffiliateUserGroups->clearIterator();
        }
        $this->collAffiliateUserGroups = null;
        if ($this->collAffiliateGroups instanceof PropelCollection) {
            $this->collAffiliateGroups->clearIterator();
        }
        $this->collAffiliateGroups = null;
        $this->aAffiliateLevel = null;
        $this->aAffiliateRelatedByAffiliateid = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string The value of the 'username' column
     */
    public function __toString()
    {
        return (string) $this->getUsername();
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
     * @return     AffiliateUser The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = AffiliateUserPeer::UPDATED_AT;

        return $this;
    }

}
