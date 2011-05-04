<?php


/**
 * Base class that represents a row from the 'modules_entityField' table.
 *
 * Campos de las entidades de modulos
 *
 * @package    propel.generator.modules.classes.om
 */
abstract class BaseModuleEntityField extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ModuleEntityFieldPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ModuleEntityFieldPeer
	 */
	protected static $peer;

	/**
	 * The value for the uniquename field.
	 * @var        string
	 */
	protected $uniquename;

	/**
	 * The value for the entityname field.
	 * @var        string
	 */
	protected $entityname;

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
	 * The value for the isrequired field.
	 * @var        boolean
	 */
	protected $isrequired;

	/**
	 * The value for the defaultvalue field.
	 * @var        string
	 */
	protected $defaultvalue;

	/**
	 * The value for the isprimarykey field.
	 * @var        boolean
	 */
	protected $isprimarykey;

	/**
	 * The value for the isautoincrement field.
	 * @var        boolean
	 */
	protected $isautoincrement;

	/**
	 * The value for the order field.
	 * @var        int
	 */
	protected $order;

	/**
	 * The value for the type field.
	 * @var        int
	 */
	protected $type;

	/**
	 * The value for the unique field.
	 * @var        boolean
	 */
	protected $unique;

	/**
	 * The value for the size field.
	 * @var        int
	 */
	protected $size;

	/**
	 * The value for the aggregateexpression field.
	 * @var        string
	 */
	protected $aggregateexpression;

	/**
	 * The value for the label field.
	 * @var        string
	 */
	protected $label;

	/**
	 * The value for the formfieldtype field.
	 * @var        int
	 */
	protected $formfieldtype;

	/**
	 * The value for the formfieldsize field.
	 * @var        int
	 */
	protected $formfieldsize;

	/**
	 * The value for the formfieldlines field.
	 * @var        int
	 */
	protected $formfieldlines;

	/**
	 * The value for the formfieldusecalendar field.
	 * @var        string
	 */
	protected $formfieldusecalendar;

	/**
	 * The value for the foreignkeytable field.
	 * @var        string
	 */
	protected $foreignkeytable;

	/**
	 * The value for the foreignkeyremote field.
	 * @var        string
	 */
	protected $foreignkeyremote;

	/**
	 * The value for the ondelete field.
	 * @var        string
	 */
	protected $ondelete;

	/**
	 * The value for the automatic field.
	 * @var        boolean
	 */
	protected $automatic;

	/**
	 * @var        ModuleEntity
	 */
	protected $aModuleEntityRelatedByEntityname;

	/**
	 * @var        ModuleEntity
	 */
	protected $aModuleEntityRelatedByForeignkeytable;

	/**
	 * @var        ModuleEntityField
	 */
	protected $aModuleEntityFieldRelatedByForeignkeyremote;

	/**
	 * @var        array ModuleEntity[] Collection to store aggregation of ModuleEntity objects.
	 */
	protected $collModuleEntitysRelatedByScopefielduniquename;

	/**
	 * @var        array ModuleEntityField[] Collection to store aggregation of ModuleEntityField objects.
	 */
	protected $collModuleEntityFieldsRelatedByUniquename;

	/**
	 * @var        array ModuleEntityFieldValidation[] Collection to store aggregation of ModuleEntityFieldValidation objects.
	 */
	protected $collModuleEntityFieldValidations;

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
	 * Get the [uniquename] column value.
	 * Nombre unico del campo
	 * @return     string
	 */
	public function getUniquename()
	{
		return $this->uniquename;
	}

	/**
	 * Get the [entityname] column value.
	 * Nombre de la entidad
	 * @return     string
	 */
	public function getEntityname()
	{
		return $this->entityname;
	}

	/**
	 * Get the [name] column value.
	 * Nombre del campo (max 50 caracteres)
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [description] column value.
	 * Descripcion del campo (comment)
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Get the [isrequired] column value.
	 * Indica si es obligatorio
	 * @return     boolean
	 */
	public function getIsrequired()
	{
		return $this->isrequired;
	}

	/**
	 * Get the [defaultvalue] column value.
	 * Valor por defecto
	 * @return     string
	 */
	public function getDefaultvalue()
	{
		return $this->defaultvalue;
	}

	/**
	 * Get the [isprimarykey] column value.
	 * Indica si clave primaria
	 * @return     boolean
	 */
	public function getIsprimarykey()
	{
		return $this->isprimarykey;
	}

	/**
	 * Get the [isautoincrement] column value.
	 * Indica si el campo es autoincremental
	 * @return     boolean
	 */
	public function getIsautoincrement()
	{
		return $this->isautoincrement;
	}

	/**
	 * Get the [order] column value.
	 * Orden
	 * @return     int
	 */
	public function getOrder()
	{
		return $this->order;
	}

	/**
	 * Get the [type] column value.
	 * Tipo de campo
	 * @return     int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get the [unique] column value.
	 * Indica si es unica
	 * @return     boolean
	 */
	public function getUnique()
	{
		return $this->unique;
	}

	/**
	 * Get the [size] column value.
	 * Size del campo
	 * @return     int
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Get the [aggregateexpression] column value.
	 * Detalles de la expresion agregada
	 * @return     string
	 */
	public function getAggregateexpression()
	{
		return $this->aggregateexpression;
	}

	/**
	 * Get the [label] column value.
	 * Etiqueta para el formulario
	 * @return     string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * Get the [formfieldtype] column value.
	 * Tipo de campo para formulario
	 * @return     int
	 */
	public function getFormfieldtype()
	{
		return $this->formfieldtype;
	}

	/**
	 * Get the [formfieldsize] column value.
	 * Size del campo en formulario
	 * @return     int
	 */
	public function getFormfieldsize()
	{
		return $this->formfieldsize;
	}

	/**
	 * Get the [formfieldlines] column value.
	 * Size del campo en formulario lineas
	 * @return     int
	 */
	public function getFormfieldlines()
	{
		return $this->formfieldlines;
	}

	/**
	 * Get the [formfieldusecalendar] column value.
	 * Si utiliza o no el calendario en formulario
	 * @return     string
	 */
	public function getFormfieldusecalendar()
	{
		return $this->formfieldusecalendar;
	}

	/**
	 * Get the [foreignkeytable] column value.
	 * Entidad con la que enlaza la clave remota
	 * @return     string
	 */
	public function getForeignkeytable()
	{
		return $this->foreignkeytable;
	}

	/**
	 * Get the [foreignkeyremote] column value.
	 * Nombre del campo en la tabla remota
	 * @return     string
	 */
	public function getForeignkeyremote()
	{
		return $this->foreignkeyremote;
	}

	/**
	 * Get the [ondelete] column value.
	 * Comportamiento onDelete
	 * @return     string
	 */
	public function getOndelete()
	{
		return $this->ondelete;
	}

	/**
	 * Get the [automatic] column value.
	 * Indica si es una columna autogenerada por un behavior
	 * @return     boolean
	 */
	public function getAutomatic()
	{
		return $this->automatic;
	}

	/**
	 * Set the value of [uniquename] column.
	 * Nombre unico del campo
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setUniquename($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->uniquename !== $v) {
			$this->uniquename = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::UNIQUENAME;
		}

		return $this;
	} // setUniquename()

	/**
	 * Set the value of [entityname] column.
	 * Nombre de la entidad
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setEntityname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->entityname !== $v) {
			$this->entityname = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::ENTITYNAME;
		}

		if ($this->aModuleEntityRelatedByEntityname !== null && $this->aModuleEntityRelatedByEntityname->getName() !== $v) {
			$this->aModuleEntityRelatedByEntityname = null;
		}

		return $this;
	} // setEntityname()

	/**
	 * Set the value of [name] column.
	 * Nombre del campo (max 50 caracteres)
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [description] column.
	 * Descripcion del campo (comment)
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

	/**
	 * Sets the value of the [isrequired] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Indica si es obligatorio
	 * @param      boolean|integer|string $v The new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setIsrequired($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->isrequired !== $v) {
			$this->isrequired = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::ISREQUIRED;
		}

		return $this;
	} // setIsrequired()

	/**
	 * Set the value of [defaultvalue] column.
	 * Valor por defecto
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setDefaultvalue($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->defaultvalue !== $v) {
			$this->defaultvalue = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::DEFAULTVALUE;
		}

		return $this;
	} // setDefaultvalue()

	/**
	 * Sets the value of the [isprimarykey] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Indica si clave primaria
	 * @param      boolean|integer|string $v The new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setIsprimarykey($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->isprimarykey !== $v) {
			$this->isprimarykey = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::ISPRIMARYKEY;
		}

		return $this;
	} // setIsprimarykey()

	/**
	 * Sets the value of the [isautoincrement] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Indica si el campo es autoincremental
	 * @param      boolean|integer|string $v The new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setIsautoincrement($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->isautoincrement !== $v) {
			$this->isautoincrement = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::ISAUTOINCREMENT;
		}

		return $this;
	} // setIsautoincrement()

	/**
	 * Set the value of [order] column.
	 * Orden
	 * @param      int $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->order !== $v) {
			$this->order = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::ORDER;
		}

		return $this;
	} // setOrder()

	/**
	 * Set the value of [type] column.
	 * Tipo de campo
	 * @param      int $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::TYPE;
		}

		return $this;
	} // setType()

	/**
	 * Sets the value of the [unique] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Indica si es unica
	 * @param      boolean|integer|string $v The new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setUnique($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->unique !== $v) {
			$this->unique = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::UNIQUE;
		}

		return $this;
	} // setUnique()

	/**
	 * Set the value of [size] column.
	 * Size del campo
	 * @param      int $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setSize($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->size !== $v) {
			$this->size = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::SIZE;
		}

		return $this;
	} // setSize()

	/**
	 * Set the value of [aggregateexpression] column.
	 * Detalles de la expresion agregada
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setAggregateexpression($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->aggregateexpression !== $v) {
			$this->aggregateexpression = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::AGGREGATEEXPRESSION;
		}

		return $this;
	} // setAggregateexpression()

	/**
	 * Set the value of [label] column.
	 * Etiqueta para el formulario
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setLabel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::LABEL;
		}

		return $this;
	} // setLabel()

	/**
	 * Set the value of [formfieldtype] column.
	 * Tipo de campo para formulario
	 * @param      int $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setFormfieldtype($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->formfieldtype !== $v) {
			$this->formfieldtype = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::FORMFIELDTYPE;
		}

		return $this;
	} // setFormfieldtype()

	/**
	 * Set the value of [formfieldsize] column.
	 * Size del campo en formulario
	 * @param      int $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setFormfieldsize($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->formfieldsize !== $v) {
			$this->formfieldsize = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::FORMFIELDSIZE;
		}

		return $this;
	} // setFormfieldsize()

	/**
	 * Set the value of [formfieldlines] column.
	 * Size del campo en formulario lineas
	 * @param      int $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setFormfieldlines($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->formfieldlines !== $v) {
			$this->formfieldlines = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::FORMFIELDLINES;
		}

		return $this;
	} // setFormfieldlines()

	/**
	 * Set the value of [formfieldusecalendar] column.
	 * Si utiliza o no el calendario en formulario
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setFormfieldusecalendar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->formfieldusecalendar !== $v) {
			$this->formfieldusecalendar = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::FORMFIELDUSECALENDAR;
		}

		return $this;
	} // setFormfieldusecalendar()

	/**
	 * Set the value of [foreignkeytable] column.
	 * Entidad con la que enlaza la clave remota
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setForeignkeytable($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->foreignkeytable !== $v) {
			$this->foreignkeytable = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::FOREIGNKEYTABLE;
		}

		if ($this->aModuleEntityRelatedByForeignkeytable !== null && $this->aModuleEntityRelatedByForeignkeytable->getName() !== $v) {
			$this->aModuleEntityRelatedByForeignkeytable = null;
		}

		return $this;
	} // setForeignkeytable()

	/**
	 * Set the value of [foreignkeyremote] column.
	 * Nombre del campo en la tabla remota
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setForeignkeyremote($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->foreignkeyremote !== $v) {
			$this->foreignkeyremote = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::FOREIGNKEYREMOTE;
		}

		if ($this->aModuleEntityFieldRelatedByForeignkeyremote !== null && $this->aModuleEntityFieldRelatedByForeignkeyremote->getUniquename() !== $v) {
			$this->aModuleEntityFieldRelatedByForeignkeyremote = null;
		}

		return $this;
	} // setForeignkeyremote()

	/**
	 * Set the value of [ondelete] column.
	 * Comportamiento onDelete
	 * @param      string $v new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setOndelete($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ondelete !== $v) {
			$this->ondelete = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::ONDELETE;
		}

		return $this;
	} // setOndelete()

	/**
	 * Sets the value of the [automatic] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Indica si es una columna autogenerada por un behavior
	 * @param      boolean|integer|string $v The new value
	 * @return     ModuleEntityField The current object (for fluent API support)
	 */
	public function setAutomatic($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->automatic !== $v) {
			$this->automatic = $v;
			$this->modifiedColumns[] = ModuleEntityFieldPeer::AUTOMATIC;
		}

		return $this;
	} // setAutomatic()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->uniquename = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->entityname = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->description = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->isrequired = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->defaultvalue = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->isprimarykey = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->isautoincrement = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->order = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->type = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->unique = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
			$this->size = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->aggregateexpression = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->label = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->formfieldtype = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->formfieldsize = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->formfieldlines = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->formfieldusecalendar = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->foreignkeytable = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->foreignkeyremote = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ondelete = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->automatic = ($row[$startcol + 21] !== null) ? (boolean) $row[$startcol + 21] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 22; // 22 = ModuleEntityFieldPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating ModuleEntityField object", $e);
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
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aModuleEntityRelatedByEntityname !== null && $this->entityname !== $this->aModuleEntityRelatedByEntityname->getName()) {
			$this->aModuleEntityRelatedByEntityname = null;
		}
		if ($this->aModuleEntityRelatedByForeignkeytable !== null && $this->foreignkeytable !== $this->aModuleEntityRelatedByForeignkeytable->getName()) {
			$this->aModuleEntityRelatedByForeignkeytable = null;
		}
		if ($this->aModuleEntityFieldRelatedByForeignkeyremote !== null && $this->foreignkeyremote !== $this->aModuleEntityFieldRelatedByForeignkeyremote->getUniquename()) {
			$this->aModuleEntityFieldRelatedByForeignkeyremote = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
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
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ModuleEntityFieldPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aModuleEntityRelatedByEntityname = null;
			$this->aModuleEntityRelatedByForeignkeytable = null;
			$this->aModuleEntityFieldRelatedByForeignkeyremote = null;
			$this->collModuleEntitysRelatedByScopefielduniquename = null;

			$this->collModuleEntityFieldsRelatedByUniquename = null;

			$this->collModuleEntityFieldValidations = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				ModuleEntityFieldQuery::create()
					->filterByPrimaryKey($this->getPrimaryKey())
					->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
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
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ModuleEntityFieldPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ModuleEntityFieldPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
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
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
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

			if ($this->aModuleEntityRelatedByEntityname !== null) {
				if ($this->aModuleEntityRelatedByEntityname->isModified() || $this->aModuleEntityRelatedByEntityname->isNew()) {
					$affectedRows += $this->aModuleEntityRelatedByEntityname->save($con);
				}
				$this->setModuleEntityRelatedByEntityname($this->aModuleEntityRelatedByEntityname);
			}

			if ($this->aModuleEntityRelatedByForeignkeytable !== null) {
				if ($this->aModuleEntityRelatedByForeignkeytable->isModified() || $this->aModuleEntityRelatedByForeignkeytable->isNew()) {
					$affectedRows += $this->aModuleEntityRelatedByForeignkeytable->save($con);
				}
				$this->setModuleEntityRelatedByForeignkeytable($this->aModuleEntityRelatedByForeignkeytable);
			}

			if ($this->aModuleEntityFieldRelatedByForeignkeyremote !== null) {
				if ($this->aModuleEntityFieldRelatedByForeignkeyremote->isModified() || $this->aModuleEntityFieldRelatedByForeignkeyremote->isNew()) {
					$affectedRows += $this->aModuleEntityFieldRelatedByForeignkeyremote->save($con);
				}
				$this->setModuleEntityFieldRelatedByForeignkeyremote($this->aModuleEntityFieldRelatedByForeignkeyremote);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setNew(false);
				} else {
					$affectedRows += ModuleEntityFieldPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collModuleEntitysRelatedByScopefielduniquename !== null) {
				foreach ($this->collModuleEntitysRelatedByScopefielduniquename as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collModuleEntityFieldsRelatedByUniquename !== null) {
				foreach ($this->collModuleEntityFieldsRelatedByUniquename as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collModuleEntityFieldValidations !== null) {
				foreach ($this->collModuleEntityFieldValidations as $referrerFK) {
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
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
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
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
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
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
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

			if ($this->aModuleEntityRelatedByEntityname !== null) {
				if (!$this->aModuleEntityRelatedByEntityname->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModuleEntityRelatedByEntityname->getValidationFailures());
				}
			}

			if ($this->aModuleEntityRelatedByForeignkeytable !== null) {
				if (!$this->aModuleEntityRelatedByForeignkeytable->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModuleEntityRelatedByForeignkeytable->getValidationFailures());
				}
			}

			if ($this->aModuleEntityFieldRelatedByForeignkeyremote !== null) {
				if (!$this->aModuleEntityFieldRelatedByForeignkeyremote->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModuleEntityFieldRelatedByForeignkeyremote->getValidationFailures());
				}
			}


			if (($retval = ModuleEntityFieldPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collModuleEntitysRelatedByScopefielduniquename !== null) {
					foreach ($this->collModuleEntitysRelatedByScopefielduniquename as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collModuleEntityFieldsRelatedByUniquename !== null) {
					foreach ($this->collModuleEntityFieldsRelatedByUniquename as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collModuleEntityFieldValidations !== null) {
					foreach ($this->collModuleEntityFieldValidations as $referrerFK) {
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
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ModuleEntityFieldPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUniquename();
				break;
			case 1:
				return $this->getEntityname();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getIsrequired();
				break;
			case 5:
				return $this->getDefaultvalue();
				break;
			case 6:
				return $this->getIsprimarykey();
				break;
			case 7:
				return $this->getIsautoincrement();
				break;
			case 8:
				return $this->getOrder();
				break;
			case 9:
				return $this->getType();
				break;
			case 10:
				return $this->getUnique();
				break;
			case 11:
				return $this->getSize();
				break;
			case 12:
				return $this->getAggregateexpression();
				break;
			case 13:
				return $this->getLabel();
				break;
			case 14:
				return $this->getFormfieldtype();
				break;
			case 15:
				return $this->getFormfieldsize();
				break;
			case 16:
				return $this->getFormfieldlines();
				break;
			case 17:
				return $this->getFormfieldusecalendar();
				break;
			case 18:
				return $this->getForeignkeytable();
				break;
			case 19:
				return $this->getForeignkeyremote();
				break;
			case 20:
				return $this->getOndelete();
				break;
			case 21:
				return $this->getAutomatic();
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
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['ModuleEntityField'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['ModuleEntityField'][$this->getPrimaryKey()] = true;
		$keys = ModuleEntityFieldPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUniquename(),
			$keys[1] => $this->getEntityname(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getIsrequired(),
			$keys[5] => $this->getDefaultvalue(),
			$keys[6] => $this->getIsprimarykey(),
			$keys[7] => $this->getIsautoincrement(),
			$keys[8] => $this->getOrder(),
			$keys[9] => $this->getType(),
			$keys[10] => $this->getUnique(),
			$keys[11] => $this->getSize(),
			$keys[12] => $this->getAggregateexpression(),
			$keys[13] => $this->getLabel(),
			$keys[14] => $this->getFormfieldtype(),
			$keys[15] => $this->getFormfieldsize(),
			$keys[16] => $this->getFormfieldlines(),
			$keys[17] => $this->getFormfieldusecalendar(),
			$keys[18] => $this->getForeignkeytable(),
			$keys[19] => $this->getForeignkeyremote(),
			$keys[20] => $this->getOndelete(),
			$keys[21] => $this->getAutomatic(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aModuleEntityRelatedByEntityname) {
				$result['ModuleEntityRelatedByEntityname'] = $this->aModuleEntityRelatedByEntityname->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aModuleEntityRelatedByForeignkeytable) {
				$result['ModuleEntityRelatedByForeignkeytable'] = $this->aModuleEntityRelatedByForeignkeytable->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aModuleEntityFieldRelatedByForeignkeyremote) {
				$result['ModuleEntityFieldRelatedByForeignkeyremote'] = $this->aModuleEntityFieldRelatedByForeignkeyremote->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collModuleEntitysRelatedByScopefielduniquename) {
				$result['ModuleEntitysRelatedByScopefielduniquename'] = $this->collModuleEntitysRelatedByScopefielduniquename->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collModuleEntityFieldsRelatedByUniquename) {
				$result['ModuleEntityFieldsRelatedByUniquename'] = $this->collModuleEntityFieldsRelatedByUniquename->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collModuleEntityFieldValidations) {
				$result['ModuleEntityFieldValidations'] = $this->collModuleEntityFieldValidations->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ModuleEntityFieldPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUniquename($value);
				break;
			case 1:
				$this->setEntityname($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setIsrequired($value);
				break;
			case 5:
				$this->setDefaultvalue($value);
				break;
			case 6:
				$this->setIsprimarykey($value);
				break;
			case 7:
				$this->setIsautoincrement($value);
				break;
			case 8:
				$this->setOrder($value);
				break;
			case 9:
				$this->setType($value);
				break;
			case 10:
				$this->setUnique($value);
				break;
			case 11:
				$this->setSize($value);
				break;
			case 12:
				$this->setAggregateexpression($value);
				break;
			case 13:
				$this->setLabel($value);
				break;
			case 14:
				$this->setFormfieldtype($value);
				break;
			case 15:
				$this->setFormfieldsize($value);
				break;
			case 16:
				$this->setFormfieldlines($value);
				break;
			case 17:
				$this->setFormfieldusecalendar($value);
				break;
			case 18:
				$this->setForeignkeytable($value);
				break;
			case 19:
				$this->setForeignkeyremote($value);
				break;
			case 20:
				$this->setOndelete($value);
				break;
			case 21:
				$this->setAutomatic($value);
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
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ModuleEntityFieldPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUniquename($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEntityname($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIsrequired($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDefaultvalue($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsprimarykey($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsautoincrement($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setOrder($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setType($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUnique($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setSize($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setAggregateexpression($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLabel($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setFormfieldtype($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setFormfieldsize($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setFormfieldlines($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFormfieldusecalendar($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setForeignkeytable($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setForeignkeyremote($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setOndelete($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setAutomatic($arr[$keys[21]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);

		if ($this->isColumnModified(ModuleEntityFieldPeer::UNIQUENAME)) $criteria->add(ModuleEntityFieldPeer::UNIQUENAME, $this->uniquename);
		if ($this->isColumnModified(ModuleEntityFieldPeer::ENTITYNAME)) $criteria->add(ModuleEntityFieldPeer::ENTITYNAME, $this->entityname);
		if ($this->isColumnModified(ModuleEntityFieldPeer::NAME)) $criteria->add(ModuleEntityFieldPeer::NAME, $this->name);
		if ($this->isColumnModified(ModuleEntityFieldPeer::DESCRIPTION)) $criteria->add(ModuleEntityFieldPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(ModuleEntityFieldPeer::ISREQUIRED)) $criteria->add(ModuleEntityFieldPeer::ISREQUIRED, $this->isrequired);
		if ($this->isColumnModified(ModuleEntityFieldPeer::DEFAULTVALUE)) $criteria->add(ModuleEntityFieldPeer::DEFAULTVALUE, $this->defaultvalue);
		if ($this->isColumnModified(ModuleEntityFieldPeer::ISPRIMARYKEY)) $criteria->add(ModuleEntityFieldPeer::ISPRIMARYKEY, $this->isprimarykey);
		if ($this->isColumnModified(ModuleEntityFieldPeer::ISAUTOINCREMENT)) $criteria->add(ModuleEntityFieldPeer::ISAUTOINCREMENT, $this->isautoincrement);
		if ($this->isColumnModified(ModuleEntityFieldPeer::ORDER)) $criteria->add(ModuleEntityFieldPeer::ORDER, $this->order);
		if ($this->isColumnModified(ModuleEntityFieldPeer::TYPE)) $criteria->add(ModuleEntityFieldPeer::TYPE, $this->type);
		if ($this->isColumnModified(ModuleEntityFieldPeer::UNIQUE)) $criteria->add(ModuleEntityFieldPeer::UNIQUE, $this->unique);
		if ($this->isColumnModified(ModuleEntityFieldPeer::SIZE)) $criteria->add(ModuleEntityFieldPeer::SIZE, $this->size);
		if ($this->isColumnModified(ModuleEntityFieldPeer::AGGREGATEEXPRESSION)) $criteria->add(ModuleEntityFieldPeer::AGGREGATEEXPRESSION, $this->aggregateexpression);
		if ($this->isColumnModified(ModuleEntityFieldPeer::LABEL)) $criteria->add(ModuleEntityFieldPeer::LABEL, $this->label);
		if ($this->isColumnModified(ModuleEntityFieldPeer::FORMFIELDTYPE)) $criteria->add(ModuleEntityFieldPeer::FORMFIELDTYPE, $this->formfieldtype);
		if ($this->isColumnModified(ModuleEntityFieldPeer::FORMFIELDSIZE)) $criteria->add(ModuleEntityFieldPeer::FORMFIELDSIZE, $this->formfieldsize);
		if ($this->isColumnModified(ModuleEntityFieldPeer::FORMFIELDLINES)) $criteria->add(ModuleEntityFieldPeer::FORMFIELDLINES, $this->formfieldlines);
		if ($this->isColumnModified(ModuleEntityFieldPeer::FORMFIELDUSECALENDAR)) $criteria->add(ModuleEntityFieldPeer::FORMFIELDUSECALENDAR, $this->formfieldusecalendar);
		if ($this->isColumnModified(ModuleEntityFieldPeer::FOREIGNKEYTABLE)) $criteria->add(ModuleEntityFieldPeer::FOREIGNKEYTABLE, $this->foreignkeytable);
		if ($this->isColumnModified(ModuleEntityFieldPeer::FOREIGNKEYREMOTE)) $criteria->add(ModuleEntityFieldPeer::FOREIGNKEYREMOTE, $this->foreignkeyremote);
		if ($this->isColumnModified(ModuleEntityFieldPeer::ONDELETE)) $criteria->add(ModuleEntityFieldPeer::ONDELETE, $this->ondelete);
		if ($this->isColumnModified(ModuleEntityFieldPeer::AUTOMATIC)) $criteria->add(ModuleEntityFieldPeer::AUTOMATIC, $this->automatic);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ModuleEntityFieldPeer::DATABASE_NAME);
		$criteria->add(ModuleEntityFieldPeer::UNIQUENAME, $this->uniquename);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getUniquename();
	}

	/**
	 * Generic method to set the primary key (uniquename column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setUniquename($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getUniquename();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of ModuleEntityField (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUniquename($this->getUniquename());
		$copyObj->setEntityname($this->getEntityname());
		$copyObj->setName($this->getName());
		$copyObj->setDescription($this->getDescription());
		$copyObj->setIsrequired($this->getIsrequired());
		$copyObj->setDefaultvalue($this->getDefaultvalue());
		$copyObj->setIsprimarykey($this->getIsprimarykey());
		$copyObj->setIsautoincrement($this->getIsautoincrement());
		$copyObj->setOrder($this->getOrder());
		$copyObj->setType($this->getType());
		$copyObj->setUnique($this->getUnique());
		$copyObj->setSize($this->getSize());
		$copyObj->setAggregateexpression($this->getAggregateexpression());
		$copyObj->setLabel($this->getLabel());
		$copyObj->setFormfieldtype($this->getFormfieldtype());
		$copyObj->setFormfieldsize($this->getFormfieldsize());
		$copyObj->setFormfieldlines($this->getFormfieldlines());
		$copyObj->setFormfieldusecalendar($this->getFormfieldusecalendar());
		$copyObj->setForeignkeytable($this->getForeignkeytable());
		$copyObj->setForeignkeyremote($this->getForeignkeyremote());
		$copyObj->setOndelete($this->getOndelete());
		$copyObj->setAutomatic($this->getAutomatic());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getModuleEntitysRelatedByScopefielduniquename() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addModuleEntityRelatedByScopefielduniquename($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getModuleEntityFieldsRelatedByUniquename() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addModuleEntityFieldRelatedByUniquename($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getModuleEntityFieldValidations() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addModuleEntityFieldValidation($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
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
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     ModuleEntityField Clone of current object.
	 * @throws     PropelException
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
	 * @return     ModuleEntityFieldPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ModuleEntityFieldPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a ModuleEntity object.
	 *
	 * @param      ModuleEntity $v
	 * @return     ModuleEntityField The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setModuleEntityRelatedByEntityname(ModuleEntity $v = null)
	{
		if ($v === null) {
			$this->setEntityname(NULL);
		} else {
			$this->setEntityname($v->getName());
		}

		$this->aModuleEntityRelatedByEntityname = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ModuleEntity object, it will not be re-added.
		if ($v !== null) {
			$v->addModuleEntityFieldRelatedByEntityname($this);
		}

		return $this;
	}


	/**
	 * Get the associated ModuleEntity object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ModuleEntity The associated ModuleEntity object.
	 * @throws     PropelException
	 */
	public function getModuleEntityRelatedByEntityname(PropelPDO $con = null)
	{
		if ($this->aModuleEntityRelatedByEntityname === null && (($this->entityname !== "" && $this->entityname !== null))) {
			$this->aModuleEntityRelatedByEntityname = ModuleEntityQuery::create()->findPk($this->entityname, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aModuleEntityRelatedByEntityname->addModuleEntityFieldsRelatedByEntityname($this);
			 */
		}
		return $this->aModuleEntityRelatedByEntityname;
	}

	/**
	 * Declares an association between this object and a ModuleEntity object.
	 *
	 * @param      ModuleEntity $v
	 * @return     ModuleEntityField The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setModuleEntityRelatedByForeignkeytable(ModuleEntity $v = null)
	{
		if ($v === null) {
			$this->setForeignkeytable(NULL);
		} else {
			$this->setForeignkeytable($v->getName());
		}

		$this->aModuleEntityRelatedByForeignkeytable = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ModuleEntity object, it will not be re-added.
		if ($v !== null) {
			$v->addModuleEntityFieldRelatedByForeignkeytable($this);
		}

		return $this;
	}


	/**
	 * Get the associated ModuleEntity object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ModuleEntity The associated ModuleEntity object.
	 * @throws     PropelException
	 */
	public function getModuleEntityRelatedByForeignkeytable(PropelPDO $con = null)
	{
		if ($this->aModuleEntityRelatedByForeignkeytable === null && (($this->foreignkeytable !== "" && $this->foreignkeytable !== null))) {
			$this->aModuleEntityRelatedByForeignkeytable = ModuleEntityQuery::create()->findPk($this->foreignkeytable, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aModuleEntityRelatedByForeignkeytable->addModuleEntityFieldsRelatedByForeignkeytable($this);
			 */
		}
		return $this->aModuleEntityRelatedByForeignkeytable;
	}

	/**
	 * Declares an association between this object and a ModuleEntityField object.
	 *
	 * @param      ModuleEntityField $v
	 * @return     ModuleEntityField The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setModuleEntityFieldRelatedByForeignkeyremote(ModuleEntityField $v = null)
	{
		if ($v === null) {
			$this->setForeignkeyremote(NULL);
		} else {
			$this->setForeignkeyremote($v->getUniquename());
		}

		$this->aModuleEntityFieldRelatedByForeignkeyremote = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the ModuleEntityField object, it will not be re-added.
		if ($v !== null) {
			$v->addModuleEntityFieldRelatedByUniquename($this);
		}

		return $this;
	}


	/**
	 * Get the associated ModuleEntityField object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     ModuleEntityField The associated ModuleEntityField object.
	 * @throws     PropelException
	 */
	public function getModuleEntityFieldRelatedByForeignkeyremote(PropelPDO $con = null)
	{
		if ($this->aModuleEntityFieldRelatedByForeignkeyremote === null && (($this->foreignkeyremote !== "" && $this->foreignkeyremote !== null))) {
			$this->aModuleEntityFieldRelatedByForeignkeyremote = ModuleEntityFieldQuery::create()->findPk($this->foreignkeyremote, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aModuleEntityFieldRelatedByForeignkeyremote->addModuleEntityFieldsRelatedByUniquename($this);
			 */
		}
		return $this->aModuleEntityFieldRelatedByForeignkeyremote;
	}

	/**
	 * Clears out the collModuleEntitysRelatedByScopefielduniquename collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addModuleEntitysRelatedByScopefielduniquename()
	 */
	public function clearModuleEntitysRelatedByScopefielduniquename()
	{
		$this->collModuleEntitysRelatedByScopefielduniquename = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collModuleEntitysRelatedByScopefielduniquename collection.
	 *
	 * By default this just sets the collModuleEntitysRelatedByScopefielduniquename collection to an empty array (like clearcollModuleEntitysRelatedByScopefielduniquename());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initModuleEntitysRelatedByScopefielduniquename($overrideExisting = true)
	{
		if (null !== $this->collModuleEntitysRelatedByScopefielduniquename && !$overrideExisting) {
			return;
		}
		$this->collModuleEntitysRelatedByScopefielduniquename = new PropelObjectCollection();
		$this->collModuleEntitysRelatedByScopefielduniquename->setModel('ModuleEntity');
	}

	/**
	 * Gets an array of ModuleEntity objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ModuleEntityField is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ModuleEntity[] List of ModuleEntity objects
	 * @throws     PropelException
	 */
	public function getModuleEntitysRelatedByScopefielduniquename($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collModuleEntitysRelatedByScopefielduniquename || null !== $criteria) {
			if ($this->isNew() && null === $this->collModuleEntitysRelatedByScopefielduniquename) {
				// return empty collection
				$this->initModuleEntitysRelatedByScopefielduniquename();
			} else {
				$collModuleEntitysRelatedByScopefielduniquename = ModuleEntityQuery::create(null, $criteria)
					->filterByModuleEntityFieldRelatedByScopefielduniquename($this)
					->find($con);
				if (null !== $criteria) {
					return $collModuleEntitysRelatedByScopefielduniquename;
				}
				$this->collModuleEntitysRelatedByScopefielduniquename = $collModuleEntitysRelatedByScopefielduniquename;
			}
		}
		return $this->collModuleEntitysRelatedByScopefielduniquename;
	}

	/**
	 * Returns the number of related ModuleEntity objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ModuleEntity objects.
	 * @throws     PropelException
	 */
	public function countModuleEntitysRelatedByScopefielduniquename(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collModuleEntitysRelatedByScopefielduniquename || null !== $criteria) {
			if ($this->isNew() && null === $this->collModuleEntitysRelatedByScopefielduniquename) {
				return 0;
			} else {
				$query = ModuleEntityQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByModuleEntityFieldRelatedByScopefielduniquename($this)
					->count($con);
			}
		} else {
			return count($this->collModuleEntitysRelatedByScopefielduniquename);
		}
	}

	/**
	 * Method called to associate a ModuleEntity object to this object
	 * through the ModuleEntity foreign key attribute.
	 *
	 * @param      ModuleEntity $l ModuleEntity
	 * @return     void
	 * @throws     PropelException
	 */
	public function addModuleEntityRelatedByScopefielduniquename(ModuleEntity $l)
	{
		if ($this->collModuleEntitysRelatedByScopefielduniquename === null) {
			$this->initModuleEntitysRelatedByScopefielduniquename();
		}
		if (!$this->collModuleEntitysRelatedByScopefielduniquename->contains($l)) { // only add it if the **same** object is not already associated
			$this->collModuleEntitysRelatedByScopefielduniquename[]= $l;
			$l->setModuleEntityFieldRelatedByScopefielduniquename($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ModuleEntityField is new, it will return
	 * an empty collection; or if this ModuleEntityField has previously
	 * been saved, it will retrieve related ModuleEntitysRelatedByScopefielduniquename from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ModuleEntityField.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ModuleEntity[] List of ModuleEntity objects
	 */
	public function getModuleEntitysRelatedByScopefielduniquenameJoinModule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ModuleEntityQuery::create(null, $criteria);
		$query->joinWith('Module', $join_behavior);

		return $this->getModuleEntitysRelatedByScopefielduniquename($query, $con);
	}

	/**
	 * Clears out the collModuleEntityFieldsRelatedByUniquename collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addModuleEntityFieldsRelatedByUniquename()
	 */
	public function clearModuleEntityFieldsRelatedByUniquename()
	{
		$this->collModuleEntityFieldsRelatedByUniquename = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collModuleEntityFieldsRelatedByUniquename collection.
	 *
	 * By default this just sets the collModuleEntityFieldsRelatedByUniquename collection to an empty array (like clearcollModuleEntityFieldsRelatedByUniquename());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initModuleEntityFieldsRelatedByUniquename($overrideExisting = true)
	{
		if (null !== $this->collModuleEntityFieldsRelatedByUniquename && !$overrideExisting) {
			return;
		}
		$this->collModuleEntityFieldsRelatedByUniquename = new PropelObjectCollection();
		$this->collModuleEntityFieldsRelatedByUniquename->setModel('ModuleEntityField');
	}

	/**
	 * Gets an array of ModuleEntityField objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ModuleEntityField is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ModuleEntityField[] List of ModuleEntityField objects
	 * @throws     PropelException
	 */
	public function getModuleEntityFieldsRelatedByUniquename($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collModuleEntityFieldsRelatedByUniquename || null !== $criteria) {
			if ($this->isNew() && null === $this->collModuleEntityFieldsRelatedByUniquename) {
				// return empty collection
				$this->initModuleEntityFieldsRelatedByUniquename();
			} else {
				$collModuleEntityFieldsRelatedByUniquename = ModuleEntityFieldQuery::create(null, $criteria)
					->filterByModuleEntityFieldRelatedByForeignkeyremote($this)
					->find($con);
				if (null !== $criteria) {
					return $collModuleEntityFieldsRelatedByUniquename;
				}
				$this->collModuleEntityFieldsRelatedByUniquename = $collModuleEntityFieldsRelatedByUniquename;
			}
		}
		return $this->collModuleEntityFieldsRelatedByUniquename;
	}

	/**
	 * Returns the number of related ModuleEntityField objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ModuleEntityField objects.
	 * @throws     PropelException
	 */
	public function countModuleEntityFieldsRelatedByUniquename(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collModuleEntityFieldsRelatedByUniquename || null !== $criteria) {
			if ($this->isNew() && null === $this->collModuleEntityFieldsRelatedByUniquename) {
				return 0;
			} else {
				$query = ModuleEntityFieldQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByModuleEntityFieldRelatedByForeignkeyremote($this)
					->count($con);
			}
		} else {
			return count($this->collModuleEntityFieldsRelatedByUniquename);
		}
	}

	/**
	 * Method called to associate a ModuleEntityField object to this object
	 * through the ModuleEntityField foreign key attribute.
	 *
	 * @param      ModuleEntityField $l ModuleEntityField
	 * @return     void
	 * @throws     PropelException
	 */
	public function addModuleEntityFieldRelatedByUniquename(ModuleEntityField $l)
	{
		if ($this->collModuleEntityFieldsRelatedByUniquename === null) {
			$this->initModuleEntityFieldsRelatedByUniquename();
		}
		if (!$this->collModuleEntityFieldsRelatedByUniquename->contains($l)) { // only add it if the **same** object is not already associated
			$this->collModuleEntityFieldsRelatedByUniquename[]= $l;
			$l->setModuleEntityFieldRelatedByForeignkeyremote($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ModuleEntityField is new, it will return
	 * an empty collection; or if this ModuleEntityField has previously
	 * been saved, it will retrieve related ModuleEntityFieldsRelatedByUniquename from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ModuleEntityField.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ModuleEntityField[] List of ModuleEntityField objects
	 */
	public function getModuleEntityFieldsRelatedByUniquenameJoinModuleEntityRelatedByEntityname($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ModuleEntityFieldQuery::create(null, $criteria);
		$query->joinWith('ModuleEntityRelatedByEntityname', $join_behavior);

		return $this->getModuleEntityFieldsRelatedByUniquename($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ModuleEntityField is new, it will return
	 * an empty collection; or if this ModuleEntityField has previously
	 * been saved, it will retrieve related ModuleEntityFieldsRelatedByUniquename from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in ModuleEntityField.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ModuleEntityField[] List of ModuleEntityField objects
	 */
	public function getModuleEntityFieldsRelatedByUniquenameJoinModuleEntityRelatedByForeignkeytable($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ModuleEntityFieldQuery::create(null, $criteria);
		$query->joinWith('ModuleEntityRelatedByForeignkeytable', $join_behavior);

		return $this->getModuleEntityFieldsRelatedByUniquename($query, $con);
	}

	/**
	 * Clears out the collModuleEntityFieldValidations collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addModuleEntityFieldValidations()
	 */
	public function clearModuleEntityFieldValidations()
	{
		$this->collModuleEntityFieldValidations = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collModuleEntityFieldValidations collection.
	 *
	 * By default this just sets the collModuleEntityFieldValidations collection to an empty array (like clearcollModuleEntityFieldValidations());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initModuleEntityFieldValidations($overrideExisting = true)
	{
		if (null !== $this->collModuleEntityFieldValidations && !$overrideExisting) {
			return;
		}
		$this->collModuleEntityFieldValidations = new PropelObjectCollection();
		$this->collModuleEntityFieldValidations->setModel('ModuleEntityFieldValidation');
	}

	/**
	 * Gets an array of ModuleEntityFieldValidation objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this ModuleEntityField is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ModuleEntityFieldValidation[] List of ModuleEntityFieldValidation objects
	 * @throws     PropelException
	 */
	public function getModuleEntityFieldValidations($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collModuleEntityFieldValidations || null !== $criteria) {
			if ($this->isNew() && null === $this->collModuleEntityFieldValidations) {
				// return empty collection
				$this->initModuleEntityFieldValidations();
			} else {
				$collModuleEntityFieldValidations = ModuleEntityFieldValidationQuery::create(null, $criteria)
					->filterByModuleEntityField($this)
					->find($con);
				if (null !== $criteria) {
					return $collModuleEntityFieldValidations;
				}
				$this->collModuleEntityFieldValidations = $collModuleEntityFieldValidations;
			}
		}
		return $this->collModuleEntityFieldValidations;
	}

	/**
	 * Returns the number of related ModuleEntityFieldValidation objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ModuleEntityFieldValidation objects.
	 * @throws     PropelException
	 */
	public function countModuleEntityFieldValidations(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collModuleEntityFieldValidations || null !== $criteria) {
			if ($this->isNew() && null === $this->collModuleEntityFieldValidations) {
				return 0;
			} else {
				$query = ModuleEntityFieldValidationQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByModuleEntityField($this)
					->count($con);
			}
		} else {
			return count($this->collModuleEntityFieldValidations);
		}
	}

	/**
	 * Method called to associate a ModuleEntityFieldValidation object to this object
	 * through the ModuleEntityFieldValidation foreign key attribute.
	 *
	 * @param      ModuleEntityFieldValidation $l ModuleEntityFieldValidation
	 * @return     void
	 * @throws     PropelException
	 */
	public function addModuleEntityFieldValidation(ModuleEntityFieldValidation $l)
	{
		if ($this->collModuleEntityFieldValidations === null) {
			$this->initModuleEntityFieldValidations();
		}
		if (!$this->collModuleEntityFieldValidations->contains($l)) { // only add it if the **same** object is not already associated
			$this->collModuleEntityFieldValidations[]= $l;
			$l->setModuleEntityField($this);
		}
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->uniquename = null;
		$this->entityname = null;
		$this->name = null;
		$this->description = null;
		$this->isrequired = null;
		$this->defaultvalue = null;
		$this->isprimarykey = null;
		$this->isautoincrement = null;
		$this->order = null;
		$this->type = null;
		$this->unique = null;
		$this->size = null;
		$this->aggregateexpression = null;
		$this->label = null;
		$this->formfieldtype = null;
		$this->formfieldsize = null;
		$this->formfieldlines = null;
		$this->formfieldusecalendar = null;
		$this->foreignkeytable = null;
		$this->foreignkeyremote = null;
		$this->ondelete = null;
		$this->automatic = null;
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
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collModuleEntitysRelatedByScopefielduniquename) {
				foreach ($this->collModuleEntitysRelatedByScopefielduniquename as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collModuleEntityFieldsRelatedByUniquename) {
				foreach ($this->collModuleEntityFieldsRelatedByUniquename as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collModuleEntityFieldValidations) {
				foreach ($this->collModuleEntityFieldValidations as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collModuleEntitysRelatedByScopefielduniquename instanceof PropelCollection) {
			$this->collModuleEntitysRelatedByScopefielduniquename->clearIterator();
		}
		$this->collModuleEntitysRelatedByScopefielduniquename = null;
		if ($this->collModuleEntityFieldsRelatedByUniquename instanceof PropelCollection) {
			$this->collModuleEntityFieldsRelatedByUniquename->clearIterator();
		}
		$this->collModuleEntityFieldsRelatedByUniquename = null;
		if ($this->collModuleEntityFieldValidations instanceof PropelCollection) {
			$this->collModuleEntityFieldValidations->clearIterator();
		}
		$this->collModuleEntityFieldValidations = null;
		$this->aModuleEntityRelatedByEntityname = null;
		$this->aModuleEntityRelatedByForeignkeytable = null;
		$this->aModuleEntityFieldRelatedByForeignkeyremote = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ModuleEntityFieldPeer::DEFAULT_STRING_FORMAT);
	}

	/**
	 * Catches calls to virtual methods
	 */
	public function __call($name, $params)
	{
		if (preg_match('/get(\w+)/', $name, $matches)) {
			$virtualColumn = $matches[1];
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
			// no lcfirst in php<5.3...
			$virtualColumn[0] = strtolower($virtualColumn[0]);
			if ($this->hasVirtualColumn($virtualColumn)) {
				return $this->getVirtualColumn($virtualColumn);
			}
		}
		return parent::__call($name, $params);
	}

} // BaseModuleEntityField
