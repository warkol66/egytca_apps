<?php

class HeadlinesDoEditAction extends BaseAction {

	function HeadlinesDoEditAction() {
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
		$headlineParams = array_merge_recursive($_POST["params"],$userParams);

		if (isset($_POST["id"])) { // Existing headline

			$headline = HeadlineQuery::create()->findPK($request->getParameter("id"));
			if (!empty($headline)) {
				$headline = Common::setObjectFromParams($headline,$headlineParams);

				$params["id"] = $_POST["id"];

				if ($headline->isModified() && !$headline->save())
					return $this->returnFailure($mapping,$smarty,$headline,'failure-edit');

				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
			}
		}
		else { // New headline

			$headline = new Headline();
			$headline = Common::setObjectFromParams($headline,$headlineParams);
			if (!$headline->save())
				return $this->returnFailure($mapping,$smarty,$headline);

			if (mb_strlen($_POST["params"]["name"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

			$params['id'] = $headline->getId();
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}
	}
}