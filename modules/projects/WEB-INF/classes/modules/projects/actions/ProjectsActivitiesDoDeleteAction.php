<?php

class ProjectsActivitiesDoDeleteAction extends BaseAction {

	function ProjectsActivitiesDoDeleteAction() {
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

		$module = "Tablero";

    $activity = ProjectActivityPeer::get($_POST["id"]);
		if (is_object($activity)) {
			$project = $activity->getProject();
		    		
    	if (Common::isAffiliatedUser() && (!$activity->isOwner(Common::getAffiliatedId())))
			//es usuario afiliado pero no es duenio de la instancia
    			return $mapping->findForwardConfig('failure');	
 
			$activity->delete();
  	}
		
		if (isset($_POST['show'])) {
			
			$myRedirectConfig = $mapping->findForwardConfig('success-show');
			$myRedirectPath = $myRedirectConfig->getpath();
			$queryData = '&projectId='.$project->getId();
			$myRedirectPath .= $queryData;
			$fc = new ForwardConfig($myRedirectPath, True);
			return $fc;
			
		}			
		if (!empty($_POST['filters']['fromProjects']))
			return $this->addFiltersToForwards(array('fromProjects'=>$_POST['filters']['fromProjects'], 'projectId'=>$_POST['filters']['projectId']),$mapping,'success');
		return $mapping->findForwardConfig('success');	
	}

}
