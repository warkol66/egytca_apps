<?php

require_once("BaseAction.php");
require_once("TableroStrategicObjective.php");
require_once("TableroObjectivePeer.php");
require_once("TableroDependencyPeer.php");
require_once("TableroCommunePeer.php");
require_once("TableroRegionPeer.php");
require_once("Region.php");

class TableroObjectivesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TablerobjectivesEditAction() {
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
		$section = "Objectives";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if ( !empty($_GET["id"]) ) {

			$objective = TableroObjectivePeer::get($_GET["id"]);
			$dependency = TableroDependencyPeer::get($objective->getAffiliateId());
			$smarty->assign("dependency",$dependency);
			$strategicObjectives = TableroStrategicObjectiveQuery::create()->findByAffiliateid($objective->getAffiliateId());
			$smarty->assign("strategicObjectives",$strategicObjectives);

			if (Common::isAffiliatedUser() && (!$objective->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');
			}
			$smarty->assign("objective",$objective);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un objective nuevo
			$objective = new TableroObjective();
			$smarty->assign("objective",$objective);
			$smarty->assign("action","create");
		}

		//caso administrador
		if (Common::isAdmin() && ($moduleConfig['useDependencies']['value'] == "YES")) {
			$dependencies = TableroDependencyPeer::getAll();
			$smarty->assign("dependencies",$dependencies);
			if (empty($_GET["id"])) {
				$strategicObjectives = TableroStrategicObjectiveQuery::create()->find();
				$smarty->assign("strategicObjectives",$strategicObjectives);
			}
		}
		else if ($useDependencies == "YES") {
			$dependencies = TableroDependencyPeer::get('1');
			$smarty->assign("dependencies",$dependencies);
			$strategicObjectives = TableroStrategicObjectiveQuery::create()->find();
			$smarty->assign("strategicObjectives",$strategicObjectives);
		}

		//caso afiliado
		if (Common::isAffiliatedUser()) {
			$affiliateId = Common::getAffiliatedId();
			$valores = TableroDependencyPeer::get($affiliateId);
			$smarty->assign("dependency",$valores);
			$strategicObjectives = TableroStrategicObjectiveQuery::create()->findByAffiliateid($affiliateId);
			$smarty->assign("strategicObjectives",$strategicObjectives);
		}

		//obtenemos todas las comunas y los barrios
		$communes = TableroCommunePeer::getAll();
		$regions = TableroRegionPeer::getAll();
		$regionsN = RegionQuery::create()->find();

		//obtenemos las que tiene actualmente el proyecto
		//se hace desde esta manera para no romper MVC
		if (isset($objective)) {
			$actualRegions = $objective->getTableroRegionObjectivesJoinTableroRegion();
			$actualCommunes = $objective->getTableroCommuneObjectivesJoinTableroCommune();

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


		//caso edicion desde show
		if (isset($_GET['show']))
			$smarty->assign('show',1);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
