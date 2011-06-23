<?php



/**
 * Skeleton subclass for performing query and update operations on the 'modules_entityFieldValidation' table.
 *
 * Validaciones de los campos de las entidades de módulos 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.modules.classes
 */
class ModuleEntityFieldValidationPeer extends BaseModuleEntityFieldValidationPeer {

	public static function getValidationNames() {
		
		$names = Array();
		$names[] = "match";
		$names[] = "notMatch";
		$names[] = "maxLength";
		$names[] = "minLength";
		$names[] = "maxValue";
		$names[] = "minValue";
		$names[] = "required";
		$names[] = "unique";
		$names[] = "validValues";
		$names[] = "type";
		return $names;
	}
	
} // ModuleEntityFieldValidationPeer
