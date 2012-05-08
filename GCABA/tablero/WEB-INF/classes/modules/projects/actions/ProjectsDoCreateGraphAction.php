<?php

class ProjectsDoCreateGraphAction extends BaseAction {

	function ProjectsDoCreateGraphAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Projects";

		global $system;
		$numberOfDecimals = $system["config"]["system"]["parameters"]["numberOfDecimals"];
		$indicator = new Indicator();
		$startDate = $_POST['startDate']['year'] . '-' . $_POST['startDate']['month'];
		$endDate = $_POST['endDate']['year'] . '-' . $_POST['endDate']['month'];
		$projectName = ProjectQuery::create()->select('Name')->findOneById($_POST['id']);
		$indicatorParams = array(
			'name' => "Curva de desembolsos \"" .$projectName . "\"",
			'type' => 2, //linea
			'graphType' => 0,
			'decimals' => $numberOfDecimals,
			'labelX' => 'Fecha',
			'labelY' => 'Inversión',
		);
		Common::setObjectFromParams($indicator, $indicatorParams);
		if (!$indicator->save())
			return $mapping->findforwardConfig("failure");
			
		//Creo relacion de curva de desembolso con categoria 1
		$relationParams["indicatorId"] = $indicator->getId();
		$relationParams["categoryId"] = -1;

		$relation = new IndicatorCategoryRelationPeer();
		$relation->create($relationParams);
	
		$series['Planned'] = new IndicatorSerie();
		$series['ExecutedLocal'] = new IndicatorSerie();
		$series['ExecutedWB'] = new IndicatorSerie();

		$series['Planned']->setIndicatorId($indicator->getId());
		$series['ExecutedLocal']->setIndicatorId($indicator->getId());
		$series['ExecutedWB']->setIndicatorId($indicator->getId());
		
		$series['Planned']->setName("Planificado");
		$series['ExecutedLocal']->setName("Certificados fuente local");
		$series['ExecutedWB']->setName("Certificados fuente externa");
		
		$series['Planned']->save();
		$series['ExecutedLocal']->save();
		$series['ExecutedWB']->save();
		
		for ($year = $_POST['startDate']['year']; $year <= $_POST['endDate']['year']; $year++) {
			$month = $_POST['startDate']['month'];
			while ($month <= $_POST['endDate']['month'] || $year < $_POST['endDate']['year']) {
				
				$x = new IndicatorX();
				$x->setIndicatorId($indicator->getId());
				$x->setName($year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT));
				$x->setOrder($year * 12 + $month);
				if (!$x->save())
					return $mapping->findForwardConfig("failure");
				foreach($series as $serie) {
					$y = new IndicatorY();
					$y->setSerieId($serie->getId());
					$y->setXId($x->getId());
					if (!$y->save())
						return $mapping->findForwardConfig("failure");
				}
				$month++;
				if($month>12){
					$month=1;
					$year++;
				} 
			}
		}

		$project = ProjectPeer::get($_POST['id']);
		$project->setIndicatorId($indicator->getId());
		if (!$project->save())
			return $mapping->findforwardConfig("failure");

		$params["id"] = $indicator->getId();
		return $this->addParamsToForwards($params,$mapping,'success');

	}

}
