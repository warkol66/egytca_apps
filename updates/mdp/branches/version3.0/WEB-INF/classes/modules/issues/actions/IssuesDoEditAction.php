<?php

class IssuesDoEditAction extends BaseAction {

	function IssuesDoEditAction() {
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
		$issueParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing actor

			$issue = IssuePeer::get($_POST["id"]);
			$issue = Common::setObjectFromParams($issue,$issueParams);
			
			if ($issue->isModified() && !$issue->save()) 
				return $this->returnFailure($mapping,$smarty,$issue);

	if (headers_sent($filename, $linenum))
		echo "Debug: Headers already sent in $filename on line $linenum\n";
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

		}
		else { // New actor

			$issue = new Issue();
			$issue = Common::setObjectFromParams($issue,$issueParams);
			if (!$issue->save())
				return $this->returnFailure($mapping,$smarty,$issue);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
		}

	}

}
