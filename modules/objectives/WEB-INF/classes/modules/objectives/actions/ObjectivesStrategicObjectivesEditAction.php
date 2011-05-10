<?php

require_once("BaseAction.php");
require_once("StrategicObjectivePeer.php");
require_once("TableroDependencyPeer.php");

class ObjectivesStrategicObjectivesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesStrategicObjectivesEditAction() {
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
		$section = "Strategic Objectives";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$policyGuidelines = PolicyGuidelinePeer::getAll();
		$smarty->assign("policyGuidelines",$policyGuidelines);

		if ( !empty($_GET["id"]) ) {

			$objective = StrategicObjectivePeer::get($_GET["id"]);

			$dependency = TableroDependencyPeer::get($objective->getAffiliateId());
			$smarty->assign("dependency",$dependency);
			
			if (Common::isAffiliatedUser() && (!$objective->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');
			}
			$smarty->assign("objective",$objective);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un objective nuevo
			$objective = new Objective();
			$smarty->assign("objective",$objective);
			$smarty->assign("action","create");
		}

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

		//caso edicion desde show
		if (isset($_GET['show']))
			$smarty->assign('show',1);

		$smarty->assign("message",$_GET["message"]);

		$smarty->assign("filters",$_GET["filters"]);

		return $mapping->findForwardConfig('success');
	}

}
