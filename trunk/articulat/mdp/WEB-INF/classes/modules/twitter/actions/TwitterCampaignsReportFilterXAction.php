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
			
			switch($_POST['graph']){
				case 'value':
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
				break;
				case 'relevance':
					$relevance = $_POST['relevance'];
					$byRelevance = TwitterTweetQuery::getAllByRelevance(null, null, $relevance);
					// seteo los valores disponibles para usarlos luego en la creacion del grafico
					if(array_key_exists('positive',$byRelevance[0]))
						$this->smarty->assign('relevant', true);
					if(array_key_exists('neutral',$byRelevance[0]))
						$this->smarty->assign('neutrally_relevant', true);
					if(array_key_exists('negative',$byRelevance[0]))
						$this->smarty->assign('irrelevant', true);
					$this->smarty->assign('byRelevance', $byRelevance);
				break;
				
			}

		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
