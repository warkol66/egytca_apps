<?php
require_once "ProjectsEditBaseAction.php";

class ProjectsEditAction extends ProjectsEditBaseAction {

	function ProjectsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		$smarty = $this->prepareSmarty($mapping,$smarty);

		if ( !empty($_GET["id"]) ) {
			//voy a editar un project

			$project = ProjectPeer::get($_GET["id"]);
			
			$this->prepareDocuments($mapping,$smarty,$project);
			$this->prepareContractors($mapping,$smarty,$project);

			if (Common::isAffiliatedUser() && (!$project->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');
			}
			
			$this->prepareRegionsAndCommunes($mapping,$smarty,$project);

			$smarty->assign("project",$project);
			$smarty->assign("action","edit");

		}
		else {
			//voy a crear un project nuevo
			$project = new Project();
			if ($_GET['fromObjectiveId']) {
				$project->setObjectiveId($_GET['fromObjectiveId']);
				$objective = ObjectivePeer::get($_GET['fromObjectiveId']);
				if (!is_null($objective->getResponsibleCode())){
					$position = PositionQuery::create()->findOneByCode($objective->getResponsibleCode());
					$positions = PositionPeer::getAllResponsiblesByPosition($position);
					$smarty->assign("positions",$positions);
				}
			}
			else{
				$this->preparePositions($mapping,$smarty);
			}

			$smarty->assign("project",$project);
			$smarty->assign("action","create");
		}

		return $mapping->findForwardConfig('success');
	}

}
