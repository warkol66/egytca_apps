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

		if (isset($_POST["id"])) { // Existing media

			$media = MediaQuery::create()->findPK($_POST["id"]);

			if (!empty($media)) {
				if (isset($_POST["params"]["id"]))
					unset($_POST["params"]["id"]);

			$media = Common::setObjectFromParams($media,$mediaParams);
			$params["id"] = $_POST["id"];

			if ($media->isModified() && !$media->save()) 
				return $this->returnFailure($mapping,$smarty,$media,'failure-edit');
			}
			$logSufix = ', ' . Common::getTranslation('action: edit','common');
			Common::doLog('success', $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');

		}
		else { // New media

			$media = new Media();
			$media = Common::setObjectFromParams($media,$mediaParams);

			if (!$media->save())
				return $this->returnFailure($mapping,$smarty,$media);			
			else {
				$params["id"] = $media->getId();

				if (mb_strlen($_POST["params"]["name"]) > 120)
					$cont = " ... ";

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('success', $_POST["params"]["name"] . $logSufix);

				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-add');
			}

		}

	}

}
