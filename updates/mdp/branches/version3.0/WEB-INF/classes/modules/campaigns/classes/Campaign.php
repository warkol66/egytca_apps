<?php



/**
 * Skeleton subclass for representing a row from the 'campaign_campaign' table.
 *
 * Base de Campaigns
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.campaign.classes
 */
class Campaign extends BaseCampaign {

	/** the default item name for this class */
	const ITEM_NAME = 'Campaign';

	/**
	* Obtiene el nombre traducido del tipo de acto.
	*
	* @return string nombre del tipo
	*/
	function getTypeTranslated() {
		$type = $this->getType();
		$types = CampaignPeer::getCampaignTypes();
		$typeName = $types[$type];
		$typeNameTranslated = Common::getTranslation($typeName,'campaign');
		return $typeNameTranslated;
	}

	/**
	* Obtiene el id de todas las categorías asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedActorsArray(){
		return CampaignParticipantQuery::create()->filterByCampaign($this)->filterByObjecttype('actor')->select('Objectid')->find()->toArray();
	}

	/**
	* Obtiene el id de todas las categorías asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedUsersArray(){
		return CampaignParticipantQuery::create()->filterByCampaign($this)->filterByObjecttype('user')->select('Objectid')->find()->toArray();
	}

	/**
	* Obtiene el id de todas las categorías asignadas.
	*
	*	@return array Id de todos los actor category asignados
	*/
	function getAssignedClientsArray(){
		return CampaignParticipantQuery::create()->filterByCampaign($this)->filterByObjecttype('client')->select('Objectid')->find()->toArray();
	}

	/**
	* Obtiene el cliente
	*
	* @return string nombre del tipo
	*/
	function getClient() {
		$client = ClientQuery::create()->findOneById($this->getClientId());
		return $client;
	}

} // Campaign
