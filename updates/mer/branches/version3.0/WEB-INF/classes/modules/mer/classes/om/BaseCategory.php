<?php


/**
 * Base class that represents a row from the 'MER_category' table.
 *
 * Categorias
 *
 * @package    propel.generator.mer.classes.om
 */
abstract class BaseCategory extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'CategoryPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CategoryPeer
	 */
	protected static $peer;

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
	 * The value for the active field.
	 * @var        boolean
	 */
	protected $active;

	/**
	 * The value for the hierarchyactors field.
	 * @var        int
	 */
	protected $hierarchyactors;

	/**
	 * @var        array Actor[] Collection to store aggregation of Actor objects.
	 */
	protected $collActors;

	/**
	 * @var        array Document[] Collection to store aggregation of Document objects.
	 */
	protected $collDocuments;

	/**
	 * @var        array Hierarchy[] Collection to store aggregation of Hierarchy objects.
	 */
	protected $collHierarchys;

	/**
	 * @var        array GraphActor[] Collection to store aggregation of GraphActor objects.
	 */
	protected $collGraphActors;

	/**
	 * @var        array GraphCategory[] Collection to store aggregation of GraphCategory objects.
	 */
	protected $collGraphCategorys;

	/**
	 * @var        array GroupCategory[] Collection to store aggregation of GroupCategory objects.
	 */
	protected $collGroupCategorys;

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
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [name] column value.
	 * Category name
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [active] column value.
	 * Is category active?
	 * @return     boolean
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Get the [hierarchyactors] column value.
	 * How many hierarchy actors can have the category
	 * @return     int
	 */
	public function getHierarchyactors()
	{
		return $this->hierarchyactors;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Category The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CategoryPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [name] column.
	 * Category name
	 * @param      string $v new value
	 * @return     Category The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = CategoryPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Sets the value of the [active] column. 
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Is category active?
	 * @param      boolean|integer|string $v The new value
	 * @return     Category The current object (for fluent API support)
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

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = CategoryPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Set the value of [hierarchyactors] column.
	 * How many hierarchy actors can have the category
	 * @param      int $v new value
	 * @return     Category The current object (for fluent API support)
	 */
	public function setHierarchyactors($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hierarchyactors !== $v) {
			$this->hierarchyactors = $v;
			$this->modifiedColumns[] = CategoryPeer::HIERARCHYACTORS;
		}

		return $this;
	} // setHierarchyactors()

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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->hierarchyactors = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 4; // 4 = CategoryPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Category object", $e);
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
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CategoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collActors = null;

			$this->collDocuments = null;

			$this->collHierarchys = null;

			$this->collGraphActors = null;

			$this->collGraphCategorys = null;

			$this->collGroupCategorys = null;

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
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			if ($ret) {
				CategoryQuery::create()
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
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				CategoryPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CategoryPeer::ID;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$criteria = $this->buildCriteria();
					if ($criteria->keyContainsValue(CategoryPeer::ID) ) {
						throw new PropelException('Cannot insert a value for auto-increment primary key ('.CategoryPeer::ID.')');
					}

					$pk = BasePeer::doInsert($criteria, $con);
					$affectedRows = 1;
					$this->setId($pk);  //[IMV] update autoincrement primary key
					$this->setNew(false);
				} else {
					$affectedRows = CategoryPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collActors !== null) {
				foreach ($this->collActors as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDocuments !== null) {
				foreach ($this->collDocuments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHierarchys !== null) {
				foreach ($this->collHierarchys as $referrerFK) {
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

			if ($this->collGraphCategorys !== null) {
				foreach ($this->collGraphCategorys as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGroupCategorys !== null) {
				foreach ($this->collGroupCategorys as $referrerFK) {
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


			if (($retval = CategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collActors !== null) {
					foreach ($this->collActors as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDocuments !== null) {
					foreach ($this->collDocuments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHierarchys !== null) {
					foreach ($this->collHierarchys as $referrerFK) {
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

				if ($this->collGraphCategorys !== null) {
					foreach ($this->collGraphCategorys as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGroupCategorys !== null) {
					foreach ($this->collGroupCategorys as $referrerFK) {
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
		$pos = CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getActive();
				break;
			case 3:
				return $this->getHierarchyactors();
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
		if (isset($alreadyDumpedObjects['Category'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Category'][$this->getPrimaryKey()] = true;
		$keys = CategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getActive(),
			$keys[3] => $this->getHierarchyactors(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collActors) {
				$result['Actors'] = $this->collActors->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collDocuments) {
				$result['Documents'] = $this->collDocuments->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collHierarchys) {
				$result['Hierarchys'] = $this->collHierarchys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphActors) {
				$result['GraphActors'] = $this->collGraphActors->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGraphCategorys) {
				$result['GraphCategorys'] = $this->collGraphCategorys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collGroupCategorys) {
				$result['GroupCategorys'] = $this->collGroupCategorys->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setActive($value);
				break;
			case 3:
				$this->setHierarchyactors($value);
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
		$keys = CategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setActive($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHierarchyactors($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(CategoryPeer::ID)) $criteria->add(CategoryPeer::ID, $this->id);
		if ($this->isColumnModified(CategoryPeer::NAME)) $criteria->add(CategoryPeer::NAME, $this->name);
		if ($this->isColumnModified(CategoryPeer::ACTIVE)) $criteria->add(CategoryPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(CategoryPeer::HIERARCHYACTORS)) $criteria->add(CategoryPeer::HIERARCHYACTORS, $this->hierarchyactors);

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
		$criteria = new Criteria(CategoryPeer::DATABASE_NAME);
		$criteria->add(CategoryPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Category (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setName($this->getName());
		$copyObj->setActive($this->getActive());
		$copyObj->setHierarchyactors($this->getHierarchyactors());

		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getActors() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addActor($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getDocuments() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDocument($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHierarchys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addHierarchy($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphActors() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphActor($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGraphCategorys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGraphCategory($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getGroupCategorys() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGroupCategory($relObj->copy($deepCopy));
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
	 * @return     Category Clone of current object.
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
	 * @return     CategoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CategoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collActors collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addActors()
	 */
	public function clearActors()
	{
		$this->collActors = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collActors collection.
	 *
	 * By default this just sets the collActors collection to an empty array (like clearcollActors());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initActors($overrideExisting = true)
	{
		if (null !== $this->collActors && !$overrideExisting) {
			return;
		}
		$this->collActors = new PropelObjectCollection();
		$this->collActors->setModel('Actor');
	}

	/**
	 * Gets an array of Actor objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Category is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Actor[] List of Actor objects
	 * @throws     PropelException
	 */
	public function getActors($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collActors || null !== $criteria) {
			if ($this->isNew() && null === $this->collActors) {
				// return empty collection
				$this->initActors();
			} else {
				$collActors = ActorQuery::create(null, $criteria)
					->filterByCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collActors;
				}
				$this->collActors = $collActors;
			}
		}
		return $this->collActors;
	}

	/**
	 * Returns the number of related Actor objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Actor objects.
	 * @throws     PropelException
	 */
	public function countActors(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collActors || null !== $criteria) {
			if ($this->isNew() && null === $this->collActors) {
				return 0;
			} else {
				$query = ActorQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCategory($this)
					->count($con);
			}
		} else {
			return count($this->collActors);
		}
	}

	/**
	 * Method called to associate a Actor object to this object
	 * through the Actor foreign key attribute.
	 *
	 * @param      Actor $l Actor
	 * @return     void
	 * @throws     PropelException
	 */
	public function addActor(Actor $l)
	{
		if ($this->collActors === null) {
			$this->initActors();
		}
		if (!$this->collActors->contains($l)) { // only add it if the **same** object is not already associated
			$this->collActors[]= $l;
			$l->setCategory($this);
		}
	}

	/**
	 * Clears out the collDocuments collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDocuments()
	 */
	public function clearDocuments()
	{
		$this->collDocuments = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDocuments collection.
	 *
	 * By default this just sets the collDocuments collection to an empty array (like clearcollDocuments());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initDocuments($overrideExisting = true)
	{
		if (null !== $this->collDocuments && !$overrideExisting) {
			return;
		}
		$this->collDocuments = new PropelObjectCollection();
		$this->collDocuments->setModel('Document');
	}

	/**
	 * Gets an array of Document objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Category is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Document[] List of Document objects
	 * @throws     PropelException
	 */
	public function getDocuments($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collDocuments || null !== $criteria) {
			if ($this->isNew() && null === $this->collDocuments) {
				// return empty collection
				$this->initDocuments();
			} else {
				$collDocuments = DocumentQuery::create(null, $criteria)
					->filterByCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collDocuments;
				}
				$this->collDocuments = $collDocuments;
			}
		}
		return $this->collDocuments;
	}

	/**
	 * Returns the number of related Document objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Document objects.
	 * @throws     PropelException
	 */
	public function countDocuments(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collDocuments || null !== $criteria) {
			if ($this->isNew() && null === $this->collDocuments) {
				return 0;
			} else {
				$query = DocumentQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCategory($this)
					->count($con);
			}
		} else {
			return count($this->collDocuments);
		}
	}

	/**
	 * Method called to associate a Document object to this object
	 * through the Document foreign key attribute.
	 *
	 * @param      Document $l Document
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDocument(Document $l)
	{
		if ($this->collDocuments === null) {
			$this->initDocuments();
		}
		if (!$this->collDocuments->contains($l)) { // only add it if the **same** object is not already associated
			$this->collDocuments[]= $l;
			$l->setCategory($this);
		}
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
	 * If this Category is new, it will return
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
					->filterByCategory($this)
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
					->filterByCategory($this)
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
			$l->setCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related Hierarchys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Hierarchy[] List of Hierarchy objects
	 */
	public function getHierarchysJoinActor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = HierarchyQuery::create(null, $criteria);
		$query->joinWith('Actor', $join_behavior);

		return $this->getHierarchys($query, $con);
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
	 * If this Category is new, it will return
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
					->filterByCategory($this)
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
					->filterByCategory($this)
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
			$l->setCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related GraphActors from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
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
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related GraphActors from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GraphActor[] List of GraphActor objects
	 */
	public function getGraphActorsJoinActor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GraphActorQuery::create(null, $criteria);
		$query->joinWith('Actor', $join_behavior);

		return $this->getGraphActors($query, $con);
	}

	/**
	 * Clears out the collGraphCategorys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGraphCategorys()
	 */
	public function clearGraphCategorys()
	{
		$this->collGraphCategorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGraphCategorys collection.
	 *
	 * By default this just sets the collGraphCategorys collection to an empty array (like clearcollGraphCategorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGraphCategorys($overrideExisting = true)
	{
		if (null !== $this->collGraphCategorys && !$overrideExisting) {
			return;
		}
		$this->collGraphCategorys = new PropelObjectCollection();
		$this->collGraphCategorys->setModel('GraphCategory');
	}

	/**
	 * Gets an array of GraphCategory objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Category is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GraphCategory[] List of GraphCategory objects
	 * @throws     PropelException
	 */
	public function getGraphCategorys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGraphCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphCategorys) {
				// return empty collection
				$this->initGraphCategorys();
			} else {
				$collGraphCategorys = GraphCategoryQuery::create(null, $criteria)
					->filterByCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collGraphCategorys;
				}
				$this->collGraphCategorys = $collGraphCategorys;
			}
		}
		return $this->collGraphCategorys;
	}

	/**
	 * Returns the number of related GraphCategory objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GraphCategory objects.
	 * @throws     PropelException
	 */
	public function countGraphCategorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGraphCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collGraphCategorys) {
				return 0;
			} else {
				$query = GraphCategoryQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCategory($this)
					->count($con);
			}
		} else {
			return count($this->collGraphCategorys);
		}
	}

	/**
	 * Method called to associate a GraphCategory object to this object
	 * through the GraphCategory foreign key attribute.
	 *
	 * @param      GraphCategory $l GraphCategory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGraphCategory(GraphCategory $l)
	{
		if ($this->collGraphCategorys === null) {
			$this->initGraphCategorys();
		}
		if (!$this->collGraphCategorys->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGraphCategorys[]= $l;
			$l->setCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related GraphCategorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GraphCategory[] List of GraphCategory objects
	 */
	public function getGraphCategorysJoinGraphModel($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GraphCategoryQuery::create(null, $criteria);
		$query->joinWith('GraphModel', $join_behavior);

		return $this->getGraphCategorys($query, $con);
	}

	/**
	 * Clears out the collGroupCategorys collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGroupCategorys()
	 */
	public function clearGroupCategorys()
	{
		$this->collGroupCategorys = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGroupCategorys collection.
	 *
	 * By default this just sets the collGroupCategorys collection to an empty array (like clearcollGroupCategorys());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initGroupCategorys($overrideExisting = true)
	{
		if (null !== $this->collGroupCategorys && !$overrideExisting) {
			return;
		}
		$this->collGroupCategorys = new PropelObjectCollection();
		$this->collGroupCategorys->setModel('GroupCategory');
	}

	/**
	 * Gets an array of GroupCategory objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Category is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array GroupCategory[] List of GroupCategory objects
	 * @throws     PropelException
	 */
	public function getGroupCategorys($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collGroupCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collGroupCategorys) {
				// return empty collection
				$this->initGroupCategorys();
			} else {
				$collGroupCategorys = GroupCategoryQuery::create(null, $criteria)
					->filterByCategory($this)
					->find($con);
				if (null !== $criteria) {
					return $collGroupCategorys;
				}
				$this->collGroupCategorys = $collGroupCategorys;
			}
		}
		return $this->collGroupCategorys;
	}

	/**
	 * Returns the number of related GroupCategory objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GroupCategory objects.
	 * @throws     PropelException
	 */
	public function countGroupCategorys(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collGroupCategorys || null !== $criteria) {
			if ($this->isNew() && null === $this->collGroupCategorys) {
				return 0;
			} else {
				$query = GroupCategoryQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCategory($this)
					->count($con);
			}
		} else {
			return count($this->collGroupCategorys);
		}
	}

	/**
	 * Method called to associate a GroupCategory object to this object
	 * through the GroupCategory foreign key attribute.
	 *
	 * @param      GroupCategory $l GroupCategory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGroupCategory(GroupCategory $l)
	{
		if ($this->collGroupCategorys === null) {
			$this->initGroupCategorys();
		}
		if (!$this->collGroupCategorys->contains($l)) { // only add it if the **same** object is not already associated
			$this->collGroupCategorys[]= $l;
			$l->setCategory($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related GroupCategorys from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array GroupCategory[] List of GroupCategory objects
	 */
	public function getGroupCategorysJoinGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = GroupCategoryQuery::create(null, $criteria);
		$query->joinWith('Group', $join_behavior);

		return $this->getGroupCategorys($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->name = null;
		$this->active = null;
		$this->hierarchyactors = null;
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
			if ($this->collActors) {
				foreach ($this->collActors as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collDocuments) {
				foreach ($this->collDocuments as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHierarchys) {
				foreach ($this->collHierarchys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphActors) {
				foreach ($this->collGraphActors as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGraphCategorys) {
				foreach ($this->collGraphCategorys as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGroupCategorys) {
				foreach ($this->collGroupCategorys as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collActors instanceof PropelCollection) {
			$this->collActors->clearIterator();
		}
		$this->collActors = null;
		if ($this->collDocuments instanceof PropelCollection) {
			$this->collDocuments->clearIterator();
		}
		$this->collDocuments = null;
		if ($this->collHierarchys instanceof PropelCollection) {
			$this->collHierarchys->clearIterator();
		}
		$this->collHierarchys = null;
		if ($this->collGraphActors instanceof PropelCollection) {
			$this->collGraphActors->clearIterator();
		}
		$this->collGraphActors = null;
		if ($this->collGraphCategorys instanceof PropelCollection) {
			$this->collGraphCategorys->clearIterator();
		}
		$this->collGraphCategorys = null;
		if ($this->collGroupCategorys instanceof PropelCollection) {
			$this->collGroupCategorys->clearIterator();
		}
		$this->collGroupCategorys = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(CategoryPeer::DEFAULT_STRING_FORMAT);
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

} // BaseCategory
