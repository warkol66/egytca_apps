<?php

class ObjectivesPolicyGuidelinesDoEditAction extends BaseAction {

	function ObjectivesPolicyGuidelinesDoEditAction() {
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

		$module = "Objectives";
		$section = "Policy Guidelines";

		$currentPage = $_POST["currentPage"];
		$smarty->assign("currentPage",$currentPage);

		if (!is_null($_POST["policyGuidelineParams"]["exchangeRate"]))
			$_POST["policyGuidelineParams"]["exchangeRate"] = Common::convertToMysqlNumericFormat($_POST["policyGuidelineParams"]["exchangeRate"]);

		if ($_POST["action"] == "edit" && !is_null($_POST["id"])) {
			//estoy editando un objective existente
			
			$policyGuideline = PolicyGuidelinePeer::get($_POST["id"]);
			$policyGuideline = Common::setObjectFromParams($policyGuideline,$_POST["policyGuidelineParams"]);
			
			if ($policyGuideline->save()) {
				//caso edicion desde show
				if (isset($_POST['show']))
					return $this->addFiltersToForwards($_POST['filters'],$mapping,'success-show');	
	
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');	
			}
		}
		else {
			//estoy creando un nuevo objective
			$policyGuideline = new PolicyGuideline();
			$policyGuideline = Common::setObjectFromParams($policyGuideline,$_POST["policyGuidelineParams"]);

			if (!$policyGuideline->save()) {
				$objective = $policyGuideline;

				//caso edicion desde show
				if (isset($_GET['show']))
					$smarty->assign('show',1);

				$smarty->assign("objective",$objective);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
			}

			return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');	

		}

	}

}
