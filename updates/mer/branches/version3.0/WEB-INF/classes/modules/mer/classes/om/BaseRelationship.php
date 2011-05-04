<?php


/**
 * Base class that represents a row from the 'MER_relationship' table.
 *
 * 
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseRelationship extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'RelationshipPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RelationshipPeer
	 */
	protected static $peer;

	/**
	 * The value for the actor1id field.
	 * @var        int
	 */
	protected $actor1id;

	/**
	 * The value for the actor2id field.
	 * @var        int
	 */
	protected $actor2id;

	/**
	 * The value for the questionid field.
	 * @var        int
	 */
	protected $questionid;

	/**
	 * The value for the direction field.
	 * @var        boolean
	 */
	protected $direction;

	/**
	 * The value for the current field.
	 * @var        string
	 */
	protected $current;

	/**
	 * The value for the potential field.
	 * @var        string
	 */
	protected $potential;

	/**
	 * @var        Actor
	 */
	protected $aActorRelatedByActor1id;

	/**
	 * @var        Actor
	 */
	protected $aActorRelatedByActor2id;

	/**
	 * @var        Question
	 */
	protected $aQuestion;

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
	 * Get the [actor1id] column value.
	 * 
	 * @return     int
	 */
	public function getActor1id()
	{
		return $this->actor1id;
	}

	/**
	 * Get the [actor2id] column value.
	 * 
	 * @return     int
	 */
	public function getActor2id()
	{
		return $this->actor2id;
	}

	/**
	 * Get the [questionid] column value.
	 * 
	 * @return     int
	 */
	public function getQuestionid()
	{
		return $this->questionid;
	}

	/**
	 * Get the [direction] column value.
	 * 
	 * @return     boolean
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	/**
	 * Get the [current] column value.
	 * Current relationship
	 * @return     string
	 */
	public function getCurrent()
	{
		return $this->current;
	}

	/**
	 * Get the [potential] column value.
	 * Potential relationship
	 * @return     string
	 */
	public function getPotential()
	{
		return $this->potential;
	}

	/**
	 * Set the value of [actor1id] column.
	 * 
	 * @param      int $v new value
	 * @return     Relationship The current object (for fluent API support)
	 */
	public function setActor1id($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->actor1id !== $v) {
			$this->actor1id = $v;
			$this->modifiedColumns[] = RelationshipPeer::ACTOR1ID;
		}

		if ($this->aActorRelatedByActor1id !== null && $this->aActorRelatedByActor1id->getId() !== $v) {
			$this->aActorRelatedByActor1id = null;
		}

		return $this;
	} // setActor1id()

	/**
	 * Set the value of [actor2id] column.
	 * 
	 * @param      int $v new value
	 * @return     Relationship The current object (for fluent API support)
	 */
	public function setActor2id($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->actor2id !== $v) {
			$this->actor2id = $v;
			$this->modifiedColumns[] = RelationshipPeer::ACTOR2ID;
		}

		if ($this->aActorRelatedByActor2id !== null && $this->aActorRelatedByActor2id->getId() !== $v) {
			$this->aActorRelatedByActor2id = null;
		}

		return $this;
	} // setActor2id()

	/**
	 * Set the value of [questionid] column.
	 * 
	 * @param      int $v new value
	 * @return     Relationship The current object (for fluent API support)
	 */
	public function setQuestionid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->questionid !== $v) {
			$this->questionid = $v;
			$this->modifiedColumns[] = RelationshipPeer::QUESTIONID;
		}

		if ($this->aQuestion !== null && $this->aQuestion->getId() !== $v) {
			$this->aQuestion = null;
		}

		return $this;
	} // setQuestionid()

	/**
	 * Sets the value of the [direction] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Relationship The current object (for fluent API support)
	 */
	public function setDirection($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->direction !== $v) {
			$this->direction = $v;
			$this->modifiedColumns[] = RelationshipPeer::DIRECTION;
		}

		return $this;
	} // setDirection()

	/**
	 * Set the value of [current] column.
	 * Current relationship
	 * @param      string $v new value
	 * @return     Relationship The current object (for fluent API support)
	 */
	public function setCurrent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->current !== $v) {
			$this->current = $v;
			$this->modifiedColumns[] = RelationshipPeer::CURRENT;
		}

		return $this;
	} // setCurrent()

	/**
	 * Set the value of [potential] column.
	 * Potential relationship
	 * @param      string $v new value
	 * @return     Relationship The current object (for fluent API support)
	 */
	public function setPotential($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->potential !== $v) {
			$this->potential = $v;
			$this->modifiedColumns[] = RelationshipPeer::POTENTIAL;
		}

		return $this;
	} // setPotential()

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

			$this->actor1id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->actor2id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->questionid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->direction = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->current = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->potential = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = RelationshipPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Relationship object", $e);
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

		if ($this->aActorRelatedByActor1id !== null && $this->actor1id !== $this->aActorRelatedByActor1id->getId()) {
			$this->aActorRelatedByActor1id = null;
		}
		if ($this->aActorRelatedByActor2id !== null && $this->actor2id !== $this->aActorRelatedByActor2id->getId()) {
			$this->aActorRelatedByActor2id = null;
		}
		if ($this->aQuestion !== null && $this->questionid !== $this->aQuestion->getId()) {
			$this->aQuestion = null;
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
			$con = Propel::getConnection(RelationshipPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = RelationshipPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aActorRelatedByActor1id = null;
			$this->aActorRelatedByActor2id = null;
			$this->aQuestion = null;
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
			$con = Propel::getConnection(RelationshipPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				RelationshipQuery::create()
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
			$con = Propel::getConnection(RelationshipPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				RelationshipPeer::addInstanceToPool($this);
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

			if ($this->aActorRelatedByActor1id !== null) {
				if ($this->aActorRelatedByActor1id->isModified() || $this->aActorRelatedByActor1id->isNew()) {
					$affectedRows += $this->aActorRelatedByActor1id->save($con);
				}
				$this->setActorRelatedByActor1id($this->aActorRelatedByActor1id);
			}

			if ($this->aActorRelatedByActor2id !== null) {
				if ($this->aActorRelatedByActor2id->isModified() || $this->aActorRelatedByActor2id->isNew()) {
					$affectedRows += $this->aActorRelatedByActor2id->save($con);
				}
				$this->setActorRelatedByActor2id($this->aActorRelatedByActor2id);
			}

			if ($this->aQuestion !== null) {
				if ($this->aQuestion->isModified() || $this->aQuestion->isNew()) {
					$affectedRows += $this->aQuestion->save($con);
				}
				$this->setQuestion($this->aQuestion);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setNew(false);
				} else {
					$affectedRows += RelationshipPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aActorRelatedByActor1id !== null) {
				if (!$this->aActorRelatedByActor1id->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActorRelatedByActor1id->getValidationFailures());
				}
			}

			if ($this->aActorRelatedByActor2id !== null) {
				if (!$this->aActorRelatedByActor2id->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActorRelatedByActor2id->getValidationFailures());
				}
			}

			if ($this->aQuestion !== null) {
				if (!$this->aQuestion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aQuestion->getValidationFailures());
				}
			}


			if (($retval = RelationshipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = RelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getActor1id();
				break;
			case 1:
				return $this->getActor2id();
				break;
			case 2:
				return $this->getQuestionid();
				break;
			case 3:
				return $this->getDirection();
				break;
			case 4:
				return $this->getCurrent();
				break;
			case 5:
				return $this->getPotential();
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
		if (isset($alreadyDumpedObjects['Relationship'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Relationship'][serialize($this->getPrimaryKey())] = true;
		$keys = RelationshipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getActor1id(),
			$keys[1] => $this->getActor2id(),
			$keys[2] => $this->getQuestionid(),
			$keys[3] => $this->getDirection(),
			$keys[4] => $this->getCurrent(),
			$keys[5] => $this->getPotential(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aActorRelatedByActor1id) {
				$result['ActorRelatedByActor1id'] = $this->aActorRelatedByActor1id->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aActorRelatedByActor2id) {
				$result['ActorRelatedByActor2id'] = $this->aActorRelatedByActor2id->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aQuestion) {
				$result['Question'] = $this->aQuestion->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = RelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setActor1id($value);
				break;
			case 1:
				$this->setActor2id($value);
				break;
			case 2:
				$this->setQuestionid($value);
				break;
			case 3:
				$this->setDirection($value);
				break;
			case 4:
				$this->setCurrent($value);
				break;
			case 5:
				$this->setPotential($value);
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
		$keys = RelationshipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setActor1id($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setActor2id($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setQuestionid($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDirection($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCurrent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPotential($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RelationshipPeer::DATABASE_NAME);

		if ($this->isColumnModified(RelationshipPeer::ACTOR1ID)) $criteria->add(RelationshipPeer::ACTOR1ID, $this->actor1id);
		if ($this->isColumnModified(RelationshipPeer::ACTOR2ID)) $criteria->add(RelationshipPeer::ACTOR2ID, $this->actor2id);
		if ($this->isColumnModified(RelationshipPeer::QUESTIONID)) $criteria->add(RelationshipPeer::QUESTIONID, $this->questionid);
		if ($this->isColumnModified(RelationshipPeer::DIRECTION)) $criteria->add(RelationshipPeer::DIRECTION, $this->direction);
		if ($this->isColumnModified(RelationshipPeer::CURRENT)) $criteria->add(RelationshipPeer::CURRENT, $this->current);
		if ($this->isColumnModified(RelationshipPeer::POTENTIAL)) $criteria->add(RelationshipPeer::POTENTIAL, $this->potential);

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
		$criteria = new Criteria(RelationshipPeer::DATABASE_NAME);
		$criteria->add(RelationshipPeer::ACTOR1ID, $this->actor1id);
		$criteria->add(RelationshipPeer::ACTOR2ID, $this->actor2id);
		$criteria->add(RelationshipPeer::QUESTIONID, $this->questionid);
		$criteria->add(RelationshipPeer::DIRECTION, $this->direction);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();
		$pks[0] = $this->getActor1id();
		$pks[1] = $this->getActor2id();
		$pks[2] = $this->getQuestionid();
		$pks[3] = $this->getDirection();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{
		$this->setActor1id($keys[0]);
		$this->setActor2id($keys[1]);
		$this->setQuestionid($keys[2]);
		$this->setDirection($keys[3]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getActor1id()) && (null === $this->getActor2id()) && (null === $this->getQuestionid()) && (null === $this->getDirection());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Relationship (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setActor1id($this->getActor1id());
		$copyObj->setActor2id($this->getActor2id());
		$copyObj->setQuestionid($this->getQuestionid());
		$copyObj->setDirection($this->getDirection());
		$copyObj->setCurrent($this->getCurrent());
		$copyObj->setPotential($this->getPotential());
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
	 * @return     Relationship Clone of current object.
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
	 * @return     RelationshipPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RelationshipPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Actor object.
	 *
	 * @param      Actor $v
	 * @return     Relationship The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setActorRelatedByActor1id(Actor $v = null)
	{
		if ($v === null) {
			$this->setActor1id(NULL);
		} else {
			$this->setActor1id($v->getId());
		}

		$this->aActorRelatedByActor1id = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Actor object, it will not be re-added.
		if ($v !== null) {
			$v->addRelationshipRelatedByActor1id($this);
		}

		return $this;
	}


	/**
	 * Get the associated Actor object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Actor The associated Actor object.
	 * @throws     PropelException
	 */
	public function getActorRelatedByActor1id(PropelPDO $con = null)
	{
		if ($this->aActorRelatedByActor1id === null && ($this->actor1id !== null)) {
			$this->aActorRelatedByActor1id = ActorQuery::create()->findPk($this->actor1id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aActorRelatedByActor1id->addRelationshipsRelatedByActor1id($this);
			 */
		}
		return $this->aActorRelatedByActor1id;
	}

	/**
	 * Declares an association between this object and a Actor object.
	 *
	 * @param      Actor $v
	 * @return     Relationship The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setActorRelatedByActor2id(Actor $v = null)
	{
		if ($v === null) {
			$this->setActor2id(NULL);
		} else {
			$this->setActor2id($v->getId());
		}

		$this->aActorRelatedByActor2id = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Actor object, it will not be re-added.
		if ($v !== null) {
			$v->addRelationshipRelatedByActor2id($this);
		}

		return $this;
	}


	/**
	 * Get the associated Actor object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Actor The associated Actor object.
	 * @throws     PropelException
	 */
	public function getActorRelatedByActor2id(PropelPDO $con = null)
	{
		if ($this->aActorRelatedByActor2id === null && ($this->actor2id !== null)) {
			$this->aActorRelatedByActor2id = ActorQuery::create()->findPk($this->actor2id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aActorRelatedByActor2id->addRelationshipsRelatedByActor2id($this);
			 */
		}
		return $this->aActorRelatedByActor2id;
	}

	/**
	 * Declares an association between this object and a Question object.
	 *
	 * @param      Question $v
	 * @return     Relationship The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setQuestion(Question $v = null)
	{
		if ($v === null) {
			$this->setQuestionid(NULL);
		} else {
			$this->setQuestionid($v->getId());
		}

		$this->aQuestion = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Question object, it will not be re-added.
		if ($v !== null) {
			$v->addRelationship($this);
		}

		return $this;
	}


	/**
	 * Get the associated Question object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Question The associated Question object.
	 * @throws     PropelException
	 */
	public function getQuestion(PropelPDO $con = null)
	{
		if ($this->aQuestion === null && ($this->questionid !== null)) {
			$this->aQuestion = QuestionQuery::create()->findPk($this->questionid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aQuestion->addRelationships($this);
			 */
		}
		return $this->aQuestion;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->actor1id = null;
		$this->actor2id = null;
		$this->questionid = null;
		$this->direction = null;
		$this->current = null;
		$this->potential = null;
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
		} // if ($deep)

		$this->aActorRelatedByActor1id = null;
		$this->aActorRelatedByActor2id = null;
		$this->aQuestion = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(RelationshipPeer::DEFAULT_STRING_FORMAT);
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

} // BaseRelationship
