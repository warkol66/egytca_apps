<?php


/**
 * Base class that represents a row from the 'MER_graphActor' table.
 *
 * Graficos
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseGraphActor extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'GraphActorPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GraphActorPeer
	 */
	protected static $peer;

	/**
	 * The value for the graphid field.
	 * @var        int
	 */
	protected $graphid;

	/**
	 * The value for the actorid field.
	 * @var        int
	 */
	protected $actorid;

	/**
	 * The value for the categoryid field.
	 * @var        int
	 */
	protected $categoryid;

	/**
	 * The value for the judgement field.
	 * @var        string
	 */
	protected $judgement;

	/**
	 * The value for the old field.
	 * @var        int
	 */
	protected $old;

	/**
	 * @var        GraphModel
	 */
	protected $aGraphModel;

	/**
	 * @var        Actor
	 */
	protected $aActor;

	/**
	 * @var        Category
	 */
	protected $aCategory;

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
	 * Get the [graphid] column value.
	 * Id del grafico modelo
	 * @return     int
	 */
	public function getGraphid()
	{
		return $this->graphid;
	}

	/**
	 * Get the [actorid] column value.
	 * Actor
	 * @return     int
	 */
	public function getActorid()
	{
		return $this->actorid;
	}

	/**
	 * Get the [categoryid] column value.
	 * Categoria
	 * @return     int
	 */
	public function getCategoryid()
	{
		return $this->categoryid;
	}

	/**
	 * Get the [judgement] column value.
	 * Juicio
	 * @return     string
	 */
	public function getJudgement()
	{
		return $this->judgement;
	}

	/**
	 * Get the [old] column value.
	 * Indica si el juicio esta vigente o no
	 * @return     int
	 */
	public function getOld()
	{
		return $this->old;
	}

	/**
	 * Set the value of [graphid] column.
	 * Id del grafico modelo
	 * @param      int $v new value
	 * @return     GraphActor The current object (for fluent API support)
	 */
	public function setGraphid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->graphid !== $v) {
			$this->graphid = $v;
			$this->modifiedColumns[] = GraphActorPeer::GRAPHID;
		}

		if ($this->aGraphModel !== null && $this->aGraphModel->getId() !== $v) {
			$this->aGraphModel = null;
		}

		return $this;
	} // setGraphid()

	/**
	 * Set the value of [actorid] column.
	 * Actor
	 * @param      int $v new value
	 * @return     GraphActor The current object (for fluent API support)
	 */
	public function setActorid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->actorid !== $v) {
			$this->actorid = $v;
			$this->modifiedColumns[] = GraphActorPeer::ACTORID;
		}

		if ($this->aActor !== null && $this->aActor->getId() !== $v) {
			$this->aActor = null;
		}

		return $this;
	} // setActorid()

	/**
	 * Set the value of [categoryid] column.
	 * Categoria
	 * @param      int $v new value
	 * @return     GraphActor The current object (for fluent API support)
	 */
	public function setCategoryid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->categoryid !== $v) {
			$this->categoryid = $v;
			$this->modifiedColumns[] = GraphActorPeer::CATEGORYID;
		}

		if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
			$this->aCategory = null;
		}

		return $this;
	} // setCategoryid()

	/**
	 * Set the value of [judgement] column.
	 * Juicio
	 * @param      string $v new value
	 * @return     GraphActor The current object (for fluent API support)
	 */
	public function setJudgement($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->judgement !== $v) {
			$this->judgement = $v;
			$this->modifiedColumns[] = GraphActorPeer::JUDGEMENT;
		}

		return $this;
	} // setJudgement()

	/**
	 * Set the value of [old] column.
	 * Indica si el juicio esta vigente o no
	 * @param      int $v new value
	 * @return     GraphActor The current object (for fluent API support)
	 */
	public function setOld($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->old !== $v) {
			$this->old = $v;
			$this->modifiedColumns[] = GraphActorPeer::OLD;
		}

		return $this;
	} // setOld()

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

			$this->graphid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->actorid = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->categoryid = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->judgement = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->old = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = GraphActorPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating GraphActor object", $e);
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

		if ($this->aGraphModel !== null && $this->graphid !== $this->aGraphModel->getId()) {
			$this->aGraphModel = null;
		}
		if ($this->aActor !== null && $this->actorid !== $this->aActor->getId()) {
			$this->aActor = null;
		}
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
			$con = Propel::getConnection(GraphActorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = GraphActorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aGraphModel = null;
			$this->aActor = null;
			$this->aCategory = null;
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
			$con = Propel::getConnection(GraphActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				GraphActorQuery::create()
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
			$con = Propel::getConnection(GraphActorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				GraphActorPeer::addInstanceToPool($this);
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

			if ($this->aGraphModel !== null) {
				if ($this->aGraphModel->isModified() || $this->aGraphModel->isNew()) {
					$affectedRows += $this->aGraphModel->save($con);
				}
				$this->setGraphModel($this->aGraphModel);
			}

			if ($this->aActor !== null) {
				if ($this->aActor->isModified() || $this->aActor->isNew()) {
					$affectedRows += $this->aActor->save($con);
				}
				$this->setActor($this->aActor);
			}

			if ($this->aCategory !== null) {
				if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
					$affectedRows += $this->aCategory->save($con);
				}
				$this->setCategory($this->aCategory);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows += 1;
					$this->setNew(false);
				} else {
					$affectedRows += GraphActorPeer::doUpdate($this, $con);
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

			if ($this->aGraphModel !== null) {
				if (!$this->aGraphModel->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGraphModel->getValidationFailures());
				}
			}

			if ($this->aActor !== null) {
				if (!$this->aActor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActor->getValidationFailures());
				}
			}

			if ($this->aCategory !== null) {
				if (!$this->aCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
				}
			}


			if (($retval = GraphActorPeer::doValidate($this, $columns)) !== true) {
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
		$pos = GraphActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGraphid();
				break;
			case 1:
				return $this->getActorid();
				break;
			case 2:
				return $this->getCategoryid();
				break;
			case 3:
				return $this->getJudgement();
				break;
			case 4:
				return $this->getOld();
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
		if (isset($alreadyDumpedObjects['GraphActor'][serialize($this->getPrimaryKey())])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['GraphActor'][serialize($this->getPrimaryKey())] = true;
		$keys = GraphActorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getGraphid(),
			$keys[1] => $this->getActorid(),
			$keys[2] => $this->getCategoryid(),
			$keys[3] => $this->getJudgement(),
			$keys[4] => $this->getOld(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aGraphModel) {
				$result['GraphModel'] = $this->aGraphModel->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aActor) {
				$result['Actor'] = $this->aActor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aCategory) {
				$result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = GraphActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setGraphid($value);
				break;
			case 1:
				$this->setActorid($value);
				break;
			case 2:
				$this->setCategoryid($value);
				break;
			case 3:
				$this->setJudgement($value);
				break;
			case 4:
				$this->setOld($value);
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
		$keys = GraphActorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setGraphid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setActorid($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCategoryid($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setJudgement($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOld($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GraphActorPeer::DATABASE_NAME);

		if ($this->isColumnModified(GraphActorPeer::GRAPHID)) $criteria->add(GraphActorPeer::GRAPHID, $this->graphid);
		if ($this->isColumnModified(GraphActorPeer::ACTORID)) $criteria->add(GraphActorPeer::ACTORID, $this->actorid);
		if ($this->isColumnModified(GraphActorPeer::CATEGORYID)) $criteria->add(GraphActorPeer::CATEGORYID, $this->categoryid);
		if ($this->isColumnModified(GraphActorPeer::JUDGEMENT)) $criteria->add(GraphActorPeer::JUDGEMENT, $this->judgement);
		if ($this->isColumnModified(GraphActorPeer::OLD)) $criteria->add(GraphActorPeer::OLD, $this->old);

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
		$criteria = new Criteria(GraphActorPeer::DATABASE_NAME);
		$criteria->add(GraphActorPeer::GRAPHID, $this->graphid);
		$criteria->add(GraphActorPeer::ACTORID, $this->actorid);

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
		$pks[0] = $this->getGraphid();
		$pks[1] = $this->getActorid();

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
		$this->setGraphid($keys[0]);
		$this->setActorid($keys[1]);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return (null === $this->getGraphid()) && (null === $this->getActorid());
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of GraphActor (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setGraphid($this->getGraphid());
		$copyObj->setActorid($this->getActorid());
		$copyObj->setCategoryid($this->getCategoryid());
		$copyObj->setJudgement($this->getJudgement());
		$copyObj->setOld($this->getOld());
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
	 * @return     GraphActor Clone of current object.
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
	 * @return     GraphActorPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GraphActorPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a GraphModel object.
	 *
	 * @param      GraphModel $v
	 * @return     GraphActor The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setGraphModel(GraphModel $v = null)
	{
		if ($v === null) {
			$this->setGraphid(NULL);
		} else {
			$this->setGraphid($v->getId());
		}

		$this->aGraphModel = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the GraphModel object, it will not be re-added.
		if ($v !== null) {
			$v->addGraphActor($this);
		}

		return $this;
	}


	/**
	 * Get the associated GraphModel object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     GraphModel The associated GraphModel object.
	 * @throws     PropelException
	 */
	public function getGraphModel(PropelPDO $con = null)
	{
		if ($this->aGraphModel === null && ($this->graphid !== null)) {
			$this->aGraphModel = GraphModelQuery::create()->findPk($this->graphid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aGraphModel->addGraphActors($this);
			 */
		}
		return $this->aGraphModel;
	}

	/**
	 * Declares an association between this object and a Actor object.
	 *
	 * @param      Actor $v
	 * @return     GraphActor The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setActor(Actor $v = null)
	{
		if ($v === null) {
			$this->setActorid(NULL);
		} else {
			$this->setActorid($v->getId());
		}

		$this->aActor = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Actor object, it will not be re-added.
		if ($v !== null) {
			$v->addGraphActor($this);
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
	public function getActor(PropelPDO $con = null)
	{
		if ($this->aActor === null && ($this->actorid !== null)) {
			$this->aActor = ActorQuery::create()->findPk($this->actorid, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aActor->addGraphActors($this);
			 */
		}
		return $this->aActor;
	}

	/**
	 * Declares an association between this object and a Category object.
	 *
	 * @param      Category $v
	 * @return     GraphActor The current object (for fluent API support)
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
			$v->addGraphActor($this);
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
				$this->aCategory->addGraphActors($this);
			 */
		}
		return $this->aCategory;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->graphid = null;
		$this->actorid = null;
		$this->categoryid = null;
		$this->judgement = null;
		$this->old = null;
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

		$this->aGraphModel = null;
		$this->aActor = null;
		$this->aCategory = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(GraphActorPeer::DEFAULT_STRING_FORMAT);
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

} // BaseGraphActor
