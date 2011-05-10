<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_adminActParticipant' table.
 *
 * Base de participantes en actos administrativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class AdminActParticipantPeer extends BaseAdminActParticipantPeer {

	/**
	* Obtiene un administrativeActParticipant.
	*
	* @param int $id id del administrativeActParticipant
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$administrativeActParticipant = AdminActParticipantQuery::create()->findPk($id);
		return $administrativeActParticipant;
	}

 /**
	* Elimina un administrativeActParticipant a partir de los valores de la clave.
	*
	* @param int $id id del administrativeActParticipant
	*	@return boolean true si se elimino correctamente la informacion, false sino
	*/
	function delete($id){
		$administrativeActParticipant = AdminActParticipantPeer::retrieveByPK($id);
		try {
			$administrativeActParticipant->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}	
	
} // AdminActParticipantPeer
