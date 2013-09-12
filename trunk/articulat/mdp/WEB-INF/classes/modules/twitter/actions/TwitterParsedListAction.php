<?php
/**
 * HeadlinesParsedListAction
 *
 * Listado de Titulares parseados
 *
 * @package    headlines
 */

class TwitterParsedListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";

		//Reviso si se solicito desde campaing valida
		$campaignId = $_GET['filters']['campaignId'];
		$campaign = CampaignQuery::create()->findOneById($campaignId);
		
		if (!$campaign) {
			unset($filters['Campaign']);
			$campaign = new Campaign();
		}

		$this->smarty->assign('campaign', $campaign);
		
		//si no quiero ver los descartados muestro los no aceptados
		if (!empty($_GET['filters']['discarded']))
			$this->filters['status'] = TwitterTweet::DISCARDED;
		else
			$this->filters['maxStatus'] = TwitterTweet::PARSED;

	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
		
		if(isset($_GET['filters']['campaignId'])){
			$this->smarty->assign("acceptedTweets", TwitterTweetQuery::create()->filterByCampaignid($_GET['filters']['campaignId'])->filterByStatus(TwitterTweet::ACCEPTED)->find());
			$this->smarty->assign("tweetValues",TwitterTweet::getValues());
			$this->smarty->assign("tweetRelevances",TwitterTweet::getRelevances());
			$this->smarty->assign("tweetStatuses",TwitterTweet::getStatuses());
		}
	}
}
