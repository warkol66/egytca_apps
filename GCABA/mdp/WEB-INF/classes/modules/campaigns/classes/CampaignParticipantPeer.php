<?php



/**
 * Skeleton subclass for performing query and update operations on the 'campaign_campaignParticipant' table.
 *
 * Base de participantes en campaigns
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.campaign.classes
 */
class CampaignParticipantPeer extends BaseCampaignParticipantPeer {

	/**
	 * Obtiene la relacion
	 * 
	 * @return relacion
	 */
	function get($id){
		$relacion = CampaignParticipantQuery::create()->findById($id);
		return $relacion;
	}

} // CampaignParticipantPeer
