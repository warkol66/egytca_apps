<?php

class IssuesShowHistoryXAction extends BaseAction {
    
    function IssuesShowHistoryXAction() {
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

                $issue = IssuePeer::get($_REQUEST["id"]);
                $issue->toVersion($_REQUEST["version"]);
                //$ic = new IssueCategory();$ic->get
                $smarty->assign("issue", $issue);
                
                return $mapping->findForwardConfig('success');
                
        }
    
}
?>
