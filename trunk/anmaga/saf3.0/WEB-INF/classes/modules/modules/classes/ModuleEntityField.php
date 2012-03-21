<?php


/**
 * Skeleton subclass for representing a row from the 'modules_entityField' table.
 *
 * Campos de las entidades de modulos 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.modules.classes
 */
class ModuleEntityField extends BaseModuleEntityField {

	public function preSave($con =null) {	
		$this->setUniqueName($this->getEntityName()."_".$this->getName());
		return true;
	}

	public function getId() {
		return $this->getUniqueName();
	}

	public function setEntityId($name) {
		return $this->setEntityName($name);
	}
  
  public function getEntityId() {
    return $this->getEntityName();
  }

	/**
	* Obtiene el nombre del modulo al que pertenece
	*
	*	@return string Nombre del modulo al que pertenece
	*/
	public function getModuleName(){
		$module = ModuleEntityPeer::get($this->getEntityId());
		$moduleName = $module->getModuleName();
		return $moduleName;
	}

	/**
	* Obtiene el nombre del modulo al que pertenece
	*
	*	@return string Nombre del modulo al que pertenece
	*/
	public function isForeignKey(){
		if ($this->getId() != 0) {
			$isForeignKey = ModuleEntityFieldQuery::create()->filterByForeignkeyremote($this->getId())->count();
			if ($isForeignKey > 0)
				return true;
		}
		else
			return false;
	}

	public function getMySqlType() {
		$types = ModuleEntityFieldPeer::getTypesMySql();
		return $types[$this->getType()];
	}

	public function getPropelType() {
		$types = ModuleEntityFieldPeer::getTypesPropel();
		return $types[$this->getType()];
	}

	public function setObjectFromSchemaInfo($attributes) {
		$this->setName($attributes["name"]);
		$this->setDescription($attributes["description"]);
		if (!empty($attributes["required"]) && $attributes["required"] == "true")
			$this->setIsRequired(true);
    if (!empty($attributes["default"]))
      $this->setDefaultValue($attributes["default"]);
		if (!empty($attributes["primaryKey"]) && $attributes["primaryKey"] == "true")
			$this->setIsPrimaryKey(true);			
		if (!empty($attributes["autoIncrement"]) && $attributes["autoIncrement"] == "true")
			$this->setIsAutoIncrement(true);
		$propelType = $attributes["type"];
		$types = ModuleEntityFieldPeer::getTypesPropel();
		foreach ($types as $key => $typeName) {
			if ($propelType == $typeName) {
				$type = $key;
			}
		}		
		$this->setType($type);
		if (!empty($attributes["size"]))
			$this->setSize($attributes["size"]);
	}	
	
	public function getSchema() {
		$schema = '<column name="'.$this->getName().'" description="'.$this->getDescription().'" type="'.$this->getPropelType().'"';
		$propelType = $this->getPropelType();
		$mySqlType = $this->getMySqlType();
		if ($propelType != $mySqlType)
			$schema .= ' sqlType="'.$mySqlType.'"';		
		if ($this->getIsRequired())
			$schema .= ' required="true"';
    $defaultValue = $this->getDefaultValue();
    if (!empty($defaultValue))
      $schema .= ' default="'.$defaultValue.'"';
		if ($this->getIsPrimaryKey())
			$schema .= ' primaryKey="true"';		
		if ($this->getIsAutoIncrement())
			$schema .= ' autoIncrement="true"';					
		$size = $this->getSize();
		if (!empty($size))
			$schema .= ' size="'.$size.'"';		
		$schema .= ' />';
		$validations = $this->getModuleEntityFieldValidations();
		if (count($validations) > 0) {
			$schema .= '<validator column="'.$this->getName().'">';
			foreach ($validations as $validation) {
				$schema .= '<rule name="'.$validation->getName().'"  value="'.$validation->getValue().'"  message="'.$validation->getMessage().'" />';
			}
			$schema .= '</validator>';			
		}
		return $schema;		
	}

	public function getSql() {
		$sql = "insert into modules_entityField ";
		$sql .= "(uniqueName, entityName, name, description, isRequired, defaultValue, isPrimaryKey, isAutoIncrement, order, type, unique, size, ";
		$sql .= "aggregateExpression, label, formFieldType, formFieldSize, formFieldLines, formFieldUseCalendar, foreignKeyTable, foreignKeyRemote) ";
		$sql .= "VALUES ('".$this->getUniqueName()."','".$this->getEntityName()."','".$this->getName()."','".$this->getDescription()."','".$this->getIsRequired()."','".$this->getDefaultValue()."','".$this->getIsPrimaryKey();
		$sql .= "','".$this->getIsAutoIncrement()."','".$this->getOrder()."','".$this->getType()."','".$this->getUnique()."','".$this->getSize();
		$sql .= "','".$this->getAggregateExpression()."','".$this->getLabel()."','".$this->getFormFieldType()."','".$this->getFormFieldSize();
		$sql .= "','".$this->getFormFieldLines()."','".$this->getFormFieldUseCalendar()."','".$this->getForeignKeyTable();
		$sql .= "','".$this->getForeignKeyRemote()."','".$this->getOnDelete()."');\n";
		$validations = $this->getModuleEntityFieldValidations();
		foreach ($validations as $validation) {
			$sql .= 'insert into modules_entityFieldValidation ';
			$sql .= "(entityFieldUniqueName, name, value, message) ";
			$sql .= "VALUES ('".$validation->getEntityFieldUniqueName()."','".$validation->getName()."','".$validation->getValue()."','".$validation->getMessage()."');\n";
		}			
		return $sql;		
	}	
	
	public function setValidationsFromParams($params) {
		//primero borramos todas las validaciones actuales
		$criteria = new Criteria();
		$criteria->add(ModuleEntityFieldValidationPeer::ENTITYFIELDUNIQUENAME,$this->getId());
		ModuleEntityFieldValidationPeer::doDelete($criteria);
		//y luego creamos las nuevas
		$values = $params["value"];
		$names = $params["name"];
		$messages = $params["message"];
		for ($i=0;$i<count($names);$i++) {
			if (!empty($names[$i]) && !empty($values[$i])) {
				$moduleEntityFieldValidation = new ModuleEntityFieldValidation();
				$moduleEntityFieldValidation->setEntityFieldUniqueName($this->getId());
				$moduleEntityFieldValidation->setName($names[$i]);
				$moduleEntityFieldValidation->setValue($values[$i]);
				$moduleEntityFieldValidation->setMessage($messages[$i]);
				$moduleEntityFieldValidation->save();
			}
		}			
	}
  
  public function save(PropelPDO $con = null) {
    try {
      if ($this->validate()) { 
        parent::save($con);
        return true;
      } else {
        return false;
      }
    }
    catch (PropelException $exp) {
      if (ConfigModule::get("global","showPropelExceptions"))
        print_r($exp->getMessage());
      return false;
    }
  }
	
} // ModuleEntityField
