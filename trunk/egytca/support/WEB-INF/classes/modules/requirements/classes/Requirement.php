<?php



/**
 * Skeleton subclass for representing a row from the 'requirements_requirement' table.
 *
 * Requerimientos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.requirements.classes
 */
class Requirement extends BaseRequirement{
	
	/**
	 * Agrega un recurso a un requerimiento
	 * 
	 * @param int $attendantId: id del usuario que vamos a agregar como recurso
	 * @param int $entityId: id del desarrollo 
	 * @param varchar $entityType: desarrollo
	 * @return bool: true si lo agrego, false si no
	 */
	public function addAttendant($attendantId, $entityId, $entityType){
		
		try{
			
			$attendant = new Attendant();
			$attendant->setAttendantid($attendant);
			$attendant->setEntityid($entityId);
			$attendant->setEntitytype($entityType);
			$attendant->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
}
