<?php

class ProjectsEditBaseAction extends BaseAction {

	function ProjectsEditBaseAction() {
		;
	}
	
	function returnFailure($mapping,$smarty,$project) {
				$smarty->assign("project",$project);
				
				$id = $project->getId();
				if ( empty($id) ) {
					$smarty->assign("action","create");
				} else {
					$smarty->assign("action","edit");
				}
				
				$smarty->assign("message","error");
				
				$this->prepareDocuments($mapping,$smarty,$project);
				$this->prepareRegionsAndCommunes($mapping,$smarty,$project);

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('failure', $_POST["paramsProject"]["name"] . $logSufix);
				return $mapping->findForwardConfig('failure');		
	}
	
	function prepareObjectives($mapping,$smarty) {
		$objectivePeer = new ObjectivePeer();
		$objectives = $objectivePeer->getAllFiltered();
		
		$smarty->assign("objectives",$objectives);
	}
	
	function preparePositions($mapping, $smarty) {
		$version = PositionPeer::getLatestVersion();
		$types = array_keys(ConfigModule::get("projects","positionsTypes"));
		$positions = PositionPeer::getAllResponsiblesByPositionTypes($types,$version);

		$smarty->assign("positions",$positions);
	}
	
	function prepareDocuments($mapping,$smarty,$project) {

		if (class_exists('DocumentPeer')) {
			$documentsUpload = ConfigModule::get("projects","useDocuments");
			$smarty->assign("documentsUpload", $documentsUpload); //en el template se realizan subidas de documentos
	
			$maxUploadSize =  Common::maxUploadSize();
			$smarty->assign("maxUploadSize",$maxUploadSize);
			
			$documentTypes = DocumentPeer::getDocumentsTypesConfig();
			$smarty->assign("documentTypes",$documentTypes);
	
			// Busco todos los documentos asociados al proyecto
			$documents = $project->getDocuments();
			$smarty->assign("documents",$documents);
		}
	}
	
	function prepareContractors($mapping,$smarty,$project) {

		if (class_exists('ProjectContractorPeer')) {
			$projectContractorPeer = new ProjectContractorPeer();
			$smarty->assign('projectContractorPeer',$projectContractorPeer);
			
			// Enviamos los tipos de contratistas.
			$contractorTypes = ProjectContractorPeer::getTypes();
			$smarty->assign('contractorTypes',$contractorTypes);
			
			// Busco todos los contratistas asociados al proyecto
			$contractors = $project->getClasifiedContractors();
			$smarty->assign('contractors',$contractors);
			
			// Busco todos los preclasificados contratistas asociados al proyecto
			$preClasifiedContractors = $project->getPreClasifiedContractors();
			$smarty->assign('preClasifiedContractors',$preClasifiedContractors);
		}
	}
	
	function prepareRegionsAndCommunes($mapping,$smarty,$project) {
		//obtenemos las comunas y los barrios asignados al objetivo de ese proyecto
			$objective = $project->getObjective();
			if (is_object($objective)) {
				$regionRelationships = $objective->getObjectiveRegionsJoinRegion();
			}

			$communes = array();
			$regions = array();

			foreach ($communeRelationships as $relation)
				array_push($communes,$relation->getTableroCommune());

			foreach ($regionRelationships as $relation)
				array_push($regions,$relation->getRegion());

			//si el proyecto no tiene asignacion de comunas o regiones
			//se puede asignar cualquiera
			if (empty($communes) && ($moduleConfig['useCommunes']['value'] == "YES"))
				$communes = TableroCommunePeer::getAll();

			if (empty($regions) && (ConfigModule::get("projects","useRegions")))
				$regions = RegionPeer::getAllByType(RegionPeer::TOWN);

			//procesamiento para obtener aquellas que no estan asignadas

			//obtenemos las que tiene actualmente el proyecto
			//se hace desde esta manera para no romper MVC

			$actualRegions = $project->getProjectRegionsJoinRegion();

			$smarty->assign("actualCommunes",$actualCommunes);
			$smarty->assign("actualRegions",$actualRegions);

			$communeCandidates = array();

			foreach($communes as $candidate) {

				$isActual = false;
				foreach ($actualCommunes as $anActual) {
					if ($anActual->getCommune()->getId() == $candidate->getId())
						$isActual = true;
				}
				if (!$isActual)
					array_push($communeCandidates,$candidate);
			}

			$regionCandidates = array();

			foreach($regions as $candidate) {
				$isActual = false;
				foreach ($actualRegions as $anActual) {
					if ($anActual->getRegion()->getId() == $candidate->getId())
						$isActual = true;
				}
				if (!$isActual)
					array_push($regionCandidates,$candidate);
			}

			$regions = ProjectPeer::getRegionCandidates($project->getId());
			$smarty->assign("regions",$regions);
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

		$module = "Projects";
		$smarty->assign("module",$module);

		$priorityTypes = ProjectPeer::getPriorityTypes();
		$smarty->assign("priorityTypes",$priorityTypes);

		$this->preparePositions($mapping, $smarty);
		
		$minorChanges = ConfigModule::get("projects","useMinorChanges");
		$smarty->assign("minorChanges",$minorChanges);
		
		$this->prepareObjectives($mapping,$smarty);

		//caso edicion desde show
		if (isset($_REQUEST['show'])) {
			$smarty->assign('show',1);
			//para menu de navegacion
			$smarty->assign('objective',$project->getObjective());
			$smarty->assign('dependency',$project->getObjective()->getAffiliate());
		}

		$smarty->assign("fromObjectiveId",$_REQUEST["fromObjectiveId"]);

		$smarty->assign("filters",$_REQUEST["filters"]);
		$smarty->assign("page",$_REQUEST["page"]);
		$smarty->assign("message",$_REQUEST["message"]);
		
		return $smarty;
	}
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		
	}

}
