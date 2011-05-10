<?php

require_once("BaseAction.php");

class ProjectsXmlToMapAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function ProjectsXmlToMapAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
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

		$tableroProjectPeer = new ProjectPeer();

		$dependenciesToMap = array(
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

		$depdendencyObjs = array();
		$projects = ProjectPeer::getProjectsToMap($depdendencyObjs);

		$smarty->assign("projects",$projects);
		header("content-Type:text/xml; charset=utf-8"); 	

		return $mapping->findForwardConfig('success');
	}

}
