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
		
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['createdat']['min'] = $_GET['filters']['minDate'];
            //die('yes');
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['createdat']['max'] = $_GET['filters']['maxDate'];
		}

		//Reviso si se solicito desde campaing valida
		$campaignId = $_GET['filters']['campaignId'];
		$campaign = CampaignQuery::create()->findOneById($campaignId);
		
		if (!$campaign) {
			unset($filters['Campaign']);
			$campaign = new Campaign();
		}

		$this->smarty->assign('campaign', $campaign);
		
		//si no quiero ver los descartados muestro los no aceptados
		if (!empty($_GET['filters']['discarded'])){
			$this->filters['parsedDiscarded'] = 1;
		}else
			$this->filters['maxStatus'] = TwitterTweet::PARSED;

		$this->filters['orderByCreatedat'] = "desc";

	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
		
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
