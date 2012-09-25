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

	const RELEASE            = 1;
	const PUBLIC_APPEREANCE  = 2;
	const INTERVIEW          = 3;
	const SPONSOR            = 4; 
	const JUDGE              = 5;
	const EARNED             = 6;

	//nombre de los tipos de garantia
	protected static $campaignTypes = array(
						Campaign::RELEASE            => 'Release',
						Campaign::PUBLIC_APPEREANCE  => 'Public Appereance',
						Campaign::INTERVIEW          => 'Interview',
						Campaign::SPONSOR            => 'Sponsor',
						Campaign::JUDGE              => 'Judge',
						Campaign::EARNED             => 'Earned'
					);

	/**
	 * Devuelve los tipos de campaign
	 */
	public static function getCampaignTypes() {
		return Campaign::$campaignTypes;
	}

	/**
	* Obtiene el nombre traducido del tipo de campaign.
	*
	* @return string nombre del tipo
	*/
	function getTypeTranslated() {
		$types = Campaign::getCampaignTypes();
		return Common::getTranslation($types[$this->getType()],'campaigns');
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
