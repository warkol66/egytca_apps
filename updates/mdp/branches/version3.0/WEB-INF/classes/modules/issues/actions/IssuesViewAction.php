<?php

class IssuesViewAction extends BaseAction {

	function IssuesViewAction() {
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

		$module = "Issues";
		$smarty->assign("module",$module);
                
                $moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
                
                $criteria = new Criteria();
                $categories = IssueCategoryPeer::doSelect($criteria);
                $smarty->assign("categories", $categories);
                
                $criteria = new Criteria();
                $issues = IssuePeer::doSelect($criteria);
                $smarty->assign("issues", $issues);
                
                $criteria = new Criteria();
                $actors = ActorPeer::doSelect($criteria);
                $smarty->assign("actors", $actors);
                
		return $mapping->findForwardConfig('success');
	}

}


