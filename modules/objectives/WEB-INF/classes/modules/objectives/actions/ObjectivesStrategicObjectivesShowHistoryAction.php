<?php

require_once("BaseAction.php");

class ObjectivesStrategicObjectivesShowHistoryAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesStrategicObjectivesShowHistoryAction() {
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

		$module = "Objectives";
		$section = "Objectives";

   		$smarty->assign("module",$module);
    	$smarty->assign("section",$section);
    	
    	$policyGuidelines = PolicyGuidelinePeer::getAll();
		$smarty->assign("policyGuidelines",$policyGuidelines);

		$objectiveId = $_GET['id'];
		$objective = StrategicObjectivePeer::get($objectiveId);
		$maxPerPage = ConfigModule::get('objectives','logsPerPage');
		$objectiveLogsPager = $objective->getLogsOrderedByUpdatedPaginated('desc', $_GET['page'], $maxPerPage);
		
		$dependency = TableroDependencyPeer::get($objective->getAffiliateId());
		$smarty->assign("dependency",$dependency);
		
		//caso administrador
		if (Common::isAdmin() && ($moduleConfig['useDependencies']['value'] == "YES")) {
			$dependencies = TableroDependencyPeer::getAll();
			$smarty->assign("dependencies",$dependencies);
		}
		else if ($useDependencies == "YES") {
			$dependencies = TableroDependencyPeer::get('1');
			$smarty->assign("dependencies",$dependencies);
		}

		//caso afiliado
		if (Common::isAffiliatedUser()) {
			$affiliateId = Common::getAffiliatedId();
			$valores = TableroDependencyPeer::get($affiliateId);
			$smarty->assign("dependency",$valores);
		}
		
		$smarty->assign("objective",$objective);
		$smarty->assign("objectiveLogsPager", $objectiveLogsPager);
		$smarty->assign("action", "showLog");

		return $mapping->findForwardConfig('success');
	}

}
