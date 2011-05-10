<?php

class PositionsTenuresDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsTenuresDoEditAction() {
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

		$module = "Positions";

		$position = PositionPeer::getLastByCode($_POST["positionTenureData"]["positionCode"]);
		
		if ($_POST["positionTenureData"]["objectType"] == "Actor") {

			$_POST["positionTenureData"]["objectId"] = $_POST["positionTenureData"]["actorId"];
			
			// TODO esto es temporal hasta que el proceso de adaptacion al uso de actores este completo.
			$_POST["positionTenureData"]["userId"] = "";
			$_POST["positionTenureData"]["name"] = ActorQuery::create()->findPK($_POST["positionTenureData"]["actorId"])->getName();
		}

		if ($_POST["positionTenureData"]["objectType"] == "User") {

			$_POST["positionTenureData"]["objectId"] = $_POST["positionTenureData"]["userId"];
			
			// TODO esto es temporal hasta que el proceso de adaptacion al uso de actores este completo.
			$_POST["positionTenureData"]["name"] = "";
		}

		if (!empty($_POST["id"])) {
			//estoy editando un PositionTenure existente

			if (PositionTenurePeer::update($_POST["id"],$_POST["positionTenureData"]))
				return $this->addParamsToForwards(array("id" => $position->getId()),$mapping,'success');

		}
		else {
			//estoy creando un nuevo PositionTenure

			$positionTenure = PositionTenurePeer::create($_POST["positionTenureData"]);

			if (empty($positionTenure)) {
				//TODO: completar
				$position = PositionPeer::getObjectFromParams($_POST["positionData"]);
				//$positionTenure = PositionTenurePeer::getObjectFromParams($_POST["positionTenureData"]);
				$smarty->assign("position",$position);
				//$smarty->assign("positionTenure",$positionTenure);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				
				$positionPeer = new PositionPeer();
				$positionTypes = $positionPeer->getPositionTypesTranslated();
				$smarty->assign("positionTypes",$positionTypes);				
				$smarty->assign("users",UserPeer::getAll());
				
				return $mapping->findForwardConfig('failure');				
			}
			return $this->addParamsToForwards(array("id" => $position->getId()),$mapping,'success');
		}

	}

}
