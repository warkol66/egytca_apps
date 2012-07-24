<?php

class MediasTypeDoEditAction extends BaseAction {

	function MediasTypeDoEditAction() {
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
		$mediaTypeParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing media

			$mediaType = MediaTypePeer::get($_POST["id"]);
			$mediaType = Common::setObjectFromParams($mediaType,$mediaTypeParams);
			
			if ($mediaType->isModified() && !$mediaType->save()) 
				return $this->returnFailure($mapping,$smarty,$mediaType,'failure-edit');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New media

			$mediaType = new MediaType();
			$mediaType = Common::setObjectFromParams($mediaType,$mediaTypeParams);
			if (!$mediaType->save())
				return $this->returnFailure($mapping,$smarty,$mediaType);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
