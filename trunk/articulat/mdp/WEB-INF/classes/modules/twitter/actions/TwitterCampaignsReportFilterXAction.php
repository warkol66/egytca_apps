<?php

class TwitterCampaignsReportFilterXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Campaign');
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		
		if(is_object($this->entity)){
			// obtengo los graficos con los filtros indicados
			
			$value = $_POST['value'];
			$byValue = TwitterTweetQuery::getAllByValue(null, null, $value);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byValue[0]))
				$this->smarty->assign('positive', true);
			if(array_key_exists('neutral',$byValue[0]))
				$this->smarty->assign('neutral', true);
			if(array_key_exists('negative',$byValue[0]))
				$this->smarty->assign('negative', true);
			$this->smarty->assign('byValue', $byValue);
				
			$relevance = $_POST['relevance'];
			$byRelevance = TwitterTweetQuery::getAllByRelevance(null, null, $relevance);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('relevant',$byRelevance[0]))
				$this->smarty->assign('relevant', true);
			if(array_key_exists('neutrally_relevant',$byRelevance[0]))
				$this->smarty->assign('neutrally_relevant', true);
			if(array_key_exists('irrelevant',$byRelevance[0]))
				$this->smarty->assign('irrelevant', true);
			$this->smarty->assign('byRelevance', $byRelevance);

		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
