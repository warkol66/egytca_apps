<?php

require_once("xml2ary.php");

class ModulesEntitiesImportSchemasAction extends BaseAction {

	function ModulesEntitiesImportSchemasAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Modules";
		$smarty->assign("module",$module);
		$section = "Entities";
		$smarty->assign("section",$section);

		//Path a schemas
		$path = "WEB-INF/propel";
		$schemasFile = scandir($path);
    
    $updatedEntitiesNames = array();
    $updatedEntitiesFieldsUniqueNames = array();
		
		$schemas = Array();
		
		foreach ($schemasFile as $schema) {
			if (substr($schema, -10) == "schema.xml") {
				$schemas[] = $schema; 
			}		
		}

		foreach ($schemas as $schema) {		
			$xml = file_get_contents($path."/".$schema);
			
			$xml2ary = new Xml2ary();
			$array = $xml2ary->getArray($xml);
			
			$tables = $array["database"]["_c"]["table"];
			$package = $array["database"]["_a"]["package"];
			$packageParts = explode(".",$package);
			$moduleName = $packageParts[0];
      
      //Cargamos modulos faltantes
      $module = ModulePeer::get($moduleName);
      if (empty($module)) {
        $module = new Module;
        $module->setName($moduleName);
        $module->save();
      }
			
      //Por si el esquema tiene una sola tabla.
      if (isset($tables["_a"]))
        $tables = array($tables);
      
			foreach ($tables as $table) {
			  $entity = null;
        
			  $behaviors = $table['_c']["behavior"];
        if (empty($behaviors))
          $behaviors = array();
        elseif (isset($behaviors["_a"]))
          $behaviors = array($behaviors);
        
				//en estos casos es que hay info de una entity
				if (isset($table["_a"]) || !isset($table["column"])) {
					if (isset($table["_a"]))
						$attributes = $table["_a"];
					else
						$attributes = $table;						

          $entity = ModuleEntityQuery::create()->filterByName($attributes['name'])->findOne();
          if (empty($entity))
					  $entity = new ModuleEntity();
					$entity->setObjectFromSchemaInfo($attributes);
					$entity->setModuleName($moduleName);
          $entity->removeBehaviors();
          $entity->save();
          
					$updatedEntitiesNames[] = $attributes['name'];
				} 

				//en estos casos es que hay info de un entityField
				if (isset($table["_c"]) || isset($table["column"])) {
				
					if (isset($table["_c"]))
						$columns = $table["_c"]["column"];
					else
						$columns = $table["column"];
          
          // Ajuste para tablas con una sola columna  
          if (isset($columns["_a"]))	
            $columns = array($columns);
					foreach ($columns as $column) {
					  if (isset($column["_a"]))
              $attributes = $column["_a"];
            else
              $attributes = $column;
					  $uniqueName = $entity->getName() . "_" . $attributes['name'];
					  $field = ModuleEntityFieldQuery::create()->filterByUniqueName($uniqueName)->findOne();
            if (empty($field))
						  $field = new ModuleEntityField();
						$field->setObjectFromSchemaInfo($attributes);
						$field->setEntityName($entity->getName());
						$field->setUniqueName($uniqueName);
						$field->save();
            $updatedEntitiesFieldsUniqueNames[] = $uniqueName;
					}

				}
        //agregamos los behaviors
        foreach($behaviors as $behavior) {
          $entity->addBehavior($behavior);
        }
			}	
		}

		foreach ($schemas as $schema) {	
			$xml = file_get_contents($path."/".$schema);
			
			$xml2ary = new Xml2ary();
			$array = $xml2ary->getArray($xml);
			
			$tables = $array["database"]["_c"]["table"];
			$package = $array["database"]["_a"]["package"];
			$packageParts = explode(".",$package);
			$moduleName = $packageParts[0];
      
      //Por si el esquema tiene una sola tabla.
      if (isset($tables["_a"]))
        $tables = array($tables);
					
			foreach ($tables as $table) {
				$foreigns = $table["_c"]["foreign-key"];
        $criteria = new Criteria();
        $criteria->add(ModuleEntityPeer::NAME,$table["_a"]["name"]);
        $entities = ModuleEntityPeer::doSelect($criteria);
        $entity = $entities[0];
        if (!empty($entity)) {
          $entity->removeForeignKeys();
				  if (!empty($foreigns)) {
						if (!empty($foreigns["_a"])) {
							//Solo hay una foreign key
							$entity->addForeignKey($foreigns);
						} else {
							//hay varias
							foreach ($foreigns as $foreign) {
								$entity->addForeignKey($foreign);
							}
						}
					}
				} else {
          echo "NO ENCUENTRA:".$table["_a"]["name"];
        }
			}
		}
    
    //Limpiamos lo que ya no va.
    ModuleEntityQuery::create()->filterByName($updatedEntitiesNames, Criteria::NOT_IN)->delete();
    ModuleEntityFieldQuery::create()->filterByUniqueName($updatedEntitiesFieldsUniqueNames, Criteria::NOT_IN)->filterByAutomatic(false)->delete();
		return $mapping->findForwardConfig('success');
	}
}
