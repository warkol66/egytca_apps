<?php

class ProjectsCreateGraphAction extends BaseAction {

	function ProjectsCreateGraphAction() {
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

		$module = "Projects";

		$smarty->assign("project", ProjectQuery::create()->findPK($_GET['id']));
		
		return $mapping->findForwardConfig("success");
	}

}
