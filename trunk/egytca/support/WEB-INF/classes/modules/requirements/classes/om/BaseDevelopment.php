<?php


/**
 * Base class that represents a row from the 'requirements_development' table.
 *
 * Desarrollo
 *
 * @package    propel.generator.requirements.classes.om
 */
abstract class BaseDevelopment extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'DevelopmentPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        DevelopmentPeer
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
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the output field.
     * @var        string
     */
    protected $output;

    /**
     * The value for the input field.
     * @var        string
     */
    protected $input;

    /**
     * The value for the process field.
     * @var        string
     */
    protected $process;

    /**
     * The value for the other field.
     * @var        string
     */
    protected $other;

    /**
     * The value for the estimateddelivery field.
     * @var        string
     */
    protected $estimateddelivery;

    /**
     * The value for the realdelivery field.
     * @var        string
     */
    protected $realdelivery;

    /**
     * The value for the delivered field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $delivered;

    /**
     * The value for the clientid field.
     * @var        int
     */
    protected $clientid;

    /**
     * The value for the estimatedhours field.
     * @var        double
     */
    protected $estimatedhours;

    /**
     * The value for the estimatedcost field.
     * @var        double
     */
    protected $estimatedcost;

    /**
     * The value for the realhours field.
     * @var        double
     */
    protected $realhours;

    /**
     * The value for the realcost field.
     * @var        double
     */
    protected $realcost;

    /**
     * The value for the quotation field.
     * @var        double
     */
    protected $quotation;

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
     * @var        Affiliate
     */
    protected $aAffiliate;

    /**
     * @var        PropelObjectCollection|Requirement[] Collection to store aggregation of Requirement objects.
     */
    protected $collRequirements;
    protected $collRequirementsPartial;

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
    protected $requirementsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->delivered = false;
    }

    /**
     * Initializes internal state of BaseDevelopment object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     * Development Id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [name] column value.
     * Headline
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [description] column value.
     * Descripcion del proceso
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [output] column value.
     * Descripcion del resultado
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Get the [input] column value.
     * Descripcion del ingreso de datos
     * @return string
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Get the [process] column value.
     * Descripcion del ingreso de datos
     * @return string
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * Get the [other] column value.
     * Otras informaciones
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Get the [optionally formatted] temporal [estimateddelivery] column value.
     * Fecha estimada de entrega
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getEstimateddelivery($format = 'Y-m-d H:i:s')
    {
        if ($this->estimateddelivery === null) {
            return null;
        }

        if ($this->estimateddelivery === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->estimateddelivery);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->estimateddelivery, true), $x);
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
     * Get the [optionally formatted] temporal [realdelivery] column value.
     * Fecha de Entrega
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRealdelivery($format = 'Y-m-d H:i:s')
    {
        if ($this->realdelivery === null) {
            return null;
        }

        if ($this->realdelivery === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->realdelivery);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->realdelivery, true), $x);
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
     * Get the [delivered] column value.
     * entregada
     * @return boolean
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * Get the [clientid] column value.
     * Id del cliente
     * @return int
     */
    public function getClientid()
    {
        return $this->clientid;
    }

    /**
     * Get the [estimatedhours] column value.
     * Estimacion de horas
     * @return double
     */
    public function getEstimatedhours()
    {
        return $this->estimatedhours;
    }

    /**
     * Get the [estimatedcost] column value.
     * Estimacion de costos
     * @return double
     */
    public function getEstimatedcost()
    {
        return $this->estimatedcost;
    }

    /**
     * Get the [realhours] column value.
     * Horas insumidas realmente
     * @return double
     */
    public function getRealhours()
    {
        return $this->realhours;
    }

    /**
     * Get the [realcost] column value.
     * Costos reales
     * @return double
     */
    public function getRealcost()
    {
        return $this->realcost;
    }

    /**
     * Get the [quotation] column value.
     * Cotizacion
     * @return double
     */
    public function getQuotation()
    {
        return $this->quotation;
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
     * Development Id
     * @param int $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = DevelopmentPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     * Headline
     * @param string $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = DevelopmentPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [description] column.
     * Descripcion del proceso
     * @param string $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = DevelopmentPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [output] column.
     * Descripcion del resultado
     * @param string $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setOutput($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->output !== $v) {
            $this->output = $v;
            $this->modifiedColumns[] = DevelopmentPeer::OUTPUT;
        }


        return $this;
    } // setOutput()

    /**
     * Set the value of [input] column.
     * Descripcion del ingreso de datos
     * @param string $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setInput($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->input !== $v) {
            $this->input = $v;
            $this->modifiedColumns[] = DevelopmentPeer::INPUT;
        }


        return $this;
    } // setInput()

    /**
     * Set the value of [process] column.
     * Descripcion del ingreso de datos
     * @param string $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setProcess($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->process !== $v) {
            $this->process = $v;
            $this->modifiedColumns[] = DevelopmentPeer::PROCESS;
        }


        return $this;
    } // setProcess()

    /**
     * Set the value of [other] column.
     * Otras informaciones
     * @param string $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setOther($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->other !== $v) {
            $this->other = $v;
            $this->modifiedColumns[] = DevelopmentPeer::OTHER;
        }


        return $this;
    } // setOther()

    /**
     * Sets the value of [estimateddelivery] column to a normalized version of the date/time value specified.
     * Fecha estimada de entrega
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Development The current object (for fluent API support)
     */
    public function setEstimateddelivery($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->estimateddelivery !== null || $dt !== null) {
            $currentDateAsString = ($this->estimateddelivery !== null && $tmpDt = new DateTime($this->estimateddelivery)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->estimateddelivery = $newDateAsString;
                $this->modifiedColumns[] = DevelopmentPeer::ESTIMATEDDELIVERY;
            }
        } // if either are not null


        return $this;
    } // setEstimateddelivery()

    /**
     * Sets the value of [realdelivery] column to a normalized version of the date/time value specified.
     * Fecha de Entrega
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Development The current object (for fluent API support)
     */
    public function setRealdelivery($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->realdelivery !== null || $dt !== null) {
            $currentDateAsString = ($this->realdelivery !== null && $tmpDt = new DateTime($this->realdelivery)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->realdelivery = $newDateAsString;
                $this->modifiedColumns[] = DevelopmentPeer::REALDELIVERY;
            }
        } // if either are not null


        return $this;
    } // setRealdelivery()

    /**
     * Sets the value of the [delivered] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * entregada
     * @param boolean|integer|string $v The new value
     * @return Development The current object (for fluent API support)
     */
    public function setDelivered($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->delivered !== $v) {
            $this->delivered = $v;
            $this->modifiedColumns[] = DevelopmentPeer::DELIVERED;
        }


        return $this;
    } // setDelivered()

    /**
     * Set the value of [clientid] column.
     * Id del cliente
     * @param int $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setClientid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->clientid !== $v) {
            $this->clientid = $v;
            $this->modifiedColumns[] = DevelopmentPeer::CLIENTID;
        }

        if ($this->aAffiliate !== null && $this->aAffiliate->getId() !== $v) {
            $this->aAffiliate = null;
        }


        return $this;
    } // setClientid()

    /**
     * Set the value of [estimatedhours] column.
     * Estimacion de horas
     * @param double $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setEstimatedhours($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->estimatedhours !== $v) {
            $this->estimatedhours = $v;
            $this->modifiedColumns[] = DevelopmentPeer::ESTIMATEDHOURS;
        }


        return $this;
    } // setEstimatedhours()

    /**
     * Set the value of [estimatedcost] column.
     * Estimacion de costos
     * @param double $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setEstimatedcost($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->estimatedcost !== $v) {
            $this->estimatedcost = $v;
            $this->modifiedColumns[] = DevelopmentPeer::ESTIMATEDCOST;
        }


        return $this;
    } // setEstimatedcost()

    /**
     * Set the value of [realhours] column.
     * Horas insumidas realmente
     * @param double $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setRealhours($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->realhours !== $v) {
            $this->realhours = $v;
            $this->modifiedColumns[] = DevelopmentPeer::REALHOURS;
        }


        return $this;
    } // setRealhours()

    /**
     * Set the value of [realcost] column.
     * Costos reales
     * @param double $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setRealcost($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->realcost !== $v) {
            $this->realcost = $v;
            $this->modifiedColumns[] = DevelopmentPeer::REALCOST;
        }


        return $this;
    } // setRealcost()

    /**
     * Set the value of [quotation] column.
     * Cotizacion
     * @param double $v new value
     * @return Development The current object (for fluent API support)
     */
    public function setQuotation($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->quotation !== $v) {
            $this->quotation = $v;
            $this->modifiedColumns[] = DevelopmentPeer::QUOTATION;
        }


        return $this;
    } // setQuotation()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Development The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = DevelopmentPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Development The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = DevelopmentPeer::UPDATED_AT;
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
            if ($this->delivered !== false) {
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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->description = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->output = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->input = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->process = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->other = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->estimateddelivery = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->realdelivery = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->delivered = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->clientid = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->estimatedhours = ($row[$startcol + 11] !== null) ? (double) $row[$startcol + 11] : null;
            $this->estimatedcost = ($row[$startcol + 12] !== null) ? (double) $row[$startcol + 12] : null;
            $this->realhours = ($row[$startcol + 13] !== null) ? (double) $row[$startcol + 13] : null;
            $this->realcost = ($row[$startcol + 14] !== null) ? (double) $row[$startcol + 14] : null;
            $this->quotation = ($row[$startcol + 15] !== null) ? (double) $row[$startcol + 15] : null;
            $this->created_at = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->updated_at = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 18; // 18 = DevelopmentPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Development object", $e);
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

        if ($this->aAffiliate !== null && $this->clientid !== $this->aAffiliate->getId()) {
            $this->aAffiliate = null;
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
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = DevelopmentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAffiliate = null;
            $this->collRequirements = null;

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
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = DevelopmentQuery::create()
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
            $con = Propel::getConnection(DevelopmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(DevelopmentPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DevelopmentPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DevelopmentPeer::UPDATED_AT)) {
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
                DevelopmentPeer::addInstanceToPool($this);
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

            if ($this->aAffiliate !== null) {
                if ($this->aAffiliate->isModified() || $this->aAffiliate->isNew()) {
                    $affectedRows += $this->aAffiliate->save($con);
                }
                $this->setAffiliate($this->aAffiliate);
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

        $this->modifiedColumns[] = DevelopmentPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DevelopmentPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DevelopmentPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(DevelopmentPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`NAME`';
        }
        if ($this->isColumnModified(DevelopmentPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`DESCRIPTION`';
        }
        if ($this->isColumnModified(DevelopmentPeer::OUTPUT)) {
            $modifiedColumns[':p' . $index++]  = '`OUTPUT`';
        }
        if ($this->isColumnModified(DevelopmentPeer::INPUT)) {
            $modifiedColumns[':p' . $index++]  = '`INPUT`';
        }
        if ($this->isColumnModified(DevelopmentPeer::PROCESS)) {
            $modifiedColumns[':p' . $index++]  = '`PROCESS`';
        }
        if ($this->isColumnModified(DevelopmentPeer::OTHER)) {
            $modifiedColumns[':p' . $index++]  = '`OTHER`';
        }
        if ($this->isColumnModified(DevelopmentPeer::ESTIMATEDDELIVERY)) {
            $modifiedColumns[':p' . $index++]  = '`ESTIMATEDDELIVERY`';
        }
        if ($this->isColumnModified(DevelopmentPeer::REALDELIVERY)) {
            $modifiedColumns[':p' . $index++]  = '`REALDELIVERY`';
        }
        if ($this->isColumnModified(DevelopmentPeer::DELIVERED)) {
            $modifiedColumns[':p' . $index++]  = '`DELIVERED`';
        }
        if ($this->isColumnModified(DevelopmentPeer::CLIENTID)) {
            $modifiedColumns[':p' . $index++]  = '`CLIENTID`';
        }
        if ($this->isColumnModified(DevelopmentPeer::ESTIMATEDHOURS)) {
            $modifiedColumns[':p' . $index++]  = '`ESTIMATEDHOURS`';
        }
        if ($this->isColumnModified(DevelopmentPeer::ESTIMATEDCOST)) {
            $modifiedColumns[':p' . $index++]  = '`ESTIMATEDCOST`';
        }
        if ($this->isColumnModified(DevelopmentPeer::REALHOURS)) {
            $modifiedColumns[':p' . $index++]  = '`REALHOURS`';
        }
        if ($this->isColumnModified(DevelopmentPeer::REALCOST)) {
            $modifiedColumns[':p' . $index++]  = '`REALCOST`';
        }
        if ($this->isColumnModified(DevelopmentPeer::QUOTATION)) {
            $modifiedColumns[':p' . $index++]  = '`QUOTATION`';
        }
        if ($this->isColumnModified(DevelopmentPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
        }
        if ($this->isColumnModified(DevelopmentPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
        }

        $sql = sprintf(
            'INSERT INTO `requirements_development` (%s) VALUES (%s)',
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
                    case '`DESCRIPTION`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`OUTPUT`':
                        $stmt->bindValue($identifier, $this->output, PDO::PARAM_STR);
                        break;
                    case '`INPUT`':
                        $stmt->bindValue($identifier, $this->input, PDO::PARAM_STR);
                        break;
                    case '`PROCESS`':
                        $stmt->bindValue($identifier, $this->process, PDO::PARAM_STR);
                        break;
                    case '`OTHER`':
                        $stmt->bindValue($identifier, $this->other, PDO::PARAM_STR);
                        break;
                    case '`ESTIMATEDDELIVERY`':
                        $stmt->bindValue($identifier, $this->estimateddelivery, PDO::PARAM_STR);
                        break;
                    case '`REALDELIVERY`':
                        $stmt->bindValue($identifier, $this->realdelivery, PDO::PARAM_STR);
                        break;
                    case '`DELIVERED`':
                        $stmt->bindValue($identifier, (int) $this->delivered, PDO::PARAM_INT);
                        break;
                    case '`CLIENTID`':
                        $stmt->bindValue($identifier, $this->clientid, PDO::PARAM_INT);
                        break;
                    case '`ESTIMATEDHOURS`':
                        $stmt->bindValue($identifier, $this->estimatedhours, PDO::PARAM_STR);
                        break;
                    case '`ESTIMATEDCOST`':
                        $stmt->bindValue($identifier, $this->estimatedcost, PDO::PARAM_STR);
                        break;
                    case '`REALHOURS`':
                        $stmt->bindValue($identifier, $this->realhours, PDO::PARAM_STR);
                        break;
                    case '`REALCOST`':
                        $stmt->bindValue($identifier, $this->realcost, PDO::PARAM_STR);
                        break;
                    case '`QUOTATION`':
                        $stmt->bindValue($identifier, $this->quotation, PDO::PARAM_STR);
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

            if ($this->aAffiliate !== null) {
                if (!$this->aAffiliate->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAffiliate->getValidationFailures());
                }
            }


            if (($retval = DevelopmentPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collRequirements !== null) {
                    foreach ($this->collRequirements as $referrerFK) {
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
        $pos = DevelopmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getDescription();
                break;
            case 3:
                return $this->getOutput();
                break;
            case 4:
                return $this->getInput();
                break;
            case 5:
                return $this->getProcess();
                break;
            case 6:
                return $this->getOther();
                break;
            case 7:
                return $this->getEstimateddelivery();
                break;
            case 8:
                return $this->getRealdelivery();
                break;
            case 9:
                return $this->getDelivered();
                break;
            case 10:
                return $this->getClientid();
                break;
            case 11:
                return $this->getEstimatedhours();
                break;
            case 12:
                return $this->getEstimatedcost();
                break;
            case 13:
                return $this->getRealhours();
                break;
            case 14:
                return $this->getRealcost();
                break;
            case 15:
                return $this->getQuotation();
                break;
            case 16:
                return $this->getCreatedAt();
                break;
            case 17:
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
        if (isset($alreadyDumpedObjects['Development'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Development'][$this->getPrimaryKey()] = true;
        $keys = DevelopmentPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getOutput(),
            $keys[4] => $this->getInput(),
            $keys[5] => $this->getProcess(),
            $keys[6] => $this->getOther(),
            $keys[7] => $this->getEstimateddelivery(),
            $keys[8] => $this->getRealdelivery(),
            $keys[9] => $this->getDelivered(),
            $keys[10] => $this->getClientid(),
            $keys[11] => $this->getEstimatedhours(),
            $keys[12] => $this->getEstimatedcost(),
            $keys[13] => $this->getRealhours(),
            $keys[14] => $this->getRealcost(),
            $keys[15] => $this->getQuotation(),
            $keys[16] => $this->getCreatedAt(),
            $keys[17] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aAffiliate) {
                $result['Affiliate'] = $this->aAffiliate->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collRequirements) {
                $result['Requirements'] = $this->collRequirements->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = DevelopmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setDescription($value);
                break;
            case 3:
                $this->setOutput($value);
                break;
            case 4:
                $this->setInput($value);
                break;
            case 5:
                $this->setProcess($value);
                break;
            case 6:
                $this->setOther($value);
                break;
            case 7:
                $this->setEstimateddelivery($value);
                break;
            case 8:
                $this->setRealdelivery($value);
                break;
            case 9:
                $this->setDelivered($value);
                break;
            case 10:
                $this->setClientid($value);
                break;
            case 11:
                $this->setEstimatedhours($value);
                break;
            case 12:
                $this->setEstimatedcost($value);
                break;
            case 13:
                $this->setRealhours($value);
                break;
            case 14:
                $this->setRealcost($value);
                break;
            case 15:
                $this->setQuotation($value);
                break;
            case 16:
                $this->setCreatedAt($value);
                break;
            case 17:
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
        $keys = DevelopmentPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setOutput($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setInput($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setProcess($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setOther($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setEstimateddelivery($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setRealdelivery($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setDelivered($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setClientid($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setEstimatedhours($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setEstimatedcost($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setRealhours($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setRealcost($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setQuotation($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DevelopmentPeer::DATABASE_NAME);

        if ($this->isColumnModified(DevelopmentPeer::ID)) $criteria->add(DevelopmentPeer::ID, $this->id);
        if ($this->isColumnModified(DevelopmentPeer::NAME)) $criteria->add(DevelopmentPeer::NAME, $this->name);
        if ($this->isColumnModified(DevelopmentPeer::DESCRIPTION)) $criteria->add(DevelopmentPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(DevelopmentPeer::OUTPUT)) $criteria->add(DevelopmentPeer::OUTPUT, $this->output);
        if ($this->isColumnModified(DevelopmentPeer::INPUT)) $criteria->add(DevelopmentPeer::INPUT, $this->input);
        if ($this->isColumnModified(DevelopmentPeer::PROCESS)) $criteria->add(DevelopmentPeer::PROCESS, $this->process);
        if ($this->isColumnModified(DevelopmentPeer::OTHER)) $criteria->add(DevelopmentPeer::OTHER, $this->other);
        if ($this->isColumnModified(DevelopmentPeer::ESTIMATEDDELIVERY)) $criteria->add(DevelopmentPeer::ESTIMATEDDELIVERY, $this->estimateddelivery);
        if ($this->isColumnModified(DevelopmentPeer::REALDELIVERY)) $criteria->add(DevelopmentPeer::REALDELIVERY, $this->realdelivery);
        if ($this->isColumnModified(DevelopmentPeer::DELIVERED)) $criteria->add(DevelopmentPeer::DELIVERED, $this->delivered);
        if ($this->isColumnModified(DevelopmentPeer::CLIENTID)) $criteria->add(DevelopmentPeer::CLIENTID, $this->clientid);
        if ($this->isColumnModified(DevelopmentPeer::ESTIMATEDHOURS)) $criteria->add(DevelopmentPeer::ESTIMATEDHOURS, $this->estimatedhours);
        if ($this->isColumnModified(DevelopmentPeer::ESTIMATEDCOST)) $criteria->add(DevelopmentPeer::ESTIMATEDCOST, $this->estimatedcost);
        if ($this->isColumnModified(DevelopmentPeer::REALHOURS)) $criteria->add(DevelopmentPeer::REALHOURS, $this->realhours);
        if ($this->isColumnModified(DevelopmentPeer::REALCOST)) $criteria->add(DevelopmentPeer::REALCOST, $this->realcost);
        if ($this->isColumnModified(DevelopmentPeer::QUOTATION)) $criteria->add(DevelopmentPeer::QUOTATION, $this->quotation);
        if ($this->isColumnModified(DevelopmentPeer::CREATED_AT)) $criteria->add(DevelopmentPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(DevelopmentPeer::UPDATED_AT)) $criteria->add(DevelopmentPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(DevelopmentPeer::DATABASE_NAME);
        $criteria->add(DevelopmentPeer::ID, $this->id);

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
     * @param object $copyObj An object of Development (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setOutput($this->getOutput());
        $copyObj->setInput($this->getInput());
        $copyObj->setProcess($this->getProcess());
        $copyObj->setOther($this->getOther());
        $copyObj->setEstimateddelivery($this->getEstimateddelivery());
        $copyObj->setRealdelivery($this->getRealdelivery());
        $copyObj->setDelivered($this->getDelivered());
        $copyObj->setClientid($this->getClientid());
        $copyObj->setEstimatedhours($this->getEstimatedhours());
        $copyObj->setEstimatedcost($this->getEstimatedcost());
        $copyObj->setRealhours($this->getRealhours());
        $copyObj->setRealcost($this->getRealcost());
        $copyObj->setQuotation($this->getQuotation());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getRequirements() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRequirement($relObj->copy($deepCopy));
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
     * @return Development Clone of current object.
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
     * @return DevelopmentPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new DevelopmentPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Affiliate object.
     *
     * @param             Affiliate $v
     * @return Development The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAffiliate(Affiliate $v = null)
    {
        if ($v === null) {
            $this->setClientid(NULL);
        } else {
            $this->setClientid($v->getId());
        }

        $this->aAffiliate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Affiliate object, it will not be re-added.
        if ($v !== null) {
            $v->addDevelopment($this);
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
    public function getAffiliate(PropelPDO $con = null)
    {
        if ($this->aAffiliate === null && ($this->clientid !== null)) {
            $this->aAffiliate = AffiliateQuery::create()->findPk($this->clientid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAffiliate->addDevelopments($this);
             */
        }

        return $this->aAffiliate;
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
        if ('Requirement' == $relationName) {
            $this->initRequirements();
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
     * If this Development is new, it will return
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
                    ->filterByDevelopment($this)
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
            $requirementRemoved->setDevelopment(null);
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
                    ->filterByDevelopment($this)
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
     * @return Development The current object (for fluent API support)
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
        $requirement->setDevelopment($this);
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
            $requirement->setDevelopment(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Development is new, it will return
     * an empty collection; or if this Development has previously
     * been saved, it will retrieve related Requirements from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Development.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Requirement[] List of Requirement objects
     */
    public function getRequirementsJoinAffiliate($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RequirementQuery::create(null, $criteria);
        $query->joinWith('Affiliate', $join_behavior);

        return $this->getRequirements($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->output = null;
        $this->input = null;
        $this->process = null;
        $this->other = null;
        $this->estimateddelivery = null;
        $this->realdelivery = null;
        $this->delivered = null;
        $this->clientid = null;
        $this->estimatedhours = null;
        $this->estimatedcost = null;
        $this->realhours = null;
        $this->realcost = null;
        $this->quotation = null;
        $this->created_at = null;
        $this->updated_at = null;
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
            if ($this->collRequirements) {
                foreach ($this->collRequirements as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collRequirements instanceof PropelCollection) {
            $this->collRequirements->clearIterator();
        }
        $this->collRequirements = null;
        $this->aAffiliate = null;
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
     * @return     Development The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = DevelopmentPeer::UPDATED_AT;

        return $this;
    }

}
