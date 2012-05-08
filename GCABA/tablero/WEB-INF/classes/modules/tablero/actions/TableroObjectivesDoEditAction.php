<?php

require_once("BaseAction.php");
require_once("TableroObjectivePeer.php");
require_once("TableroDependencyPeer.php");
require_once("TableroCommunePeer.php");
require_once("TableroRegionPeer.php");

class TableroObjectivesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroObjectivesDoEditAction() {
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

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un objective existente

			TableroObjectivePeer::update($_POST["id"],$_POST["name"],$_POST["dependencyId"],$_POST["description"],$_POST["date"],$_POST["expirationDate"],$_POST["achieved"],$_POST["notes"],$_POST["strategicObjectiveId"]);

			//caso edicion desde show
			if (isset($_POST['show']))
				return $mapping->findForwardConfig('success-show');

			return $mapping->findForwardConfig('success');

		}
		else {
			//estoy creando un nuevo objective

			if ( !TableroObjectivePeer::create($_POST["name"],$_POST["dependencyId"],$_POST["description"],$_POST["date"],$_POST["expirationDate"],$_POST["achieved"],$_POST["notes"],$_POST["strategicObjectiveId"]) ) {
				$objective = new TableroObjective();
				$objective->setid($_POST["id"]);
				$objective->setname($_POST["name"]);
				$objective->setAffiliateId($_POST["dependencyId"]);
				$objective->setdescription($_POST["description"]);
				$objective->setStrategicObjectiveId($_POST["strategicObjectiveId"]);
				try {
					$objective->setdate($_POST["date"]);
				} catch (PropelException $exp) { }
				if (!empty($_POST["expirationDate"]))
					$objective->setexpirationDate($_POST["expirationDate"]);
				$objective->setAchieved($_POST["achieved"]);
				$objective->setNotes($_POST["notes"]);

				//caso administrador
				if (Common::isAdmin()) {
					$valores = TableroDependencyPeer::getAll();
					$smarty->assign("dependencyId_valores",$valores);
				}

				//caso afiliado
				if (Common::isAffiliatedUser()) {
					$affiliateId = Common::getAffiliatedId();
					$valores = TableroDependencyPeer::get($affiliateId);
					$smarty->assign("dependency",$valores);
				}

				//obtenemos todas las comunas y los barrios
				$communes = TableroCommunePeer::getAll();
				$regions = TableroRegionPeer::getAll();

				//obtenemos las que tiene actualmente el proyecto
				//se hace desde esta manera para no romper MVC
				if (isset($objective)) {
					$actualRegions = $objective->getRegionObjectivesJoinRegion();
					$actualCommunes = $objective->getCommuneObjectivesJoinCommune();

					$smarty->assign("actualCommunes",$actualCommunes);
					$smarty->assign("actualRegions",$actualRegions);

				}

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
				$smarty->assign("communes",$communeCandidates);
				$smarty->assign("regions",$regionCandidates);

				//caso edicion desde show
				if (isset($_GET['show']))
					$smarty->assign('show',1);

				$smarty->assign("objective",$objective);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
