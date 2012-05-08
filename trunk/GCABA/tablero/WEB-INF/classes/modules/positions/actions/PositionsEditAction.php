<?php

class PositionsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsEditAction() {
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
		$smarty->assign("module",$module);
		
		//obtengo las categorias que el usuario puede acceder	
		$loginUser = Common::getAdminLogged();
		$smarty->assign('loginUser',$loginUser);

		$positionPeer = new PositionPeer();
		$smarty->assign('staffKind', PositionPeer::STAFF);
		$smarty->assign("positionKinds", $positionPeer->getPositionKindsTranslated());
		$positionTypes = $positionPeer->getPositionTypesTranslated();
		$smarty->assign("positionTypes", $positionTypes);

		if ( !empty($_GET["id"]) ) {
			$position = PositionPeer::get($_GET["id"]);
			
			if ( !empty($_GET["tenureId"]) ) {
				$positionTenure = $position->getPositionTenure($_GET["tenureId"]);
				$type = $positionTenure->getObjectType();
				if ($type == "Actor") {
					$actor = $positionTenure->getActor();
					$user = $positionTenure->getUser();
}				else{
					$actor = $positionTenure->getActor();
					$user = $positionTenure->getUser();
	}
			}
			else {
				$positionTenure = new PositionTenure();
				$user = new User();
				$actor = new Actor();
			}
			
			$positionTenures = $position->getPositionTenures();
			
			if ($position->getKind() === PositionPeer::HIERARCHICAL)
				$positions = PositionPeer::getAllPossibleParentsByType($position->getType(), $position->getVersionId());
			else
				$positions = PositionPeer::getAllPossibleParentsByType($position->getKind(), $position->getVersionId());
			
			$smarty->assign("action","edit");
		} else {
			//voy a crear un position nuevo
			$position = new Position();
			$positionTenure = new PositionTenure();
			$user = new User();
			$actor = new Actor();
			$smarty->assign("action","create");
			$positions = PositionPeer::getAllPossibleParents();
		}

		$smarty->assign("position",$position);
		$smarty->assign("positionTenure",$positionTenure);
		$smarty->assign("positionTenures",$positionTenures);
		$smarty->assign("positions",$positions);
		
		$smarty->assign("user", $user);
		$smarty->assign("actor", $actor);
		//$smarty->assign("users",UserPeer::getAll());
		
		$smarty->assign("userGroups", GroupPeer::getAll());

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("addTenure",$_GET["addTenure"]);

		return $mapping->findForwardConfig('success');
	}

}

