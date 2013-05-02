<?php

class BoardDatesValidateXAction extends BaseAction {

	function BoardDatesValidateXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Board";
		$smarty->assign("module",$module);
		
		//si falta ingresar una fecha
		if(empty($_POST['params']['endDate']) || empty($_POST['params']['startDate']))
			$smarty->assign("dateMessage","error");
		else{
			$inBetween = BoardChallenge::selectBetweenDates($_POST['params']['startDate'],$_POST['params']['endDate']);
			
			//si estoy editando un challenge existente, me fijo que no compare superposicion con si mismo
			if(isset($_POST['id'])){
				$existentChallenges = array();
				foreach($inBetween as $existent){
					if ($existent->getId() != $_POST['id'])
						$existentChallenges[] = $existent;
				}
				if(count($existentChallenges) > 0)
					$smarty->assign("dateMessage", "invalid");
					
			}else{
				if(count($inBetween) > 0)
				$smarty->assign("dateMessage", "invalid");
			}
			
		}

		return $mapping->findForwardConfig('success');
	}
}


/*class BoardDatesValidateXAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preList() {
		parent::preList();
		
		if(isset($_POST['id']))
			$this->filters['selectBetweenDates'] = array($_POST['id'],$_POST['params']['endDate'],$_POST['params']['startDate']);
		else
			$this->filters['selectBetweenDates'] = array(null,$_POST['params']['endDate'],$_POST['params']['startDate']);
		
		//ver como arreglar el tema de los filtros
		if(!empty($_POST['params']['endDate']) && !empty($_POST['params']['startDate'])){
			$this->filters['dateRange']['startdate']['max'] = $_POST['params']['startDate'];
            $this->filters['dateRange']['enddate']['min'] = $_POST['params']['endDate'];
		}
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Board";
		$this->smarty->assign("module", $module);
		
		if(empty($_POST['params']['endDate']) || empty($_POST['params']['startDate']))
			$this->smarty->assign("dateMessage","error");
		else
			if(is_object($this->results))
				$this->smarty->assign("dateMessage","invalid");

	}/*

}*/
