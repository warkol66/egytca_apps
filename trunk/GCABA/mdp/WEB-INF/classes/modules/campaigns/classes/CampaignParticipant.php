<?php



/**
 * Skeleton subclass for representing a row from the 'campaign_campaignParticipant' table.
 *
 * Base de participantes en campaigns
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.campaign.classes
 */
class CampaignParticipant extends BaseCampaignParticipant {

	/**
	 * Obtiene la entidad a cargo del tenure.
	 * 
	 * @return User o Actor dependiendo del ObjectType, NULL en caso de no existir.
	 */
	public function getObject() {
		if ($this->getObjectType() == "Actor") {
			return ActorQuery::create()->findPK($this->getObjectid());
		} else {
			return UserQuery::create()->findPK($this->getObjectid());
		}
	}
	
	/**
	 * Obtiene el actor asociado al cargo o un nuevo Actor si no existe ninguno.
	 * 
	 * @return siempre retorna un Actor, si existe uno asociado retorna ese, sino uno en blanco
	 */
	public function getActor() {
		if ($this->getObjectType() == "Actor") {
			return ActorQuery::create()->findPK($this->getObjectid());
		} else {
			return new Actor();
		}
	}
	
	/**
	 * Obtiene el usuario asociado al cargo o un nuevo User si no existe ninguno.
	 * 
	 * @return siempre retorna un User, si existe uno asociado retorna ese, sino uno en blanco
	 */
	public function getUser() {
		if ($this->getObjectType() == "User") {
			return UserQuery::create()->findPK($this->getObjectid());
		} else {
			return new User();
		}
	}

} // CampaignParticipant
