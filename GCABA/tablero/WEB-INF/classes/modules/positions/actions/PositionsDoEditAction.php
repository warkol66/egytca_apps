<?php

class PositionsDoEditAction extends BaseAction {

	function PositionsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Positions";
		
		$pagerRedirect = array ( "page" => $_POST["page"]);

		foreach ($_POST["filters"] as $key => $value) 
			$filterRedirect["filters[$key]"] = $value;

		if (is_array($filterRedirect))		
			$redirectParams = $pagerRedirect + $filterRedirect;
		else if (is_array($pagerRedirect))
			$redirectParams = $pagerRedirect;
		else
			$redirectParams = $filterRedirect;

		//si no hay userGroup seleccionado, lo ponemos en null.
		if (isset($_POST['positionData']['userGroupId']) && (($_POST['positionData']['userGroupId'] == 0)))
			$_POST['positionData']['userGroupId'] = NULL;
		
		// Si no planifica, me aseguro que las positions tengan el UserGroupId de sus padres.
		if ($_POST['positionData']['planning'] == 0) {
			$parentPosition = PositionQuery::create()->findPK($_POST['positionData']['parentId']);
			if (!empty($parentPosition))
				$_POST['positionData']['userGroupId'] = $parentPosition->getUserGroupId();
		}

		if ($_POST["action"] == "edit") {
			//estoy editando un Position existente

			$redirectParams = $redirectParams + array("id" => $_POST["id"]);

			if (PositionPeer::update($_POST["id"],$_POST["positionData"]))
				return $this->addParamsToForwards(array("id" => $_POST["id"]),$mapping,'successCreate');

		}
		else {
			//estoy creando un nuevo Position
			if ($_POST['positionData']['type'] === PositionPeer::STAFF) {
				$_POST['positionData']['kind'] = PositionPeer::STAFF;
			}
			$position = PositionPeer::create($_POST["positionData"]);

			if (empty($position)) {
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
			return $this->addParamsToForwards(array("id" => $position->getId()),$mapping,'successCreate');
		}

	}

}
