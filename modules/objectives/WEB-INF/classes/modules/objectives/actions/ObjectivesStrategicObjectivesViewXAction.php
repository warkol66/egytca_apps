<?php

class ObjectivesStrategicObjectivesViewXAction extends BaseAction {


	function ObjectivesStrategicObjectivesEditAction() {
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

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

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
			$smarty->assign("action","showLog");
		}
		else
			return $mapping->findForwardConfig('failure');

		return $mapping->findForwardConfig('success');
	}

}
