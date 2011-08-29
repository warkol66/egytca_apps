<?php

class IssuesLogTabsAction extends BaseAction {
    
    function IssuesLogTabsAction() {
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

                $maxPerPage = 4;
                $issue = IssuePeer::get($_GET["id"]);
                $issueVersionsPager = $issue->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage);
                
                $smarty->assign("issue", $issue);
                $smarty->assign("issueVersionsPager", $issueVersionsPager);

                return $mapping->findForwardConfig('success');
                
        }
    
}
?>
