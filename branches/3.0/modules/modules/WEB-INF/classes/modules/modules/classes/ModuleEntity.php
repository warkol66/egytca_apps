<?php


/**
 * Skeleton subclass for representing a row from the 'modules_entity' table.
 *
 * Entidades de modulos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.modules.classes
 */
class ModuleEntity extends BaseModuleEntity {

	public function getId() {
		return $this->getName();
	}

	/**
	* Obtiene el nombre de la entidad a la que pertenece
	*
	*	@return string Nombre de la entidad a la que pertenece
	*/
	public function getAllEntityFields(){
		return $this->getModuleEntityFieldsRelatedByEntityName();
	}
  
  public function getAllEntityFieldsNonAutomatic(){
    return ModuleEntityFieldQuery::create()->filterByEntityName($this->getName())
                                           ->filterByAutomatic(null)
                                           ->find();
  }

	public function getEntityFieldsNoPrimaryKey(){
		$criteria = new Criteria();
		$criteria->add(ModuleEntityFieldPeer::ISPRIMARYKEY,false,Criteria::EQUAL);
		return $this->getModuleEntityFieldsRelatedByEntityName($criteria);
	}

	public function getEntityFieldsWithForeignKey(){
		$criteria = new Criteria();
		$criterion = $criteria->getNewCriterion(ModuleEntityFieldPeer::FOREIGNKEYREMOTE,null,Criteria::NOT_EQUAL);
		$criterion->addAnd($criteria->getNewCriterion(ModuleEntityFieldPeer::FOREIGNKEYREMOTE,0,Criteria::NOT_EQUAL));
		$criteria->addAnd($criterion);
		return $this->getModuleEntityFieldsRelatedByEntityName($criteria);
	}

	public function getEntityFieldsWithUnique(){
		$criteria = new Criteria();
		$criteria->add(ModuleEntityFieldPeer::UNIQUE,true,Criteria::EQUAL);
		return $this->getModuleEntityFieldsRelatedByEntityName($criteria);
	}

	public function getTableName() {
		return $this->getName();
	}

	public function getSchema() {
		$schema = "<tables>\n";
		$schema .= $this->getTableSchema();
		if ($this->getSaveLog()) {
			$schema .= $this->getTableSchema(true);
		}
		$schema .= "</tables>\n";
		return $schema;
	}

	public function getSql() {
		$sql = "#".$this->getName()."\n";
		$sql .= "delete from modules_entity where name = '".$this->getName()."';\n";
		$sql .= "insert into modules_entity (moduleName, name, phpName, description, softDelete, relation, saveLog, nestedset, scopeFieldUniqueName, behaviors) ";
		$sql .= "values ('".$this->getModuleName()."','".$this->getName()."','".$this->getPhpName()."','".$this->getDescription."','".$this->getSoftDelete();
		$sql .= "','".$this->getRelation()."','".$this->getSaveLog()."','".$this->getNestedset()."','".$this->getScopeFieldUniqueName()."','".stream_get_contents($this->getBehaviors())."');\n";
		foreach ($this->getAllEntityFields() as $field) {
			$sql .= $field->getSql();
		}
		return $sql;
	}	
	
	public function setObjectFromSchemaInfo($attributes) {
		$this->setName($attributes["name"]);
		$this->setPhpName($attributes["phpName"]);
		$this->setDescription($attributes["description"]);
		if (!empty($attributes["isCrossRef"]) && $attributes["isCrossRef"] == "true")
			$this->setRelation(true);
    else
      $this->setRelation(false);
	}

	public function addForeignKey($foreign) {
	  $foreignTable = $foreign["_a"]["foreignTable"];
    $onDelete = strtolower($foreign["_a"]["onDelete"]);

    $criteria = new Criteria();
    $criteria->add(ModuleEntityPeer::NAME,$foreignTable);
    $entityRelated = ModuleEntityPeer::doSelectOne($criteria);
    
    if (!empty($foreign["_c"]["reference"]["_a"]))
      $references = array($foreign["_c"]["reference"]);
    else
      $references = $foreign["_c"]["reference"];
    
    foreach($references as $reference) {
      $fieldName = $reference["_a"]["local"];
      $foreignFieldName = $reference["_a"]["foreign"];
  		$criteria = new Criteria();
  		$criteria->add(ModuleEntityFieldPeer::NAME,$fieldName);
  		$criteria->add(ModuleEntityFieldPeer::ENTITYNAME,$this->getName());
  		$field = ModuleEntityFieldPeer::doSelectOne($criteria);
      if (empty($field)) {
        echo "LOCAL FIELD NOT FOUND: ".$foreignTable."-".$fieldName;
        return;
      }
      if (!empty($onDelete))
        $field->setOnDelete($onDelete);
  		if (!empty($entityRelated)) {
  			$field->setForeignKeyTable($entityRelated->getName());
  			$criteria = new Criteria();
  			$criteria->add(ModuleEntityFieldPeer::NAME,$foreignFieldName);
  			$criteria->add(ModuleEntityFieldPeer::ENTITYNAME,$entityRelated->getName());
  			$fieldRelated = ModuleEntityFieldPeer::doSelectOne($criteria);
  			if (!empty($fieldRelated)) {
  				$field->setForeignKeyRemote($fieldRelated->getUniqueName());
  				$field->save();
  			} else {
  				echo "FIELD RELATED NOT FOUND: ".$foreignTable."-".$foreignFieldName;
  			}
  		} else {
  			echo "ENTITY RELATED NOT FOUND: ".$foreignTable;
  		}
    }
	}

  public function addBehavior($behavior) {
    $parameters = $behavior['_c']['parameter'];
    if (empty($parameters))
      $parameters = array();
    elseif (isset($parameters['_a']))
      $parameters = array($parameters);
      
    //Estos behaviors se guardan de otra manera
    if ($behavior['_a']['name'] == 'nested_set') {
      $this->setNestedSet(true);
      foreach ($parameters as $parameter) {
        if ($parameter['_a']['name'] == 'scope_column') {
          $scopeFieldName = $parameter['_a']['value'];
          $scopeFieldUniqueName = $this->getName()."_".$scopeFieldName;
          $this->setScopeFieldUniqueName($scopeFieldUniqueName);
        }
      }
      $this->save();
      return;
    }
    
    if ($behavior['_a']['name'] == 'soft_delete') {
      $this->setSoftDelete(true);
      $this->save();
      return;
    }
      
    $adaptedBehavior = array();
    $adaptedBehavior['name'] = $behavior['_a']['name'];
    $adaptedBehavior['parameters'] = array();
    
    foreach ($parameters as $parameter) {
      $name = $parameter['_a']['name'];
      $value = $parameter['_a']['value'];
      $adaptedBehavior['parameters'][] = array('name' => $name, 'value' => $value);
    }
    
    $behaviors = $this->getBehaviors();
    if ($behaviors != null)
      $behaviors = unserialize(stream_get_contents($behaviors));
    
    if (empty($behaviors))
      $behaviors = array($adaptedBehavior);
    else
      $behaviors[] = $adaptedBehavior;
    
    $this->setBehaviors(serialize($behaviors));
    $this->save();
  }

  public function removeForeignKeys() {
    ModuleEntityFieldQuery::create()->filterByEntityName($this->getName())
                                    ->update(array('Foreignkeytable' => null, 'Foreignkeyremote' => null, 'Ondelete' => null));
  }
  
  public function removeBehaviors() {
    $this->setSoftDelete(null);
    $this->setNestedSet(null);
    $this->setScopeFieldUniqueName(null);
    $this->setBehaviors(null);
    ModuleEntityFieldQuery::create()->filterByEntityName($this->getName())
                                    ->filterByAutomatic(true)
                                    ->delete();
  }

	public function getTableSchema($log=false) {

		if (!$log) {
			$schema = "\n".'	<table name="'.$this->getTableName().'" phpName="'.$this->getPhpName().'" description="'.$this->getDescription().'"';

			if ($this->getRelation()) {
				$schema .= ' isCrossRef="true"';
			}

			$schema .= ">\n";
		} else {
			$schema = "\n".'	<table name="'.$this->getTableName().'Log" phpName="'.$this->getPhpName().'Log" description="Log '.$this->getDescription().'">'."\n";
		}



		if (!$log) {
			foreach ($this->getAllEntityFieldsNonAutomatic() as $field) {
				$schema .= '		'.$field->getSchema()."\n";
			}
		} else {
			$schema .= '<column name="id" required="true" primaryKey="true" type="INTEGER" description="Log Id" autoIncrement="true" />'."\n";
			$schema .= '<column name="'.$this->getName().'Id" required="true" type="INTEGER" description="'.$this->getPhpName().' Id" />'."\n";
			foreach ($this->getEntityFieldsNoPrimaryKey() as $field) {
				$schema .= '		'.$field->getSchema()."\n";
			}
		}

		if (!$log) {
			foreach ($this->getEntityFieldsWithUnique() as $field) {
				$schema .= "		<unique>\n";
				$schema .= '			<unique-column name="'.$field->getName().'" />'."\n";
				$schema .= "		</unique>\n";
			}
		}

		if (!$log && $this->getNestedSet()) {
			$scopeField = $this->getModuleEntityFieldRelatedByScopefieldUniqueName();

			$schema .= '		<behavior name="nested_set">'."\n";
			if (!empty($scopeField)) {
				$schema .= '			<parameter name="use_scope" value="true" />'."\n";
				$schema .= '			<parameter name="scope_column" value="'.$scopeField->getName().'" />'."\n";
			}
			$schema .= '		</behavior>';
		}

		if (!$log && $this->getSoftDelete()) {
			$schema .= '		<behavior name="soft_delete" />'."\n";
		}

    //Otros behaviors
    if (!$log && $this->getBehaviors() != null) {
      $behaviors = unserialize(stream_get_contents($this->getBehaviors()));
      foreach($behaviors as $behavior) {
        $parameters = $behavior['parameters'];
        if (count($parameters) > 0) {
          $schema .= '    <behavior name="'.$behavior['name'].'">'."\n";
          foreach($parameters as $parameter) {
            $name = $parameter['name'];
            $value = $parameter['value'];
            $schema .= '      <parameter name="'.$name.'" value="'.$value.'" />'."\n";
          }
          $schema .= '    </behavior>'."\n";
        } else {
          $schema .= '    <behavior name="'.$behavior['name'].'" />'."\n";
        }
      }
    }

		if ($log) {
			$schema .= '		<foreign-key foreignTable="'.$this->getTableName().'">'."\n";
			$schema .= '			<reference local="'.$this->getName().'Id" foreign="id" />'."\n";
			$schema .= "		</foreign-key>\n";
		}

		foreach ($this->getEntityFieldsWithForeignKey() as $field) {
		  $onDelete = $field->getOnDelete();
		  $onDelete = !empty($onDelete) ? ' onDelete="'.$onDelete.'"' : '';
			$entityRelated = $field->getModuleEntityRelatedByForeignkeytable();
			$fieldRelated = $field->getModuleEntityFieldRelatedByForeignkeyremote();
			$schema .= '		<foreign-key foreignTable="'.$entityRelated->getTableName().'"'.$onDelete.'>'."\n";
			$schema .= '			<reference local="'.$field->getName().'" foreign="'.$fieldRelated->getName().'" />'."\n";
			$schema .= "		</foreign-key>\n\n";
		}

		$schema .= '		<vendor type="mysql">'."\n";
		$schema .= '			<parameter name="Charset" value="utf8" />'."\n";
		$schema .= '			<parameter name="Collate" value="utf8_general_ci" />'."\n";
		$schema .= "		</vendor>\n";

		$schema .= "	</table>\n\n";
		return $schema;
	}

	public function createFieldsFromParams($paramsFields) {
		for ($i=0;$i<count($paramsFields["name"]);$i++) {
			$params = array();
			foreach ($paramsFields as $key => $values) {
				if (!empty($values[$i])) {
					$params[$key] = $values[$i];	
				}
				
			}
			$params["entityName"] = $this->getName();
			$field = new ModuleEntityField();
			$field = Common::setObjectFromParams($field,$params);
			$field->save(); 
		}
	}
  
  public function getBehaviorsOnArray() {
    if ($this->getBehaviors() === null)
      return array();
    return unserialize(stream_get_contents($this->getBehaviors()));
  }
  
  /**
   * Establece que la entidad utiliza softDelete.
   * Crea el campo deleted_at como automático.
   */
  public function setSoftdelete($v) {
    parent::setSoftDelete($v);
    $fieldName = 'deleted_at';
    $fieldUniqueName = $this->getName().'_'.$fieldName;
    if ($v) {
      $fieldParams = array(
        'uniqueName' => $fieldUniqueName,
        'entityName' => $this->getName(),
        'name' => $fieldName,
        'type' => ModuleEntityFieldPeer::TIMESTAMP,
        'automatic' => true
      );
      $field = ModuleEntityFieldQuery::create()->filterByUniqueName($fieldUniqueName)->findOne();
      if (empty($field)) {
        $field = new ModuleEntityField;
        Common::setObjectFromParams($field, $fieldParams);
        $field->save();
      }
    } else {
      $field = ModuleEntityFieldQuery::create()->filterByUniqueName($fieldUniqueName)
                                               ->filterByAutomatic(true)
                                               ->delete();
    }
  }
  
  /**
   * Establece que la entidad utiliza nested set.
   * Crea los campos tree_left, tree_right y tree_level como automáticos.
   */
  public function setNestedset($v) {
    parent::setNestedset($v);
    $fieldsToCreate = array('tree_left', 'tree_right', 'tree_level');
    foreach ($fieldsToCreate as $fieldToCreate) {
      $fieldName = $fieldToCreate;
      $fieldUniqueName = $this->getName().'_'.$fieldName;
      if ($v) {
        $fieldParams = array(
          'uniqueName' => $fieldUniqueName,
          'entityName' => $this->getName(),
          'name' => $fieldName,
          'type' => ModuleEntityFieldPeer::INTEGER,
          'automatic' => true
        );
        $field = ModuleEntityFieldQuery::create()->filterByUniqueName($fieldUniqueName)->findOne();
        if (empty($field)) {
          $field = new ModuleEntityField;
          Common::setObjectFromParams($field, $fieldParams);
          $field->save();
        }
      } else {
        $field = ModuleEntityFieldQuery::create()->filterByUniqueName($fieldUniqueName)
                                                 ->filterByAutomatic(true)
                                                 ->delete();
      }
    }
  }
  
  /**
   * Establece el campo scope field del behavior nested set.
   * Si el campo relacionado no existe lo crea y lo marca como automatico.
   */
  public function setScopefielduniquename($v) {
    $scopeFieldUniqueName = $v;
    if (empty($scopeFieldUniqueName))
      ModuleEntityFieldQuery::create()->filterByUniqueName($this->getScopeFieldUniqueName())
                                      ->filterByAutomatic(true)
                                      ->delete();
    parent::setScopeFieldUniqueName($scopeFieldUniqueName);
    $scopeField = ModuleEntityFieldQuery::create()->filterByUniqueName($scopeFieldUniqueName)->findOne();
    if (empty($scopeField)) {
      $scopeField = new ModuleEntityField;
      $scopeFieldName = preg_replace('/^'.$this->getName().'_/', '', $scopeFieldUniqueName);
      if (!empty($scopeFieldName)) {
        $scopeFieldParams = array(
          'uniqueName' => $scopeFieldUniqueName,
          'entityName' => $this->getName(),
          'name' => $scopeFieldName,
          'type' => ModuleEntityFieldPeer::INTEGER,
          'automatic' => true
        );
        Common::setObjectFromParams($scopeField, $scopeFieldParams);
        $scopeField->save();
      }
    }
  }
} // ModuleEntity
