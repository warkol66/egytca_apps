<?php

require_once("BaseAction.php");

class ProjectsDetailsShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProjectsDetailsShowAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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
		$section = "Projects";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		if (empty($_GET['projectId'])) {
			return $mapping->findForwardConfig('failure');		
		}

		$dependencyId = $this->getDependencyId();

		$project = ProjectPeer::get($_GET['projectId']);
		$indicators = TableroIndicatorPeer::getAllByProject($_GET['projectId'],$dependencyId);
		$milestones = TableroMilestonePeer::getAllByProject($_GET['projectId'],$dependencyId);
		
		$actualRegions = $project->getTableroRegionProjectsJoinTableroRegion();
		$actualCommunes = $project->getTableroCommuneProjectsJoinTableroCommune();
			
		$smarty->assign('project',$project);
		$smarty->assign('objective',$project->getObjective());
		$smarty->assign('dependency',$project->getObjective()->getAffiliate());
		$smarty->assign('indicators',$indicators);
		$smarty->assign('milestones',$milestones);
		$smarty->assign("actualCommunes",$actualCommunes);
		$smarty->assign("actualRegions",$actualRegions);
		$smarty->assign("message",$_GET['message']);
		
		return $mapping->findForwardConfig('success');

	}

}
