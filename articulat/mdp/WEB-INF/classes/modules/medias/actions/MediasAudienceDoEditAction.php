<?php

class MediasAudienceDoEditAction extends BaseAction {

	function MediasAudienceDoEditAction() {
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
		$mediaAudienceParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing media

			$mediaAudience = MediaAudiencePeer::get($_POST["id"]);
			$mediaAudience = Common::setObjectFromParams($mediaAudience,$mediaAudienceParams);
			
			if ($mediaAudience->isModified() && !$mediaAudience->save()) 
				return $this->returnFailure($mapping,$smarty,$mediaAudience,'failure-edit');

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New media

			$mediaAudience = new MediaAudience();
			$mediaAudience = Common::setObjectFromParams($mediaAudience,$mediaAudienceParams);
			if (!$mediaAudience->save())
				return $this->returnFailure($mapping,$smarty,$mediaAudience);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
