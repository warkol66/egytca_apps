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

                $smarty->assign("id", $_GET["id"]);

                return $mapping->findForwardConfig('success');
                
        }
    
}
?>
