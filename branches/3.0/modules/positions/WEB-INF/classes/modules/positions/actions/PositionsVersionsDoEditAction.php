<?php

class PositionsVersionsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsVersionsDoEditAction() {
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

			if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if (!empty($_POST["id"])) { // Existing project

			$version = PositionVersionPeer::get($_POST["id"]);
			$version = Common::setObjectFromParams($version,$_POST["positionVersionData"]);
			
			if ( !$version->save() ) {

				return $this->returnFailure($mapping,$smarty,$project);
			}

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}
		else { // New project

			$version = new PositionVersion();
			$version = Common::setObjectFromParams($version,$_POST["positionVersionData"]);
			if (!$version->save())
				return $this->returnFailure($mapping,$smarty,$project);

			PositionPeer::createNewVersion();	
				
			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["positionVersionData"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'successCreate');
		}

	}		
		
}
