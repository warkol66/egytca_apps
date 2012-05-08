<?php

require_once("BaseAction.php");
require_once("TableroProjectPeer.php");
require_once("TableroObjectivePeer.php");

class TableroProjectsShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function TableroProjectsShowAction() {
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

		if (empty($_GET['objectiveId']))
			return $mapping->findForwardConfig('failure');

		$dependencyId = $this->getDependencyId();

		$objective = TableroObjectivePeer::get($_GET['objectiveId']);

		$projects = TableroProjectPeer::getAllByObjective($_GET['objectiveId'],$dependencyId);

		$smarty->assign('dependency',$objective->getAffiliate());
		$smarty->assign('objective',$objective);
		$smarty->assign('projects',$projects);
		$smarty->assign('message',$_GET['message']);

		return $mapping->findForwardConfig('success');

	}

}
