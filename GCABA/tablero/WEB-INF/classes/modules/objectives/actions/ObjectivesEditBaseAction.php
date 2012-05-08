<?php

class ObjectivesEditBaseAction extends BaseAction {

	function ObjectivesEditBaseAction() {
		;
	}
	
	function returnFailure($mapping,$smarty,$objective) {
		$smarty->assign("objective",$objective);
				
		$id = $objective->getId();
		if ( empty($id) ) {
			$action = "create";	
		} else {
			$action = "edit";
		}
				
		$this->prepareDependencies($mapping,$smarty,$objective);
		$this->prepareRegionsAndCommunes($mapping,$smarty,$objective);
		$this->prepareStrategicObjectives($mapping,$smarty,$objective);
				
		$smarty->assign("action",$action);				
		$smarty->assign("message","error");
				
		$logSufix = ', ' . Common::getTranslation("action: $action",'common');
		Common::doLog('failure', $_POST['paramsObjective']["name"] . $logSufix);
		return $mapping->findForwardConfig('failure');		
	}
	
	function prepareSmarty($mapping,$smarty) {

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Objectives";
		$section = "Objectives";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$version = PositionPeer::getLatestVersion();
		$types = array_keys(ConfigModule::get("objectives","positionsTypes"));
		$positions = PositionPeer::getAllResponsiblesByPositionType($types,$version);
		$smarty->assign("positions",$positions);
		
		$minorChanges = ConfigModule::get("objectives","useMinorChanges");
		$smarty->assign("minorChanges",$minorChanges);
		
		//caso administrador
		if (Common::isAdmin() && ($moduleConfig['useDependencies']['value'] == "YES")) {
//			$dependencies = TableroDependencyPeer::getAll();
			$smarty->assign("dependencies",$dependencies);
			if (empty($_GET["id"])) {
				$strategicObjectives = StrategicObjectiveQuery::create()->find();
				$smarty->assign("strategicObjectives",$strategicObjectives);
			}
		}
		else if ($useDependencies == "YES") {
//			$dependencies = TableroDependencyPeer::get('1');
			$smarty->assign("dependencies",$dependencies);
			$strategicObjectives = StrategicObjectiveQuery::create()->find();
			$smarty->assign("strategicObjectives",$strategicObjectives);
		}

		//caso afiliado
		if (Common::isAffiliatedUser()) {
			$affiliateId = Common::getAffiliatedId();
//			$valores = TableroDependencyPeer::get($affiliateId);
			$smarty->assign("dependency",$valores);
			$strategicObjectives = StrategicObjectiveQuery::create()->findByAffiliateid($affiliateId);
			$smarty->assign("strategicObjectives",$strategicObjectives);
		}
		
		//caso edicion desde show
		if (isset($_REQUEST['show']))
			$smarty->assign('show',1);

		$smarty->assign("message",$_REQUEST["message"]);
		
		return $smarty;
	}
	
	function prepareDependencies($mapping,$smarty,$objective) {
//		$dependency = TableroDependencyPeer::get($objective->getAffiliateId());
		$smarty->assign("dependency",$dependency);
	}
	
	function prepareStrategicObjectives($mapping,$smarty,$objective) {
//		$strategicObjectives = StrategicObjectiveQuery::create()->findByAffiliateid($objective->getAffiliateId());
// 		Por ahora pido todos los objetivos
		$strategicObjectives = StrategicObjectiveQuery::create()->find();
		$smarty->assign("strategicObjectives",$strategicObjectives);
	}
	
	function prepareRegionsAndCommunes($mapping,$smarty,$objective) {
		
		//obtenemos todas las comunas y los barrios
//		$communes = TableroCommunePeer::getAll();
		$regions = RegionPeer::getAll();
		$regionsN = RegionQuery::create()->find();

		//obtenemos las que tiene actualmente el proyecto
		//se hace desde esta manera para no romper MVC
		if (isset($objective)) {
			$actualRegions = $objective->getObjectiveRegionsJoinRegion();
//			$actualCommunes = $objective->getTableroCommuneObjectivesJoinTableroCommune();

			$smarty->assign("actualCommunes",$actualCommunes);
			$smarty->assign("actualRegions",$actualRegions);

		}

		$communeCandidates = array();

		foreach($communes as $candidate) {

			$isActual = false;
			foreach ($actualCommunes as $anActual) {
				if ($anActual->getTableroCommune()->getId() == $candidate->getId())
					$isActual = true;
			}
			if (!$isActual)
				array_push($communeCandidates,$candidate);
		}

			$regions = ObjectivePeer::getRegionCandidates($_GET["id"]);
			$smarty->assign("regions",$regions);

/*
		$regionCandidates = array();

		foreach($regions as $candidate) {
			$isActual = false;
			foreach ($actualRegions as $anActual) {
				if ($anActual->getTableroRegion()->getId() == $candidate->getId())
					$isActual = true;
			}
			if (!$isActual)
				array_push($regionCandidates,$candidate);
		}
		$smarty->assign("communes",$communeCandidates);
		$smarty->assign("regions",$regionCandidates);
		$smarty->assign("regionsN",$regionsN);
*/
	}
	
	function execute($mapping, $form, &$request, &$response) {
		BaseAction::execute($mapping, $form, $request, $response);
	}

}
