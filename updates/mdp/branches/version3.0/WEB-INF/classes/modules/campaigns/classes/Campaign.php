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

} // Campaign
