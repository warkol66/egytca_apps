<?php



/**
 * Skeleton subclass for performing query and update operations on the 'campaign_campaignCommitment' table.
 *
 * Base de Compromisos de Campaigns
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.campaign.classes
 */
class CampaignCommitmentPeer extends BaseCampaignCommitmentPeer {

	/**
	* Obtiene un commitment.
	*
	* @param int $id id del commitment
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$commitment = CampaignCommitmentPeer::retrieveByPk($id);
		return $commitment;
	}

 /**
	* Elimina un commitment a partir de los valores de la clave.
	*
	* @param int $id id del campaign
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$commitment = CampaignCommitmentPeer::retrieveByPk($id);
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
		CampaignCommitmentPeer::disableSoftDelete();
		$commitment = CampaignCommitmentPeer::retrieveByPk($id);
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


} // CampaignCommitmentPeer
