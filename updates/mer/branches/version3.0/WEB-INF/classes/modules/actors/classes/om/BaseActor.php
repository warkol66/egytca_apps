<?php


/**
 * Base class that represents a row from the 'MER_actor' table.
 *
 * Actors
 *
 * @package    propel.generator.actors.classes.om
 */
abstract class BaseActor extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ActorPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ActorPeer
	 */
	protected static $peer;

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
	 * The value for the categoryid field.
	 * @var        int
	 */
	protected $categoryid;

	/**
	 * The value for the active field.
	 * Note: this column has a database default value of: true
	 * @var        boolean
	 */
	protected $active;

	/**
	 * The value for the strategy field.
	 * @var        string
	 */
	protected $strategy;

	/**
	 * The value for the tactic field.
	 * @var        string
	 */
	protected $tactic;

	/**
	 * The value for the comments field.
	 * @var        string
	 */
	protected $comments;

	/**
	 * The value for the observations field.
	 * @var        string
	 */
	protected $observations;

	/**
	 * The value for the deleted_at field.
	 * @var        string
	 */
	protected $deleted_at;

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
	 * @var        Category
	 */
	protected $aCategory;

	/**
	 * @var        array Hierarchy[] Collection to store aggregation of Hierarchy objects.
	 */
	protected $collHierarchys;

	/**
	 * @var        array Relationship[] Collection to store aggregation of Relationship objects.
	 */
	protected $collRelationshipsRelatedByActor1id;

	/**
	 * @var        array Relationship[] Collection to store aggregation of Relationship objects.
	 */
	protected $collRelationshipsRelatedByActor2id;

	/**
	 * @var        array ActorActiveQuestion[] Collection to store aggregation of ActorActiveQuestion objects.
	 */
	protected $collActorActiveQuestions;

	/**
	 * @var        array RelationshipActiveQuestion[] Collection to store aggregation of RelationshipActiveQuestion objects.
	 */
	protected $collRelationshipActiveQuestionsRelatedByActor1id;

	/**
	 * @var        array RelationshipActiveQuestion[] Collection to store aggregation of RelationshipActiveQuestion objects.
	 */
	protected $collRelationshipActiveQuestionsRelatedByActor2id;

	/**
	 * @var        array Answer[] Collection to store aggregation of Answer objects.
	 */
	protected $collAnswers;

	/**
	 * @var        array GraphActor[] Collection to store aggregation of GraphActor objects.
	 */
	protected $collGraphActors;

	/**
	 * @var        array GraphRelation[] Collection to store aggregation of GraphRelation objects.
	 */
	protected $collGraphRelationsRelatedByActor1id;

	/**
	 * @var        array GraphRelation[] Collection to store aggregation of GraphRelation objects.
	 */
	protected $collGraphRelationsRelatedByActor2id;

	/**
	 * @var        JudgementActor one-to-one related JudgementActor object
	 */
	protected $singleJudgementActor;

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
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->active = true;
	}

	/**
	 * Initializes internal state of BaseActor object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * actor's Id
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [title] column value.
	 * actor's title
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [name] column value.
	 * actor's name
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [surname] column value.
	 * actor's surname
	 * @return     string
	 */
	public function getSurname()
	{
		return $this->surname;
	}

	/**
	 * Get the [categoryid] column value.
	 * 
	 * @return     int
	 */
	public function getCategoryid()
	{
		return $this->categoryid;
	}

	/**
	 * Get the [active] column value.
	 * to be deleted!!!
	 * @return     boolean
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Get the [strategy] column value.
	 * Estrategia
	 * @return     string
	 */
	public function getStrategy()
	{
		return $this->strategy;
	}

	/**
	 * Get the [tactic] column value.
	 * Tactica
	 * @return     string
	 */
	public function getTactic()
	{
		return $this->tactic;
	}

	/**
	 * Get the [comments] column value.
	 * Comentarios
	 * @return     string
	 */
	public function getComments()
	{
		return $this->comments;
	}

	/**
	 * Get the [observations] column value.
	 * Observaciones to be deleted
	 * @return     string
	 */
	public function getObservations()
	{
		return $this->observations;
	}

	/**
	 * Get the [optionally formatted] temporal [deleted_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDeletedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->deleted_at === null) {
			return null;
		}


		if ($this->deleted_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
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
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
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
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Set the value of [id] column.
	 * actor's Id
	 * @param      int $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ActorPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [title] column.
	 * actor's title
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ActorPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [name] column.
	 * actor's name
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = ActorPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [surname] column.
	 * actor's surname
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setSurname($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->surname !== $v) {
			$this->surname = $v;
			$this->modifiedColumns[] = ActorPeer::SURNAME;
		}

		return $this;
	} // setSurname()

	/**
	 * Set the value of [categoryid] column.
	 * 
	 * @param      int $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setCategoryid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->categoryid !== $v) {
			$this->categoryid = $v;
			$this->modifiedColumns[] = ActorPeer::CATEGORYID;
		}

		if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
			$this->aCategory = null;
		}

		return $this;
	} // setCategoryid()

	/**
	 * Sets the value of the [active] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * to be deleted!!!
	 * @param      boolean|integer|string $v The new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->active !== $v || $this->isNew()) {
			$this->active = $v;
			$this->modifiedColumns[] = ActorPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Set the value of [strategy] column.
	 * Estrategia
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setStrategy($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->strategy !== $v) {
			$this->strategy = $v;
			$this->modifiedColumns[] = ActorPeer::STRATEGY;
		}

		return $this;
	} // setStrategy()

	/**
	 * Set the value of [tactic] column.
	 * Tactica
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setTactic($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tactic !== $v) {
			$this->tactic = $v;
			$this->modifiedColumns[] = ActorPeer::TACTIC;
		}

		return $this;
	} // setTactic()

	/**
	 * Set the value of [comments] column.
	 * Comentarios
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setComments($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->comments !== $v) {
			$this->comments = $v;
			$this->modifiedColumns[] = ActorPeer::COMMENTS;
		}

		return $this;
	} // setComments()

	/**
	 * Set the value of [observations] column.
	 * Observaciones to be deleted
	 * @param      string $v new value
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setObservations($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->observations !== $v) {
			$this->observations = $v;
			$this->modifiedColumns[] = ActorPeer::OBSERVATIONS;
		}

		return $this;
	} // setObservations()

	/**
	 * Sets the value of [deleted_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setDeletedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->deleted_at !== null || $dt !== null) {
			$currentDateAsString = ($this->deleted_at !== null && $tmpDt = new DateTime($this->deleted_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->deleted_at = $newDateAsString;
				$this->modifiedColumns[] = ActorPeer::DELETED_AT;
			}
		} // if either are not null

		return $this;
	} // setDeletedAt()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = ActorPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Actor The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = ActorPeer::UPDATED_AT;
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
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->active !== true) {
				return false;
			}

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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->surname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->categoryid = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->active = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->strategy = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->tactic = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->comments = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->observations = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->deleted_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->created_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->updated_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 13; // 13 = ActorPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Actor object", $e);
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

		if ($this->aCategory !== null && $this->categoryid !== $this->aCategory->getId()) {
			$this->aCategory = null;
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
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ActorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCategory = null;
			$this->collHierarchys = null;

			$this->collRelationshipsRelatedByActor1id = null;

			$this->collRelationshipsRelatedByActor2id = null;

			$this->collActorActiveQuestions = null;

			$this->collRelationshipActiveQuestionsRelatedByActor1id = null;

			$this->collRelationshipActiveQuestionsRelatedByActor2id = null;

			$this->collAnswers = null;

			$this->collGraphActors = null;

			$this->collGraphRelationsRelatedByActor1id = null;

			$this->collGraphRelationsRelatedByActor2id = null;

			$this->singleJudgementActor = null;

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
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// soft_delete behavior
			if (!empty($ret) && ActorQuery::isSoftDeleteEnabled()) {
				$this->keepUpdateDateUnchanged();
				$this->setDeletedAt(time());
				$this->save($con);
				$con->commit();
				ActorPeer::removeInstanceFromPool($this);
				return;
			}

			if ($ret) {
				ActorQuery::create()
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
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// timestampable behavior
				if (!$this->isColumnModified(ActorPeer::CREATED_AT)) {
					$this->setCreatedAt(time());
				}
				if (!$this->isColumnModified(ActorPeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			} else {
				$ret = $ret && $this->preUpdate($con);
				// timestampable behavior
				if ($this->isModified() && !$this->isColumnModified(ActorPeer::UPDATED_AT)) {
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
				ActorPeer::addInstanceToPool($this);
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

			if ($this->aCategory !== null) {
				if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
					$affectedRows += $this->aCategory->save($con);
				}
				$this->setCategory($this->aCategory);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ActorPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(ActorPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.ActorPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += ActorPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collHierarchys !== null) {
				foreach ($this->collHierarchys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationshipsRelatedByActor1id !== null) {
				foreach ($this->collRelationshipsRelatedByActor1id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationshipsRelatedByActor2id !== null) {
				foreach ($this->collRelationshipsRelatedByActor2id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorActiveQuestions !== null) {
				foreach ($this->collActorActiveQuestions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationshipActiveQuestionsRelatedByActor1id !== null) {
				foreach ($this->collRelationshipActiveQuestionsRelatedByActor1id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationshipActiveQuestionsRelatedByActor2id !== null) {
				foreach ($this->collRelationshipActiveQuestionsRelatedByActor2id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAnswers !== null) {
				foreach ($this->collAnswers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGraphActors !== null) {
				foreach ($this->collGraphActors as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGraphRelationsRelatedByActor1id !== null) {
				foreach ($this->collGraphRelationsRelatedByActor1id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGraphRelationsRelatedByActor2id !== null) {
				foreach ($this->collGraphRelationsRelatedByActor2id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleJudgementActor !== null) {
				if (!$this->singleJudgementActor->isDeleted()) {
						$affectedRows += $this->singleJudgementActor->save($con);
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

			if ($this->aCategory !== null) {
				if (!$this->aCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
				}
			}


			if (($retval = ActorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHierarchys !== null) {
					foreach ($this->collHierarchys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationshipsRelatedByActor1id !== null) {
					foreach ($this->collRelationshipsRelatedByActor1id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationshipsRelatedByActor2id !== null) {
					foreach ($this->collRelationshipsRelatedByActor2id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorActiveQuestions !== null) {
					foreach ($this->collActorActiveQuestions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationshipActiveQuestionsRelatedByActor1id !== null) {
					foreach ($this->collRelationshipActiveQuestionsRelatedByActor1id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationshipActiveQuestionsRelatedByActor2id !== null) {
					foreach ($this->collRelationshipActiveQuestionsRelatedByActor2id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAnswers !== null) {
					foreach ($this->collAnswers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGraphActors !== null) {
					foreach ($this->collGraphActors as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGraphRelationsRelatedByActor1id !== null) {
					foreach ($this->collGraphRelationsRelatedByActor1id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGraphRelationsRelatedByActor2id !== null) {
					foreach ($this->collGraphRelationsRelatedByActor2id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleJudgementActor !== null) {
					if (!$this->singleJudgementActor->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleJudgementActor->getValidationFailures());
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
		$pos = ActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getSurname();
				break;
			case 4:
				return $this->getCategoryid();
				break;
			case 5:
				return $this->getActive();
				break;
			case 6:
				return $this->getStrategy();
				break;
			case 7:
				return $this->getTactic();
				break;
			case 8:
				return $this->getComments();
				break;
			case 9:
				return $this->getObservations();
				break;
			case 10:
				return $this->getDeletedAt();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
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
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Actor'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Actor'][$this->getPrimaryKey()] = true;
		$keys = ActorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getSurname(),
			$keys[4] => $this->getCategoryid(),
			$keys[5] => $this->getActive(),
			$keys[6] => $this->getStrategy(),
			$keys[7] => $this->getTactic(),
			$keys[8] => $this->getComments(),
			$keys[9] => $this->getObservations(),
			$keys[10] => $this->getDeletedAt(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aCategory) {
				$result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collHierarchys) {
				$result['Hierarchys'] = $this->collHierarchys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collRelationshipsRelatedByActor1id) {
				$result['RelationshipsRelatedByActor1id'] = $this->collRelationshipsRelatedByActor1id->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collRelationshipsRelatedByActor2id) {
				$result['RelationshipsRelatedByActor2id'] = $this->collRelationshipsRelatedByActor2id->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collActorActiveQuestions) {
				$result['ActorActiveQuestions'] = $this->collActorActiveQuestions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collRelationshipActiveQuestionsRelatedByActor1id) {
				$result['RelationshipActiveQuestionsRelatedByActor1id'] = $this->collRelationshipActiveQuestionsRelatedByActor1id->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collRelationshipActiveQuestionsRelatedByActor2id) {
				$result['RelationshipActiveQuestionsRelatedByActor2id'] = $this->collRelationshipActiveQuestionsRelatedByActor2id->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collAnswers) {
				$result['Answers'] = $this->collAnswers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphActors) {
				$result['GraphActors'] = $this->collGraphActors->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphRelationsRelatedByActor1id) {
				$result['GraphRelationsRelatedByActor1id'] = $this->collGraphRelationsRelatedByActor1id->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphRelationsRelatedByActor2id) {
				$result['GraphRelationsRelatedByActor2id'] = $this->collGraphRelationsRelatedByActor2id->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->singleJudgementActor) {
				$result['JudgementActor'] = $this->singleJudgementActor->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
		$pos = ActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setSurname($value);
				break;
			case 4:
				$this->setCategoryid($value);
				break;
			case 5:
				$this->setActive($value);
				break;
			case 6:
				$this->setStrategy($value);
				break;
			case 7:
				$this->setTactic($value);
				break;
			case 8:
				$this->setComments($value);
				break;
			case 9:
				$this->setObservations($value);
				break;
			case 10:
				$this->setDeletedAt($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
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
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ActorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSurname($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCategoryid($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActive($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStrategy($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTactic($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setComments($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setObservations($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDeletedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ActorPeer::DATABASE_NAME);

		if ($this->isColumnModified(ActorPeer::ID)) $criteria->add(ActorPeer::ID, $this->id);
		if ($this->isColumnModified(ActorPeer::TITLE)) $criteria->add(ActorPeer::TITLE, $this->title);
		if ($this->isColumnModified(ActorPeer::NAME)) $criteria->add(ActorPeer::NAME, $this->name);
		if ($this->isColumnModified(ActorPeer::SURNAME)) $criteria->add(ActorPeer::SURNAME, $this->surname);
		if ($this->isColumnModified(ActorPeer::CATEGORYID)) $criteria->add(ActorPeer::CATEGORYID, $this->categoryid);
		if ($this->isColumnModified(ActorPeer::ACTIVE)) $criteria->add(ActorPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(ActorPeer::STRATEGY)) $criteria->add(ActorPeer::STRATEGY, $this->strategy);
		if ($this->isColumnModified(ActorPeer::TACTIC)) $criteria->add(ActorPeer::TACTIC, $this->tactic);
		if ($this->isColumnModified(ActorPeer::COMMENTS)) $criteria->add(ActorPeer::COMMENTS, $this->comments);
		if ($this->isColumnModified(ActorPeer::OBSERVATIONS)) $criteria->add(ActorPeer::OBSERVATIONS, $this->observations);
		if ($this->isColumnModified(ActorPeer::DELETED_AT)) $criteria->add(ActorPeer::DELETED_AT, $this->deleted_at);
		if ($this->isColumnModified(ActorPeer::CREATED_AT)) $criteria->add(ActorPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ActorPeer::UPDATED_AT)) $criteria->add(ActorPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(ActorPeer::DATABASE_NAME);
		$criteria->add(ActorPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
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
	 * @param      object $copyObj An object of Actor (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setTitle($this->getTitle());
		$copyObj->setName($this->getName());
		$copyObj->setSurname($this->getSurname());
		$copyObj->setCategoryid($this->getCategoryid());
		$copyObj->setActive($this->getActive());
		$copyObj->setStrategy($this->getStrategy());
		$copyObj->setTactic($this->getTactic());
		$copyObj->setComments($this->getComments());
		$copyObj->setObservations($this->getObservations());
		$copyObj->setDeletedAt($this->getDeletedAt());
		$copyObj->setCreatedAt($this->getCreatedAt());
		$copyObj->setUpdatedAt($this->getUpdatedAt());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getHierarchys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHierarchy($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRelationshipsRelatedByActor1id() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRelationshipRelatedByActor1id($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRelationshipsRelatedByActor2id() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRelationshipRelatedByActor2id($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getActorActiveQuestions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addActorActiveQuestion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRelationshipActiveQuestionsRelatedByActor1id() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRelationshipActiveQuestionRelatedByActor1id($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRelationshipActiveQuestionsRelatedByActor2id() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRelationshipActiveQuestionRelatedByActor2id($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAnswers() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAnswer($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphActors() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphActor($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphRelationsRelatedByActor1id() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphRelationRelatedByActor1id($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphRelationsRelatedByActor2id() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphRelationRelatedByActor2id($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getJudgementActor();
			if ($relObj) {
				$copyObj->setJudgementActor($relObj->copy($deepCopy));
			}

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
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Actor Clone of current object.
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
	 * @return     ActorPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ActorPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Category object.
	 *
	 * @param      Category $v
	 * @return     Actor The current object (for fluent API support)
	 * @throws     PropelException
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
			$v->addActor($this);
		}

		return $this;
	}


	/**
	 * Get the associated Category object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Category The associated Category object.
	 * @throws     PropelException
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
				$this->aCategory->addActors($this);
			 */
		}
		return $this->aCategory;
	}

	/**
	 * Clears out the collHierarchys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addHierarchys()
	 */
	public function clearHierarchys()
	{
		$this->collHierarchys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collHierarchys collection.
	 *
	 * By default this just sets the collHierarchys collection to an empty array (like clearcollHierarchys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initHierarchys($overrideExisting = true)
	{
		if (null !== $this->collHierarchys && !$overrideExisting) {
			return;
		}
		$this->collHierarchys = new PropelObjectCollection();
		$this->collHierarchys->setModel('Hierarchy');
	}

	/**
	 * Gets an array of Hierarchy objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Hierarchy[] List of Hierarchy objects
	 * @throws     PropelException
	 */
	public function getHierarchys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collHierarchys || null !== $criteria) {
			if ($this->isNew() && null === $this->collHierarchys) {
				// return empty collection
				$this->initHierarchys();
			} else {
				$collHierarchys = HierarchyQuery::create(null, $criteria)
					->filterByActor($this)
					->find($con);
				if (null !== $criteria) {
					return $collHierarchys;
				}
				$this->collHierarchys = $collHierarchys;
			}
		}
		return $this->collHierarchys;
	}

	/**
	 * Returns the number of related Hierarchy objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Hierarchy objects.
	 * @throws     PropelException
	 */
	public function countHierarchys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collHierarchys || null !== $criteria) {
			if ($this->isNew() && null === $this->collHierarchys) {
				return 0;
			} else {
				$query = HierarchyQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActor($this)
					->count($con);
			}
		} else {
			return count($this->collHierarchys);
		}
	}

	/**
	 * Method called to associate a Hierarchy object to this object
	 * through the Hierarchy foreign key attribute.
	 *
	 * @param      Hierarchy $l Hierarchy
	 * @return     void
	 * @throws     PropelException
	 */
	public function addHierarchy(Hierarchy $l)
	{
		if ($this->collHierarchys === null) {
			$this->initHierarchys();
		}
		if (!$this->collHierarchys->contains($l)) { // only add it if the **same** object is not already associated
			$this->collHierarchys[]= $l;
			$l->setActor($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related Hierarchys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Hierarchy[] List of Hierarchy objects
	 */
	public function getHierarchysJoinCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = HierarchyQuery::create(null, $criteria);
		$query->joinWith('Category', $join_behavior);

		return $this->getHierarchys($query, $con);
	}

	/**
	 * Clears out the collRelationshipsRelatedByActor1id collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRelationshipsRelatedByActor1id()
	 */
	public function clearRelationshipsRelatedByActor1id()
	{
		$this->collRelationshipsRelatedByActor1id = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRelationshipsRelatedByActor1id collection.
	 *
	 * By default this just sets the collRelationshipsRelatedByActor1id collection to an empty array (like clearcollRelationshipsRelatedByActor1id());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRelationshipsRelatedByActor1id($overrideExisting = true)
	{
		if (null !== $this->collRelationshipsRelatedByActor1id && !$overrideExisting) {
			return;
		}
		$this->collRelationshipsRelatedByActor1id = new PropelObjectCollection();
		$this->collRelationshipsRelatedByActor1id->setModel('Relationship');
	}

	/**
	 * Gets an array of Relationship objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 * @throws     PropelException
	 */
	public function getRelationshipsRelatedByActor1id($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipsRelatedByActor1id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipsRelatedByActor1id) {
				// return empty collection
				$this->initRelationshipsRelatedByActor1id();
			} else {
				$collRelationshipsRelatedByActor1id = RelationshipQuery::create(null, $criteria)
					->filterByActorRelatedByActor1id($this)
					->find($con);
				if (null !== $criteria) {
					return $collRelationshipsRelatedByActor1id;
				}
				$this->collRelationshipsRelatedByActor1id = $collRelationshipsRelatedByActor1id;
			}
		}
		return $this->collRelationshipsRelatedByActor1id;
	}

	/**
	 * Returns the number of related Relationship objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Relationship objects.
	 * @throws     PropelException
	 */
	public function countRelationshipsRelatedByActor1id(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipsRelatedByActor1id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipsRelatedByActor1id) {
				return 0;
			} else {
				$query = RelationshipQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActorRelatedByActor1id($this)
					->count($con);
			}
		} else {
			return count($this->collRelationshipsRelatedByActor1id);
		}
	}

	/**
	 * Method called to associate a Relationship object to this object
	 * through the Relationship foreign key attribute.
	 *
	 * @param      Relationship $l Relationship
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationshipRelatedByActor1id(Relationship $l)
	{
		if ($this->collRelationshipsRelatedByActor1id === null) {
			$this->initRelationshipsRelatedByActor1id();
		}
		if (!$this->collRelationshipsRelatedByActor1id->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRelationshipsRelatedByActor1id[]= $l;
			$l->setActorRelatedByActor1id($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related RelationshipsRelatedByActor1id from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 */
	public function getRelationshipsRelatedByActor1idJoinQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipQuery::create(null, $criteria);
		$query->joinWith('Question', $join_behavior);

		return $this->getRelationshipsRelatedByActor1id($query, $con);
	}

	/**
	 * Clears out the collRelationshipsRelatedByActor2id collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRelationshipsRelatedByActor2id()
	 */
	public function clearRelationshipsRelatedByActor2id()
	{
		$this->collRelationshipsRelatedByActor2id = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRelationshipsRelatedByActor2id collection.
	 *
	 * By default this just sets the collRelationshipsRelatedByActor2id collection to an empty array (like clearcollRelationshipsRelatedByActor2id());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRelationshipsRelatedByActor2id($overrideExisting = true)
	{
		if (null !== $this->collRelationshipsRelatedByActor2id && !$overrideExisting) {
			return;
		}
		$this->collRelationshipsRelatedByActor2id = new PropelObjectCollection();
		$this->collRelationshipsRelatedByActor2id->setModel('Relationship');
	}

	/**
	 * Gets an array of Relationship objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 * @throws     PropelException
	 */
	public function getRelationshipsRelatedByActor2id($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipsRelatedByActor2id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipsRelatedByActor2id) {
				// return empty collection
				$this->initRelationshipsRelatedByActor2id();
			} else {
				$collRelationshipsRelatedByActor2id = RelationshipQuery::create(null, $criteria)
					->filterByActorRelatedByActor2id($this)
					->find($con);
				if (null !== $criteria) {
					return $collRelationshipsRelatedByActor2id;
				}
				$this->collRelationshipsRelatedByActor2id = $collRelationshipsRelatedByActor2id;
			}
		}
		return $this->collRelationshipsRelatedByActor2id;
	}

	/**
	 * Returns the number of related Relationship objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Relationship objects.
	 * @throws     PropelException
	 */
	public function countRelationshipsRelatedByActor2id(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipsRelatedByActor2id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipsRelatedByActor2id) {
				return 0;
			} else {
				$query = RelationshipQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActorRelatedByActor2id($this)
					->count($con);
			}
		} else {
			return count($this->collRelationshipsRelatedByActor2id);
		}
	}

	/**
	 * Method called to associate a Relationship object to this object
	 * through the Relationship foreign key attribute.
	 *
	 * @param      Relationship $l Relationship
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationshipRelatedByActor2id(Relationship $l)
	{
		if ($this->collRelationshipsRelatedByActor2id === null) {
			$this->initRelationshipsRelatedByActor2id();
		}
		if (!$this->collRelationshipsRelatedByActor2id->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRelationshipsRelatedByActor2id[]= $l;
			$l->setActorRelatedByActor2id($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related RelationshipsRelatedByActor2id from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 */
	public function getRelationshipsRelatedByActor2idJoinQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipQuery::create(null, $criteria);
		$query->joinWith('Question', $join_behavior);

		return $this->getRelationshipsRelatedByActor2id($query, $con);
	}

	/**
	 * Clears out the collActorActiveQuestions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addActorActiveQuestions()
	 */
	public function clearActorActiveQuestions()
	{
		$this->collActorActiveQuestions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collActorActiveQuestions collection.
	 *
	 * By default this just sets the collActorActiveQuestions collection to an empty array (like clearcollActorActiveQuestions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initActorActiveQuestions($overrideExisting = true)
	{
		if (null !== $this->collActorActiveQuestions && !$overrideExisting) {
			return;
		}
		$this->collActorActiveQuestions = new PropelObjectCollection();
		$this->collActorActiveQuestions->setModel('ActorActiveQuestion');
	}

	/**
	 * Gets an array of ActorActiveQuestion objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ActorActiveQuestion[] List of ActorActiveQuestion objects
	 * @throws     PropelException
	 */
	public function getActorActiveQuestions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collActorActiveQuestions || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorActiveQuestions) {
				// return empty collection
				$this->initActorActiveQuestions();
			} else {
				$collActorActiveQuestions = ActorActiveQuestionQuery::create(null, $criteria)
					->filterByActor($this)
					->find($con);
				if (null !== $criteria) {
					return $collActorActiveQuestions;
				}
				$this->collActorActiveQuestions = $collActorActiveQuestions;
			}
		}
		return $this->collActorActiveQuestions;
	}

	/**
	 * Returns the number of related ActorActiveQuestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ActorActiveQuestion objects.
	 * @throws     PropelException
	 */
	public function countActorActiveQuestions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collActorActiveQuestions || null !== $criteria) {
			if ($this->isNew() && null === $this->collActorActiveQuestions) {
				return 0;
			} else {
				$query = ActorActiveQuestionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActor($this)
					->count($con);
			}
		} else {
			return count($this->collActorActiveQuestions);
		}
	}

	/**
	 * Method called to associate a ActorActiveQuestion object to this object
	 * through the ActorActiveQuestion foreign key attribute.
	 *
	 * @param      ActorActiveQuestion $l ActorActiveQuestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addActorActiveQuestion(ActorActiveQuestion $l)
	{
		if ($this->collActorActiveQuestions === null) {
			$this->initActorActiveQuestions();
		}
		if (!$this->collActorActiveQuestions->contains($l)) { // only add it if the **same** object is not already associated
			$this->collActorActiveQuestions[]= $l;
			$l->setActor($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related ActorActiveQuestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ActorActiveQuestion[] List of ActorActiveQuestion objects
	 */
	public function getActorActiveQuestionsJoinQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ActorActiveQuestionQuery::create(null, $criteria);
		$query->joinWith('Question', $join_behavior);

		return $this->getActorActiveQuestions($query, $con);
	}

	/**
	 * Clears out the collRelationshipActiveQuestionsRelatedByActor1id collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRelationshipActiveQuestionsRelatedByActor1id()
	 */
	public function clearRelationshipActiveQuestionsRelatedByActor1id()
	{
		$this->collRelationshipActiveQuestionsRelatedByActor1id = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRelationshipActiveQuestionsRelatedByActor1id collection.
	 *
	 * By default this just sets the collRelationshipActiveQuestionsRelatedByActor1id collection to an empty array (like clearcollRelationshipActiveQuestionsRelatedByActor1id());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRelationshipActiveQuestionsRelatedByActor1id($overrideExisting = true)
	{
		if (null !== $this->collRelationshipActiveQuestionsRelatedByActor1id && !$overrideExisting) {
			return;
		}
		$this->collRelationshipActiveQuestionsRelatedByActor1id = new PropelObjectCollection();
		$this->collRelationshipActiveQuestionsRelatedByActor1id->setModel('RelationshipActiveQuestion');
	}

	/**
	 * Gets an array of RelationshipActiveQuestion objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 * @throws     PropelException
	 */
	public function getRelationshipActiveQuestionsRelatedByActor1id($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipActiveQuestionsRelatedByActor1id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipActiveQuestionsRelatedByActor1id) {
				// return empty collection
				$this->initRelationshipActiveQuestionsRelatedByActor1id();
			} else {
				$collRelationshipActiveQuestionsRelatedByActor1id = RelationshipActiveQuestionQuery::create(null, $criteria)
					->filterByActorRelatedByActor1id($this)
					->find($con);
				if (null !== $criteria) {
					return $collRelationshipActiveQuestionsRelatedByActor1id;
				}
				$this->collRelationshipActiveQuestionsRelatedByActor1id = $collRelationshipActiveQuestionsRelatedByActor1id;
			}
		}
		return $this->collRelationshipActiveQuestionsRelatedByActor1id;
	}

	/**
	 * Returns the number of related RelationshipActiveQuestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RelationshipActiveQuestion objects.
	 * @throws     PropelException
	 */
	public function countRelationshipActiveQuestionsRelatedByActor1id(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipActiveQuestionsRelatedByActor1id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipActiveQuestionsRelatedByActor1id) {
				return 0;
			} else {
				$query = RelationshipActiveQuestionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActorRelatedByActor1id($this)
					->count($con);
			}
		} else {
			return count($this->collRelationshipActiveQuestionsRelatedByActor1id);
		}
	}

	/**
	 * Method called to associate a RelationshipActiveQuestion object to this object
	 * through the RelationshipActiveQuestion foreign key attribute.
	 *
	 * @param      RelationshipActiveQuestion $l RelationshipActiveQuestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationshipActiveQuestionRelatedByActor1id(RelationshipActiveQuestion $l)
	{
		if ($this->collRelationshipActiveQuestionsRelatedByActor1id === null) {
			$this->initRelationshipActiveQuestionsRelatedByActor1id();
		}
		if (!$this->collRelationshipActiveQuestionsRelatedByActor1id->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRelationshipActiveQuestionsRelatedByActor1id[]= $l;
			$l->setActorRelatedByActor1id($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related RelationshipActiveQuestionsRelatedByActor1id from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 */
	public function getRelationshipActiveQuestionsRelatedByActor1idJoinQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipActiveQuestionQuery::create(null, $criteria);
		$query->joinWith('Question', $join_behavior);

		return $this->getRelationshipActiveQuestionsRelatedByActor1id($query, $con);
	}

	/**
	 * Clears out the collRelationshipActiveQuestionsRelatedByActor2id collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRelationshipActiveQuestionsRelatedByActor2id()
	 */
	public function clearRelationshipActiveQuestionsRelatedByActor2id()
	{
		$this->collRelationshipActiveQuestionsRelatedByActor2id = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRelationshipActiveQuestionsRelatedByActor2id collection.
	 *
	 * By default this just sets the collRelationshipActiveQuestionsRelatedByActor2id collection to an empty array (like clearcollRelationshipActiveQuestionsRelatedByActor2id());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRelationshipActiveQuestionsRelatedByActor2id($overrideExisting = true)
	{
		if (null !== $this->collRelationshipActiveQuestionsRelatedByActor2id && !$overrideExisting) {
			return;
		}
		$this->collRelationshipActiveQuestionsRelatedByActor2id = new PropelObjectCollection();
		$this->collRelationshipActiveQuestionsRelatedByActor2id->setModel('RelationshipActiveQuestion');
	}

	/**
	 * Gets an array of RelationshipActiveQuestion objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 * @throws     PropelException
	 */
	public function getRelationshipActiveQuestionsRelatedByActor2id($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipActiveQuestionsRelatedByActor2id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipActiveQuestionsRelatedByActor2id) {
				// return empty collection
				$this->initRelationshipActiveQuestionsRelatedByActor2id();
			} else {
				$collRelationshipActiveQuestionsRelatedByActor2id = RelationshipActiveQuestionQuery::create(null, $criteria)
					->filterByActorRelatedByActor2id($this)
					->find($con);
				if (null !== $criteria) {
					return $collRelationshipActiveQuestionsRelatedByActor2id;
				}
				$this->collRelationshipActiveQuestionsRelatedByActor2id = $collRelationshipActiveQuestionsRelatedByActor2id;
			}
		}
		return $this->collRelationshipActiveQuestionsRelatedByActor2id;
	}

	/**
	 * Returns the number of related RelationshipActiveQuestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related RelationshipActiveQuestion objects.
	 * @throws     PropelException
	 */
	public function countRelationshipActiveQuestionsRelatedByActor2id(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipActiveQuestionsRelatedByActor2id || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipActiveQuestionsRelatedByActor2id) {
				return 0;
			} else {
				$query = RelationshipActiveQuestionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActorRelatedByActor2id($this)
					->count($con);
			}
		} else {
			return count($this->collRelationshipActiveQuestionsRelatedByActor2id);
		}
	}

	/**
	 * Method called to associate a RelationshipActiveQuestion object to this object
	 * through the RelationshipActiveQuestion foreign key attribute.
	 *
	 * @param      RelationshipActiveQuestion $l RelationshipActiveQuestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationshipActiveQuestionRelatedByActor2id(RelationshipActiveQuestion $l)
	{
		if ($this->collRelationshipActiveQuestionsRelatedByActor2id === null) {
			$this->initRelationshipActiveQuestionsRelatedByActor2id();
		}
		if (!$this->collRelationshipActiveQuestionsRelatedByActor2id->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRelationshipActiveQuestionsRelatedByActor2id[]= $l;
			$l->setActorRelatedByActor2id($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related RelationshipActiveQuestionsRelatedByActor2id from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 */
	public function getRelationshipActiveQuestionsRelatedByActor2idJoinQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipActiveQuestionQuery::create(null, $criteria);
		$query->joinWith('Question', $join_behavior);

		return $this->getRelationshipActiveQuestionsRelatedByActor2id($query, $con);
	}

	/**
	 * Clears out the collAnswers collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addAnswers()
	 */
	public function clearAnswers()
	{
		$this->collAnswers = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collAnswers collection.
	 *
	 * By default this just sets the collAnswers collection to an empty array (like clearcollAnswers());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initAnswers($overrideExisting = true)
	{
		if (null !== $this->collAnswers && !$overrideExisting) {
			return;
		}
		$this->collAnswers = new PropelObjectCollection();
		$this->collAnswers->setModel('Answer');
	}

	/**
	 * Gets an array of Answer objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Answer[] List of Answer objects
	 * @throws     PropelException
	 */
	public function getAnswers($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collAnswers || null !== $criteria) {
			if ($this->isNew() && null === $this->collAnswers) {
				// return empty collection
				$this->initAnswers();
			} else {
				$collAnswers = AnswerQuery::create(null, $criteria)
					->filterByActor($this)
					->find($con);
				if (null !== $criteria) {
					return $collAnswers;
				}
				$this->collAnswers = $collAnswers;
			}
		}
		return $this->collAnswers;
	}

	/**
	 * Returns the number of related Answer objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Answer objects.
	 * @throws     PropelException
	 */
	public function countAnswers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collAnswers || null !== $criteria) {
			if ($this->isNew() && null === $this->collAnswers) {
				return 0;
			} else {
				$query = AnswerQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActor($this)
					->count($con);
			}
		} else {
			return count($this->collAnswers);
		}
	}

	/**
	 * Method called to associate a Answer object to this object
	 * through the Answer foreign key attribute.
	 *
	 * @param      Answer $l Answer
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAnswer(Answer $l)
	{
		if ($this->collAnswers === null) {
			$this->initAnswers();
		}
		if (!$this->collAnswers->contains($l)) { // only add it if the **same** object is not already associated
			$this->collAnswers[]= $l;
			$l->setActor($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related Answers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Answer[] List of Answer objects
	 */
	public function getAnswersJoinQuestion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = AnswerQuery::create(null, $criteria);
		$query->joinWith('Question', $join_behavior);

		return $this->getAnswers($query, $con);
	}

	/**
	 * Clears out the collGraphActors collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGraphActors()
	 */
	public function clearGraphActors()
	{
		$this->collGraphActors = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGraphActors collection.
	 *
	 * By default this just sets the collGraphActors collection to an empty array (like clearcollGraphActors());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGraphActors($overrideExisting = true)
	{
		if (null !== $this->collGraphActors && !$overrideExisting) {
			return;
		}
		$this->collGraphActors = new PropelObjectCollection();
		$this->collGraphActors->setModel('GraphActor');
	}

	/**
	 * Gets an array of GraphActor objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GraphActor[] List of GraphActor objects
	 * @throws     PropelException
	 */
	public function getGraphActors($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGraphActors || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphActors) {
				// return empty collection
				$this->initGraphActors();
			} else {
				$collGraphActors = GraphActorQuery::create(null, $criteria)
					->filterByActor($this)
					->find($con);
				if (null !== $criteria) {
					return $collGraphActors;
				}
				$this->collGraphActors = $collGraphActors;
			}
		}
		return $this->collGraphActors;
	}

	/**
	 * Returns the number of related GraphActor objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GraphActor objects.
	 * @throws     PropelException
	 */
	public function countGraphActors(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGraphActors || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphActors) {
				return 0;
			} else {
				$query = GraphActorQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActor($this)
					->count($con);
			}
		} else {
			return count($this->collGraphActors);
		}
	}

	/**
	 * Method called to associate a GraphActor object to this object
	 * through the GraphActor foreign key attribute.
	 *
	 * @param      GraphActor $l GraphActor
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGraphActor(GraphActor $l)
	{
		if ($this->collGraphActors === null) {
			$this->initGraphActors();
		}
		if (!$this->collGraphActors->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGraphActors[]= $l;
			$l->setActor($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related GraphActors from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GraphActor[] List of GraphActor objects
	 */
	public function getGraphActorsJoinGraphModel($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GraphActorQuery::create(null, $criteria);
		$query->joinWith('GraphModel', $join_behavior);

		return $this->getGraphActors($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Actor is new, it will return
	 * an empty collection; or if this Actor has previously
	 * been saved, it will retrieve related GraphActors from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Actor.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GraphActor[] List of GraphActor objects
	 */
	public function getGraphActorsJoinCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GraphActorQuery::create(null, $criteria);
		$query->joinWith('Category', $join_behavior);

		return $this->getGraphActors($query, $con);
	}

	/**
	 * Clears out the collGraphRelationsRelatedByActor1id collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGraphRelationsRelatedByActor1id()
	 */
	public function clearGraphRelationsRelatedByActor1id()
	{
		$this->collGraphRelationsRelatedByActor1id = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGraphRelationsRelatedByActor1id collection.
	 *
	 * By default this just sets the collGraphRelationsRelatedByActor1id collection to an empty array (like clearcollGraphRelationsRelatedByActor1id());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGraphRelationsRelatedByActor1id($overrideExisting = true)
	{
		if (null !== $this->collGraphRelationsRelatedByActor1id && !$overrideExisting) {
			return;
		}
		$this->collGraphRelationsRelatedByActor1id = new PropelObjectCollection();
		$this->collGraphRelationsRelatedByActor1id->setModel('GraphRelation');
	}

	/**
	 * Gets an array of GraphRelation objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GraphRelation[] List of GraphRelation objects
	 * @throws     PropelException
	 */
	public function getGraphRelationsRelatedByActor1id($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGraphRelationsRelatedByActor1id || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphRelationsRelatedByActor1id) {
				// return empty collection
				$this->initGraphRelationsRelatedByActor1id();
			} else {
				$collGraphRelationsRelatedByActor1id = GraphRelationQuery::create(null, $criteria)
					->filterByActorRelatedByActor1id($this)
					->find($con);
				if (null !== $criteria) {
					return $collGraphRelationsRelatedByActor1id;
				}
				$this->collGraphRelationsRelatedByActor1id = $collGraphRelationsRelatedByActor1id;
			}
		}
		return $this->collGraphRelationsRelatedByActor1id;
	}

	/**
	 * Returns the number of related GraphRelation objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GraphRelation objects.
	 * @throws     PropelException
	 */
	public function countGraphRelationsRelatedByActor1id(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGraphRelationsRelatedByActor1id || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphRelationsRelatedByActor1id) {
				return 0;
			} else {
				$query = GraphRelationQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActorRelatedByActor1id($this)
					->count($con);
			}
		} else {
			return count($this->collGraphRelationsRelatedByActor1id);
		}
	}

	/**
	 * Method called to associate a GraphRelation object to this object
	 * through the GraphRelation foreign key attribute.
	 *
	 * @param      GraphRelation $l GraphRelation
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGraphRelationRelatedByActor1id(GraphRelation $l)
	{
		if ($this->collGraphRelationsRelatedByActor1id === null) {
			$this->initGraphRelationsRelatedByActor1id();
		}
		if (!$this->collGraphRelationsRelatedByActor1id->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGraphRelationsRelatedByActor1id[]= $l;
			$l->setActorRelatedByActor1id($this);
		}
	}

	/**
	 * Clears out the collGraphRelationsRelatedByActor2id collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGraphRelationsRelatedByActor2id()
	 */
	public function clearGraphRelationsRelatedByActor2id()
	{
		$this->collGraphRelationsRelatedByActor2id = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGraphRelationsRelatedByActor2id collection.
	 *
	 * By default this just sets the collGraphRelationsRelatedByActor2id collection to an empty array (like clearcollGraphRelationsRelatedByActor2id());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGraphRelationsRelatedByActor2id($overrideExisting = true)
	{
		if (null !== $this->collGraphRelationsRelatedByActor2id && !$overrideExisting) {
			return;
		}
		$this->collGraphRelationsRelatedByActor2id = new PropelObjectCollection();
		$this->collGraphRelationsRelatedByActor2id->setModel('GraphRelation');
	}

	/**
	 * Gets an array of GraphRelation objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Actor is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GraphRelation[] List of GraphRelation objects
	 * @throws     PropelException
	 */
	public function getGraphRelationsRelatedByActor2id($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGraphRelationsRelatedByActor2id || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphRelationsRelatedByActor2id) {
				// return empty collection
				$this->initGraphRelationsRelatedByActor2id();
			} else {
				$collGraphRelationsRelatedByActor2id = GraphRelationQuery::create(null, $criteria)
					->filterByActorRelatedByActor2id($this)
					->find($con);
				if (null !== $criteria) {
					return $collGraphRelationsRelatedByActor2id;
				}
				$this->collGraphRelationsRelatedByActor2id = $collGraphRelationsRelatedByActor2id;
			}
		}
		return $this->collGraphRelationsRelatedByActor2id;
	}

	/**
	 * Returns the number of related GraphRelation objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GraphRelation objects.
	 * @throws     PropelException
	 */
	public function countGraphRelationsRelatedByActor2id(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGraphRelationsRelatedByActor2id || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphRelationsRelatedByActor2id) {
				return 0;
			} else {
				$query = GraphRelationQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByActorRelatedByActor2id($this)
					->count($con);
			}
		} else {
			return count($this->collGraphRelationsRelatedByActor2id);
		}
	}

	/**
	 * Method called to associate a GraphRelation object to this object
	 * through the GraphRelation foreign key attribute.
	 *
	 * @param      GraphRelation $l GraphRelation
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGraphRelationRelatedByActor2id(GraphRelation $l)
	{
		if ($this->collGraphRelationsRelatedByActor2id === null) {
			$this->initGraphRelationsRelatedByActor2id();
		}
		if (!$this->collGraphRelationsRelatedByActor2id->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGraphRelationsRelatedByActor2id[]= $l;
			$l->setActorRelatedByActor2id($this);
		}
	}

	/**
	 * Gets a single JudgementActor object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     JudgementActor
	 * @throws     PropelException
	 */
	public function getJudgementActor(PropelPDO $con = null)
	{

		if ($this->singleJudgementActor === null && !$this->isNew()) {
			$this->singleJudgementActor = JudgementActorQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleJudgementActor;
	}

	/**
	 * Sets a single JudgementActor object as related to this object by a one-to-one relationship.
	 *
	 * @param      JudgementActor $v JudgementActor
	 * @return     Actor The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setJudgementActor(JudgementActor $v = null)
	{
		$this->singleJudgementActor = $v;

		// Make sure that that the passed-in JudgementActor isn't already associated with this object
		if ($v !== null && $v->getActor() === null) {
			$v->setActor($this);
		}

		return $this;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->title = null;
		$this->name = null;
		$this->surname = null;
		$this->categoryid = null;
		$this->active = null;
		$this->strategy = null;
		$this->tactic = null;
		$this->comments = null;
		$this->observations = null;
		$this->deleted_at = null;
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
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHierarchys) {
				foreach ($this->collHierarchys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationshipsRelatedByActor1id) {
				foreach ($this->collRelationshipsRelatedByActor1id as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationshipsRelatedByActor2id) {
				foreach ($this->collRelationshipsRelatedByActor2id as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collActorActiveQuestions) {
				foreach ($this->collActorActiveQuestions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationshipActiveQuestionsRelatedByActor1id) {
				foreach ($this->collRelationshipActiveQuestionsRelatedByActor1id as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationshipActiveQuestionsRelatedByActor2id) {
				foreach ($this->collRelationshipActiveQuestionsRelatedByActor2id as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAnswers) {
				foreach ($this->collAnswers as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphActors) {
				foreach ($this->collGraphActors as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphRelationsRelatedByActor1id) {
				foreach ($this->collGraphRelationsRelatedByActor1id as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphRelationsRelatedByActor2id) {
				foreach ($this->collGraphRelationsRelatedByActor2id as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleJudgementActor) {
				$this->singleJudgementActor->clearAllReferences($deep);
			}
		} // if ($deep)

		if ($this->collHierarchys instanceof PropelCollection) {
			$this->collHierarchys->clearIterator();
		}
		$this->collHierarchys = null;
		if ($this->collRelationshipsRelatedByActor1id instanceof PropelCollection) {
			$this->collRelationshipsRelatedByActor1id->clearIterator();
		}
		$this->collRelationshipsRelatedByActor1id = null;
		if ($this->collRelationshipsRelatedByActor2id instanceof PropelCollection) {
			$this->collRelationshipsRelatedByActor2id->clearIterator();
		}
		$this->collRelationshipsRelatedByActor2id = null;
		if ($this->collActorActiveQuestions instanceof PropelCollection) {
			$this->collActorActiveQuestions->clearIterator();
		}
		$this->collActorActiveQuestions = null;
		if ($this->collRelationshipActiveQuestionsRelatedByActor1id instanceof PropelCollection) {
			$this->collRelationshipActiveQuestionsRelatedByActor1id->clearIterator();
		}
		$this->collRelationshipActiveQuestionsRelatedByActor1id = null;
		if ($this->collRelationshipActiveQuestionsRelatedByActor2id instanceof PropelCollection) {
			$this->collRelationshipActiveQuestionsRelatedByActor2id->clearIterator();
		}
		$this->collRelationshipActiveQuestionsRelatedByActor2id = null;
		if ($this->collAnswers instanceof PropelCollection) {
			$this->collAnswers->clearIterator();
		}
		$this->collAnswers = null;
		if ($this->collGraphActors instanceof PropelCollection) {
			$this->collGraphActors->clearIterator();
		}
		$this->collGraphActors = null;
		if ($this->collGraphRelationsRelatedByActor1id instanceof PropelCollection) {
			$this->collGraphRelationsRelatedByActor1id->clearIterator();
		}
		$this->collGraphRelationsRelatedByActor1id = null;
		if ($this->collGraphRelationsRelatedByActor2id instanceof PropelCollection) {
			$this->collGraphRelationsRelatedByActor2id->clearIterator();
		}
		$this->collGraphRelationsRelatedByActor2id = null;
		if ($this->singleJudgementActor instanceof PropelCollection) {
			$this->singleJudgementActor->clearIterator();
		}
		$this->singleJudgementActor = null;
		$this->aCategory = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ActorPeer::DEFAULT_STRING_FORMAT);
	}

	// soft_delete behavior
	
	/**
	 * Bypass the soft_delete behavior and force a hard delete of the current object
	 */
	public function forceDelete(PropelPDO $con = null)
	{
		ActorPeer::disableSoftDelete();
		$this->delete($con);
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

	// timestampable behavior
	
	/**
	 * Mark the current object so that the update date doesn't get updated during next save
	 *
	 * @return     Actor The current object (for fluent API support)
	 */
	public function keepUpdateDateUnchanged()
	{
		$this->modifiedColumns[] = ActorPeer::UPDATED_AT;
		return $this;
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

} // BaseActor
