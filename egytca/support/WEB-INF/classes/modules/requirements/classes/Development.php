<?php



/**
 * Skeleton subclass for representing a row from the 'requirements_development' table.
 *
 * Desarrollo
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.requirements.classes
 */
class Development extends BaseDevelopment{
	
	/**
	 * Agrega un recurso a un desarrollo
	 * 
	 * @param int $attendant: usuario que vamos a agregar como recurso
	 * @param int $entityId: id del desarrollo 
	 * @param varchar $entityType: desarrollo
	 * @return bool: true si lo agrego, false si no
	 */
	public function addAttendant($attendant, $entityId, $entityType){
		
		try{
			
			$Attendant = new Attendant();
			$Attendant->setAttendantid($attendant);
			$Attendant->setEntityid($entityId);
			$Attendant->setEntitytype($entityType);
			$Attendant->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
}
