<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_missionCommitment' table.
 *
 * Base de Compromisos de Misiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class MissionCommitmentPeer extends BaseMissionCommitmentPeer {

	/**
	* Obtiene un commitment.
	*
	* @param int $id id del commitment
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$commitment = MissionCommitmentPeer::retrieveByPk($id);
		return $commitment;
	}

 /**
	* Elimina un commitment a partir de los valores de la clave.
	*
	* @param int $id id del mission
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$commitment = MissionCommitmentPeer::retrieveByPk($id);
		try {
			$commitment->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un commitment a partir del id.
	*
	* @param int $id Id del commitment
	* @return boolean true
	*/
  function hardDelete($id) {
		MissionCommitmentPeer::disableSoftDelete();
		$commitment = MissionCommitmentPeer::retrieveByPk($id);
		try {
			$commitment->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}


} // MissionCommitmentPeer
