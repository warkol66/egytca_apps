<?php

class TwitterListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		//si selecciono campaña seteo el
		if(!isset($_GET['filters']['campaignid'])){
			$campaigns = CampaignQuery::create()->getMostRecentIds(15, 1);
			$this->filters['getMostRecent'] = $campaigns;
		}else
			$this->smarty->assign("campaignid",$_GET['filters']['campaignId']);
			
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['createdat']['min'] = $_GET['filters']['minDate'];
            //die('yes');
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['createdat']['max'] = $_GET['filters']['maxDate'];
		}
		
		//filtro por estado
		//ver si se puede eliminar algun caso
		if(!empty($_GET['filters']['status'])){
			$this->filters['Status'] = TwitterTweet::PARSED;
		}elseif(!empty($_GET['filters']['discarded'])){
			$this->filters['Status'] = TwitterTweet::DISCARDED;
		}elseif(!empty($_GET['filters']['all'])){
			$this->filters['maxStatus'] = TwitterTweet::DISCARDED;
		}else{
			$this->filters['Status'] = TwitterTweet::ACCEPTED;
		}
		
		//si hay un filtro de procesados seteado lo aplico
		if(isset($_GET['filters']['processed'])){
			//si quiero ver todos
			if($_GET['filters']['processed'] == -1)
				$this->filters['maxStatus'] = TwitterTweet::DISCARDED; //o discarded?
		}

	}

	protected function postList() {
		parent::postList();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		$this->smarty->assign("tweetValues",TwitterTweet::getValues());
		$this->smarty->assign("tweetRelevances",TwitterTweet::getRelevances());
		$this->smarty->assign("tweetStatuses",TwitterTweet::getStatuses());
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		$this->smarty->assign("campaigns",CampaignQuery::getMostRecent(15, true));
		
		if(!empty($_GET['filters']['dateRange']['createdat']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['createdat']['min'];
        if(!empty($_GET['filters']['dateRange']['createdat']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['createdat']['max'];
            
        //fix para que se pasen bien los filtros a la url del paginador
        $url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
		foreach ($this->filters as $key => $value)
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$this->smarty->assign("url",$url);
            
        $this->smarty->assign("filters",$this->filters);
	}

}