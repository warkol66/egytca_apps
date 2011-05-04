<?php


/**
 * Base class that represents a row from the 'MER_formSectionQuestion' table.
 *
 * 
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseQuestion extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'QuestionPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        QuestionPeer
	 */
	protected static $peer;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the sectionid field.
	 * @var        int
	 */
	protected $sectionid;

	/**
	 * The value for the type field.
	 * @var        int
	 */
	protected $type;

	/**
	 * The value for the question field.
	 * @var        string
	 */
	protected $question;

	/**
	 * The value for the position field.
	 * @var        int
	 */
	protected $position;

	/**
	 * The value for the unit field.
	 * @var        string
	 */
	protected $unit;

	/**
	 * The value for the analysis field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $analysis;

	/**
	 * The value for the label field.
	 * @var        string
	 */
	protected $label;

	/**
	 * @var        FormSection
	 */
	protected $aFormSection;

	/**
	 * @var        array QuestionOption[] Collection to store aggregation of QuestionOption objects.
	 */
	protected $collQuestionOptions;

	/**
	 * @var        array Relationship[] Collection to store aggregation of Relationship objects.
	 */
	protected $collRelationships;

	/**
	 * @var        array ActorActiveQuestion[] Collection to store aggregation of ActorActiveQuestion objects.
	 */
	protected $collActorActiveQuestions;

	/**
	 * @var        array RelationshipActiveQuestion[] Collection to store aggregation of RelationshipActiveQuestion objects.
	 */
	protected $collRelationshipActiveQuestions;

	/**
	 * @var        array Answer[] Collection to store aggregation of Answer objects.
	 */
	protected $collAnswers;

	/**
	 * @var        array GraphModelAxis[] Collection to store aggregation of GraphModelAxis objects.
	 */
	protected $collGraphModelAxiss;

	/**
	 * @var        array GraphRelationQuestion[] Collection to store aggregation of GraphRelationQuestion objects.
	 */
	protected $collGraphRelationQuestions;

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
		$this->analysis = false;
	}

	/**
	 * Initializes internal state of BaseQuestion object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [sectionid] column value.
	 * 
	 * @return     int
	 */
	public function getSectionid()
	{
		return $this->sectionid;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return     int
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get the [question] column value.
	 * 
	 * @return     string
	 */
	public function getQuestion()
	{
		return $this->question;
	}

	/**
	 * Get the [position] column value.
	 * 
	 * @return     int
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * Get the [unit] column value.
	 * 
	 * @return     string
	 */
	public function getUnit()
	{
		return $this->unit;
	}

	/**
	 * Get the [analysis] column value.
	 * Aparece la pregunta en analysis?
	 * @return     boolean
	 */
	public function getAnalysis()
	{
		return $this->analysis;
	}

	/**
	 * Get the [label] column value.
	 * Label de la pregunta
	 * @return     string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = QuestionPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [sectionid] column.
	 * 
	 * @param      int $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setSectionid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->sectionid !== $v) {
			$this->sectionid = $v;
			$this->modifiedColumns[] = QuestionPeer::SECTIONID;
		}

		if ($this->aFormSection !== null && $this->aFormSection->getId() !== $v) {
			$this->aFormSection = null;
		}

		return $this;
	} // setSectionid()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      int $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = QuestionPeer::TYPE;
		}

		return $this;
	} // setType()

	/**
	 * Set the value of [question] column.
	 * 
	 * @param      string $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setQuestion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->question !== $v) {
			$this->question = $v;
			$this->modifiedColumns[] = QuestionPeer::QUESTION;
		}

		return $this;
	} // setQuestion()

	/**
	 * Set the value of [position] column.
	 * 
	 * @param      int $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setPosition($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->position !== $v) {
			$this->position = $v;
			$this->modifiedColumns[] = QuestionPeer::POSITION;
		}

		return $this;
	} // setPosition()

	/**
	 * Set the value of [unit] column.
	 * 
	 * @param      string $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setUnit($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->unit !== $v) {
			$this->unit = $v;
			$this->modifiedColumns[] = QuestionPeer::UNIT;
		}

		return $this;
	} // setUnit()

	/**
	 * Sets the value of the [analysis] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Aparece la pregunta en analysis?
	 * @param      boolean|integer|string $v The new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setAnalysis($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->analysis !== $v || $this->isNew()) {
			$this->analysis = $v;
			$this->modifiedColumns[] = QuestionPeer::ANALYSIS;
		}

		return $this;
	} // setAnalysis()

	/**
	 * Set the value of [label] column.
	 * Label de la pregunta
	 * @param      string $v new value
	 * @return     Question The current object (for fluent API support)
	 */
	public function setLabel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = QuestionPeer::LABEL;
		}

		return $this;
	} // setLabel()

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
			if ($this->analysis !== false) {
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
			$this->sectionid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->type = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->question = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->position = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->unit = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->analysis = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->label = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = QuestionPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Question object", $e);
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

		if ($this->aFormSection !== null && $this->sectionid !== $this->aFormSection->getId()) {
			$this->aFormSection = null;
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
			$con = Propel::getConnection(QuestionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = QuestionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aFormSection = null;
			$this->collQuestionOptions = null;

			$this->collRelationships = null;

			$this->collActorActiveQuestions = null;

			$this->collRelationshipActiveQuestions = null;

			$this->collAnswers = null;

			$this->collGraphModelAxiss = null;

			$this->collGraphRelationQuestions = null;

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
			$con = Propel::getConnection(QuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				QuestionQuery::create()
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
			$con = Propel::getConnection(QuestionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				QuestionPeer::addInstanceToPool($this);
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

			if ($this->aFormSection !== null) {
				if ($this->aFormSection->isModified() || $this->aFormSection->isNew()) {
					$affectedRows += $this->aFormSection->save($con);
				}
				$this->setFormSection($this->aFormSection);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = QuestionPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(QuestionPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.QuestionPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows += QuestionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collQuestionOptions !== null) {
				foreach ($this->collQuestionOptions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationships !== null) {
				foreach ($this->collRelationships as $referrerFK) {
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

			if ($this->collRelationshipActiveQuestions !== null) {
				foreach ($this->collRelationshipActiveQuestions as $referrerFK) {
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

			if ($this->collGraphModelAxiss !== null) {
				foreach ($this->collGraphModelAxiss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGraphRelationQuestions !== null) {
				foreach ($this->collGraphRelationQuestions as $referrerFK) {
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

			if ($this->aFormSection !== null) {
				if (!$this->aFormSection->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFormSection->getValidationFailures());
				}
			}


			if (($retval = QuestionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collQuestionOptions !== null) {
					foreach ($this->collQuestionOptions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationships !== null) {
					foreach ($this->collRelationships as $referrerFK) {
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

				if ($this->collRelationshipActiveQuestions !== null) {
					foreach ($this->collRelationshipActiveQuestions as $referrerFK) {
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

				if ($this->collGraphModelAxiss !== null) {
					foreach ($this->collGraphModelAxiss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGraphRelationQuestions !== null) {
					foreach ($this->collGraphRelationQuestions as $referrerFK) {
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
		$pos = QuestionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSectionid();
				break;
			case 2:
				return $this->getType();
				break;
			case 3:
				return $this->getQuestion();
				break;
			case 4:
				return $this->getPosition();
				break;
			case 5:
				return $this->getUnit();
				break;
			case 6:
				return $this->getAnalysis();
				break;
			case 7:
				return $this->getLabel();
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
		if (isset($alreadyDumpedObjects['Question'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Question'][$this->getPrimaryKey()] = true;
		$keys = QuestionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSectionid(),
			$keys[2] => $this->getType(),
			$keys[3] => $this->getQuestion(),
			$keys[4] => $this->getPosition(),
			$keys[5] => $this->getUnit(),
			$keys[6] => $this->getAnalysis(),
			$keys[7] => $this->getLabel(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aFormSection) {
				$result['FormSection'] = $this->aFormSection->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collQuestionOptions) {
				$result['QuestionOptions'] = $this->collQuestionOptions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collRelationships) {
				$result['Relationships'] = $this->collRelationships->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collActorActiveQuestions) {
				$result['ActorActiveQuestions'] = $this->collActorActiveQuestions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collRelationshipActiveQuestions) {
				$result['RelationshipActiveQuestions'] = $this->collRelationshipActiveQuestions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collAnswers) {
				$result['Answers'] = $this->collAnswers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphModelAxiss) {
				$result['GraphModelAxiss'] = $this->collGraphModelAxiss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphRelationQuestions) {
				$result['GraphRelationQuestions'] = $this->collGraphRelationQuestions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = QuestionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSectionid($value);
				break;
			case 2:
				$this->setType($value);
				break;
			case 3:
				$this->setQuestion($value);
				break;
			case 4:
				$this->setPosition($value);
				break;
			case 5:
				$this->setUnit($value);
				break;
			case 6:
				$this->setAnalysis($value);
				break;
			case 7:
				$this->setLabel($value);
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
		$keys = QuestionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSectionid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQuestion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPosition($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUnit($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAnalysis($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLabel($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(QuestionPeer::DATABASE_NAME);

		if ($this->isColumnModified(QuestionPeer::ID)) $criteria->add(QuestionPeer::ID, $this->id);
		if ($this->isColumnModified(QuestionPeer::SECTIONID)) $criteria->add(QuestionPeer::SECTIONID, $this->sectionid);
		if ($this->isColumnModified(QuestionPeer::TYPE)) $criteria->add(QuestionPeer::TYPE, $this->type);
		if ($this->isColumnModified(QuestionPeer::QUESTION)) $criteria->add(QuestionPeer::QUESTION, $this->question);
		if ($this->isColumnModified(QuestionPeer::POSITION)) $criteria->add(QuestionPeer::POSITION, $this->position);
		if ($this->isColumnModified(QuestionPeer::UNIT)) $criteria->add(QuestionPeer::UNIT, $this->unit);
		if ($this->isColumnModified(QuestionPeer::ANALYSIS)) $criteria->add(QuestionPeer::ANALYSIS, $this->analysis);
		if ($this->isColumnModified(QuestionPeer::LABEL)) $criteria->add(QuestionPeer::LABEL, $this->label);

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
		$criteria = new Criteria(QuestionPeer::DATABASE_NAME);
		$criteria->add(QuestionPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Question (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setSectionid($this->getSectionid());
		$copyObj->setType($this->getType());
		$copyObj->setQuestion($this->getQuestion());
		$copyObj->setPosition($this->getPosition());
		$copyObj->setUnit($this->getUnit());
		$copyObj->setAnalysis($this->getAnalysis());
		$copyObj->setLabel($this->getLabel());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getQuestionOptions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addQuestionOption($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRelationships() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRelationship($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getActorActiveQuestions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addActorActiveQuestion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRelationshipActiveQuestions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addRelationshipActiveQuestion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAnswers() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addAnswer($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphModelAxiss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphModelAxis($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphRelationQuestions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphRelationQuestion($relObj->copy($deepCopy));
				}
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
	 * @return     Question Clone of current object.
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
	 * @return     QuestionPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new QuestionPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a FormSection object.
	 *
	 * @param      FormSection $v
	 * @return     Question The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFormSection(FormSection $v = null)
	{
		if ($v === null) {
			$this->setSectionid(NULL);
		} else {
			$this->setSectionid($v->getId());
		}

		$this->aFormSection = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the FormSection object, it will not be re-added.
		if ($v !== null) {
			$v->addQuestion($this);
		}

		return $this;
	}


	/**
	 * Get the associated FormSection object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     FormSection The associated FormSection object.
	 * @throws     PropelException
	 */
	public function getFormSection(PropelPDO $con = null)
	{
		if ($this->aFormSection === null && ($this->sectionid !== null)) {
			$this->aFormSection = FormSectionQuery::create()->findPk($this->sectionid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aFormSection->addQuestions($this);
			 */
		}
		return $this->aFormSection;
	}

	/**
	 * Clears out the collQuestionOptions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addQuestionOptions()
	 */
	public function clearQuestionOptions()
	{
		$this->collQuestionOptions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collQuestionOptions collection.
	 *
	 * By default this just sets the collQuestionOptions collection to an empty array (like clearcollQuestionOptions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initQuestionOptions($overrideExisting = true)
	{
		if (null !== $this->collQuestionOptions && !$overrideExisting) {
			return;
		}
		$this->collQuestionOptions = new PropelObjectCollection();
		$this->collQuestionOptions->setModel('QuestionOption');
	}

	/**
	 * Gets an array of QuestionOption objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Question is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array QuestionOption[] List of QuestionOption objects
	 * @throws     PropelException
	 */
	public function getQuestionOptions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collQuestionOptions || null !== $criteria) {
			if ($this->isNew() && null === $this->collQuestionOptions) {
				// return empty collection
				$this->initQuestionOptions();
			} else {
				$collQuestionOptions = QuestionOptionQuery::create(null, $criteria)
					->filterByQuestion($this)
					->find($con);
				if (null !== $criteria) {
					return $collQuestionOptions;
				}
				$this->collQuestionOptions = $collQuestionOptions;
			}
		}
		return $this->collQuestionOptions;
	}

	/**
	 * Returns the number of related QuestionOption objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related QuestionOption objects.
	 * @throws     PropelException
	 */
	public function countQuestionOptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collQuestionOptions || null !== $criteria) {
			if ($this->isNew() && null === $this->collQuestionOptions) {
				return 0;
			} else {
				$query = QuestionOptionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByQuestion($this)
					->count($con);
			}
		} else {
			return count($this->collQuestionOptions);
		}
	}

	/**
	 * Method called to associate a QuestionOption object to this object
	 * through the QuestionOption foreign key attribute.
	 *
	 * @param      QuestionOption $l QuestionOption
	 * @return     void
	 * @throws     PropelException
	 */
	public function addQuestionOption(QuestionOption $l)
	{
		if ($this->collQuestionOptions === null) {
			$this->initQuestionOptions();
		}
		if (!$this->collQuestionOptions->contains($l)) { // only add it if the **same** object is not already associated
			$this->collQuestionOptions[]= $l;
			$l->setQuestion($this);
		}
	}

	/**
	 * Clears out the collRelationships collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRelationships()
	 */
	public function clearRelationships()
	{
		$this->collRelationships = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRelationships collection.
	 *
	 * By default this just sets the collRelationships collection to an empty array (like clearcollRelationships());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRelationships($overrideExisting = true)
	{
		if (null !== $this->collRelationships && !$overrideExisting) {
			return;
		}
		$this->collRelationships = new PropelObjectCollection();
		$this->collRelationships->setModel('Relationship');
	}

	/**
	 * Gets an array of Relationship objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Question is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 * @throws     PropelException
	 */
	public function getRelationships($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRelationships || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationships) {
				// return empty collection
				$this->initRelationships();
			} else {
				$collRelationships = RelationshipQuery::create(null, $criteria)
					->filterByQuestion($this)
					->find($con);
				if (null !== $criteria) {
					return $collRelationships;
				}
				$this->collRelationships = $collRelationships;
			}
		}
		return $this->collRelationships;
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
	public function countRelationships(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRelationships || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationships) {
				return 0;
			} else {
				$query = RelationshipQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByQuestion($this)
					->count($con);
			}
		} else {
			return count($this->collRelationships);
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
	public function addRelationship(Relationship $l)
	{
		if ($this->collRelationships === null) {
			$this->initRelationships();
		}
		if (!$this->collRelationships->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRelationships[]= $l;
			$l->setQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related Relationships from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 */
	public function getRelationshipsJoinActorRelatedByActor1id($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipQuery::create(null, $criteria);
		$query->joinWith('ActorRelatedByActor1id', $join_behavior);

		return $this->getRelationships($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related Relationships from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Relationship[] List of Relationship objects
	 */
	public function getRelationshipsJoinActorRelatedByActor2id($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipQuery::create(null, $criteria);
		$query->joinWith('ActorRelatedByActor2id', $join_behavior);

		return $this->getRelationships($query, $con);
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
	 * If this Question is new, it will return
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
					->filterByQuestion($this)
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
					->filterByQuestion($this)
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
			$l->setQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related ActorActiveQuestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array ActorActiveQuestion[] List of ActorActiveQuestion objects
	 */
	public function getActorActiveQuestionsJoinActor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ActorActiveQuestionQuery::create(null, $criteria);
		$query->joinWith('Actor', $join_behavior);

		return $this->getActorActiveQuestions($query, $con);
	}

	/**
	 * Clears out the collRelationshipActiveQuestions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addRelationshipActiveQuestions()
	 */
	public function clearRelationshipActiveQuestions()
	{
		$this->collRelationshipActiveQuestions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collRelationshipActiveQuestions collection.
	 *
	 * By default this just sets the collRelationshipActiveQuestions collection to an empty array (like clearcollRelationshipActiveQuestions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initRelationshipActiveQuestions($overrideExisting = true)
	{
		if (null !== $this->collRelationshipActiveQuestions && !$overrideExisting) {
			return;
		}
		$this->collRelationshipActiveQuestions = new PropelObjectCollection();
		$this->collRelationshipActiveQuestions->setModel('RelationshipActiveQuestion');
	}

	/**
	 * Gets an array of RelationshipActiveQuestion objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Question is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 * @throws     PropelException
	 */
	public function getRelationshipActiveQuestions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipActiveQuestions || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipActiveQuestions) {
				// return empty collection
				$this->initRelationshipActiveQuestions();
			} else {
				$collRelationshipActiveQuestions = RelationshipActiveQuestionQuery::create(null, $criteria)
					->filterByQuestion($this)
					->find($con);
				if (null !== $criteria) {
					return $collRelationshipActiveQuestions;
				}
				$this->collRelationshipActiveQuestions = $collRelationshipActiveQuestions;
			}
		}
		return $this->collRelationshipActiveQuestions;
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
	public function countRelationshipActiveQuestions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collRelationshipActiveQuestions || null !== $criteria) {
			if ($this->isNew() && null === $this->collRelationshipActiveQuestions) {
				return 0;
			} else {
				$query = RelationshipActiveQuestionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByQuestion($this)
					->count($con);
			}
		} else {
			return count($this->collRelationshipActiveQuestions);
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
	public function addRelationshipActiveQuestion(RelationshipActiveQuestion $l)
	{
		if ($this->collRelationshipActiveQuestions === null) {
			$this->initRelationshipActiveQuestions();
		}
		if (!$this->collRelationshipActiveQuestions->contains($l)) { // only add it if the **same** object is not already associated
			$this->collRelationshipActiveQuestions[]= $l;
			$l->setQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related RelationshipActiveQuestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 */
	public function getRelationshipActiveQuestionsJoinActorRelatedByActor1id($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipActiveQuestionQuery::create(null, $criteria);
		$query->joinWith('ActorRelatedByActor1id', $join_behavior);

		return $this->getRelationshipActiveQuestions($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related RelationshipActiveQuestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array RelationshipActiveQuestion[] List of RelationshipActiveQuestion objects
	 */
	public function getRelationshipActiveQuestionsJoinActorRelatedByActor2id($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = RelationshipActiveQuestionQuery::create(null, $criteria);
		$query->joinWith('ActorRelatedByActor2id', $join_behavior);

		return $this->getRelationshipActiveQuestions($query, $con);
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
	 * If this Question is new, it will return
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
					->filterByQuestion($this)
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
					->filterByQuestion($this)
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
			$l->setQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related Answers from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Answer[] List of Answer objects
	 */
	public function getAnswersJoinActor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = AnswerQuery::create(null, $criteria);
		$query->joinWith('Actor', $join_behavior);

		return $this->getAnswers($query, $con);
	}

	/**
	 * Clears out the collGraphModelAxiss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGraphModelAxiss()
	 */
	public function clearGraphModelAxiss()
	{
		$this->collGraphModelAxiss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGraphModelAxiss collection.
	 *
	 * By default this just sets the collGraphModelAxiss collection to an empty array (like clearcollGraphModelAxiss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGraphModelAxiss($overrideExisting = true)
	{
		if (null !== $this->collGraphModelAxiss && !$overrideExisting) {
			return;
		}
		$this->collGraphModelAxiss = new PropelObjectCollection();
		$this->collGraphModelAxiss->setModel('GraphModelAxis');
	}

	/**
	 * Gets an array of GraphModelAxis objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Question is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GraphModelAxis[] List of GraphModelAxis objects
	 * @throws     PropelException
	 */
	public function getGraphModelAxiss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGraphModelAxiss || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphModelAxiss) {
				// return empty collection
				$this->initGraphModelAxiss();
			} else {
				$collGraphModelAxiss = GraphModelAxisQuery::create(null, $criteria)
					->filterByQuestion($this)
					->find($con);
				if (null !== $criteria) {
					return $collGraphModelAxiss;
				}
				$this->collGraphModelAxiss = $collGraphModelAxiss;
			}
		}
		return $this->collGraphModelAxiss;
	}

	/**
	 * Returns the number of related GraphModelAxis objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GraphModelAxis objects.
	 * @throws     PropelException
	 */
	public function countGraphModelAxiss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGraphModelAxiss || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphModelAxiss) {
				return 0;
			} else {
				$query = GraphModelAxisQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByQuestion($this)
					->count($con);
			}
		} else {
			return count($this->collGraphModelAxiss);
		}
	}

	/**
	 * Method called to associate a GraphModelAxis object to this object
	 * through the GraphModelAxis foreign key attribute.
	 *
	 * @param      GraphModelAxis $l GraphModelAxis
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGraphModelAxis(GraphModelAxis $l)
	{
		if ($this->collGraphModelAxiss === null) {
			$this->initGraphModelAxiss();
		}
		if (!$this->collGraphModelAxiss->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGraphModelAxiss[]= $l;
			$l->setQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related GraphModelAxiss from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GraphModelAxis[] List of GraphModelAxis objects
	 */
	public function getGraphModelAxissJoinGraphModel($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GraphModelAxisQuery::create(null, $criteria);
		$query->joinWith('GraphModel', $join_behavior);

		return $this->getGraphModelAxiss($query, $con);
	}

	/**
	 * Clears out the collGraphRelationQuestions collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGraphRelationQuestions()
	 */
	public function clearGraphRelationQuestions()
	{
		$this->collGraphRelationQuestions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGraphRelationQuestions collection.
	 *
	 * By default this just sets the collGraphRelationQuestions collection to an empty array (like clearcollGraphRelationQuestions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGraphRelationQuestions($overrideExisting = true)
	{
		if (null !== $this->collGraphRelationQuestions && !$overrideExisting) {
			return;
		}
		$this->collGraphRelationQuestions = new PropelObjectCollection();
		$this->collGraphRelationQuestions->setModel('GraphRelationQuestion');
	}

	/**
	 * Gets an array of GraphRelationQuestion objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Question is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GraphRelationQuestion[] List of GraphRelationQuestion objects
	 * @throws     PropelException
	 */
	public function getGraphRelationQuestions($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGraphRelationQuestions || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphRelationQuestions) {
				// return empty collection
				$this->initGraphRelationQuestions();
			} else {
				$collGraphRelationQuestions = GraphRelationQuestionQuery::create(null, $criteria)
					->filterByQuestion($this)
					->find($con);
				if (null !== $criteria) {
					return $collGraphRelationQuestions;
				}
				$this->collGraphRelationQuestions = $collGraphRelationQuestions;
			}
		}
		return $this->collGraphRelationQuestions;
	}

	/**
	 * Returns the number of related GraphRelationQuestion objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GraphRelationQuestion objects.
	 * @throws     PropelException
	 */
	public function countGraphRelationQuestions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGraphRelationQuestions || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphRelationQuestions) {
				return 0;
			} else {
				$query = GraphRelationQuestionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByQuestion($this)
					->count($con);
			}
		} else {
			return count($this->collGraphRelationQuestions);
		}
	}

	/**
	 * Method called to associate a GraphRelationQuestion object to this object
	 * through the GraphRelationQuestion foreign key attribute.
	 *
	 * @param      GraphRelationQuestion $l GraphRelationQuestion
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGraphRelationQuestion(GraphRelationQuestion $l)
	{
		if ($this->collGraphRelationQuestions === null) {
			$this->initGraphRelationQuestions();
		}
		if (!$this->collGraphRelationQuestions->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGraphRelationQuestions[]= $l;
			$l->setQuestion($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Question is new, it will return
	 * an empty collection; or if this Question has previously
	 * been saved, it will retrieve related GraphRelationQuestions from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Question.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GraphRelationQuestion[] List of GraphRelationQuestion objects
	 */
	public function getGraphRelationQuestionsJoinGraphRelation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GraphRelationQuestionQuery::create(null, $criteria);
		$query->joinWith('GraphRelation', $join_behavior);

		return $this->getGraphRelationQuestions($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->sectionid = null;
		$this->type = null;
		$this->question = null;
		$this->position = null;
		$this->unit = null;
		$this->analysis = null;
		$this->label = null;
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
			if ($this->collQuestionOptions) {
				foreach ($this->collQuestionOptions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationships) {
				foreach ($this->collRelationships as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collActorActiveQuestions) {
				foreach ($this->collActorActiveQuestions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationshipActiveQuestions) {
				foreach ($this->collRelationshipActiveQuestions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAnswers) {
				foreach ($this->collAnswers as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphModelAxiss) {
				foreach ($this->collGraphModelAxiss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphRelationQuestions) {
				foreach ($this->collGraphRelationQuestions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collQuestionOptions instanceof PropelCollection) {
			$this->collQuestionOptions->clearIterator();
		}
		$this->collQuestionOptions = null;
		if ($this->collRelationships instanceof PropelCollection) {
			$this->collRelationships->clearIterator();
		}
		$this->collRelationships = null;
		if ($this->collActorActiveQuestions instanceof PropelCollection) {
			$this->collActorActiveQuestions->clearIterator();
		}
		$this->collActorActiveQuestions = null;
		if ($this->collRelationshipActiveQuestions instanceof PropelCollection) {
			$this->collRelationshipActiveQuestions->clearIterator();
		}
		$this->collRelationshipActiveQuestions = null;
		if ($this->collAnswers instanceof PropelCollection) {
			$this->collAnswers->clearIterator();
		}
		$this->collAnswers = null;
		if ($this->collGraphModelAxiss instanceof PropelCollection) {
			$this->collGraphModelAxiss->clearIterator();
		}
		$this->collGraphModelAxiss = null;
		if ($this->collGraphRelationQuestions instanceof PropelCollection) {
			$this->collGraphRelationQuestions->clearIterator();
		}
		$this->collGraphRelationQuestions = null;
		$this->aFormSection = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(QuestionPeer::DEFAULT_STRING_FORMAT);
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

} // BaseQuestion
