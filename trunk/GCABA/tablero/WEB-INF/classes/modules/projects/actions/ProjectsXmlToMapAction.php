<?php

class ProjectsXmlToMapAction extends BaseAction {

	function ProjectsXmlToMapAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplatePlain.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Tablero";
		$section = "Projects";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

/*		$dependenciesToMap = array(
					"VIALIDAD",
					"IPRODHA",
					"ARQUITECTURA",
					"UEP-PROMEBA"
				);

		$i = 0;

		foreach ($dependenciesToMap as $dependency) {
			$depdendencyObjs[$i] = AffiliateQuery::create()->findOneByName($dependency);
			$i ++;
		}
*/
		$depdendencyObjs = array();
		$projects = ProjectPeer::getProjectsToMap($depdendencyObjs);

		$smarty->assign("projects",$projects);
		header("content-Type:text/xml; charset=utf-8"); 	

		return $mapping->findForwardConfig('success');
	}

}
