<?php

require_once("BaseAction.php");

class TableroIndicatorsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroIndicatorsEditAction() {
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

		$module = "Tablero";
		$section = "Indicators";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

    		if ( !empty($_GET["id"]) ) {
			//voy a editar un indicator
			$indicator = TableroIndicatorPeer::get($_GET["id"]);
			$objective = $indicator->getTableroProject()->getTableroObjective();			
			//casos de edicion particulares
			
			if ($indicator->isForRegion()) {
			
				$regionRelationships = $objective->getTableroRegionObjectivesJoinTableroRegion();
				$regions = array();

				foreach ($regionRelationships as $relation) {
					array_push($regions,$relation->getRegion());

				}
			
			}
			
			if ($indicator->isForCommune()) {

				$communeRelationships = $objective->getTableroCommuneObjectivesJoinTableroCommune(); 
				$communes = array();			

				foreach ($communeRelationships as $relation) {
					array_push($communes,$relation->getCommune());
				}

			}
			
			if (Common::isAffiliatedUser() && (!$indicator->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');		
			}
						
			
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","edit");
		}
		else {

			//voy a crear un indicator nuevo
			$indicator = new TableroIndicator();
			$smarty->assign("indicator",$indicator);
			$smarty->assign("action","create");

			if (Common::isAffiliatedUser()) {
				//si no se pasa el id de proyecto no se puede crear una nuevo
				if ( !isset($_GET['projectId'])) {
					return $mapping->findForwardConfig('failure');
				}

				
				$project = TableroProjectPeer::get($_GET['projectId']);
				$objective = $project->getObjective();
				
				$communeRelationships = $objective->getTableroCommuneObjectivesJoinTableroCommune(); 
				$regionRelationships = $objective->getTableroRegionObjectivesJoinTableroRegion();
				
				$communes = array();
				$regions = array();
				
				foreach ($communeRelationships as $relation) {
					array_push($communes,$relation->getCommune());
				}

				foreach ($regionRelationships as $relation) {
					array_push($regions,$relation->getRegion());

				}

				$smarty->assign('project',$project);
				$dependencyId = Common::getAffiliatedId();	
				$valores = TableroProjectPeer::getAll($dependencyId);

		
			}

		}
				
		if (Common::isAdmin()) {
			$valores = TableroProjectPeer::getAll();
			$communes = TableroCommunePeer::getAll();
			$regions = TableroRegionPeer::getAll();
		}

		
		$smarty->assign("projectId_valores",$valores);


		//caso que venga de show
		if (isset($_GET['show'])) {
			$smarty->assign('show',1);
			//para menu navegacion
			if (!isset($project)) {
				if (!empty($_GET['id'])) {

					$project = $indicator->getProject();
				}
				if (!empty($_GET['projectId']))
					$project = TableroProjectPeer::get($_GET['projectId']);
			}

			$smarty->assign('project',$project);
			$smarty->assign('objective',$project->getObjective());
			$smarty->assign('dependency',$project->getObjective()->getAffiliate());
			
		}

		$smarty->assign('measureUnits',TableroMeasureUnitPeer::getAll());
		
		$smarty->assign("communes",$communes);
		$smarty->assign("regions",$regions);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
