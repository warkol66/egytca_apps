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
            
        if(!empty($_GET['filters']['dateFrom']) && !empty($_GET['filters']['dateTo']))
			$this->filters['createdat'] = array(
				'min' => Common::getDatetimeOnGMT(gmdate('Y-m-d H:i:s',strtotime($_GET['filters']['dateFrom']))),
				'max' => Common::getDatetimeOnGMT(gmdate('Y-m-d H:i:s',strtotime($_GET['filters']['dateTo']))));

		//Reviso si se solicito desde campaing valida
		$campaign = CampaignQuery::create()->findOneById($_GET['filters']['campaignid']);
		
		if (!$campaign)
			$campaign = new Campaign();

		$this->smarty->assign('campaign', $campaign);
		
		/*print_r($campaign);
		die();*/
		
		//si no quiero ver los descartados muestro los no aceptados
		if (!empty($_GET['filters']['discarded']))
			$this->filters['parsedDiscarded'] = 1;
		else
			$this->filters['maxStatus'] = TwitterTweet::PARSED;

		$this->filters['orderByCreatedat'] = "desc";
		
		/*print_r($this->filters);
		die();*/

	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
		
		unset($this->filters['createdat']);
            
        //fix para que se pasen bien los filtros a la url del paginador
        $url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
		foreach ($this->filters as $key => $value)
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$this->smarty->assign("url",$url);
            
    $this->smarty->assign("filters",$this->filters);	
	}
}
