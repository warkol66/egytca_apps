<?php

class StudycasesShowAction extends BaseAction {

	function StudycasesShowAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//
		// Use a different template
		$this->template->template = "TemplateContent.tpl";

		$module = "Studycases";
		$smarty->assign("module",$module);

		$smarty->assign("actionRequested","studycasesShow");

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$studycasePeer = new StudyCasePeer();

		$studycasePeer->setPublished();

		$studycases = $studycasePeer->getAll();

		$smarty->assign("studycases",$studycases);

		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}
