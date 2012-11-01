<?php

require_once("BaseAction.php");

class ProcessesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ProcessesEditAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
TA	* already been completed.
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

		$module = "Processes";
		$section = "Processes";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if ( !empty($_GET["id"]) ) {
			//voy a editar un process

			$process = ProcessPeer::get($_GET["id"]);
			
			if (Common::isAffiliatedUser() && (!$process->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');		
			}
			$smarty->assign("process",$process);
  		$smarty->assign("action","edit");

			//obtenemos las comunas y los barrios asignados al objetivo de ese proyecto			
			$objective = $process->getObjective();
			
			$communeRelationships = $objective->getTableroCommuneObjectivesJoinTableroCommune(); 
			$regionRelationships = $objective->getTableroRegionObjectivesJoinTableroRegion();
			
			$communes = array();
			$regions = array();
						
			foreach ($communeRelationships as $relation)
				array_push($communes,$relation->getTableroCommune());

			foreach ($regionRelationships as $relation)
				array_push($regions,$relation->getTableroRegion());
			
			//si el proyecto no tiene asignacion de comunas o regiones
			//se puede asignar cualquiera
			if (empty($communes) && ($moduleConfig['useCommunes']['value'] == "YES"))
				$communes = TableroCommunePeer::getAll();
			
			if (empty($regions) && ($moduleConfig['useRegions']['value'] == "YES"))
				$regions = TableroRegionPeer::getAll();

			//procesamiento para obtener aquellas que no estan asignadas

			//obtenemos las que tiene actualmente el proyecto
			//se hace desde esta manera para no romper MVC

			$actualRegions = $process->getTableroRegionProcessesJoinTableroRegion();
			$actualCommunes = $process->getTableroCommuneProcessesJoinTableroCommune();

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
					if ($anActual->getTableroRegion()->getId() == $candidate->getId())
						$isActual = true;
				}
				if (!$isActual)
					array_push($regionCandidates,$candidate);
			}
			
			$smarty->assign("communes",$communeCandidates);
			$smarty->assign("regions",$regionCandidates);
		}
		else {
			//voy a crear un process nuevo
			$process = new Process();
			$smarty->assign("process",$process);																																									
			$smarty->assign("action","create");
		}

		//caso administrador
		if (Common::isAdmin())
			$objectives = ObjectivePeer::getAll();
		//caso afiliado	
		else if (Common::isAffiliatedUser()) {					
			//obtenemos solo los objetivos relacionados a ese afiliado
			$affiliateId = Common::getAffiliatedId();
			$objectives = ObjectivePeer::getAll($affiliateId);
		}
		
		//caso edicion desde show
		if (isset($_GET['show'])) {
			$smarty->assign('show',1);
			//para menu de navegacion
			$smarty->assign('objective',$process->getObjective());
			$smarty->assign('dependency',$process->getObjective()->getAffiliate());
		}	

		$smarty->assign("objectives",$objectives);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}