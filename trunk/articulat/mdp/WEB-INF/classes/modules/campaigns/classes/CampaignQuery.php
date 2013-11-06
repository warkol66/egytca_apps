<?php



/**
 * Skeleton subclass for performing query and update operations on the 'campaign_campaign' table.
 *
 * Base de Campaigns
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.campaign.classes
 */
class CampaignQuery extends BaseCampaignQuery {
	
	public function getMostRecentIds($cant, $twitter){
		$date = date('Y-m-d',strtotime("-$cant days"));
			$campaigns = CampaignQuery::create()->select('Campaign.Id')->filterByTwitterCampaign($twitter)->filterByStartDate(array('min' => $date))->find();
		return $campaigns->toArray();
	}
	
	/* Obtiene las campañas cuya fecha de inicio es menor a $days
	 * 
	 * */
	public function getMostRecent($cant, $twitter){
		$date = date('Y-m-d',strtotime("-$cant days"));
			return CampaignQuery::create()->filterByTwitterCampaign($twitter)->filterByStartDate(array('min' => $date))->find();
	}
	
	/* Busca las campaigns de twitter cuya fecha de inicio es menor a la actual
	 * y la de fin es mayor
	 */
	public function getTwitterActive(){
		$today = date('Y-m-d H:i:s');
		
		$active = CampaignQuery::create()
			->filterByTwittercampaign(1)
			->condition('c0','Campaign.StartDate <= ?', $today)
			->condition('c1','Campaign.FinishDate >= ?', $today)
			->where(array('c0','c1'), 'and')
			->find();
			
		return $active;
	}

} // CampaignQuery
