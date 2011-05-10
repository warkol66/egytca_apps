<?php

class StudycasesDoEditAction extends BaseAction {

	function StudycasesDoEditAction() {
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

		if ($_POST["action"] == "edit") { // Existing studycase

			$studycase = StudyCasePeer::get($_POST["id"]);
			$studycase = Common::setObjectFromParams($studycase,$_POST["params"]);
			
			if (!$studycase->save()) 
				return $this->returnFailure($mapping,$smarty,$studycase);

			return $mapping->findForwardConfig('success');

		}
		else { // New studycase

			$studycase = new StudyCase();
			$studycase = Common::setObjectFromParams($studycase,$_POST["params"]);
			if (!$studycase->save())
				return $this->returnFailure($mapping,$smarty,$studycase);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

			return $mapping->findForwardConfig('success');
		}

	}

}
