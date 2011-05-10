<?php

class ObjectivesPolicyGuidelinesEditAction extends BaseAction {

	function ObjectivesPolicyGuidelinesEditAction() {
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
		$section = "Policiy Guidelines";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if ( !empty($_GET["id"]) ) {

			$objective = PolicyGuidelinePeer::get($_GET["id"]);
			
			$smarty->assign("objective",$objective);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un objective nuevo
			$objective = new PolicyGuideline();
			$smarty->assign("objective",$objective);
			$smarty->assign("action","create");
		}

		//caso edicion desde show
		if (isset($_GET['show']))
			$smarty->assign('show',1);

		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("filters",$_GET["filters"]);

		return $mapping->findForwardConfig('success');
	}

}
