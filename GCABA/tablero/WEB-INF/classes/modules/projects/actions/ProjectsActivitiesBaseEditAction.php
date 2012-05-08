<?php

class ProjectsActivitiesBaseEditAction extends BaseAction {


	function ProjectsActivitiesBaseEditAction() {
		;
	}
	function prepareProjectsAndObjectives($mapping,$smarty) {
		$projectPeer = new ProjectPeer();
		$projects = $projectPeer->getAllFiltered();
		
		if (isset($_GET['show'])) {
			$smarty->assign('show',1);
			//para menu navegacion
			if (!isset($project)) {
				if (!empty($_GET['id'])) {
					$project = $activity->getProject();
				}
				if (!empty($_GET['projectId']))
					$project = ProjectPeer::get($_GET['projectId']);
			}			
			$smarty->assign('project',$project);
			$smarty->assign('objective',$project->getObjective());
		}

		
		$smarty->assign("projects",$projects);
	}
	
	function prepareProjectActivity($mapping,$smarty, $request) {
		$activityId = $request->getParameter('id');
		if ( !empty($activityId) ) {
			$activity = ProjectActivityPeer::get($activityId);
			if (Common::isAffiliatedUser() && (!$activity->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');		
			}			

			$smarty->assign("activity",$activity);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un Activity nuevo
			$activity = new ProjectActivity();
			$filters = $request->getParameterValues('filters');
			if (!empty($filters['fromProjects']))
				$activity->setProjectId($filters['projectId']);
			if (!empty($_GET['fromProjectsList']))
				$activity->setProjectId($_GET['fromProjectsList']);
			$smarty->assign("activity",$activity);
			$smarty->assign("action","create");
		}
		return $activity;
	}
	
	function prepareDocuments($mapping,$smarty,$activity) {

		if (class_exists('DocumentPeer') && ConfigModule::get("projectsActivities","useDocuments")) {
			$documentsUpload = ConfigModule::get("projectsActivities","useDocuments");
			$smarty->assign("documentsUpload", $documentsUpload); //en el template se realizan subidas de documentos
	
			$maxUploadSize =  Common::maxUploadSize();
			$smarty->assign("maxUploadSize",$maxUploadSize);
			
			$documentTypes = DocumentPeer::getDocumentsTypesConfig();
			$smarty->assign("documentTypes",$documentTypes);
	
			// Busco todos los documentos asociados al proyecto
			$documents = $activity->getDocuments();
			$smarty->assign("documents",$documents);
		}
	}
	
	function prepareProjectActivityLogs($mapping,$smarty, $request, $activity) {
		$maxPerPage = ConfigModule::get('projects','logsPerPage');
		$projectActivityLogsPager = $activity->getLogsOrderedByUpdatedPaginated('desc', $request->getParameter('page'), $maxPerPage);
		$smarty->assign("projectActivityLogsPager", $projectActivityLogsPager);
		return $projectActivityLogsPager;
	}

}
