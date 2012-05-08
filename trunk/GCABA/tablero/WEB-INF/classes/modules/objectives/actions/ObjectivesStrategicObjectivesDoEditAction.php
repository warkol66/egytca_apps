<?php

class ObjectivesStrategicObjectivesDoEditAction extends BaseAction {

	function ObjectivesStrategicObjectivesDoEditAction() {
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

		$module = "Objectives";
		$section = "Strategic Objetives";

		$currentPage = $_POST["currentPage"];
		$smarty->assign("currentPage",$currentPage);

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un objective existente

			$strategicObjective = StrategicObjectivePeer::get($_POST["id"]);
			$strategicObjective = Common::setObjectFromParams($strategicObjective, $_POST["strategicObjective"]);
			
			$strategicObjective->save();

			//caso edicion desde show
			if (isset($_POST['show']))
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'success-show');	

			return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');	

		}
		else {
			//estoy creando un nuevo objective
			$strategicObjective = new StrategicObjective();
			$strategicObjective = Common::setObjectFromParams($strategicObjective, $_POST["strategicObjective"]);
			if ( !$strategicObjective->save()) {
				$objective = new Objective();
				$objective->setid($_POST["id"]);
				$objective->setname($_POST["name"]);
				$objective->setAffiliateId($_POST["dependencyId"]);
				$objective->setdescription($_POST["description"]);

				//caso administrador
				if (Common::isAdmin()) {
					$smarty->assign("dependencyId_valores",$valores);
				}

				//caso afiliado
				if (Common::isAffiliatedUser()) {
					$affiliateId = Common::getAffiliatedId();
					$smarty->assign("dependency",$valores);
				}

				//caso edicion desde show
				if (isset($_GET['show']))
					$smarty->assign('show',1);

				$smarty->assign("objective",$objective);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');	

		}

	}

}
