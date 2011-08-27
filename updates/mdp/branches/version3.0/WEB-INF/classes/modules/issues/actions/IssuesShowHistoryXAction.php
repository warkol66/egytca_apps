<?php

include_once 'IssuesEditBaseAction.php';

class IssuesShowHistoryXAction extends IssuesEditBaseAction {
    
function IssuesShowHistoryXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
            
            parent::execute($mapping, $form, $request, $response);
            
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
                
                $smarty->assign("action", "showLog");
                
                return $mapping->findForwardConfig('success');
                
        }
    
}
?>
