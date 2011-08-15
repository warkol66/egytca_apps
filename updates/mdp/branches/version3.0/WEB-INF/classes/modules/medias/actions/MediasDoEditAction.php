<?php

class MediasDoEditAction extends BaseAction {

	function MediasDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$mediaParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing media

			$media = MediaPeer::get($_POST["id"]);
			$media = Common::setObjectFromParams($media,$mediaParams);
			
			if ($media->isModified() && !$media->save()) 
				return $this->returnFailure($mapping,$smarty,$media,'failure-edit');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New media

			$media = new Media();
			$media = Common::setObjectFromParams($media,$mediaParams);
			if (!$media->save())
				return $this->returnFailure($mapping,$smarty,$media);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
